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
?>
<!DOCTYPE html>
<html>

<head>
	<title>My Profile</title>
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

		h1 {
			color: black;
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
			margin-left: 60px;
			margin-right: 60px;
			text-align: justify;
		}

		th {
			font-size: 30px;
			text-align: center;
			padding-bottom: 20px;
			padding-top: 20px;
		}

		td {
			padding: 20px;
			font-size: 20px;

		}

		input[type=submit] {
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

		input[type=submit]:hover {
			background-color: #931A21;
			color: white;
		}

		hr {
			border-bottom: none;
			border-left: none;
			border-right: none;
			width: 80%;
			padding-top: 10px
		}

		img {
			width: 100%;
			height: auto;
		}

		.dropdown {
			display: inline-block;
			position: relative;

		}

		.dropdown-content {
			display: none;
			position: absolute;
			z-index: 1;
			border-top: 2px #931A21 solid;
			border-left: 2px #931A21 solid;
			border-right: 2px #931A21 solid;
		}

		.dropdown-button {
			display: inline-block;
			width: 100%;
			padding: 5px;
			font-size: 18px;
			border-top: none;
			border-left: none;
			border-right: none;
			border: none;
			color: white;
			transition-duration: 0.4s;
			cursor: pointer;
			background-color: white;
			color: black;
			border-bottom: 2px #931A21 solid;
		}

		.dropdown-button:hover {
			background-color: #931A21;
			color: white;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".dropdown").mouseleave(function() {
				$(".dropdown-content").hide();
			});
		});
		$(document).ready(function() {
			$(".dropdown").mouseenter(function() {
				$(".dropdown-content").show();
			});
		});
		$(document).ready(function() {
			$("#epicture").click(function() {
				window.location = "edit_profile.php#epicture";
			});
		});
		$(document).ready(function() {
			$("#ename").click(function() {
				window.location = "edit_profile.php#ename";
			});
		});
		$(document).ready(function() {
			$("#eemail").click(function() {
				window.location = "edit_profile.php#eemail";
			});
		});
	</script>
</head>

<body background="image\bg.png">
	<form action="edit_profile.php" method="POST">
		<table cellspacing="1">
			<tr>
				<h1 align=center>My Profile</h1>
				<hr>
			</tr>
			<tr>
				<td colspan="3">
				</td>
			</tr>
			<tr>
				<td rowspan="5" width="30%" style="padding-right: 100px;">
					<?php
					$user_image = "SELECT UserImage FROM user_details WHERE UserID='$uid'";
					$result_user_image = mysqli_query($conn, $user_image);
					if ($result_user_image) {
						while ($row = mysqli_fetch_array($result_user_image, MYSQLI_ASSOC)) {
							echo "<img src='data:image/png;base64," . base64_encode($row['UserImage']) . "'>";
						}
					}
					?>
				</td>
			</tr>
			<tr>
				<?php
				$read_user = "SELECT UserID FROM user_details WHERE UserID='$uid'";
				$result_read_user = mysqli_query($conn, $read_user);
				if ($result_read_user) {
					while ($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)) {
						echo "<td style='text-align:left;' ><b>User ID: </b></td>";
						echo "<td width='50%'>" . $row['UserID'] . "</td>";
					}
				}
				?>
			</tr>
			<tr>
				<?php
				$read_user = "SELECT UserFullName FROM user_details WHERE UserID='$uid'";
				$result_read_user = mysqli_query($conn, $read_user);
				if ($result_read_user) {
					while ($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)) {
						echo "<td style='text-align:left;' ><b>Name: </b></td>";
						echo "<td width='50%'>" . $row['UserFullName'] . "</td>";
					}
				}
				?>
			</tr>
			<tr>
				<?php
				$read_user = "SELECT UserEmail FROM user_details WHERE UserID='$uid'";
				$result_read_user = mysqli_query($conn, $read_user);
				if ($result_read_user) {
					while ($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)) {
						echo "<td style='text-align:left;' ><b>E-mail: </b></td>";
						echo "<td width='50%'>" . $row['UserEmail'] . "</td>";
					}
				}
				?>
			</tr>
			<tr>
				<?php
				$read_user = "SELECT UserType FROM user_details WHERE UserID='$uid'";
				$result_read_user = mysqli_query($conn, $read_user);
				if ($result_read_user) {
					while ($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)) {
						echo "<td style='text-align:left;' ><b>User Type: </b></td>";
						echo "<td width='50%'>" . $row['UserType'] . "</td>";
					}
				}
				?>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center; padding-top: 80px;">
					<div class="dropdown">
						<input type="submit" name="editprofile" value="Edit Profile">
						<div class="dropdown-content" align="center">
							<input type="button" class="dropdown-button" id="epicture" value="Profile Picture">
							<input type="button" class="dropdown-button" id="ename" value="Name">
							<input type="button" class="dropdown-button" id="eemail" value="E-mail">
						</div>
					</div>
				</td>
			</tr>
		</table>
	</form>
</body>

</html>