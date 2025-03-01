<?php
require_once 'connect.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

if (isset($_GET['enddate'])) {
    $start_date = $_GET['startdate']; // รับค่าวันที่เริ่มต้น
    $end_date = $_GET['enddate']; // รับค่าวันที่สิ้นสุด
    $sl_model = $_GET['sl_model']; // รับค่าเลือก Group By
    $location = $_GET['location'];

    // เงื่อนไขการจัดกลุ่ม
    $groupByField = ($sl_model === 'emp') ? 'com_act.comact_emp_code_fk' : 'com_act.comact_com_code_fk';
    $groupByFieldcreate = ($sl_model === 'emp') ? 'com_creator_emp_code_fk' : 'com_code';

    // SQL สำหรับ tbl_company_grade
    $sql_com_gade = " SELECT 
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type1_15A,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type1_15B,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type1_15C,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type1_15D,

    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type2_15A,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type2_15B,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type2_15C,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type2_15D,

    COUNT(CASE WHEN com_group.com_type = '3' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type3_15A,
    COUNT(CASE WHEN com_group.com_type = '3' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type3_15B,
    COUNT(CASE WHEN com_group.com_type = '3' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type3_15C,
    COUNT(CASE WHEN com_group.com_type = '3' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type3_15D,
    
    COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type1_total,
    COUNT(CASE WHEN com_group.com_type = '3' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) AS count_type3_total
   
FROM `tbl_company_group` AS com_group
LEFT JOIN `tbl_company_grade` AS grade 
    ON com_group.com_code = grade.com_grade_com_code_fk
LEFT JOIN `tbl_company_activity` AS com_act 
    ON com_group.com_code = com_act.comact_com_code_fk
        WHERE grade.com_grade_date BETWEEN '2015-01-01' AND ?";

    // เตรียม Statement
    $stmt = mysqli_prepare($conn, $sql_com_gade);
    mysqli_stmt_bind_param(
$stmt,
"sssssssssssssss",
  $location,
 $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $location,
        $end_date
    );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    //ดืงข้อมุลจาก create tbl_company_group toltal ส้างหน่วยงาน
    $sql_com_create_toltal = "SELECT
  COUNT(CASE WHEN com_type = '1' AND LEFT(com_code, 2) = ? THEN 1 END) as count_total_create_type1,
  COUNT(CASE WHEN com_type = '3' AND LEFT(com_code, 2) = ? THEN 1 END) as count_total_create_type3
  FROM `tbl_company_group`
  WHERE `com_create_date` BETWEEN ? AND ? AND LEFT(com_code, 2) = ?";

    $com_create_toltal = mysqli_prepare($conn, $sql_com_create_toltal);
    mysqli_stmt_bind_param($com_create_toltal, "sssss", $location, $location, $start_date, $end_date, $location);
    mysqli_stmt_execute($com_create_toltal);
    $resultcom_create_toltal = mysqli_stmt_get_result($com_create_toltal);



    //ดืงข้อมุลจาก create tbl_company_group toltal ส้างหน่วยงาน
    $sql_com_create = "SELECT
        emp.emp_fname,
        emp.emp_lname,
        com_group.com_code,
  LEFT(com_code, 2) as province_create,
  COUNT(CASE WHEN com_type = '1' AND LEFT(com_code, 2) = ? THEN 1 END) as count_create_type1,
  COUNT(CASE WHEN com_type = '3' AND LEFT(com_code, 2) = ? THEN 1 END) as count_create_type3
  FROM `tbl_company_group` as com_group
  LEFT JOIN tbl_employee as emp ON emp.emp_code = com_group.com_creator_emp_code_fk
  WHERE `com_create_date` BETWEEN ? AND ? AND LEFT(com_code, 2) = ?
   GROUP BY $groupByFieldcreate";

    $com_create = mysqli_prepare($conn, $sql_com_create);
    mysqli_stmt_bind_param($com_create, "sssss", $location, $location, $start_date, $end_date, $location);
    mysqli_stmt_execute($com_create);
    $resultcom_create = mysqli_stmt_get_result($com_create);




    //ดืงข้อมุลจาก tbl_com_activity toltal เยี่ยมยาม
    $sql_actity_toltal = "SELECT  
    
COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) as count_actity_type1,
COUNT(CASE WHEN com_group.com_type = '3' AND LEFT(com_act.comact_com_code_fk, 2) = ? THEN 1 END) as count_actity_type3
FROM `tbl_company_group` as com_group
LEFT JOIN `tbl_company_activity` AS com_act 
  ON com_group.com_code = com_act.comact_com_code_fk
  WHERE com_act.comact_date BETWEEN ? AND ? AND LEFT(com_act.comact_com_code_fk, 2)= ?";

    $actity_toltal = mysqli_prepare($conn, $sql_actity_toltal);
    mysqli_stmt_bind_param($actity_toltal, "sssss", $location, $location, $start_date, $end_date, $location);
    mysqli_stmt_execute($actity_toltal);
    $resultactivity_toltal = mysqli_stmt_get_result($actity_toltal);




    // SQL สำหรับ tbl_company_activity ผลงานของบุกคน
    $sql_actity = "SELECT 
       emp.emp_fname,
        emp.emp_lname,
         goal.ser_goal_amnt,
        goal.ser_goal_accno,
        com_act.comact_emp_code_fk, 
        LEFT(com_act.comact_com_code_fk, 2) AS province_actity,
         com_act.comact_com_code_fk,
         goal.ser_goal_emp_code_fk,
        SUM(com_group.com_type = '1') AS type_1_count,
        SUM(com_group.com_type = '3') AS type_3_count
    FROM `tbl_company_group` AS com_group
    LEFT JOIN `tbl_company_activity` AS com_act 
        ON com_group.com_code = com_act.comact_com_code_fk 
    LEFT JOIN tbl_employee as emp
        ON emp.emp_code = com_act.comact_emp_code_fk
    LEFT JOIN `tbl_service_goal` AS goal 
        ON goal.ser_goal_emp_code_fk = com_act.comact_emp_code_fk
        AND goal.ser_goal_indi_code_fk = 'SD02'
    WHERE com_act.comact_date BETWEEN ? AND ? and LEFT(com_act.comact_com_code_fk, 2)= ?
    GROUP BY $groupByField
    
    ";

    $stmt1 = mysqli_prepare($conn, $sql_actity);
    mysqli_stmt_bind_param($stmt1, "sss", $start_date, $end_date, $location);
    mysqli_stmt_execute($stmt1);
    $resultactivity = mysqli_stmt_get_result($stmt1);


    // เก็บผลลัพธ์จากทั้งสองตาราง
    $data = [];

    // ดึงผลลัพธ์
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $row_com_create_toltal = mysqli_fetch_assoc($resultcom_create_toltal) ?? ['count_total_create_type1' => 0, 'count_total_create_type3' => 0];
        $row_activity_toltal = mysqli_fetch_assoc($resultactivity_toltal) ?? ['count_actity_type1' => 0, 'count_actity_type3' => 0];

        $data['grade_data'] = [
            'count_type1_15A' => (int) $row['count_type1_15A'],
            'count_type1_15B' => (int) $row['count_type1_15B'],
            'count_type1_15C' => (int) $row['count_type1_15C'],
            'count_type1_15D' => (int) $row['count_type1_15D'],
            'count_type2_15A' => (int) $row['count_type2_15A'],
            'count_type2_15B' => (int) $row['count_type2_15B'],
            'count_type2_15C' => (int) $row['count_type2_15C'],
            'count_type2_15D' => (int) $row['count_type2_15D'],
            'count_type3_15A' => (int) $row['count_type3_15A'],
            'count_type3_15B' => (int) $row['count_type3_15B'],
            'count_type3_15C' => (int) $row['count_type3_15C'],
            'count_type3_15D' => (int) $row['count_type3_15D'],
            'count_type1_total' => (int) $row['count_type1_total'],
            'count_type3_total' => (int) $row['count_type3_total'],
        
            'count_actity_type1' => (int) $row_activity_toltal['count_actity_type1'], // ดึงค่าจากแหล่งที่ถูกต้อง
            'count_actity_type3' => (int) $row_activity_toltal['count_actity_type3'], // ดึงค่าจากแหล่งที่ถูกต้อง
            'count_total_create_type1' => (int) $row_com_create_toltal['count_total_create_type1'], // ดึงค่าจากแหล่งที่ถูกต้อง
            'count_total_create_type3' => (int) $row_com_create_toltal['count_total_create_type3'], // ดึงค่าจากแหล่งที่ถูกต้อง

        ];
    }

    $data['com_create_data'] = [];
    while ($row_com_create = mysqli_fetch_assoc($resultcom_create)) {
        if ($row_com_create['province_create'] === $location) { // ตรวจสอบ location
            $data['com_create_data'][] = [
                'emp_code' => trim($row_com_create['emp_fname'] . ' ' . $row_com_create['emp_lname']),
                'com_code' => $row_com_create['com_code'],
                'province_create' => $row_com_create['province_create'],
                'count_create_type1' => (int) $row_com_create['count_create_type1'],
                'count_create_type3' => (int) $row_com_create['count_create_type3']
            ];
        }
    }
    // ดึงผลลัพธ์จาก tbl_company_activity
    $data['activity_data'] = [];
    while ($row_activity = mysqli_fetch_assoc($resultactivity)) {
        if ($row_activity['province_actity'] === $location) { // ตรวจสอบ location
            $data['activity_data'][] = [
                'emp_code' => trim($row_activity['emp_fname'] . ' ' . $row_activity['emp_lname']),
                'com_code' => $row_activity['comact_com_code_fk'],
                'province_actity' => $row_activity['province_actity'],
                'type_1_count' => (int) $row_activity['type_1_count'],
                'type_3_count' => (int) $row_activity['type_3_count'],
                'ser_goal_accno' => $row_activity['ser_goal_accno'] ?? ''
            ];
        }
    }

    // ส่งออก JSON
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Invalid request. Please provide startdate, enddate, and sl_model.']);
}
