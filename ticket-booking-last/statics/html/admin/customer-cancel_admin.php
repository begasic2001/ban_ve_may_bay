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
	<div class="wrapper">
		<!-- ==== FOOTER ==== -->
		<?php
			include ("sidebar.php");
		?>

		<div class="medium-font container">
			<h2 class="title-font">Danh sách khách hàng đã hủy</h2>
			<form action="../../php/admin/admin_view_delete_tickets_form_handler.php" method="post" class="form-data" target="result">
				<div class="form-input">
					<label>Mã chuyến bay:</label>
					<input type="text" name="flight_no" required />
				</div>
				<div class="form-input">
					<label>Ngày bắt đầu:</label>
					<input type="date" name="departure_date" required />
				</div>

				<button type="submit" name="Submit" class="btn btn--success no-bor-outl-deco">Tìm kiếm</button>
			</form>

			<!-- ==== RESULT ==== -->
			<iframe src="../../php/admin/admin_view_delete_tickets_form_handler.php" name="result">
			</iframe>
		</div>
	</div>
</body>
</html>