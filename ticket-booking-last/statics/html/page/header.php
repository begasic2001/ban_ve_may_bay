<div class="header">
  <!-- ==== LOGO ==== -->
  <section class="logo">
    <a href="../../../index.php">
      <img src="../../../assets/logo/fly_safe.png" alt="Logo website" />
    </a>
  </section>

  <!-- ==== NAVIGATION ==== -->
  <nav class="title-font nav">
    <li><a href="../../../../index.php" class="no-bor-outl-deco">Trang chủ</a></li>
    <li><a href="#" class="no-bor-outl-deco">Vé máy bay</a></li>
    <li><a href="#" class="no-bor-outl-deco">Tour du lịch</a></li>
  </nav>

  <!-- ==== SIGN ==== -->
  <section class="medium-font sign">
    <div class="sign__btn">
      <?php
      if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Customer')
      {
        echo 
        "<a href=\"homepage_user.php\" class=\"no-bor-outl-deco\">
          Đăng Nhập <i class=\"far fa-user-circle\"></i>
        </a>";
      }
      else if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Administrator')
      {
        echo 
        "<a href=\"homepage_admin.php\" class=\"no-bor-outl-deco\">
          Đăng Nhập <i class=\"far fa-user-circle\"></i>
        </a>";
      }
      else
      {
        echo "<a href=\"../page/sign-in.php\" class=\"no-bor-outl-deco\">
          Đăng Nhập <i class=\"far fa-user-circle\"></i>
        </a>";
      }
    ?>
    </div>
    <div class="sign__btn">
      <a href="../page/sign-up.php" class="no-bor-outl-deco btn btn--success">Đăng ký</a>
    </div>
  </section>
</div>