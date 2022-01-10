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
  <link rel="stylesheet" href="../../css/page/header.css">
  <link rel="stylesheet" href="../../css/page/footer.css">

  <style>
    h3 {
      margin-top: 15rem;
    }

    .footer {
      margin-top: 30rem;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <?php
      include ("header.php");
    ?>

    <h3>Người dùng  đã đăng ký thành công! Đăng nhập vào tài khoản của bạn để đặt vé.</h3>
    
    <?php
      include ("../footer.php");
    ?>
  </div>
</body>
</html>