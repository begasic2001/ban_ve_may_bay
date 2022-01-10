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
		.header {
			justify-content: space-between;
		}
		
		.footer {
			transform: translateY(40%);
		}
		.wrapper {
			padding-top: 15rem;
		}
		
		h2, h3 {
			padding: 2.5rem;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<h2 class="title-font">ĐẶT VÉ THÀNH CÔNG</h2>
		<h3 class="medium-font">Khoản thanh toán của bạn  <?php echo number_format($_SESSION['total_amount'],0,',',','); ?>VNĐ đã nhận được.<br><br> Code vé của bạn là <strong><?php echo $_SESSION['pnr'];?></strong>. Vé của bạn đã được đặt thành công.</h3>

		<!-- ==== FOOTER ==== -->
		<?php
			include ("../footer.php");
		?>
	</div>
	

</body>
</html>