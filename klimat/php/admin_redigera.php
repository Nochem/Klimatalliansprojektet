<!DOCTYPE html>
<?php
   include('session.php');
?>
<!DOCTYPE  html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Admin redigera fält
	</title>
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
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
					<li class="menuitem">
						Statistik
					</li>
				</a>
				<a href="admin_redigera.php">
					<li class="menuitem currentpage">
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
			<div id="sidebar">
				<div id="stat">
					<h1>
						Redigera fält
					</h1>
					<table>
						<tr>
							<th>Utsläppskälla</th>
							<th>Standardenhet</th>
							<th>Omräkningsfaktor</th>
							<th>Utsläpp per MWH, ton CO<sub>2</sub></th>
						</tr>
						<tr>
							<td>
								<p>Pellets</p>
							</td>
							<td>
								<p>MWh</p>
							</td>
							<td>
								<p>1</p>
							</td>
							<td>
								<p>0</p>
							</td>
							<td>
								<button class="flatbutton" type="button">Redigera</button>
							</td>
							<td>
								<button class="flatbutton" type="button">Ta bort</button>
							</td>
						</tr>
						<tr>
							<td>
								<p>Olja</p>
							</td>
							<td>
								<p>m<sup>3</sup></p>
							</td>
							<td>
								<p>9,89</p>
							</td>
							<td>
								<p>0,271</p>
							</td>
							<td>
								<button class="flatbutton" type="button">Redigera</button>
							</td>
							<td>
								<button class="flatbutton" type="button">Ta bort</button>
							</td>
						</tr>
						<tr>
							<td>
								<p>Halm</p>
							</td>
							<td>
								<p>MWh</p>
							</td>
							<td>
								<p>1</p>
							</td>
							<td>
								<p>0</p>
							</td>
							<td>
								<button class="flatbutton" type="button">Redigera</button>
							</td>
							<td>
								<button class="flatbutton" type="button">Ta bort</button>
							</td>
						</tr>
						<tr>
							<td>
								<p>Gasol</p>
							</td>
							<td>
								<p>MWh</p>
							</td>
							<td>
								<p>1</p>
							</td>
							<td>
								<p>0,2344</p>
							</td>
							<td>
								<button class="flatbutton" type="button">Redigera</button>
							</td>
							<td>
								<button class="flatbutton" type="button">Ta bort</button>
							</td>
						</tr>
						<tr>
							<td>
								<button class="flatbutton" type="button">Lägg till fält</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>

	</body>
	</html>
