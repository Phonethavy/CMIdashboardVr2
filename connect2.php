<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cmi_database_system";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); // แสดงข้อความที่ชัดเจนเมื่อการเชื่อมต่อล้มเหลว
    } else {
        echo ""; // ไม่แสดงข้อความในกรณีที่เชื่อมต่อสำเร็จ (สามารถแสดง Connection successful ระหว่างทดสอบได้)
    }
?>
