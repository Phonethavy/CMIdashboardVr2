<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMIMFI Dashboard</title>

    <link rel="stylesheet" href="st1.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        /* ตั้งค่าทั่วไป */
        body {
            font-family: 'Times New Roman', Times, serif, 'Noto Sans Lao';
            margin: 0;
            padding: 0;
            text-align: center;
            background: #fff;
        }
    </style>
</head>

<body>
    <?php include 'index.php'; ?>

    <main>
        <div class="logo-center">
            <img src="img/12345.png" alt="CMIMFI Logo">
        </div>
        <h1>ຍິນດີຕ້ອນຮັບສູ່ລະບົບຕິດຕາມຜົນງານ</h1>

        <section class="stats">
            <div class="stat-item">
                <i class="fas fa-wallet"></i>
                <h3>ລາຍຮັບທັງໝົດ</h3>
                <p>150,000,000,000</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-money-bill-wave"></i>
                <h3>ລາຍຮັບອື່ນໆ</h3>
                <p>8,400,000,000</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <h3>ລູກຄ້າ</h3>
                <p>28,000</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-chart-line"></i>
                <h3>ລາຍຈ່າຍດຳເນີນງານ</h3>
                <p>20%</p>
            </div>
        </section>
    </main>
</body>

</html>