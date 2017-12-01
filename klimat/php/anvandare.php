<?php
   include('session.php');
?>
<!DOCTYPE  html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - AnvÃ¤ndare
	</title>
	<link rel="stylesheet" type="text/css" href="../css/anvandare-style.css">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="user">
		<a id="username">
			User: <?php echo $row['Name']; ?>
		</a>
		<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.php">
			<label>
				<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
			</label>
		</form>

	</div>
	<div id="wrapper">
		<div id="logo">
		</div>
		<div id="menu">
			<ul>
				<a href="statistik_admin.php">
					<li class="menuitem">
						Statistik
					</li>
				</a>
				<a href="admin_redigera.php">
					<li class="menuitem">
						Redigera fÃ¤lt
					</li>
				</a>
				<a href="anvandare.php">
					<li class="menuitem currentpage">
						AnvÃ¤ndare
					</li>
				</a>
				<a href="mina_sidor_admin.php">
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>

			</ul>
		</div>
		<div id="sidebar">
		</div>
		<div id="content">
			<div id="stat">
				<h1>
					AnvÃ¤ndare
				</h1>
				<button class="flatbutton" type="addMemberButton">LÃ¤gg till medlem</button>
				<table>
					<tr style="font-size:21px;">
						<th style="text-align:left">Namn</th>
						<th style="text-align:left">Mejl</th>
						<th style="text-align:left">LÃ¶senord</th>
					</tr>
					<tr>
						<td style="text-align:left">FÃ¶retag 1</td>
						<td style="text-align:left">FÃ¶retag1@hotmail.com</td>
						<td style="text-align:left">abc123</td>
						<td style="text-align:left"><button class="flatbutton" type="editMemberButton">Redigera medlem</button></td>
					</tr>
					<tr>
						<td style="text-align:left">FÃ¶retag 2</td>
						<td style="text-align:left">FÃ¶retag2@hotmail.com</td>
						<td style="text-align:left">abc123</td>
						<td style="text-align:left"><button class="flatbutton" type="editMemberButton">Redigera medlem</button></td>
					</tr>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
	</body>
	</html>
