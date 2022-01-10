<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
  <link rel="stylesheet" href="./statics/css/common.css" />
  <link rel="stylesheet" href="./statics/css/page/header.css">
  <link rel="stylesheet" href="./statics/css/page/footer.css">
  <link rel="stylesheet" href="./statics/css/page/homepage.css" />
</head>
<body>
  <div class="wrapper">
    <!-- ==== HEADER ==== -->
    <header class="header">
      <!-- ==== LOGO ==== -->
      <section class="logo">
        <a href="">
          <img src="./assets/logo/fly_safe.png" alt="Logo website" />
        </a>
      </section>

      <!-- ==== NAVIGATION ==== -->
      <nav class="title-font nav">
        <li><a href="index.php" class="no-bor-outl-deco">Trang chủ</a></li>
        <li><a href="./statics/html/page/warning-message_ticket.php" class="no-bor-outl-deco">Vé máy bay</a></li>
        <li><a onclick="nofi()" href="#" class="no-bor-outl-deco">Tour du lịch</a></li>
      </nav>

      <!-- ==== SIGN ==== -->
      <section class="medium-font sign">
        <div class="sign__btn">
          <?php
            if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Customer')
            {
              echo 
              "<a href=\"./statics/html/user/homepage_user.php\" class=\"no-bor-outl-deco\">
                Đăng Nhập <i class=\"far fa-user-circle\"></i>
              </a>";
            }
            else if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Administrator')
            {
              echo 
              "<a href=\"admin_homepage.php\" class=\"no-bor-outl-deco\">
                Đăng Nhập <i class=\"far fa-user-circle\"></i>
              </a>";
            }
            else
            {
              echo "<a href=\"./statics/html/page/sign-in.php\" class=\"no-bor-outl-deco\">
                Đăng Nhập <i class=\"far fa-user-circle\"></i>
              </a>";
            }
          ?>
        </div>
        <div class="sign__btn">
          <a href="./statics/html/page/sign-up.php" class="no-bor-outl-deco btn btn--success">Đăng ký</a>
        </div>
      </section>
    </header>

    <!-- ==== INPUT FORM ==== -->
    <section class="slider">
    </section>

    <!-- ==== CONTAINER ==== -->
    <div class="container">
      <!-- START: Explore -->
      <div class="explore text-center">
        <h1>Khám phá những điểm mới</h1>
        <h3>Hãy để chúng tôi cho bạn trải nghiệm những địa điểm mới nhất</h3>

        <div class="explore__locations">
          <div class="location">
            <div class="location__img">
              <img src="./assets/img/greece.png" alt="Hy Lạp" />
            </div>
            <p class="default-font">Hy Lạp</p>
          </div>
          <div class="location">
            <div class="location__img">
              <img src="./assets/img/canada.png" alt="Canada" />
            </div>
            <p class="default-font">Canada</p>
          </div>
          <div class="location">
            <div class="location__img">
              <img src="./assets/img/vung_tau.png" alt="Vũng Tàu" />
            </div>
            <p class="default-font">Vũng Tàu</p>
          </div>
        </div>
      </div>
      <!-- END: Explore -->

      <!-- START: Introduce -->
      <div class="introduce">
        <div class="text-center introduce__txt">
          <div class="introduce__header">
            <h3 class="medium-font">Uy tín hàng đầu</h3>
            <h4>5 lý do khách hàng nên chọn đại lý chúng tôi</h4>
          </div>
          <div class="default-font introduce__body">
            <p>Bao gồm những đội ngũ nhân viên hàng đầu</p>
            <p>Nhân viên luôn thân thiện với khách hàng</p>
            <p>Khách hàng là thượng đế</p>
            <p>Đem lại sự hài lòng cho khách hàng</p>
            <p>Làm việc nhanh gọn lẹ</p>
          </div>
        </div>
        <div class="introduce__img">
          <img src="./assets/img/plane3.png" alt="Hình ảnh minh họa" width="100%" />
        </div>
      </div>
      <!-- END: Introduce -->
    </div>

    <!-- ==== FOOTER ==== -->
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




  <!-- ==== JS ==== -->
  <script>
    function nofi() {
      alert("Chức năng đang phát triển");
    }
  </script>
</body>
</html>
