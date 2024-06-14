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
?>

<!DOCTYPE html>
<html>

<head>
	<title>My Booking</title>
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
	<div id="view" align="center">
		<p><span style="font-weight: 900;font-size: 30px">My Booking</span>
		</p>
		<hr>
		<table align="center" cellpadding="6px" cellspacing="6px">
			<tr>
				<th>No.</th>
				<th>Booking<br>Date & Time</th>
				<th>Event Name</th>
				<th>Event Date</th>
				<th>Event Time</th>
				<th>Faculty</th>
			</tr>
			<!--Get all booking record of hte user-->
			<?php

			$count = 0;
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			//Read user booking detail
			$read_user_booking = "SELECT * FROM booking_details WHERE UserID='$uid'";
			$result_read_user_booking = mysqli_query($conn, $read_user_booking);
			if ($result_read_user_booking) {
				while ($row = mysqli_fetch_array($result_read_user_booking, MYSQLI_ASSOC)) {
					$eid = $row['EventID'];
					$count = $count + 1;
					echo "<tr>";
					echo "<td>" . $count . "</td>";
					echo "<td>" . $row['BookingTimeStamp'] . "</td>";
					//Read event detail
					$read_event_detail = "SELECT * FROM event_details WHERE EventID='$eid'";
					$result_read_event_detail = mysqli_query($conn, $read_event_detail);
					if ($result_read_event_detail) {
						while ($row1 = mysqli_fetch_array($result_read_event_detail, MYSQLI_ASSOC)) {
							$vid = $row1['VenueID'];
							echo "<td>" . $row1['EventName'] . "</td>";
							echo "<td>" . $row1['EventDate'] . "</td>";
							echo "<td>" . $row1['EventTime'] . "</td>";
							//Read venue detail
							$read_venue_detail = "SELECT * FROM venue_details WHERE VenueID='$vid'";
							$result_read_venue_detail = mysqli_query($conn, $read_venue_detail);
							if ($result_read_event_detail) {
								while ($row2 = mysqli_fetch_array($result_read_venue_detail, MYSQLI_ASSOC)) {
									echo "<td>" . $row2['VenueName'] . "</td>";
								}
							}
						}
					}
					echo "</tr>";
				}
			}
			?>
		</table>
	</div>
</body>

</html>