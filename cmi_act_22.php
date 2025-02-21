<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Data</title>
    <link rel="stylesheet" href="cmi_atc.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <?php include 'index.php'; ?>
    <div class="container mt-4">
        <h1>Financial Data for Year <span id="year-display"></span></h1>
        <select id="year-input" name="year">
            <?php
            include('connect.php'); // Include database connection
            $selectedYear = isset($_GET['year']) ? $_GET['year'] : ''; // Get selected year from URL
            $tbl_atc = mysqli_query($conn, "SELECT YEAR(tbl_atc.date) AS year FROM `tbl_atc` GROUP BY `year`");
            while ($c = mysqli_fetch_array($tbl_atc)) {
                $selected = ($c['year'] == $selectedYear) ? 'selected' : '';
            ?>
                <option value="<?php echo $c['year']; ?>" <?php echo $selected; ?>><?php echo $c['year']; ?></option>
            <?php } ?>
        </select>

        <button class="bt-n2" id="fetch-data">Search Years</button>
        <div id="loading">Loading data, please wait...</div>

        <table class="table1" id="data-table">
            <thead>
                <tr>
                    <th style="padding: 0px 80px; text-align: left;">Data Type</th>
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

                </tr>
            </thead>
            <tbody>
                <tr id="calculated-ratio-row">
                    <td style="padding: 5px 0px;text-align: left;" data-label="Data Type">ອັດຕາສ່ວນປະສິດທິພາບດ້ານການດຳເນີນງານ ຕ້ອງນ້ອຍກວ່າ</td>
                    <td data-label="Goal">30%</td>


                    <!-- Calculated ratios will be appended here -->
                </tr>
            </tbody>
        </table>
        <table border="1" id="data-table1">
            <thead>
                <tr>
                    <th>Category</th>
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
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <canvas id="financialChart" width="100" height="50"></canvas>

        <script>
            function numberFormat(num) {
                if (isNaN(num) || num === null) return "N/A";
                return Number(num).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            var ctx = document.getElementById('financialChart').getContext('2d');
            var financialChart;

            function createChart(labels, data1, data2) {
                if (financialChart) {
                    financialChart.destroy();
                }
                financialChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'ອັດຕາສ່ວນປະສິດທິພາບດ້ານການດຳເນີນງານ ຕ້ອງນ້ອຍກວ່າ',
                                data: data2,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                size: '30px',
                                borderWidth: 5,
                                fill: true,
                            },
                            {
                                label: 'Goal (30%)',
                                data: Array(labels.length).fill(30),
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
                                    display: false
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
                                    stepSize: 5,
                                    callback: function(value) {
                                        return value + '%'; // เพิ่ม % ที่แกน Y
                                    }
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
                    const selectedYear = parseInt($('#year-input').val());
                    if (!selectedYear) {
                        alert('Please select a year.');
                        return;
                    }

                    $('#loading').show();

                    let fetchedData = [];
                    let promises = [];

                    // Fetch data for the selected year (all months)
                    promises.push(
                        $.ajax({
                            url: `BOL0097_db.php?year1=${selectedYear}&year2=${selectedYear - 1}`,
                            method: 'GET',
                            dataType: 'json'
                        }).then(data => {
                            fetchedData = data;
                        })
                    );

                    Promise.all(promises).then(() => {
                        $('#loading').hide();
                        $('#calculated-ratio-row').find('td:gt(2)').remove();
                        // Populate table with data for all months of the year
                        let labels = [];
                        let roeData = [];
                        Object.keys(fetchedData).forEach(month => {
                            const monthData = fetchedData[month];
                            if (!monthData) return;

                            const {
                                Capital16,
                                Capital2_16_7,
                                debt2,
                                loans5,
                                assets8,
                                otherAssets10,
                                result_monthV,
                                All_propertyI,
                                balance2_3,
                                loan_balance99,
                                otherdept11_4,
                                other15_3,
                                drevaluation16_6,
                                deptsentcus12,
                                Cash1_1,
                                Debt11,
                                Debt12,
                                Interest1,
                                Fee_income9,
                                Fee_orther15,
                                Interest_expense2_1,
                                Payment_of_fees10_1,
                                administrative_expenses16_1,
                                salary_lousy17,
                                Other_business18,
                                debt_must_be_received19,
                                Profit_tax21_1,
                                cash1_1_1,
                                All_dept_and_moneyII,
                                loan_balanceCDE,
                                outstangding16,
                                interest16,
                                outstanding05,
                                provisionA,
                                provisionB,
                                provisionC,
                                provisionD,
                                provisionE,
                                expensesOther18,
                                expensesGeneral16_2,
                                expenseslousy17,
                                sumloan,
                                sumloanrate,
                                sumfixes,
                                sumfixesrate,
                                saving,
                                savingrate,
                                sumfix2,
                                sumfix2rate,
                                Quantity,



                            } = monthData;
                            const CapitalPreviousYear = fetchedData[12] ? parseFloat(fetchedData[12].CapitalPreviousYear) : null;
                            const All_propertyIPreviousYear = fetchedData[12] ? parseFloat(fetchedData[12].All_propertyIPreviousYear) : null;
                            const PreviousYearloan_balance99 = fetchedData[12] ? parseFloat(fetchedData[12].PreviousYearloan_balance99) : null;

                            const roe = ((expensesGeneral16_2 + expenseslousy17 + expensesOther18) * 12) / month / ((PreviousYearloan_balance99 + loan_balance99) / 2) * 100;
                            roeData.push(roe);
                            labels.push(month);

                            // Populate the ratio row in the table
                            $('#calculated-ratio-row').append(`
                        <td>${numberFormat(roe)}%</td>
                        
`);

                        });

                        // Create a chart
                        createChart(labels, roeData, roeData);
                    }).catch(() => {
                        $('#loading').hide();
                        alert('Error fetching data.');
                    });
                });
            });



            $(document).ready(function() {
                $('#fetch-data').on('click', function() {
                    var selectedYear = parseInt($('#year-input').val());
                    var previousYear = selectedYear - 1;

                    if (selectedYear) {
                        $('#year-display').text(selectedYear);
                        $('#loading').show();

                        $.ajax({
                            url: `BOL0097_db.php?year1=${selectedYear}&year2=${previousYear}`,
                            method: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#loading').hide();
                                var tableBody = $('#data-table1 tbody');
                                tableBody.empty(); // Clear previous data entirely

                                // Create row structure for each category
                                var rows = {
                                    expensesGeneral16_2: `<tr><td>16. ລາຍຈ່າຍບໍລິຫານທົ່ວໄປ</td>`,
                                    expenseslousy17: `<tr><td>17. ລາຍຈ່າຍຄ່າຫຼຸ້ຍຫ້ຽນ ແລະ ຄ່າເຊື່ອມມູນຄ່າ ຊ.ຄ.ທ </td>`,
                                    expensesOther18: `<tr><td>18. ລາຍຈ່າຍອື່ນໆໃນການທຸລະກິດ</td>`,
                                    PreviousYearloan_balance99: `<tr><td>ຍອດເຫຼືອເງິນກູ້ປີກ່ອນ</td>`,
                                    loan_balance99: `<tr><td>ຍອດເຫຼືອເງິນກູ້ເດືອນປະຈຸບັນ</td>`,

                                };

                                for (var month in data) {
                                    var formattedMonth = month.padStart(2, '0');
                                    var expensesGeneral16_2 = data[month].expensesGeneral16_2 || " ";
                                    var expenseslousy17 = data[month].expenseslousy17 || " ";
                                    var expensesOther18 = data[month].expensesOther18 || " ";
                                    var PreviousYearloan_balance99 = data[month].PreviousYearloan_balance99 || " ";
                                    var loan_balance99 = data[month].loan_balance99 || " ";

                                    var ratio = calculate21(
                                        expensesGeneral16_2,
                                        expenseslousy17,
                                        expensesOther18,
                                        PreviousYearloan_balance99,
                                        loan_balance99
                                    );

                                    rows.expensesGeneral16_2 += `<td>${numberFormat(expensesGeneral16_2)}</td>`;
                                    rows.expenseslousy17 += `<td>${numberFormat(expenseslousy17)}</td>`;
                                    rows.expensesOther18 += `<td>${numberFormat(expensesOther18)}</td>`;
                                    rows.PreviousYearloan_balance99 += `<td>${numberFormat(PreviousYearloan_balance99)}</td>`;
                                    rows.loan_balance99 += `<td>${numberFormat(loan_balance99)}</td>`;
                                }


                                // Close each row
                                for (var key in rows) {
                                    rows[key] += `</tr>`;
                                    tableBody.append(rows[key]);
                                }
                            },
                            error: function(xhr) {
                                $('#loading').hide();
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
                    $('#fetch-data').click();
                }
            });

            function calculate21(expensesGeneral16_2, expenseslousy17, expensesOther18, PreviousYearloan_balance99, loan_balance99) {
                const denominator = ((PreviousYearloan_balance99 + loan_balance99) / 2) * 100;
                return denominator ? ((expensesGeneral16_2 + expenseslousy17 + expensesOther18) * 12) / denominator * 100 .toFixed(2) : "";
            }
        </script>
</body>

</html>