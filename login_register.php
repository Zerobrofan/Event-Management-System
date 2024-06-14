 <?php
	//Connect database
	include_once "database/connect.php";

	//To register user
	if (isset($_POST['register'])) {
		$uid = $_POST['userid'];
		$upass = $_POST['userpass'];
		$upass1 = $_POST['userpass1'];
		$uname = $_POST['username'];
		$utype = $_POST['usertype'];
		$uemail = $_POST['useremail'];
		$upicture = file_get_contents("image/DefaultUserAvatar.jpg");
		$upicture = mysqli_real_escape_string($conn, $upicture);

		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$insert_user = "INSERT INTO user_details (UserID, UserFullName, UserPassword, UserType, UserEmail, UserImage) VALUES ('$uid', '$uname', '$upass', '$utype', '$uemail', '$upicture')";

		//check password reconfirmation
		if (($upass != $upass1)) {
			$message = "Password and re-enter password is incorrect. Please try again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		} else {
			$result_insert_user = mysqli_query($conn, $insert_user);
			if ($result_insert_user) {
				$message = "Register success. You can login now.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			} else {
				$message = "Registration fail. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}

	//To check entered details, login user, and retrieve user name and type
	if (isset($_POST['login'])) {
		$uid = $_POST['userid'];
		$upass = $_POST['userpass'];
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$read_DB = "SELECT * FROM user_details WHERE UserID='$uid' AND UserPassword='$upass'";
		$result = mysqli_query($conn, $read_DB);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				//Compare string to check entered password and database record. Case sensitive.
				if (strcmp($upass, $row['UserPassword']) == 0) {
					session_start();
					$_SESSION['UserFullName'] = $row['UserFullName'];
					$_SESSION['UserID'] = $row['UserID'];
					$_SESSION['UserType'] = $row['UserType'];
					$message = "Login Success.";
					echo "<script type='text/javascript'>alert('$message');</script>";
					header("Refresh: 0; index.php");
				} else {
					$message = "Login Fail. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		} else {
			$message = "Login Fail. Please try again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
	?>

 <!DOCTYPE html>
 <html>

 <head>
 	<title>Login or Register</title>
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

 		.login_button {
 			color: white;
 			font-size: 26px;
 			font-weight: 900;
 			width: 50%;
 			text-align: center;
 			border: none;
 			border-bottom: 2px solid #931A21;
 			border-right: 2px solid #931A21;
 			padding: 8px 0px;
 			display: inline-block;
 			background-color: #9D3037;
 			transition-duration: 0.1s;
 		}

 		.register_button {
 			color: black;
 			font-size: 26px;
 			font-weight: 900;
 			width: 50%;
 			text-align: center;
 			border: none;
 			background-color: #f2f2f2;
 			padding: 8px 0px;
 			display: inline-block;
 			border-bottom: 2px solid #931A21;
 			transition-duration: 0.4s;
 		}

 		input[type=submit],
 		input[type=button] {
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
 		input[type=button]:hover {
 			background-color: #931A21;
 			/* Dark red color on hover */
 			color: white;
 			/* White text on hover for better contrast */
 		}

 		input[type=text],
 		input[type=password],
 		input[type=email] {
 			background-color: #f2f2f2;
 			padding: 6px 2px;
 			text-align: center;
 			border-style: none;
 			border-bottom: 2px solid #931A21;
 			font-size: 18px;
 			width: 60%;
 		}

 		.loginform {
 			margin-top: 50px;
 			width: 500px;
 			height: 500px;
 			margin-left: 33%;
 			margin-right: 33%;
 			text-align: center;
 			background-color: #f2f2f2;
 			font-size: 18px;
 			z-index: 1;
 			position: absolute;
 		}

 		.registerform {
 			margin-top: 50px;
 			width: 500px;
 			height: 500px;
 			margin-left: 33%;
 			margin-right: 33%;
 			text-align: center;
 			background-color: #f2f2f2;
 			font-size: 18px;
 			position: absolute;
 		}

 		form {
 			margin-left: 60px;
 			margin-top: 15px;
 			margin-right: 60px;
 			padding: 50px;
 			border: 0.5px solid black;
 			border-radius: 11px;
 			background-color: #f2f2f2;
 		}

 		.register-active {
 			z-index: 2;
 		}
 	</style>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 	<script>
 		$(document).ready(function() {
 			$(".register_button").click(function() {
 				$(".login_button").css('background-color', 'f2f2f2');
 				$(".register_button").css('background-color', '#9D3037');
 				$(".register_button").css('color', 'white');
 				$(".login_button").css('color', 'black');
 				$(".registerform").addClass("register-active");
 			});
 		});
 		$(document).ready(function() {
 			$(".login_button").click(function() {
 				$(".register_button").css('background-color', 'f2f2f2');
 				$(".login_button").css('background-color', '#9D3037');
 				$(".login_button").css('color', 'white');
 				$(".register_button").css('color', 'black');
 				$(".registerform").removeClass("register-active");
 			});
 		});
 		$(document).ready(function() {
 			$(".home").click(function() {
 				window.location = "index.php";
 			});
 		});
 	</script>
 </head>

 <body background="image\bg.png">
 	<!--Login form-->
 	<form method="POST" class="loginform" action="login_register.php">
 		<br><br>
 		<button type="button" class="login_button">Login</button><button type="button" class="register_button">Register</button>
 		<br><br><br><br>
 		<input type="text" class="" name="userid" placeholder="User ID" required>
 		<br><br><br>
 		<input type="password" class="" name="userpass" placeholder="Password" required>
 		<br><br><br>
 		<input type="submit" name="login" value="Login">&nbsp;&nbsp;&nbsp;&nbsp;
 		<input type="button" class="home" value="Home">
 		<br><br><br><br>
 	</form>

 	<!--Register form color: #008B8B;-->
 	<form method="POST" class="registerform" action="login_register.php">
 		<br><br>
 		<button type="button" class="login_button">Login</button><button type="button" class="register_button">Register</button>
 		<br><br>
 		<input type="text" name="userid" placeholder="User ID" required>
 		<br><br>
 		<input type="text" name="username" placeholder="Name" required>
 		<br><br>
 		<input type="password" name="userpass" placeholder="Password" required>
 		<br><br>
 		<input type="password" name="userpass1" placeholder="Re-enter Password" required>
 		<br><br>
 		<input type="email" name="useremail" placeholder="E-mail" required>
 		<br><br>
 		<input type="text" name="usertype" value="Student" placeholder="User Type" readonly>
 		<br><br>
 		<input type="submit" name="register" value="Register">&nbsp;&nbsp;&nbsp;&nbsp;
 		<input type="button" class="home" value="Home">
 	</form>
 </body>

 </html>