<!DOCTYPE html>
<?php
include('session.php');
?>
<html>
<head>
	<?php
	$rapport_id = $_SESSION['Id'];
	 if (isset($_GET['Spara'])) {
		  $lokalcount = $_GET['nbrofRowslokal'];
		$transportstart = $lokalcount;
		$transportcount = $_GET['nbrofRowsTransport'];
		 $rapport_id = $_SESSION['Id'];
		 $_SESSION['Id'] = null;
                // KOD FöR ATT SKAPA NY RAPPORT
                $yearinput = $_GET['theYear'];
                $name = $_GET['personName'];
                $repname = $_GET['reportName'];
                $finished = $_GET['finished'];
                $comment = $_GET['OtherComment'];
                $flygresorcount = $_GET['nbrofRowsFlight'];

		$transportstart = $lokalcount;
		$transportlength = $lokalcount + $transportcount;

                if($finished){
                    $finished = 1;
                }else{
                    $finsihed = 0;
                }
                $id = null;
                if ($createReportSql = mysqli_prepare($dbc,"INSERT INTO Report (ChangeDate, User,Year,NameofReport,NameofUser,finished, Comment) values (default,?,?,?,?,?,?)
					ON DUPLICATE KEY UPDATE ChangeDate = default, Year = ?, NameofReport = ? , finished = ?, Comment = ? , NameofUser = ?")){
                    $createReportSql->bind_param("ssssisssiss",$login_session,$yearinput,$repname,$name,$finished, $comment, $yearinput , $repname, $finished, $comment, $name);
                    $createReportSql->execute();
                    $id = $createReportSql->insert_id; //Får senaste auto id som gjorts med denna sql sats
					$_SESSION['createdReport'] = $createReportSql->affected_rows;
                    $createReportSql->close();
					$_SESSION['SentId'] = $id;
                }
                //SLUT PÅ… KOD FöR ATT SKAPA EN NY RAPPORT
                if($id != null){
                    // Transport insert
                    for ($i = $lokalcount; $i < $transportlength; $i++) {
                        $emissionSource = $_GET['emissionSource'][$i];
                        $amount = $_GET['amount'][$i];
                        $unit = $_GET['unit'][$i];
                        $convFactor = $_GET['convFactor'][$i];
                        $emissionCO2 = $_GET['emissionCO2'][$i];
                        $Ton = $_GET['ton'][$i];
                        if (!empty($amount) && !is_null($Ton)){
                            if ($insertTransportsql = mysqli_prepare($dbc, "INSERT INTO Transport(EmissionSource,Amount,Unit,ConvFactor,EmissionMwh,TonCO2,Id) values (?,?,?,?,?,?,?)
								ON DUPLICATE KEY UPDATE Amount = ?, Unit = ?, TonCO2 = ? ")) {
                                $insertTransportsql->bind_param("sdsdddidsd", $emissionSource, $amount, $unit, $convFactor, $emissionCO2, $Ton, $id, $amount, $unit, $Ton);
                                $insertTransportsql->execute();
                                $transportqlresult = $insertTransportsql->get_result();
                                $insertTransportsql->close();
                            }
                        }
                    }
                    $lokalerstart = $transportcount;
                    $lokalerlength = $transportcount + $lokalcount;
                    //övrigt Transport insert
                    $envReq = $_GET['YesOrNo'];
                    $envReqDesc = $_GET['comment1'];
                    $bioTranspAmount = $_GET['bioTranspAmount'];
                    $otherEnvReq = $_GET['YesOrNo3'];
                    $otherEnvReqDesc = $_GET['comment2'];
                    $VehicPolicy = $_GET['YesOrNo4'];
                    $travelPolicy = $_GET['YesOrNo5'];
                    if ($insertOtherTransportsql = mysqli_prepare($dbc,
                        "INSERT INTO OtherTransport(EnvironmentReqPurchased, EnvironmentReqPurchasedDescription, BioTransportAmount,
	EnvironmentReqOtherTransportDescription, EnvironmentReqOtherTransport, EnforcementPurchasePolicyVehicle, EnforcementTravelPolicy, Id)
	values (?,?,?,?,?,?,?,?)
	ON DUPLICATE KEY UPDATE EnvironmentReqPurchased = ?, EnvironmentReqPurchasedDescription = ?, BioTransportAmount = ?,
	EnvironmentReqOtherTransportDescription = ?, EnvironmentReqOtherTransport = ?, EnforcementPurchasePolicyVehicle = ?, EnforcementTravelPolicy = ?"))
                    {
                        $insertOtherTransportsql->bind_param("isdsiiiiisdsiii", $envReq , $envReqDesc ,
                            $bioTranspAmount , $otherEnvReqDesc , $otherEnvReq, $VehicPolicy , 	$travelPolicy , $id
							, $envReq, $envReqDesc,  $bioTranspAmount , $otherEnvReqDesc, $otherEnvReq,  $VehicPolicy , $travelPolicy  );
                        $insertOtherTransportsql->execute();
                        $otherTransportqlresult = $insertOtherTransportsql->get_result();
                        $insertOtherTransportsql->close();
                    }
                    // Lokaler och Processer insert
                    for ($i = 0; $i < $lokalcount; $i++) {
                        $emissionSource = $_GET['emissionSource'][$i];
                        $amount = $_GET['amount'][$i];
                        $unit = $_GET['unit'][$i];
                        $convFactor = $_GET['convFactor'][$i];
                        $emissionCO2 = $_GET['emissionCO2'][$i];
                        $Ton = $_GET['ton'][$i];
                        if (!empty($amount) && !is_null($Ton)) {
                            if ($insertPlacesProcesses = mysqli_prepare($dbc, "INSERT INTO PlacesAndProcesses(EmissionSource,Amount,Unit,ConvFactor,EmissionMwh,TonCO2,Id) values (?,?,?,?,?,?,?)
								ON DUPLICATE KEY UPDATE Amount = ?, Unit = ?, TonCO2 = ?")) {
                                $insertPlacesProcesses->bind_param("sdsdddidsd", $emissionSource, $amount, $unit, $convFactor, $emissionCO2, $Ton, $id, $amount, $unit, $Ton);
                                $insertPlacesProcesses->execute();
                                $placesProcessessqlresult = $insertPlacesProcesses->get_result();
                                $insertPlacesProcesses->close();
                            }
                        }
                    }
                    //övrig lokaler och processer insert
                    $producedSolarHeat = $_GET['producedSolarHeat'];
                    $producedSolarElectr = $_GET['producedSolarElectrity'];
                    $placesOwned = $_GET['placesOwned'];
                    $placesRented = $_GET['placesRented'];
                    if ($insertOtherPlacesProcesses = mysqli_prepare($dbc,
                        "INSERT INTO OtherPlacesAndProcesses(PlacesOwned,PlacesRentedOut,ProducedSolarHeat,ProducedSolarElectricity,Id) values (?,?,?,?,?)
						ON DUPLICATE KEY UPDATE PlacesOwned = ? ,PlacesRentedOut = ?, ProducedSolarHeat = ? , ProducedSolarElectricity = ?"))
                    {
                        $insertOtherPlacesProcesses->bind_param("iiddiiidd", $placesOwned, $placesRented, $producedSolarHeat, $producedSolarElectr, $id, $placesOwned, $placesRented, $producedSolarHeat, $producedSolarElectr);
                        $insertOtherPlacesProcesses->execute();
                        $otherPlacesProcessessqlresult = $insertOtherPlacesProcesses->get_result();
                        $insertOtherPlacesProcesses->close();
                    }
					if ($deleteFlights = mysqli_prepare($dbc, "DELETE FROM Flights WHERE id = ?")) {
                                $deleteFlights->bind_param("i", $id);
                                $deleteFlights->execute();
                                $deleteFlightsResult = $deleteFlights->get_result();
                                $deleteFlights->close();
                    }
                    // Insert Flygresor
                    for ($i = 0; $i <$flygresorcount; $i++) {
                        $departure = $_GET['Departure'][$i];
                        $destination = $_GET['Destination'][$i];
                        $lengthKM = $_GET['lengthKM'][$i];
                        $KgCO2 = $_GET['kgCO2'][$i];
                        if (!empty($KgCO2)) {
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
                        if ($insertOtherFlightsql = mysqli_prepare($dbc, "INSERT INTO OtherFlight(TotalAmount, Id) values (?,?) ON DUPLICATE KEY UPDATE TotalAmount = ?")) {
                            $insertOtherFlightsql->bind_param("did", $flightTotKGCO2, $id, $flightTotKGCO2 );
                            $insertOtherFlightsql->execute();
                            $transportqlresult = $insertOtherFlightsql->get_result();
                            $insertOtherFlightsql->close();
                        }
                    }
                }
            }
			if($_SESSION['createdReport'] > 0){

					$host  = $_SERVER['HTTP_HOST'];
					$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
					$extra = 'historik.php';

					header("Location: http://$host$uri/$extra");

					exit;

					}
	?>
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
<div id="wrapper">
    <a href="rapport.php">
        <div id="logo">

            <div id="user">
                		<p id="username">
            			User: <?php echo $login_session; ?>

            		</p>
            	</div>
        </div>
    </a>

    <div id="menu">
        <ul>
            <a href="rapport.php" >
                <li class="menuitem changeSite" >
                    Rapport
                </li>
            </a>
            <a href="historik.php">
                <li class="menuitem changeSite">
                    Historik
                </li>
            </a>
            <a href="statistik.php">
                <li class="menuitem changeSite">
                    Statistik
                </li>
            </a>
            <a href="mina_sidor.php">
                <li class="menuitem changeSite">
                    Mina Sidor
                </li>
            </a>
            <a href="kontakt.php">
                <li class="menuitem changeSite">
                    Kontakt
                </li>
            </a>

            <li style="padding:0em">
                <form id="logout" name="form1" action="logout.php" method="post" onsubmit="return confirm('Är du säker du vill logga ut?'")>
    				<input name="submit2" type="submit" id="submit2" value="Logga ut">
    			</form>
            </li>
        </ul>
    </div>
	<?php
					$rapport_id = $_SESSION['Id'];
				  if ($ReportSql = mysqli_prepare($dbc, "SELECT Id,NameofReport,NameOfUser,DATE(ChangeDate) as ChangeDate,Year ,finished,Comment from Report where Id = ? and User = ?")) {
					$ReportSql ->bind_param("is", $rapport_id,$login_session);
					/* execute query */
				   $ReportSql ->execute();
					/* instead of bind_result: */
					$ReportSqlres= $ReportSql->get_result();
					/* now you can fetch the results into an array - NICE */
				   }else{
				   }
				    $reportRow = $ReportSqlres->fetch_assoc();
					$reportYear = $reportRow['Year'];
					$ReportName = $reportRow['NameofReport'];
					$Reporter = $reportRow['NameOfUser'];
					$lastChange = $reportRow['ChangeDate'];
					$fin = $reportRow['finished'];
					$Comment = $reportRow['Comment'];
					$finished = $fin ? "Färdig" : "Ej Färdig";




	?>
    <div id="content">
        <form method="get" name="form" id="form">
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>

                    <input id="modalInputReportName" name="reportName" value = "<?php echo $ReportName;?>" required='' type='text'>
                    <label alt='Rapportnamn' placeholder='Skriv det namn du vill ha på rapporten'></label>
                    <br>
                   <input id="modalInputYear" name="theYear" required='' value = "<?php echo $reportYear;?>" type='text' maxlength="4"oninput='yearCheck(this.value)'>
                    <label id = "modalYear" alt='År' placeholder='Skriv in för vilket pår rapporten gäller (åååå)'></label>
                    <br>
                    <input id="modalInputName" name="personName" value = "<?php echo $Reporter;?>" required='' type='text'>
                    <label alt='Ditt Namn' placeholder='Skriv ditt namn'></label>
                    <label for="finCheck">Färdig rapport</label>
                    <input id="finCheck" type="checkbox" name="finished" value="FärdigRapport" <?php echo ($fin ? 'checked' : ''); ?>>

                    <br>
                    <br>
                    <button id = "saveCheck" name="Spara" form="form"  class = "menubutton flatbutton savebutton" style="left: 5px">
                        Spara
                    </button>
                </div>
            </div>
			<?php
				 if(!empty($reportRow)){

					   echo '<h1>';
					   echo "Redigera rapport för år " .''. $reportYear;
					   echo '</h1>';
					   echo '<table name="info">';
					echo '<tr><th align = "left">Rapportnamn:</th>';
					echo '<td>';
					echo $ReportName;
					echo '</td></tr>';
					echo '<tr><th align = "left">Rapporterad av:</th>';
					echo '<td>' ;
					echo $Reporter;
					echo '</td></tr>';
					echo '<tr><th align = "left">Senast ändrad:</th>';
					echo '<td>';
					echo $lastChange;
					echo '</td></tr>';
					echo '<tr><th align = "left">Status:</th>';
					echo '<td>' ;
					echo $finished;
					echo '</td></tr>';
					echo '</table>';


				   }
				?>

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

            if ($emissionsql = mysqli_prepare($dbc, "SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
                $emissionsql->bind_param("s", $categoryTransport);
                $emissionsql->execute();
                $emissionsqlresult = $emissionsql->get_result();
            }

		if ($Transportsql = mysqli_prepare($dbc, "SELECT Transport.TonCO2, Transport.Unit, Transport.EmissionSource, Amount FROM ConversionFactors JOIN Transport ON ConversionFactors.EmissionSource = Transport.EmissionSource WHERE Id = ?")) {
                $Transportsql->bind_param("i", $rapport_id);
                $Transportsql->execute();
                $Transportsqlresult = $Transportsql->get_result();
            }
			if ($emissionsqlPlaces = mysqli_prepare($dbc, "SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
                $emissionsqlPlaces->bind_param("s", $categoryLokalerProcesser);
                $emissionsqlPlaces->execute();
                $Placesemissionsqlresult = $emissionsqlPlaces->get_result();
            }

			if ($LokalSql = mysqli_prepare($dbc, "SELECT PlacesAndProcesses.Unit, PlacesAndProcesses.EmissionSource ,PlacesAndProcesses.Amount,PlacesAndProcesses.TonCO2 FROM ConversionFactors JOIN PlacesAndProcesses ON ConversionFactors.EmissionSource = PlacesAndProcesses.EmissionSource WHERE Id = ?" )) {
                $LokalSql->bind_param("i", $rapport_id);
                $LokalSql->execute();
                $LokalResult = $LokalSql->get_result();

            }

            if ($OtherLokalSql = mysqli_prepare($dbc, "SELECT PlacesOwned,PlacesRentedOut,ProducedSolarElectricity,ProducedSolarHeat,Comment FROM OtherPlacesAndProcesses, Report where OtherPlacesAndProcesses.Id = Report.Id AND Report.Id = ? AND Report.user = ?")) {
                $OtherLokalSql->bind_param("ss", $rapport_id,$login_session);
                $OtherLokalSql->execute();
                $OtherPlacesRes = $OtherLokalSql->get_result();

            }

			// Hämtar alla kolumner från OtherTransport
            if ($OtherTransportSql = mysqli_prepare($dbc, "SELECT BioTransportAmount,EnforcementPurchasePolicyVehicle,EnforcementTravelPolicy,EnvironmentReqOtherTransport,EnvironmentReqOtherTransportDescription,EnvironmentReqPurchased,EnvironmentReqPurchasedDescription,Comment
															FROM OtherTransport, Report where OtherTransport.Id = Report.Id
															AND Report.Id = ?
															AND Report.user = ?")) {
                $OtherTransportSql->bind_param("is", $rapport_id, $login_session);
                $OtherTransportSql->execute();
                $OtherTransportRes = $OtherTransportSql->get_result();

            }

		// Hämtar alla kolumner från Flights
            if ($FlightSql = mysqli_prepare($dbc, "SELECT Departure,Destination,LengthKM,KGCO2 FROM Flights, Report where Flights.Id = Report.Id AND Report.Id = ? AND Report.user = ?")) {
                $FlightSql->bind_param("is", $rapport_id, $login_session);
                $FlightSql->execute();
                $FlightRes = $FlightSql->get_result();
            }

		// Hämtar ut totala kg CO2 utsläpp för flygresor
            if ($OtherFlightSql = mysqli_prepare($dbc, "SELECT TotalAmount FROM OtherFlight, Report where OtherFlight.Id = Report.Id AND Report.id = ? AND Report.user = ? ")) {
                $OtherFlightSql->bind_param("is", $rapport_id, $login_session);
                $OtherFlightSql->execute();
                $OtherFlightRes = $OtherFlightSql->get_result();
	    }

            // ----------- Lokaler och processer ---------------
            $otherplacesrow = $OtherPlacesRes->fetch_assoc();
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
								<input name="placesOwned" type="text" class="inputbox" value = "'.$otherplacesrow['PlacesOwned'].'"/>
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
								<input name="placesRented" type="text" class="inputbox" value = "'.$otherplacesrow['PlacesRentedOut'].'"/>
							</td>
							<td>
								<p style="margin:5px">m<sup>2</sup></p>
							</td>
						</tr>
					</tbody>';
					mysqli_data_seek($OtherPlacesRes , 0);

            echo '<h1>';

            echo '<a name="Lokaler och Processer">

			</a>';
            echo '</h1>';
            echo '<table id = "maintable" name= ' . htmlspecialchars($categoryLokalerProcesser) . ' cellspacing="10">';
            // Skapar rubriker till table
		echo '<th> Utsläppskälla </th>'; 
		echo '<th> Inköpt mängd</th>'; 
		echo '<th> Mått </th>'; 
		echo '<th> Omr. faktor till MWh </th>'; 
		echo '<th> Omr. faktor från MWh till CO<sub>2</sub></th>'; 
		echo '<th> Ton CO<sub>2</sub>e </th>';
            while ($myrow = $Placesemissionsqlresult->fetch_assoc()) {
                if (!empty($myrow)) {
                    // transportcount används för att loopa igenom (i en for sats)  alla fält när man skickar in data till databasen
                    $lokalcount++;
                    // Skapar innehåll i table
                    echo '<tr>';
                    // här börjar man bygga upp raderna i rapporten
                    echo '<td >';
                    echo $myrow['EmissionSource'];
                    echo '</td>';
                    $str = htmlspecialchars($myrow['EmissionSource']);
                    //skapar en hidden input som används av php när man skickar in data (alla hidden inputs används av php för att skicka in data till databasen)
                    echo "<input type=\"hidden\" name=\"emissionSource[]\" value=\"$str\">";
					mysqli_data_seek($LokalResult , 0);
					echo '<td>';


					$cmp = htmlspecialchars($myrow['EmissionSource']); // CMP är stringar man jämför med
					//För varje unit i conversionfactors som tillhör transport
					while($row = $LokalResult->fetch_assoc()){

						if(!empty($row)){
							 //skapar inputen för inköpta mängd, har en funktion oninput som uppdaterar tonCO2 kolumnen , arrayindex är en variabel som ökas varje gång en ny rad skapas i transport och lokaler och processer.
							if($myrow['EmissionSource'] == $row['EmissionSource'] && !$hit){
								echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')"
									oninput ="tonCO2(' . $arrayindex . ')"
									class="inputbox" value="' . $row['Amount'] . '"/>';
								$hit = true;
								$CO2value = $row['TonCO2'];
							}

							$cmp2 =  htmlspecialchars($row['EmissionSource']);
							if( strcmp ($cmp ,$cmp2 ) == 0){
								$cmp3 = htmlspecialchars($myrow['Unit']);
								$cmp4 =  htmlspecialchars($row['Unit']);

								//Om valda unit är samma som standard i conversion factors.
								if(strcmp($cmp3,$cmp4)==0){
									echo '<td>';
									echo '<select name="unit[]" onchange="selectedUnit(' . $arrayindex . ')">';

									echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
									echo '<option value ="Ton"> Ton </option>';
									echo '</select>';
									echo '</td>';
								}else{
									echo '<td>';
									echo '<select name="unit[]" onchange="selectedUnit(' . $arrayindex . ')">';
									echo '<option value ="Ton"> Ton </option>';
									echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
									echo '</select>';
									echo '</td>';
								}
							}
						}
					}
					if(!$hit){
						echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')"
						onchange ="tonCO2(' . $arrayindex . ')"
						class="inputbox" />';
						echo '<td>';
						// Skapar selectboxen för enhet
						echo '<select name="unit[]" onchange="selectedUnit(' . $arrayindex . ')">';
						echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
						echo '<option value ="Ton"> Ton </option>';
						echo '</select>';
						echo '</td>';
					}
					$hit = false;
                    echo '</td>';
                    //skapar omräkningsfaktor

			//Skrivs ut första gången sidan laddas in även om enheten är ton
                    echo '<td >';
                    echo '<p name = "coFactor[]"> ' . $myrow['convFactor'] . '</p>';
                    echo '</td>';
                    echo '<input type="hidden" name="convFactor[]" value=' . $myrow['convFactor'] . '>';

                    //skapar utsläpp i mwh 
			echo '<td class="colCenter">'; 
			echo '<p name="coFactorMWh[]"> ' . $myrow['EmissionCO2perMWh'] . '</p>'; 
			echo '</td>'; 
			echo '<input type="hidden" name="emissionCO2[]" value=' . $myrow['EmissionCO2perMWh'] . '>'; 
			//skapar kolumnen för tonCO2 denna uppdateras av tonCO2 funktionen som triggas av amount fältet.
					echo '<td name="tonCO[]">';
                    echo $CO2value;
                    echo '</td>';
                    echo '<input type="hidden" name="ton[]" value='. $CO2value . '>';
                    echo '</tr>';
		echo '<input type="hidden" name = "nbrofRowslokal" id="nbrofRowslokal" value="'.$lokalcount. '" >';
                    $arrayindex++;
					$CO2value = 0;
				}
            }
			echo '</table>';
			   echo'<table id= "otherTable">';
            echo '<thead>
				<th>Produktion av förnybar energi</th>
		  </thead>
		<tbody>';
            echo '<tr>
			<td>
				Produktion av solvärme
			</td>';
            echo '<td> <input class="inputbox" name="producedSolarHeat" type="text" value = "'.$otherplacesrow['ProducedSolarHeat'].'"> </td>';
            echo '<td>
			<p style="margin:5px">MWh</p>
		 </td>';
            echo '</tr>';
            echo '<tr>
			<td>
				Produktion av solel
			</td>';
            echo '<td> <input class="inputbox" name="producedSolarElectrity" type="text" value = "'.$otherplacesrow['ProducedSolarElectricity'].'"> </td>';
            echo '<td>
			<p style="margin:5px">MWh</p>
		 </td>';
            echo '</tr>
		</tbody>';
            echo '</table>';

	// -------------- Transport ------------
            echo '<h1>';
            echo '<a name="Transport">
				Transport
			</a>';
            echo '</h1>';
            echo '<table id = "maintable" name= ' . htmlspecialchars($categoryTransport) . ' cellspacing="10">';
           	
		// Skapar rubriker till table
		echo '<th> Utsläppskälla </th>'; 
		echo '<th> Inköpt mängd</th>'; 
		echo '<th> Mått </th>'; 
		echo '<th> Omr. faktor till MWh </th>'; 
		echo '<th> Omr. faktor från MWh till CO<sub>2</sub></th>'; 
		echo '<th> Ton CO<sub>2</sub>e </th>';
		
		
        
            while ($myrow = $emissionsqlresult->fetch_assoc()) {
                if (!empty($myrow)) {
                    // transportcount används för att loopa igenom (i en for sats)  alla fält när man skickar in data till databasen
                    $transportcount++;
                    // Skapar innehåll i table
                    echo '<tr>';
                    // här börjar man bygga upp raderna i rapporten
                    echo '<td >';
                    echo $myrow['EmissionSource'];
                    echo '</td>';
                    $str = htmlspecialchars($myrow['EmissionSource']);
                    //skapar en hidden input som används av php när man skickar in data (alla hidden inputs används av php för att skicka in data till databasen)
                    echo "<input type=\"hidden\" name=\"emissionSource[]\" value=\"$str\">";

					echo '<td>';
					mysqli_data_seek($Transportsqlresult , 0);

					$cmp = htmlspecialchars($myrow['EmissionSource']); // CMP är stringar man jämför med
					//För varje unit i conversionfactors som tillhör transport
					while($row = $Transportsqlresult->fetch_assoc()){

						if(!empty($row)){
							 //skapar inputen för inköpta mängd, har en funktion oninput som uppdaterar tonCO2 kolumnen , arrayindex är en variabel som ökas varje gång en ny rad skapas i transport och lokaler och processer.
							if($myrow['EmissionSource'] == $row['EmissionSource'] && !$hit){
								echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')"
									oninput ="tonCO2(' . $arrayindex . ')"
									class="inputbox" value="' . $row['Amount'] . '"/>';
								$hit = true;
								$CO2value = $row['TonCO2'];
							}

							$cmp2 =  htmlspecialchars($row['EmissionSource']);
							if( strcmp ($cmp ,$cmp2 ) == 0){
								$cmp3 = htmlspecialchars($myrow['Unit']);
								$cmp4 =  htmlspecialchars($row['Unit']);

								//Om valda unit är samma som standard i conversion factors.
								if(strcmp($cmp3,$cmp4)==0){
									echo '<td>';
									echo '<select name="unit[]" onchange="selectedUnit(' . $arrayindex . ')">';

									echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
									echo '<option value ="Ton"> Ton </option>';
									echo '</select>';
									echo '</td>';

								}else{
									echo '<td>';
									echo '<select name="unit[]" onchange="selectedUnit(' . $arrayindex . ')">';
									echo '<option value ="Ton"> Ton </option>';
									echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
									echo '</select>';
									echo '</td>';
								}
							}
						}
					}
					if(!$hit){
						echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')"
						onchange ="tonCO2(' . $arrayindex . ')"
						class="inputbox" />';
						echo '<td>';
						// Skapar selectboxen för enhet
						echo '<select name="unit[]" onchange="selectedUnit(' . $arrayindex . ')">';
						echo '<option value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .  '</option>';
						echo '<option value ="Ton"> Ton </option>';
						echo '</select>';
						echo '</td>';
					}
					$hit = false;
                    echo '</td>';
                    //skapar omräkningsfaktor

			//Skrivs ut första gången sidan laddas in även om enheten är ton
                    echo '<td >';
                    echo '<p name = "coFactor[]"> ' . $myrow['convFactor'] . '</p>';
                    echo '</td>';
                    echo '<input type="hidden" name="convFactor[]" value=' . $myrow['convFactor'] . '>';

                     //skapar utsläpp i mwh 
			echo '<td class="colCenter">'; 
			echo '<p name="coFactorMWh[]"> ' . $myrow['EmissionCO2perMWh'] . '</p>'; 
			echo '</td>'; 
			echo '<input type="hidden" name="emissionCO2[]" value=' . $myrow['EmissionCO2perMWh'] . '>'; 
			
					echo '<td name="tonCO[]">';
                    echo $CO2value;
                    echo '</td>';
                    echo '<input type="hidden" name="ton[]" value='. $CO2value . '>';
                    echo '</tr>';
			echo '<input type="hidden" name = "nbrofRowsTransport" id="nbrofRowsTransport" value="'.$transportcount. '">';
					$arrayindex++;
					$CO2value = 0;
				}

            }

            echo '</table>';
            echo'<div id="m_krav">
				<h3>Ställs miljökrav vid inköp av fordon</h3>';
				while($myrow = $OtherTransportRes->fetch_assoc()){
				if(!empty($myrow)){
					//Skapar Ja/Nej knapparna under rubriken "Ställs miljökrav vid inköp av fordon"
					if($myrow['EnvironmentReqPurchased']){
						echo '<p>
							<input class="radiobutton" type="radio" name="YesOrNo" onclick="showElemC1()" value="1" checked /> Ja';
						echo '<input class="radiobutton" type="radio" name="YesOrNo" onclick="hideElemC1()" value="0" style="margin-bottom: 20px"/> Nej
							</p>
						<textarea class="comments" rows="4" cols="50" name="comment1" id="comment1" form="form" placeholder="Beskriv krav..." >'. $myrow['EnvironmentReqPurchasedDescription'] . '</textarea></td>
						</div>';
					}else{
						echo '<p>
						<input class="radiobutton" type="radio" name="YesOrNo" onclick="showElemC1()" value="1"/> Ja';
						echo '<input class="radiobutton" type="radio" name="YesOrNo" onclick="hideElemC1()" value="0" checked> Nej
						</p>
						<textarea class="comments" rows="4" cols="50" name="comment1" id="comment1" form="form" style="display: none" placeholder="Beskriv krav..."></textarea></td>
						</div>';
					}
					//Skapar textboxen och fyller i den, under rubriken "Biodrivmedel i köpta transsporttjänster"
					if($myrow['BioTransportAmount']){
						echo '<div id="bio_krav">
									<h3> Biodrivmedel i köpta transporttjänster </h3>
						<p>Andel %
							<input name="bioTranspAmount" type="text" class="inputbox" value="' . $myrow['BioTransportAmount'] . '"/></p>
						</div>';
					}else{
						echo'<div id="bio_krav">
									<h3> Biodrivmedel i köpta transporttjänster </h3>
								<p> Andel %
									<input name="bioTranspAmount" type="text" class="inputbox"/>
								</p>
							</div>';
					}
					//Skapar Ja/Nej knapparna och textfältet under rubriken "Andra miljökrav på transporttjänster"
					if($myrow['EnvironmentReqOtherTransport']){
						echo '<div id="etc_krav">
							<h3>
								Andra miljökrav på transporttjänster (t.ex. sparsamkörning eller energieffektivitet)?
							</h3>
							<p>
								<input class="radiobutton" type="radio" name="YesOrNo3" onclick="showElemC2()" value="1" checked/> Ja
								<input class="radiobutton" type="radio" name="YesOrNo3" value="0" onclick="hideElemC2()" style="margin-bottom: 20px"> Nej
							</p>
								<textarea class="comments" rows="4" cols="50" name="comment2" id="comment2" form="form" style="margin-bottom:20px" >'.$myrow['EnvironmentReqOtherTransportDescription'].'</textarea>
							</div>';
					}else{
						echo '<div id="etc_krav">
							<h3>
								Andra miljökrav på transporttjänster (t.ex. sparsamkörning eller energieffektivitet)?
							</h3>
							<p>
								<input class="radiobutton" type="radio" name="YesOrNo3" onclick="showElemC2()" value="1"> Ja
								<input class="radiobutton" type="radio" name="YesOrNo3" value="0" onclick="hideElemC2()" style="margin-bottom: 20px" checked> Nej
							</p>
							<textarea class="comments" rows="4" cols="50" name="comment2" id="comment2" form="form" style="display: none" style="margin-bottom:20px" placeholder="Beskriv krav..."></textarea>
						</div>';
					}
					//Skapar Ja/Nej knapparna under rubriken "Inköps- och resepolicy"
					if($myrow['EnforcementPurchasePolicyVehicle']){
						echo '<div id="inkops_rese">
							<h3>
								Inköps- och resepolicy
							</h3>
							<p>
								Tillämpas inköpspolicyn för fordon
							</p>
							<p>
								<input class="radiobutton" type="radio" name="YesOrNo4" value="1" checked> Ja
								<input class="radiobutton" type="radio" name="YesOrNo4" value="0" style="margin-bottom: 20px"> Nej
							</p>';
					}else{
						echo '<div id="inkops_rese">
							<h3>
								Inköps- och resepolicy
							</h3>
							<p>
								Tillämpas inköpspolicyn för fordon
							</p>
							<p>
								<input class="radiobutton" type="radio" name="YesOrNo4" value="1"> Ja
								<input class="radiobutton" type="radio" name="YesOrNo4" value="0" style="margin-bottom: 20px" checked> Nej
							</p>';
					}
					//Skapar Ja/Nej knapparna under rubriken "Tillämpas resepolicy"
					if($myrow['EnforcementTravelPolicy']){
						echo'<p>
								Tillämpas resepolicy
							</p>
							<p>
								<input class="radiobutton" type="radio" name="YesOrNo5" value="1" checked> Ja
								<input class="radiobutton" type="radio" name="YesOrNo5" value="0" style="margin-bottom: 20px"> Nej
							</p>
						</div>';
					}else{
						echo'<p>
								Tillämpas resepolicy
							</p>
							<p>
								<input class="radiobutton" type="radio" name="YesOrNo5" value="1"> Ja
								<input class="radiobutton" type="radio" name="YesOrNo5" value="0" style="margin-bottom: 20px" checked> Nej
							</p>
						</div>';
					}
				}
            }

            // ---------- Flygresor ----------
            $flygresorcount = 1;
            echo '<h1>
					<a name="flygresor">
						Flygresor
					</a>
				</h1>
				<p>
					Använd <a href="http://www.atmosfair.de" target="blank" style="color: blue">länken</a> för att beräkna flygutsläppen (öppnas i nytt fönster). Fyll sedan i tabellen nedan. Har du redan en total mängd kan du fylla i totala flygutsläppet direkt.
				</p>
				<table>
					<thead>';
			if(!$myrow = $OtherFlightRes->fetch_assoc()){
				echo'	<tr>
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
					</tbody>';
			}
			mysqli_data_seek($OtherFlightRes,0);
			while($myrow = $OtherFlightRes->fetch_assoc()){
				if($myrow['TotalAmount']){
					echo'	<tr>
							<th>Totala flygutsläpp</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input name="totalFlightKGCO2" type="text" class="inputbox" value="' . $myrow['TotalAmount'] . '"/>
							</td>
							<td>
								<p style="margin-left: 2em;"> kg CO<sub>2</sub></p>
							</td>
						</tr>
					</tbody>';
				}else{
					echo'	<tr>
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
					</tbody>';

				}
			}
			echo'</table>';

			echo '<table id="reportTable">
					<thead>
					<tr>
						<th>Från</th>
						<th>Till</th>
						<th>Längd km</th>
						<th>kg C02</th>
					</tr>
					</thead>
					<tbody>';
			if(!$FlightResRow = $FlightRes->fetch_assoc()){
				echo' <tr>
							<td><input name="Departure[]"type="text" class="inputbox"/></td>
							<td><input name="Destination[]" class="inputbox"/></td>
							<td><input name="lengthKM[]" class="inputbox"/></td>
							<td><input name="kgCO2[]" class="inputbox"/></td>
						</tr>';
			}
			$nbrFlights = 0;
			mysqli_data_seek($FlightRes, 0);
			while($FlightResRow = $FlightRes->fetch_assoc()){
				if(!empty($FlightResRow)){
					if($FlightResRow['Departure']){
						echo' <tr>
								<td><input name="Departure[]" type="text" class="inputbox" value="'.$FlightResRow['Departure'].'"/> </td>
								<td><input name="Destination[]" class="inputbox" value="'.$FlightResRow['Destination'].'" /></td>
								<td><input name="lengthKM[]" class="inputbox" value="'.$FlightResRow['LengthKM'].'" /></td>
								<td><input name="kgCO2[]" class="inputbox" value="'.$FlightResRow['KGCO2'].'" /></td>
								<td><input type="button" value="X" id="close-button"></td>
							</tr>';
							$nbrFlights++;
					}else{
						echo' <tr>
							<td><input name="Departure[]"type="text" class="inputbox"/></td>
							<td><input name="Destination[]" class="inputbox"/></td>
							<td><input name="lengthKM[]" class="inputbox"/></td>
							<td><input name="kgCO2[]" class="inputbox"/></td>
						</tr>';
					}
				}else{
					echo'<tr>
							<td><input name="Departure[]"type="text" class="inputbox"/></td>
							<td><input name="Destination[]" class="inputbox"/></td>
							<td><input name="lengthKM[]" class="inputbox"/></td>
							<td><input name="kgCO2[]" class="inputbox"/></td>
						</tr>';
				}
			}
				echo' </tbody>
				</table>
				<input type="hidden" name = "nbrofRowsFlight" id="nbrofRowsFlight" value="'.$nbrFlights.'" >
				<input type = "button" id="addrow" value = "Ny resa"/>
				<div id="flygresor_comments">
					<h3>Övriga kommentarer</h3>
					<textarea name="OtherComment" class="comments" rows="8" cols="50">';
					echo $Comment;
					echo '</textarea>
					<br>
					<input type = "button" name="Spara2"  class = "menubutton flatbutton savebutton modalSave" value ="Spara"/>
					<input type = "button" class = "menubutton flatbutton rensa" value ="Rensa"/>
				</div>
				</form>
			</div>
		</div>';

            ?>
            </table>
            <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
            <script type="text/javascript" src="../js/rapport-script.js"></script>
			<script type="text/javascript" src="../js/rapport-script2.js"></script>
           <!--// <script type="text/javascript" src="../js/proto-script.js"></script>-->
</body>
</html>
