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
	<link rel="stylesheet" href="../../css/user/confirm_third.css" />

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
			<div class="progress__step progress__step--done">
				<span class="progress__num">2</span>
				<p class="progress__title">Thông tin hành khách</p>
			</div>
			<div class="progress__step">
				<span class="progress__num progress__num--checked">3</span>
				<a class="progress__title">Xác nhận</a>
			</div>
		</section>

		<div class="container">
			<form action="../../php/user/payment_details_form_handler_round.php" method="post" class="default-font form-data">
				<h2 class="title-font"><u>Hoá Đơn Thanh Toán</u></h2>
				<?php
					$flight_no=$_SESSION['flight_no'];
					$journey_date=$_SESSION['journey_date'];
					$ngay_ve=$_SESSION['ngay_ve'];
					$no_of_pass=$_SESSION['no_of_pass'];
					$total_no_of_meals=$_SESSION['total_no_of_meals'];
					$payment_id=rand(100000000,999999999);
					$pnr=$_SESSION['pnr'];
					$_SESSION['payment_id']=$payment_id;
					$payment_date=date('Y-m-d'); 
					$_SESSION['payment_date']=$payment_date;
	
	
					require_once('../../php/mysqli_connect.php');
					if($_SESSION['class']=='economy')
					{	
						$query="SELECT gia_economy FROM chuyen_bay where ma_chuyen_bay=? and ngay_bat_dau=? and ngay_ve=?";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"sss",$flight_no,$journey_date,$ngay_ve);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$ticket_price);
						mysqli_stmt_fetch($stmt);
					}
					else if($_SESSION['class']=='business')
					{
						$query="SELECT gia_business FROM chuyen_bay where ma_chuyen_bay=? and ngay_bat_dau=? and ngay_ve=?";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"sss",$flight_no,$journey_date,$ngay_ve);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$ticket_price);
						mysqli_stmt_fetch($stmt);
					}
					mysqli_stmt_close($stmt);
					mysqli_close($dbc);
					$total_ticket_price=$no_of_pass*$ticket_price;
					$total_meal_price=250000*$total_no_of_meals;
					if($_SESSION['insurance']=='yes')
					{
						$total_insurance_fee=100000*$no_of_pass;
					}
					else
					{
						$total_insurance_fee=0;
					}
					if($_SESSION['priority_checkin']=='yes')
					{
						$total_priority_checkin_fee=200000*$no_of_pass;
					}
					else
					{
						$total_priority_checkin_fee=0;
					}
					if($_SESSION['lounge_access']=='yes')
					{
						$total_lounge_access_fee=300000*$no_of_pass;
					}
					else
					{
						$total_lounge_access_fee=0;
					}
					$total_discount=0;
					$total_amount=$total_ticket_price+$total_meal_price+$total_insurance_fee+$total_priority_checkin_fee+$total_lounge_access_fee+$total_discount;
					$_SESSION['total_amount']=$total_amount;
	
					echo "<table class=\"bill-result\">";
						echo "<tr>";
							echo "<td>Giá vé cơ bản, Phí nhiên liệu và Giao dịch (Đã bao gồm Phí & Thuế):</td>";
							echo "<td>".number_format($total_ticket_price,0,',',',')."VNĐ</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Phí kết hợp bữa ăn:</td>";
							echo "<td>".number_format($total_meal_price,0,',',',')."VNĐ</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Phí đăng ký ưu tiên:</td>";
							echo "<td>".number_format($total_priority_checkin_fee,0,',',',')."VNĐ</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Phí sử dụng phòng chờ:</td>";
							echo "<td> ".number_format($total_lounge_access_fee,0,',',',')."VNĐ</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Phí bảo hiểm:</td>";
							echo "<td>".number_format($total_insurance_fee,0,',',',')."VNĐ</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>Giảm Giá:</td>";
							echo "<td>".number_format($total_discount,0,',',',')."VNĐ</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td class=\"text-center total\"><strong>Total:</strong></td>";
							echo "<td class=\"total\">".number_format($total_amount,0,',',',')."VNĐ</td>";
						echo "</tr>";
					echo "</table>";
					echo "<p>Mã hoá đơn / Giao dịch của bạn là <strong>".$payment_id.".</strong> xin lưu ý : ghi nhớ để tham khảo trong tương lai.</p>";
				?>

				<h2 class="medium-font">Chọn phương thức thanh toán:</h2>
				<table class="bill-result">
					<tr>
						<td>
							<i class="fa fa-credit-card" aria-hidden="true"></i> Thẻ tín dụng
							<input type="radio" name="payment_mode" value="credit card" checked>
						</td>
						<td>
							<i class="fa fa-credit-card-alt" aria-hidden="true"></i> Thẻ ghi nợ
							<input type="radio" name="payment_mode" value="debit card">
						</td>
						<td>
							<i class="fa fa-desktop" aria-hidden="true"></i> Net Banking 
							<input type="radio" name="payment_mode" value="net banking">
						</td>
					</tr>
				</table>
				<br>

				<div class="form__btn">
					<button type="submit" name="Pay_Now" class="btn btn--success no-bor-outl-deco">Thanh toán</button>
				</div>	
			</form>
		</div>

		<!-- ==== FOOTER ==== -->
		<?php
			include (".../footer.php");
		?>
	</div>
</body>
</html>