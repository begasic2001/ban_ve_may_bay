<?php
    $conn = @new mysqli('localhost', 'root', '', 'ticket_booking');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
    $ma_chuyen_bay = $_GET["ma_chuyen_bay"];
    $sql = "DELETE FROM chuyen_bay where ma_chuyen_bay='$ma_chuyen_bay'";
    
    $res = $conn->query($sql);

    
    $conn->close();

    header("location: ../../html/admin/all-list-flight.php");
?>