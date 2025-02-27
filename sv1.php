
<head>
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

        <select style="padding: 1px;border-radius: 2px;" name="sl_model" id="sl_model">
            <option value="emp">Employee</option>
            <option value="com">Location Group</option>
        </select>



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
                        <th scope="col" colspan="3">ເງິນກູ້ພະນັກງານ</th>
                        <th scope="col" colspan="3">ເງິນປະຊາຊົນ</th>
                        <th scope="col" colspan="3">ເງິນກູ້ເພດຍິງ</th>

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

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><button class="toggle-btn" onclick="toggleRows1()"><i class="fas fa-pen"></i></button> ຍອດເຫຼືອໜ່ວຍທັງໝົດ</td>
                    </tr>


                </tbody>
            </table>
        </main>

        <!-- Script Section -->
        <script>
            let isToggled = false; // ตัวแปรเช็คสถานะ toggle
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault(); // ป้องกันการโหลดหน้าใหม่

                const formData = new FormData(this);
                const params = new URLSearchParams(formData).toString();
                const selectedModel = document.getElementById("sl_model").value; // ดึงค่าที่เลือก

                fetch('sv1_db.php?' + params)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Data received:", data); // ตรวจสอบข้อมูล

                        // ดึง tbody ของตาราง
                        const tableBody = document.querySelector("#data-table tbody");
                        tableBody.innerHTML = ""; // ล้างข้อมูลเดิมก่อน

                        // แถวแรก (Header Toggle)
                        let toggleRow = document.createElement("tr");
                        toggleRow.innerHTML = `
                                <td >
                                    <button class="toggle-btn" onclick="toggleRows()">
                                        <i class="fas fa-pen"></i>
                                    </button> 
                                    ຍອດເຫຼືອໜ່ວຍທັງໝົດ
                                </td>
                                <td colspan="9"></td>
                           `;
                        tableBody.appendChild(toggleRow);

                        //แสดงข้อมูลเกรด A
                        let gradeRow = document.createElement("tr");
                        gradeRow.classList.add("toggle-row");
                        gradeRow.style.display = isToggled ? "table-row" : "none";

                        gradeRow.innerHTML = `
                                <td colspan="2">ຈຳນວນໜ່ວຍເກຣດ A</td>
                                <td colspan="6">${data.grade_data.count_type1_15A}</td>
                                <td colspan="6">${data.grade_data.count_type3_15A}</td>
                                
                            `;

                        tableBody.appendChild(gradeRow);
                        //แสดงข้อมูลเกรด B
                        let gradeRow3 = document.createElement("tr");
                        gradeRow3.classList.add("toggle-row");
                        gradeRow3.style.display = isToggled ? "table-row" : "none";

                        gradeRow3.innerHTML = `
                                <td colspan="2">ຈຳນວນໜ່ວຍເກຣດ B</td>
                                <td colspan="6">${data.grade_data.count_type1_15B}</td>
                                <td colspan="6">${data.grade_data.count_type3_15B}</td>
                                
                            `;

                        tableBody.appendChild(gradeRow3);
                        //แสดงข้อมูลเกรด c
                        let gradeRow4 = document.createElement("tr");
                        gradeRow4.classList.add("toggle-row");
                        gradeRow4.style.display = isToggled ? "table-row" : "none";

                        gradeRow4.innerHTML = `
                                <td colspan="2">ຈຳນວນໜ່ວຍເກຣດ C</td>
                                <td colspan="6">${data.grade_data.count_type1_15C}</td>
                                <td colspan="6">${data.grade_data.count_type3_15C}</td>
                                
                            `;

                        tableBody.appendChild(gradeRow4);

                        //แสดงข้อมูลเกรด D
                        let gradeRow5 = document.createElement("tr");
                        gradeRow5.classList.add("toggle-row");
                        gradeRow5.style.display = isToggled ? "table-row" : "none";

                        gradeRow5.innerHTML = `
                                <td colspan="2">ຈຳນວນໜ່ວຍເກຣດ D</td>
                                <td colspan="6">${data.grade_data.count_type1_15D}</td>
                                <td colspan="6">${data.grade_data.count_type3_15D}</td>
                                
                            `;

                        tableBody.appendChild(gradeRow5);

                        //แสดงข้อมูลเกรด D
                        let gradeRow6 = document.createElement("tr");
                        gradeRow6.classList.add("toggle-row");
                        gradeRow6.style.display = isToggled ? "table-row" : "none";

                        gradeRow6.innerHTML = `
                                <td colspan="2">
                                  <button class="toggle-btn" onclick="toggleRows2()">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    ຈຳນວນໜ່ວຍຕັ້ງໃໝ່ (ເດືອນ)</td>
                                <td colspan="6">${data.grade_data.count_total_create_type1}</td>
                                <td colspan="6">${data.grade_data.count_total_create_type3} </td>
                            `;

                        tableBody.appendChild(gradeRow6);

                        // วนลูปเพิ่มข้อมูลของ emp_code หรือ com_code
                        data.com_create_data.forEach((row, index) => {
                            let tr = document.createElement("tr");
                            tr.classList.add("toggle-row2"); // ใส่ class สำหรับ toggle
                            if (!isToggled) tr.style.display = "none"; // ซ่อนถ้า toggle ยังไม่ถูกกด
                            tr.id = "row-" + index; // กำหนด ID ให้แถว

                            let employee = selectedModel === "emp" ? row.emp_code : row.com_code;
                            let count_create_type1 = row.count_create_type1;
                            let count_create_type3 = row.count_create_type3;

                            tr.innerHTML = `
                                    <td colspan="2">${employee}</td>
                                    <td colspan="6">${count_create_type1}</td>
                                    <td colspan="6">${count_create_type3}</td>
                        `;
                            tableBody.appendChild(tr);
                        });



                        let gradeRow7 = document.createElement("tr");
                        gradeRow7.classList.add("toggle-row");
                        gradeRow7.style.display = isToggled ? "table-row" : "none";

                        gradeRow7.innerHTML = `
                                <td colspan="2">
                                 <button class="toggle-btn" onclick="toggleRows3()">
                                        <i class="fas fa-pen"></i>
                                    </button> ຈຳນວນໜ່ວຍຢ້ຽມຍາມ (ເດືອນ)</td>
                                <td colspan="6">${data.grade_data.count_actity_type1}</td>
                                <td colspan="6">${data.grade_data.count_actity_type3}</td>
                            `;

                        tableBody.appendChild(gradeRow7);


                        // วนลูปเพิ่มข้อมูลของ emp_code หรือ com_code
                        data.activity_data.forEach((row, index) => {
                            let tr = document.createElement("tr");
                            tr.classList.add("toggle-row3"); // ใส่ class สำหรับ toggle
                            if (!isToggled) tr.style.display = "none"; // ซ่อนถ้า toggle ยังไม่ถูกกด
                            tr.id = "row-" + index; // กำหนด ID ให้แถว

                            let employee = selectedModel === "emp" ? row.emp_code : row.com_code;
                            let type_1_count = row.type_1_count;
                            let type_3_count = row.type_3_count;

                            tr.innerHTML = `
                                    <td colspan="2">${employee}</td>
                                    <td colspan="6">${type_1_count}</td>
                                    <td colspan="6">${type_3_count}</td>
                        `;
                            tableBody.appendChild(tr);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });

            // ฟังก์ชัน toggle แถวที่ซ่อนอยู่
            function toggleRows() {
                isToggled = !isToggled; // สลับค่า true/false
                document.querySelectorAll(".toggle-row").forEach(row => {
                    row.style.display = isToggled ? "table-row" : "none";
                });
            }

            function toggleRows2() {
                let rows = document.querySelectorAll(".toggle-row2");
                rows.forEach(row => {
                    row.style.display = row.style.display === "none" ? "table-row" : "none";
                });
            }

            function toggleRows3() {
                let rows = document.querySelectorAll(".toggle-row3");
                rows.forEach(row => {
                    row.style.display = row.style.display === "none" ? "table-row" : "none";
                });
            }
        </script>


</html>