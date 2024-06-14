<?php
//Connect database
include "database/connect.php";

//Read session
include 'session.php';
$uid = $_SESSION['UserID'];
if ($uid == '' || $uid == null) {
	$message = "Please login to continue";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Refresh: 0, login_register.php");
}

//Read button script
include "top_button.html";

if (isset($_POST['editpicture'])) {
	//mySQL (Object-oriented)
	$conn = new mysqli($servername, $username, $password, $dbname);
	//get uploaded image
	$newpicture = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
	//get uploaded image name
	$newpicture_name = $_FILES['picture']['name'];
	if ($newpicture == false) {
		echo "<script>alert('Empty field. No update made.')</script>";
	} else {
		$update_picture = "UPDATE user_details SET UserImage='" . $newpicture . "' WHERE UserID='$uid'";
		$result_update_picture = $conn->query($update_picture);
		$update_picture_name = "UPDATE user_details SET UserImageName='" . $newpicture_name . "' WHERE UserID='$uid'";
		$result_update_picture_name = $conn->query($update_picture_name);
		if ($result_update_picture == true) {
			$message = "Update profile picture success.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("Refresh: 0, my_profile.php");
		} else {
			$message = "Fail to update profile picture. Please try again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}
if (isset($_POST['editname'])) {
	$newname = $_POST['username'];
	$update_name = "UPDATE user_details SET UserFullName='$newname' WHERE UserID='$uid'";
	$result_update_name = mysqli_query($conn, $update_name);
	if ($result_update_name) {
		$_SESSION['UserFullName'] = $newname;
		$message = "Update name success.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, my_profile.php");
	} else {
		$message = "Fail to update name. Please try again.";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
} else if (isset($_POST['editemail'])) {
	$newemail = $_POST['email'];
	$update_email = "UPDATE user_details SET UserEmail='$newemail' WHERE UserID='$uid'";
	$result_update_email = mysqli_query($conn, $update_email);
	if ($result_update_email) {
		$message = "Update e-mail success.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, my_profile.php");
	} else {
		$message = "Fail to update e-mail. Please try again.";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Edit Profile</title>
	<style type="text/css">
		@font-face {
			font-family: 'Cairo-Medium';
			src: url("fonts/Cairo-Medium.ttf");
			font-weight: normal;
			font-style: normal;
		}

		body {
			font-family: 'Cairo-Medium', sans-serif;
		}

		h1 {
			color: #931A21;
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
			max-width: 750px;
			margin-top: 50px;
			margin-bottom: 50px;
			margin-left: auto;
			margin-right: auto;
			background-color: #f2f2f2;
		}

		th {
			font-size: 30px;
			text-align: center;
			width: 50%;
		}

		td {
			font-size: 22px;
			text-align: center;				
		}

		input[type=text],
		input[type=email] {

			font-size: 22px;
			text-align: center;
			padding-top: 2px;
			padding-bottom: 5px;
		}

		input[type=file] {

			font-size: 16px;
			text-align: center;
			padding-top: 2px;
			padding-bottom: 2px;
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
			margin-bottom: 50px;
		}
	</style>
</head>

<body background="image\bg.png">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
	<div id="epicture">
		<form action="edit_profile.php" method="POST" enctype="multipart/form-data">
			<table align="center" cellspacing="20px">
				<tr>
					<th>Edit Profile Picture</th>
				</tr>
				<td>
					<hr>
				</td>
				<tr>
					<td>New Profile Picture: <input type="file" name="picture"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="editpicture" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel">
					</td>
				</tr>
			</table>
		</form>
	</div>

	<div id="ename">
		<form action="edit_profile.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr>
					<th>Edit Name</th>
				</tr>
				<td>
					<hr>
				</td>
				<tr>
					<td>New Name: <input type="text" name="username" size="30" required>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="editname" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel">
					</td>
				</tr>
			</table>
		</form>
	</div>

	<div id="eemail">
		<form action="edit_profile.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr>
					<th>Edit E-mail</th>
				</tr>
				<td>
					<hr>
				</td>
				<tr>
					<td>New E-mail: <input type="email" name="email" size="30" required>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="editemail" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>