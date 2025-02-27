 <! DOCTYPE html>
     <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>KPIອົງກອນ</title>

         <style>
             body {
                 font-family: Arial, 'Times New Roman', 'Phetsarath OT', sans-serif;
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
                 font-size: 16px;
             }

             i.fas {
                 display: inline-block;
                 padding: 5px;
                 /* เพิ่มพื้นที่ให้คลิกง่ายขึ้น */
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

             .border-01 {
                 border-bottom: solid 8px #a31a37;
                 width: 70%;
                 margin: 0 auto;
                 border-radius: 5px;

             }

             button {
                 padding: 10px;
                 font-size: 16px;
                 margin-right: 10px;
                 cursor: pointer;
                 background-color: #db234e;
                 color: white;
                 border: none;
                 border-radius: 5px;
             }

             button:hover {
                 background-color: #a31a37;
             }

             .data2 {
                 background-color: rgb(216, 216, 216);
                 border: 2px solid #ccc;
                 /* ขอบสีเทา */
                 border-radius: 10px;
                 /* ทำให้ขอบโค้งมนเล็กน้อย */
                 padding: 10px;
                 /* เพิ่มช่องว่างรอบขอบ */
             }

             .stat-item {
                 background: none;
                 padding: 20px 0px;
                 border-radius: 10px;
                 text-align: center;
                 width: 255px;
                 margin: 19px 6px;
                 box-shadow: none;
             }

             @media only screen and (max-width: 600px) {
                 table {
                     font-size: 14px;
                 }

                 th,
                 td {
                     padding: 8px;
                 }
             }
         </style>
         <script>
        document.addEventListener('DOMContentLoaded', function() {
    // ดึงข้อมูลล่าสุดเมื่อหน้าเว็บโหลด
    fetch('../ajx_json/kpi_db.php?latest=true')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                document.querySelector('#totalkpi1 span').textContent = (data[0].KPI1 || 0).toLocaleString();
                document.querySelector('#totalkpi2 span').textContent = (data[0].KPI2 || 0).toLocaleString();
                document.querySelector('#totalkpi3 span').textContent = (data[0].KPI3 || 0).toLocaleString();
                document.querySelector('#totalkpi4 span').textContent = (data[0].calculated_kpi4_l || 0).toLocaleString() + '%';
                document.querySelector('#goalkpi1 span').textContent = (data[0].goalkpi1 || 0).toLocaleString();
                document.querySelector('#goalkpi2 span').textContent = (data[0].goalkpi2 || 0).toLocaleString();
                document.querySelector('#goalkpi3 span').textContent = (data[0].goalkpi3 || 0).toLocaleString();
                document.querySelector('#goalkpi4 span').textContent = (data[0].goalkpi4 || 0).toLocaleString() + '%';
                document.querySelector('#calculated_kpi1_goal span').textContent = (data[0].calculated_kpi1_goal || 0).toLocaleString() + '%';
                document.querySelector('#calculated_kpi2_goal span').textContent = (data[0].calculated_kpi2_goal || 0).toLocaleString() + '%';
                document.querySelector('#calculated_kpi3_goal span').textContent = (data[0].calculated_kpi3_goal || 0).toLocaleString() + '%';
                document.querySelector('#calculated_kpi4_goal span').textContent = (data[0].calculated_kpi4_goal || 0).toLocaleString() + '%';
            } else {
                // แสดงข้อความกรณีไม่มีข้อมูล
                document.querySelector('#totalkpi1 span').textContent = 0;
                document.querySelector('#totalkpi2 span').textContent = 0;
                document.querySelector('#totalkpi3 span').textContent = 0;
                document.querySelector('#totalkpi4 span').textContent = 0;
                document.querySelector('#goalkpi1 span').textContent = 0;
                document.querySelector('#goalkpi2 span').textContent = 0;
                document.querySelector('#goalkpi3 span').textContent = 0;
                document.querySelector('#goalkpi4 span').textContent = 0;
                document.querySelector('#calculated_kpi1_goal span').textContent = 0;
                document.querySelector('#calculated_kpi2_goal span').textContent = 0;
                document.querySelector('#calculated_kpi3_goal span').textContent = 0;
                document.querySelector('#calculated_kpi4_goal span').textContent = 0;
            }
        })
        .catch(error => console.error('Error:', error));

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const params = new URLSearchParams(formData).toString();

        fetch('../ajx_json/kpi_db.php?' + params)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    document.querySelector('#totalkpi1 span').textContent = (data[0].KPI1 || 0).toLocaleString();
                    document.querySelector('#totalkpi2 span').textContent = (data[0].KPI2 || 0).toLocaleString();
                    document.querySelector('#totalkpi3 span').textContent = (data[0].KPI3 || 0).toLocaleString();
                    document.querySelector('#totalkpi4 span').textContent = (data[0].calculated_kpi4_l || 0).toLocaleString() + '%';
                    document.querySelector('#goalkpi1 span').textContent = (data[0].goalkpi1 || 0).toLocaleString();
                    document.querySelector('#goalkpi2 span').textContent = (data[0].goalkpi2 || 0).toLocaleString();
                    document.querySelector('#goalkpi3 span').textContent = (data[0].goalkpi3 || 0).toLocaleString();
                    document.querySelector('#goalkpi4 span').textContent = (data[0].goalkpi4 || 0).toLocaleString() + '%';
                    document.querySelector('#calculated_kpi1_goal span').textContent = (data[0].calculated_kpi1_goal || 0).toLocaleString() + '%';
                    document.querySelector('#calculated_kpi2_goal span').textContent = (data[0].calculated_kpi2_goal || 0).toLocaleString() + '%';
                    document.querySelector('#calculated_kpi3_goal span').textContent = (data[0].calculated_kpi3_goal || 0).toLocaleString() + '%';
                    document.querySelector('#calculated_kpi4_goal span').textContent = (data[0].calculated_kpi4_goal || 0).toLocaleString() + '%';
                } else {
                    // จัดการกรณีไม่มีข้อมูล
                }
            })
            .catch(error => console.error('Error:', error));
    });



                 // Export table to Excel
                 window.ExportToExcel = function(type, fn, dl) {
                     const elt = document.getElementById('data-table');
                     const wb = XLSX.utils.table_to_book(elt, {
                         sheet: "sheet1"
                     });
                     return dl ?
                         XLSX.write(wb, {
                             bookType: type,
                             bookSST: true,
                             type: 'base64'
                         }) :
                         XLSX.writeFile(wb, fn || ('KPI_Employee.' + (type || 'xlsx')));
                 };
             });
         </script>
     </head>
     <?php include("../navbar/header.php"); ?>

     <body>
         <main>
             <div class="logo-center">
                 <img src="../img/12345.png" alt="CMIMFI Logo">
             </div>
             <h1>ຍິນດີຕ້ອນຮັບສູ່ລະບົບຕິດຕາມຜົນງານ</h1>
             <div class="container mt-4">
                 <form id="searchForm" class="d-flex justify-content-center align-items-center gap-2">

                     <label for="startdate" class="fw-bold">From</label>
                     <input type="date" id="startdate" name="startdate" class="form-control form-control-sm w-auto" required>

                     <label for="enddate" class="fw-bold">To</label>
                     <input type="date" id="enddate" name="enddate" class="form-control form-control-sm w-auto" required>

                     <button type="submit" class="btn btn-danger btn-sm">
                         <i class="fa-solid fa-magnifying-glass"></i>
                     </button>
                 </form>



             </div>
             <section class="stats">
                 <div class="stat-item">
                     <a href="../page2_cmi_kpi/kpi1.php"><i class="fas fa-wallet"></i></a>
                     <div class="border-01"></div>
                     <h3>ລາຍຮັບທັງໝົດ</h3>
                     <h1>ເປົ້າໝາຍ</h1>
                     <p id="goalkpi1"> <span></span></p>
                     <div class="data2">
                         <p id="totalkpi1"> <span></span></p>
                         <p id="calculated_kpi1_goal"> <span></span></p>
                     </div>

                 </div>


                 <div class="stat-item">
                     <a href="../page2_cmi_kpi/kpi2.php"><i class="fas fa-money-bill-wave"></i></a>
                     <div class="border-01"></div>
                     <h3>ລາຍຮັບອື່ນໆ</h3>
                     <h1>ເປົ້າໝາຍ</h1>
                     <p id="goalkpi2"> <span></span></p>
                     <div class="data2">
                         <p id="totalkpi2"> <span></span></p>
                         <p id="calculated_kpi2_goal"> <span></span></p>
                     </div>
                 </div>
                 <div class="stat-item">
                     <a href="../page2_cmi_kpi/kpi3.php"><i class="fas fa-users"></i></a>
                     <div class="border-01"></div>
                     <h3>ລູກຄ້າ</h3>
                     <h1>ເປົ້າໝາຍ</h1>
                     <p id="goalkpi3"> <span></span></p>
                     <div class="data2">
                         <p id="totalkpi3"> <span></span></p>
                         <p id="calculated_kpi3_goal"> <span></span></p>
                     </div>
                 </div>
                 <div class="stat-item">
                     <a href="../page2_cmi_kpi/kpi4.php"><i class="fas fa-chart-line"></i></a>
                     <div class="border-01"></div>

                     <h3>ລາຍຈ່າຍດຳເນີນງານ</h3>
                     <h1>ເປົ້າໝາຍ</h1>
                     <p id="goalkpi4"> <span></span></p>
                     <div class="data2">
                         <p id="totalkpi4"> <span></span></p>
                         <p id="calculated_kpi4_goal"> <span></span></p>
                     </div>
                 </div>
             </section>
         </main>

         </div>

         <script>
             /* When the user clicks on the button, 
                toggle between hiding and showing the dropdown content */
             function myFunction() {
                 document.getElementById("myDropdown").classList.toggle("show");
             }

             // Close the dropdown if the user clicks outside of it
             window.onclick = function(event) {
                 if (!event.target.matches('.dropbtn')) {
                     var dropdowns = document.getElementsByClassName("dropdown-content");
                     var i;
                     for (i = 0; i < dropdowns.length; i++) {
                         var openDropdown = dropdowns[i];
                         if (openDropdown.classList.contains('show')) {
                             openDropdown.classList.remove('show');
                         }
                     }
                 }
             }
         </script>
     </body>

     </html>