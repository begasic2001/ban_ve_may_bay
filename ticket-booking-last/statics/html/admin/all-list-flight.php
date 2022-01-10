<?php
    session_start();
?>

<?php
    //Ket noi CSDL
    $conn = @new mysqli('localhost', 'root', '', 'ticket_booking');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn -> connect_error);
    }
    
    $sql = "Select * From chuyen_bay";  

    $res = $conn -> query($sql);

    $num = $res -> num_rows;

    if ($num <= 0) {
        die("Chưa có thông tin chuyến bay");
    }
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
    <div class="wrapper">
        <h2 class="text-center title-font">Thông Tin Chuyến Bay</h2>
        <form action="../../php/admin/admin_search_flight_handler.php" method="POST" class="form-data">
            <div class="form-input">
                <input type="text" name="key" placeholder="Nhập chuyến bay muốn tìm...">
                <button type="submit" name="tim">Tìm kiếm</button>
            </div>
        </form>
            
        <table class="text-center default-font data-result">
            <thead>
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
                <th colspan="2">Các chức năng</th>
            </thead>
        <?php
            echo "<p class=\"default-font\">Có $num chuyến bay</p>";
            
            if ( $num > 0)  {
                while ($row = $res->fetch_assoc()) {
                    $ma_chuyen_bay = $row["ma_chuyen_bay"];
                    $noi_di = $row["from_city"];
                    $noi_den = $row["to_city"];
                    $ngay_bat_dau = $row["ngay_bat_dau"];
                    $ngay_ket_thuc = $row["ngay_ket_thuc"];
                    $gio_bat_dau = $row["gio_bat_dau"];
                    $gio_ket_thuc = $row["gio_ket_thuc"];
                    $so_luong_economy = $row["so_luong_economy"];
                    $so_luong_business = $row["so_luong_business"];
                    $gia_economy = number_format($row["gia_economy"],0,',',',');
                    $gia_business = number_format($row["gia_business"],0,',',',');
                    $ma_may_bay = $row["ma_may_bay"];
                    $ngay_ve = $row["ngay_ve"];
                    if($ngay_ve != NULL){
                        $sua = "<a href='../../php/admin/admin_edit_flight1_handler.php?ma_chuyen_bay=$ma_chuyen_bay' class=\"no-bor-outl-deco btn--edit\">Sửa</a>";
                    } else {
                        $sua = "<a href='../../php/admin/admin_edit_flight2_handler.php?ma_chuyen_bay=$ma_chuyen_bay' class=\"no-bor-outl-deco btn--edit\">Sửa</a>";
                    }
                    // $xoa = "<a onclick='return delNofi($ma_chuyen_bay)' href='../../php/admin/admin_delete_flight_handler.php?ma_chuyen_bay=$ma_chuyen_bay' class=\"no-bor-outl-deco btn--del\">Xóa</a>";

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
                            echo "<td>$gia_economy VND</td>";
                            echo "<td>$gia_business VND</td>";
                            echo "<td> $ma_may_bay</td>";
                            echo "<td>$ngay_ve</td>";
                            echo "<td>$sua</td>";
                            
                    ?>

<td><a onclick="return DelNofi('<?php echo $row['ma_chuyen_bay']; ?>')" href="../../php/admin/admin_delete_flight_handler.php?ma_chuyen_bay=<?php echo $row["ma_chuyen_bay"];?>" class="no-bor-outl-deco btn--del">Xóa</a></td>
                    <?php
                        echo "</tr>";
                    echo "</tbody>";
                }
            } else {
                echo "Không có dữ liệu !!!!";
            }

            $conn -> close();
        ?>
    </div>

    <!-- ==== JS ==== -->
        <script>
            function DelNofi(ma_chuyen_bay){
                return confirm(`Bạn có chắc muốn xoá chuyến bay ${ma_chuyen_bay} này không ?`);
            }
        </script>
</body>
</html>