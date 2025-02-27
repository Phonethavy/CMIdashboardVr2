<?php
include('connect.php'); // Include database connection

if (isset($_GET['year1']) && isset($_GET['year2'])) {
    $yearCurrent = isset($_GET['year1']) ? $_GET['year1'] : ''; // Get selected year from URL
    $yearPrevious = isset($_GET['year2']) ? $_GET['year2'] : ''; // Get previous year

    $data = [];

    // Loop through months for current year
    for ($month = 1; $month <= 12; $month++) {
        $month_str = str_pad($month, STR_PAD_LEFT, '0', STR_PAD_LEFT);

        // Prepare SQL query for current year
        $sqlCurrentYear = "SELECT 
             act_date,
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('3101000','3202000','3203000','3208000','3401200','3402200','3800000','3908000','5101311','5101312','5102132','5102232','5102870',
                        '5102880','5102900','5109300','5506200','5508400','5701200','5704110','5704120','5704220','5705000') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('4101341','4101800','4102130','4102151','4102152','4102510','4102512','4106100','4107800','4108800','4109100','4109300','4109800','4201100','4201200','4201300','4202100','4202200',
                        '4202800','4203100','4203200','4208000','4300000','4402000','4403120','4403180','4403800','4403810','4405100','4405200','4405201','4405300','4406100','4406500','4407100','4407200','4408100','4408200','4408300',
                        '4408400','4408500','4408600','4408610','4408720','4408730','4408800','4506100','4506200','4508000','4601110','4601122','4601124','4601125','4601126','4601127','4601128','4601210','4701200','4701800','4702800','4704120','4704220','4705100') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 
                    'N0') AS 'Capital16',  

                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('3401200','3402200') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Capital2_16_7' ,
                    
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1131110','1131130','1131151','1131152','1131153','1131242') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'debt2', 
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1203121','1203122','1283121','1283122','1291131','1291132','1292131','1292132','1293131','1293132') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('1299131','1299211','1299311') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'loans5', 
                    
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1441200','1441810','1442200','1442400','1442500','1442600','1442700','1442800') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('1481120','1481125','1481181','1481220','1481240','1481250','1481260','1481270','1481280') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'assets8', 
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1283711','1283712','1203711','1203712','1297111','1297112','1297131','1297132','1361100','1362100','1362300','1362320','1362800','1373300','1373400','1373800','1388100','1388220','1388300','1388800') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'otherAssets10',

                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('5101311','5101312','5102132','5102232','5102870','5102880','5102900','5109300','5506200','5508400','5701200','5704110','5704120','5704220','5705000') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('4101341','4101800','4102130','4102151','4102152','4102510','4102512','4106100','4107800','4108800','4109100','4109300','4109800','4201100','4201200','4201300','4202100','4202200','4202800','4203100',
                        '4203200','4208000','4300000','4402000','4403120','4403180','4403800','4403810','4405100','4405200','4405201','4405300','4406100','4406500','4407100','4407200','4408100','4408200','4408300','4408400','4408500','4408600',
                        '4408610','4408720','4408730','4408800','4506100','4506200','4508000','4601110','4601122','4601124','4601125','4601126','4601127','4601128','4601210','4701200','4701800','4702800','4704120','4704220','4705100') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'result_monthV',
                        
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1101100','1121170','1131110','1131130','1131151','1131152','1131153','1131242','1203121','1203122','1283121','1283122','1291131','1291132','1292131','1292132','1293131','1293132',
                        '1441200','1441810','1442200','1442400','1442500','1442600','1442700','1442800','1283711','1283712','1203711','1203712','1297111','1297112','1297131','1297132','1361100','1362100','1362310','1362320',
                        '1362800','1373300','1373400','1373800','1388100','1388220','1388300','1388800') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('1299131','1299211','1299311','1481120','1481125','1481181','1481220','1481240','1481250','1481260','1481270','1481280') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'All_propertyI',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('0') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'balance2_3',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1203121','1203122','1283121','1283122','1291131','1291132','1292131','1292132','1293131','1293132') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'loan_balance99',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('0') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'otherdept11_4',
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('2361110','2361140','2361310','2362300','2362500','2362510','2362600','2388500','2388800','3301100','3308000') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('2388300') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'other15_3',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('0') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'drevaluation16_6',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('2201300','2201512','2201513','2201521','2201522','2201523') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'deptsentcus12',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1101000','1103000','1108000') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Cash1_1',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('2121210','2121230','212130','2121410','2121430','2131110','2131130','2131140','2131210','2131230','2131240','2131311','2131313','2131314','2131321','2131323','2131324','2131410','2131430','2131440','2131510','2131530','2131540','2131610',
                        '2131630','2131640','2131710','2131730','2131740','2121250','2121450','2131150','2131250','2131315','2131325','213145','213155','213165','213175','21221,''21222','2122300','2132100','2132200','2141000','2142','2161000')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Debt11',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('2201100','2201300','2201400','2201500','2201200','2231000','2235000','2241000','2261000','2201700')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Debt12',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('5101311','5101312','5102132','5102900','5102232')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Interest1',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('5102870','5102880')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Fee_income9',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('5109300','5508400','5704110','5704120','5704220')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Fee_orther15',
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4101341','4102130','4102151','4102152','4102510','4102512')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Interest_expense2_1',
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4101800','4108800')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Payment_of_fees10_1',
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4201100','4201200','4201300','4202100','4202200','4202800','4203100','4203200','4208000','4300000','4402000',
                        '4403120','4403180','4403800','4403810','4405100','4405200','4405201','4405300','4406100','4406500','4407100','4407200','4408100',
                        '4408200','4408300','4408400','4408500','4408600','4408610','4408720','4408730','4408800')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'administrative_expenses16_1',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4601110','4601122','4601124','4601125','4601126','4601127','4601128','4601210') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('5601200') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'salary_lousy17',
                  
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4107800','4109100','4109300','4109800','4506200','4704120','4704220')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Other_business18',

                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4701200','4701800','4705100') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('5701200','5705000') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'debt_must_be_received19',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4900000')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'Profit_tax21_1',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1101100')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'cash1_1_1',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('2131130','2131152','2201300','2201512','2201513','2201521','2201522','2201523','2361110','2361140','2361310','2362300','2362500','2362510','2362600','2388300','2388500','2388800','3301100','3308000')
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'All_dept_and_moneyII',
                    FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1291131','1291132','1292131','1292132','1293131','1293132')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'loan_balanceCDE',
                 FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('9801000')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'outstangding16',
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('9802000')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'interest16',
                FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ( '1203121','1203122','1283121','1283122','1291131','1291132','1292131','1292132','1293131','1293132')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'outstanding05',
                 FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ( '1203121','1203122')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS ' provisionA',
                FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ( '1283121','1283122')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS ' provisionB',
              FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ( '1291131','1291132')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS ' provisionC',
                  FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ( '1292131','1292132')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS ' provisionD',
             FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('1293131','1293132')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS ' provisionE',
                  FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4201100','4201200','4201300','4202100','4202200','4202800','4203100','4203200','4208000','4300000','4402000','4403120','4403180','4403800','4403810','4405100',
                        '4405200','4405201','4405300','4406100','4406500','4407100','4407200','4408100','4408200','4408300','4408400','4408500','4408600','4408610','4408720','4408730','4408800')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'expensesGeneral16_2',
                   FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4601110','4601122','4601124','4601125','4601126','4601127','4601128','4601210') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('5601200') 
                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'expenseslousy17' ,
               FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('4107800','4109100','4109300','4109800','4506200','4704120','4704220')

                        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'expensesOther18'
                  
                FROM tbl_atc
                WHERE year(`act_date`) = '$yearCurrent' AND month(act_date )= '$month_str'"; // Get data for each month

        $resultCurrent = mysqli_query($conn, $sqlCurrentYear);
        $sqlnii_nim = "SELECT  FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('Quantity') 
THEN tbl_nim.nim_amount ELSE 0 END), 'N0') AS 'Quantity',

FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('LOAN0005','LOAN0006','LOAN0007','LOAN0008','LOAN0011','LOAN0012','LOAN0013','LOAN0014','LOAN0015','LOAN0016','LOAN0017','LOAN0018') 
THEN tbl_nim.nim_amount ELSE 0 END), 'N0') AS 'sumloan',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('LOAN0005','LOAN0006','LOAN0007','LOAN0008','LOAN0011','LOAN0012','LOAN0013','LOAN0014','LOAN0015','LOAN0016','LOAN0017','LOAN0018') 
THEN tbl_nim.nim_amount * tbl_nim.nim_rate ELSE 0 END), 'N0') AS 'sumloanrate',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('SAVING','FIXED_13','FIXED_18','FIXED_19','FIXED_20','FIXED_21','FIXED_22') 
THEN tbl_nim.nim_amount ELSE 0 END), 'N0') AS 'sumfixes',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('SAVING','FIXED_13','FIXED_18','FIXED_19','FIXED_20','FIXED_21','FIXED_22') 
THEN tbl_nim.nim_amount * tbl_nim.nim_rate ELSE 0 END), 'N0') AS 'sumfixesrate',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('SAV00003','SAV00004','SAV00016','SAV00001','SAV00002') 
THEN tbl_nim.nim_amount ELSE 0 END), 'N0') AS 'saving',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('SAV00003','SAV00004','SAV00016','SAV00001','SAV00002')
THEN tbl_nim.nim_amount * tbl_nim.nim_rate ELSE 0 END), 'N0') AS 'savingrate',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('F060M001','F120M001','F048M001','F048M002','F036M004','F036M005','F036M006','F048M003','F006M002','F012M004','F024M002','F012M005','F024M003','F048M004','F048M005','F060M003','F012M006','F024M005') 
THEN tbl_nim.nim_amount ELSE 0 END), 'N0') AS 'sumfix2',
FORMAT(SUM(CASE 
WHEN nim_catalog_code IN ('F060M001','F120M001','F048M001','F048M002','F036M004','F036M005','F036M006','F048M003','F006M002','F012M004','F024M002','F012M005','F024M003','F048M004','F048M005','F060M003','F012M006','F024M005') 
THEN tbl_nim.nim_amount * tbl_nim.nim_rate ELSE 0 END), 'N0') AS 'sumfix2rate'
 FROM `tbl_nim`
WHERE year(`nim_date`) = '$yearCurrent' AND month(nim_date ) = '$month_str'"; // Get data for December only

        $resultnii_nim = mysqli_query($conn, $sqlnii_nim);


        if ($resultCurrent && $resultnii_nim) {
            $row = mysqli_fetch_assoc($resultCurrent);
            $row3 = mysqli_fetch_assoc($resultnii_nim);
            $data[$month] = [
                'Capital16' => isset($row['Capital16']) ? (float)str_replace(',', '', $row['Capital16']) : 0,
                'Capital2_16_7' => isset($row['Capital2_16_7']) ? (float)str_replace(',', '', $row['Capital2_16_7']) : 0,
                'debt2' => isset($row['debt2']) ? (float)str_replace(',', '', $row['debt2']) : 0,
                'loans5' => isset($row['loans5']) ? (float)str_replace(',', '', $row['loans5']) : 0,
                'assets8' => isset($row['assets8']) ? (float)str_replace(',', '', $row['assets8']) : 0,
                'otherAssets10' => isset($row['otherAssets10']) ? (float)str_replace(',', '', $row['otherAssets10']) : 0,
                'result_monthV' => isset($row['result_monthV']) ? (float)str_replace(',', '', $row['result_monthV']) : 0,
                'All_propertyI' => isset($row['All_propertyI']) ? (float)str_replace(',', '', $row['All_propertyI']) : 0,
                'balance2_3' => isset($row['balance2_3']) ? (float)str_replace(',', '', $row['balance2_3']) : 0,
                'loan_balance99' => isset($row['loan_balance99']) ? (float)str_replace(',', '', $row['loan_balance99']) : 0,
                'otherdept11_4' => isset($row['otherdept11_4']) ? (float)str_replace(',', '', $row['otherdept11_4']) : 0,
                'other15_3' => isset($row['other15_3']) ? (float)str_replace(',', '', $row['other15_3']) : 0,
                'drevaluation16_6' => isset($row['drevaluation16_6']) ? (float)str_replace(',', '', $row['drevaluation16_6']) : 0,
                'deptsentcus12' => isset($row['deptsentcus12']) ? (float)str_replace(',', '', $row['deptsentcus12']) : 0,
                'Cash1_1' => isset($row['Cash1_1']) ? (float)str_replace(',', '', $row['Cash1_1']) : 0,
                'Debt11' => isset($row['Debt11']) ? (float)str_replace(',', '', $row['Debt11']) : 0,
                'Debt12' => isset($row['Debt12']) ? (float)str_replace(',', '', $row['Debt12']) : 0,
                'Interest1' => isset($row['Interest1']) ? (float)str_replace(',', '', $row['Interest1']) : 0,
                'Fee_income9' => isset($row['Fee_income9']) ? (float)str_replace(',', '', $row['Fee_income9']) : 0,
                'Fee_orther15' => isset($row['Fee_orther15']) ? (float)str_replace(',', '', $row['Fee_orther15']) : 0,
                'Interest_expense2_1' => isset($row['Interest_expense2_1']) ? (float)str_replace(',', '', $row['Interest_expense2_1']) : 0,
                'Payment_of_fees10_1' => isset($row['Payment_of_fees10_1']) ? (float)str_replace(',', '', $row['Payment_of_fees10_1']) : 0,
                'administrative_expenses16_1' => isset($row['administrative_expenses16_1']) ? (float)str_replace(',', '', $row['administrative_expenses16_1']) : 0,
                'salary_lousy17' => isset($row['salary_lousy17']) ? (float)str_replace(',', '', $row['salary_lousy17']) : 0,
                'Other_business18' => isset($row['Other_business18']) ? (float)str_replace(',', '', $row['Other_business18']) : 0,
                'debt_must_be_received19' => isset($row['debt_must_be_received19']) ? (float)str_replace(',', '', $row['debt_must_be_received19']) : 0,
                'Profit_tax21_1' => isset($row['Profit_tax21_1']) ? (float)str_replace(',', '', $row['Profit_tax21_1']) : 0,
                'cash1_1_1' => isset($row['cash1_1_1']) ? (float)str_replace(',', '', $row['cash1_1_1']) : 0,
                'All_dept_and_moneyII' => isset($row['All_dept_and_moneyII']) ? (float)str_replace(',', '', $row['All_dept_and_moneyII']) : 0,
                'loan_balanceCDE' => isset($row['loan_balanceCDE']) ? (float)str_replace(',', '', $row['loan_balanceCDE']) : 0,
                'outstangding16' => isset($row['outstangding16']) ? (float)str_replace(',', '', $row['outstangding16']) : 0,
                'interest16' => isset($row['interest16']) ? (float)str_replace(',', '', $row['interest16']) : 0,
                'outstanding05' => isset($row['outstanding05']) ? (float)str_replace(',', '', $row['outstanding05']) : 0,
                'provisionA' => isset($row['provisionA']) ? (float)str_replace(',', '', $row['provisionA']) : 0,
                'provisionB' => isset($row['provisionB']) ? (float)str_replace(',', '', $row['provisionB']) : 0,
                'provisionC' => isset($row['provisionC']) ? (float)str_replace(',', '', $row['provisionC']) : 0,
                'provisionD' => isset($row['provisionD']) ? (float)str_replace(',', '', $row['provisionD']) : 0,
                'provisionE' => isset($row['provisionE']) ? (float)str_replace(',', '', $row['provisionE']) : 0,
                'expensesGeneral16_2' => isset($row['expensesGeneral16_2']) ? (float)str_replace(',', '', $row['expensesGeneral16_2']) : 0,
                'expenseslousy17' => isset($row['expenseslousy17']) ? (float)str_replace(',', '', $row['expenseslousy17']) : 0,
                'expensesOther18' => isset($row['expensesOther18']) ? (float)str_replace(',', '', $row['expensesOther18']) : 0,
                'sumloan' => isset($row3['sumloan']) ? (float)str_replace(',', '', $row3['sumloan']) : 0,
                'sumloanrate' => isset($row3['sumloanrate']) ? (float)str_replace(',', '', $row3['sumloanrate']) : 0,
                'sumfixes' => isset($row3['sumfixes']) ? (float)str_replace(',', '', $row3['sumfixes']) : 0,
                'sumfixesrate' => isset($row3['sumfixesrate']) ? (float)str_replace(',', '', $row3['sumfixesrate']) : 0,
                'saving' => isset($row3['saving']) ? (float)str_replace(',', '', $row3['saving']) : 0,
                'savingrate' => isset($row3['savingrate']) ? (float)str_replace(',', '', $row3['savingrate']) : 0,
                'sumfix2' => isset($row3['sumfix2']) ? (float)str_replace(',', '', $row3['sumfix2']) : 0,
                'sumfix2rate' => isset($row3['sumfix2rate']) ? (float)str_replace(',', '', $row3['sumfix2rate']) : 0,
                'Quantity' => isset($row3['Quantity']) ? (float)str_replace(',', '', $row3['Quantity']) : 0,
            ];
        } else {
            error_log("No results found for year $year and month $month_str");
            $data[$month] = [
                'Capital16' => 0,
                'Capital2_16_7' => 0,
                'debt2' => 0,
                'loans5' => 0,
                'assets8' => 0,
                'otherAssets10' => 0,
                'result_monthV' => 0,
                'All_propertyI' => 0,
                'balance2_3' => 0,
                'loan_balance99' => 0,
                'otherdept11_4' => 0,
                'other15_3' => 0,
                'drevaluation16_6' => 0,
                'deptsentcus12' => 0,
                'Cash1_1' => 0,
                'Debt11' => 0,
                'Debt12' => 0,
                'Interest1' => 0,
                'Fee_income9' => 0,
                'Fee_orther15' => 0,
                'Interest_expense2_1' => 0,
                'Payment_of_fees10_1' => 0,
                'administrative_expenses16_1' => 0,
                'salary_lousy17' => 0,
                'Other_business18' => 0,
                'debt_must_be_received19' => 0,
                'Profit_tax21_1' => 0,
                'cash1_1_1' => 0,
                'All_dept_and_moneyII' => 0,
                'loan_balanceCDE' => 0,
                'outstangding16' => 0,
                'interest16' => 0,
                'outstanding05' => 0,
                'provisionA' => 0,
                'provisionB' => 0,
                'provisionC' => 0,
                'provisionD' => 0,
                'provisionE' => 0,
                'expensesGeneral16_2' => 0,
                'expenseslousy17' => 0,
                'expensesOther18' => 0,
                'sumloan' => 0,
                'sumloanrate' => 0,
                'sumfixes' => 0,
                'sumfixesrate' => 0,
                'saving' => 0,
                'savingrate' => 0,
                'sumfix2' => 0,
                'sumfix2rate' => 0,
                'Quantity' => 0,
            ];
        }
    }

    // Prepare SQL query for previous year for December only
    $sqlPreviousYear = "SELECT 
 FORMAT(SUM(CASE 
                        WHEN act_gl_code IN ('3101000','3202000','3203000','3208000','3401200','3402200','3800000','3908000','5101311','5101312','5102132','5102232','5102870',
                        '5102880','5102900','5109300','5506200','5508400','5701200','5704110','5704120','5704220','5705000') 
                        THEN tbl_atc.act_amount_money ELSE 0 END) 
                    - 
                    SUM(CASE 
                        WHEN act_gl_code IN ('4101341','4101800','4102130','4102151','4102152','4102510','4102512','4106100','4107800','4108800','4109100','4109300','4109800','4201100','4201200','4201300','4202100','4202200',
                        '4202800','4203100','4203200','4208000','4300000','4402000','4403120','4403180','4403800','4403810','4405100','4405200','4405201','4405300','4406100','4406500','4407100','4407200','4408100','4408200','4408300',
                        '4408400','4408500','4408600','4408610','4408720','4408730','4408800','4506100','4506200','4508000','4601110','4601122','4601124','4601125','4601126','4601127','4601128','4601210','4701200','4701800','4702800','4704120','4704220','4705100') 
                        THEN tbl_atc.act_amount_money ELSE 0 END),
'N0') AS 'CapitalPreviousYear',
FORMAT(SUM(CASE 
        WHEN act_gl_code IN ('1101100','1121170','1131110','1131130','1131151','1131152','1131153','1131242','1203121','1203122','1283121','1283122','1291131','1291132','1292131','1292132','1293131','1293132',
        '1441200','1441810','1442200','1442400','1442500','1442600','1442700','1442800','1283711','1283712','1203711','1203712','1297111','1297112','1297131','1297132','1361100','1362100','1362310','1362320',
        '1362800','1373300','1373400','1373800','1388100','1388220','1388300','1388800') 
        THEN tbl_atc.act_amount_money ELSE 0 END) 
    - 
    SUM(CASE 
        WHEN act_gl_code IN ('1299131','1299211','1299311','1481120','1481125','1481181','1481220','1481240','1481250','1481260','1481270','1481280') 
        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'All_propertyIPreviousYear',
FORMAT(SUM(CASE 
        WHEN act_gl_code IN ('1203121','1203122','1283121','1283122','1291131','1291132','1292131','1292132','1293131','1293132') 
        THEN tbl_atc.act_amount_money ELSE 0 END), 'N0') AS 'PreviousYearloan_balance99'
FROM tbl_atc
WHERE  year(`act_date`) = '$yearPrevious' AND month(act_date )= '$month_str'"; // Get data for December only

    $resultPrevious = mysqli_query($conn, $sqlPreviousYear);
    if ($resultPrevious) {
        $row2 = mysqli_fetch_assoc($resultPrevious);
        $data[12]['CapitalPreviousYear'] = isset($row2['CapitalPreviousYear']) ? (float)str_replace(',', '', $row2['CapitalPreviousYear']) : 0; // Store only in December
        $data[12]['All_propertyIPreviousYear'] = isset($row2['All_propertyIPreviousYear']) ? (float)str_replace(',', '', $row2['All_propertyIPreviousYear']) : 0; // Store only in December
        $data[12]['PreviousYearloan_balance99'] = isset($row2['PreviousYearloan_balance99']) ? (float)str_replace(',', '', $row2['PreviousYearloan_balance99']) : 0; // Store only in December
    } else {
        error_log("No results found for previous year $yearPrevious for December");
        $data[12]['CapitalPreviousYear'] = 0; // Default to 0
        $data[12]['All_propertyIPreviousYear'] = 0; // Default to 0
        $data[12]['PreviousYearloan_balance99'] = 0; // Default to 0
    }

    // Return data as JSON
    echo json_encode($data);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Year parameters not set.']);
}

mysqli_close($conn);
