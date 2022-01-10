<html>
	<head>
		<title>Login Handler</title>
	</head>
	<body>
		<?php
			session_start();
			session_destroy();
			session_start();
			if(isset($_POST['Login']))
			{
				$data_missing=array();
				if(empty($_POST['username']))
				{
					$data_missing[]='Username';
				}
				else
				{
					$user_name=trim($_POST['username']);
				}
				if(empty($_POST['password']))
				{
					$data_missing[]='Password';
				}
				else
				{
					$pass_word=$_POST['password'];
				}
				if(empty($_POST['user_type']))
				{
					$data_missing[]='User Type';
				}
				else
				{
					$user_type=$_POST['user_type'];
					$_SESSION['user_type']=$user_type;
				}


				if(empty($data_missing))
				{
					if($user_type=='Customer')
					{
						require_once('../mysqli_connect.php');
						$query="SELECT count(*) FROM khach_mua where ma_khach_mua=? and pass=?";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"ss",$user_name,$pass_word);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$cnt);
						mysqli_stmt_fetch($stmt);
						//echo $cnt;
						mysqli_stmt_close($stmt);
						mysqli_close($dbc);
						/*$affected_rows=mysqli_stmt_affected_rows($stmt);
						$response=@mysqli_query($dbc,$query);
						echo $affected_rows;
						*/
						if($cnt==1)
						{
							echo "Đã đăng nhập <br>";
							$_SESSION['login_user']=$user_name;
							echo $_SESSION['login_user']." đã đăng nhập";
							header("location:../../html/user/homepage_user.php");
						}
						else
						{
							echo "Lỗi đăng nhập";
							session_destroy();
							header('location:../../html/page/sign-in.php?msg=failed');
						}
					}
					else if($user_type=='Administrator')
					{
						require_once('../mysqli_connect.php');
						$query="SELECT count(*) FROM admin where admin_id=? and pass=?";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"ss",$user_name,$pass_word);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$cnt);
						mysqli_stmt_fetch($stmt);
						//echo $cnt;
						mysqli_stmt_close($stmt);
						mysqli_close($dbc);
						/*$affected_rows=mysqli_stmt_affected_rows($stmt);
						$response=@mysqli_query($dbc,$query);
						echo $affected_rows;
						*/
						if($cnt==1)
						{
							echo "Đã đăng nhập <br>";
							$_SESSION['login_user']=$user_name;
							echo $_SESSION['login_user']." đã đăng nhập";
							header('location:../../html/admin/homepage_admin.php');
						}
						else
						{
							echo "Đăng nhập lỗi";
							session_destroy();
							header('location:../../html/page/sign-in.php?msg=failed');
						}
					}
				}
				else
				{
					echo "Các ô nhập liệu trống<br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Gửi yêu cầu không nhận được";
			}
		?>
	</body>
</html>