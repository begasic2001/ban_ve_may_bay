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
	<link rel="stylesheet" href="../../css/admin/all-list-flight.css">
</head>
<body>
    <?php
        $conn = @new mysqli('localhost', 'root', '', 'ticket_booking');

        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $ma_chuyen_bay = $_GET["ma_chuyen_bay"];
        
        if (isset($_POST["capnhat"])) {
            $ma_chuyen_bay = $_POST["ma_chuyen_bay"];
            $noi_di =  $_POST["noi_di"];
            $noi_den = $_POST["noi_den"];
            $ngay_bat_dau = $_POST["ngay_bat_dau"];
            $ngay_ket_thuc = $_POST["ngay_ket_thuc"];
            $gio_bat_dau = $_POST["gio_bat_dau"];
            $gio_ket_thuc = $_POST["gio_ket_thuc"];
            $so_luong_economy = $_POST["so_luong_economy"];
            $so_luong_business = $_POST["so_luong_business"];
            $gia_economy= $_POST["gia_economy"];
            $gia_business= $_POST["gia_business"];
            $ma_may_bay = $_POST["ma_may_bay"];
            if (! empty($ma_chuyen_bay) && ! empty($noi_di) && ! empty($noi_den) &&
                ! empty($ngay_bat_dau) && ! empty($ngay_ket_thuc) && ! empty($gio_bat_dau) && ! empty($gio_ket_thuc) && ! empty($so_luong_economy) && ! empty($so_luong_business) && ! empty($gia_economy) && ! empty($gia_business) && ! empty($ma_may_bay)) {
                $sql = 
                    "UPDATE chuyen_bay 
                    SET from_city='$noi_di', to_city='$noi_den' , ngay_bat_dau='$ngay_bat_dau' , ngay_ket_thuc='$ngay_ket_thuc', gio_bat_dau ='$gio_bat_dau',gio_ket_thuc='$gio_ket_thuc', so_luong_economy='$so_luong_economy' , so_luong_business='$so_luong_business', gia_economy ='$gia_economy', gia_business='$gia_business', ma_may_bay='$ma_may_bay'
                    where ma_chuyen_bay='$ma_chuyen_bay'";
                $res = $conn->query($sql);

                if ($res) {
                    $tb="<p align='center'>Cập nhật thành công !!!</p>";
                } else {
                    $tb="<p align='center'>Cập nhật thất bại, lỗi câu lệnh : $sql</p>"; 
                } 
            } else {
                $tb="<p align='center'>Cần phải có thông tin hợp lệ</p>";
            }
        } else {
            $res = $conn->query("SELECT * FROM chuyen_bay where ma_chuyen_bay = '$ma_chuyen_bay'");

            if ($res->num_rows>0) {
                $row = $res->fetch_assoc();
                $ma_chuyen_bay = $row["ma_chuyen_bay"];
                $noi_di =  $row["from_city"];
                $noi_den = $row["to_city"];
                $ngay_bat_dau = $row["ngay_bat_dau"];
                $ngay_ket_thuc = $row["ngay_ket_thuc"];
                $gio_bat_dau = $row["gio_bat_dau"];
                $gio_ket_thuc = $row["gio_ket_thuc"];
                $so_luong_economy = $row["so_luong_economy"];
                $so_luong_business = $row["so_luong_business"];
                $gia_economy= $row["gia_economy"];
                $gia_business= $row["gia_business"];
                $ma_may_bay = $row["ma_may_bay"];
            }

            $tb="";
        }

        $conn->close();
    ?>

    <div class="container">        
        <h2 class="title-font text-center">Cập nhật thông tin chuyến bay</h2>
        <form action="" method="post" enctype="multipart/form-data" name="">
            <table class="default-font table-edit">
                <tr>
                    <th>Mã Chuyến Bay: </th>
                    <td><input type="text" name="ma_chuyen_bay" readonly value="<?php echo  $ma_chuyen_bay; ?>"></td>
                </tr>
                <tr>
                    <th>Nơi Đi: </th>
                    <td><input type="text" name="noi_di" value="<?php echo  $noi_di; ?>"></td>
                </tr>
                <tr>
                    <th>Nơi đến: </th>
                    <td><input type="text" name="noi_den" value="<?php echo  $noi_den; ?>"></td>
                </tr>
                
                <tr>
                    <th>Ngày Bắt Đầu: </th>
                    <td><input type="text" name="ngay_bat_dau" value="<?php echo  $ngay_bat_dau; ?>"></td>
                </tr>
                <tr>
                    <th>Ngày Kết Thúc: </th>
                    <td><input type="text" name="ngay_ket_thuc" value="<?php echo  $ngay_ket_thuc; ?>"></td>
                </tr>
                <tr>
                    <th>Giờ Bắt Đầu: </th>
                    <td><input type="text" name="gio_bat_dau" value="<?php echo $gio_bat_dau; ?>"></td>
                </tr>
                <tr>
                    <th>Giờ Kết Thúc: </th>
                    <td><input type="text" name="gio_ket_thuc" value="<?php echo $gio_ket_thuc; ?>"></td>
                </tr>
                <tr>
                    <th>Số Lượng Economy: </th>
                    <td><input type="text" name="so_luong_economy" value="<?php echo $so_luong_economy; ?>"></td>
                </tr>
                <tr>
                    <th>Số Lượng Business: </th>
                    <td><input type="text" name="so_luong_business" value="<?php echo $so_luong_business; ?>"></td>
                </tr>
                <tr>
                    <th>Giá Economy: </th>
                    <td><input type="text" name="gia_economy" value="<?php echo $gia_economy; ?>"></td>
                </tr>
                <tr>
                    <th>Giá Business: </th>
                    <td><input type="text" name="gia_business" value="<?php echo $gia_business; ?>"></td>
                </tr>
                <tr>
                    <th>Mã Máy Bay: </th>
                    <td><input type="text" name="ma_may_bay" readonly value="<?php echo $ma_may_bay; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="capnhat" class="btn no-bor-outl-deco">Cập nhật</button>
                    </td>
                </tr>
            </table>
        </form> 
    </div>

    <?php
        if (!empty($tb)) {
            echo $tb;
        }
    ?>
</body>
</html>