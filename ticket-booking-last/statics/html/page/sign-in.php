<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập</title>

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
    <section class="container sign-in">
      <h2 class="title-font text-center title">Đăng Nhập</h2>
      <form action="../../php/page/login_handler.php" method="post" autocomplete="off" class="form-data">
        <div class="form-input">
          <input type="text" name="username" placeholder="Tài khoản..." required>
          <input type="password" name="password" placeholder="Mật khẩu..." required>
        </div>

        <div class="default-font form-choose">
          <label>Loại tài khoản:</label>
          <input type="radio" name="user_type" id="loai-user" value="Customer" checked />
          <label for="loai-user"> User</label>
          <input type="radio" name="user_type" id="loai-admin" value="Administrator" />
          <label for="loai-admin"> Admin</label>

          <br>
          <?php
            if(isset($_GET['msg']) && $_GET['msg']=='failed')
            {
              echo "<br><strong style='color:red'>Sai tài khoản/ mật khẩu</strong>";
            }
          ?>
        </div>

        <button type="submit" name="Login" class="no-bor-outl-deco btn btn--success">
          Đăng nhập
        </button>

        <p class="text-center default-font">
          Chưa có tài khoản? <a href="./sign-up.php">Đăng ký</a>
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
