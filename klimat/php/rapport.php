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
				<button name="Spara" form="form" class = "menubutton flatbutton" onclick = "alert('Rapport sparad')">
					Spara
				</button>
				<button class = "menubutton flatbutton rensa">
					Rensa
				</button>
			</p>
			
<?php
require_once('mysqli_connect.php');
// Hämtar alla unika kategorier
$emissionsqlresult = NULL;
$lokalcount = 0;
$transportcount = 0;
$flygresorcount = 0;
$arrayindex = 0;
$categoryTransport = "Transport";
$categoryLokalerProcesser = "Lokaler och processer";
echo '<form method="get" action="#">';
echo '<input type="submit" name="delete" value="ta bort test data från databas" />';
echo '</form>';
// -------------- Transport ------------
    if ($emissionsql = mysqli_prepare($dbc, "SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
        $emissionsql->bind_param("s", $categoryTransport);
        $emissionsql->execute();
        $emissionsqlresult = $emissionsql->get_result();
    }
	echo '<h1>';
		echo '<a name="Transport">
				Transport
			</a>';
    echo '</h1>';
    
	echo '<form method="get" name="form" id="form">';
    echo '<table name= ' . htmlspecialchars($categoryTransport) . ' cellspacing="10">';
   
   // Skapar rubriker till table
		echo '<th> Utsläppskälla </th>';
		echo '<th> Inköpt mängd</th>';
		echo '<th> Mått </th>';
		echo '<th> Omräknings Faktor </th>';
		echo '<th> Utsläpp CO<sub>2</sub> per MWh </th>';
		echo '<th> Ton CO<sub>2</sub> </th>';
    while ($myrow = $emissionsqlresult->fetch_assoc()) {
        if (!empty($myrow)) {
			$transportcount++;
			// Skapar innehåll i table
			echo '<tr name="row[]">';         
            echo '<td >';
				echo $myrow['EmissionSource'];
            echo '</td>';
            echo '<input type="hidden" name="emissionSource[]" value=' . $myrow['EmissionSource'] . '>';
          
            echo '<td>';
				echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')" 
				onchange ="tonCO2(' . $arrayindex . ')" 
				class="inputbox"/>'; 
            
			echo '</td>';
            echo '<td>';
				echo '<select name="unit[]">';
				echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
				echo '</select>';
            echo '</td>';
 
            echo '<td>' . $myrow['convFactor'] . '</td>';
            echo '<input type="hidden" name="convFactor[]" value=' . $myrow['convFactor'] . '>';
          
            echo '<td id= >' . $myrow['EmissionCO2perMWh'] . '</td>';
            echo '<input type="hidden" name="emissionCO2[]" value=' . $myrow['EmissionCO2perMWh'] . '>';
  
            echo '<td name=tonCO[]>';
            echo '</td>'; // behövs matte
            echo '<input type="hidden" name="ton[]">';
            echo '</tr>';
            $arrayindex++;
        }
    }
	
    echo '</table>';

	echo'<div id="m_krav">
				<h3>Ställs miljökrav vid inköp av fordon</h3>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo" value="1"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo" value="0" style="margin-bottom: 20px"> Nej
					</p>
					<p>Om ja beskriv krav:</p>
					<textarea class="comments" rows="4" cols="50" name="comment1" form="form"></textarea></td>
			</div>
			<div id="bio_krav">
				<h3>
					Biodrivmedel i köpta transporttjänster
				</h3>
				<p>Andel %
					<input name="bioTranspAmount" type="text" class="inputbox"/></p>
					<br>
					<p>Krav Ja/Nej</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo2" value="1"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo2" value="0" style="margin-bottom: 20px"> Nej
					</p>
			</div>
			<div id="etc_krav">
				<h3>
					Andra miljökrav på transporttjänster (t.ex. sparsamkörning eller energieffektivitet)
				</h3>
				
				<p>
					Krav Ja/Nej
				</p>
				
				<p>
					<input class="radiobutton" type="radio" name="YesOrNo3" value="1"> Ja
					<input class="radiobutton" type="radio" name="YesOrNo3" value="0" style="margin-bottom: 20px"> Nej
				</p>
				
				<p>
					Om ja beskriv krav:
				</p>
					<textarea class="comments" rows="4" cols="50" name="comment2" form="form" style="margin-bottom:20px"></textarea>
				</div>
				
				<div id="inkops_rese">
					<h3>
						Inköps- och resepolicy
					</h3>
					<p>
						Tillämpas inköpspolicyn för fordon
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo4" value="1"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo4" value="0" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Tillämpas resepolicy
					</p>
					<p>
						<input class="radiobutton" type="radio" name="YesOrNo5" value="1"> Ja
						<input class="radiobutton" type="radio" name="YesOrNo5" value="0" style="margin-bottom: 20px"> Nej
					</p>
					<p>
						Eventuella kommentarer
					</p>
					<textarea class="comments" name="comment3" rows="8" cols="50"></textarea>
		
				</div>';
				
				
	
// ----------- Lokaler och processer ---------------
if ($emissionsql = mysqli_prepare($dbc, "SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
        $emissionsql->bind_param("s", $categoryLokalerProcesser);
        $emissionsql->execute();
        $emissionsqlresult = $emissionsql->get_result();
}
	echo '<h1>';
		echo '<a name="Lokaler och processer">
				Lokaler och processer
			</a>';
    echo '</h1>';
	
	echo '<table name= ' . htmlspecialchars($categoryLokalerProcesser) . ' cellspacing="10">
					<thead>
					</thead>
					<tbody>
						<tr>
							<td>
								Lokaler som företaget äger
							</td>
							<td>
								<input name="placesOwned" type="text" class="inputbox"/>
								
							</td>
							<td>
								<p style="margin:5px">m<sup>2</sup></p>
							</td>
						</tr>
						<tr>
							<td>
								Varav lokaler som hyrs ut
							</td>
							<td>
								<input name="placesRented" type="text" class="inputbox"/>
							</td>
							<td>
								<p style="margin:5px">m<sup>2</sup></p>
							</td>
						</tr>
					</tbody>';
	
   // Skapar rubriker till table
	echo '<thead>
			<tr>';
		echo '<th> Utsläppskälla </th>';
		echo '<th> Inköpt mängd</th>';
		echo '<th> Mått </th>';
		echo '<th> Omräknings Faktor </th>';
		echo '<th> Utsläpp CO<sub>2</sub> per MWh </th>';
		echo '<th> Ton CO<sub>2</sub> </th>';
		
	echo '	</tr>
		</thead>
	<tbody id="stattableTransport">';
    while ($myrow = $emissionsqlresult->fetch_assoc()) {
        if (!empty($myrow)) {
			$lokalcount++;
			// Skapar innehåll i table
			echo '<tr name="row[]">';         
            echo '<td >';
				echo $myrow['EmissionSource'];
            echo '</td>';
            echo '<input type="hidden" name="emissionSource[]" value=' . $myrow['EmissionSource'] . '>';
          
            echo '<td>';
				echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')" onchange ="tonCO2(' . $arrayindex . ')" 
				class="inputbox"/>';
            echo '</td>';
            echo '<td>';
				echo '<select name="unit[]">';
				echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
				echo '</select>';
            echo '</td>';
 
            echo '<td>' . $myrow['convFactor'] . '</td>';
            echo '<input type="hidden" name="convFactor[]" value=' . $myrow['convFactor'] . '>';
          
            echo '<td id= >' . $myrow['EmissionCO2perMWh'] . '</td>';
            echo '<input type="hidden" name="emissionCO2[]" value=' . $myrow['EmissionCO2perMWh'] . '>';
  
            echo '<td name=tonCO[]>';
            echo '</td>';// behövs matte
            echo '<input type="hidden" name="ton[]" value="0">';
            echo '</tr>';
            $arrayindex++;
        }
    }
	echo '</tbody>';
	
	echo '<thead>
				<th>Produktion av förnybar energi</th>
		  </thead>
		<tbody>';
	echo '<tr> 
			<td>
				Produktion av solvärme
			</td>';
	echo '<td> <input class="inputbox" name="producedSolarHeat" type="text"> </td>';
	echo '<td>
			<p style="margin:5px">MWh</p>
		 </td>';
	echo '</tr>';
	echo '<tr> 
			<td>
				Produktion av solel
			</td>';
	echo '<td> <input class="inputbox" name="producedSolarElectr" type="text"> </td>';
	echo '<td>
			<p style="margin:5px">MWh</p>
		 </td>';
	echo '</tr>
		</tbody>';
	
    echo '</table>';
	
	echo'<h3>Övriga kommentarer</h3>
				<textarea name="placesProcessesComment" class="comments" rows="8" cols="50"></textarea>';
			
// ---------- Flygresor ----------
$flygresorcount = 1;
echo '<h1>
					<a name="flygresor">
						Flygresor
					</a>
				</h1>
					
				<table id="reportTable">
					<thead>	
						<tr>
							<th>Totala flygutsläpp</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" class="inputbox"/> 
							</td>
							<td>
								<p style="margin-left: 2em;"> kg CO<sub>2</sub></p>
							</td>
						</tr>
					</tbody>
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
							<td><input name="Departure[]"type="text" class="inputbox"/></td>
							<td><input name="Destination[]" class="inputbox"/></td>
							<td><input name="lengthKM[]" class="inputbox"/></td>
							<td><input name="kgCO2[]" class="inputbox"/></td>
						</tr>
					</tbody>
				</table>
				<button id="addrow">
					Ny resa
				</button>
				<div id="flygresor_comments">
					<h3>Övriga kommentarer</h3>
					<textarea name="flightsComment" class="comments" rows="8" cols="50"></textarea>
					<br>
					<button name="Spara" form="form" class = "menubutton flatbutton savebutton" onclick = "alert(\'Rapport sparad\')">
						Spara
					</button>
					
					<button class = "menubutton flatbutton rensa">
						Rensa
					</button>
					
					
				</div>
			</div>
		</div>
		</form>
		';
if (isset($_GET['Spara'])) {
	// Transport insert
    for ($i = 0; $i < $transportcount; $i++) {
        $emissionSource = $_GET['emissionSource'][$i];
        $amount = $_GET['amount'][$i];
        $unit = $_GET['unit'][$i];
        $convFactor = $_GET['convFactor'][$i];
        $emissionCO2 = $_GET['emissionCO2'][$i];
        $Ton = $_GET['ton'][$i];
        $id = "101";
        /*  echo "<script type='text/javascript'>alert('$emissionSource');</script>";
          echo "<script type='text/javascript'>alert('$unit');</script>";
           echo "<script type='text/javascript'>alert('$convFactor');</script>";
            echo "<script type='text/javascript'>alert('$emissionCO2');</script>";
             echo "<script type='text/javascript'>alert('$Ton');</script>"; */
        if (!empty($amount)) {
            if ($insertTransportsql = mysqli_prepare($dbc, "INSERT INTO Transport(EmissionSource,Unit,ConvFactor,EmissionMwh,TonCO2,Id) values (?,?,?,?,?,?)")) {
                $insertTransportsql->bind_param("ssdddi", $emissionSource, $unit, $convFactor, $emissionCO2, $Ton, $id);
                $insertTransportsql->execute();
                $transportqlresult = $insertTransportsql->get_result();
                $insertTransportsql->close();
            }
        }
    }
	$lokalerstart = $transportcount;
	$lokalerlength = $transportcount + $lokalcount; 
	
	//Övrigt Transport insert
	$envReq = $_GET['YesOrNo'];
	$envReqDesc = $_GET['comment1'];
	
	$bioTranspAmount = $_GET['bioTranspAmount'];
	$bioTransp = $_GET['YesOrNo2'];
	
	$otherEnvReq = $_GET['YesOrNo3'];
	$otherEnvReqDesc = $_GET['comment2'];
	
	$VehicPolicy = $_GET['YesOrNo4'];
	$travelPolicy = $_GET['YesOrNo5'];

	$comment = $_GET['comment3'];

	if ($insertOtherTransportsql = mysqli_prepare($dbc, 
	"INSERT INTO OtherTransport(EnviormentReqPurchased, EnviormentReqPurchasedDescription,BioTransport, BioTransportAmount, 
	EnviormentReqOtherTransportDescription, EnviormentReqOtherTransport, EnforcementPurchasePolicyVehicle, EnforementTravelPolicy, Comment, Id)
	values (?,?,?,?,?,?,?,?,?,?)")) 
	{
        $insertOtherTransportsql->bind_param("isidsiiisi", $envReq , $envReqDesc , $bioTransp, 
		$bioTranspAmount , $otherEnvReqDesc , $otherEnvReq, $VehicPolicy , 	$travelPolicy , $comment , $id);
        $insertOtherTransportsql->execute();
        $otherTransportqlresult = $insertOtherTransportsql->get_result();
        $insertOtherTransportsql->close();
    }

	
	// Lokaler och Processer insert
	for ($i = $lokalerstart; $i < $lokalerlength; $i++) {
        $emissionSource = $_GET['emissionSource'][$i];
        $amount = $_GET['amount'][$i];
        $unit = $_GET['unit'][$i];
        $convFactor = $_GET['convFactor'][$i];
        $emissionCO2 = $_GET['emissionCO2'][$i];
        $Ton = $_GET['ton'][$i];
        $id = "101";
        /*  echo "<script type='text/javascript'>alert('$emissionSource');</script>";
          echo "<script type='text/javascript'>alert('$unit');</script>";
           echo "<script type='text/javascript'>alert('$convFactor');</script>";
            echo "<script type='text/javascript'>alert('$emissionCO2');</script>";
             echo "<script type='text/javascript'>alert('$Ton');</script>"; */
        if (!empty($amount)) {
            if ($insertPlacesProcesses = mysqli_prepare($dbc, "INSERT INTO PlacesAndProcesses(EmissionSource,Unit,ConvFactor,EmissionMwh,TonCO2,Id) values (?,?,?,?,?,?)")) {
                $insertPlacesProcesses->bind_param("ssdddi", $emissionSource, $unit, $convFactor, $emissionCO2, $Ton, $id);
                $insertPlacesProcesses->execute();
                $placesProcessessqlresult = $insertPlacesProcesses->get_result();
                $insertPlacesProcesses->close();
            }
        }
    }
	
	//Övrig lokaler och processer insert
	$producedSolarHeat = $_GET['producedSolarHeat'];
	$producedSolarElectr = $_GET['producedSolarElectr'];
	
	$PlacesProcessesComment = $_GET['placesProcessesComment'];
	$placesOwned = $_GET['placesOwned'];
	$placesRented = $_GET['placesRented'];

	 if ($insertOtherPlacesProcesses = mysqli_prepare($dbc, 
	 "INSERT INTO OtherPlacesAndProcesses(PlacesOwned,PlacesRentedOut,ProducedSolarHeat,ProducedSolarElectricity,Comment,Id) values (?,?,?,?,?,?)"))
	{
        $insertOtherPlacesProcesses->bind_param("iiddsi", $placesOwned, $placesRented, $producedSolarHeat,  $producedSolarElectr, $PlacesProcessesComment, $id);
        $insertOtherPlacesProcesses->execute();
        $otherPlacesProcessessqlresult = $insertOtherPlacesProcesses->get_result();
        $insertOtherPlacesProcesses->close();
    }
	
	// Insert Flygresor
for ($i = 0; $i <$flygresorcount; $i++) {
        $departure= $_GET['Departure'][$i];
        $destination = $_GET['Destination'][$i];
        $lengthKM = $_GET['lengthKM'][$i];
        $KgCO2 = $_GET['kgCO2'][$i];
        $id = "101";
        /*  echo "<script type='text/javascript'>alert('$emissionSource');</script>";
          echo "<script type='text/javascript'>alert('$unit');</script>";
           echo "<script type='text/javascript'>alert('$convFactor');</script>";
            echo "<script type='text/javascript'>alert('$emissionCO2');</script>";
             echo "<script type='text/javascript'>alert('$Ton');</script>"; */
        if (!empty($departure) && !empty($destination)) {
            if ($insertFlightsql = mysqli_prepare($dbc, "INSERT INTO Flights(Departure,Destination,LengthKM,KgCO2,Id) values (?,?,?,?,?)")) {
                $insertFlightsql->bind_param("ssddi", $departure, $destination, $lengthKM, $KgCO2,$id);
                $insertFlightsql->execute();
                $transportqlresult = $insertFlightsql->get_result();
                $insertFlightsql->close();
            }
        }
    }
}
if (isset($_GET['delete'])) {
    $deleteSQL = "DELETE FROM Transport where Id = 101";
    @mysqli_query($dbc, $deleteSQL);
	$deleteSQL = "DELETE FROM PlacesAndProcesses where Id = 101";
	@mysqli_query($dbc, $deleteSQL);
	$deleteSQL = "DELETE FROM Flights where Id = 101";
	@mysqli_query($dbc, $deleteSQL);
	$deleteSQL = "DELETE FROM OtherPlacesAndProcesses where Id = 101";
	@mysqli_query($dbc, $deleteSQL);
	$deleteSQL = "DELETE FROM OtherTransport where Id = 101";
	@mysqli_query($dbc, $deleteSQL);
	
}
?>
</table>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/rapport-script.js"></script>
</body>
<script>
    function tonCO2(nbr) {
        var amount = document.getElementsByName("amount[]")[nbr].value;
        var convFac = document.getElementsByName("convFactor[]")[nbr].value;
        var emission = document.getElementsByName("emissionCO2[]")[nbr].value;
        amount = noLetters(amount);
        update(nbr, amount, emission, convFac);
        amount = noPeriodFirst(amount);
        update(nbr, amount, emission, convFac);
        amount = checkTwoDot(amount);
        update(nbr, amount, emission, convFac);
        document.getElementsByName("amount[]")[nbr].value = amount;
    }
    function update(nbr, amount, emission, convFac) {
        var amount1 = amount.replace(',', '.');
        document.getElementsByName("amount[]")[nbr].value = amount;
        var ton = amount1 * emission * convFac;
        if (!isNaN(ton) && ton > 0) {
            document.getElementsByName("tonCO[]")[nbr].innerHTML = round(ton, 2);
            document.getElementsByName("ton[]")[nbr].value = round(ton, 2);
        } else {
            document.getElementsByName("tonCO[]")[nbr].innerHTML = "";
            document.getElementsByName("ton[]")[nbr].innerHTML = "";
        }
    }
    function noLetters(str) {
        
        str = str.replace(/[^0-9,.]/gi, '');
        return str;
    }
    function noPeriodFirst(str) {
        if (str.charAt(0) == '.') {
            str = setCharAt(str, 0, "");
        }
        if (str.charAt(0) == ',') {
            str = setCharAt(str, 0, "");
        }
        return str;
    }
    function checkTwoDot(str) {
        if (str.match(/[.,]/gi).length > 1) {
            str = setCharAt(str, str.length - 1, '');
            return str;
        }
        return str;
    }
    function setCharAt(str, index, chr) {
        if (index > str.length - 1) return str;
        return str.substr(0, index) + chr + str.substr(index + 1);
    }
    function round(value, decimals) {
        return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
    }
</script>
</html>