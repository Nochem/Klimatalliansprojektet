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
				class="inputbox"/>'; // onChange funktion behövs för att räkna ut enrgi i mwh
            
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
   
    echo '<table name= ' . htmlspecialchars($categoryLokalerProcesser) . ' cellspacing="10">';
   
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
				class="inputbox"/>'; // onChange funktion behövs för att räkna ut enrgi i mwh
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
    echo '</table>';
	
	echo'<h3>Övriga kommentarer</h3>
				<textarea class="comments" rows="8" cols="50">
				</textarea>';
			
// ---------- Flygresor ----------
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
}

if (isset($_GET['delete'])) {
    $deleteSQL = "DELETE FROM Transport where Id = 101";
    @mysqli_query($dbc, $deleteSQL);
}
?>
</table>
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