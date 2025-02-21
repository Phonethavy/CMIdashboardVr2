<?php
require_once 'connect.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

if (isset(($_GET['enddate']))) {
    $start_date = $_GET['startdate'];// รับค่าวันที่เริ่มต้น
    $end_date = $_GET['enddate'];// รับค่าวันที่สิ้นสุด



    // สร้างคำสั่ง SQL สำหรับ tbl_loan
    $sql_com_gade = "SELECT 
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type1_15A,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type1_16A,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type1_17A,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'A' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type1_14A,

    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type1_15B,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type1_16B,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type1_17B,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'B' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type1_14B,

    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type1_15C,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type1_16C,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type1_17C,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type1_14C,

    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type1_15D,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type1_16D,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type1_17D,
    COUNT(CASE WHEN com_group.com_type = '1' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type1_14D,
    
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'A'  AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type2_15A,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'A'  AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type2_16A,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'A'  AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type2_17A,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'A'  AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type2_14A,

    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'B'  AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type2_15B,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'B'  AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type2_16B,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'B'  AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type2_17B,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'B'  AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type2_14B,

    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type2_15C,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type2_16C,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type2_17C,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'C' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type2_14C,
    
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type2_15D,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type2_16D,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type2_17D,
    COUNT(CASE WHEN com_group.com_type = '2' AND grade.com_grade_lv = 'D' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type2_14D,
    COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type1_total15,
    COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type1_total16,
    COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type1_total17,
    COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type1_total14,
    COUNT(CASE WHEN com_group.com_type = '2'AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) AS count_type2_total15,
    COUNT(CASE WHEN com_group.com_type = '2'AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) AS count_type2_total16,
    COUNT(CASE WHEN com_group.com_type = '2'AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) AS count_type2_total17,
    COUNT(CASE WHEN com_group.com_type = '2'AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) AS count_type2_total14

FROM `tbl_company_group` AS com_group
LEFT JOIN `tbl_company_grade` AS grade 
    ON com_group.com_code = grade.com_grade_com_code_fk
LEFT JOIN `tbl_company_activity` AS com_act 
    ON com_group.com_code = com_act.comact_com_code_fk
WHERE grade.com_grade_date BETWEEN '2015-01-01' AND ? ";

    // เตรียม Statement
    $stmt = mysqli_prepare($conn, $sql_com_gade);
    mysqli_stmt_bind_param($stmt, "s", $end_date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //ดืงข้อมุลจาก tbl_com_activity
    $sql_actity = "SELECT  COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) as count_actity_type1_14,
  COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) as count_actity_type1_15,
  COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) as count_actity_type1_16,
  COUNT(CASE WHEN com_group.com_type = '1' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) as count_actity_type1_17,
  
  COUNT(CASE WHEN com_group.com_type = '2' AND LEFT(com_act.comact_com_code_fk, 2) = '14' THEN 1 END) as count_actity_type2_14,
  COUNT(CASE WHEN com_group.com_type = '2' AND LEFT(com_act.comact_com_code_fk, 2) = '15' THEN 1 END) as count_actity_type2_15,
  COUNT(CASE WHEN com_group.com_type = '2' AND LEFT(com_act.comact_com_code_fk, 2) = '16' THEN 1 END) as count_actity_type2_16,
  COUNT(CASE WHEN com_group.com_type = '2' AND LEFT(com_act.comact_com_code_fk, 2) = '17' THEN 1 END) as count_actity_type2_17
  
  
FROM `tbl_company_group` as com_group
LEFT JOIN `tbl_company_activity` AS com_act 
    ON com_group.com_code = com_act.comact_com_code_fk
    WHERE com_act.comact_date BETWEEN ? AND ?";

    $stmt1 = mysqli_prepare($conn, $sql_actity);
    mysqli_stmt_bind_param($stmt1, "ss", $start_date, $end_date);
    mysqli_stmt_execute($stmt1);

    $resultactivity = mysqli_stmt_get_result($stmt1);
    $row_activity = mysqli_fetch_assoc($resultactivity);





    //ดืงข้อมุลจาก create tbl_company_group
    $sql_com_create = "SELECT
COUNT(CASE WHEN com_type = '1' AND LEFT(com_code, 2) = '14' THEN 1 END) as count_com_create_type1_14,
COUNT(CASE WHEN com_type = '1' AND LEFT(com_code, 2) = '15' THEN 1 END) as count_com_create_type1_15,
COUNT(CASE WHEN com_type = '1' AND LEFT(com_code, 2) = '16' THEN 1 END) as count_com_create_type1_16,
COUNT(CASE WHEN com_type = '1' AND LEFT(com_code, 2) = '17' THEN 1 END) as count_com_create_type1_17,

COUNT(CASE WHEN com_type = '2' AND LEFT(com_code, 2) = '14' THEN 1 END) as count_com_create_type2_14,
COUNT(CASE WHEN com_type = '2' AND LEFT(com_code, 2) = '15' THEN 1 END) as count_com_create_type2_15,
COUNT(CASE WHEN com_type = '2' AND LEFT(com_code, 2) = '16' THEN 1 END) as count_com_create_type2_16,
COUNT(CASE WHEN com_type = '2' AND LEFT(com_code, 2) = '17' THEN 1 END) as count_com_create_type2_17
FROM `tbl_company_group`
WHERE `com_create_date` BETWEEN ? AND ?";

    $com_create = mysqli_prepare($conn, $sql_com_create);
    mysqli_stmt_bind_param($com_create, "ss", $start_date, $end_date);
    mysqli_stmt_execute($com_create);
    $resultcom_create = mysqli_stmt_get_result($com_create);
    $row_com_create = mysqli_fetch_assoc($resultcom_create);


    //ดืงข้อมุลจาก tbl_agent
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

    function countStatus($conn, $start_date, $end_date)
    {
        $sql_loan = "
      SELECT *
FROM (
    SELECT loan_crd_no, 
           loan_cus_code_fk, 
           loan_receive_finish_date, 
           loan_info_offer, 
           loan_closed_date,
           cus_prov_id_fk,
           
           CASE 
               WHEN (@row_num := IF(@prev_cus = loan_cus_code_fk, @row_num + 1, 1)) = 1 
               THEN 'new' 
               ELSE 'เก่า' 
           END AS status,

           CASE 
               WHEN @prev_cus = loan_cus_code_fk THEN
                   CASE 
                       -- เปรียบเทียบ loan_closed_date ของแถวแรก กับ loan_receive_finish_date ของแถวถัดไป
                       WHEN DATEDIFF(loan_receive_finish_date, @prev_closed_date) > 0 THEN 'กับคืน'
                       ELSE 'อ่วย'
                   END
               ELSE NULL
           END AS additional_status,
           
           -- เก็บค่า loan_closed_date ของแถวแรก
           (@prev_closed_date := loan_closed_date) AS dummy_closed,
           
           -- เก็บค่า loan_cus_code_fk ของแถวปัจจุบัน
           (@prev_cus := loan_cus_code_fk) AS dummy
    FROM tbl_loan
    ORDER BY loan_cus_code_fk, loan_receive_finish_date
) AS temp_table
WHERE loan_receive_finish_date BETWEEN ? and ?";

        // Prepare statement
        $stmt = mysqli_prepare($conn, $sql_loan);
        mysqli_stmt_bind_param($stmt, "ss", $start_date, $end_date);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Initialize counters
        $count_new_status14 = 0;
        $count_new_status15 = 0;
        $count_new_status16 = 0;
        $count_new_status17 = 0;

        $count_customer_return14 = 0;
        $count_customer_return15 = 0;
        $count_customer_return16 = 0;
        $count_customer_return17 = 0;

        $count_owe14 = 0;
        $count_owe15 = 0;
        $count_owe16 = 0;
        $count_owe17 = 0;

        // Loop through results and count based on conditions
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['status'] == 'new' && $row['cus_prov_id_fk'] == '14') {
                $count_new_status14++;
            }
            if ($row['status'] == 'new' && $row['cus_prov_id_fk'] == '15') {
                $count_new_status15++;
            }
            if ($row['status'] == 'new' && $row['cus_prov_id_fk'] == '16') {
                $count_new_status16++;
            }
            if ($row['status'] == 'new' && $row['cus_prov_id_fk'] == '17') {
                $count_new_status17++;
            }
            if ($row['additional_status'] == 'กับคืน' && $row['cus_prov_id_fk'] == '14') {
                $count_customer_return14++;
            }
            if ($row['additional_status'] == 'กับคืน' && $row['cus_prov_id_fk'] == '15') {
                $count_customer_return15++;
            }
            if ($row['additional_status'] == 'กับคืน' && $row['cus_prov_id_fk'] == '16') {
                $count_customer_return16++;
            }
            if ($row['additional_status'] == 'กับคืน' && $row['cus_prov_id_fk'] == '17') {
                $count_customer_return17++;
            }
            if ($row['additional_status'] == 'อ่วย' && $row['cus_prov_id_fk'] == '14') {
                $count_owe14++;
            }
            if ($row['additional_status'] == 'อ่วย' && $row['cus_prov_id_fk'] == '15') {
                $count_owe15++;
            }
            if ($row['additional_status'] == 'อ่วย' && $row['cus_prov_id_fk'] == '16') {
                $count_owe16++;
            }
            if ($row['additional_status'] == 'อ่วย' && $row['cus_prov_id_fk'] == '17') {
                $count_owe17++;
            }
   
        }

        // Return the counts
        return [
            'new_status14' => $count_new_status14,
            'new_status15' => $count_new_status15,
            'new_status16' => $count_new_status16,
            'new_status17' => $count_new_status17,
            'customer_return14' => $count_customer_return14,
            'customer_return15' => $count_customer_return15,
            'customer_return16' => $count_customer_return16,
            'customer_return17' => $count_customer_return17,
            'owe14' => $count_owe14,
            'owe15' => $count_owe15,
            'owe16' => $count_owe16,
            'owe17' => $count_owe17,
   
       
        ];
    }

    
   // Call the countStatus function and assign the result to $loan_status_counts
$loan_status_counts = countStatus($conn, $start_date, $end_date);

// Now, you can safely access the values
$new_status_count14 = $loan_status_counts['new_status14'];
$new_status_count15 = $loan_status_counts['new_status15'];
$new_status_count16 = $loan_status_counts['new_status16'];
$new_status_count17 = $loan_status_counts['new_status17'];

$customer_return_count14 = $loan_status_counts['customer_return14'];
$customer_return_count15 = $loan_status_counts['customer_return15'];
$customer_return_count16 = $loan_status_counts['customer_return16'];
$customer_return_count17 = $loan_status_counts['customer_return17'];

$owe_count14 = $loan_status_counts['owe14'];
$owe_count15 = $loan_status_counts['owe15'];
$owe_count16 = $loan_status_counts['owe16'];
$owe_count17 = $loan_status_counts['owe17'];



$sql_count_open_new = "SELECT     
    COUNT(DISTINCT CASE WHEN cus_prov_id_fk = 14 THEN loan_cus_code_fk END) AS prov_14,    
    COUNT(DISTINCT CASE WHEN cus_prov_id_fk = 15 THEN loan_cus_code_fk END) AS prov_15,    
    COUNT(DISTINCT CASE WHEN cus_prov_id_fk = 16 THEN loan_cus_code_fk END) AS prov_16,    
    COUNT(DISTINCT CASE WHEN cus_prov_id_fk = 17 THEN loan_cus_code_fk END) AS prov_17
FROM tbl_loan    
WHERE loan_receive_finish_date BETWEEN ? AND ?;

";

$count_open_new = mysqli_prepare($conn, $sql_count_open_new);
mysqli_stmt_bind_param($count_open_new, "ss", $start_date, $end_date);
mysqli_stmt_execute($count_open_new);
$resultcount_open_new = mysqli_stmt_get_result($count_open_new);
$row_count_open_new = mysqli_fetch_assoc($resultcount_open_new);


function customer_remain($conn, $end_date){

    $sql_cus_remain = "SELECT * FROM( 
        SELECT loan_crd_no, loan_cus_code_fk, loan_receive_finish_date, loan_closed_date,cus_prov_id_fk,
            CASE WHEN (? >= loan_receive_finish_date AND ? < loan_closed_date) 
            OR (? >= loan_receive_finish_date
            AND (loan_closed_date IS NULL OR loan_closed_date = '0000-00-00'))
            THEN 'ນັບ' ELSE 'ບໍ່ນັບ' END AS count_status 
        FROM tbl_loan
    ) AS count_total
    WHERE loan_receive_finish_date BETWEEN '2015-01-01' AND ? 
    ORDER BY `loan_cus_code_fk`, `loan_closed_date`";
    
    

  // Prepare statement
  $stmt_cus_remain = mysqli_prepare($conn, $sql_cus_remain);
  mysqli_stmt_bind_param($stmt_cus_remain, "ssss", $end_date, $end_date, $end_date, $end_date);
  mysqli_stmt_execute($stmt_cus_remain);
  
  $result_cus_remain = mysqli_stmt_get_result($stmt_cus_remain);

  // Initialize counters
  $count_cus_remain14 = 0;
  $count_cus_remain15 = 0;
  $count_cus_remain16 = 0;
  $count_cus_remain17 = 0;

  // Loop through results and count based on conditions
  while ($row1 = mysqli_fetch_assoc($result_cus_remain)) {
      if ($row1['count_status'] == 'ນັບ' && $row1['cus_prov_id_fk'] == '14') {
          $count_cus_remain14++;
      }
      if ($row1['count_status'] == 'ນັບ' && $row1['cus_prov_id_fk'] == '15') {
          $count_cus_remain15++;
      }
      if ($row1['count_status'] == 'ນັບ' && $row1['cus_prov_id_fk'] == '16') {
          $count_cus_remain16++;
      }
      if ($row1['count_status'] == 'ນັບ' && $row1['cus_prov_id_fk'] == '17') {
          $count_cus_remain17++;
      }


  }

  // Return the counts
  return [
      'new_status14' => $count_cus_remain14,
      'new_status15' => $count_cus_remain15,
      'new_status16' => $count_cus_remain16,
      'new_status17' => $count_cus_remain17,
 
 
  ];
}
$loan_cus_remain = customer_remain($conn, $start_date, $end_date);
$count_cus_remain14 = $loan_cus_remain['new_status14'];
$count_cus_remain15 = $loan_cus_remain['new_status15'];
$count_cus_remain16 = $loan_cus_remain['new_status16'];
$count_cus_remain17 = $loan_cus_remain['new_status17'];

function customer_close($conn, $start_date, $end_date) {
    // กำหนดค่าตัวแปร session สำหรับ MySQL
    mysqli_query($conn, "SET @prev_cus = NULL, @prev_closed_date = NULL");

    // คำสั่ง SQL แก้ไขให้ถูกต้อง
    $sql_cus_remain = "SELECT 
        loan_cus_code_fk,
        loan_receive_finish_date,
        loan_closed_date,
        cus_prov_id_fk,
        @prev_count_close AS count_close,
        @prev_count_close := 
            CASE 
                WHEN @prev_cus = loan_cus_code_fk 
                     AND DATE_FORMAT(@prev_closed_date, '%Y-%m-%d') = DATE_FORMAT(loan_receive_finish_date, '%Y-%m-%d')
                THEN 'owe' 
                WHEN @prev_cus = loan_cus_code_fk 
                THEN 'close' 
                ELSE '' 
            END,
        @prev_cus := loan_cus_code_fk,
        @prev_closed_date := loan_closed_date
    FROM tbl_loan
    WHERE loan_receive_finish_date BETWEEN ? AND ?
    ORDER BY loan_cus_code_fk, loan_receive_finish_date";

    // Prepare statement
    $stmt_cus_remain = mysqli_prepare($conn, $sql_cus_remain);
    mysqli_stmt_bind_param($stmt_cus_remain, "ss", $start_date, $end_date);
    mysqli_stmt_execute($stmt_cus_remain);
    
    $result_count_close = mysqli_stmt_get_result($stmt_cus_remain);

    // Initialize counters
    $count_close = [
        '14' => 0,
        '15' => 0,
        '16' => 0,
        '17' => 0
    ];

    // Loop through results and count based on conditions
    while ($row1 = mysqli_fetch_assoc($result_count_close)) {
        if ($row1['count_close'] == 'close' && isset($count_close[$row1['cus_prov_id_fk']])) {
            $count_close[$row1['cus_prov_id_fk']]++;
        }
    }

    // Return the counts
    return [
        'new_count_close14' => $count_close['14'],
        'new_count_close15' => $count_close['15'],
        'new_count_close16' => $count_close['16'],
        'new_count_close17' => $count_close['17'],
    ];
}

$loan_count_close = customer_close($conn, $start_date, $end_date);
$count_count_close14 = $loan_count_close['new_count_close14'];
$count_count_close15 = $loan_count_close['new_count_close15'];
$count_count_close16 = $loan_count_close['new_count_close16'];
$count_count_close17 = $loan_count_close['new_count_close17'];

    $data = [];
    if (mysqli_num_rows($result)  > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // แปลงค่าทุกตัวที่จำเป็นเป็น float เพื่อใช้คำนวณ
            $Treasury_expenditure16 = isset($row['Treasury_expenditure16']) ? (float)str_replace(',', '', $row['Treasury_expenditure16']) : 0;
            $count_type1_15A = isset($row['count_type1_15A']) ? (float)str_replace(',', '', $row['count_type1_15A']) : 0;
            $count_type1_16A = isset($row['count_type1_16A']) ? (float)str_replace(',', '', $row['count_type1_16A']) : 0;
            $count_type1_17A = isset($row['count_type1_17A']) ? (float)str_replace(',', '', $row['count_type1_17A']) : 0;
            $count_type1_14A = isset($row['count_type1_14A']) ? (float)str_replace(',', '', $row['count_type1_14A']) : 0;

            $count_type1_15B = isset($row['count_type1_15B']) ? (float)str_replace(',', '', $row['count_type1_15B']) : 0;
            $count_type1_16B = isset($row['count_type1_16B']) ? (float)str_replace(',', '', $row['count_type1_16B']) : 0;
            $count_type1_17B = isset($row['count_type1_17B']) ? (float)str_replace(',', '', $row['count_type1_17B']) : 0;
            $count_type1_14B = isset($row['count_type1_14B']) ? (float)str_replace(',', '', $row['count_type1_14B']) : 0;

            $count_type1_15C = isset($row['count_type1_15C']) ? (float)str_replace(',', '', $row['count_type1_15C']) : 0;
            $count_type1_16C = isset($row['count_type1_16C']) ? (float)str_replace(',', '', $row['count_type1_16C']) : 0;
            $count_type1_17C = isset($row['count_type1_17C']) ? (float)str_replace(',', '', $row['count_type1_17C']) : 0;
            $count_type1_14C = isset($row['count_type1_14C']) ? (float)str_replace(',', '', $row['count_type1_14C']) : 0;

            $count_type1_15D = isset($row['count_type1_15D']) ? (float)str_replace(',', '', $row['count_type1_15D']) : 0;
            $count_type1_16D = isset($row['count_type1_16D']) ? (float)str_replace(',', '', $row['count_type1_16D']) : 0;
            $count_type1_17D = isset($row['count_type1_17D']) ? (float)str_replace(',', '', $row['count_type1_17D']) : 0;
            $count_type1_14D = isset($row['count_type1_14D']) ? (float)str_replace(',', '', $row['count_type1_14D']) : 0;

            $count_type2_15A = isset($row['count_type2_15A']) ? (float)str_replace(',', '', $row['count_type2_15A']) : 0;
            $count_type2_16A = isset($row['count_type2_16A']) ? (float)str_replace(',', '', $row['count_type2_16A']) : 0;
            $count_type2_17A = isset($row['count_type2_17A']) ? (float)str_replace(',', '', $row['count_type2_17A']) : 0;
            $count_type2_14A = isset($row['count_type2_14A']) ? (float)str_replace(',', '', $row['count_type2_14A']) : 0;

            $count_type2_15B = isset($row['count_type2_15B']) ? (float)str_replace(',', '', $row['count_type2_15B']) : 0;
            $count_type2_16B = isset($row['count_type2_16B']) ? (float)str_replace(',', '', $row['count_type2_16B']) : 0;
            $count_type2_17B = isset($row['count_type2_17B']) ? (float)str_replace(',', '', $row['count_type2_17B']) : 0;
            $count_type2_14B = isset($row['count_type2_14B']) ? (float)str_replace(',', '', $row['count_type2_14B']) : 0;

            $count_type2_15C = isset($row['count_type2_15C']) ? (float)str_replace(',', '', $row['count_type2_15C']) : 0;
            $count_type2_16C = isset($row['count_type2_16C']) ? (float)str_replace(',', '', $row['count_type2_16C']) : 0;
            $count_type2_17C = isset($row['count_type2_17C']) ? (float)str_replace(',', '', $row['count_type2_17C']) : 0;
            $count_type2_14C = isset($row['count_type2_14C']) ? (float)str_replace(',', '', $row['count_type2_14C']) : 0;

            $count_type2_15D = isset($row['count_type2_15D']) ? (float)str_replace(',', '', $row['count_type2_15D']) : 0;
            $count_type2_16D = isset($row['count_type2_16D']) ? (float)str_replace(',', '', $row['count_type2_16D']) : 0;
            $count_type2_17D = isset($row['count_type2_17D']) ? (float)str_replace(',', '', $row['count_type2_17D']) : 0;
            $count_type2_14D = isset($row['count_type2_14D']) ? (float)str_replace(',', '', $row['count_type2_14D']) : 0;

            $count_type1_total15 = isset($row['count_type1_total15']) ? (float)str_replace(',', '', $row['count_type1_total15']) : 0;
            $count_type1_total16 = isset($row['count_type1_total16']) ? (float)str_replace(',', '', $row['count_type1_total16']) : 0;
            $count_type1_total17 = isset($row['count_type1_total17']) ? (float)str_replace(',', '', $row['count_type1_total17']) : 0;
            $count_type1_total14 = isset($row['count_type1_total14']) ? (float)str_replace(',', '', $row['count_type1_total14']) : 0;

            $count_type2_total15 = isset($row['count_type2_total15']) ? (float)str_replace(',', '', $row['count_type2_total15']) : 0;
            $count_type2_total16 = isset($row['count_type2_total16']) ? (float)str_replace(',', '', $row['count_type2_total16']) : 0;
            $count_type2_total17 = isset($row['count_type2_total17']) ? (float)str_replace(',', '', $row['count_type2_total17']) : 0;
            $count_type2_total14 = isset($row['count_type2_total14']) ? (float)str_replace(',', '', $row['count_type2_total14']) : 0;

            $count_actity_type1_14 = isset($row_activity['count_actity_type1_14']) ? (float)str_replace(',', '', $row_activity['count_actity_type1_14']) : 0;
            $count_actity_type1_15 = isset($row_activity['count_actity_type1_15']) ? (float)str_replace(',', '', $row_activity['count_actity_type1_15']) : 0;
            $count_actity_type1_16 = isset($row_activity['count_actity_type1_16']) ? (float)str_replace(',', '', $row_activity['count_actity_type1_16']) : 0;
            $count_actity_type1_17 = isset($row_activity['count_actity_type1_17']) ? (float)str_replace(',', '', $row_activity['count_actity_type1_17']) : 0;

            $count_actity_type2_14 = isset($row_activity['count_actity_type2_14']) ? (float)str_replace(',', '', $row_activity['count_actity_type2_14']) : 0;
            $count_actity_type2_15 = isset($row_activity['count_actity_type2_15']) ? (float)str_replace(',', '', $row_activity['count_actity_type2_15']) : 0;
            $count_actity_type2_16 = isset($row_activity['count_actity_type2_16']) ? (float)str_replace(',', '', $row_activity['count_actity_type2_16']) : 0;
            $count_actity_type2_17 = isset($row_activity['count_actity_type2_17']) ? (float)str_replace(',', '', $row_activity['count_actity_type2_17']) : 0;

            $count_com_create_type1_14 = isset($row_com_create['count_com_create_type1_14']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type1_14']) : 0;
            $count_com_create_type1_15 = isset($row_com_create['count_com_create_type1_15']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type1_15']) : 0;
            $count_com_create_type1_16 = isset($row_com_create['count_com_create_type1_16']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type1_16']) : 0;
            $count_com_create_type1_17 = isset($row_com_create['count_com_create_type1_17']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type1_17']) : 0;

            $count_com_create_type2_14 = isset($row_com_create['count_com_create_type2_14']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type2_14']) : 0;
            $count_com_create_type2_15 = isset($row_com_create['count_com_create_type2_15']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type2_15']) : 0;
            $count_com_create_type2_16 = isset($row_com_create['count_com_create_type2_16']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type2_16']) : 0;
            $count_com_create_type2_17 = isset($row_com_create['count_com_create_type2_17']) ? (float)str_replace(',', '', $row_com_create['count_com_create_type2_17']) : 0;

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

            $row_count_open_loan_new14 = isset($row_count_open_new['prov_14']) ? (float)str_replace(',', '', $row_count_open_new['prov_14']) : 0;
            $row_count_open_loan_new15 = isset($row_count_open_new['prov_15']) ? (float)str_replace(',', '', $row_count_open_new['prov_15']) : 0;
            $row_count_open_loan_new16 = isset($row_count_open_new['prov_16']) ? (float)str_replace(',', '', $row_count_open_new['prov_16']) : 0;
            $row_count_open_loan_new17 = isset($row_count_open_new['prov_17']) ? (float)str_replace(',', '', $row_count_open_new['prov_17']) : 0;



            // เก็บค่าผลลัพธ์ โดยใช้ค่าต้นฉบับจากฐานข้อมูล
            $data[] = [
                'count_type1_15A' => $count_type1_15A,
                'count_type1_16A' => $count_type1_16A,
                'count_type1_17A' => $count_type1_17A,
                'count_type1_14A' => $count_type1_14A,

                'count_type1_15B' => $count_type1_15B,
                'count_type1_16B' => $count_type1_16B,
                'count_type1_17B' => $count_type1_17B,
                'count_type1_14B' => $count_type1_14B,

                'count_type1_15C' => $count_type1_15C,
                'count_type1_16C' => $count_type1_16C,
                'count_type1_17C' => $count_type1_17C,
                'count_type1_14C' => $count_type1_14C,

                'count_type1_15D' => $count_type1_15D,
                'count_type1_16D' => $count_type1_16D,
                'count_type1_17D' => $count_type1_17D,
                'count_type1_14D' => $count_type1_14D,

                'count_type2_15A' => $count_type2_15A,
                'count_type2_16A' => $count_type2_16A,
                'count_type2_17A' => $count_type2_17A,
                'count_type2_14A' => $count_type2_14A,

                'count_type2_15B' => $count_type2_15B,
                'count_type2_16B' => $count_type2_16B,
                'count_type2_17B' => $count_type2_17B,
                'count_type2_14B' => $count_type2_14B,

                'count_type2_15C' => $count_type2_15C,
                'count_type2_16C' => $count_type2_16C,
                'count_type2_17C' => $count_type2_17C,
                'count_type2_14C' => $count_type2_14C,

                'count_type2_15D' => $count_type2_15D,
                'count_type2_16D' => $count_type2_16D,
                'count_type2_17D' => $count_type2_17D,
                'count_type2_14D' => $count_type2_14D,

                'count_type1_total15' => $count_type1_total15,
                'count_type1_total16' => $count_type1_total16,
                'count_type1_total17' => $count_type1_total17,
                'count_type1_total14' => $count_type1_total14,

                'count_type2_total15' => $count_type2_total15,
                'count_type2_total16' => $count_type2_total16,
                'count_type2_total17' => $count_type2_total17,
                'count_type2_total14' => $count_type2_total14,

                'count_actity_type1_14' => $count_actity_type1_14,
                'count_actity_type1_15' => $count_actity_type1_15,
                'count_actity_type1_16' => $count_actity_type1_16,
                'count_actity_type1_17' => $count_actity_type1_17,

                'count_actity_type2_14' => $count_actity_type2_14,
                'count_actity_type2_15' => $count_actity_type2_15,
                'count_actity_type2_16' => $count_actity_type2_16,
                'count_actity_type2_17' => $count_actity_type2_17,


                'count_com_create_type1_14' => $count_com_create_type1_14,
                'count_com_create_type1_15' => $count_com_create_type1_15,
                'count_com_create_type1_16' => $count_com_create_type1_16,
                'count_com_create_type1_17' => $count_com_create_type1_17,

                'count_com_create_type2_14' => $count_com_create_type2_14,
                'count_com_create_type2_15' => $count_com_create_type2_15,
                'count_com_create_type2_16' => $count_com_create_type2_16,
                'count_com_create_type2_17' => $count_com_create_type2_17,

                //AGENT
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

                'new_status_count14' => $new_status_count14,
                'new_status_count15' => $new_status_count15,
                'new_status_count16' => $new_status_count16,
                'new_status_count17' => $new_status_count17,

                'customer_return_count14' => $customer_return_count14,
                'customer_return_count15' => $customer_return_count15,
                'customer_return_count16' => $customer_return_count16,
                'customer_return_count17' => $customer_return_count17,

                'owe_count14' => $owe_count14,
                'owe_count15' => $owe_count15,
                'owe_count16' => $owe_count16,
                'owe_count17' => $owe_count17,

                'row_count_open_loan_new14' => $row_count_open_loan_new14,
                'row_count_open_loan_new15' => $row_count_open_loan_new15,
                'row_count_open_loan_new16' => $row_count_open_loan_new16,
                'row_count_open_loan_new17' => $row_count_open_loan_new17,

                'count_cus_remain14' => $count_cus_remain14,
                'count_cus_remain15' => $count_cus_remain15,
                'count_cus_remain16' => $count_cus_remain16,
                'count_cus_remain17' => $count_cus_remain17,

                'count_count_close14' => $count_count_close14,
                'count_count_close15' => $count_count_close15,
                'count_count_close16' => $count_count_close16,
                'count_count_close17' => $count_count_close17,

           
       

            ];
        }
    }


    // ส่งออก JSON
    echo json_encode($data);
} else {
    // ตอบกลับเมื่อไม่มีพารามิเตอร์
    echo json_encode(['error' => 'Invalid request. Please provide startdate and enddate.']);
}
