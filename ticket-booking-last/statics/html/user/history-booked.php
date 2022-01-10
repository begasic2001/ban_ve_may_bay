<?php
	session_start();
?>
<html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Tra cứu vé</title>

	<!-- ==== CDN ==== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />

	<!-- ==== CSS ==== -->
	<link rel="stylesheet" href="../../css/common.css" />
	<link rel="stylesheet" href="../../css/page/header.css">
	<link rel="stylesheet" href="../../css/page/footer.css">
	<link rel="stylesheet" href="../../css/user/history-booked.css" />

	<style>
		.header {
			justify-content: space-between;
		}
		
		.footer {
			transform: translateY(40%);
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<!-- ==== HISTORY ==== -->
		<div class="default-font container">
			<h2 class="title-font text-center">LỊCH SỬ ĐẶT VÉ</h2>
			<?php
				$todays_date = date('Y-m-d');
				$thirty_days_before_date = date_create(date('Y-m-d'));
				date_sub($thirty_days_before_date, date_interval_create_from_date_string("30 days")); 
				$thirty_days_before_date = date_format($thirty_days_before_date, "Y-m-d");
				
				$customer_id = $_SESSION['login_user'];
				require_once('../../php/mysqli_connect.php');
				$query = 
				"SELECT t.code_ve,t.ngay_dat_ve,t.ma_chuyen_bay,t.ngay_bat_dau,t.loai,t.trang_thai_dat,t.ma_khach_bay,t.ma_hoa_don,t.ngay_ve , p.ten_khach_bay , s.tong_tien , k.ten , k.dia_chi
					FROM ve t , khach_bay p , hoa_don s , khach_mua k
					where t.ma_khach_mua=? 
					AND ngay_bat_dau>=? 
					and t.code_ve = p.code_ve
					and t.code_ve = s.code_ve
					and t.ma_khach_mua = k.ma_khach_mua
					AND trang_thai_dat='CONFIRMED' 
					ORDER BY  ngay_bat_dau";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ss", $customer_id, $todays_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $flight_no,$journey_date, $class, $booking_status, $no_of_passengers, $payment_id,$ngay_ve1,$ten_khach_bay, $tong_tien,$ten, $dia_chi);
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 0) {
					echo "<h3><center>Không có chuyến đi !</center></h3>";
				} else {
					echo "<div class=\"flights\">";
						echo "<h3 class=\"text-center medium-font\">Các chuyến chuẩn bị bay</h3>";
						echo "<table class=\"text-center flights-data\">";
							echo "<thead>";
							echo
								"<th>Code vé</th>
								<th>Ngày đặt vé</th>
								<th>Mã Chuyến Bay</th>
								<th>Ngày bắt đầu</th>
								<th>Ngày Về</th>
								<th>Loại Vé</th>
								<th>Tình Trạng </th>
								<th>Số Khách Bay</th>
								<th>Mã Hoá Đơn</th>
								<th>Tên Khách Mua</th>
								<th> Tên Khách Bay</th>
								<th>Địa Chỉ</th>
								<th>Tổng Tiền</th>";
							echo "</thead>";

						while(mysqli_stmt_fetch($stmt)) {
							if($ngay_ve1) {
								$ngay_ve1 = $ngay_ve1;
							} else {
								$ngay_ve1 = "Trống";
							}

							echo "<tbody>";
								echo
									"<tr>
										<td>".$pnr."</td>
										<td>".$date_of_reservation."</td>
										<td>".$flight_no."</td>
										<td>".$journey_date."</td>
										<td>".$ngay_ve1."</td>
										<td>".$class."</td>
										<td>".$booking_status."</td>
										<td>".$no_of_passengers."</td>
										<td>".$payment_id."</td>
										<td>".$ten."</td>
										<td>".$ten_khach_bay."</td>
										<td>".$dia_chi."</td>
										<td>".number_format($tong_tien,0,',',',')."VNĐ</td>
									</tr>";
							echo "</tbody>";
						}
						echo "</table>";
					echo "</div>";
				}

				
				$query = 
				"SELECT t.code_ve,t.ngay_dat_ve,t.ma_chuyen_bay,t.ngay_bat_dau,t.loai,t.trang_thai_dat,t.ma_khach_bay,t.ma_hoa_don,t.ngay_ve , p.ten_khach_bay , s.tong_tien , k.ten , k.dia_chi
					FROM ve t , khach_bay p , hoa_don s , khach_mua k
					where t.ma_khach_mua=? 
					and ngay_bat_dau<? 
					and ngay_bat_dau>=? 
					and t.code_ve = p.code_ve
					and t.code_ve = s.code_ve
					and t.ma_khach_mua = k.ma_khach_mua
					ORDER BY  ngay_bat_dau";
				$stmt=mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "sss", $customer_id, $todays_date,$thirty_days_before_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $flight_no, $journey_date, $class, $booking_status, $no_of_passengers, $payment_id, $ngay_ve1, $ten_khach_bay, $tong_tien, $ten, $dia_chi);
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt)==0) {
					echo "<h3><center>Không Có Chuyến Bay Hoàn Thành Trong 30 Ngày!</center></h3>";
				} else {
					echo "<div class=\"flights\">";
						echo "<h3 class=\"text-center medium-font\">Các chuyến đã bay</h3>";
						echo "<table class=\"text-center flights-data\">";
						echo "<thead>";
							echo 
								"<th>Code Vé</th>
								<th>Ngày đặt vé</th>
								<th>Mã Chuyến Bay</th>
								<th>Ngày bắt đầu</th>
								<th>Ngày Về</th>
								<th>Loại Vé</th>
								<th>Tình Trạng </th>
								<th>Số Khách Bay</th>
								<th>Mã Hoá Đơn</th>
								<th>Tên Khách Mua</th>
								<th> Tên Khách Bay</th>
								<th>Địa Chỉ</th>
								<th>Tổng Tiền</th>";
						echo "</thead>";
						while(mysqli_stmt_fetch($stmt)) {
							if($ngay_ve1) {
								$ngay_ve1 = $ngay_ve1;
							}
							else {
								$ngay_ve1 = "Trống";
							}
						echo "<tbody>";
							echo 
								"<tr>
										<td>".$pnr."</td>
										<td>".$date_of_reservation."</td>
										<td>".$flight_no."</td>
										<td>".$journey_date."</td>
										<td>".$ngay_ve1."</td>
										<td>".$class."</td>
										<td>".$booking_status."</td>
										<td>".$no_of_passengers."</td>
										<td>".$payment_id."</td>
										<td>".$ten."</td>
										<td>".$ten_khach_bay."</td>
										<td>".$dia_chi."</td>
										<td>".number_format($tong_tien,0,',',',')."VNĐ</td>
									</tr>";
						}
					echo "</table>";
				}
				
				mysqli_stmt_close($stmt);
				mysqli_close($dbc);
			?>
		</div>

		<!-- ==== FOOTER ==== -->
		<?php
			include (".../footer.php");
		?>
	</div>
</body>
</html>