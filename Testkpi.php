<?php
include('connect.php'); 
if (isset(($_GET['enddate']))) {
    $start_date = $_GET['startdate']; // รับค่าวันที่เริ่มต้น
    $end_date = $_GET['enddate']; // รับค่าวันที่สิ้นสุด

    // ส่วนที่ 1: นับลูกค้าที่หมดสัญญา (cus_out_ct)
    $sql_cus_out_ct = "SELECT 
        COUNT(CASE WHEN cus_prov_id_fk = 16 THEN 1 END) AS count_16_out_ct,
        COUNT(CASE WHEN cus_prov_id_fk = 15 THEN 1 END) AS count_15_out_ct,
        COUNT(CASE WHEN cus_prov_id_fk = 14 THEN 1 END) AS count_14_out_ct,
        COUNT(CASE WHEN cus_prov_id_fk = 17 THEN 1 END) AS count_17_out_ct,
        COUNT(*) AS total_count
        FROM (
            SELECT 
                `loan_receive_finish_date`, 
                `loan_period`, 
                `loan_closed_date`,
                `cus_prov_id_fk`,
                DATE_ADD(`loan_receive_finish_date`, INTERVAL `loan_period` MONTH) AS `new_date`
            FROM `tbl_loan`
        ) AS subquery
        WHERE new_date BETWEEN ? AND ?
        AND loan_closed_date IS NULL;"; // ลูกค้าหมดสัญญา

    // เตรียมคำสั่ง SQL
    $count_cus_out_ct = mysqli_prepare($conn, $sql_cus_out_ct);

    // ผูกค่าพารามิเตอร์
    mysqli_stmt_bind_param($count_cus_out_ct, "ss", $start_date, $end_date);

    // รันคำสั่ง SQL
    mysqli_stmt_execute($count_cus_out_ct);

    // ดึงผลลัพธ์
    $resultcount_cus_out_ct = mysqli_stmt_get_result($count_cus_out_ct);
    $row_count_cus_out_ct = mysqli_fetch_assoc($resultcount_cus_out_ct);

    // ส่วนที่ 2: นับลูกค้าที่ปิดสัญญา (closed)
    function checkStatusclose($date1, $date2) {
        if (!$date1 || $date1 == "0000-00-00") {
            $date1 = "ว่าง";
        }
        if (!$date2 || $date2 == "0000-00-00") {
            $date2 = "ว่าง";
        }

        if ($date1 === "ว่าง" || $date2 === "ว่าง") {
            return "unknown";
        }

        $ym1 = date('Y-m', strtotime($date1));
        $ym2 = date('Y-m', strtotime($date2));

        return ($ym1 == $ym2) ? "owe" : "closed";
    }

    // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
    $sql = "SELECT 
        loan_cus_code_fk,
        loan_receive_finish_date,
        loan_closed_date,
        cus_prov_id_fk
        FROM tbl_loan
        ORDER BY loan_cus_code_fk, loan_receive_finish_date";

    $result = $conn->query($sql);

    if (!$result) {
        die("Query Failed: " . $conn->error);
    }

    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // ตัวแปรเก็บ count closed รวม
    $count_closed = 0;
    $filtered_closed_count = 0;

    // ตัวแปรเก็บ count closed แยกตามจังหวัด (ทั้งหมด)
    $province_closed_count = [14 => 0, 15 => 0, 16 => 0, 17 => 0];

    // ตัวแปรเก็บ count closed แยกตามจังหวัด (เฉพาะช่วงวันที่)
    $filtered_province_closed_count = [14 => 0, 15 => 0, 16 => 0, 17 => 0];

    for ($i = 0; $i < count($rows); $i++) {
        $status = "unknown";
        if (($i + 1) < count($rows)) {
            $status = checkStatusclose($rows[$i]['loan_closed_date'], $rows[$i + 1]['loan_receive_finish_date']);
        }

        if ($status === "closed") {
            $count_closed++;

            // เช็คว่าจังหวัดอยู่ในกลุ่มที่ต้องการหรือไม่
            $province_id = intval($rows[$i]['cus_prov_id_fk']);
            if (isset($province_closed_count[$province_id])) {
                $province_closed_count[$province_id]++;

                // กรองข้อมูลเฉพาะช่วงวันที่
                if (!empty($start_date) && !empty($end_date)) {
                    if ($rows[$i]['loan_closed_date'] >= $start_date && $rows[$i]['loan_closed_date'] <= $end_date) {
                        $filtered_closed_count++;
                        $filtered_province_closed_count[$province_id]++;
                    }
                }
            }
        }
    }

    // รวมข้อมูลทั้งหมด
    $data = [
        'count_14_out_ct' => isset($row_count_cus_out_ct['count_14_out_ct']) ? (float)str_replace(',', '', $row_count_cus_out_ct['count_14_out_ct']) : 0,
        'count_15_out_ct' => isset($row_count_cus_out_ct['count_15_out_ct']) ? (float)str_replace(',', '', $row_count_cus_out_ct['count_15_out_ct']) : 0,
        'count_16_out_ct' => isset($row_count_cus_out_ct['count_16_out_ct']) ? (float)str_replace(',', '', $row_count_cus_out_ct['count_16_out_ct']) : 0,
        'count_17_out_ct' => isset($row_count_cus_out_ct['count_17_out_ct']) ? (float)str_replace(',', '', $row_count_cus_out_ct['count_17_out_ct']) : 0,
        'count_closed' => $count_closed,
        'filtered_closed_count' => $filtered_closed_count,
        'province_closed_count' => $province_closed_count,
        'filtered_province_closed_count' => $filtered_province_closed_count
    ];

    // ส่งออก JSON
    echo json_encode($data);
} else {
    // ตอบกลับเมื่อไม่มีพารามิเตอร์
    echo json_encode(['error' => 'Invalid request. Please provide startdate and enddate.']);
}
?>