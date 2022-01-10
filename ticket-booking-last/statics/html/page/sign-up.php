<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng ký</title>

  <!-- ==== CDN ==== -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet"
  />

  <!-- ==== CSS ==== -->
  <link rel="stylesheet" href="../../css/common.css" />
  <link rel="stylesheet" href="../../css/page/header.css" />
  <link rel="stylesheet" href="../../css/page/footer.css" />
  <link rel="stylesheet" href="../../css/page/log.css" />
</head>
<body>
  <div class="wrapper">
    <!-- ==== HEADER ==== -->
    <?php
      include ("header.php");
    ?>

    <!-- ==== THEME ==== -->
    <section class="background">
      <div class="backgroud__theme"></div>
    </section>

    <!-- ==== FORM ==== -->
    <section class="container sign-up">
      <h2 class="title-font text-center title">Đăng ký</h2>
      <form action="../../php/page/new_user_form_handler.php" method="post" class="form-data">
        <h3 class="medium-font">Thông tin đăng nhập</h3>

        <div class="form-input">
          <input type="text" name="username" placeholder="Nhập tài khoản..." required />
          <input type="password" name="password" placeholder="Nhập mật khẩu..." required />
          <input type="text" name="email" placeholder="Nhập email..." required />
        </div>

        <br />
        <hr />
        <br />

        <h3 class="medium-font">Thông tin đăng nhập</h3>
        <div class="form-input">
          <input type="text" name="name" placeholder="Họ và tên.." required />
          <input type="text" name="phone_no" placeholder="Số điện thoại..." maxlength="11" required />
          <input type="text" name="address" placeholder="Địa chỉ..." required />
        </div>

        <button type="submit" name="Submit" class="no-bor-outl-deco btn btn--success">
          Đăng ký
        </button>

        <p class="text-center default-font">
          Đã có tài khoản? <a href="./sign-in.php">Đăng nhập</a>
        </p>
      </form>
    </section>

    <!-- ==== FOOTER ==== -->
    <?php
      include ("../footer.php");
    ?>
  </div>
</body>
</html>
