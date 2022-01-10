<?php
    session_start();
?>

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
        if(isset($_POST['tim'])) {
            $key = $_POST['key'];
            $tb = "";
            if(!empty($key)) {
                $conn = @new mysqli('localhost','root','','ticket_booking');
                if($conn->connect_error){
                    die("Kết Nối Thất Bại: ". $conn->connect_error);
                }
                $sql = 
                    "SELECT * 
                    FROM chuyen_bay 
                    Where ma_chuyen_bay like '%$key%'
                    OR from_city like '%$key%' 
                    OR to_city like '%$key%' 
                    OR ngay_bat_dau like '%$key%'
                    OR ngay_ket_thuc like '%$key%' 
                    OR gio_bat_dau like '%$key%' 
                    OR gio_ket_thuc like '%$key%'
                    OR so_luong_economy like '%$key%' 
                    OR so_luong_business like '%$key%' 
                    OR gia_economy like '%$key%'
                    OR gia_business like '%$key%' 
                    OR ma_may_bay like '%$key%' OR ngay_ve like '%$key%'";
                $res = $conn->query($sql);
            }
            else {
                $tb = "Chưa Nhập Từ Khoá Tìm Kiếm";
            }
        } else {
            $key = "";
            $tb = "";
        }
    ?>

    <?php 
        if(! empty($key) ) {
            if($res->num_rows>0) {
                $n = $res -> num_rows;
                echo "<p class='default-font'> Có $n Chuyến Bay Được Tìm Thấy </p>";

                echo "<table class=\"default-font text-center data-result\">";
                echo 
                    " <thead>
                        <th>Mã Chuyến Bay</th>
                        <th>Nơi Đi</th>
                        <th>Nơi Đến</th>
                        <th>Ngày Bắt Đầu</th>
                        <th>Ngày Kết Thúc</th>
                        <th>Giờ Bắt Đầu</th>
                        <th>Giờ Kết Thúc</th>
                        <th>Số Lượng Economy</th>
                        <th>Số Lượng Business</th>
                        <th>Giá Economy</th>
                        <th>Giá Business</th>
                        <th>Mã Máy Bay</th>
                        <th>Ngày Về</th>
                        <th colspan=\"2\">Các chức năng</th>
                    </thead>";

                while($row = $res->fetch_assoc()) {
                    $ma_chuyen_bay = $row["ma_chuyen_bay"];
                    $noi_di = $row["from_city"];
                    $noi_den = $row["to_city"];
                    $ngay_bat_dau = $row["ngay_bat_dau"];
                    $ngay_ket_thuc = $row["ngay_ket_thuc"];
                    $gio_bat_dau = $row["gio_bat_dau"];
                    $gio_ket_thuc = $row["gio_ket_thuc"];
                    $so_luong_economy = $row["so_luong_economy"];
                    $so_luong_business = $row["so_luong_business"];
                    $gia_economy = $row["gia_economy"];
                    $gia_business = $row["gia_business"];
                    $ma_may_bay = $row["ma_may_bay"];
                    $ngay_ve = $row["ngay_ve"];
                    if($ngay_ve != NULL){
                        $sua = "<a href='admin_edit_flight1_handler.php?ma_chuyen_bay=$ma_chuyen_bay' class=\"no-bor-outl-deco btn--edit\">Sửa</a>";
                    } else {
                        $sua = "<a href='admin_edit_flight2_handler.php?ma_chuyen_bay=$ma_chuyen_bay' class=\"no-bor-outl-deco btn--edit\">Sửa</a>";
                    }
                    // $xoa = "<a href='admin_delete_flight_handler.php?ma_chuyen_bay=$ma_chuyen_bay' class=\"no-bor-outl-deco btn--del\">Xóa</a>";

                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>$ma_chuyen_bay</td>";
                            echo "<td>$noi_di</td>";
                            echo "<td>$noi_den</td>";
                            echo "<td>$ngay_bat_dau</td>";
                            echo "<td>$ngay_ket_thuc</td>";
                            echo "<td>$gio_bat_dau</td>";
                            echo "<td>$gio_ket_thuc</td>";
                            echo "<td>$so_luong_economy</td>";
                            echo "<td>$so_luong_business</td>";
                            echo "<td>$gia_economy</td>";
                            echo "<td>$gia_business</td>";
                            echo "<td> $ma_may_bay</td>";
                            echo "<td>$ngay_ve</td>";
                            echo "<td>$sua</td>";
                            // echo "<td>$xoa</td>";
                        ?>
<td><a onclick="return DelNofi('<?php echo $row['ma_chuyen_bay']; ?>')" href="../../php/admin/admin_delete_flight_handler.php?ma_chuyen_bay=<?php echo $row["ma_chuyen_bay"];?>" class="no-bor-outl-deco btn--del">Xóa</a></td>

                        <?php
                        echo "</tr>";
                    echo "</tbody>";
                }
                echo "</table>";
            } else {
                echo "<div style='color:red; text-align:center;'>Không Tìm Thấy Chuyến Bay!!!</div>";
            }

            $conn->close();

        } else {
            if(!empty($tb)) {
                echo "<div style='color:red; text-align:center;'>$tb</div>'";
            }
        }
    ?>
       <script>
            function DelNofi(ma_chuyen_bay){
                return confirm(`Bạn có chắc muốn xoá chuyến bay ${ma_chuyen_bay} này không ?`);
            }
        </script>
</body>
</html>