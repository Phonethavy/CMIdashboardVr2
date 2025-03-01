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
    <script src="https://kit.fontawesome.com/d90dda4fe3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- XLSX library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/st1.css">
</head>
<style>
    .custom-navbar {
        background-color: #BA1C1C !important;
    }

    .navbar-nav .nav-link {
        font-weight: 800;
        padding: 10px;
        transition: 0.5s;
        border-radius: 5px;
        text-decoration: none;
        color: #ffffff;
    }

    .navbar-nav .nav-link:hover {
        color: #000000 !important;
        background-color: #ffffff;
    }

    /* ทำให้ไอคอนในลิงก์เป็นสีขาว */
    .navbar-nav .nav-link i {
        color: #ffffff;
        margin-right: 5px;
    }

    .nav-link {
        color: #ffffff;
        margin-right: 5px;
    }

    /* เปลี่ยนสีไอคอนตอน hover */
    .navbar-nav .nav-link:hover i {
        color: #000000;
    }

    /* ปรับขนาดปุ่ม toggle */
    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30' width='30' height='30'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container-fluid">
                <img src="../img/logo2.png" alt="Logo" width="170em" height="50em">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../navbar/header.php"><i class="fa-solid fa-house"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../page1_cmi_kpi/kpi.php"><i class="far fa-chart-bar"></i>KPI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../page1_cmi_act/act.php"><i class="fas fa-dollar-sign"></i>Financial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../page1_cmi_sv/service.php"><i class="fas fa-id-card"></i>Service</a>
                        </li>
                    </ul>
                </div>
                <div class="profile">
                    <img src="../img/jay.jpg" alt="User">
                    <div class="user-info">

                        <a class="nav-link">Phonethavy Sengsoulichanh</a>

                        <a class="nav-link">IT DEV</a>

                    </div>
                </div>
            </div>

        </nav>




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








    </div>

</body>

</html>