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
	<link rel="stylesheet" href="../../css/admin/add-flight.css">
</head>
<body>
	<div class="wrapper">
		<h2 class="title-font text-center">Nhập mã máy bay để kích hoạt</h2>
		<form action="../../php/admin/activate_jet_details_form_handler.php" method="post" class="default-font form-data">
			<div>
			<?php
				if(isset($_GET['msg']) && $_GET['msg']=='success')
				{
					echo "<strong style='color: green'>Máy bay đã được kích hoạt thành công.</strong>
						<br>
						<br>";
				}
				else if(isset($_GET['msg']) && $_GET['msg']=='failed')
				{
					echo "<strong style='color:red'>Mã không hợp lệ , vui lòng nhập lại.</strong>
						<br>
						<br>";
				}
			?>

			<div class="form-input">
				<label>Nhập mã máy bay hợp lệ:</label>
				<input type="text" name="jet_id" required />
			</div>

			<button type="submit" name="Activate" class="btn btn--success no-bor-outl-deco">Kích hoạt</button>
			</div>
		</form>
	</div>
</body>
</html>