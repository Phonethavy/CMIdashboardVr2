<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Data</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="cmi_atc.css">

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

                </tr>
            </thead>
            <tbody>
                <tr id="calculated-ratio-row">
                    <td data-label="Data Type">ອັດຕາສ່ວນຜົນຕອບແທນຈາກທຶນ ROE ຕ້ອງຫຼາຍກວ່າ</td>
                    <td data-label="Goal">2%</td>


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
            function calculate4(result_monthV, All_propertyIPreviousYear, All_propertyI) {
                const denominator = (All_propertyIPreviousYear + All_propertyI) / 2;
                return denominator ? ((result_monthV / denominator) * 100).toFixed(2) : "";
            }

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
                                label: 'ROE',
                                data: data2,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                size: '30px',
                                borderWidth: 5,
                                fill: true,
                            },
                            {
                                label: 'Goal (2%)',
                                data: Array(labels.length).fill(2),
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
                                debt2,
                                result_monthV,
                                All_propertyI
                            } = monthData;
                            const CapitalPreviousYear = fetchedData[12] ? parseFloat(fetchedData[12].CapitalPreviousYear) : null;
                            const All_propertyIPreviousYear = fetchedData[12] ? parseFloat(fetchedData[12].All_propertyIPreviousYear) : null;

                            const roe = calculate4(result_monthV, All_propertyIPreviousYear, All_propertyI);
                            roeData.push(roe);
                            labels.push(month);

                            // Populate the ratio row in the table
                            $('#calculated-ratio-row').append(`
                        <td>${roe}%</td>
                        <td style="background-color: ${roe >= 2 ? 'lightgreen' : 'lightcoral'};">
                         ປະຕິບັດ ${roe >= 2 ? 'ໄດ້' : 'ບໍ່ໄດ້'}
                        </td>
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
                                    result_monthV: `<tr><td>V. ຜົນໄດ້ຮັບສຸດທິໃນເດືອນ</td>`,
                                    All_propertyI: `<tr><td>I.ຊັບສິນທັງໝົດປີນີ້</td>`,
                                    All_propertyIPreviousYear: `<tr><td>ທືນທັງໝົດປີກ່ອນໜ້າ (${previousYear})</td>`,


                                };

                                // Populate rows with data for each month
                                for (var month in data) {
                                    var formattedMonth = month.padStart(2, '0');
                                    var ratio = calculate4(data[month].result_monthV, data[month].All_propertyI, data[month].All_propertyIPreviousYear);

                                    rows.result_monthV += `<td>${numberFormat(data[month].result_monthV)}</td>`;
                                    rows.All_propertyI += `<td>${numberFormat(data[month].All_propertyI)}</td>`;
                                    rows.All_propertyIPreviousYear += `<td>${numberFormat(data[month].All_propertyIPreviousYear)}</td>`;


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
        </script>
</body>

</html>