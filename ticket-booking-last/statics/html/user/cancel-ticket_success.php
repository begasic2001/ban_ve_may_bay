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
		.container {
			padding: 13rem 2rem;
			height: 60vh;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<div class="container">
			<h3 class="medium-font">Vé của bạn đã huỷ thành công.<br><br>
			Số tiền của bạn  <?php echo number_format($_SESSION['refund_amount'],0,',',',')?> VNĐ
			sẽ được hoàn lại vào tài khoản ngân hàng của bạn (Phí hủy trên 15% số tiền vé của bạn đã được khấu trừ).</td>
			</h3>
		</div>

		<!-- ==== FOOTER ==== -->
		<?php
			include (".../footer.php");
		?>
	</div>
</body>
</html>