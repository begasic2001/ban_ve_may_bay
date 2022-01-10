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
	<link rel="stylesheet" href="../../css/user/passenger-info_second.css" />

	<style>
		.header {
			justify-content: space-between;
		}
		
		.footer {
			transform: translateY(40%);
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<!-- ==== HEADER ==== -->
		<?php
			include ("header.php");
		?>

		<!-- ==== PROGRESS ==== -->
		<section class="title-font progress">
			<div class="progress__step progress__step--done">
				<span class="progress__num">1</span>
				<p class="progress__title">Chọn vé</p>
			</div>
			<div class="progress__step">
				<span class="progress__num progress__num--checked">2</span>
				<p class="progress__title">Thông tin hành khách</p>
			</div>
			<div class="progress__step">
				<span class="progress__num">3</span>
				<a class="progress__title">Xác nhận</a>
			</div>
		</section>

		<div class="info">
			<h2 class="text-center title-font">Thông Tin Khách Bay</h2>
			<?php
				if(isset($_POST["select_flight"]) && isset($_POST["Select"])) {
					$no_of_pass=$_SESSION['no_of_pass'];
					$class=$_SESSION['class'];
					$count=$_SESSION['count'];
					$flight_no=$_POST['select_flight'];
					$_SESSION['flight_no'] = $flight_no;

					echo "<form action=\"../../php/user/add_ticket_details_form_handler.php\" method=\"post\" class=\"form-data\">";
						echo "<div class=\"default-font info__passenger\">";
							while($count <= $no_of_pass) {
								echo "<h3 class=\"medium-font\">Hành khách ".$count."</h3>";
								echo "<div class=\"input-box row1\">";
									echo "<div class=\"form-input form-input__main\">";
										echo "<label>Họ tên</label>";
										echo "<input type=\"text\" name=\"pass_name[]\" required />";
									echo "</div>";
									echo "<div class=\"form-input form-input__other\">";
										echo "<label>Tuổi: </label>";
										echo "<input type=\"number\" name=\"pass_age[]\" min=\"1\" max=\"100\" required />";
									echo "</div>";
									echo "<div class=\"form-input form-input__other\">";
										echo "<label>Giới tính: </label>";
										echo "<select name=\"pass_gender[]\">";
											echo "<option value=\"\"></option>";
											echo "<option value=\"Nam\">Nam</option>";
											echo "<option value=\"Nữ\">Nữ</option>";
											echo "<option value=\"Khác\">Khác</option>";
										echo "</select>";
									echo "</div>";
								echo "</div>";

								echo "<div class=\"input-box row2\">";
									echo "<div class=\"form-input form-input__other\">";
										echo "<label>Sử dụng dịch vụ: </label>";
										echo "<select name=\"pass_meal[]\">";
											echo "<option value=\"\"></option>";
											echo "<option value=\"Có\">Có</option>";
											echo "<option value=\"Không\">Không</option>";
										echo "</select>";
									echo "</div>";
									echo "<div class=\"form-input form-input__other\">";
										echo "<label>Mã khuyến mãi: <i>(Nếu có)</i></label>";
										echo "<input type=\"text\" name=\"pass_ff_id[]\" />";
									echo "</div>";
								echo "</div>";
								echo "<br>";
								
								$count = $count+1;
							}
						echo "</div>";

						echo "<div class=\"default-font info__passenger\">";
							echo "<h3 class=\"medium-font\">Các dịch vụ đi kèm</h3>";
							echo "<div class=\"form-addition\">";
								echo "<label>Phòng chờ cao cấp: </label>";
								echo "<span>Có</span>";
								echo "<input type='radio' name='lounge_access' value='yes' checked/>";
								echo "<span>Không</span>";
								echo "<input type='radio' name='lounge_access' value='no'/>";
							echo "</div>";
							echo "<div class=\"form-addition\">";
								echo "<label>Đăng ký ưu tiên: </label>";
								echo "<span>Có</span>";
								echo "<input type='radio' name='priority_checkin' value='yes' checked/>";
								echo "<span>Không</span>";
								echo "<input type='radio' name='priority_checkin' value='no'/>";
							echo "</div>";
							echo "<div class=\"form-addition\">";
								echo "<label>Mua bảo hiểm: </label>";
								echo "<span>Có</span>";
								echo "<input type='radio' name='insurance' value='yes' checked/>";
								echo "<span>Không</span>";
								echo "<input type='radio' name='insurance' value='no'/>";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"form__btn\">";
							echo "<button type=\"submit\" name=\"Submit\" class=\"btn btn--success no-bor-outl-deco\">Tiếp tục</button>";
						echo "</div>";
					echo "</form>";
				} else {
					echo "Submit request not received";
					header('location:result-ticket_first.php');
				}
			?>
		</div>

		<!-- ==== FOOTER ==== -->
		<?php
			include ("../footer.php");
		?>
	</div>

</body>
</html>