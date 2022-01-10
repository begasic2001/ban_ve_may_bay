<?php
    session_start();

    $con=mysqli_connect("localhost","root","","ticket_booking");
    if(!isset($con)) {
        die("Database Not Found");
    }


    if(isset($_REQUEST["u_sub"])) {
    $id=$_POST['pnr'];

        if($id!='') {
            $query = mysqli_query($con ,"select * from khach_bay where code_ve='".$id."'");
            $res = mysqli_fetch_row($query);
            $query0 = mysqli_query($con ,"select * from ve where code_ve='".$id."'");
            $res0 = mysqli_fetch_row($query0);
            $query1 = mysqli_query($con ,"select * from hoa_don where code_ve='".$id."'");
            $res1 = mysqli_fetch_row($query1);

            if($res) {
                $_SESSION['user']=$id;
                header('location:../../html/user/pnrcheck.php');
            } else {
                echo '<script>';
                echo 'alert("Invalid username or password")';
                echo '</script>';
            }
            
            if($res0) {
                $_SESSION['user']=$id;
                header('location:../../html/user/pnrcheck.php');
            } else {
                echo '<script>';
                echo 'alert("Invalid username or password")';
                echo '</script>';
            }
            
            if($res1) {
                $_SESSION['user']=$id;
                header('location:../../html/user/pnrcheck.php');
            } else {
                echo '<script>';
                echo 'alert("Invalid username or password")';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'alert("Enter both username and password")';
            echo '</script>';
        }
    }
?>

<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="../../css/page/header.css">
    <link rel="stylesheet" href="../../css/page/footer.css">

    <style>
        .wrapper {
            background-color: #F3F3F3;
        }
        .header {
            justify-content: space-between;
        }
        .container {
            padding-top: 13rem;
            height: 60vh;
        }
        .container__logo img {
            display: block;
            margin: auto;
        }
        .form-data {
            margin-top: 2rem;
            text-align: center;
        }
        .form-input input {
            padding: 1rem;
        }
        .form-data button {
            margin-top: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- ==== HEADER ==== -->
        <?php
            include ("../../html/user/header.php");
        ?>

        <div class="default-font container">
            <div class="container__logo">
                <img src="../../../assets/logo/fly_safe.png" alt="logo website">
            </div>
            <form id="index" action="pnr.php" method="post" class="form-data">
                <div class="form-input">
                    <label>Nhập mã vé muốn in:</label>
                    <input type="text" id="u_id" name="pnr"><br>
                </div>
                
                <button type="submit" id="u_sub" name="u_sub" class="btn btn--success no-bor-outl-deco">In hóa đơn</button>
            </form>  
        </div>

        <!-- ==== FOOTER ==== -->
        <?php
            include ("../../html/footer.php");
        ?>
    </div>
</body>
</html>
