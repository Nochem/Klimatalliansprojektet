<?php
   include('session.php');
   if($row['Admin'] == 0){
     header("location: rapport.php");
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Admin Statistik
	</title>
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<style>
	#yeardrop{
		width:500px;
		height: 40px;
	}
	</style>

	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="user">
		<p id="username">
			User: <?php echo $row['Name']; ?>
			<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.php">
				<label>
					<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
				</label>
			</form>
		</p>
	</div>
	<div id="wrapper">
		<div id="logo">
		</div>
		<div id="menu">
			<ul>
				<a href="anvandare.php">
					<li class="menuitem">
						Användare
					</li>
				</a>
				<a href="statistik_admin.php">
					<li class="menuitem currentpage">
						Statistik
					</li>
				</a>
				<a href="admin_redigera.php">
					<li class="menuitem">
						Redigera fält
					</li>
				</a>
				<a href="mina_sidor_admin.php">
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>
			</ul>
		</div>
		<div id="content">
			<canvas id="myChart" width="100" height="100"></canvas>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/chartjs_min.js"></script>
	<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["2014", "2013", "2012", "2011"],

			datasets: [{
				data: [727, 589, 537, 543, 574],
				backgroundColor: "rgba(63,103,126,1)",
				hoverBackgroundColor: "rgba(50,90,100,1)"
			},{
				data: [238, 553, 746, 884, 903],
				backgroundColor: "rgba(163,103,126,1)",
				hoverBackgroundColor: "rgba(140,85,100,1)"
			},{
				data: [1238, 553, 746, 884, 903],
				backgroundColor: "rgba(63,203,226,1)",
				hoverBackgroundColor: "rgba(46,185,235,1)"
			}]
		},
		options: {
			scales: {
				xAxes: [{
					barThickness:30,
					stacked:true
				}],
				yAxes: [{

					barThickness:30,
					stacked:true
				}]
			},
			responsive:true
		}
	});
	</script>
</body>
</html>
