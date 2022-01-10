<?php
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','ticket_booking');

$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
OR dies('Không thể kết nối:' .
	mysqli_connect_error());
?>
