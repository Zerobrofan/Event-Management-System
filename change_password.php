<?php
//Connect database
include_once "database/connect.php";

//Read session
include 'session.php';
$uid = $_SESSION['UserID'];
if ($uid == '' || $uid == null) {
	$message = "Please login to continue";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Refresh: 0, login_register.php");
}

//To change password
if (isset($_POST['change'])) {
	$passori = $_POST['original'];
	$passnew = $_POST['new'];
	$passre = $_POST['reenter'];

	$conn = mysqli_connect($servername, $username, $password, $dbname);


	//check password reconfirmation
	if (strcmp($passre, $passnew) !== 0) {
		$message = "New password and re-enter password is not same. Please try again.";
		echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		//read original password
		$read_ori = "SELECT UserPassword FROM user_details WHERE UserID='$uid'";
		$result_read_ori = mysqli_query($conn, $read_ori);
		//compare entered original password and password in database
		if ($result_read_ori) {
			while ($row = mysqli_fetch_array($result_read_ori, MYSQLI_ASSOC)) {
				$upass = $row['UserPassword'];
				//If not same, change password fail
				if (strcmp($passori, $upass) !== 0) {
					$message = "Original password is incorrect. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				//If same, procees with change password
				else {
					$update_password = "UPDATE user_details SET UserPassword='$passre' WHERE UserID='$uid'";
					$result_update_password = mysqli_query($conn, $update_password);
					if ($result_update_password) {
						$message = "Change password success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} else {
						$message = "Fail to change password. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Change Password</title>
	<style>
		@font-face {
			font-family: 'Cairo-Medium';
			src: url("fonts/Cairo-Medium.ttf");
			font-weight: normal;
			font-style: normal;
		}

		body {
			font-family: 'Cairo-Medium', sans-serif;
		}

		a:hover {
			color: #D05258;
		}

		a {
			color: #931A21;
			text-decoration: none;
		}


		form {
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
			padding: 10px;
			border: 0.5px solid black;
			border-radius: 11px;
			background-color: #f2f2f2;
		}

		table {
			min-width: 600px;
			max-width: 800px;
			margin-top: 50px;
			margin-bottom: 50px;
			margin-left: auto;
			margin-right: auto;
			padding-top: 20px;
			padding-bottom: 30px;
			padding-left: 10px;
			padding-right: 10px;
			min-height: 400px;
		}

		th {
			font-size: 30px;
			text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		td,
		input[type=password] {

			padding: 5px;
			text-align: center;
			border-style: none;
			font-size: 22px;
			width: 60%;
		}

		input[type=submit],
		input[type=reset] {
			border: none;
			color: white;
			padding: 10px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			transition-duration: 0.4s;
			cursor: pointer;
			background-color: white;
			color: black;
			border: 2px solid #931A21;
			border-radius: 5px;
		}

		input[type=submit]:hover,
		input[type=reset]:hover {
			background-color: #931A21;
			color: white;
		}

		hr {
			border-bottom: none;
			border-left: none;
			border-right: none;
			width: 95%;
			padding-top: 10px;
			margin-bottom: 50px;

		}
	</style>
</head>

<body background="image\bg.png">
	<form action="change_password.php" method="POST">
		<table>
			<tr>
				<th align="center">Change Password</th>
			</tr>
			<tr>
				<td>
					<hr>
					<input type="password" name="original" placeholder="Original Password" style="background-color: #f2f2f2; border-bottom: 2px solid #931A21;" required>
					<br><br>
					<input type="password" name="new" placeholder="New Password" style="background-color: #f2f2f2; border-bottom: 2px solid #931A21;" minlength="8" maxlength="12" required>
					<br><br>
					<input type="password" name="reenter" placeholder="Re-enter New Password" style="background-color: #f2f2f2; border-bottom: 2px solid #931A21;" ; required>
					<br><br><br>
					<input type="submit" name="change" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" name="cancel" value="Cancel">
				</td>
			</tr>
		</table>
	</form>

</body>

</html>