<!DOCTYPE html>
<html>

<head>
	<title>Logging out..</title>
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
	</style>

</head>

<body background="image\bg.png" style="margin-top: 30px;text-align: center;">
	<?php
	session_start();
	if (isset($_SESSION['UserFullName'])) {
		session_destroy();
		echo "<h1>Logout successful. Redirect to home page in 3 seconds. <br>Click <a href='index.php'>here</a> if no response.</h1>";
		header('Refresh: 2; index.php');
	}
	?>
</body>

</html>