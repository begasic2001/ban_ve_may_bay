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
			transform: translateY(55%);
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<main class="container">
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

			<!-- ==== SEARCH ==== -->
			<section class="search">
				<form action="result-ticket_khuhoi_first.php" method="post" class="form-data">
					<h2 class="text-center title-font">Bảng tra cứu vé</h2>
					<!-- START: location -->
					<div class="input-box">
						<div class="form-input input-half">
							<input type="text" name="origin" placeholder="Điểm đi..." required />
						</div>
						<div class="form-input input-half">
							<input type="text" name="destination" placeholder="Điểm đến..." required />
						</div>
					</div>
					<!-- END: location -->
	
					<!-- START: another function -->
					<div class="input-box">
						<div class="form-input input-fourth">
							<input type="date" name="dep_date" min=
									<?php 
										$todays_date = date('Y-m-d'); 
										echo $todays_date;
									?> 
								max=
									<?php 
										$max_date = date_create(date('Y-m-d'));
										date_add($max_date, date_interval_create_from_date_string("90 days")); 
										echo date_format($max_date,"Y-m-d");
									?> required />
						</div>
						<div class="form-input input-fourth">
							<input type="date" name="ngay_ve"
								min=
									<?php 
										$todays_date = date('Y-m-d'); 
										echo $todays_date;
									?> 
								max=
									<?php 
										$max_date = date_create(date('Y-m-d'));
										date_add($max_date, date_interval_create_from_date_string("90 days")); 
										echo date_format($max_date, "Y-m-d");
									?> required />
						</div>
						<div class="form-input input-fourth">
							<input type="number" name="no_of_pass" min="1" placeholder="Số lượng..." required />
						</div>
						<div class="form-input input-fourth">
							<select name="class">
								<option value="economy">Economy</option>
								<option value="business">Business</option>
							</select>
						</div>
					</div>
					<!-- END: another function -->
	
					<div class="form__btns">
						<!-- START: switch page -->
						<div class="default-font form__choose">
							<a href="search-ticket_first.php" class="no-bor-outl-deco">Một chiều</a>
							<a href="#" class="no-bor-outl-deco">
								Khứ hồi
							</a>
						</div>
						<!-- END: switch page -->
	
						<button type="submit" name="Search" class="btn btn--success no-bor-outl-deco">
							Tra cứu
						</button>
					</div>
				</form>
			</section>
		</main>

		<!-- ==== FOOTER ==== -->
		<?php
			include ("../footer.php");
		?>
	</div>
</body>
</html>