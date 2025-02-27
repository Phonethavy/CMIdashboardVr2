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
        th, td {
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
    </style>
</head>
<body>
    <?php include 'index.php'; ?>
    
    <form id="searchForm" action="service.php" method="get">
        <input type="date" id="startdate" name="startdate" required>
        <input type="date" id="enddate" name="enddate" required>
        <select id="location-input" name="location">
            <?php
            include('connect.php');
            $tbl_atc = mysqli_query($conn, "SELECT localid, location FROM location");
            while ($c = mysqli_fetch_array($tbl_atc)) {
                echo "<option value='{$c['localid']}'>{$c['location']}</option>";
            }
            ?>
        </select>
        <select name="sl_model" id="sl_model">
            <option value="emp">Employee</option>
            <option value="com">Location Group</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <table id="data-table">
        <thead>
            <tr>
                <th>ຊື່</th>
                <th colspan="3">ເງິນກູ້ພະນັກງານ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <button class="toggle-btn" onclick="toggleRows()">▼</button>
                    ຍອດເຫຼືອໜ່ວຍທັງໝົດ
                </td>
            </tr>
        </tbody>
    </table>

    <script>
        let isToggled = false;

        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData).toString();
            const selectedModel = document.getElementById("sl_model").value;

            fetch('sv1_db.php?' + params)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector("#data-table tbody");
                    tableBody.innerHTML = "";
                    
                    let toggleRow = document.createElement("tr");
                    toggleRow.innerHTML = `
                        <td>
                            <button class="toggle-btn" onclick="toggleRows()">▼</button>
                            ຍອດເຫຼືອໜ່ວຍທັງໝົດ
                        </td>
                    `;
                    tableBody.appendChild(toggleRow);

                    if (data.activity_data.length > 0) {
                        let gradeRow = document.createElement("tr");
                        gradeRow.classList.add("hidden-row");
                        gradeRow.innerHTML = `
                            <td>ຈຳນວນໜ່ວຍເກຣດ A: ${data.activity_data[0].count_type1_15A}</td>
                        `;
                        tableBody.appendChild(gradeRow);
                    }

                    data.activity_data.forEach(row => {
                        let tr = document.createElement("tr");
                        tr.classList.add("hidden-row");
                        let displayValue = selectedModel === "emp" ? row.emp_code : row.com_code;
                        tr.innerHTML = `<td>${displayValue}</td>`;
                        tableBody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Error:', error));
        });

        function toggleRows() {
            isToggled = !isToggled;
            document.querySelectorAll(".hidden-row").forEach(row => {
                row.style.display = isToggled ? "table-row" : "none";
            });
        }
    </script>
</body>
</html>
