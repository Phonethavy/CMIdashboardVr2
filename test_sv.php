<?php
include("connect.php"); // ไฟล์เชื่อมต่อฐานข้อมูล

// รับค่า start_date, end_date, location และ groupByField จาก request
$start_date = $_GET['2024-01-01'] ?? '2024-01-01';
$end_date = $_GET['2024-12-31'] ?? '2024-12-31';
$groupByField = $_GET['emp_code'] ?? 'emp_code'; // เปลี่ยนค่า default
$location = $_GET['16'] ?? ''; // รับค่า location

// กำหนดคอลัมน์ที่อนุญาตให้ใช้ใน GROUP BY
$allowedGroupByFields = ['emp_code', 'province_activity', 'comact_com_code_fk'];
if (!in_array($groupByField, $allowedGroupByFields)) {
    $groupByField = 'emp_code'; // ตั้งค่าเริ่มต้นถ้าค่าที่ส่งมาไม่ถูกต้อง
}

// ดึงข้อมูล activity_data
$activity_sql = "SELECT 
        emp.emp_fname,
        emp.emp_lname,
        com_act.comact_emp_code_fk AS emp_code, 
        LEFT(com_act.comact_com_code_fk, 2) AS province_activity,
        com_act.comact_com_code_fk,
        SUM(com_group.com_type = '1') AS type_1_count,
        SUM(com_group.com_type = '3') AS type_3_count
    FROM `tbl_company_group` AS com_group
    LEFT JOIN `tbl_company_activity` AS com_act 
        ON com_group.com_code = com_act.comact_com_code_fk 
    LEFT JOIN tbl_employee AS emp 
        ON emp.emp_code = com_act.comact_emp_code_fk
    WHERE com_act.comact_date BETWEEN ? AND ? 
        AND LEFT(com_act.comact_com_code_fk, 2) = ?
    GROUP BY $groupByField"; // ใช้ค่าที่ validate แล้ว

$stmt1 = mysqli_prepare($conn, $activity_sql);
mysqli_stmt_bind_param($stmt1, "sss", $start_date, $end_date, $location);
mysqli_stmt_execute($stmt1);
$resultactivity = mysqli_stmt_get_result($stmt1);

$activity_data = [];
$emp_codes = [];

while ($row = mysqli_fetch_assoc($resultactivity)) {
    $activity_data[] = $row;
    $emp_codes[] = $row['emp_code']; // ดึง emp_code เพื่อใช้ดึง goal
}

// จัดรูปแบบข้อมูล JSON
$data = [
    'activity_data' => $activity_data
];

echo json_encode($data);
?>
