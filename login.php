<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <script src="https://kit.fontawesome.com/d90dda4fe3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="st1.css">
    <style>

        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    text-align: center;
}

.login-container {
    max-width: 600px;
    margin: 50px auto;
}

header {
    background-color: #b71c1c;
    padding: 15px;
    color: white;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;  /* Space between logo and text */
    align-items: center;  /* Vertically center the items */
}

.logo {
    display: flex;
    align-items: center;
}

.logo img {
    margin-right: 10px; /* Space between the logo and the text */
}

.logo h1 {
    display: inline-block;
    margin-left: 10px;
    font-size: 18px;
}

.login-box {
    background: #EBEBEB;
    padding: 21px;
    border-radius: 35px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 32%;
    
    /* ทำให้อยู่ตรงกลาง */
    margin: 48px auto;  /* ใช้ margin auto แทน */
}
header p {
    text-align: center;
    flex-grow: 1;
    font-size: 24px;  /* Increase font size */
    font-weight: bold;
    margin-right: 180px; 
}


.login-logo {
    width: 100px;
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    background-color: #b71c1c;
    border: none;
    color: white;
    border-radius: 5px;
}

.footer-text {
    margin-top: 10px;
    font-size: 14px;
}

    </style>
</head>

<body>
<div class="container">
<header>
<div class="logo">
<img src="./img/Logo2.png" alt="Logo" class="hd_logo">
</div>
<p>CMI Performance Monitoring Dashboard<i class="fas fa-share-square"></i></p>
    </header>
    </div>
    <div class="login-box">
            <img src="img/12345.png" class="login-logo" alt="CMIMFI Logo">
            <h2>ຂໍ້ມູນເຂົ້າລະບົບ</h2>
            <p>ກະລຸນາໃສ່ ຊື່ຜູ້ໃຊ້ ແລະ ລະຫັດຜ່ານ ເພື່ອເຂົ້ານຳໃຊ້</p>

            <form action="dashboard.html" method="POST">
                <input type="text" class="form-control" placeholder="Username" required>
                <input type="password" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
            </form>

            <p class="footer-text">ເຂົ້າໃຈໂລກ ເຂົ້າເຖິງງ່າຍ ຍຶດໝັ້ນໃນຫຼັກການ</p>
        </div>
</body>

</html>