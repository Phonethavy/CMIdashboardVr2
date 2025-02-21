<!DOCTYPE html>
<html lang="lo">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMIMFI Dashboard</title>
    <link rel="stylesheet" href="service.css">
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

        .sl {
            border-radius: 4px;
            text-transform: none;
            padding: 1px;
        }
    </style>
</head>

<body>
    <?php include 'index.php'; ?>

    <!-- Search Form -->
    <form id="searchForm" class="d-flex justify-content-center align-items-center gap-2" action="service.php" method="get">
        <label for="startdate" class="fw-bold">Date</label>
        <input type="date" id="startdate" name="startdate" class="form-control form-control-sm w-auto" required>
        <label for="enddate" class="fw-bold">Date</label>
        <input type="date" id="enddate" name="enddate" class="form-control form-control-sm w-auto" required>
        <select id="location-input" class="sl" name="location">
            <?php
            include('connect.php'); // Include database connection
            $selectedlocation = isset($_GET['location']) ? $_GET['location'] : ''; // Get selected location from URL
            $tbl_atc = mysqli_query($conn, "SELECT localid, location FROM `location`"); // Select both localid and location

            while ($c = mysqli_fetch_array($tbl_atc)) {
                $selected = ($c['localid'] == $selectedlocation) ? 'selected' : ''; // Compare localid instead
            ?>
                <option value="<?php echo $c['localid']; ?>" <?php echo $selected; ?>>
                    <?php echo htmlspecialchars($c['location']); ?>
                </option>
            <?php } ?>
        </select>
                <select name="" id="">Employee</select>
                <select name="" id="">Location Group</select>


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

                    </tr>
                    <tr id="header-row-3">
                        <th>ເປົ້າຫມາຍ</th>
                        <th>ຜົນງານ</th>
                        <th>ທຽບເປົ້າຫມາຍ</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><button class="toggle-btn" onclick="toggleRows()"><i class="fas fa-pen"></i></button> ຍອດເຫຼືອໜ່ວຍທັງໝົດ</td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total16"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total14"><span></span></td>
                        <td id=""><span></span></td>
                        <td id=""><span></span></td>
                        <td id="count_type1_total17"><span></span></td>
                        <td id=""><span></span></td>

                    </tr>

                    <!-- Hidden rows for more details -->
                    <tr id="1" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ A</td>
                        <td><span></span></td>
                        <td id="count_type1_16A"><span></span></td>
                        <td></td>


                    </tr>
                    <tr id="2" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ B</td>
                        <td><span></span></td>
                        <td id="count_type1_16B"><span></span></td>
                        <td></td>


                    </tr>
                    <tr id="3" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ C</td>
                        <td><span></span></td>
                        <td id="count_type1_16C"><span></span></td>
                        <td></td>


                    </tr>
                    <tr id="4" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍເກຣດ D</td>
                        <td><span></span></td>
                        <td id="count_type1_16D"><span></span></td>
                        <td></td>


                    </tr>
                    <tr id="5" class="hidden-row">
                        <td>ຈຳນວນໜ່ວຍຕັ້ງໃໝ່ (ເດືອນ)</td>
                        <td><span></span></td>
                        <td id="count_com_create_type1_16"><span></span></td>
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

                fetch('sv_db.php?' + params)
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
        </script>
</body>

</html>