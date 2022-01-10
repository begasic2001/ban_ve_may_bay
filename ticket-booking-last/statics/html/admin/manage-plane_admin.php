<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sidbar</title>

	<!-- ==== CDN ==== -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
		rel="stylesheet"
	/>
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
	/>

	<!-- ==== CSS ==== -->
	<link rel="stylesheet" href="../../css/common.css" />
	<link rel="stylesheet" href="../../css/admin/sidebar.css" />
	<link rel="stylesheet" href="../../css/admin/manage-plane-flight_admin.css">
</head>
  <div class="wrapper">
    <!-- ==== SIDEBAR ==== -->
    <?php
      include ("sidebar.php");
    ?>

    <!-- ==== MANAGE ==== -->
    <div class="container">
      <h2 class="title-font">Danh sách các chuyến bay</h2>

      <div class="container-function">
        <span class="default-font">Chọn các chức năng:</span>
        <a href="add-plane.php" target="result" class="default-font btn no-bor-outl-deco">Thêm máy bay</a>
        <a href="deactivate-plane.php" target="result" class="default-font btn no-bor-outl-deco">Xóa máy bay</a>
        <a href="activate-plane.php" target="result" class="default-font btn no-bor-outl-deco">Xác nhận máy bay</a>
      </div>

      <iframe src="" name="result"></iframe>
    </div>
  </div>
</body>
</html>