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
?>

<!DOCTYPE html>
<html>

<head>
	<title>View Venue</title>
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
			color: black;
			padding-top: 30px;
		}

		p {
			font-weight: 900;
			font-size: 30px;
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
		}

		table {
			margin-left: 60px;
			margin-right: 60px;
			margin-bottom: 60px;
			text-align: justify;
		}

		th {
			background-color: #931A21;
			border: 1px solid #931A21;
			font-size: 22px;
			text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
			color: white;
		}

		td {
			border: 1px solid black;
			font-size: 20px;
			text-align: center;
			padding-top: 5px;
			padding-bottom: 5px;
			background-color: white;
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

		div {
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
			padding: 30px;
			border: 0.5px solid black;
			border-radius: 11px;
			background-color: #f2f2f2;
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

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>

	<!--Sort according to name in ascending/descending order-->
	<!--Sort according to UserID by default-->
	<div id="view" align="center">
		<br>
		<p>View All Faculties</p>
		<hr>
		<form action="venue_manage_view.php" method="POST" style="font-size: 20px;">
			Sort according to faculty name in: &nbsp;&nbsp;
			<input type="submit" name="ascending" value="Ascending">&nbsp;&nbsp;
			<input type="submit" name="descending" value="Descending">
		</form>
		<table align="center" cellpadding="20px" cellspacing="6px">
			<tr>
				<th>No.</th>
				<th>Faculty</th>
				<th>Faculty Information</th>
			</tr>
			<?php
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (isset($_POST['ascending'])) {
				$count = 0;
				$read_venue = "SELECT * FROM venue_details ORDER BY VenueName ASC";
				$result_read_venue = mysqli_query($conn, $read_venue);
				if (mysqli_num_rows($result_read_venue) > 0) {
					while ($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)) {
						$count = $count + 1;
						echo "<tr>";
						echo "<td>" . $count . "</td>";
						echo "<td>" . $row['VenueName'] . "</td>";
						echo "<td>" . $row['VenueInfo'] . "</td>";
						echo "<tr>";
					}
				}
			} else if (isset($_POST['descending'])) {
				$count = 0;
				$read_venue = "SELECT * FROM venue_details ORDER BY VenueName DESC";
				$result_read_venue = mysqli_query($conn, $read_venue);
				if (mysqli_num_rows($result_read_venue) > 0) {
					while ($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)) {
						$count = $count + 1;
						echo "<tr>";
						echo "<td>" . $count . "</td>";
						echo "<td>" . $row['VenueName'] . "</td>";
						echo "<td>" . $row['VenueInfo'] . "</td>";
						echo "<tr>";
					}
				}
			} else {
				$count = 0;
				$read_venue = "SELECT * FROM venue_details ORDER BY VenueName ASC";
				$result_read_venue = mysqli_query($conn, $read_venue);
				if (mysqli_num_rows($result_read_venue) > 0) {
					while ($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)) {
						$count = $count + 1;
						echo "<tr>";
						echo "<td>" . $count . "</td>";
						echo "<td>" . $row['VenueName'] . "</td>";
						echo "<td>" . $row['VenueInfo'] . "</td>";
						echo "<tr>";
					}
				}
			}
			?>
		</table>
	</div>
</body>

</html>