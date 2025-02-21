<?php
require_once 'connect.php'; // รวมไฟล์การเชื่อมต่อฐานข้อมูล

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

function fetchGoal($year, $conn) {
    $goal_query = "SELECT `code_kpi`,`Goal` FROM tbl_kpi_goal
                   WHERE `code_kpi` = 'KPI3'
                   AND YEAR(date_dim) = ?";
                   
    $goal_stmt = $conn->prepare($goal_query);
    $goal_stmt->bind_param("i", $year);
    $goal_stmt->execute();
    $goal_result = $goal_stmt->get_result();
    $goal_row = $goal_result->fetch_assoc();

    return $goal_row['Goal'] ?? 0; // คืนค่า Goal หรือ 0 หากไม่มีข้อมูล
}
function kpi3($year, $conn) {
    $goal_query1 = "SELECT COUNT(*) as kpi3 FROM `kpi3` WHERE YEAR(kpi3.date) = ?";
                   
    $goal_stmt1 = $conn->prepare($goal_query1);
    $goal_stmt1->bind_param("i", $year);
    $goal_stmt1->execute();
    $result = $goal_stmt1->get_result();
    $kpi3 = $result->fetch_assoc();

    return $kpi3['kpi3'] ?? 0; }

$goal_total = fetchGoal($year, $conn); // ดึงค่าผลรวมของ goal
$kpi3 = kpi3($year, $conn);
// สร้างคำสั่ง SQL
$query = "SELECT 
    YEAR(tbl_atc.date) AS Year,
    MONTH(tbl_atc.date) AS Month,
    FORMAT(SUM(CASE 
        WHEN account_no IN (
            '510213200200000', '510213200200001', '510213200200002', '510223200200000',
            '510223200200002', '510223200200015', '510290000200000', '510290000200001', 
            '510290000200002', '510288000000002', '510288000200000', '510288000200001',
            '510288000200002', '510288000200015', '510288000220027', '510288000220036', 
            '510288000220028'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_loans16,
    
    FORMAT(SUM(CASE 
        WHEN account_no IN (
            '510213200300001', '510213200300002', '510223200300000', '510223200300002',
            '510223200300015', '510290000300000', '510290000300001', '510290000300002',
            '510290000300015', '510288000300000', '510288000300001', '510288000300002',
            '510288000300015', '510288000320027', '510288000320028'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_loans14,

    FORMAT(SUM(CASE 
        WHEN account_no IN (
            '510213200400000', '510213200400001', '510213200400002', '510223200400000',
            '510223200400002', '510223200400015', '510290000400000', '510290000400001', 
            '510290000400002', '510290000400015', '510288000400000', '510288000400001',
            '510288000400002', '510288000400015', '510288000420027', '510288000420030',
            '510288000420031', '510288000420033'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_loans17,

    FORMAT(SUM(CASE 
        WHEN account_no IN (
            '510213200500000', '510213200500001', '510213200500002', '510223200500000',
            '510223200500002', '510223200500015', '510290000500000', '510290000500001', 
            '510290000500002', '510290000500015', '510288000500000', '510288000500001',
            '510288000500002', '510288000500015', '510288000520028', '510288000520027'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_loans15,
    FORMAT(SUM(CASE 
        WHEN account_no IN (
            '510213200200007','510223200200007','510290000200007','510213200200003',
            '510288000200003','510288000220003','510290000200003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_public16,
    FORMAT(SUM(CASE 
        WHEN account_no IN (
            '510213200300007','510223200300007','510290000300007','510213200300003',
            '510290000300003','510288000300003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_public14,
  FORMAT(SUM(CASE 
        WHEN account_no IN (
           '510213200400007','510223200400007','510290000400007','510213200400003',
           '510290000400003','510288000400003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_public17,
  FORMAT(SUM(CASE 
        WHEN account_no IN (
         '510213200500007','510223200500007','510290000500007','510213200500003',
         '510223200500003','510290000500003','510288000500003','510288000520003',
         '510288000500007'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_public15,
  FORMAT(SUM(CASE 
        WHEN account_no IN (
         '510213200200014','510223200200014','510290000200014','510290000200004'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_SME16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
         '510213200300014','510223200300014','510290000300014'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_SME14,

FORMAT(SUM(CASE 
        WHEN account_no IN (
        '510213200400014','510223200400014','510290000400014'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_SME17,
 FORMAT(SUM(CASE 
        WHEN account_no IN (
        '510213200500014','510223200500014','510290000500014'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_SME15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '510131100100000','510131200100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_deposit_interest0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
      '510287000220000','510287000221000','510287000222000','510287000200001','510287000200002','510287000200003','510287000212000','510287000223000','510287000211000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Fee_income16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
      '510287000321000','510287000322000','510287000300002','510287000300003','510287000311000','510287000323000','510287000312000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Fee_income14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
        '510287000421000','510287000422000','510287000400001','510287000400002','510287000400003','510287000411000','510287000412000','510287000423000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Fee_income17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '510287000521000','510287000522000','510287000500001','510287000500002','510287000500003','510287000511000','510287000511015','510287000512000','510287000523000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Fee_income15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '570500000200000','570500000200001','570500000200002','570500000200003','570500000200007','570500000200014','570500000200004'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_external_debt16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '570500000300000','570500000300001','570500000300002','570500000300003','570500000300007'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_external_debt14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '570500000400000','570500000400001','570500000400002','570500000400003','570500000400007'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_external_debt17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '570500000400000','570500000400001','570500000400002','570500000400003','570500000400007'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_external_debt15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '550840000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_other0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '550840000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_other16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '5550840000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_other14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '550840000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_other17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '550840000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Income_other15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
       '570120000200001','570120000200002','570120000200003','570120000200007','570120000200011','570120000200012','570120000200013','570120000200014','570120000200015'
,'570411000200000','570411000200001','570411000200002','570411000200007','570411000200015','570412000200000','570412000200001','570412000200002','570412000200003','570412000200007','570412000200015'
,'570120000200004','570411000200003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Money_income16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
      '570120000300001','570120000300002','570120000300003','570120000300007','570120000300011','570120000300012','570120000300013','570120000300015'
,'570411000300000','570411000300001','570411000300002','570411000300003','570411000300015','570412000300000','570412000300001','570412000300002','570412000300003','570412000300015'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Money_income14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
     '570120000400001','570120000400002','570120000400003','570120000400012','570120000400015','570411000400000','570411000400001'
,'570411000400002','570411000400003','570411000400015','570412000400000','570412000400001','570412000400002','570412000400003','570412000400015','570422000400002'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Money_income17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
    '570120000500001','570120000500002','570120000500003','570120000500007','570120000500011','570120000500015','570411000500000','570411000500001'
,'570411000500002','570411000500003','570411000500007','570411000500015','570412000500000','570412000500001','570412000500002','570412000500003',
'570412000500007','570412000500015'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Money_income15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
   '470120000200001','470120000200002','470120000200003','470120000200007','470120000200011','470120000200012','470120000200013','470120000200014'
,'470120000200015','470412000200000','470412000200002','470412000200003','470412000200007','470412000200015','470422000200000','470422000200001','470422000200002',
'470422000200007','470422000200015','470120000200004','470412000000002','470422000200003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Treasury_expenditure16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
 '470120000300001','470120000300002','470120000300003','470120000300007'
,'470120000300011','470120000300012','470120000300013','470120000300015','470412000300000','470412000300001','470412000300002'
,'470412000300003','470412000300015','470422000300000','470422000300001','470422000300002','470422000300015','470422000300003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Treasury_expenditure14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
 '470120000400001','470120000400002','470120000400003','470120000400013','470120000400015','470412000400000'
,'470412000400002','470412000400003','470412000400015','470422000400000','470422000400001','470422000400002'
,'470422000400015','470422000400003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Treasury_expenditure17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'470120000500001','470120000500002','470120000500003','470120000500007','470120000500011'
,'470120000500012','470120000500015','470412000500000','470412000500002'
,'470412000500003','470412000500007','470412000500015','470422000500000'
,'470422000500002','470422000500003','470422000500007','470422000500015'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Treasury_expenditure15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'470510000200002','470510000200003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'470510000300002'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'470510000400002'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'470510000500002'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Unplanned_debt_expenditure15,

FORMAT(SUM(CASE 
        WHEN account_no IN (
'440872000100000','440873000100000','440510000100000','440520000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Rate_work0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440872000200000','440873000200000','440510000200000','440520000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Rate_work16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440872000300000','440873000300000','440510000300000','440520000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Rate_work14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440872000400000','440873000400000','440510000400000','440520000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Rate_work17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440872000500000','440873000500000','440510000500000','440520000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Rate_work15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410980000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Agent_compensation0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410780000200000','410980000200000','410980000200001','410980000200002','410980000200003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Agent_compensation16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410780000300000','410980000300000','410980000300001','410980000300002','410980000300003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Agent_compensation14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410780000300000','410980000300000','410980000300001','410980000300002','410980000300003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Agent_compensation17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410780000500000','410980000500000','410980000500001','410980000500002','410980000500003'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Agent_compensation15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440610000100000','440860000100001','440650000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Sales_promotion_fee0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440610000200000','440860000200001','440650000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Sales_promotion_fee16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440610000300000','440860000300001','440650000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Sales_promotion_fee14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440610000400000','440860000400001','440650000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Sales_promotion_fee17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440610000500000','440860000500001','440650000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Sales_promotion_fee15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440710000100000','440820000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Office_supplies_publications0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440710000100000','440820000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Office_supplies_publications16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440710000300000','440820000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Office_supplies_publications14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440710000400000','440820000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Office_supplies_publications17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440710000500000','440820000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Office_supplies_publications15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440810000100000','410910000100000','410180000100000','440380000100000','440530000100000','440880000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Operating_Fees0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440810000200000','410180000200000','440380000200000','440530000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Operating_Fees16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410180000300000','440380000300000','440530000300000','440880000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Operating_Fees14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410180000300000','440380000300000','440530000300000','440880000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Operating_Fees17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'410180000500000','440380000500000','440530000500000','440880000500000','440810000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Operating_Fees15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420110000100000','420210000100000','420220000100000','420280000100000','450800000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Salary_monthly_allowance0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420110000200000','420210000200000','420220000200000','420280000200000','420280000200001','420280000200002','420120000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Salary_monthly_allowance16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420110000300000','420210000300000','420220000300000','420280000300000','420280000300002','420120000300000','450800000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Salary_monthly_allowance14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420110000400000','420210000400000','420220000400000','420280000400000','420280000400001','420280000400002','420120000400000','450800000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Salary_monthly_allowance17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420110000500000','420210000500000','420220000500000','420280000500000','420280000500001','420280000500002','420120000500000','450800000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Salary_monthly_allowance15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440312000100000','440318000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Fees_paid_and_audited_externally0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420800000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Other_personnel_expenses0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420130000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420130000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420130000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420130000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420130000500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Overtime_and_welfare_allowances15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440830000100000','440850000100000','440380000100001','440840000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440830000200000','440850000200000','440380000200001','440840000200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440830000300000','440850000300000','440380000300001','440840000300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440830000400000','440850000400000','440380000400001','440840000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440830000400000','440850000400000','440380000400001','440840000400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) AS Utilities_and_maintenance_fees15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440200000100000','440200000100002'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) ASSignature_fee_and_rental_fee0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'440200000100000','440200000100002'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) ASSignature_fee_and_rental_fee16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'460111000000000','460111000100000','460112400000000','460112400100000','460112500100000','460112600000000','460112600100000','460112700000000','460112700100000','460112800000000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) Fees0,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'460112600200000','460112700200000','460112500200000','460112400200000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) Fees16,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'460112400300000','460112500300000','460112600300000','460112700300000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) Fees14,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'460112600400000','460112700400000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) Fees17,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'460112400500000','460112500500000','460112600500000','460112700500000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) Fees15,
FORMAT(SUM(CASE 
        WHEN account_no IN (
'420320000100000'
        ) 
        THEN tbl_atc.amount_money ELSE 0 END), 2) Build_staff_within_the_country0
        FROM tbl_atc
WHERE YEAR(tbl_atc.date) = ?
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

    // คำนวณค่าที่ต้องการ
    $calculated_kpi1 = (
        $Income_loans16 + $Income_loans14 + $Income_loans17 + $Income_loans15 +
        $Income_public16 + $Income_public14 + $Income_public17 + $Income_public15 +
        $Income_SME16 + $Income_SME14 + $Income_SME17 + $Income_SME15 + $Income_other15+
        $Income_deposit_interest0 + $Fee_income16 + $Fee_income14 + $Fee_income17 + $Fee_income15 + $Income_external_debt16 + $Income_external_debt14 + $Income_external_debt17 + $Income_external_debt15 +
        $Income_other0 + $Income_other16 + $Income_other14 + $Income_other17 +
        $Money_income16 + $Money_income14 + $Money_income17 + $Money_income15
) - (
        $Treasury_expenditure16 + $Treasury_expenditure14 + $Treasury_expenditure17 + $Treasury_expenditure15
);
    $Income_loans = $Income_loans16 + $Income_loans14 + $Income_loans17 + $Income_loans15;
    $a = $Treasury_expenditure16 + $Treasury_expenditure14 + $Treasury_expenditure17 + $Treasury_expenditure15;
    $b = $Income_public16 + $Income_public14 + $Income_public17 + $Income_public15;
    $c = $Income_SME16 + $Income_SME14 + $Income_SME17 + $Income_SME15;
    $d = $Income_deposit_interest0;
    $e = $Fee_income16 + $Fee_income17 + $Fee_income15 +$Fee_income14;
    $f = $Income_external_debt16 + $Income_external_debt17 + $Income_external_debt15 +$Income_external_debt14;
    $g = $Income_other16 + $Income_other17 + $Income_other15 +$Income_other14 +$Income_other0;
    $h = $Money_income16 + $Money_income17 + $Money_income15 +$Money_income14;


    $calculated_kpi2 = (

        $Income_public16 + $Income_public14 + $Income_public17 + $Income_public15 +
        $Income_SME16 + $Income_SME14 + $Income_SME17 + $Income_SME15

);
    // เก็บค่าผลลัพธ์
    $data[] = [
        'KPI1' => number_format($calculated_kpi1),
        'KPI2' => number_format($calculated_kpi2, 2), // ฟอร์แมตเป็นตัวเลขทศนิยม 2 ตำแหน่ง
        // ฟอร์แมตเป็นตัวเลขทศนิยม 2 ตำแหน่ง
        'index' => count($data) + 1,
        'Year' => $row['Year'],
        'Month' => $row['Month'],
        'Goal_Total' => number_format($goal_total), // เพิ่มผลรวม Goal ที่ได้จาก fetchGoal
        'ລາຍຮັບຈາກເງິນກູ້ເງິນເດືອນ' =>  number_format($Income_loans),
        'ລາຍຈ່າຍຄັງແຮ' =>  number_format($a),
        'ລາຍຮັບຈາກເງິນກູ້ປະຊາຊົນ' =>  number_format($b),
        'ລາຍຮັບຈາກເງິນກູ້ SME' =>  number_format($c),
        'ລາຍຮັບຈາກດອກເບ້ຍເງິນຝາກ' =>  number_format($d),
        'ລາຍຮັບຄ່າທຳນຽມ ເງິນກູ້ເງິນເດືອນ' =>  number_format($e),
        'ລາຍຮັບຈາກໜີ້ນອກຜັງ' =>  number_format($f),
        'ລາຍຮັບໃນການດຳນເນີນງານອື່ນໆ' =>  number_format($g),
        'ລາຍຮັບເງິນແຮ' =>  number_format($h),
        'KPI3' =>number_format($kpi3),
    
    ];
}

// ส่งออก JSON
echo json_encode($data);