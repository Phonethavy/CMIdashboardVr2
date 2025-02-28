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
    <link rel="stylesheet" href="css/st1.css">
    <link rel="stylesheet" href="service.css">
    <style>
           body {
            font-family: Arial, sans-serif;
        }

      
    </style>
</head>

<body>
<div class="container">
<header>
<div class="logo">
<img src="./img/Logo2.png" alt="Logo" class="hd_logo">
</div>
        <nav>
            <ul>
            <li><a href="index.php"><i class="fa-solid fa-house-chimney"></i></i> Home</a></li>
                    <li><a href="page1_cmi_kpi/kpi.php"><i class="far fa-chart-bar"></i>KPI</a></li>
                    <li><a href="page1_cmi_act/act.php"><i class="fas fa-dollar-sign"></i>Financial</a></li>
                    <li><a href="page1_cmi_sv/service.php"><i class="fas fa-id-card"></i>Service</a></li>
            </ul>
        </nav>
        <div class="profile">
            <img src="img/jay.jpg" alt="User">
            <div class="user-info">
                <span>Phonethavy Sengsoulichanh</span>
                <small>IT DEV</small>
            </div>
        </div>
    </header>

       
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