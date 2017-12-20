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
			User: <?php echo $login_session; ?>
			<form id="logout" name="form1" action="logout.php" method="post" onsubmit="return confirm('Är du säker du vill logga ut?');">
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
		<div class="chart-container">
			
			<div id="chart">

				<canvas id="myChart" styles="width=100px height=100px"></canvas>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/chartjs_min.js"></script>
	<script type="text/javascript" src="../php/statistikscript_admin.php"></script>
</body>
</html>
