<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPI Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            /* เพิ่ม z-index เพื่อให้มันแสดงอยู่ข้างบน */
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            /* เพิ่ม z-index เพื่อให้แสดงอยู่ใต้ popup */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            z-index: 1;
            /* ปรับ z-index ให้ตารางอยู่ข้างล่าง popup */
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            position: relative;
            /* เพื่อให้สามารถจัดลำดับ z-index ได้ */
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

        button {
            background-color: #c00;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #a31a37;
        }

        .toggle-btn {
            cursor: pointer;
            font-size: 18px;
            color: #c00;
            background: none;
            border: none;
        }

        .compare-btn {
            background-color: #c00;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 10px;
            /* มุมมน */
            transition: background-color 0.3s;
        }

        .compare-btn:hover {
            background-color: #a31a37;
        }
    </style>

</head>
<?php include("../navbar/header.php"); ?>


<body>


    <div class="container mt-4">
        <form id="searchForm">
            <label for="year">Select Year:</label>
            <select id="year-input" name="year">
                <?php
                include('../ajx_json/connect.php'); // Include database connection
                $selectedYear = isset($_GET['year']) ? $_GET['year'] : ''; // Get selected year from URL
                $tbl_atc = mysqli_query($conn, "SELECT YEAR(tbl_atc.date) AS year FROM `tbl_atc` GROUP BY `year`");
                while ($c = mysqli_fetch_array($tbl_atc)) {
                    $selected = ($c['year'] == $selectedYear) ? 'selected' : '';
                ?>
                    <option value="<?php echo $c['year']; ?>" <?php echo $selected; ?>><?php echo $c['year']; ?></option>
                <?php } ?>
            </select>
            <button type="submit">Search</button>

        </form>
    </div>
    <div class="container mt-4">
        <div class="d-flex justify-content-start mb-2">
            <button type="button" class="compare-btn">
                <a id="openPopup" style="color: #fff; text-decoration: none;"><i class="fas fa-eye"></i> Compare</a>

            </button>

        </div>
        <table id="data-table">

            <thead>
                <tr>
                    <th colspan="2">Name</th>
                    <th>Goal</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <h3 style="font-size: 0.85rem;">KPI1. ລາຍຮັບທັງຫມົດ </h3>
        <canvas id="financialChart" width="790" height="200" style="display: none;"></canvas>
    </div>




    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2>Search KPI Data</h2>
        <label for="year">Year:</label>
        <select id="year"></select>
        <label for="month">Month:</label>
        <select id="month">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <button id="search">Search</button>
        <button id="closePopup">Close</button>

        <table border="1" id="popupTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Goal</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script>
        var ctx = document.getElementById('financialChart').getContext('2d');
        var financialChart;

        function createChart(labels, data1, data2, year) {
            if (financialChart) {
                financialChart.destroy();
            }

            // 🔥 แปลง String เป็น Number
            let sanitizedData = data1.map(value => {
                let num = parseFloat(value.replace(/,/g, '')); // เอา "," ออกแล้วแปลงเป็นตัวเลข
                return isNaN(num) ? 0 : num; // ถ้า NaN ให้เป็น 0
            });

            let sanitizedGoal = data2.map(value => {
                let num = parseFloat(value);
                return isNaN(num) ? 0 : num;
            });
            let goalValue = (year == "2024") ? 130000000000 : 150000000000;
            let maxValue = Math.max(...sanitizedData, ...sanitizedGoal) * 1.2;
            let minValue = Math.min(...sanitizedData, ...sanitizedGoal) * 1.2;

            // 🔎 Debug: ตรวจสอบค่าหลังแปลง
            console.log("Sanitized KPI1:", sanitizedData);
            console.log("Sanitized Goal:", sanitizedGoal);

            // ❌ ป้องกันกราฟไม่ขึ้น
            if (sanitizedData.every(v => v === 0) && sanitizedGoal.every(v => v === 0)) {
                console.warn("No valid data to display on the chart.");
                return;
            }

            financialChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'KPI1',
                            data: sanitizedData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 3,
                            fill: true,
                        },
                        {
                            label:'Goal',
                            data: sanitizedGoal,
                            borderColor: 'rgba(255, 206, 86, 1)',
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderDash: [5, 5],
                            borderWidth: 3,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        y: {
                            beginAtZero: false,
                            min: Math.floor(minValue / 1000000000) * 1000000000, // ปัดลงให้เป็นหลักพันล้าน
                            max: Math.ceil(maxValue / 1000000000) * 1000000000, // ปัดขึ้นให้เป็นหลักพันล้าน
                            grid: {
                                color: 'rgba(200, 200, 200, 0.3)'
                            },
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 14
                                },
                                stepSize: 1000000000, // ✅ ให้ค่าขึ้นทีละ 1 พันล้าน
                                callback: value => (value / 1000000000).toFixed(0) + "B" // ✅ แสดงค่าเป็น Billion เช่น 150B
                            }
                        }

                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleFont: {
                                size: 16
                            },
                            bodyFont: {
                                size: 14
                            }
                        }
                    }
                }
            });
        }




        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const year = encodeURIComponent(document.getElementById('year-input').value);

            fetch(`../ajx_json/kpi1_db.php?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#data-table tbody');
                    tableBody.innerHTML = '';

                    let kpiData = [];
                    let goalData = [];
                    let labels = [];

                    let categories = ['KPI1', 'ລາຍຮັບຈາກເງິນກູ້ເງິນເດືອນ', 'ລາຍຈ່າຍຄັງແຮ', 'ລາຍຮັບຈາກເງິນກູ້ປະຊາຊົນ',
                        'ລາຍຮັບຈາກເງິນກູ້ SME', 'ລາຍຮັບຈາກດອກເບ້ຍເງິນຝາກ', 'ລາຍຮັບຄ່າທຳນຽມ ເງິນກູ້ເງິນເດືອນ', 'ລາຍຮັບຈາກໜີ້ນອກຜັງ',
                        'ລາຍຮັບໃນການດຳນເນີນງານອື່ນໆ', 'ລາຍຮັບເງິນແຮ'
                    ];
                    let goalValue = (year == "2024") ? 130000000000 : 150000000000;
                    let firstRow = true;

                    categories.forEach((category, index) => {
                        let rowId = `row-${index}`;
                        let row = [`<td>${category}</td>`];

                        // Only add Goal value for the first row (KPI1)
                        if (index === 0) {
                            let Goal = data.length > 0 ? data[0]?.Goal_Total || 0 : 0;
                            row.push(`<td>${Goal}</td>`);
                        } else {
                            row.push(`<td></td>`); // Empty cell for other rows where Goal is not shown
                        }

                        // Add month data
                        for (let i = 1; i <= 12; i++) {
                            const monthData = data.find(d => d.Month == i);
                            row.push(`<td>${monthData?.[category] || 0}</td>`);
                        }

                        // Add the toggle button (shifted one column)
                        if (index === 0) {
                            row.unshift(`<td><button class="toggle-btn" onclick="toggleRows()">
            <i class="fas fa-pen"></i>
        </button></td>`);
                            tableBody.innerHTML += `<tr id="${rowId}">${row.join('')}</tr>`;
                        } else {
                            row.unshift(`<td></td>`); // Empty column for other rows before toggle button 
                            tableBody.innerHTML += `<tr id="${rowId}" class="toggle-row" style="display: none;">${row.join('')}</tr>`;
                        }
                    });

                    let availableMonths = data.filter(d => d.Month).map(d => d.Month).sort((a, b) => a - b);
                    availableMonths.forEach(month => {
                        labels.push(["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"][month - 1]);
                        let monthData = data.find(d => d.Month == month);
                        kpiData.push(monthData?.['KPI1'] || 0);
                        goalData.push(goalValue);
                    });

                    createChart(labels, kpiData, goalData);
                    document.getElementById('financialChart').style.display = 'block';
                })
                .catch(error => console.error('Error:', error));
        });



        // ✅ ฟังก์ชันซ่อน/แสดงแถวที่ไม่ใช่ KPI1
        function toggleRows() {
            document.querySelectorAll(".toggle-row").forEach(row => {
                row.style.display = (row.style.display === "none") ? "table-row" : "none";
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            let currentYear = new Date().getFullYear();
            for (let i = currentYear; i >= currentYear - 10; i--) {
                $('#year').append(`<option value="${i}">${i}</option>`);
            }

            $('#openPopup').click(function() {
                $('#overlay, #popup').show();
            });

            $('#closePopup, #overlay').click(function() {
                $('#overlay, #popup').hide();
            });

            let selectedMonths = [];
            let storedData = [];

            $("#search").click(function() {
                let year = $("#year").val();
                let month = $("#month").val();

                if (!selectedMonths.includes(month)) {
                    selectedMonths.push(month);
                }

                $.ajax({
                    url: "../ajx_json/kpi1_db.php",
                    type: "GET",
                    data: {
                        year: year,
                        month: month
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log("Response:", response); // ตรวจสอบ JSON ที่ได้จาก PHP
                        storedData = storedData.concat(response);
                        renderTable(storedData);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            });

            function renderTable(data) {
                let tbody = $("#popupTable tbody");
                let headerRow = $("#popupTable thead tr");

                tbody.empty();
                headerRow.find("th:gt(1)").remove(); // ลบคอลัมน์ที่ 3 ขึ้นไปก่อนสร้างใหม่

                // เพิ่มเดือนที่เลือกเป็นคอลัมน์ Header
                selectedMonths.forEach(month => {
                    let monthYear = data.find(row => row.Month == month);
                    if (monthYear) {
                        headerRow.append(`<th>${monthYear.Month}/${monthYear.Year}</th>`);
                    }
                });

                // แสดง Goal Total แค่ Row แรก (แถวเดียว)
                let goalRow = `<tr><td>Goal Total</td>`; // คอลัมน์ที่ 2 และ 3 เป็นค่าว่าง
                let goalTotalDisplayed = false; // ตัวแปรเช็คว่า Goal Total แสดงแล้วหรือยัง
                selectedMonths.forEach(month => {
                    let row = data.find(row => row.Month == month);
                    if (!goalTotalDisplayed) {
                        goalRow += `<td>${row ? row["Goal_Total"] : " "}</td>`; // แสดงค่า Goal_Total แค่ครั้งแรก
                        goalTotalDisplayed = true;
                    } else {
                        goalRow += `<td></td>`; // ไม่แสดง Goal_Total ในเดือนถัดไป
                    }
                });
                goalRow += `</tr>`;
                tbody.append(goalRow);

                // แสดง KPI และข้อมูลอื่น ๆ ในคอลัมน์ 3 ขึ้นไป
                let rows = [{
                        label: "KPI 1",
                        key: "KPI1"
                    },
                    {
                        label: "ລາຍຮັບຈາກເງິນກູ້ເງິນເດືອນ",
                        key: "ລາຍຮັບຈາກເງິນກູ້ເງິນເດືອນ"
                    },
                    {
                        label: "ລາຍຈ່າຍຄັງແຮ",
                        key: "ລາຍຈ່າຍຄັງແຮ"
                    },
                    {
                        label: "ລາຍຮັບຈາກເງິນກູ້ປະຊາຊົນ",
                        key: "ລາຍຮັບຈາກເງິນກູ້ປະຊາຊົນ"
                    },
                    {
                        label: "ລາຍຮັບຈາກເງິນກູ້ SME",
                        key: "ລາຍຮັບຈາກເງິນກູ້ SME"
                    },
                    {
                        label: "ລາຍຮັບຈາກດອກເບ້ຍເງິນຝາກ",
                        key: "ລາຍຮັບຈາກດອກເບ້ຍເງິນຝາກ"
                    },
                    {
                        label: "ລາຍຮັບຄ່າທຳນຽມ ເງິນກູ້ເງິນເດືອນ",
                        key: "ລາຍຮັບຄ່າທຳນຽມ ເງິນກູ້ເງິນເດືອນ"
                    },
                    {
                        label: "ລາຍຮັບຈາກໜີ້ນອກຜັງ",
                        key: "ລາຍຮັບຈາກໜີ້ນອກຜັງ"
                    },
                    {
                        label: "ລາຍຮັບໃນການດຳນເນີນງານອື່ນໆ",
                        key: "ລາຍຮັບໃນການດຳນເນີນງານອື່ນໆ"
                    },
                ];

                rows.forEach(item => {
                    let rowHtml = `<tr><td>${item.label}</td><td></td>`; // คอลัมน์ที่ 2 ว่าง
                    selectedMonths.forEach(month => {
                        let row = data.find(row => row.Month == month);
                        rowHtml += `<td>${row ? row[item.key] : "-"}</td>`;
                    });
                    rowHtml += `</tr>`;
                    tbody.append(rowHtml);
                });
            }

        });
    </script>


</body>

</html>