<?php
require_once 'connect.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

// Function to count loan statuses based on start and end dates
function countStatus($conn, $start_date, $end_date) {
    $sql_loan = "
    SELECT loan_crd_no, 
           loan_cus_code_fk, 
           loan_receive_finish_date, 
           loan_info_offer, 
           loan_closed_date,
           CASE 
               WHEN (@row_num := IF(@prev_cus = loan_cus_code_fk, @row_num + 1, 1)) = 1 
               THEN 'ໃໝ່' 
               ELSE 'เก่า' 
           END AS status,
           CASE 
               WHEN @prev_cus = loan_cus_code_fk THEN
                   CASE 
                       WHEN DATEDIFF(loan_receive_finish_date, loan_closed_date) <= 30 THEN 'ลูกค้ากับคืน'
                       WHEN DATEDIFF(loan_receive_finish_date, loan_closed_date) <= 13 THEN 'อ่วย'
                       ELSE NULL
                   END
               ELSE NULL
           END AS additional_status,
           (@prev_cus := loan_cus_code_fk) AS dummy
    FROM tbl_loan
    WHERE loan_receive_finish_date BETWEEN ? AND ?
    ORDER BY loan_cus_code_fk, loan_receive_finish_date";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql_loan);
    mysqli_stmt_bind_param($stmt, "ss", $start_date, $end_date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Initialize counters
    $count_new_status = 0;
    $count_customer_return = 0;
    $count_owe = 0;

    // Loop through results and count based on conditions
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['status'] == 'ໃໝ່') {
            $count_new_status++;
        }
        if ($row['additional_status'] == 'ลูกค้ากับคืน') {
            $count_customer_return++;
        }
        if ($row['additional_status'] == 'อ่วย') {
            $count_owe++;
        }
    }

    // Return the counts
    return [
        'new_status' => $count_new_status,
        'customer_return' => $count_customer_return,
        'owe' => $count_owe
    ];
}

if (isset($_GET['enddate'])) {
    $start_date = '2015-01-01'; // รับค่าวันที่เริ่มต้น
    $end_date = $_GET['enddate']; // รับค่าวันที่สิ้นสุด

    // ดึงข้อมูลจาก tbl_agent
    $sql_agent = "SELECT
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'A' AND `agent_prov_id_fk` = '14' THEN 1 END) as count_agent_A14, 
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'A' AND `agent_prov_id_fk` = '15' THEN 1 END) as count_agent_A15, 
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'A' AND `agent_prov_id_fk` = '16' THEN 1 END) as count_agent_A16, 
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'A' AND `agent_prov_id_fk` = '17' THEN 1 END) as count_agent_A17, 
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '14' THEN 1 END) as count_agent_B14,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '15' THEN 1 END) as count_agent_B15,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '16' THEN 1 END) as count_agent_B16,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '17' THEN 1 END) as count_agent_B17,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_prov_id_fk` = '14' THEN 1 END) as count_toltal14,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_prov_id_fk` = '15' THEN 1 END) as count_toltal15,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_prov_id_fk` = '16' THEN 1 END) as count_toltal16,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_prov_id_fk` = '17' THEN 1 END) as count_toltal17
    FROM `tbl_agent`";

    $agent = mysqli_prepare($conn, $sql_agent);
    mysqli_stmt_execute($agent);
    $resultagent = mysqli_stmt_get_result($agent);
    $row_agent = mysqli_fetch_assoc($resultagent);

    $sql_AGENT_B_NEW = "SELECT
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '14' THEN 1 END) as count_agent_B14_new,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '15' THEN 1 END) as count_agent_B15_new,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '16' THEN 1 END) as count_agent_B16_new,
        COUNT(CASE WHEN `agent_status` = '0' AND `agent_type` = 'B' AND `agent_prov_id_fk` = '17' THEN 1 END) as count_agent_B17_new
    FROM `tbl_agent`
    WHERE `agent_regist_date` BETWEEN ? AND ?";

    $AGENT_B_NEW = mysqli_prepare($conn, $sql_AGENT_B_NEW);
    mysqli_stmt_bind_param($AGENT_B_NEW, "ss", $start_date, $end_date);
    mysqli_stmt_execute($AGENT_B_NEW);
    $resultAGENT_B_NEW = mysqli_stmt_get_result($AGENT_B_NEW);
    $row_AGENT_B_NEW = mysqli_fetch_assoc($resultAGENT_B_NEW);

    // Call the countStatus function for loan data
    $loan_status_counts = countStatus($conn, $start_date, $end_date);

    // Extract the counts from the function result
    $new_status_count = $loan_status_counts['new_status'];
    $customer_return_count = $loan_status_counts['customer_return'];
    $owe_count = $loan_status_counts['owe'];

    $data = [];
    if (mysqli_num_rows($resultagent) > 0) {
        while ($row = mysqli_fetch_assoc($resultagent)) {
            // แปลงค่าทุกตัวที่จำเป็นเป็น float เพื่อใช้คำนวณ
            $count_agent_A14 = isset($row_agent['count_agent_A14']) ? (float)str_replace(',', '', $row_agent['count_agent_A14']) : 0;
            $count_agent_A15 = isset($row_agent['count_agent_A15']) ? (float)str_replace(',', '', $row_agent['count_agent_A15']) : 0;
            $count_agent_A16 = isset($row_agent['count_agent_A16']) ? (float)str_replace(',', '', $row_agent['count_agent_A16']) : 0;
            $count_agent_A17 = isset($row_agent['count_agent_A17']) ? (float)str_replace(',', '', $row_agent['count_agent_A17']) : 0;

            $count_agent_B14 = isset($row_agent['count_agent_B14']) ? (float)str_replace(',', '', $row_agent['count_agent_B14']) : 0;
            $count_agent_B15 = isset($row_agent['count_agent_B15']) ? (float)str_replace(',', '', $row_agent['count_agent_B15']) : 0;
            $count_agent_B16 = isset($row_agent['count_agent_B16']) ? (float)str_replace(',', '', $row_agent['count_agent_B16']) : 0;
            $count_agent_B17 = isset($row_agent['count_agent_B17']) ? (float)str_replace(',', '', $row_agent['count_agent_B17']) : 0;

            $count_toltal14 = isset($row_agent['count_toltal14']) ? (float)str_replace(',', '', $row_agent['count_toltal14']) : 0;
            $count_toltal15 = isset($row_agent['count_toltal15']) ? (float)str_replace(',', '', $row_agent['count_toltal15']) : 0;
            $count_toltal16 = isset($row_agent['count_toltal16']) ? (float)str_replace(',', '', $row_agent['count_toltal16']) : 0;
            $count_toltal17 = isset($row_agent['count_toltal17']) ? (float)str_replace(',', '', $row_agent['count_toltal17']) : 0;

            $count_agent_B14_new = isset($row_AGENT_B_NEW['count_agent_B14_new']) ? (float)str_replace(',', '', $row_AGENT_B_NEW['count_agent_B14_new']) : 0;
            $count_agent_B15_new = isset($row_AGENT_B_NEW['count_agent_B15_new']) ? (float)str_replace(',', '', $row_AGENT_B_NEW['count_agent_B15_new']) : 0;
            $count_agent_B16_new = isset($row_AGENT_B_NEW['count_agent_B16_new']) ? (float)str_replace(',', '', $row_AGENT_B_NEW['count_agent_B16_new']) : 0;
            $count_agent_B17_new = isset($row_AGENT_B_NEW['count_agent_B17_new']) ? (float)str_replace(',', '', $row_AGENT_B_NEW['count_agent_B17_new']) : 0;

            // เก็บค่าผลลัพธ์ โดยใช้ค่าต้นฉบับจากฐานข้อมูล
            $data[] = [
                'count_agent_A14' => $count_agent_A14,
                'count_agent_A15' => $count_agent_A15,
                'count_agent_A16' => $count_agent_A16,
                'count_agent_A17' => $count_agent_A17,
                'count_agent_B14' => $count_agent_B14,
                'count_agent_B15' => $count_agent_B15,
                'count_agent_B16' => $count_agent_B16,
                'count_agent_B17' => $count_agent_B17,
                'count_toltal14' => $count_toltal14,
                'count_toltal15' => $count_toltal15,
                'count_toltal16' => $count_toltal16,
                'count_toltal17' => $count_toltal17,
                'count_agent_B14_new' => $count_agent_B14_new,
                'count_agent_B15_new' => $count_agent_B15_new,
                'count_agent_B16_new' => $count_agent_B16_new,
                'count_agent_B17_new' => $count_agent_B17_new,
                'new_status_count' => $new_status_count,
                'customer_return_count' => $customer_return_count,
                'owe_count' => $owe_count
            ];
        }
    }

    // ส่งค่าผลลัพธ์กลับ
    echo json_encode($data);
}
?>
