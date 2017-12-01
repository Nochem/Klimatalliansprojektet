<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Rapport
	</title>
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link rel="stylesheet" type="text/css" href="../css/rapport-style.css">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="user">
		<p>	User: Företag
			<form id="logout" align="right" style="float:right"name="form1" method="post" action="statistik.php">
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
					<li class="menuitem currentpage" >
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
					<li class="menuitem">
						Kontakt
					</li>
				</a>
			</ul>
		</div>
		<div id="content">
			<h1>
				Inventering av CO<sub>2</sub> utsläpp
			</h1>
			<p>
				År: <input type="text" name="Year" class="inputbox" style="float: none">
				<button class = "menubutton flatbutton" onclick = "alert('Rapport sparad')">
					Spara
				</button>
				<button class = "menubutton flatbutton rensa">
					Rensa
				</button>
			</p>
			

<?php 
require_once('mysqli_connect.php');  

$categoryTransport = "Transport";
$categoryLokalerProcesser = "Lokaler och processer";

$transport = array();
$placesAndProcesses = array();


echo '<form name="rapport2" method="post" id="rapport2">';

// --- TRANSPORT ---
		if ($emissionsql = mysqli_prepare($dbc,"SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
				$emissionsql->bind_param("s", $categoryTransport);
				$emissionsql->execute();
				$emissionsqlresult = $emissionsql->get_result();
		}
		
		echo '<h1>
				<a name="Transport">
					Transport
				</a>
			</h1>';
		
		echo '<table>';
		echo '<thead>
					<tr>
						<th>Utsläppskälla</th>
						<th>Inköpt mängd</th>
						<th>Omräkningsfaktor</th>
						<th>Utsläpp per MWh, ton CO<sub>2<sub></th>
						<th>Ton CO<sub>2</sub></th>
					</tr>
				</thead>
				<tbody id="stattableTransport">';
		while ($myrow = $emissionsqlresult->fetch_assoc()) {
			if(!empty($myrow)){
				$transport[] = $myrow['EmissionSource'];
				echo '
					<tr>
						<td>'.$myrow['EmissionSource'].'</td>
						<td>
							<input type="text" name="'.$myrow['EmissionSource'].'" onkeypress=\'return event.charCode >= 48 && event.charCode <= 57\' class="inputbox"/>
							<select>
								<option>
									m<sup>3</sup>
								</option>
								<option>
									L
								</option>
							</select>
						</td>
						<td> '.$myrow['convFactor'].' </td>
						<td> '.$myrow['EmissionCO2perMWh'].' </td>
						<td>
							<p id="outputbox" class="output"></p>
						</td>
					</tr>
					';		
			}	
		}
		echo '</tbody>';
		echo '</table>';
		
		echo'<div id="m_krav">
				<h3>Ställs miljökrav vid inköp av fordon</h3>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo" value="No" style="margin-bottom: 20px"> Nej
					</p>

					<p>Om ja beskriv krav:</p>

					<textarea class="comments" rows="4" cols="50" name="comment1" form="usrform"></textarea></td>
			</div>
			<div id="bio_krav">
				<h3>
					Biodrivmedel i köpta transporttjänster
				</h3>

				<p>Andel %
					<input  type="text" class="inputbox"/></p>
					<br>

					<p>Krav Ja/Nej</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo2" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo2" value="No" style="margin-bottom: 20px"> Nej
					</p>
			</div>
			<div id="etc_krav">
				<h3>
					Andra miljökrav på  transporttjänster (t.ex. sparsamkörning eller energieffektivitet)
				</h3>
				
				<p>
					Krav Ja/Nej
				</p>
				
				<p>
					<input class="radiobutton" type="radio" name="YesOrNo3" value="Yes"> Ja
					<input class="radiobutton" type="radio" name="YesOrNo3" value="No" style="margin-bottom: 20px"> Nej
				</p>
				
				<p>
					Om ja beskriv krav:
				</p>
					<textarea class="comments" rows="4" cols="50" name="comment2" form="usrform" style="margin-bottom: 20px"></textarea>
				</div>
				
				<div id="inkops_rese">
					<h3>
						Inköps- och resepolicy
					</h3>
					<p>
						Tillämpas inköpspolicyn för fordon
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo4" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo4" value="No" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Tillämpas resepolicy
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo5" value="Yes"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo5" value="No" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Eventuella kommentarer
					</p>
					<textarea class="comments" name="comment2" rows="8" cols="50"></textarea>
				</div>';

// --- LOKALER OCH PROCESSER --		
		if ($emissionsql2 = mysqli_prepare($dbc,"SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
				$emissionsql2->bind_param("s", $categoryLokalerProcesser);
				$emissionsql2->execute();
				$emissionsqlresult2 = $emissionsql2->get_result();
		}
		
		echo '<h1>
				<a name="LokalerProcesser">
					Lokaler och processer
				</a>
			</h1>';
		
		
		echo' <table>
					<thead>
					</thead>
					<tbody>
						<tr>
							<td>
								Lokaler som företaget äger
							</td>
							<td>
								<input  type="text" onkeypress=\'return event.charCode >= 48 && event.charCode <= 57\' class="inputbox"/>
								<p style="margin:5px">(m<sup>2</sup>)</p>
							</td>
						</tr>
						<tr>
							<td>
								Varav lokaler som hyrs ut
							</td>
							<td>
								<input type="text" onkeypress=\'return event.charCode >= 48 && event.charCode <= 57\' class="inputbox"/>
								<p style="margin:5px">(m<sup>2</sup>)</p>
							</td>
						</tr>
					</tbody>';
		
		echo '<thead>
					<tr>
						<th>Utsläppskälla</th>
						<th>Inköpt mängd</th>
						<th>Omräkningsfaktor</th>
						<th>Utsläpp per MWh, ton CO<sub>2<sub></th>
						<th>Ton CO<sub>2</sub></th>
					</tr>
				</thead>
				<tbody id="stattableLokalerProcesser">';
				
		while ($myrow2 = $emissionsqlresult2->fetch_assoc()) {
			if(!empty($myrow2)){
				$placesAndProcesses[] = $myrow2['EmissionSource'];
				echo '
					<tr>
						<td>'.$myrow2['EmissionSource'].'</td>
						<td>
							<input type="text" name="'.$myrow2['EmissionSource'].'" onkeypress=\'return event.charCode >= 48 && event.charCode <= 57\' class="inputbox"/>
							<select>
								<option>
									m<sup>3</sup>
								</option>
								<option>
									L
								</option>
							</select>
						</td>
						<td> '.$myrow2['convFactor'].' </td>
						<td> '.$myrow2['EmissionCO2perMWh'].' </td>
						<td>
							<p id="outputbox" class="output"></p>
						</td>
					</tr>';		
			}
		}
		echo '</tbody>';
		echo '</table>';
		
		echo' <h3>Övriga kommentarer</h3>
				<textarea class="comments" rows="8" cols="50">
				</textarea>';
		
// --- FLYGRESOR ---
		echo '<h1>
					<a name="flygresor">
						Flygresor
					</a>
				</h1>
				<h2>Totala flygutsläpp</h2>
				<input type="text" class="inputbox"/> <p style="margin-left: 2em;">kg Co2</p>

				<table id="reportTable">
					<thead>
						<tr>
							<th>Från</th>
							<th>Till</th>
							<th>Längd km</th>
							<th>kg C02</th>
						</tr>

					</thead>
					<tbody>

						<tr>
							<td><input name="from"type="text" class="inputbox"/></td>
							<td><input type="to" class="inputbox"/></td>
							<td><input type="lengthKM" class="inputbox"/></td>
							<td><input type="kgCO2" class="inputbox"/></td>
						</tr>
					</tbody>
				</table>

				<button id="addrow">
					Ny resa
				</button>

				<div id="flygresor_comments">
					<h3>Övriga kommentarer</h3>

					<textarea class="comments"rows="8" cols="50">
					</textarea>
					<br>
					<button class = "menubutton flatbutton savebutton" onclick = "alert(\'Rapport sparad\')">
						Spara
					</button>
					<button class = "menubutton flatbutton rensa">
						Rensa
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/rapport-script.js"></script>
</body>
</html>';
?>
		