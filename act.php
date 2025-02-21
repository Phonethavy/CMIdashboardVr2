<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Data</title>
    <style>
        * {
            font-family: 'Times New Roman', 'Phetsarath OT';
            margin: 0;
            padding: 0;

        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 4%;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;


        }

        th:nth-child(2),
        td:nth-child(2) {
            white-space: nowrap;
            width: auto;
            text-align: left;
        }

        th {
            background-color: #c00;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
        }

        tr:hover {
            background-color: #ddd;
        }

        #loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        #a1 {
            color: black;
            text-decoration: none;
            margin-left: 400px;
        }

        select,
        button {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
        }

        button {
            background-color: #db234e;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #a31a37;
        }

        /* Mobile-specific styles */
        table th {
            text-align: center;
            border-width: 1px;
        }

        h1 {
            text-align: center;
            border-bottom: 5px solid #a31a37;
            display: inline-block;
            width: 100%;
            padding-bottom: 10px;
        }

        .section-header {
            background-color: #cc3333;
            color: white;
            font-weight: bold;
        }

        .approved {
            color: green;
            font-weight: bold;
        }

        .not-approved {
            color: red;
            font-weight: bold;
        }

        .tb1 {
            background-color: #c00;
        }

        .a {
            color: black;
        }

        @media (max-width: 768px) {
            table th {
                font-size: 14px;
                padding: 8px;
            }

            .h3,
            h3 {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            table th {
                font-size: 12px;
                padding: 6px;
            }

            h3 {
                font-size: 0.85rem;

            }
        }

        h3 {
            font-size: 0.85rem;



        }
    </style>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <script>
        window.onload = function() {
            const currentDate1 = new Date();
            const monthNames1 = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            const currentMonth2 = monthNames1[currentDate1.getMonth()];
            const currentYear2 = currentDate1.getFullYear();

            document.getElementById("monthYearHeader").innerText = `${currentMonth2} ${currentYear2}`;
        }
    </script>

    <?php include 'index.php'; ?>
    <div class="container mt-4">
        <h1>ຕົວຊີ້ວັດຄວາມຫມັ້ນຄົງທາງການເງິນ<span id="year-display"></span></h1>

        <div id="loading">Loading data, please wait...</div>

        <table>
            <tr>
                <!-- <th>no</th> -->
                <th>ລາຍການ</th>
                <th>ມາດຕະຖານທີ່ກຳນົດໄວ້</th>
                <th id="monthYearHeader"></th>
                <th>ຄວາມສອດຄ່ອງ</th>
            </tr>
            <tr class="section-header">
                <td style="background-color: #c00;text-align: center;" colspan="4">ໝວດຄວາມພຽງພໍຂອງທຶນ</td>
            </tr>
            <tr>
                
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_1.php"> ອັດຕາສ່ວນທຶນທັງໝົດ / ຊັບສິນທີ່ວາງນ້ຳໜັກຄວາມສ່ຽງ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell">12%</td>
                
                <td id="ratio-value-cell">-</td>
                <td id="status-cell" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_2.php">ອັດຕາສ່ວນທຶນຊັ້ນໜຶ່ງ / ຊັບສີນທີ່ວາງນ້ຳໜັກຄວາມສ່ຽງ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell2">8%</td>
                <td id="ratio-value-cell2">-</td>
                <td id="status-cell2" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_3.php">ອັດຕາສ່ວນຜົນຕອບແທນຈາກທຶນ ROE ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell3">5%</td>
                <td id="ratio-value-cell3">-</td>
                <td id="status-cell3" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_4.php">ອັດຕາສ່ວນຜົນຕອບແທນຈາກຊັບສີນ ROA ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell4">2%</td>
                <td id="ratio-value-cell4">-</td>
                <td id="status-cell4" style="color: black;">-</td>
            </tr>
            <tr class="section-header">
                <td style="text-align: center;" class="td1" colspan="4">ໝວດຄວາມສາມາດໃນການຊຳລະໜີ້</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_5.php">ການກູ້ຢືມ: ການກູ້ຍືມຈາກພາຍນອກທັງໝົດ / ຍອດສີນເຊື່ອທັງໝົດ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell5">30%</td>
                <td id="ratio-value-cell5">-</td>
                <td id="status-cell5" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_6.php">ການລົງທຶນ: ເງິນລົງທືນທັງໝົດ / ທຶນຈົດທະບຽນ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell6">10%</td>
                <td id="ratio-value-cell6">-</td>
                <td id="status-cell6" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_7.php">ອັດຕາສ່ວນການລະດົມເງິນຝາກ (ເງິນຝາກທັງໝົດ / ທືນຊັ້ນໜຶ່ງ ) ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell7">10%</td>
                <td id="ratio-value-cell7">-</td>
                <td id="status-cell7" style="color: black;">-</td>
            </tr>
            <tr class="section-header">
                <td style="text-align: center;" class="td1" colspan="4">ໝວດຄວມາມສາມາດໃນການສ້າງກຳໄລ</td>
            </tr>

            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_8.php">ອັດຕາສ່ວນດອກເບ້ຍສຸດທິ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell8">12%</td>
                <td id="ratio-value-cell8">-</td>
                <td id="status-cell8" style="color: black;">-</td>
            </tr>

            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_9.php">ການກຸ້ມຕົນເອງໃນການດຳເນີນງານ OSS ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell9">100%</td>
                <td id="ratio-value-cell9">-</td>
                <td id="status-cell9" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_10.php">ອັດຕາສ່ວນການລົງທຶນເງິນຝາກທັງໝົດ / ທັງໝົດ ຕ້ອງຫຼາຍກວ່າ</a>
                <td id="goal-cell10">10%</td>
                <td id="ratio-value-cell10">-</td>
                <td id="status-cell10" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_11.php">ອັດຕາສ່ວນເງິນກູ້ທັງໝົດຕໍ່ຊັບສີນທັງໝົດ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell11">80%</td>
                <td id="ratio-value-cell11">-</td>
                <td id="status-cell11" style="color: black;">-</td>
            </tr>
            <tr class="section-header">
                <td style="background-color: #c00; text-align: center;" class="td1" colspan="4">ໝວດສະພາບຄ່ອງ</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_12.php">ສະພາບຄ່ອງ 1: ເງີນສົດໃນມື / ເງີນຝາກທັງໝົດ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell12">1%</td>
                <td id="ratio-value-cell12">-</td>
                <td id="status-cell12" style="color: black;">-</td>
            </tr>

            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_13.php">ສະພາບຄ່ອງ 2: (ເງິນສົດໃນມື+ເງິນຝາກຢູ່ສະຖາບັນອື່ນ) / ໜີ້ສີນທັງໝົດ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell13">15%</td>
                <td id="ratio-value-cell13">-</td>
                <td id="status-cell13" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_14.php">ອັດຕາສ່ວນຊັບສີນຄ່ອງຕົວ ( ເງິນສົດແລະເງິນທ/ຄ ທີ່ສາມາດຖອນໄດ້ ) / ຊັບສິນທັງໝົດ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell14">10%</td>
                <td id="ratio-value-cell14">-</td>
                <td id="status-cell14" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_15.php">ອັດຕາສ່ວນໜີ້ທວງຍາກ: ເງິນກູ້ຊ້າເກີນ 60ວັນ /ຍອດເງິນກູ້ທັງໝົດ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell15">5%</td>
                <td id="ratio-value-cell15">-</td>
                <td id="status-cell15" style="color: black;">-</td>
            </tr>
            <tr class="section-header">
                <td style="text-align: center;" colspan="4">ໝວດຄຸນນະພາບຄັງເງິນກູ້</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_16.php">ອັດຕາສ່ວນການລ້າງໜີ້ສູນ: ຍອດເງີນກູ້ທີ່ຕິດຕາມນອກຜັງ / ຍອດເງິນກູ້ທັງໝົດສະເລ່ຍ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell16">2%</td>
                <td id="ratio-value-cell16">-</td>
                <td id="status-cell16" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_17.php">ອັດຕາສ່ວນສິນເຊື່ອໃຫ້ແກ່ລູກຄ້າລາຍໃຫຍ່ / ທຶນທັງໝົດ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell17">30%</td>
                <td id="ratio-value-cell17">-</td>
                <td id="status-cell17" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_18.php">ອັດຕາສ່ວນສິນເຊື່ອໃຫ້ແກ່ລູກຄ້າໜຶ່ງລາຍ / ທຶນທັງໝົດ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell18">10%</td>
                <td id="ratio-value-cell18">-</td>
                <td id="status-cell18" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_19.php">ອັດຕາສ່ວນສິນເຊື່ອໃຫ້ແກ່ພາກສ່ວນທີ່ມີສາຍພົວພັນທັງໝົດ / ທຶນທັງໝົດ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell19">5%</td>
                <td id="ratio-value-cell19">-</td>
                <td id="status-cell19" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_20.php">ອັດຕາສ່ວນສິນເຊື່ອໃຫ້ແກ່ພາກສ່ວນທີ່ມີສາຍພົວພັນໜຶ່ງລາຍ / ທຶນທັງໝົດ ຕ້ອງນ້ອຍກວ່າ</a>
                </td>
                <td id="goal-cell20">1%</td>
                <td id="ratio-value-cell20">-</td>
                <td id="status-cell20" style="color: black;">-</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_21.php">ອັດຕາສ່ວນຄວາມພຽງພໍຂອງການຫັກເງິນແຮສິນເຊື່ອທີ່ຖືກຈັດຊັ້ນ / ເງິນແຮທັງໝົດທີ່ຕ້ອງສ້າງຕາມລະບຽບ ຕ້ອງຫຼາຍກວ່າ</a>
                </td>
                <td id="goal-cell21">100%</td>
                <td id="ratio-value-cell21">-</td>
                <td id="status-cell21" style="color: black;">-</td>
            </tr>
            <tr class="section-header">
                <td style="background-color: #c00;text-align: center;" class="td1" colspan="4">ໝວດປະສິດທິພາບການດຳເນີນງານ</td>
            </tr>
            <tr>
                <td><a style="text-decoration:none ;color:rgb(0, 0, 0);" href="cmi_act_22.php">ອັດຕາສ່ວນປະສິດທິພາບດ້ານການດຳເນີນງານ ຕ້ອງນ້ອຍກວ່າ
                    </a>
                </td>
                <td id="goal-cell22">30%</td>
                <td id="ratio-value-cell22">-</td>
                <td id="status-cell22" style="color: black;">-</td>
            </tr>
        </table>

    </div>

    <script>
        function calculate(Capital16, debt2, loans5, assets8, otherAssets10) {
            const denominator = (debt2 * 0.20) + loans5 + assets8 + otherAssets10;
            return denominator ? ((Capital16 / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate2(Capital16, Capital2_16_7, debt2, loans5, assets8, otherAssets10) {
            const denominator = (debt2 * 0.20) + loans5 + assets8 + otherAssets10;
            return denominator ? (((Capital16 - Capital2_16_7) / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate3(result_monthV, CapitalPreviousYear, Capital16, debt2) {
            const denominator = (CapitalPreviousYear + Capital16) / 2;
            return denominator ? ((result_monthV / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate4(result_monthV, All_propertyIPreviousYear, All_propertyI) {
            const denominator = (All_propertyIPreviousYear + All_propertyI) / 2;
            return denominator ? ((result_monthV / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate5(balance2_3, loan_balance99) {
            const denominator = (loan_balance99);
            return denominator ? ((balance2_3 / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate6(otherdept11_4, other15_3, drevaluation16_6) {
            const denominator = (other15_3 - drevaluation16_6);
            return denominator ? ((otherdept11_4 / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate7(deptsentcus12, Capital16, Capital2_16_7) {
            const denominator = (Capital16 - Capital2_16_7);
            return denominator ? ((deptsentcus12 / denominator)).toFixed(2) : "0.00";
        }

        function calculate8(sumloanrate, sumfixesrate, savingrate, sumfix2rate, sumloan, sumfixes) {
            const denominator = (sumloan + sumfixes);
            return denominator ? (((sumloanrate + sumfixesrate) - (savingrate + sumfix2rate)) / denominator * 100).toFixed(2) :
                "0.00";
        }

        function calculate9(Interest1, Fee_income9, Fee_orther15, Interest_expense2_1, Payment_of_fees10_1, administrative_expenses16_1, salary_lousy17, Other_business18, debt_must_be_received19, Profit_tax21_1) {
            const denominator = (Interest_expense2_1 + Payment_of_fees10_1 + administrative_expenses16_1 + salary_lousy17 + Other_business18 + debt_must_be_received19 + Profit_tax21_1);
            return denominator ? (((Interest1 + Fee_income9 + Fee_orther15) / denominator) * 100).toFixed(2) : "0.00";
        }


        function calculate10(assets8, All_propertyI) {
            const denominator = (All_propertyI);
            return denominator ? ((assets8 / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate11(loan_balance99, All_propertyI) {
            const denominator = (All_propertyI);
            return denominator ? ((loan_balance99 / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate12(cash1_1_1, Debt11, deptsentcus12) {
            const denominator = (Debt11 + deptsentcus12);
            return denominator ? ((cash1_1_1 / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate13(All_dept_and_moneyII, cash1_1_1, debt2, Capital16) {
            const denominator = (All_dept_and_moneyII + Capital16);
            return denominator ? (((cash1_1_1 + debt2) / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate14(All_propertyI, cash1_1_1, debt2) {
            const denominator = (All_propertyI);
            return denominator ? (((cash1_1_1 + debt2) / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate15(loan_balanceCDE, loan_balance99) {
            const denominator = (loan_balance99);
            return denominator ? ((loan_balanceCDE / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate16(interest16, outstanding05, outstangding16) {
            const denominator = (outstanding05);
            return denominator ? (((outstangding16 + interest16) / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate17(interest16, outstanding05, outstangding16) {
            const denominator = (outstanding05);
            return denominator ? ((0) * 100).toFixed(2) : "0.00";
        }

        function calculate18(Capital16, outstanding05, Quantity) {
                const denominator = (Capital16);
                return denominator ? (((outstanding05 / Quantity) / denominator) * 100).toFixed(2) : "";

            }

        function calculate19(interest16, outstanding05, outstangding16) {
            const denominator = (outstanding05);
            return denominator ? (((0) / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate20(interest16, outstanding05, outstangding16) {
            const denominator = (outstanding05);
            return denominator ? (((0) / denominator) * 100).toFixed(2) : "0.00";
        }

        function calculate21(provisionA, provisionB, provisionC, provisionD, provisionE) {
            const denominator = ((provisionA * (1 / 100)) + (provisionB * (5 / 100)) + (provisionC * (25 / 100)) + (provisionD * (50 / 100)) + (provisionE * (100 / 100)));
            return denominator ? (((provisionA * (1 / 100)) + (provisionB * (5 / 100)) + (provisionC * (25 / 100)) + (provisionD * (50 / 100) + (provisionE * (100 / 100))))) / denominator * 100 .toFixed(2) : "0.00";
        }

        function calculate22(expensesGeneral16_2, expenseslousy17, expensesOther18, loan_balance99, PreviousYearloan_balance99, currentMonth) {
            // แปลงค่าให้เป็นตัวเลข และป้องกันค่า undefined หรือ NaN
            expensesGeneral16_2 = parseFloat(expensesGeneral16_2) || 0;
            expenseslousy17 = parseFloat(expenseslousy17) || 0;
            expensesOther18 = parseFloat(expensesOther18) || 0;
            loan_balance99 = parseFloat(loan_balance99) || 0;
            PreviousYearloan_balance99 = parseFloat(PreviousYearloan_balance99) || 0;
            currentMonth = parseInt(currentMonth) || 1; // ป้องกัน currentMonth เป็น 0

            // คำนวณตัวหาร: ค่าเฉลี่ยระหว่าง loan_balance99 และ PreviousYearloan_balance99
            const denominator = (PreviousYearloan_balance99 + loan_balance99) / 2;

            // คำนวณตัวเศษ: รวมค่าใช้จ่ายและคูณ 12 หารด้วยเดือนปัจจุบัน
            const totalExpenses = ((expensesGeneral16_2 + expenseslousy17 + expensesOther18) * 12 / currentMonth);

            // ตรวจสอบว่าตัวหารไม่เป็น 0 หรือ NaN
            return denominator > 0 ? ((totalExpenses / denominator) * 100).toFixed(2) : "0.00";
        }

        function checkAchievementGreaterThanOrEqual(ratio, goal) {
            return {
                statusText: ratio >= goal ? "ປະຕິບັດໄດ້" : "ປະຕິບັດບໍ່ໄດ້",
                statusColor: ratio >= goal ? "green" : "red"
            };
        }

        function checkAchievementLessThan(ratio, goal) {
            return {
                statusText: ratio < goal ? "ປະຕິບັດໄດ້" : "ປະຕິບັດບໍ່ໄດ້",
                statusColor: ratio < goal ? "green" : "red"
            };
        }

        function getMonthName(monthIndex) {
            const months = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            return months[monthIndex];
        }
        const currentMonth = new Date().getMonth() + 1; // ได้ค่า 1-12
        const previousMonth = currentMonth === 2 ? 1 : ((currentMonth + 10) % 12) + 1;

        console.log(`Current Month: ${currentMonth}, Previous Month: ${previousMonth}`);


        const currentYear = new Date().getFullYear();



        $('#year-display').text(`${currentYear}`);

        $.ajax({
            url: `act_db.php?year1=${currentYear}&year2=${currentYear - 1}&month=${previousMonth}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#loading').hide();
                console.log("Previous Month:", previousMonth);
                if (!response || !response[previousMonth]) {
                    alert('Data for the latest month not found.');
                    return;
                }

                const data = response[previousMonth];

                // Example: Calculating ratio values
                const ratioValue1 = calculate(data.Capital16, data.debt2, data.loans5, data.assets8, data.otherAssets10) + '%';
                const ratioValue2 = calculate2(data.Capital16, data.Capital2_16_7, data.debt2, data.loans5, data.assets8, data.otherAssets10) + '%';
                const ratioValue3 = calculate3(data.result_monthV, data.CapitalPreviousYear, data.Capital16, data.debt2)+ '%';
                const ratioValue4 = calculate4(data.result_monthV, data.All_propertyIPreviousYear, data.All_propertyI)+ '%';
                const ratioValue5 = calculate5(data.balance2_3, data.loan_balance99)+ '%';
                const ratioValue6 = calculate6(data.otherdept11_4, data.other15_3, data.drevaluation16_6);
                const ratioValue7 = calculate7(data.deptsentcus12, data.Capital16, data.Capital2_16_7);
                const ratioValue8 = calculate8(data.sumloanrate, data.sumfixesrate, data.savingrate, data.sumfix2rate, data.sumloan, data.sumfixes)+ '%';
                const ratioValue9 = calculate9(data.Interest1, data.Fee_income9, data.Fee_orther15, data.Interest_expense2_1, data.Payment_of_fees10_1, data.administrative_expenses16_1, data.salary_lousy17, data.Other_business18, data.debt_must_be_received19, data.Profit_tax21_1)+ '%';
                const ratioValue10 = calculate10(data.assets8, data.All_propertyI)+ '%';
                const ratioValue11 = calculate11(data.loan_balance99, data.All_propertyI)+ '%';
                const ratioValue12 = calculate12(data.cash1_1_1, data.Debt11, data.deptsentcus12)+ '%';
                const ratioValue13 = calculate13(data.All_dept_and_moneyII, data.cash1_1_1, data.debt2, data.Capital16)+ '%';
                const ratioValue14 = calculate14(data.All_propertyI, data.cash1_1_1, data.debt2)+ '%';
                const ratioValue15 = calculate15(data.loan_balanceCDE, data.loan_balance99)+ '%';
                const ratioValue16 = calculate16(data.interest16, data.outstanding05, data.outstangding16)+ '%';
                const ratioValue17 = calculate17(data.interest16, data.outstanding05, data.outstangding16)+ '%';
                const ratioValue18 = calculate18(data.Capital16, data.outstanding05, data.Quantity)+ '%';
                const ratioValue19 = calculate19(data.interest16, data.outstanding05, data.outstangding16)+ '%';
                const ratioValue20 = calculate20(data.interest16, data.outstanding05, data.outstangding16)+ '%';
                const ratioValue21 = calculate21(data.provisionA, data.provisionB, data.provisionC, data.provisionD, data.provisionE);
                const ratioValue22 = calculate22(
                    data.expensesGeneral16_2,
                    data.expenseslousy17,
                    data.expensesOther18,
                    data.loan_balance99,
                    data.PreviousYearloan_balance99,
                    data.currentMonth
                )+ '%';

                // Update the table with calculated results
                $('#ratio-value-cell').text(ratioValue1);
                $('#status-cell').text(checkAchievementGreaterThanOrEqual(ratioValue1, 12).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue1, 12).statusColor);

                $('#ratio-value-cell2').text(ratioValue2);
                $('#status-cell2').text(checkAchievementGreaterThanOrEqual(ratioValue2, 8).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue2, 8).statusColor);

                $('#ratio-value-cell3').text(ratioValue3);
                $('#status-cell3').text(checkAchievementGreaterThanOrEqual(ratioValue3, 5).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue3, 5).statusColor);

                $('#ratio-value-cell4').text(ratioValue4);
                $('#status-cell4').text(checkAchievementGreaterThanOrEqual(ratioValue4, 2).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue4, 2).statusColor);

                $('#ratio-value-cell5').text(ratioValue5);
                $('#status-cell5').text(checkAchievementGreaterThanOrEqual(ratioValue5, 30).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue5, 30).statusColor);

                $('#ratio-value-cell6').text(ratioValue6);
                $('#status-cell6').text(checkAchievementGreaterThanOrEqual(ratioValue6, 10).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue6, 10).statusColor);

                $('#ratio-value-cell7').text(ratioValue7);
                $('#status-cell7').text(checkAchievementGreaterThanOrEqual(ratioValue7, 10).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue7, 12).statusColor);

                $('#ratio-value-cell8').text(ratioValue8);
                $('#status-cell8').text(checkAchievementGreaterThanOrEqual(ratioValue8, 12).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue8, 12).statusColor);

                $('#ratio-value-cell9').text(ratioValue9);
                $('#status-cell9').text(checkAchievementGreaterThanOrEqual(ratioValue9, 100).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue9, 100).statusColor);

                $('#ratio-value-cell10').text(ratioValue10);
                $('#status-cell10').text(checkAchievementGreaterThanOrEqual(ratioValue10, 10).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue10, 10).statusColor);

                $('#ratio-value-cell11').text(ratioValue11);
                $('#status-cell11').text(checkAchievementGreaterThanOrEqual(ratioValue11, 80).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue11, 80).statusColor);

                $('#ratio-value-cell12').text(ratioValue12);
                $('#status-cell12').text(checkAchievementGreaterThanOrEqual(ratioValue12, 1).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue12, 1).statusColor);

                $('#ratio-value-cell13').text(ratioValue13);
                $('#status-cell13').text(checkAchievementGreaterThanOrEqual(ratioValue13, 15).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue13, 15).statusColor);

                $('#ratio-value-cell14').text(ratioValue14);
                $('#status-cell14').text(checkAchievementGreaterThanOrEqual(ratioValue14, 10).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue14, 10).statusColor);

                $('#ratio-value-cell15').text(ratioValue15);
                $('#status-cell15').text(checkAchievementGreaterThanOrEqual(ratioValue15, 5).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue15, 5).statusColor);

                $('#ratio-value-cell16').text(ratioValue16);
                $('#status-cell16').text(checkAchievementLessThan(ratioValue16, 2).statusText).css('color', checkAchievementLessThan(ratioValue16, 2).statusColor);

                $('#ratio-value-cell17').text(ratioValue17);
                $('#status-cell17').text(checkAchievementGreaterThanOrEqual(ratioValue17, 30).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue17, 30).statusColor);

                $('#ratio-value-cell18').text(ratioValue18);
                $('#status-cell18').text(checkAchievementGreaterThanOrEqual(ratioValue18, 10).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue18, 10).statusColor);

                $('#ratio-value-cell19').text(ratioValue19);
                $('#status-cell19').text(checkAchievementGreaterThanOrEqual(ratioValue19, 5).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue19, 5).statusColor);

                $('#ratio-value-cell20').text(ratioValue20);
                $('#status-cell20').text(checkAchievementGreaterThanOrEqual(ratioValue20, 1).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue20, 1).statusColor);

                $('#ratio-value-cell21').text(ratioValue21);
                $('#status-cell21').text(checkAchievementGreaterThanOrEqual(ratioValue21, 100).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue21, 100).statusColor);

                $('#ratio-value-cell22').text(ratioValue22);
                $('#status-cell22').text(checkAchievementGreaterThanOrEqual(ratioValue22, 30).statusText).css('color', checkAchievementGreaterThanOrEqual(ratioValue22, 30).statusColor);
            }
        });
    </script>
</body>

</html>