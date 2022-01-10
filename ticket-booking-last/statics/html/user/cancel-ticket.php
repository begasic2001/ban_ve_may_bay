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

	<style>
		.wrapper {
			background-color: #F3F3F3;
		}
		.header {
			justify-content: space-between;
		}
		.footer {
			transform: translateY(55%);
		}
		.container {
			padding-top: 13rem;
			height: 40vh;
		}
		.container__img img {
			display: block;
			margin: auto;
		}
		.form-data h2 {
			margin-top: 2rem;
		}
		.form-input {
			margin: 2rem auto;
			text-align: center;
		}
		.form-input input {
			padding: 1rem;
		}
		.form-data button {
			display: block;
			margin: 3rem auto;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<div class="default-font container">
			<div class="container__img">
				<img src="../../../assets/logo/fly_safe.png" alt="logo website">
			</div>
			<form action="../../php/user/cancel_booked_tickets_form_handler.php" method="post" class="form-data">
				<?php
					if(isset($_GET['msg']) && $_GET['msg']=='failed') {
						echo "<strong style='color: red'>*Code vé không hợp lệ vui lòng nhập lại</strong>
							<br>
							<br>";
					}
				?>
				
				<div class="form-input">
					<label>Nhập mã vé muốn hủy: </label>
					<input type="text" name="pnr" required>
				</div>
				<button type="submit" name="Cancel_Ticket" class="btn btn--success no-bor-outl-deco">Hủy vé</button>
			</form>
		</div>

		<!-- ==== FOOTER ==== -->
		<?php
			include (".../footer.php");
		?>
	</div>
</body>
</html>