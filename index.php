<?php
//Connect database
include "database/connect.php";

//Read session
include 'session.php';

//Read button script
include "top_button.html";

?>

<!DOCTYPE html>
<html>

<head>
	<title>University Events</title>
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

		.top {
			font-size: 34px;
			text-align: center;
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

		.search-bar {
			border-radius: 5px;
		}

		.search-bar:focus {
			outline-color: #931A21;
		}

		input[type=submit]:hover {
			background-color: #931A21;
			color: white;
		}


		table {
			margin-left: 60px;
			margin-right: 60px;
			text-align: justify;
		}

		.event_name {
			border-style: none;
			font-size: 30px;
			margin-top: 10px;
			background-color: #f2f2f2;
		}

		.search {
			background-color: transparent;
		}

		.search form {
			border: none;
			background-color: transparent;
		}
	</style>
</head>

<body background="image\bg.png">
	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>




	<!--Search event form-->
	<div class="search" style="text-align: center">
		<div class="top">
			<h1>UNIVERSITY EVENTS</h1>
			<?php include "slideshow.html"; ?>
		</div>
		<form action="event_detail.php" method="POST">
			<input type="text" size="40" class="search-bar" name="searchevent" placeholder="Enter event name to search event" style="font-size: 16px;padding: 10px" />
			<input type="submit" name="search" value="Search" />
		</form>
	</div>


	<!--Display all event area-->
	<div class="content" align="center">
		<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		//Read all event
		$read_DB = "SELECT * FROM event_details ORDER BY EventDate DESC";
		$result = mysqli_query($conn, $read_DB);

		//Display all result
		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<form action='event_detail.php' method='POST'><table>";
				echo "<tr><td><input class ='event_name'  type='text' name='eventname' value='" . $row['EventName'] . "' size=65 readonly></td></tr>";
				echo "<tr><td><span  style='font-size:16px'><hr>" . $row['EventDescription'] . "</td></tr>";
				echo "<tr><td><br></td></tr>";
				echo "<tr><td style='text-align:center'><input type='submit' name='more_detail' value='More Details'/></td></tr>";
				echo "<tr><td><br></td></tr>";
				echo "</table></form><br>";
			}
		}
		?>
	</div>
</body>

</html>