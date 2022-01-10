<?php
	session_start();
?>

<!DOCTYPE html>
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
	<link rel="stylesheet" href="../../css/admin/add-flight.css" />
</head>
<body>
	<div class="wrapper">
		<h2 class="title-font text-center">Thêm chuyến bay</h2>
	
		<form action="../../php/admin/add_flight_details_form_handler.php" method="post" class="default-font form-data">
			<?php
				if(isset($_GET['msg']) && $_GET['msg']=='success') {
					echo "<strong style='color: green'>Thêm chuyến bay thành công.</strong>
						<br>
						<br>";
				} else if(isset($_GET['msg']) && $_GET['msg']=='failed') {
					echo "<strong style='color: red'>Thêm thất bại , vui lòng nhập lại.</strong>
					<br>
					<br>";
				}
			?>

			<div class="form-input">
				<label>Mã chuyến bay: </label>
				<input type="text" name="flight_no" required />
			</div>
			<br>
			<div class="input-box">
				<div class="form-input">
					<label>Nơi đi:</label>
					<input type="text" name="origin" required />
				</div>
				<div class="form-input">
					<label>Nơi đến:</label>
					<input type="text" name="destination" required />
				</div>
			</div>
			<br>
			<div class="input-box">
				<div class="form-input">
					<label>Ngày khởi hành:</label>
					<input type="date" name="dep_date" required>
				</div>
				<div class="form-input">
					<label>Ngày kết thúc:</label>
					<input type="date" name="arr_date" required>
				</div>
			</div>
			<br>
			<div class="input-box">
				<div class="form-input">
					<label>Thời Gian Khởi Hành:</label>
					<input type="time" name="dep_time" required>
				</div>
				<div class="form-input">
					<label>Thời Gian Kết Thúc:</label>
					<input type="time" name="arr_time" required>
				</div>
			</div>
			<br>
			<div class="input-box">
				<div class="form-input">
					<label>Sô lượng vé Economy:</label>
					<input type="number" name="seats_eco" required>
				</div>
				<div class="form-input">
					<label>Số lượng vé Business:</label>
					<input type="number" name="seats_bus" required>
				</div>
			</div>
			<br>
			<div class="input-box">
				<div class="form-input">
					<label>Giá Economy:</label>
					<input type="number" name="price_eco" required>
				</div>
				<div class="form-input">
					<label>Giá Business:</label>
					<input type="number" name="price_bus" required>
				</div>
			</div>
			<br>
			<div class="form-input">
					<label>Mã Máy Bay:</label>
					<input type="text" name="jet_id" required>
			</div>

			<button type="submit" name="Submit" class="btn btn--success no-bor-outl-deco">Thêm</button>
		</form>
	</div>
</body>
</html>