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

	<!-- ==== CDN ==== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />

	<!-- ==== CSS ==== -->
	<link rel="stylesheet" href="../../css/common.css" />
	<link rel="stylesheet" href="../../css/page/header.css">
	<link rel="stylesheet" href="../../css/page/footer.css">
	<link rel="stylesheet" href="../../css/user/search-ticket_first.css" />

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

		<section class="container">
			<!-- ==== PROGRESS ==== -->
			<section class="title-font progress">
				<div class="progress__step">
					<span class="progress__num progress__num--checked">1</span>
					<p class="progress__title">Chọn vé</p>
				</div>
				<div class="progress__step">
					<span class="progress__num">2</span>
					<p class="progress__title">Thông tin hành khách</p>
				</div>
				<div class="progress__step">
					<span class="progress__num">3</span>
					<a class="progress__title">Xác nhận</a>
				</div>
			</section>

			<div class="default-font result">
				<h2 class="text-center title-font">Chuyến Bay Hiện Có</h2>
				<?php
					if(isset($_POST['Search'])) {
						$data_missing = array();
						if(empty($_POST['origin'])) {
							$data_missing[] = 'Origin';
						} else {
							$origin = $_POST['origin'];
						}

						if(empty($_POST['destination'])) {
							$data_missing[] = 'Destination';
						} else {
							$destination = $_POST['destination'];
						}

						if(empty($_POST['dep_date'])) {
							$data_missing[] = 'Departure Date';
						} else {
							$dep_date = trim($_POST['dep_date']);
						}

						if(empty($_POST['no_of_pass'])) {
							$data_missing[] = 'No. of Passengers';
						} else {
							$no_of_pass=trim($_POST['no_of_pass']);
						}

						if(empty($_POST['class'])) {
							$data_missing[] = 'Class';
						} else {
							$class = trim($_POST['class']);
						}

						if(empty($data_missing)) {
							$_SESSION['no_of_pass'] = $no_of_pass;
							$_SESSION['class'] = $class;
							$count = 1;
							$_SESSION['count'] = $count;
							$_SESSION['journey_date'] = $dep_date;
							require_once('../../php/mysqli_connect.php');
							if($class=="economy") {
								$query = 
								"SELECT ma_chuyen_bay,from_city,to_city,ngay_bat_dau,gio_bat_dau,ngay_ket_thuc,gio_ket_thuc,gia_economy,ngay_ve 
									FROM chuyen_bay
									where from_city=? 
									and to_city=? 
									and ngay_bat_dau=? 
									and so_luong_economy>=?
									and ngay_ve IS NULL 
									ORDER BY  gio_bat_dau";
								$stmt = mysqli_prepare($dbc, $query);
								mysqli_stmt_bind_param($stmt, "sssi", $origin, $destination, $dep_date, $no_of_pass);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_bind_result($stmt, $flight_no, $from_city, $to_city, $departure_date, $departure_time, $arrival_date, $arrival_time, $price_economy, $ngay_ve);
								mysqli_stmt_store_result($stmt);
								
								if(mysqli_stmt_num_rows($stmt)==0) {
									echo "<h3>Không tìm thấy chuyến bay nào !</h3>";
								} else {
									echo "<form action=\"passenger-info_second.php\" method=\"post\" class=\"text-center\">";
									echo "<table class=\"res-table\"";
									echo 
									"<tr>
										<th>Mã Chuyến Bay</th>
										<th>Khởi Hành</th>
										<th>Kết Thúc</th>
										<th>Ngày BĐ</th>
										<th>Thời Gian BĐ</th>
										<th>Ngày KT</th>
										<th>Thời Gian KT</th>
										<th>Giá vé (ECONOMY)</th>
										<th>Chọn</th>
									</tr>";
									while(mysqli_stmt_fetch($stmt)) {
										echo 
										"<tr>
											<td>".$flight_no."</td>
											<td>".$from_city."</td>
											<td>".$to_city."</td>
											<td>".$departure_date."</td>
											<td>".$departure_time."</td>
											<td>".$arrival_date."</td>
											<td>".$arrival_time."</td>
											<td>".number_format($price_economy,0,',',',')." VNĐ</td>
											<td><input type=\"radio\" name=\"select_flight\" value=\"".$flight_no."\"></td>
										</tr>";
									}
									echo "</table> <br>";
									echo "<button type=\"submit\" name=\"Select\" class=\"btn btn--success no-bor-outl-deco res__btn\">Tiếp tục</button>";
									echo "</form>";
								}
							} else if($class=="business") {
								$query=
									"SELECT ma_chuyen_bay, from_city, to_city, ngay_bat_dau, gio_bat_dau, ngay_ket_thuc, gio_ket_thuc, gia_business, ngay_ve  
									FROM chuyen_bay
									where from_city=? and to_city=? and ngay_bat_dau=? and so_luong_business>=? 
									and ngay_ve IS NULL 
									ORDER BY  gio_bat_dau";
								$stmt=mysqli_prepare($dbc,$query);
								mysqli_stmt_bind_param($stmt, "sssi", $origin, $destination, $dep_date, $no_of_pass);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_bind_result($stmt, $flight_no, $from_city, $to_city, $departure_date, $departure_time, $arrival_date, $arrival_time, $price_business, $ngay_ve);
								mysqli_stmt_store_result($stmt);

								if(mysqli_stmt_num_rows($stmt)==0) {
									echo "<h3>Không Tìm Thấy Chuyến Bay Nào !</h3>";
								} else {
									echo "<form action=\"passenger-info_second.php\" method=\"post\" class=\"text-center\">";
									echo "<table class=\"res-table\">";
									echo 
									"<tr>
										<th>Mã Chuyến Bay</th>
										<th>Khởi Hành</th>
										<th>Kết Thúc</th>
										<th>Ngày BĐ</th>
										<th>Thời Gian BĐ</th>
										<th>Ngày KT</th>
										<th>Thời Gian KT</th>
										<th>Giá vé (Business)</th>
										<th>Chọn</th>
									</tr>";

									while(mysqli_stmt_fetch($stmt)) {
										echo 
										"<tr>
											<td>".$flight_no."</td>
											<td>".$from_city."</td>
											<td>".$to_city."</td>
											<td>".$departure_date."</td>
											<td>".$departure_time."</td>
											<td>".$arrival_date."</td>
											<td>".$arrival_time."</td>
											<td>".number_format($price_business,0,',',',')."VNĐ</td>
											<td><input type=\"radio\" name=\"select_flight\" value=".$flight_no."></td>
										</tr>";
									}
									echo "</table> <br>";
									echo "<button type=\"submit\" name=\"Select\" class=\"btn btn--success no-bor-outl-deco res__btn\">Tiếp tục</button";
									echo "</form>";
								}
							}	
							
							mysqli_stmt_close($stmt);
							mysqli_close($dbc);
						} else {
							echo "Ô dữ liệu đang trống! <br>";
							foreach($data_missing as $missing) {
								echo $missing ."<br>";
							}
						}
					} else {
						echo "Bạn Chưa Chọn Vé";
					}
				?>
			</div>
		</section>

		<!-- ==== FOOTER ==== -->
		<?php
			include ("../footer.php");
		?>
	</div>
</body>
</html>