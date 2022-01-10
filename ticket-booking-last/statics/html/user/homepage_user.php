<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>

	<!-- ==== CDN ==== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />

	<!-- ==== CSS ==== -->
	<link rel="stylesheet" href="../../css/common.css">
	<link rel="stylesheet" href="../../css/page/header.css">
	<link rel="stylesheet" href="../../css/page/footer.css">
	<link rel="stylesheet" href="../../css/user/homepage_user.css">

	<style>
		.header {
			justify-content: space-between;
		}
	</style>
</head>
<body>
	<div class="default-font wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<div class="function">
			<?php
				echo "<h1 class=\"title-font\">Welcome ".$_SESSION['login_user']."</h1>";
				require_once('../../php/mysqli_connect.php');
			?>
			<table class="function-data">
				<tr>
					<td class="admin_func">
						<a href="search-ticket_first.php" class="no-bor-outl-deco">
							1. Tìm Kiếm Chuyến Bay <i class="fas fa-search"></i>
						</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func">
						<a href="history-booked.php" class="no-bor-outl-deco">
							2. Lịch Sử Đặt Vé <i class="fas fa-history"></i>
					</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func">
						<a href="pnr.php" class="no-bor-outl-deco">
							3. In Hoá Đơn <i class="fas fa-print"></i>
						</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func">
						<a href="cancel-ticket.php" class="no-bor-outl-deco warning">
							4. Huỷ Chuyến Bay <i class="fas fa-ban"></i>
						</a>
					</td>
				</tr>
			</table>
		</div>

		<footer class="default-font footer">
      <!-- ==== ABOUT US ==== -->
      <section class="about-us">
        <h2>Về chúng tôi</h2>
        <div class="about__txt">
          <p>
           Địa chỉ công ty 451/33/18 Phạm Thế Hiển Phường 3 Quận 8
          </p>
        </div>
        <hr />
        <div class="about__info">
          <div class="about__contact">
            <i class="fas fa-phone-alt"></i>
            <span>:0123000</span>
          </div>
          <div class="about__time">
            <i class="far fa-clock"></i>
            <span>:Mon - Sat 8.00 - 17.00</span>
          </div>
        </div>
        <hr />
        <div class="about__func">
          <a href="#">Chi nhánh</a>
          <a href="#">Góp ý</a>
          <a href="#">FAQ</a>
        </div>
      </section>

      <!-- ==== LEGAL ==== -->
      <section class="legal">
        <h2>Vấn đề pháp lý</h2>
        <p><a href="#">Các điều khoản & pháp lý</a></p>
        <p><a href="#">Điều lệ vận chuyển</a></p>
        <p><a href="#">Bảo mật thông tin</a></p>
      </section>

      <!-- ==== SUPPORT ==== -->
      <section class="support">
        <h2>Hỗ trợ</h2>
        <p><a href="#">Chăm sóc khách hàng</a></p>
        <p><a href="#">Chính sách bảo vệ khách hàng</a></p>
      </section>
    </footer>
	</div>
</body>
</html>