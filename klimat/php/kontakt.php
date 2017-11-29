<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Kontakt
	</title>
	<style>

	</style>
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link rel="stylesheet" type="text/css" href="../css/minasidor-style.css">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="user">

		<p id="username">
			User: Företag
			<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.php">
				<label>
					<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
				</label>
			</form>
		</p>
	</div>
	<div id="wrapper">
		<a href="rapport.php">
			<div id="logo">
			</div>
		</a>
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
					<li class="menuitem">
						Statistik
					</li>
				</a>
				<a href="mina_sidor.php">
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>
				<a href="kontakt.php">
					<li class="menuitem currentpage">
						Kontakt
					</li>
				</a>
			</ul>
		</div>
		<div id="content">
			<p style="font-size:22px; text-align:left;">
				Karl-Erik Grevendahl, Telnummer, <a class="email" href="mailto:john.doe@example.com">E-mail</a>, osv TODO
			</p>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/minasidor-script.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>
