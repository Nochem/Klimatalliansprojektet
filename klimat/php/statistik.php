<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Statistik
	</title>
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link rel="stylesheet" type="text/css" href="../css/statistik-style.css">
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
		<a href="rapport.php"></a>
		<div id="logo">
		</div>
		<div id="menu">
			<ul>
				<a href="rapport.php">
					<li class="menuitem" >
						Rapport
					</li>
				</a>
				<a href="historik.php">
					<li class="menuitem">
						Historik
					</li>
				</a>
				<a href="statistik.php">
					<li class="menuitem currentpage">
						Statistik
					</li>
				</a>
				<a href="mina_sidor.php">
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>
				<a href="kontakt.php">
					<li class="menuitem">
						Kontakt
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
	<script type="text/javascript" src="../php/statistikscript.php"></script>
	<script type="text/javascript" src="../js/chartjs_min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>
