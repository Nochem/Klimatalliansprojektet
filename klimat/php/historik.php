<html>
	<head>
		<meta charset="UTF-8">
		<title>
			Klimat allians Lund - Historik
		</title>
		<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
		<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/historik-style.css">
		<link rel="icon" href="../res/icon.png">
	</head>
	<body>

		<form id="logout" align="right" name="form1" method="post" action="historik.html">
			  <label class="logoutLblPos">
			  <input name="submit2" type="submit" id="submit2" value="Log out">
			  </label>
		</form>
		<div id="wrapper">
			<a href="rapport.html"></a>
			<div id="logo">
			</div>
			<div id="menu">
				<ul>
					<li class="menuitem">
						<a href="rapport.html">
							Rapport
						</a>
					</li>
					<li class="menuitem currentpage">
						<a href="historik.html">
							Historik
						</a>
					</li>
					<li class="menuitem">
						<a href="statistik.html">
							Statistik
						</a>
					</li>
					<li class="menuitem">
						<a href="mina_sidor.html">
							Mina Sidor
						</a>
					</li>
				</ul>
			</div>
			<div id="sidebar">
			</div>
			<div id="content">
				<div id="stat">
					<h1>
						Inventering av CO<sub>2</sub> utsläpp från transporter
					</h1>
					<table>
						<tr>
							<th>Utsläppskälla</th>
							<th>Inköpt mängd</th>
							<th> Enhet</th>
							<th> ton CO<sub>2</sub></th>
						</tr>

<?php
// Skapar en anslutning till databasen
require_once('mysqli_connect.php');

// Queryn som skickas till databasen
$query = "SELECT YEAR(birth_date) FROM student";

// Svar från databasen genom att skicka anslutningen och queryn
$response = @mysqli_query($dbc, $query);

// Om queryn fick ett korrekt svar, fortsätt
if($response){
echo '<select id="yeardrop">';
	
// mysqli_fetch_array returnerar en rad av data från queryn och fortsätter tills ingen mer data är tillgänglig
while($row = mysqli_fetch_array($response)){
echo '<option>'. 
	$row['YEAR(birth_date)']  . 
	'</option>';
}

echo '</select>';
} else {

echo "Förfrågan till databasen misslyckades <br/>";

echo mysqli_error($dbc);
}
// Stänger anslutningen till databasen
mysqli_close($dbc);
?>
					<tbody id = "gentable">
					</tbody>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
		<script type="text/javascript" src="../js/historik-script.js"></script>
	</body>
</html>
