<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Admin mina sidor
	</title>
	<link rel="stylesheet" type="text/css" href="../css/minasidor-style.css">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="User">

		<p id="Username">
			User: Admin


			<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.html">
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
				<a href="statistik_admin.html">
					<li class="menuitem">
						Statistik
					</li>
				</a>
				<a href="admin_redigera.html">
					<li class="menuitem">
						Redigera fält
					</li>
				</a>
				<a href="anvandare.html">
					<li class="menuitem">
						Användare
					</li>
				</a>
				<a href="mina_sidor_admin.html">
					<li class="menuitem currentpage">
						Mina Sidor
					</li>
				</a>


			</ul>
		</div>
		<div id="content">
			<h2>
				Kontaktinformation
				<br>
			</h2>
			<form action="/action_page.php">
				Namn :
				<input type="text" name="Name" value="Karl Erik">
				<input class="flatbutton" type="submit" value="Spara">
				<br><br>
				Epost:
				<input type="text" name="email" value="KarlErik@hotmail.com">
				<input class="flatbutton" type="submit" value="Spara">
				<br><br>
				Telefon :
				<input type="text" name="telenmr" value="0123456789">
				<input class="flatbutton" type="submit" value="Spara">
				<br><br>
			</form>

			<h2>
				Ändra Lösenord
			</h2> <form id="passwchange" onsubmit="return validateForm()">
				<p>
					Befintligt Lösenord:
				</p>
				<input id="oldpass" type="password" name="oldPass" value="">
				<p>
					Nytt Lösenord:
				</p>
				<input id="newpass" type="password" name="newPass" value="">
				<p>
					Bekräfta nytt lösenord:
				</p>
				<input id="newpassconf" type="password" name="newPassconfirm" value="">
				<p id="nomatch">

				</p>
				<br>
				<input id="change" type="submit"value="Ändra Lösenord">
			</form>
			<p>
				Senaste inloggning: 2017-11-01
			</p>
			<p> Från ip : 192.168.0.1 </p>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/minasidor-script.js"></script>
</body>
</html>
