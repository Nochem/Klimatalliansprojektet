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
			User: Företag

			<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.html">
				<label>
					<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
				</label>
			</form>
		</p>
	</div>

	<div id="wrapper">
		<a href="rapport.html"></a>
		<div id="logo">
		</div>
		<div id="menu">
			<ul>
				<a href="rapport.html">
					<li class="menuitem" >
						Rapport
					</li>
				</a>
				<a href="historik.html">
					<li class="menuitem">
						Historik
					</li>
				</a>
				<a href="statistik.html">
					<li class="menuitem currentpage">
						Statistik
					</li>
				</a>
				<a href="mina_sidor.html">
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>
				<a href="kontakt.html">
					<li class="menuitem">
						Kontakt
					</li>
				</a>

			</ul>

		</div>

		<div class="chart-container">
			Se statistik mellan
			<select id="yearselectfrom" class="yearselectfrom">
				<option value="2015">2015</option>

			</select>
			och
			<select id="yearselectto" class="yearselectto">

				<option value="2019">2019</option>
			</select>
			<div id="chart">

				<canvas id="myChart" styles="width=100px height=100px"></canvas>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/statistik-script.js"></script>
	<script type="text/javascript" src="../js/chartjs_min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>
