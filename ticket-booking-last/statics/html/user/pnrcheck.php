<?php

    session_start();
    error_reporting(1);
  ?>

  <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Hoá Đơn</title>
        
         <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
         <link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
       <script src="bootstrap/jquery.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/admform.css"></link>
        
        <script type="text/javascript">
            function printpage()
            {
            var printButton = document.getElementById("print");
            printButton.style.visibility = 'hidden';
            window.print()
             printButton.style.visibility = 'visible';
             }
        </script>
        
        
    </head>
  <?php

$con=mysqli_connect("localhost","root","","ticket_booking");
$q=mysqli_query($con,"SELECT *
from ve , hoa_don , khach_mua
where ve.code_ve = hoa_don.code_ve
and ve.ma_khach_mua = khach_mua.ma_khach_mua
and ve.code_ve='".$_SESSION['user']."'");
$n=  mysqli_fetch_assoc($q);
$stname= $n['code_ve'];
$flight_no= $n['ma_chuyen_bay'];
$journey_date= $n['ngay_bat_dau'];
$class= $n['loai'];
$booking_status= $n['trang_thai_dat'];
$no_of_passengers= $n['ma_khach_bay'];
$lounge_access= $n['lui_phong_cho'];
$priority_checkin= $n['dang_ky_uu_tien'];
$insurance= $n['bao_hiem'];
$payment_id= $n['ma_hoa_don'];
$customer_id= $n['ma_khach_mua'];
$tong_tien=$n['tong_tien'];
$ten_khach_mua = $n['ten'];
$dia_chi = $n['dia_chi'];
$ngay_dat_ve =$n['ngay_dat_ve'];




$id=$_SESSION['user'];

$result = mysqli_query($con,"SELECT * FROM khach_bay WHERE code_ve='".$_SESSION['user']."'");
                    
                    while($row = mysqli_fetch_array($result))
                      {
?>

<hr style="border: 1px solid black;border-style: dashed;">
<center><h3>Cơ quan quản lý sân bay của Việt Nam</h3></center>
<center><h2>Thẻ lên máy bay - Phiếu đặt chỗ chuyến bay</h2></center><h4><?php echo $booking_status;?></h4>
<br>
<td style="width:4%;"> <font style="font-family: Verdana;">CODE Vé : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $id;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <td style="width:4%;"> <font style="font-family: Verdana;">Ngày Đặt Vé : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $ngay_dat_ve;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<td style="width:4%;"> <font style="font-family: Verdana;">Mã Chuyến Bay : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $flight_no;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<td style="width:4%;"> <font style="font-family: Verdana;">Ngày Khởi Hành : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $journey_date;?> </td><br>
<td style="width:4%;"> <font style="font-family: Verdana;">Loại Vé : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $class;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<td style="width:4%;"> <font style="font-family: Verdana;">Mã Thanh Toán : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $payment_id;?> </td><br>
<td style="width:4%;"> <font style="font-family: Verdana;">Quyền Vào Phòng chờ : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $lounge_access;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<td style="width:4%;"> <font style="font-family: Verdana;">Đăng Ký Ưu Tiên : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $priority_checkin;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<td style="width:4%;"> <font style="font-family: Verdana;">Bảo hiểm : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $insurance;?> </td><br>
<td style="width:4%;"> <font style="font-family: Verdana;">Khách Đặt : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $ten_khach_mua;?> </td><br>
<td style="width:4%;"> <font style="font-family: Verdana;">Địa Chỉ : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $dia_chi;?> </td><br>
<td style="width:4%;"> <font style="font-family: Verdana;">Trạng Thái: </font> </td>
                    <td style="width:58%;" colspan="3"> <?php echo $booking_status;?> </td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<td style="width:4%;"> <font style="font-family: Verdana;">Khách Bay: </font> </td>
                    <td style="width:58%;" colspan="3"> <?php echo $no_of_passengers;?> </td>
                    <td style="width:4%;"> <font style="font-family: Verdana;">Tong Tien: </font> </td>
                    <td style="width:58%;" colspan="3"> <?php echo number_format($tong_tien,0,',',',');?> VNĐ</td>

    <body>

                 
                
        </div>
<center><img src='../../../assets/logo/fly_safe.png' class='img-thumbnail' width='800px' style='height:100px;'></center>
         
  <div class="container-fluid">
                            <div class="row">
                               <div class="col-sm-12">
      <center>  <table class="table table-bordered" style="font-family: Verdana">
                
              
                
                <center><font style="font-family:Verdana; font-size:18px;">
                   
                    </font></center>
                
                <br>
                <br>
                <center><font style="font-family:Arial Black; font-size:20px;">
		
                   </font></center>
                </td>
                    <td colspan="2" width="3%" >
                   <?php
                  
                    $picfile_path ='images/';
                    $result1 = mysqli_query($con,"SELECT * FROM khach_bay where code_ve='".$_SESSION['user']."'");
                   $row1 = mysqli_fetch_array($result1)  ; 
                    
                    
                        $picsrc=$picfile_path.$row1['s_pic'];
                        
                   ?>
                        </td>
                 </tr>   


    
                 
                 <tr>
                 <td style="width:4%;"> <font style="font-family: Verdana;">CODE Vé : </font> </td>
                    <td style="width:8%;" colspan="3"> <?php echo $stname;?> </td>
                 </tr>
                 
                 
                <tr>
                    <td> <font style="font-family: Verdana;"> Khách Bay : </font> </td>
                    <td colspan="3"> <?php echo ''. $row[0]. '   ' ?>
                </tr>
                  
                  <tr>
                    <td > <font style="font-family: Verdana;"> Tên Khách Bay</font>  </td>
                    <td colspan="3"> <?php echo ''. $row[2]. '   ' ?><br>
                    <?php echo ' Age - '.$row[3] ?></td>
                  </tr>
                
                  <tr>
                    <td><font style="font-family: Verdana;"> Giới Tính</font></td>
                    <td  colspan="3"><?php echo $row[4] ?> </td>
                   </tr>
                 
                  <tr>
                    <td> <font style="font-family: Verdana;">Chọn Bữa Ăn Trên Máy Bay</font></td>
                    <td> <?php echo $row[5] ?></td>
                    <td><font style="font-family: Verdana;">Mã Số Khách Quen (nếu có)</font></td>
                    <td> <?php echo $row[6] ?> </td>

                  </tr>
                
                
                
                 
                       </table></center>
                               </div>
                            </div>
            </div>
        <?php
              }
        ?>
 <p> 
<center> <input type="submit" id="print" class="toggle btn btn-primary" value="In" onclick="printpage();"></center>
<CENTER><a class="print_hide" href="pnr.php">Kiểm tra hoá đơn khác</a></center>
</p>
   <style>
     @media print {
      .print_hide{
        display:none;
      }
     }
   </style> 

    </body>
</html>


                     