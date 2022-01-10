<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sidbar</title>

	<!-- ==== CDN ==== -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
		rel="stylesheet"
	/>
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
	/>

	<!-- ==== CSS ==== -->
	<link rel="stylesheet" href="../../css/common.css" />
	<link rel="stylesheet" href="../../css/admin/sidebar.css" />
	<link rel="stylesheet" href="../../css/admin/manage-customer_admin.css">
</head>
<body>
	<?php
		if(isset($_POST['Submit'])) {
			$data_missing = array();

			if(empty($_POST['flight_no'])) {
				$data_missing[] = 'Flight No.';
			} else {
				$flight_no = trim($_POST['flight_no']);
			}

			if(empty($_POST['departure_date'])) {
				$data_missing[] = 'Departure Date';
			} else {
				$departure_date = $_POST['departure_date'];
			}

			if(empty($data_missing)) {
				require_once('../mysqli_connect.php');
				$query = 
					"SELECT t.code_ve,t.ngay_dat_ve,t.loai,t.ma_khach_bay,t.ma_hoa_don,t.ma_khach_mua,t.ma_chuyen_bay,t.ngay_bat_dau,t.ngay_ve , p.ten_khach_bay , s.tong_tien , k.ten , k.dia_chi
					FROM ve t, khach_bay p , hoa_don s , khach_mua k
					where t.ma_chuyen_bay=? 
					and ngay_bat_dau=? 
					and t.code_ve = p.code_ve
					and t.code_ve = s.code_ve
					and t.ma_khach_mua = k.ma_khach_mua
					and trang_thai_dat='CANCELED' 
					ORDER BY loai";
				$stmt = mysqli_prepare($dbc,$query);
				mysqli_stmt_bind_param($stmt, "ss", $flight_no, $departure_date);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $pnr, $date_of_reservation, $class, $no_of_passengers, $payment_id, $customer_id, $ma_chuyen_bay, $ngay_bat_dau, $ngay_ve, $ten_khach_bay, $tong_tien, $ten, $dia_chi);
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt)==0) {
					echo "<h3 class=\"medium-font\">Không có thông tin về vé đã đặt!</h3>";
				} else {
					echo "<table class=\"text-center default-font data-result\">";
					echo 
						"<thead>
							<th>Code Vé</th>
							<th>Ngày đặt vé</th>
							<th>Loại Vé</th>
							<th>Mã chuyến bay</th>
							<th>Ngày Bắt Đầu</th>
							<th>Ngày Về</th>
							<th>Số Khách Bay</th>
							<th>Mã Hoá Đơn</th>
							<th>Tên Khách Mua</th>
							<th>Địa Chỉ</th>
							<th>Tên Khách Bay</th>
							<th>Tổng Tiền</th>
						</thead>";
					
					while(mysqli_stmt_fetch($stmt)) {
						if($ngay_ve!="") {
							$ngay_ve = $ngay_ve;
						} else {
							$ngay_ve = "Trống";
						}
					echo
					 "<tbody>
					 		<tr>
								<td>".$pnr."</td>
								<td>".$date_of_reservation."</td>
								<td>".$class."</td>
								<td>".$ma_chuyen_bay."</td>
								<td>".$ngay_bat_dau."</td>
								<td>".$ngay_ve."</td>
								<td>".$no_of_passengers."</td>
								<td>".$payment_id."</td>
								<td>".$ten."</td>
								<td>".$dia_chi."</td>
								<td>".$ten_khach_bay."</td>
								<td>".number_format($tong_tien,0,',',',')."VNĐ</td>
							</tr>
						</tbody>";
					}
					echo "</table>";
				}

				mysqli_stmt_close($stmt);
				mysqli_close($dbc);
			} else {
				echo "The following data fields were empty! <br>";
				foreach($data_missing as $missing) {
					echo $missing ."<br>";
				}
			}
		}
	?>
</body>
</html>