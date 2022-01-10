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
	<link rel="stylesheet" href="../../css/admin/delete-flight.css">
</head>
<body>
	<div class="default-font wrapper">
		<h2 class="title-font text-center">Xóa chuyên bay</h2>
		<form action="../../php/admin/delete_flight_details_form_handler.php" method="post" class="form-data">
			<div>

				<?php
					if(isset($_GET['msg']) && $_GET['msg']=='success') {
						echo "<strong style='color:green; padding-left:20px;'>Lịch bay đã được xóa thành công.</strong>
							<br>
							<br>";
					}
					else if(isset($_GET['msg']) && $_GET['msg']=='failed') {
						echo "<strong style='color:red; padding-left:20px;'>*Mã chuyến bay / Ngày khởi hành không hợp lệ, vui lòng nhập lại.</strong>
							<br>
							<br>";
					}
				?>

				<div class="form-list">
					<div class="form-input">
						<label>Mã chuyến bay:</label>
						<input type="text" name="flight_no" required>
					</div>
					<div class="form-input">
						<label>Ngày khởi hành:</label>
						<input type="date" name="departure_date" required>
					</div>
					<button type="submit" name="Delete" class="btn btn--success no-bor-outl-deco">Xóa</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>