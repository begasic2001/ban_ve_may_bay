<html>
	<head>
		<title>Add New User</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Submit']))
			{
				$data_missing=array();
				if(empty($_POST['username']))
				{
					$data_missing[]='User Name';
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
					$password=$_POST['password'];
				}
				if(empty($_POST['email']))
				{
					$data_missing[]='Email ID';
				}
				else
				{
					$email_id=trim($_POST['email']);
				}

				if(empty($_POST['name']))
				{
					$data_missing[]='Name';
				}
				else
				{
					$name=$_POST['name'];
				}
				if(empty($_POST['phone_no']))
				{
					$data_missing[]='Phone No.';
				}
				else
				{
					$phone_no=trim($_POST['phone_no']);
				}
				if(empty($_POST['address']))
				{
					$data_missing[]='Address';
				}
				else
				{
					$address=$_POST['address'];
				}

				if(empty($data_missing))
				{
					require_once('../mysqli_connect.php');
					$query="INSERT INTO khach_mua (ma_khach_mua,pass,ten,email,sdt,dia_chi) VALUES (?,?,?,?,?,?)";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ssssss",$user_name,$password,$name,$email_id,$phone_no,$address);
					mysqli_stmt_execute($stmt);
					$affected_rows=mysqli_stmt_affected_rows($stmt);
					//echo $affected_rows."<br>";
					// mysqli_stmt_bind_result($stmt,$cnt);
					// mysqli_stmt_fetch($stmt);
					// echo $cnt;
					mysqli_stmt_close($stmt);
					mysqli_close($dbc);
					/*
					$response=@mysqli_query($dbc,$query);
					*/
					if($affected_rows==1)
					{
						header('location:../../html/page/sign-up_nofi-success.php');
					}
					else
					{
						echo "Đã tồn tại tài khoản";
						echo mysqli_error();
					}
				}
				else
				{
					echo "Các ô nhập bị trống <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Không nhận được yêu cầu gửi đi";
			}
		?>
	</body>
</html>