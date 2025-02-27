<?php
require_once 'connect.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

function fetchGoal($year, $conn)
{
        $goal_query = "SELECT `kpi_goal_code_kpi`,`kpi_goal_goal` FROM tbl_kpi_goal
                       WHERE `kpi_goal_code_kpi` = 'KPI4'
                       AND YEAR(kpi_goal_date) = ?";

        $goal_stmt = $conn->prepare($goal_query);
        $goal_stmt->bind_param("i", $year);
        $goal_stmt->execute();
        $goal_result = $goal_stmt->get_result();
        $goal_row = $goal_result->fetch_assoc();

        return $goal_row['kpi_goal_goal'] ?? 0; // คืนค่า Goal หรือ 0 หากไม่มีข้อมูล
}
$goal_total = fetchGoal($year, $conn); // ดึงค่าผลรวมของ goal
// สร้างคำสั่ง SQL
$query = "SELECT 
    YEAR(tbl_atc.act_date) AS Year,
    MONTH(tbl_atc.act_date) AS Month,
    FORMAT(SUM(CASE 
        WHEN act_account_no IN (
            '510213200200000', '510213200200001', '510213200200002', '510223200200000',
            '510223200200002', '510223200200015', '510290000200000', '510290000200001', 
            '510290000200002', '510288000000002', '510288000200000', '510288000200001',
            '510288000200002', '510288000200015', '510288000220027', '510288000220036', 
            '510288000220028'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_loans16,
    
    FORMAT(SUM(CASE 
        WHEN act_account_no IN (
            '510213200300001', '510213200300002', '510223200300000', '510223200300002',
            '510223200300015', '510290000300000', '510290000300001', '510290000300002',
            '510290000300015', '510288000300000', '510288000300001', '510288000300002',
            '510288000300015', '510288000320027', '510288000320028'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_loans14,

    FORMAT(SUM(CASE 
        WHEN act_account_no IN (
            '510213200400000', '510213200400001', '510213200400002', '510223200400000',
            '510223200400002', '510223200400015', '510290000400000', '510290000400001', 
            '510290000400002', '510290000400015', '510288000400000', '510288000400001',
            '510288000400002', '510288000400015', '510288000420027', '510288000420030',
            '510288000420031', '510288000420033'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_loans17,

    FORMAT(SUM(CASE 
        WHEN act_account_no IN (
            '510213200500000', '510213200500001', '510213200500002', '510223200500000',
            '510223200500002', '510223200500015', '510290000500000', '510290000500001', 
            '510290000500002', '510290000500015', '510288000500000', '510288000500001',
            '510288000500002', '510288000500015', '510288000520028', '510288000520027'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_loans15,
    FORMAT(SUM(CASE 
        WHEN act_account_no IN (
            '510213200200007','510223200200007','510290000200007','510213200200003',
            '510288000200003','510288000220003','510290000200003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_public16,
    FORMAT(SUM(CASE 
        WHEN act_account_no IN (
            '510213200300007','510223200300007','510290000300007','510213200300003',
            '510290000300003','510288000300003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_public14,
  FORMAT(SUM(CASE 
        WHEN act_account_no IN (
           '510213200400007','510223200400007','510290000400007','510213200400003',
           '510290000400003','510288000400003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_public17,
  FORMAT(SUM(CASE 
        WHEN act_account_no IN (
         '510213200500007','510223200500007','510290000500007','510213200500003',
         '510223200500003','510290000500003','510288000500003','510288000520003',
         '510288000500007'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_public15,
  FORMAT(SUM(CASE 
        WHEN act_account_no IN (
         '510213200200014','510223200200014','510290000200014','510290000200004'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_SME16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
         '510213200300014','510223200300014','510290000300014'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_SME14,

FORMAT(SUM(CASE 
        WHEN act_account_no IN (
        '510213200400014','510223200400014','510290000400014'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_SME17,
 FORMAT(SUM(CASE 
        WHEN act_account_no IN (
        '510213200500014','510223200500014','510290000500014'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_SME15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '510131100100000','510131200100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_deposit_interest0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
      '510287000220000','510287000221000','510287000222000','510287000200001','510287000200002','510287000200003','510287000212000','510287000223000','510287000211000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Fee_income16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
      '510287000321000','510287000322000','510287000300002','510287000300003','510287000311000','510287000323000','510287000312000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Fee_income14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
        '510287000421000','510287000422000','510287000400001','510287000400002','510287000400003','510287000411000','510287000412000','510287000423000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Fee_income17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '510287000521000','510287000522000','510287000500001','510287000500002','510287000500003','510287000511000','510287000511015','510287000512000','510287000523000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Fee_income15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '570500000200000','570500000200001','570500000200002','570500000200003','570500000200007','570500000200014','570500000200004'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_external_debt16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '570500000300000','570500000300001','570500000300002','570500000300003','570500000300007'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_external_debt14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '570500000400000','570500000400001','570500000400002','570500000400003','570500000400007'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_external_debt17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '570500000400000','570500000400001','570500000400002','570500000400003','570500000400007'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_external_debt15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '550840000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_other0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '550840000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_other16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '5550840000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_other14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '550840000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_other17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '550840000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Income_other15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
       '570120000200001','570120000200002','570120000200003','570120000200007','570120000200011','570120000200012','570120000200013','570120000200014','570120000200015'
,'570411000200000','570411000200001','570411000200002','570411000200007','570411000200015','570412000200000','570412000200001','570412000200002','570412000200003','570412000200007','570412000200015'
,'570120000200004','570411000200003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Money_income16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
      '570120000300001','570120000300002','570120000300003','570120000300007','570120000300011','570120000300012','570120000300013','570120000300015'
,'570411000300000','570411000300001','570411000300002','570411000300003','570411000300015','570412000300000','570412000300001','570412000300002','570412000300003','570412000300015'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Money_income14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
     '570120000400001','570120000400002','570120000400003','570120000400012','570120000400015','570411000400000','570411000400001'
,'570411000400002','570411000400003','570411000400015','570412000400000','570412000400001','570412000400002','570412000400003','570412000400015','570422000400002'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Money_income17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
    '570120000500001','570120000500002','570120000500003','570120000500007','570120000500011','570120000500015','570411000500000','570411000500001'
,'570411000500002','570411000500003','570411000500007','570411000500015','570412000500000','570412000500001','570412000500002','570412000500003',
'570412000500007','570412000500015'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Money_income15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
   '470120000200001','470120000200002','470120000200003','470120000200007','470120000200011','470120000200012','470120000200013','470120000200014'
,'470120000200015','470412000200000','470412000200002','470412000200003','470412000200007','470412000200015','470422000200000','470422000200001','470422000200002',
'470422000200007','470422000200015','470120000200004','470412000000002','470422000200003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Treasury_expenditure16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
 '470120000300001','470120000300002','470120000300003','470120000300007'
,'470120000300011','470120000300012','470120000300013','470120000300015','470412000300000','470412000300001','470412000300002'
,'470412000300003','470412000300015','470422000300000','470422000300001','470422000300002','470422000300015','470422000300003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Treasury_expenditure14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
 '470120000400001','470120000400002','470120000400003','470120000400013','470120000400015','470412000400000'
,'470412000400002','470412000400003','470412000400015','470422000400000','470422000400001','470422000400002'
,'470422000400015','470422000400003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Treasury_expenditure17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'470120000500001','470120000500002','470120000500003','470120000500007','470120000500011'
,'470120000500012','470120000500015','470412000500000','470412000500002'
,'470412000500003','470412000500007','470412000500015','470422000500000'
,'470422000500002','470422000500003','470422000500007','470422000500015'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Treasury_expenditure15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'470510000200002','470510000200003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'470510000300002'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'470510000400002'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'470510000500002'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure15,

FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440872000100000','440873000100000','440510000100000','440520000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Rate_work0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440872000200000','440873000200000','440510000200000','440520000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Rate_work16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440872000300000','440873000300000','440510000300000','440520000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Rate_work14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440872000400000','440873000400000','440510000400000','440520000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Rate_work17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440872000500000','440873000500000','440510000500000','440520000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Rate_work15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410980000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Agent_compensation0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410780000200000','410980000200000','410980000200001','410980000200002','410980000200003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Agent_compensation16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410780000300000','410980000300000','410980000300001','410980000300002','410980000300003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Agent_compensation14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410780000300000','410980000300000','410980000300001','410980000300002','410980000300003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Agent_compensation17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410780000500000','410980000500000','410980000500001','410980000500002','410980000500003'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Agent_compensation15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440610000100000','440860000100001','440650000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Sales_promotion_fee0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440610000200000','440860000200001','440650000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Sales_promotion_fee16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440610000300000','440860000300001','440650000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Sales_promotion_fee14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440610000400000','440860000400001','440650000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Sales_promotion_fee17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440610000500000','440860000500001','440650000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Sales_promotion_fee15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440710000100000','440820000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Office_supplies_publications0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440710000100000','440820000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Office_supplies_publications16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440710000300000','440820000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Office_supplies_publications14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440710000400000','440820000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Office_supplies_publications17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440710000500000','440820000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Office_supplies_publications15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440810000100000','410910000100000','410180000100000','440380000100000','440530000100000','440880000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Operating_Fees0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440810000200000','410180000200000','440380000200000','440530000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Operating_Fees16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410180000300000','440380000300000','440530000300000','440880000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Operating_Fees14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410180000300000','440380000300000','440530000300000','440880000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Operating_Fees17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'410180000500000','440380000500000','440530000500000','440880000500000','440810000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Operating_Fees15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420110000100000','420210000100000','420220000100000','420280000100000','450800000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Salary_monthly_allowance0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420110000200000','420210000200000','420220000200000','420280000200000','420280000200001','420280000200002','420120000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Salary_monthly_allowance16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420110000300000','420210000300000','420220000300000','420280000300000','420280000300002','420120000300000','450800000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Salary_monthly_allowance14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420110000400000','420210000400000','420220000400000','420280000400000','420280000400001','420280000400002','420120000400000','450800000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Salary_monthly_allowance17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420110000500000','420210000500000','420220000500000','420280000500000','420280000500001','420280000500002','420120000500000','450800000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Salary_monthly_allowance15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440312000100000','440318000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Fees_paid_and_audited_externally0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420800000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Other_personnel_expenses0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420130000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420130000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420130000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420130000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420130000500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440830000100000','440850000100000','440380000100001','440840000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440830000200000','440850000200000','440380000200001','440840000200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440830000300000','440850000300000','440380000300001','440840000300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440830000400000','440850000400000','440380000400001','440840000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440830000400000','440850000400000','440380000400001','440840000400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'440200000100000','440200000100002'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) AS Signature_fee_and_rental_fee0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'460111000000000','460111000100000','460112400000000','460112400100000','460112500100000','460112600000000','460112600100000','460112700000000','460112700100000','460112800000000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) Fees0,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'460112600200000','460112700200000','460112500200000','460112400200000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) Fees16,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'460112400300000','460112500300000','460112600300000','460112700300000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) Fees14,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'460112600400000','460112700400000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) Fees17,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'460112400500000','460112500500000','460112600500000','460112700500000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) Fees15,
FORMAT(SUM(CASE 
        WHEN act_account_no IN (
'420320000100000'
        ) 
        THEN tbl_atc.act_amount_money ELSE 0 END), 2) Build_staff_within_the_country0
        FROM tbl_atc
WHERE YEAR(tbl_atc.act_date) = ?
GROUP BY Year, Month
ORDER BY Year, Month";

// เตรียม Statement
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $year);
$stmt->execute();
$result = $stmt->get_result();



// ฟังก์ชันสำหรับดึง Goal ตามช่วงวันที่


$data = [];
while ($row = $result->fetch_assoc()) {
        // แปลงค่าทุกตัวที่จำเป็นเป็น float เพื่อใช้คำนวณ
        $Treasury_expenditure16 = isset($row['Treasury_expenditure16']) ? (float)str_replace(',', '', $row['Treasury_expenditure16']) : 0;
        $Treasury_expenditure14 = isset($row['Treasury_expenditure14']) ? (float)str_replace(',', '', $row['Treasury_expenditure14']) : 0;
        $Treasury_expenditure17 = isset($row['Treasury_expenditure17']) ? (float)str_replace(',', '', $row['Treasury_expenditure17']) : 0;
        $Treasury_expenditure15 = isset($row['Treasury_expenditure15']) ? (float)str_replace(',', '', $row['Treasury_expenditure15']) : 0;

        // แปลงค่ารายได้ที่ใช้คำนวณ
        $Income_loans16 = isset($row['Income_loans16']) ? (float)str_replace(',', '', $row['Income_loans16']) : 0;
        $Income_loans14 = isset($row['Income_loans14']) ? (float)str_replace(',', '', $row['Income_loans14']) : 0;
        $Income_loans17 = isset($row['Income_loans17']) ? (float)str_replace(',', '', $row['Income_loans17']) : 0;
        $Income_loans15 = isset($row['Income_loans15']) ? (float)str_replace(',', '', $row['Income_loans15']) : 0;
        $Income_public16 = isset($row['Income_public16']) ? (float)str_replace(',', '', $row['Income_public16']) : 0;
        $Income_public14 = isset($row['Income_public14']) ? (float)str_replace(',', '', $row['Income_public14']) : 0;
        $Income_public17 = isset($row['Income_public17']) ? (float)str_replace(',', '', $row['Income_public17']) : 0;
        $Income_public15 = isset($row['Income_public15']) ? (float)str_replace(',', '', $row['Income_public15']) : 0;
        $Income_SME16 = isset($row['Income_SME16']) ? (float)str_replace(',', '', $row['Income_SME16']) : 0;
        $Income_SME14 = isset($row['Income_SME14']) ? (float)str_replace(',', '', $row['Income_SME14']) : 0;
        $Income_SME17 = isset($row['Income_SME17']) ? (float)str_replace(',', '', $row['Income_SME17']) : 0;
        $Income_SME15 = isset($row['Income_SME15']) ? (float)str_replace(',', '', $row['Income_SME15']) : 0;
        $Income_deposit_interest0 = isset($row['Income_deposit_interest0']) ? (float)str_replace(',', '', $row['Income_deposit_interest0']) : 0;
        $Fee_income16 = isset($row['Fee_income16']) ? (float)str_replace(',', '', $row['Fee_income16']) : 0;
        $Fee_income14 = isset($row['Fee_income14']) ? (float)str_replace(',', '', $row['Fee_income14']) : 0;
        $Fee_income17 = isset($row['Fee_income17']) ? (float)str_replace(',', '', $row['Fee_income17']) : 0;
        $Fee_income15 = isset($row['Fee_income15']) ? (float)str_replace(',', '', $row['Fee_income15']) : 0;
        $Income_external_debt16 = isset($row['Income_external_debt16']) ? (float)str_replace(',', '', $row['Income_external_debt16']) : 0;
        $Income_external_debt14 = isset($row['Income_external_debt14']) ? (float)str_replace(',', '', $row['Income_external_debt14']) : 0;
        $Income_external_debt17 = isset($row['Income_external_debt17']) ? (float)str_replace(',', '', $row['Income_external_debt17']) : 0;
        $Income_external_debt15 = isset($row['Income_external_debt15']) ? (float)str_replace(',', '', $row['Income_external_debt15']) : 0;
        $Income_other0 = isset($row['Income_other0']) ? (float)str_replace(',', '', $row['Income_other0']) : 0;
        $Income_other16 = isset($row['Income_other16']) ? (float)str_replace(',', '', $row['Income_other16']) : 0;
        $Income_other14 = isset($row['Income_other14']) ? (float)str_replace(',', '', $row['Income_other14']) : 0;
        $Income_other17 = isset($row['Income_other17']) ? (float)str_replace(',', '', $row['Income_other17']) : 0;
        $Income_other15 = isset($row['Income_other15']) ? (float)str_replace(',', '', $row['Income_other15']) : 0;
        $Money_income16 = isset($row['Money_income16']) ? (float)str_replace(',', '', $row['Money_income16']) : 0;
        $Money_income14 = isset($row['Money_income14']) ? (float)str_replace(',', '', $row['Money_income14']) : 0;
        $Money_income17 = isset($row['Money_income17']) ? (float)str_replace(',', '', $row['Money_income17']) : 0;
        $Money_income15 = isset($row['Money_income15']) ? (float)str_replace(',', '', $row['Money_income15']) : 0;


        $Unplanned_debt_expenditure16 = isset($row['Unplanned_debt_expenditure16']) ? (float)str_replace(',', '', $row['Unplanned_debt_expenditure16']) : 0;
        $Unplanned_debt_expenditure15 = isset($row['Unplanned_debt_expenditure15']) ? (float)str_replace(',', '', $row['Unplanned_debt_expenditure15']) : 0;
        $Unplanned_debt_expenditure14 = isset($row['Unplanned_debt_expenditure14']) ? (float)str_replace(',', '', $row['Unplanned_debt_expenditure14']) : 0;
        $Unplanned_debt_expenditure17 = isset($row['Unplanned_debt_expenditure17']) ? (float)str_replace(',', '', $row['Unplanned_debt_expenditure17']) : 0;
        $Rate_work0 = isset($row['Rate_work0']) ? (float)str_replace(',', '', $row['Rate_work0']) : 0;
        $Rate_work16 = isset($row['Rate_work16']) ? (float)str_replace(',', '', $row['Rate_work16']) : 0;
        $Rate_work15 = isset($row['Rate_work15']) ? (float)str_replace(',', '', $row['Rate_work15']) : 0;
        $Rate_work14 = isset($row['Rate_work14']) ? (float)str_replace(',', '', $row['Rate_work14']) : 0;
        $Rate_work17 = isset($row['Rate_work17']) ? (float)str_replace(',', '', $row['Rate_work17']) : 0;
        $Agent_compensation0 = isset($row['Agent_compensation0']) ? (float)str_replace(',', '', $row['Agent_compensation0']) : 0;
        $Agent_compensation14 = isset($row['Agent_compensation14']) ? (float)str_replace(',', '', $row['Agent_compensation14']) : 0;
        $Agent_compensation15 = isset($row['Agent_compensation15']) ? (float)str_replace(',', '', $row['Agent_compensation15']) : 0;
        $Agent_compensation16 = isset($row['Agent_compensation16']) ? (float)str_replace(',', '', $row['Agent_compensation16']) : 0;
        $Agent_compensation17 = isset($row['Agent_compensation17']) ? (float)str_replace(',', '', $row['Agent_compensation17']) : 0;
        $Sales_promotion_fee0 = isset($row['Sales_promotion_fee0']) ? (float)str_replace(',', '', $row['Sales_promotion_fee0']) : 0;
        $Sales_promotion_fee14 = isset($row['Sales_promotion_fee14']) ? (float)str_replace(',', '', $row['Sales_promotion_fee14']) : 0;
        $Sales_promotion_fee15 = isset($row['Sales_promotion_fee15']) ? (float)str_replace(',', '', $row['Sales_promotion_fee15']) : 0;
        $Sales_promotion_fee16 = isset($row['Sales_promotion_fee16']) ? (float)str_replace(',', '', $row['Sales_promotion_fee16']) : 0;
        $Sales_promotion_fee17 = isset($row['Sales_promotion_fee17']) ? (float)str_replace(',', '', $row['Sales_promotion_fee17']) : 0;
        $Office_supplies_publications0 = isset($row['Office_supplies_publications0']) ? (float)str_replace(',', '', $row['Office_supplies_publications0']) : 0;
        $Office_supplies_publications16 = isset($row['Office_supplies_publications16']) ? (float)str_replace(',', '', $row['Office_supplies_publications16']) : 0;
        $Office_supplies_publications15 = isset($row['Office_supplies_publications15']) ? (float)str_replace(',', '', $row['Office_supplies_publications15']) : 0;
        $Office_supplies_publications14 = isset($row['Office_supplies_publications14']) ? (float)str_replace(',', '', $row['Office_supplies_publications14']) : 0;
        $Office_supplies_publications17 = isset($row['Office_supplies_publications17']) ? (float)str_replace(',', '', $row['Office_supplies_publications17']) : 0;
        $Operating_Fees0 = isset($row['Operating_Fees0']) ? (float)str_replace(',', '', $row['Operating_Fees0']) : 0;
        $Operating_Fees14 = isset($row['Operating_Fees14']) ? (float)str_replace(',', '', $row['Operating_Fees14']) : 0;
        $Operating_Fees15 = isset($row['Operating_Fees15']) ? (float)str_replace(',', '', $row['Operating_Fees15']) : 0;
        $Operating_Fees16 = isset($row['Operating_Fees16']) ? (float)str_replace(',', '', $row['Operating_Fees16']) : 0;
        $Operating_Fees17 = isset($row['Operating_Fees17']) ? (float)str_replace(',', '', $row['Operating_Fees17']) : 0;

        $Salary_monthly_allowance16 = isset($row['Salary_monthly_allowance16']) ? (float)str_replace(',', '', $row['Salary_monthly_allowance16']) : 0;
        $Salary_monthly_allowance = isset($row['Salary_monthly_allowance']) ? (float)str_replace(',', '', $row['Salary_monthly_allowance']) : 0;
        $Salary_monthly_allowance14 = isset($row['Salary_monthly_allowance14']) ? (float)str_replace(',', '', $row['Salary_monthly_allowance14']) : 0;
        $Salary_monthly_allowance17 = isset($row['Salary_monthly_allowance17']) ? (float)str_replace(',', '', $row['Salary_monthly_allowance17']) : 0;
        $Salary_monthly_allowance15 = isset($row['Salary_monthly_allowance15']) ? (float)str_replace(',', '', $row['Salary_monthly_allowance15']) : 0;
        $Fees_paid_and_audited_externally0 = isset($row['Fees_paid_and_audited_externally0']) ? (float)str_replace(',', '', $row['Fees_paid_and_audited_externally0']) : 0;
        $Other_personnel_expenses0 = isset($row['Other_personnel_expenses0']) ? (float)str_replace(',', '', $row['Other_personnel_expenses0']) : 0;
        $Overtime_and_welfare_allowances0 = isset($row['Overtime_and_welfare_allowances0']) ? (float)str_replace(',', '', $row['Overtime_and_welfare_allowances0']) : 0;


        $Utilities_and_maintenance_fees0 = isset($row['Utilities_and_maintenance_fees0']) ? (float)str_replace(',', '', $row['Utilities_and_maintenance_fees0']) : 0;
        $Utilities_and_maintenance_fees16 = isset($row['Utilities_and_maintenance_fees16']) ? (float)str_replace(',', '', $row['Utilities_and_maintenance_fees16']) : 0;
        $Utilities_and_maintenance_fees14 = isset($row['Utilities_and_maintenance_fees14']) ? (float)str_replace(',', '', $row['Utilities_and_maintenance_fees14']) : 0;
        $Utilities_and_maintenance_fees17 = isset($row['Utilities_and_maintenance_fees17']) ? (float)str_replace(',', '', $row['Utilities_and_maintenance_fees17']) : 0;
        $Utilities_and_maintenance_fees15 = isset($row['Utilities_and_maintenance_fees15']) ? (float)str_replace(',', '', $row['Utilities_and_maintenance_fees15']) : 0;
        $Signature_fee_and_rental_fee0 = isset($row['Signature_fee_and_rental_fee0']) ? (float)str_replace(',', '', $row['Signature_fee_and_rental_fee0']) : 0;
        $Public_relations_and_clerical_fees0 = isset($row['Public_relations_and_clerical_fees0']) ? (float)str_replace(',', '', $row['Public_relations_and_clerical_fees0']) : 0;

        $Fees0 = isset($row['Fees0']) ? (float)str_replace(',', '', $row['Fees0']) : 0;
        $Fees16 = isset($row['Fees16']) ? (float)str_replace(',', '', $row['Fees16']) : 0;
        $Fees14 = isset($row['Fees14']) ? (float)str_replace(',', '', $row['Fees14']) : 0;
        $Fees17 = isset($row['Fees17']) ? (float)str_replace(',', '', $row['Fees17']) : 0;
        $Fees15 = isset($row['Fees15']) ? (float)str_replace(',', '', $row['Fees15']) : 0;
        $Build_staff_within_the_country0 = isset($row['Build_staff_within_the_country0']) ? (float)str_replace(',', '', $row['Build_staff_within_the_country0']) : 0;

        // คำนวณค่าที่ต้องการ
        $calculated_kpi1 = (
                $Income_loans16 + $Income_loans14 + $Income_loans17 + $Income_loans15 +
                $Income_public16 + $Income_public14 + $Income_public17 + $Income_public15 +
                $Income_SME16 + $Income_SME14 + $Income_SME17 + $Income_SME15 + $Income_other15 +
                $Income_deposit_interest0 + $Fee_income16 + $Fee_income14 + $Fee_income17 + $Fee_income15 + $Income_external_debt16 + $Income_external_debt14 + $Income_external_debt17 + $Income_external_debt15 +
                $Income_other0 + $Income_other16 + $Income_other14 + $Income_other17 +
                $Money_income16 + $Money_income14 + $Money_income17 + $Money_income15
        );



        $Unplanned_debt_expenditure =  (($Unplanned_debt_expenditure16 + $Unplanned_debt_expenditure15 + $Unplanned_debt_expenditure14 + $Unplanned_debt_expenditure17) /  $calculated_kpi1) * 100;
        $a = (($Rate_work0 + $Rate_work16 + $Rate_work15 + $Rate_work14 + $Rate_work17) /  $calculated_kpi1) * 100;
        $b = (($Agent_compensation0 + $Agent_compensation14 + $Agent_compensation15 + $Agent_compensation16 + $Agent_compensation17) /  $calculated_kpi1) * 100;
        $c = (($Sales_promotion_fee0 + $Sales_promotion_fee14 + $Sales_promotion_fee15 + $Sales_promotion_fee16 + $Sales_promotion_fee17) /  $calculated_kpi1) * 100;
        $d = (($Office_supplies_publications0 + $Office_supplies_publications16 + $Office_supplies_publications15 + $Office_supplies_publications14 + $Office_supplies_publications17) /  $calculated_kpi1) * 100;
        $e = (($Operating_Fees0 + $Operating_Fees14 + $Operating_Fees15 + $Operating_Fees16 + $Operating_Fees17) /  $calculated_kpi1) * 100;
        $f = (($Salary_monthly_allowance16 + $Salary_monthly_allowance14 + $Salary_monthly_allowance17 + $Salary_monthly_allowance15) /  $calculated_kpi1) * 100;
        $Fees_paid_and_audited_externally0 = (($Fees_paid_and_audited_externally0) /  $calculated_kpi1) * 100;
        $Other_personnel_expenses0 = (($Other_personnel_expenses0) /  $calculated_kpi1) * 100;
        $Overtime_and_welfare_allowances0 = (($Overtime_and_welfare_allowances0) /  $calculated_kpi1) * 100;
        $g = (($Utilities_and_maintenance_fees0 + $Utilities_and_maintenance_fees16 + $Utilities_and_maintenance_fees14 + $Utilities_and_maintenance_fees17 + $Utilities_and_maintenance_fees15) /  $calculated_kpi1) * 100;
        $Signature_fee_and_rental_fee0 = (($Signature_fee_and_rental_fee0) /  $calculated_kpi1) * 100;
        $Public_relations_and_clerical_fees0 = (($Public_relations_and_clerical_fees0) /  $calculated_kpi1) * 100;
        $Fees0 = (($Fees0 + $Fees16 + $Fees14 + $Fees17 + $Fees15) /  $calculated_kpi1) * 100;
        $Build_staff_within_the_country0 = (($Build_staff_within_the_country0) /  $calculated_kpi1) * 100;



        $calculated_kpi4 = (

                $Unplanned_debt_expenditure16 + $Unplanned_debt_expenditure15 + $Unplanned_debt_expenditure14 + $Unplanned_debt_expenditure17 +
                $Rate_work0 + $Rate_work16 + $Rate_work15 + $Rate_work14 + $Rate_work17 +
                $Agent_compensation0 + $Agent_compensation14 + $Agent_compensation15 + $Agent_compensation16 + $Agent_compensation17 +
                $Sales_promotion_fee0 + $Sales_promotion_fee14 + $Sales_promotion_fee15 + $Sales_promotion_fee16 + $Sales_promotion_fee17 +
                $Office_supplies_publications0 + $Office_supplies_publications16 + $Office_supplies_publications15 + $Office_supplies_publications14 + $Office_supplies_publications17 +
                $Operating_Fees0 + $Operating_Fees14 + $Operating_Fees15 + $Operating_Fees16 + $Operating_Fees17 +
                $Salary_monthly_allowance16 + $Salary_monthly_allowance14 + $Salary_monthly_allowance17 + $Salary_monthly_allowance15 +
                $Fees_paid_and_audited_externally0 +
                $Utilities_and_maintenance_fees0 + $Utilities_and_maintenance_fees16 + $Utilities_and_maintenance_fees14 + $Utilities_and_maintenance_fees17 + $Utilities_and_maintenance_fees15 +
                $Other_personnel_expenses0 +
                $Overtime_and_welfare_allowances0 +
                $Signature_fee_and_rental_fee0 +
                $Public_relations_and_clerical_fees0 +
                $Fees0 + $Fees16 + $Fees14 + $Fees17 + $Fees15 +
                $Build_staff_within_the_country0

        );
        $calculated_kpi4_goal = number_format((2-(($calculated_kpi4 / $calculated_kpi1) / ($goal_total/100)))*100, 2);
        $calculatedkpi4 = number_format((($calculated_kpi4 / $calculated_kpi1)) * 100, 2);
        // เก็บค่าผลลัพธ์
        $data[] = [
                // ฟอร์แมตเป็นตัวเลขทศนิยม 2 ตำแหน่ง
                // ฟอร์แมตเป็นตัวเลขทศนิยม 2 ตำแหน่ง
                'index' => count($data) + 1,
                'Year' => $row['Year'],
                'Month' => $row['Month'],
              'Goal_Total' => number_format($goal_total),// เพิ่มผลรวม Goal ที่ได้จาก fetchGoal


                'ລາຍຈ່າຍໜີ້ນອກຜັງ' =>  number_format($Unplanned_debt_expenditure, 2),
                'ອັດຕາໄປວຽກ' =>  number_format($a, 2),
                'ຄ່າຕອບແທນຕົວແທນ' =>  number_format($b, 2),
                'ຄ່າສົ່ງເສີມການຂາຍ' =>  number_format($c, 2),
                'ຄ່າເຄື່ອງໃຊ້ຫ້ອງການ ແລະສິ່ງພິມ' =>  number_format($d, 2),
                'ຄ່າທຳນຽມໃນການດຳເນີນງານ' =>  number_format($e, 2),
                'ເງິນເດືອນ ແລະ ເງິນອຸດໜູນປະຈຳເດືອນ' =>  number_format($f, 2),
                'ຄ່າວ່າຈ້າງທີ່ປືກສາ ແລະ ກວດກາພາຍນອກ' =>  number_format($Fees_paid_and_audited_externally0, 2),
                'ລາຍຈ່າຍອື່ນໆທາງດ້ານພະນັກງານ' =>  number_format($Other_personnel_expenses0, 2),
                'ເງິນລ່ວງເວລາ ແລະ ເງິນອຸດໜູນສະຫວັດດີການ' =>  number_format($Overtime_and_welfare_allowances0, 2),
                'ຄ່າສາທາລະນຸປະໂພກ ແລະ ບຳລຸງຮັກສາ' =>  number_format($g, 2),
                'ຄ່າລາຍເຊັນແລະຄ່າເຊົ່າ' =>  number_format($Signature_fee_and_rental_fee0, 2),
                'ຄ່າປະຊາສຳພັນ ແລະ ພິທິການ' =>  number_format($Public_relations_and_clerical_fees0, 2),
                'ຄ່າຫຼຸ້ຍຫ້ຽນ' =>  number_format($Fees0, 2),
                'ກໍ່ສ້າງພະນັກງານຢູ່ພາຍໃນປະເທດ' =>  number_format($Build_staff_within_the_country0, 2),


                'KPI4' => number_format($calculatedkpi4),
                'KPI1' => number_format($calculated_kpi1),
                'calculated_kpi4_goal' =>number_format($calculated_kpi4_goal),
                'calculatedkpi4' => number_format($calculatedkpi4),

        ];
}

// ส่งออก JSON
echo json_encode($data);
