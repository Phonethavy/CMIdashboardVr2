<!DOCTYPE html>
<html lang="lo">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMIMFI Dashboard</title>
    <link rel="stylesheet" href="../css/service.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            font-size: 16px;
        }

        th,
        td {
            padding: 10px;
            text-align: right;
        }

        th {
            background-color: #BA1C1C;
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

        .ths {
            width: 100%;
            padding: 8px;
            background-color: #BA1C1C;
            color: white;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .hidden-row {
            display: none;
        }

        .toggle-btn {
            cursor: pointer;
            font-size: 18px;
            color: #db234e;
            background: none;
            border: none;
        }

        .gap-2 {
            gap: .5rem !important;
            margin: 16px;
        }
    </style>
</head>
<?php include("../navbar/header.php"); ?>

<body>
    <!-- Search Form -->
    <form id="searchForm" class="d-flex justify-content-center align-items-center gap-2" action="service.php" method="get">
        <label for="startdate" class="fw-bold">Start</label>
        <input type="date" id="startdate" name="startdate" class="form-control form-control-sm w-auto" required>
        <label for="enddate" class="fw-bold">To</label>
        <input type="date" id="enddate" name="enddate" class="form-control form-control-sm w-auto" required>

        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    <div class="container mt-4">
        
        <main>
            <table style="border-width: 0.1px;" class="table1" id="data-table">
                <thead>
                    <tr id="header-row-3">
                        <th scope="col" rowspan="3">ຊື່</th>
                        <th scope="col" colspan="3">CPS</th>
                        <th scope="col" colspan="3">SLV</th>
                        <th scope="col" colspan="3">SK</th>
                        <th scope="col" colspan="3">ATP</th>
                    </tr>
                    <tr id="header-row-3">
                        <th>ເປົ້າຫມາຍ</th>
                        <th>ຜົນງານ</th>
                        <th>ທຽບເປົ້າຫມາຍ</th>
                        <th>ເປົ້າຫມາຍ</th>
                        <th>ຜົນງານ</th>
                        <th>ທຽບເປົ້າຫມາຍ</th>
                        <th>ເປົ້າຫມາຍ</th>
                        <th>ຜົນງານ</th>
                        <th>ທຽບເປົ້າຫມາຍ</th>
                        <th>ເປົ້າຫມາຍ</th>
                        <th>ຜົນງານ</th>
                        <th>ທຽບເປົ້າຫມາຍ</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><button class="toggle-btn" onclick="toggleRows()"><i class="fas fa-pen"></i></button><a href="../page2_cmi_sv/sv1.php"> ຍອດເຫຼືອໜ່ວຍທັງໝົດ</a></td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total16"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total14"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total17"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total15"><span></span></td>
                        <td id=""><span></span></td>
                    </tr>

                    <!-- Hidden rows for more details -->
                    <tr id="1" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ A</td>
                        <td><span></span></td>
                        <td id="count_type1_16A"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_14A"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_17A"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_15A"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="2" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ B</td>
                        <td><span></span></td>
                        <td id="count_type1_16B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_14B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_17B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_15B"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="3" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ C</td>
                        <td><span></span></td>
                        <td id="count_type1_16C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_14C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_17C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_15C"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="4" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ D</td>
                        <td><span></span></td>
                        <td id="count_type1_16D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_14D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_17D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type1_15D"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="5" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍຕັ້ງໃໝ່ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_com_create_type1_16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_com_create_type1_14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_com_create_type1_17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_com_create_type1_15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="6" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍຢ້ຽມຍາມ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_actity_type1_16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_actity_type1_14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_actity_type1_17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_actity_type1_15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><button class="toggle-btn" onclick="toggleRows2()"><i class="fas fa-pen"></i></button><a href="../page2_cmi_sv/sv2.php">ຍອດເຫຼືອສູນທັງໝົດ</a> </td>
                        <td id=""><span></span></td>
                        <td id="count_type2_total16"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type2_total14"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type2_total17"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type2_total15"><span></span></td>
                        <td id=""><span></span></td>
                    </tr>

                    <!-- Hidden rows for more details -->
                    <tr id="7" class="hidden-row">
                        <td>ຈຳນວນສູນເກຣດ A</td>
                        <td><span></span></td>
                        <td id="count_type2_16A"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_14A"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_17A"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_15A"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="8" class="hidden-row">
                        <td>ຈຳນວນສູນເກຣດ B</td>
                        <td><span></span></td>
                        <td id="count_type2_16B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_14B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_17B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_15B"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="9" class="hidden-row">
                        <td>ຈຳນວນສູນເກຣດ C</td>
                        <td><span></span></td>
                        <td id="count_type2_16C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_14C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_17C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_15C"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="10" class="hidden-row">
                        <td>ຈຳນວນສູນເກຣດ D</td>
                        <td><span></span></td>
                        <td id="count_type2_16D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_14D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_17D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_type2_15D"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="11" class="hidden-row">
                        <td>ຈຳນວນສູນຕັ້ງໃໝ່ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_com_create_type2_16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_com_create_type2_14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_com_create_type2_17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_com_create_type2_15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="12" class="hidden-row">
                        <td>ຈຳນວນສູນຢ້ຽມຍາມ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_actity_type2_16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_actity_type2_14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_actity_type2_17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_actity_type2_15"><span></span></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><button class="toggle-btn" onclick="toggleRows3()"><i class="fas fa-pen"></i></button>ຍອດເຫຼືອຜູ້ເບິ່ງແຍງສູນ</td>
                        <td id=""><span></span></td>
                        <td id="count_toltal16"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_toltal14"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_toltal17"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_toltal15"><span></span></td>
                        <td id=""><span></span></td>
                    </tr>

                    <!-- Hidden rows for more details -->
                    <tr id="13" class="hidden-row">
                        <td>ຈຳນວນ A ທີ່ເຄື່ອນໄຫວ </td>
                        <td><span></span></td>
                        <td id="count_agent_A16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_A14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_A17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_A15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="14" class="hidden-row">
                        <td>ຈຳນວນ B ທີ່ເຄື່ອນໄຫວ</td>
                        <td><span></span></td>
                        <td id="count_agent_B16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_B14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_B17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_B15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="15" class="hidden-row">
                        <td>ຈຳນວນ B ທີ່ຫາໄດ້ໃໝ່ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_agent_B16_new"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_B14_new"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_B17_new"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_agent_B15_new"><span></span></td>
                        <td></td>
                    </tr>
                    <tr><td><h4>ຂໍ້ມູນລູກຄ້າເງິນກູ້</h4></td></tr>
                    <tr>
                        <td><button class="toggle-btn" onclick="toggleRows4()"><i class="fas fa-pen"></i></button>ຍອດເຫຼືອລູກຄ້າທັງໝົດ</td>
                        <td><span></span></td>
                        <td id="count_cus_remain16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_cus_remain14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_cus_remain17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_cus_remain15"><span></span></td>
                        <td></td>
                    </tr>

                    <!-- Hidden rows for more details -->
                    <tr id="16" class="hidden-row">
                        <td>ຈຳນວນລູກຄ້າທີ່ເປີດບັນຊີ (ເດືອນ) </td>
                        <td><span></span></td>
                        <td id="row_count_open_loan_new16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="row_count_open_loan_new14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="row_count_open_loan_new17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="row_count_open_loan_new15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="17" class="hidden-row">
                        <td>ຈຳນວນລູກຄ້າໃໝ່ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="new_status_count16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="new_status_count14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="new_status_count17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="new_status_count15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="18" class="hidden-row">
                        <td>ຈຳນວນລູກຄ້າກັບຄືນ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="customer_return_count16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="customer_return_count14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="customer_return_count17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="customer_return_count15"><span></span></td>
                        <td></td>
                    </tr>

                    <tr id="19" class="hidden-row">
                        <td>ຈຳນວນລູກຄ້າປັບໂຄງສ້າງ (ເດືອນ) </td>
                        <td><span></span></td>
                        <td id="owe_count16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="owe_count14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="owe_count17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="owe_count15"><span></span></td>
                        <td></td>
                    </tr>

                    <tr id="20" class="hidden-row">
                        <td>ຈຳນວນລູກຄ້າປິດບັນຊີ (ເດືອນ) </td>
                        <td><span></span></td>
                        <td id="filtered_province_closed_count16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="filtered_province_closed_count14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="filtered_province_closed_count17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="filtered_province_closed_count15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="21" class="hidden-row">
                        <td>ຈຳນວນລູກຄ້າໝົດສັນຍາ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_16_out_ct"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_14_out_ct"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_17_out_ct"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="count_15_out_ct"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="" >
                        <td><button class="toggle-btn" onclick="toggleRows5()"><i class="fas fa-pen"></i></button>ຂໍ້ມູນເງິນກູ້</td>
                    </tr>
                    <tr id="22" class="hidden-row">
                        <td>ຍອດເຫຼືອລູກຄ້າທັງໝົດ</td>
                        <td><span></span></td>
                        <td id="loan_balance16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="loan_balance14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="loan_balance17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="loan_balance15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="23" class="hidden-row">
                        <td>ຈຳນວນເງິນທີ່ສະເໜີກູ້ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="Offer_loan16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="Offer_loan14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="Offer_loan17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="Offer_loan15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="24" class="hidden-row">
                        <td>ຈຳນວນເງິນທີ່ເບີກຈ່າຍ (ເດືອນ) </td>
                        <td><span></span></td>
                        <td id="Disbursed_money16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="Disbursed_money14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="Disbursed_money17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="Disbursed_money15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="25" class="hidden-row">
                        <td>ຈຳນວນເງິນທີ່ເບີກຈ່າຍໃຫ້ ລູກຄ້າໃໝ່/ກັບຄືນ (ເດືອນ) </td>
                        <td><span></span></td>
                        <td id="sum_loan_appointment_offer_return_and_new16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="sum_loan_appointment_offer_return_and_new14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="sum_loan_appointment_offer_return_and_new17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="sum_loan_appointment_offer_return15_and_new15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="26" class="hidden-row">
                        <td>ຈຳນວນເງິນທີ່ເບີກ ຈ່າຍເພື່ອປັບໂຄງສ້າງ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="sum_loan_appointment_offer_owe16"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="sum_loan_appointment_offer_owe14"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="sum_loan_appointment_offer_owe17"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="sum_loan_appointment_offer_owe15"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="27" class="hidden-row">
                        <td>ຊຳລະຊັ້ນA & B (ເດືອນ) </td>
                        <td><span></span></td>
                        <td id="total_pay_amnt_16A_B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_14A_B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_17A_B"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_15A_B"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="28" class="hidden-row">
                        <td>ຈຳນວນເງິນຊຳລະ PAR60+ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="total_pay_amnt_par6016"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_par6014"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_par6017"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_par6015"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="29" class="hidden-row">
                        <td>ຈຳນວນເງິນຊຳລະ C (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="total_pay_amnt_16C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_14C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_17C"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_15C"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="30" class="hidden-row">
                        <td>ຈຳນວນເງິນຊຳລະ D (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="total_pay_amnt_16D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_14D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_17D"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_15D"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="31" class="hidden-row">
                        <td>ຈຳນວນເງິນຊຳລະ E (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="total_pay_amnt_14E"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_15E"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_16E"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_17E"><span></span></td>
                        <td></td>
                    </tr>
                    <tr id="32" class="hidden-row">
                        <td>ຈຳນວນເງິນຊຳລະW/O (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="total_pay_amnt_16WF"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_14WF"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_17WF"><span></span></td>
                        <td></td>
                        <td></td>
                        <td id="total_pay_amnt_15WF"><span></span></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </main>

        <!-- Script Section -->
        <script>
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const params = new URLSearchParams(formData).toString();

                fetch('../ajx_json/sv_db.php?' + params)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            document.querySelector('#count_type1_total16 span').textContent = (data[0].count_type1_total16 || "0").toLocaleString();
                            document.querySelector('#count_type1_total15 span').textContent = (data[0].count_type1_total15 || "0").toLocaleString();
                            document.querySelector('#count_type1_total14 span').textContent = (data[0].count_type1_total14 || "0").toLocaleString();
                            document.querySelector('#count_type1_total17 span').textContent = (data[0].count_type1_total17 || "0").toLocaleString();

                            document.querySelector('#count_type1_16A span').textContent = (data[0].count_type1_16A || "0").toLocaleString();
                            document.querySelector('#count_type1_14A span').textContent = (data[0].count_type1_14A || "0").toLocaleString();
                            document.querySelector('#count_type1_15A span').textContent = (data[0].count_type1_15A || "0").toLocaleString();
                            document.querySelector('#count_type1_17A span').textContent = (data[0].count_type1_17A || "0").toLocaleString();

                            document.querySelector('#count_type1_16B span').textContent = (data[0].count_type1_16B || "0").toLocaleString();
                            document.querySelector('#count_type1_14B span').textContent = (data[0].count_type1_14B || "0").toLocaleString();
                            document.querySelector('#count_type1_15B span').textContent = (data[0].count_type1_15B || "0").toLocaleString();
                            document.querySelector('#count_type1_17B span').textContent = (data[0].count_type1_17B || "0").toLocaleString();

                            document.querySelector('#count_type1_16C span').textContent = (data[0].count_type1_16C || "0").toLocaleString();
                            document.querySelector('#count_type1_14C span').textContent = (data[0].count_type1_14C || "0").toLocaleString();
                            document.querySelector('#count_type1_15C span').textContent = (data[0].count_type1_15C || "0").toLocaleString();
                            document.querySelector('#count_type1_17C span').textContent = (data[0].count_type1_17C || "0").toLocaleString();

                            document.querySelector('#count_type1_16D span').textContent = (data[0].count_type1_16D || "0").toLocaleString();
                            document.querySelector('#count_type1_14D span').textContent = (data[0].count_type1_14D || "0").toLocaleString();
                            document.querySelector('#count_type1_15D span').textContent = (data[0].count_type1_15D || "0").toLocaleString();
                            document.querySelector('#count_type1_17D span').textContent = (data[0].count_type1_17D || "0").toLocaleString();

                            document.querySelector('#count_actity_type1_14 span').textContent = (data[0].count_actity_type1_14 || "0").toLocaleString();
                            document.querySelector('#count_actity_type1_15 span').textContent = (data[0].count_actity_type1_15 || "0").toLocaleString();
                            document.querySelector('#count_actity_type1_16 span').textContent = (data[0].count_actity_type1_16 || "0").toLocaleString();
                            document.querySelector('#count_actity_type1_17 span').textContent = (data[0].count_actity_type1_17 || "0").toLocaleString();

                            document.querySelector('#count_com_create_type1_14 span').textContent = (data[0].count_com_create_type1_14 || "0").toLocaleString();
                            document.querySelector('#count_com_create_type1_15 span').textContent = (data[0].count_com_create_type1_15 || "0").toLocaleString();
                            document.querySelector('#count_com_create_type1_16 span').textContent = (data[0].count_com_create_type1_16 || "0").toLocaleString();
                            document.querySelector('#count_com_create_type1_17 span').textContent = (data[0].count_com_create_type1_17 || "0").toLocaleString();



                            document.querySelector('#count_type2_total16 span').textContent = (data[0].count_type2_total16 || "0").toLocaleString();
                            document.querySelector('#count_type2_total15 span').textContent = (data[0].count_type2_total15 || "0").toLocaleString();
                            document.querySelector('#count_type2_total14 span').textContent = (data[0].count_type2_total14 || "0").toLocaleString();
                            document.querySelector('#count_type2_total17 span').textContent = (data[0].count_type2_total17 || "0").toLocaleString();

                            document.querySelector('#count_type2_16A span').textContent = (data[0].count_type2_16A || "0").toLocaleString();
                            document.querySelector('#count_type2_14A span').textContent = (data[0].count_type2_14A || "0").toLocaleString();
                            document.querySelector('#count_type2_15A span').textContent = (data[0].count_type2_15A || "0").toLocaleString();
                            document.querySelector('#count_type2_17A span').textContent = (data[0].count_type2_17A || "0").toLocaleString();

                            document.querySelector('#count_type2_16B span').textContent = (data[0].count_type2_16B || "0").toLocaleString();
                            document.querySelector('#count_type2_14B span').textContent = (data[0].count_type2_14B || "0").toLocaleString();
                            document.querySelector('#count_type2_15B span').textContent = (data[0].count_type2_15B || "0").toLocaleString();
                            document.querySelector('#count_type2_17B span').textContent = (data[0].count_type2_17B || "0").toLocaleString();

                            document.querySelector('#count_type2_16C span').textContent = (data[0].count_type2_16C || "0").toLocaleString();
                            document.querySelector('#count_type2_14C span').textContent = (data[0].count_type2_14C || "0").toLocaleString();
                            document.querySelector('#count_type2_15C span').textContent = (data[0].count_type2_15C || "0").toLocaleString();
                            document.querySelector('#count_type2_17C span').textContent = (data[0].count_type2_17C || "0").toLocaleString();

                            document.querySelector('#count_type2_16D span').textContent = (data[0].count_type2_16D || "0").toLocaleString();
                            document.querySelector('#count_type2_14D span').textContent = (data[0].count_type2_14D || "0").toLocaleString();
                            document.querySelector('#count_type2_15D span').textContent = (data[0].count_type2_15D || "0").toLocaleString();
                            document.querySelector('#count_type2_17D span').textContent = (data[0].count_type2_17D || "0").toLocaleString();

                            document.querySelector('#count_actity_type2_14 span').textContent = (data[0].count_actity_type2_14 || "0").toLocaleString();
                            document.querySelector('#count_actity_type2_15 span').textContent = (data[0].count_actity_type2_15 || "0").toLocaleString();
                            document.querySelector('#count_actity_type2_16 span').textContent = (data[0].count_actity_type2_16 || "0").toLocaleString();
                            document.querySelector('#count_actity_type2_17 span').textContent = (data[0].count_actity_type2_17 || "0").toLocaleString();

                            document.querySelector('#count_com_create_type2_14 span').textContent = (data[0].count_com_create_type2_14 || "0").toLocaleString();
                            document.querySelector('#count_com_create_type2_15 span').textContent = (data[0].count_com_create_type2_15 || "0").toLocaleString();
                            document.querySelector('#count_com_create_type2_16 span').textContent = (data[0].count_com_create_type2_16 || "0").toLocaleString();
                            document.querySelector('#count_com_create_type2_17 span').textContent = (data[0].count_com_create_type2_17 || "0").toLocaleString();

                            document.querySelector('#count_agent_A14 span').textContent = (data[0].count_agent_A14 || "0").toLocaleString();
                            document.querySelector('#count_agent_A15 span').textContent = (data[0].count_agent_A15 || "0").toLocaleString();
                            document.querySelector('#count_agent_A16 span').textContent = (data[0].count_agent_A16 || "0").toLocaleString();
                            document.querySelector('#count_agent_A17 span').textContent = (data[0].count_agent_A17 || "0").toLocaleString();

                            document.querySelector('#count_agent_B14 span').textContent = (data[0].count_agent_B14 || "0").toLocaleString();
                            document.querySelector('#count_agent_B15 span').textContent = (data[0].count_agent_B15 || "0").toLocaleString();
                            document.querySelector('#count_agent_B16 span').textContent = (data[0].count_agent_B16 || "0").toLocaleString();
                            document.querySelector('#count_agent_B17 span').textContent = (data[0].count_agent_B17 || "0").toLocaleString();

                            document.querySelector('#count_toltal14 span').textContent = (data[0].count_toltal14 || "0").toLocaleString();
                            document.querySelector('#count_toltal15 span').textContent = (data[0].count_toltal15 || "0").toLocaleString();
                            document.querySelector('#count_toltal16 span').textContent = (data[0].count_toltal16 || "0").toLocaleString();
                            document.querySelector('#count_toltal17 span').textContent = (data[0].count_toltal17 || "0").toLocaleString();

                            document.querySelector('#count_agent_B14_new span').textContent = (data[0].count_agent_B14_new || "0").toLocaleString();
                            document.querySelector('#count_agent_B15_new span').textContent = (data[0].count_agent_B15_new || "0").toLocaleString();
                            document.querySelector('#count_agent_B16_new span').textContent = (data[0].count_agent_B16_new || "0").toLocaleString();
                            document.querySelector('#count_agent_B17_new span').textContent = (data[0].count_agent_B17_new || "0").toLocaleString();


                            document.querySelector('#new_status_count14 span').textContent = (data[0].new_status_count14 || "0").toLocaleString();
                            document.querySelector('#new_status_count15 span').textContent = (data[0].new_status_count15 || "0").toLocaleString();
                            document.querySelector('#new_status_count16 span').textContent = (data[0].new_status_count16 || "0").toLocaleString();
                            document.querySelector('#new_status_count17 span').textContent = (data[0].new_status_count17 || "0").toLocaleString();

                            document.querySelector('#customer_return_count14 span').textContent = (data[0].customer_return_count14 || "0").toLocaleString();
                            document.querySelector('#customer_return_count15 span').textContent = (data[0].customer_return_count15 || "0").toLocaleString();
                            document.querySelector('#customer_return_count16 span').textContent = (data[0].customer_return_count16 || "0").toLocaleString();
                            document.querySelector('#customer_return_count17 span').textContent = (data[0].customer_return_count17 || "0").toLocaleString();

                            document.querySelector('#owe_count14 span').textContent = (data[0].owe_count14 || "0").toLocaleString();
                            document.querySelector('#owe_count15 span').textContent = (data[0].owe_count15 || "0").toLocaleString();
                            document.querySelector('#owe_count16 span').textContent = (data[0].owe_count16 || "0").toLocaleString();
                            document.querySelector('#owe_count17 span').textContent = (data[0].owe_count17 || "0").toLocaleString();

                            document.querySelector('#row_count_open_loan_new14 span').textContent = (data[0].row_count_open_loan_new14 || "0").toLocaleString();
                            document.querySelector('#row_count_open_loan_new15 span').textContent = (data[0].row_count_open_loan_new15 || "0").toLocaleString();
                            document.querySelector('#row_count_open_loan_new16 span').textContent = (data[0].row_count_open_loan_new16 || "0").toLocaleString();
                            document.querySelector('#row_count_open_loan_new17 span').textContent = (data[0].row_count_open_loan_new17 || "0").toLocaleString();


                            document.querySelector('#count_cus_remain14 span').textContent = (data[0].count_cus_remain14 || "0").toLocaleString();
                            document.querySelector('#count_cus_remain15 span').textContent = (data[0].count_cus_remain15 || "0").toLocaleString();
                            document.querySelector('#count_cus_remain16 span').textContent = (data[0].count_cus_remain16 || "0").toLocaleString();
                            document.querySelector('#count_cus_remain17 span').textContent = (data[0].count_cus_remain17 || "0").toLocaleString();

                            document.querySelector('#filtered_province_closed_count14 span').textContent = (data[0].filtered_province_closed_count[14] || "0").toLocaleString();
                            document.querySelector('#filtered_province_closed_count15 span').textContent = (data[0].filtered_province_closed_count[15] || "0").toLocaleString();
                            document.querySelector('#filtered_province_closed_count16 span').textContent = (data[0].filtered_province_closed_count[16] || "0").toLocaleString();
                            document.querySelector('#filtered_province_closed_count17 span').textContent = (data[0].filtered_province_closed_count[17] || "0").toLocaleString();
                          

                            document.querySelector('#count_14_out_ct span').textContent = (data[0].count_14_out_ct || "0").toLocaleString();
                            document.querySelector('#count_15_out_ct span').textContent = (data[0].count_15_out_ct || "0").toLocaleString();
                            document.querySelector('#count_16_out_ct span').textContent = (data[0].count_16_out_ct || "0").toLocaleString();
                            document.querySelector('#count_17_out_ct span').textContent = (data[0].count_17_out_ct || "0").toLocaleString();

                            document.querySelector('#loan_balance14 span').textContent = (data[0].loan_balance14 || "0").toLocaleString();
                            document.querySelector('#loan_balance15 span').textContent = (data[0].loan_balance15 || "0").toLocaleString();
                            document.querySelector('#loan_balance16 span').textContent = (data[0].loan_balance16 || "0").toLocaleString();
                            document.querySelector('#loan_balance17 span').textContent = (data[0].loan_balance17 || "0").toLocaleString();

                            document.querySelector('#Offer_loan16 span').textContent = (data[0].Offer_loan16 || "0").toLocaleString();
                            document.querySelector('#Offer_loan15 span').textContent = (data[0].Offer_loan15 || "0").toLocaleString();
                            document.querySelector('#Offer_loan14 span').textContent = (data[0].Offer_loan14 || "0").toLocaleString();
                            document.querySelector('#Offer_loan17 span').textContent = (data[0].Offer_loan17 || "0").toLocaleString();

                            document.querySelector('#Disbursed_money14 span').textContent = (data[0].Disbursed_money14 || "0").toLocaleString();
                            document.querySelector('#Disbursed_money15 span').textContent = (data[0].Disbursed_money15 || "0").toLocaleString();
                            document.querySelector('#Disbursed_money16 span').textContent = (data[0].Disbursed_money16 || "0").toLocaleString();
                            document.querySelector('#Disbursed_money17 span').textContent = (data[0].Disbursed_money17 || "0").toLocaleString();

                            document.querySelector('#sum_loan_appointment_offer_return_and_new14 span').textContent = (data[0].sum_loan_appointment_offer_return_and_new14 || "0").toLocaleString();
                            document.querySelector('#sum_loan_appointment_offer_return15_and_new15 span').textContent = (data[0].sum_loan_appointment_offer_return15_and_new15 || "0").toLocaleString();
                            document.querySelector('#sum_loan_appointment_offer_return_and_new16 span').textContent = (data[0].sum_loan_appointment_offer_return_and_new16 || "0").toLocaleString();
                            document.querySelector('#sum_loan_appointment_offer_return_and_new17 span').textContent = (data[0].sum_loan_appointment_offer_return_and_new17 || "0").toLocaleString();

                            document.querySelector('#sum_loan_appointment_offer_owe14 span').textContent = (data[0].sum_loan_appointment_offer_owe14 || "0").toLocaleString();
                            document.querySelector('#sum_loan_appointment_offer_owe15 span').textContent = (data[0].sum_loan_appointment_offer_owe15 || "0").toLocaleString();
                            document.querySelector('#sum_loan_appointment_offer_owe16 span').textContent = (data[0].sum_loan_appointment_offer_owe16 || "0").toLocaleString();
                            document.querySelector('#sum_loan_appointment_offer_owe17 span').textContent = (data[0].sum_loan_appointment_offer_owe17 || "0").toLocaleString();

                            document.querySelector('#total_pay_amnt_14A_B span').textContent = (data[0].total_pay_amnt_14A_B || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_15A_B span').textContent = (data[0].total_pay_amnt_15A_B || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_16A_B span').textContent = (data[0].total_pay_amnt_16A_B || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_17A_B span').textContent = (data[0].total_pay_amnt_17A_B || "0").toLocaleString();

                            document.querySelector('#total_pay_amnt_par6014 span').textContent = (data[0].total_pay_amnt_par6014 || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_par6015 span').textContent = (data[0].total_pay_amnt_par6015 || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_par6016 span').textContent = (data[0].total_pay_amnt_par6016 || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_par6017 span').textContent = (data[0].total_pay_amnt_par6017 || "0").toLocaleString();

                            document.querySelector('#total_pay_amnt_14C span').textContent = (data[0].total_pay_amnt_14C || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_15C span').textContent = (data[0].total_pay_amnt_15C || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_16C span').textContent = (data[0].total_pay_amnt_16C || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_17C span').textContent = (data[0].total_pay_amnt_17C || "0").toLocaleString();

                            document.querySelector('#total_pay_amnt_14D span').textContent = (data[0].total_pay_amnt_14D || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_15D span').textContent = (data[0].total_pay_amnt_15D || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_16D span').textContent = (data[0].total_pay_amnt_16D || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_17D span').textContent = (data[0].total_pay_amnt_17D || "0").toLocaleString();

                            document.querySelector('#total_pay_amnt_14E span').textContent = (data[0].total_pay_amnt_14E || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_15E span').textContent = (data[0].total_pay_amnt_15E || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_16E span').textContent = (data[0].total_pay_amnt_16E || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_17E span').textContent = (data[0].total_pay_amnt_17E || "0").toLocaleString();

                            document.querySelector('#total_pay_amnt_14WF span').textContent = (data[0].total_pay_amnt_14WF || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_15WF span').textContent = (data[0].total_pay_amnt_15WF || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_16WF span').textContent = (data[0].total_pay_amnt_16WF || "0").toLocaleString();
                            document.querySelector('#total_pay_amnt_17WF span').textContent = (data[0].total_pay_amnt_17WF || "0").toLocaleString();


                          

                        } else {
                            // จัดการกรณีไม่มีข้อมูล
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });


            function toggleRows() {
                var rows = ['1', '2', '3', '4', '5', '6']; // Add more row IDs here if needed
                rows.forEach(function(rowId) {
                    var row = document.getElementById(rowId);
                    if (row.style.display === "none" || row.style.display === "") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            function toggleRows2() {
                var rows = ['7', '8', '9', '10', '11', '12']; // Add more row IDs here if needed
                rows.forEach(function(rowId) {
                    var row = document.getElementById(rowId);
                    if (row.style.display === "none" || row.style.display === "") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            function toggleRows3() {
                var rows = ['13', '14', '15']; // Add more row IDs here if needed
                rows.forEach(function(rowId) {
                    var row = document.getElementById(rowId);
                    if (row.style.display === "none" || row.style.display === "") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
            function toggleRows4() {
                var rows = ['16', '17', '18','19','20','21']; // Add more row IDs here if needed
                rows.forEach(function(rowId) {
                    var row = document.getElementById(rowId);
                    if (row.style.display === "none" || row.style.display === "") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
            function toggleRows5() {
                var rows = ['22', '23', '24', '25', '26','27','28','29','30','31']; // Add more row IDs here if needed
                rows.forEach(function(rowId) {
                    var row = document.getElementById(rowId);
                    if (row.style.display === "none" || row.style.display === "") {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
        </script>
</body>

</html>