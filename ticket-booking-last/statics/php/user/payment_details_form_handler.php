<?php
	session_start();
?>
<html>
	<head>
		<title>Gửi chi tiết thanh toán</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Pay_Now'])) {
				$no_of_pass = $_SESSION['no_of_pass'];
				$flight_no = $_SESSION['flight_no'];
				$journey_date = $_SESSION['journey_date'];
				$class = $_SESSION['class'];
				$pnr = $_SESSION['pnr'];
				$payment_id=$_SESSION['payment_id'];
				$total_amount=$_SESSION['total_amount'];
				$payment_date=$_SESSION['payment_date'];
				$payment_mode=$_POST['payment_mode'];				

				require_once('../mysqli_connect.php');
				if($class=='economy')
				{
					$query="UPDATE chuyen_bay SET so_luong_economy=so_luong_economy-? WHERE ma_chuyen_bay=? AND ngay_bat_dau=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$journey_date);
					mysqli_stmt_execute($stmt);
					$affected_rows_1=mysqli_stmt_affected_rows($stmt);
					echo $affected_rows_1.'<br>';
					mysqli_stmt_close($stmt);
				}
				else if($class=='business')
				{
					$query="UPDATE chuyen_bay SET so_luong_business=so_luong_business-? WHERE ma_chuyen_bay=? AND ngay_bat_dau=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$journey_date);
					mysqli_stmt_execute($stmt);
					$affected_rows_1=mysqli_stmt_affected_rows($stmt);
					echo $affected_rows_1.'<br>';
					mysqli_stmt_close($stmt);
				}

				if($affected_rows_1==1)
				{
					echo "Successfully Updated Seats<br>";

					$query="INSERT INTO hoa_don (ma_hoa_don,code_ve,ngay_thanh_toan,tong_tien,phuong_thuc) VALUES (?,?,?,?,?)";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"sssis",$payment_id,$pnr,$payment_date,$total_amount,$payment_mode);
					mysqli_stmt_execute($stmt);
					$affected_rows_2=mysqli_stmt_affected_rows($stmt);
					echo $affected_rows_2.'<br>';
					mysqli_stmt_close($stmt);
					if($affected_rows_2==1)
					{
						echo "Successfully Updated Payment Details<br>";
						header('location:../../html/user/ticket-success.php');
					}
					else
					{
						echo "Submit Error";
						echo mysqli_error();
					}
				}
				else
				{
					echo "Submit Error";
					echo mysqli_error();
				}
				mysqli_close($dbc);
			}
			else
			{
				echo "Payment request not received";
			}
		?>
	</body>
</html>