<?php
	session_start();
?>
<html>
	<head>
		<title>THÊM MÁY BAY</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Submit']))
			{
				$data_missing=array();
				if(empty($_POST['jet_id']))
				{
					$data_missing[]='Jet ID';
				}
				else
				{
					$jet_id=trim($_POST['jet_id']);
				}

				if(empty($_POST['jet_type']))
				{
					$data_missing[]='Jet Type';
				}
				else
				{
					$jet_type=$_POST['jet_type'];
				}

				if(empty($_POST['jet_capacity']))
				{
					$data_missing[]='Jet Capacity';
				}
				else
				{
					$jet_capacity=$_POST['jet_capacity'];
				}

				if(empty($data_missing))
				{
					require_once('../mysqli_connect.php');
					$query="INSERT INTO may_bay (ma_may_bay,loai_may_bay,suc_chua,active) VALUES (?,?,?,'Yes')";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ssi",$jet_id,$jet_type,$jet_capacity);
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
						echo "Thêm Thành Công";
						header("location: ../../html/admin/add-plane.php?msg=success");
					}
					else
					{
						echo "Thêm Thất Bại";
						echo mysqli_error();
						header("location: ../../html/admin/add-plane.php?msg=failed");
					}
				}
				else
				{
					echo "Ô dữ liệu đang bị trống! <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Gửi yêu cầu thất bại";
			}
		?>
	</body>
</html>