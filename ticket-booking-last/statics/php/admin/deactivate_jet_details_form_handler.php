<?php
	session_start();
?>
<html>
	<head>
		<title>HUỶ KÍCH HOẠT MÁY</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Deactivate']))
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

				if(empty($data_missing))
				{
					require_once('../mysqli_connect.php');
					$query="UPDATE may_bay SET active='No' WHERE ma_may_bay=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"s",$jet_id);
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
						echo "HUỶ THÀNH CÔNG";
						header("location: ../../html/admin/deactivate-plane.php?msg=success");
					}
					else
					{
						echo "Submit Error";
						echo mysqli_error();
						header("location: ../../html/admin/deactivate-plane.php?msg=failed");
					}
				}
				else
				{
					echo "The following data fields were empty! <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Deactivate request not received";
			}
		?>
	</body>
</html>