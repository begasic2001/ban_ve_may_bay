<?php
	session_start();
?>
<html>
	<head>
		<title>
			HUỶ VÉ
		</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Cancel_Ticket']))
			{
				$data_missing=array();
				if(empty($_POST['pnr']))
				{
					$data_missing[]='PNR';
				}
				else
				{
					$pnr=trim($_POST['pnr']);
				}

				if(empty($data_missing))
				{
					require_once('../mysqli_connect.php');

					$todays_date=date('Y-m-d'); 
					$customer_id=$_SESSION['login_user'];

					$query="SELECT count(*) 
					from ve t 
					WHERE code_ve=? and ngay_bat_dau>=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$pnr,$todays_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$cnt);
					mysqli_stmt_fetch($stmt);
					mysqli_stmt_close($stmt);
					if($cnt!=1)
					{
						mysqli_close($dbc);
						header("location: ../../html/user/cancel-ticket.php?msg=failed");
					}
					$query="UPDATE ve 
					SET trang_thai_dat='CANCELED' 
					WHERE code_ve=? and ma_khach_mua=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$pnr,$customer_id);
					mysqli_stmt_execute($stmt);
					$affected_rows=mysqli_stmt_affected_rows($stmt);
					//echo $affected_rows."<br>";
					// mysqli_stmt_bind_result($stmt,$cnt);
					// mysqli_stmt_fetch($stmt);
					// echo $cnt;
					mysqli_stmt_close($stmt);
					if($affected_rows==1)
					{
						$query="SELECT t.ma_chuyen_bay,t.ngay_bat_dau,t.ma_khach_bay,t.loai,0.85*p.tong_tien 
						as refund_amount 
						from ve t,hoa_don p 
						WHERE t.code_ve=? 
						and t.code_ve=p.code_ve";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"s",$pnr);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$flight_no,$journey_date,$no_of_pass,$class,$refund_amount);
						mysqli_stmt_fetch($stmt);
						mysqli_stmt_close($stmt);
						$_SESSION['refund_amount']=$refund_amount;
						if($class=='economy')
						{
							$query="UPDATE chuyen_bay SET so_luong_economy=so_luong_economy+? WHERE ma_chuyen_bay=? AND ngay_bat_dau=?";
							$stmt=mysqli_prepare($dbc,$query);
							mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$journey_date);
							mysqli_stmt_execute($stmt);
							$affected_rows_1=mysqli_stmt_affected_rows($stmt);
							echo $affected_rows_1.'<br>';
							mysqli_stmt_close($stmt);
						}
						else if($class=='business')
						{
							$query="UPDATE chuyen_bay SET so_luong_business=so_luong_business+? WHERE ma_chuyen_bay=? AND ngay_bat_dau=?";
							$stmt=mysqli_prepare($dbc,$query);
							mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$journey_date);
							mysqli_stmt_execute($stmt);
							$affected_rows_1=mysqli_stmt_affected_rows($stmt);
							echo $affected_rows_1.'<br>';
							mysqli_stmt_close($stmt);
						}
						if($affected_rows_1==1)
						{

							header("location: ../../html/user/cancel-ticket_success.php");
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
						header("location: cancel-ticket.php?msg=failed");
					}
					mysqli_close($dbc);
				}
				else
				{
					echo "Ô dữ liệu trống! <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Cancel request not received";
			}
		?>
	</body>
</html>