<!DOCTYPE html>
<?php
include('session.php');
?>
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
    <p>	User: <?php
        echo $login_session;
        ?>
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
        <form method="get" name="form" id="form">
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>

                    <input id="modalInputReportName" name="reportName" required='' type='text'>
                    <label alt='Rapportnamn' placeholder='Skriv det namn du vill ha på rapporten'></label>
                    <br>
                    <input id="modalInputYear" name="theYear" required='' type='text' maxlength="4"onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <label id = "modalYear" alt='År' placeholder='Skriv in för vilket pår rapporten gäller (åååå)'></label>
                    <br>
                    <input id="modalInputName" name="personName" required='' type='text'>
                    <label alt='Ditt Namn' placeholder='Skriv ditt namn'></label>
                    <input type="checkbox" name="finished" value="FärdigRapport" unchecked> Färdig Rapport
                    <br>
                    <br>
                    <button id = "saveCheck" name="Spara" form="form"  class = "menubutton flatbutton savebutton" style="left: 5px">
                        Spara
                    </button>
                </div>
            </div>

            <h1>
                Inventering av CO<sub>2</sub> utsläpp
            </h1>
            <p>

                <input type = "button" name="Spara2"  class = "menubutton flatbutton savebutton modalSave" value ="Spara"/>
                <input type = "button" class = "menubutton flatbutton rensa" value ="Rensa"/>
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

                    $str = htmlspecialchars($myrow['EmissionSource']);
                    echo "<input type=\"hidden\" name=\"emissionSource[]\" value=\"$str\">";

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
                    echo '</td>';
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

                    $str = htmlspecialchars($myrow['EmissionSource']);
                    echo "<input type=\"hidden\" name=\"emissionSource[]\" value=\"$str\">";

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
							<td><input name="totalFlightKGCO2" type="text" class="inputbox"/> 
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
				<input type="hidden" name = "nbrofRowsFlight" id="nbrofRowsFlight" value="1" >
				<button id="addrow">
					Ny resa
				</button>
				<div id="flygresor_comments">
					<h3>Övriga kommentarer</h3>
					<textarea name="OtherComment" class="comments" rows="8" cols="50"></textarea>
					<br>
					<input type = "button" name="Spara2"  class = "menubutton flatbutton savebutton modalSave" value ="Spara"/>
					<input type = "button" class = "menubutton flatbutton rensa" value ="Rensa"/>	
				</div>
				</form>
			</div>
		</div>';

            if (isset($_GET['Spara'])) {

                // KOD FÖR ATT SKAPA NY RAPPORT
                $yearinput = $_GET['theYear'];
                $name = $_GET['personName'];
                $repname = $_GET['reportName'];
                $finished = $_GET['finished'];
                $comment = $_GET['OtherComment'];
                $flygresorcount = $_GET['nbrofRowsFlight'];
                if($finished){
                    $finished = 1;
                }else{
                    $finsihed = 0;
                }
                $id = null;
                if ($createReportSql = mysqli_prepare($dbc,"INSERT INTO Report (User,Year,NameofReport,NameofUser,finished, Comment) values (?,?,?,?,?,?)")){
                    $createReportSql->bind_param("ssssis",$login_session,$yearinput,$repname,$name,$finished, $comment);
                    $createReportSql->execute();
                    $id = $createReportSql->insert_id; //Får senaste auto id som gjorts med denna sql sats
                    $createReportSql->close();
                }
                //SLUT PÅ KOD FÖR ATT SKAPA EN NY RAPPORT

                if($id != null){
                    // Transport insert
                    for ($i = 0; $i < $transportcount; $i++) {
                        $emissionSource = $_GET['emissionSource'][$i];
                        $amount = $_GET['amount'][$i];
                        $unit = $_GET['unit'][$i];
                        $convFactor = $_GET['convFactor'][$i];
                        $emissionCO2 = $_GET['emissionCO2'][$i];
                        $Ton = $_GET['ton'][$i];

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

                    if ($insertOtherTransportsql = mysqli_prepare($dbc,
                        "INSERT INTO OtherTransport(EnvironmentReqPurchased, EnvironmentReqPurchasedDescription,BioTransport, BioTransportAmount, 
	EnvironmentReqOtherTransportDescription, EnvironmentReqOtherTransport, EnforcementPurchasePolicyVehicle, EnforcementTravelPolicy, Id)
	values (?,?,?,?,?,?,?,?,?)"))
                    {
                        $insertOtherTransportsql->bind_param("isidsiiii", $envReq , $envReqDesc , $bioTransp,
                            $bioTranspAmount , $otherEnvReqDesc , $otherEnvReq, $VehicPolicy , 	$travelPolicy , $id);
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
                    $producedSolarElectr = $_GET['producedSolarElectricity'];
                    $placesOwned = $_GET['placesOwned'];
                    $placesRented = $_GET['placesRented'];
                    if ($insertOtherPlacesProcesses = mysqli_prepare($dbc,
                        "INSERT INTO OtherPlacesAndProcesses(PlacesOwned,PlacesRentedOut,ProducedSolarHeat,ProducedSolarElectricity,Id) values (?,?,?,?,?)"))
                    {
                        $insertOtherPlacesProcesses->bind_param("iiddi", $placesOwned, $placesRented, $producedSolarHeat, $producedSolarElectr, $id);
                        $insertOtherPlacesProcesses->execute();
                        $otherPlacesProcessessqlresult = $insertOtherPlacesProcesses->get_result();
                        $insertOtherPlacesProcesses->close();
                    }

                    // Insert Flygresor
                    for ($i = 0; $i <$flygresorcount; $i++) {
                        $departure = $_GET['Departure'][$i];
                        $destination = $_GET['Destination'][$i];
                        $lengthKM = $_GET['lengthKM'][$i];
                        $KgCO2 = $_GET['kgCO2'][$i];

                        if (!empty($departure) && !empty($destination)) {
                            if ($insertFlightsql = mysqli_prepare($dbc, "INSERT INTO Flights(Departure,Destination,LengthKM,KgCO2,Id) values (?,?,?,?,?)")) {
                                $insertFlightsql->bind_param("ssddi", $departure, $destination, $lengthKM, $KgCO2,$id);
                                $insertFlightsql->execute();
                                $transportqlresult = $insertFlightsql->get_result();
                                $insertFlightsql->close();
                            }
                        }
                    }

                    $flightTotKGCO2 = $_GET['totalFlightKGCO2'];

                    if(!empty($flightTotKGCO2)){
                        if ($insertOtherFlightsql = mysqli_prepare($dbc, "INSERT INTO OtherFlight(TotalAmount, Id) values (?,?)")) {
                            $insertOtherFlightsql->bind_param("di", $flightTotKGCO2, $id);
                            $insertOtherFlightsql->execute();
                            $transportqlresult = $insertOtherFlightsql->get_result();
                            $insertOtherFlightsql->close();
                        }
                    }
                }
            }
            ?>
            </table>
            <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
            <script type="text/javascript" src="../js/rapport-script.js"></script>
            <script type="text/javascript" src="../js/rapport-script-2.js"></script>
            <script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>