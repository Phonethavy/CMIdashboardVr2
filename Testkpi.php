<?php
require_once 'connect.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

if (isset(($_GET['enddate']))) {
    $start_date = $_GET['startdate'];// รับค่าวันที่เริ่มต้น
    $end_date = $_GET['enddate'];// รับค่าวันที่สิ้นสุด



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


function customer_remain($conn, $start_date, $end_date){

    $sql_cus_remain = "SELECT * FROM( 
        SELECT loan_crd_no, loan_cus_code_fk, loan_receive_finish_date, loan_closed_date,cus_prov_id_fk,
            CASE WHEN (? >= loan_receive_finish_date AND ? < loan_closed_date) 
            OR (? >= loan_receive_finish_date
            AND (loan_closed_date IS NULL OR loan_closed_date = '0000-00-00'))
            THEN 'ນັບ' ELSE 'ບໍ່ນັບ' END AS count_status 
        FROM tbl_loan
    ) AS count_total
    WHERE loan_receive_finish_date BETWEEN ? AND ? 
    ORDER BY `loan_cus_code_fk`, `loan_closed_date`"; 
    
    

  // Prepare statement
  $stmt_cus_remain = mysqli_prepare($conn, $sql_cus_remain);
  mysqli_stmt_bind_param($stmt_cus_remain, "sssss", $end_date, $end_date, $end_date, $start_date, $end_date);
  mysqli_stmt_execute($stmt_cus_remain);
  
  $result = mysqli_stmt_get_result($stmt_cus_remain);

  // Initialize counters
  $count_cus_remain14 = 0;
  $count_cus_remain15 = 0;
  $count_cus_remain16 = 0;
  $count_cus_remain17 = 0;

  // Loop through results and count based on conditions
  while ($row1 = mysqli_fetch_assoc($result)) {
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

    $data = [];
    if (mysqli_num_rows($result)  > 0 ) {
        while ($row = mysqli_fetch_assoc($result)) {
            // แปลงค่าทุกตัวที่จำเป็นเป็น float เพื่อใช้คำนวณ
           

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
               

                'row_count_open_loan_new14' => $row_count_open_loan_new14,
                'row_count_open_loan_new15' => $row_count_open_loan_new15,
                'row_count_open_loan_new16' => $row_count_open_loan_new16,
                'row_count_open_loan_new17' => $row_count_open_loan_new17,

                'count_cus_remain14' => $count_cus_remain14,
                'count_cus_remain15' => $count_cus_remain15,
                'count_cus_remain16' => $count_cus_remain16,
                'count_cus_remain17' => $count_cus_remain17,

           
       

            ];
        }
    }


    // ส่งออก JSON
    echo json_encode($data);
} else {
    // ตอบกลับเมื่อไม่มีพารามิเตอร์
    echo json_encode(['error' => 'Invalid request. Please provide startdate and enddate.']);
}
