<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Tra cứu vé</title>
</head>
<body>
	<?php
		$i=1;

		if(isset($_POST['Submit'])) {
			$pnr = rand(1000000,9999999);
			$date_of_res = date("Y-m-d");
			$flight_no = $_SESSION['flight_no'];
			$journey_date = $_SESSION['journey_date'];
			$ngay_ve = $_SESSION['ngay_ve'];
			$class = $_SESSION['class'];
			$booking_status = "PENDING";
			$no_of_pass = $_SESSION['no_of_pass'];
			$lounge_access = $_POST['lounge_access'];
			$priority_checkin = $_POST['priority_checkin'];
			$insurance = $_POST['insurance'];
			$total_no_of_meals = 0;
			$_SESSION['pnr'] = $pnr;

			$_SESSION['lounge_access'] = $lounge_access;
			$_SESSION['priority_checkin'] = $priority_checkin;
			$_SESSION['insurance'] = $insurance;

			$payment_id = NULL;
			$customer_id = $_SESSION['login_user'];

			require_once('../mysqli_connect.php');

			if($_SESSION['class'] == 'economy') {	
				$query = 
					"SELECT gia_economy 
					FROM chuyen_bay 
					where ma_chuyen_bay=? 
					and ngay_bat_dau=? 
					and ngay_ve=?";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "sss", $flight_no, $journey_date, $ngay_ve);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ticket_price);
				mysqli_stmt_fetch($stmt);
			} else if($_SESSION['class']=='business') {
				$query = 
					"SELECT gia_business 
					FROM chuyen_bay 
					where ma_chuyen_bay=? 
					and ngay_bat_dau=? 
					and ngay_ve=?";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "sss", $flight_no, $journey_date, $ngay_ve);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $ticket_price);
				mysqli_stmt_fetch($stmt);
			}

			mysqli_stmt_close($stmt);
			$ff_mileage=$ticket_price/10;

			$query = 
				"INSERT INTO ve 
				(code_ve, ngay_dat_ve, ma_chuyen_bay, ngay_bat_dau, loai,trang_thai_dat,ma_khach_bay, lui_phong_cho, dang_ky_uu_tien, bao_hiem, ma_hoa_don, ma_khach_mua, ngay_ve) 
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "ssssssissssss", $pnr, $date_of_res, $flight_no, $journey_date, $class, $booking_status, $no_of_pass, $lounge_access, $priority_checkin, $insurance, $payment_id, $customer_id, $ngay_ve);
			mysqli_stmt_execute($stmt);
			$affected_rows = mysqli_stmt_affected_rows($stmt);
			echo $affected_rows.'<br>';

			if($affected_rows == 1) {
				echo "Successfully Submitted<br>";
			} else {
				echo "Submit Error";
				echo mysqli_error();
			}
			
			for($i = 1; $i <= $no_of_pass; $i++) {
				echo "frequent_flier_no=".$_POST['pass_ff_id'][$i-1].'<br>';

				if($_POST['pass_ff_id'][$i-1]=='')
					$_POST['pass_ff_id'][$i-1] = NULL;
				else {
					$query=
						"SELECT count(*) 
						from khach_mua c, ct_kh_tb f 
						WHERE c.ten=? 
						and f.ma_so=? 
						and c.ma_khach_mua=f.ma_khach_mua";
					$stmt = mysqli_prepare($dbc, $query);
					mysqli_stmt_bind_param($stmt, "ss", $_POST['pass_name'][$i-1], $_POST['pass_ff_id'][$i-1]);
					mysqli_stmt_execute($stmt);
					$affected_rows = mysqli_stmt_affected_rows($stmt);
					mysqli_stmt_bind_result($stmt, $cnt);
					mysqli_stmt_fetch($stmt);
					echo "cnt=".$cnt."<br>";
					mysqli_stmt_close($stmt);
					
					if($cnt == 1) {
						$query = 
							"UPDATE ct_kh_tb 
							SET dam_bay=dam_bay+? 
							where ma_so=?";
						$stmt = mysqli_prepare($dbc, $query);
						mysqli_stmt_bind_param($stmt, "is", $ff_mileage, $_POST['pass_ff_id'][$i-1]);
						mysqli_stmt_execute($stmt);
						$affected_rows = mysqli_stmt_affected_rows($stmt);
						echo $affected_rows.'<br>';
						mysqli_stmt_close($stmt);
					}
				}

				$query = 
					"INSERT INTO khach_bay 
					(ma_khach_bay, code_ve, ten_khach_bay, tuoi, gioi_tinh, chon_bua_an, ma_so) VALUES (?,?,?,?,?,?,?)";
				$stmt=mysqli_prepare($dbc, $query);

				if($_POST['pass_meal'][$i-1] == 'yes')
					$total_no_of_meals++;

				mysqli_stmt_bind_param($stmt, "ississs", $i,$pnr,$_POST['pass_name'][$i-1], $_POST['pass_age'][$i-1], $_POST['pass_gender'][$i-1], $_POST['pass_meal'][$i-1], $_POST['pass_ff_id'][$i-1]);
				mysqli_stmt_execute($stmt);
				$affected_rows = mysqli_stmt_affected_rows($stmt);
				echo 'Passenger added '.$affected_rows.'<br>';
			}

			$_SESSION['total_no_of_meals'] = $total_no_of_meals;
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);

			header("location: ../../html/user/confirm_khuhoi_third.php");
		} else {
			echo "Submit request not received";
		}
	?>
</body>
</html>