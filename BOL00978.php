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
            margin: 20px 0;
            background-color: #fff;
        }

        th,
        td {
            padding: 10px;
            text-align: right;
            border: 1px solid #ddd;
        }

        th {
            background-color: #db234e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        #loading {
            display: none;
            text-align: center;
            margin: 20px 0;
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
            /* ปรับตำแหน่งให้จัดกึ่งกลาง */
            background-color: #db234e;
            color: white;
            padding: 10px;
            border: 1px solid #ddd;
            width: 8%;
            /* ปรับขนาดความกว้างของแต่ละ column ให้เท่ากัน */
        }
        label{
            font-size: 60px;
        }

        @media (max-width: 768px) {
            table th {
                font-size: 14px;
                /* ลดขนาดฟอนต์ในมือถือ */
                padding: 8px;
                /* ลด padding */
            }

        }


        @media (max-width: 480px) {
            table th {
                font-size: 12px;
                /* ปรับขนาดตัวอักษรให้เล็กลงในมือถือขนาดเล็ก */
                padding: 6px;
            }
        }
    </style>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
<?php include 'index.php'; ?>
    <h1>Financial Data for Year <span id="year-display"></span></h1>
    <select id="year-input" name="year">
        <?php
        include('server.php'); // Include database connection
        $selectedYear = isset($_GET['year']) ? $_GET['year'] : ''; // Get selected year from URL
        $tbl_atc = mysqli_query($conn, "SELECT `year` FROM `tbl_atc` GROUP BY `year`");
        while ($c = mysqli_fetch_array($tbl_atc)) {
            // Set selected attribute for the dropdown
            $selected = ($c['year'] == $selectedYear) ? 'selected' : '';
        ?>
            <option value="<?php echo $c['year']; ?>" <?php echo $selected; ?>><?php echo $c['year']; ?></option>
        <?php } ?>
    </select>

    <button id="fetch-data">Search Years</button>
    <div id="loading">Loading data, please wait...</div>
    <table>
        <th style="text-align: center;">ຫມວດຄວາມພຽງພໍຂອງທຶນ</th>
    </table>
    <table class="table1" id="data-table">
        <thead>
            <tr>
                <th>Data Type</th>
                <th>Goal</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>April</th>
                <th>May</th>
                <th>June</th>
                <th>July</th>
                <th>August</th>
                <th>September</th>
                <th>October</th>
                <th>November</th>
                <th>December</th>
                <th>ມາດຕະຖານທີ່ກຳນົດໄວ້</th>
            </tr>
        </thead>
        <tbody>
        
            <tr id="calculated-ratio-row2">
                <td>ອັດຕາສ່ວນທຶນຊັ້ນໜຶ່ງ / ຊັບສີນທີ່ວາງນ້ຳໜັກຄວາມສ່ຽງ ຕ້ອງຫຼາຍກວ່າ</td>
                <td>8%</td>
                <!-- Calculated ratios will be appended here -->
            </tr>

        </tbody>
    </table>



    <table border="1" id="data-table1">
        <thead>
            <tr>
                <th>Month</th>
                <th>16. ທຶນ ແລະ ຖືວ່າເປັນທຶນຂອງສະຖາບັນການເງິນ</th>
                <th>2. ໜີ້ຕ້ອງຮັບຈາກສະຖາບັນການເງິນອື່ນ</th>
                <th>5. ສິນເຊື່ອ ແລະ ເງິນລ່ວງໜ້າໃຫ້ລູກຄ້າສຸດທິ</th>
                <th>8. ຊັບສົມບັດຄົງທີ່ສຸດທິ</th>
                <th>10. ຊັບສິນອື່ນໆ</th>
                <th>ອັດຕາສ່ວນທຶນທັງໝົດ / ຊັບສິນທີ່ວາງນ້ຳໜັກຄວາມສ່ຽງ ຕ້ອງຫຼາຍກວ່າ(%)</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>



    <canvas id="financialChart" width="100" height="50" font-size="20px"></canvas>

    <script>
        function calculate(Capital, debt, loans, assets, otherAssets) {
            if (isNaN(Capital) || isNaN(debt) || isNaN(loans) || isNaN(assets) || isNaN(otherAssets)) {
                return "N/A"; // Handle NaN cases
            }
            let denominator = (debt * 0.20) + (loans * 1.00) + (assets * 1.00) + (otherAssets * 1.00);
            return denominator !== 0 ? ((Capital / denominator) * 100).toFixed(2) : "0.00";
        }


        function calculate2(Capital, Capital2, debt, loans, assets, otherAssets) {
            if (isNaN(Capital) || isNaN(Capital2) || isNaN(debt) || isNaN(loans) || isNaN(assets) || isNaN(otherAssets)) {
                return "N/A"; // Handle NaN cases
            }
            let denominator = (debt * 0.20) + (loans * 1.00) + (assets * 1.00) + (otherAssets * 1.00);
            return denominator !== 0 ? (((Capital - Capital2) / denominator) * 100).toFixed(2) : "0.00";
        }








        function numberFormat(num) {
            if (isNaN(num) || num === null) return "N/A"; // Handle NaN and null cases
            return Number(num).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }



        var ctx = document.getElementById('financialChart').getContext('2d');
        var financialChart;

        function createChart(labels, data1, data2) {
            if (financialChart) {
                financialChart.destroy(); // Destroy existing chart if it exists
            }
            financialChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'ອັດຕາສ່ວນທຶນທັງໝົດ / ຊັບສິນທີ່ວາງນ້ຳໜັກຄວາມສ່ຽງ ຕ້ອງຫຼາຍກວ່າ (8%)',
                            data: data2,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            size: '30px',
                            borderWidth: 5,
                            fill: true,
                        },
                        {
                            label: 'Goal (8%)',
                            data: Array(labels.length).fill(8), // เติมค่ามาตรฐาน (8%) สำหรับทุกเดือน
                            borderColor: 'rgba(255, 206, 86, 1)',
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderDash: [5, 5],
                            borderWidth: 5,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 30
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.3)'
                            },
                            ticks: {
                                color: '#666',
                                font: {
                                    size: 30
                                },
                                stepSize: 5
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#333',
                                font: {
                                    size: 20
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleFont: {
                                size: 30
                            },
                            bodyFont: {
                                size: 30
                            }
                        }
                    }
                }
            });
        }







        $(document).ready(function() {
            $('#fetch-data').on('click', function() {
                // var year = $('#year-input').val();
                // ดึงค่าปีที่เลือกจาก dropdown
                var selectedYear = parseInt($('#year-input').val());
                var previousYear = selectedYear - 1; // คำนวณปีก่อนหน้า

                // ส่งค่าปีที่เลือกและปีก่อนหน้าไปยัง PHP ผ่าน AJAX
                if (selectedYear) {
                    $('#year-display').text(selectedYear);
                    $('#loading').show();

                    $.ajax({
                        url: `BOL0097_db.php?year1=${selectedYear}&year2=${previousYear}`,
                        method: 'GET',
                        data: {
                            year1: selectedYear, // ปีที่เลือก
                            year2: previousYear // ปีก่อนหน้า
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#loading').hide();
                            $('#calculated-ratio-row').find('td:gt(2)').remove();
                            $('#calculated-ratio-row2').find('td:gt(2)').remove();


                            const months = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
                            // var standard = '16%';
                            // var standard2 = '8%';
                            let ratioData1 = [];
                            let ratioData2 = [];

                            months.forEach(month => {
                                let monthData = data[month];

                                if (monthData) {
                                    let Capital = parseFloat(monthData.Capital);
                                    let Capital2 = parseFloat(monthData.Capital2);
                                    let debt = parseFloat(monthData.debt);
                                    let loans = parseFloat(monthData.loans);
                                    let assets = parseFloat(monthData.assets);
                                    let otherAssets = parseFloat(monthData.otherAssets);
                                    let CapitalPreviousYear = data["12"] ? data["12"].CapitalPreviousYear : null;
                                    let All_propertyIPreviousYear = data["12"] ? data["12"].All_propertyIPreviousYear : null;
                                    var standard = '12';

                                    var ratio = calculate(Capital, debt, loans, assets, otherAssets);
                                    var ratio2 = calculate2(Capital, Capital2, debt, loans, assets, otherAssets);


                                    
                                    $('#calculated-ratio-row2').append(`<td>${ratio2}%</td>`);

                                   
                                    ratioData2.push(parseFloat(ratio2));
                                }

                            });
                            createChart(months, ratioData1, ratioData2);
                            let monthData = months;
                            if (monthData) {
                                let Capital = parseFloat(monthData.Capital);
                                let Capital2 = parseFloat(monthData.Capital2);
                                let debt = parseFloat(monthData.debt);
                                let loans = parseFloat(monthData.loans);
                                let assets = parseFloat(monthData.assets);
                                let otherAssets = parseFloat(monthData.otherAssets);
                                var standard = '12';
                                var standard2 = '8';
                                var standard3 = '5';

                                var ratio = calculate(Capital, debt, loans, assets, otherAssets);
                                var ratio2 = calculate2(Capital, Capital2, debt, loans, assets, otherAssets);


                                if (standard < ratio) {
                                    $('#calculated-ratio-row').append(`<td>ປະຕິບັດໄດ້</td>`);
                                } else {
                                    $('#calculated-ratio-row').append(`<td>ປະຕິບັດບໍ່ໄດ້</td>`);
                                }
                                if (standard2 < ratio2) {
                                    $('#calculated-ratio-row2').append(`<td>ປະຕິບັດໄດ້</td>`);
                                } else {
                                    $('#calculated-ratio-row2').append(`<td>ປະຕິບັດບໍ່ໄດ້</td>`);
                                }

                            }


                        },
                        error: function(xhr) {
                            $('#loading').hide();
                            const errorMsg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Unexpected error occurred';
                            alert('Error fetching data: ' + errorMsg);
                        }
                    });
                } else {
                    alert('Please select a year.');
                }
            });

            // Automatically fetch data for the selected year if available
            if ('<?php echo $selectedYear; ?>') {
                $('#fetch-data').click();
            }
        });



        $(document).ready(function() {
            $('#fetch-data').on('click', function() {
                // var year = $('#year-input').val();
                // ดึงค่าปีที่เลือกจาก dropdown
                var selectedYear = parseInt($('#year-input').val());
                var previousYear = selectedYear - 1; // คำนวณปีก่อนหน้า

                // ส่งค่าปีที่เลือกและปีก่อนหน้าไปยัง PHP ผ่าน AJAX
                if (selectedYear) {
                    $('#year-display').text(selectedYear);
                    $('#loading').show();

                    $.ajax({
                        url: `BOL0097_db.php?year1=${selectedYear}&year2=${previousYear}`,
                        method: 'GET',
                        data: {
                            year1: selectedYear, // ปีที่เลือก
                            year2: previousYear // ปีก่อนหน้า
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#loading').hide(); // Hide loading message
                            var tableBody = $('#data-table1 tbody');
                            tableBody.empty(); // Clear previous data

                            // Populate the table with fetched data
                            for (var month in data) {
                                // Calculate the ratio using the calculate function
                                var ratio = calculate(data[month].Capital, data[month].debt, data[month].loans, data[month].assets, data[month].otherAssets);

                                var row = `<tr>
                                            <td>${month.padStart(2, '0')}</td>
                                            <td>${numberFormat(data[month].Capital)}</td>
                                            <td>${numberFormat(data[month].debt)}</td>
                                            <td>${numberFormat(data[month].loans)}</td>
                                            <td>${numberFormat(data[month].assets)}</td>
                                            <td>${numberFormat(data[month].otherAssets)}</td>
                                            <td>${ratio}%</td> <!-- Display the calculated ratio -->
                                        </tr>`;
                                tableBody.append(row);
                            }
                        },
                        error: function(xhr) {
                            $('#loading').hide(); // Hide loading message
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                alert('Error fetching data: ' + xhr.responseJSON.error);
                            } else {
                                alert('Unexpected error occurred: ' + xhr.statusText);
                            }
                        }
                    });
                } else {
                    alert('Please select a year.');
                }
            });

            if ('<?php echo $selectedYear; ?>') {
                $('#fetch-data').click(); // Trigger data fetch on page load
            }
        });
    </script>

</body>

</html>