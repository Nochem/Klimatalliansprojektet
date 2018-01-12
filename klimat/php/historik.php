<?php
include('session.php');
$_SESSION['createdReport'] = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<?php
$sentID = $_SESSION['SentId'];
$selectedYear = $_GET['yeardrop'];
				if($sentID !=null){
					if ($yearSQL = mysqli_prepare($dbc, "SELECT  Year from Report where id = ? and user = ?")) {
                    $yearSQL->bind_param("is",$sentID,$login_session);
                    /* execute query */
                    $yearSQL->execute();
                    /* instead of bind_result: */
                    $yearSQLresult2 = $yearSQL->get_result();
                    /* now you can fetch the results into an array - NICE */
                }
					if(mysqli_num_rows($yearSQLresult2)>0){
					$myrowyear = $yearSQLresult2->fetch_assoc();
					$host  = $_SERVER['HTTP_HOST'];
					$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
					$extra = 'historik.php?yeardrop=';
					$selectedYear = $myrowyear['Year'];
					$_SESSION['SentId'] = null;
					header("Location: http://$host$uri/$extra$selectedYear");
					exit;
					}
					}
					?>
    <meta charset="UTF-8">
    <title>
        Klimatallians - Historik
    </title>
    <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style-proto.css">
    <link rel="stylesheet" type="text/css" href="../css/historik-style.css">
    <link rel="icon" href="../res/icon.png">
</head>
<body>

<div id="wrapper">
    <a href="rapport.php">
    <div id="logo">
	</a>
        <div id="user">
            		<p id="username">
        			Inloggad som: <b><?php echo $login_session; ?></b>
        		</p>
        	</div>
    </div>
    <div id="menu">
        <ul>
            <a href="rapport.php">
                <li class="menuitem" >
                    Rapport
                </li>
            </a>
            <a href="historik.php">
                <li class="menuitem currentpage">
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

            <li style="padding:0em">
                <form id="logout" name="form1" action="logout.php" method="post" onsubmit="return confirm('Är du säker du vill logga ut?')">
    				<input name="submit2" type="submit" id="submit2" value="Logga ut">
    			</form>
            </li>
        </ul>
    </div>
    <div id="sidebar">

    </div>
    <div id="content">

        <div id="stat">
            <h1 name= "Rubrik" align= "Center"> Historik </h1>



            <form action="#" method="get" name="histDrop">

                <?php
                
                if ($yearSQL = mysqli_prepare($dbc, "SELECT Year from Report where User = ? ORDER BY YEAR DESC")) {
                    $yearSQL->bind_param("s", $login_session);
                    /* execute query */
                    $yearSQL->execute();
                    /* instead of bind_result: */
                    $yearSQLresult = $yearSQL->get_result();
                    /* now you can fetch the results into an array - NICE */
                }
                if(mysqli_num_rows($yearSQLresult) > 0){
                    if(isset($yearSQLresult)){
			    echo '<div align="center">';
                        echo '<select id="yeardrop" name="yeardrop" onchange="this.form.submit()">';
                        echo '&nbsp';
                        echo "<option value = '-1'> Välj ett år </option>";
// mysqli_fetch_array returnerar en rad av data från queryn och fortsätter tills ingen mer data är tillgänglig
                        while( $myrow = $yearSQLresult->fetch_assoc()){
				if(strcmp($selectedYear,$myrow['Year']) == 0){
                            echo '<option selected value =' .$myrow['Year'] . '>' .$myrow['Year']. '</option>';
                        }else{
                                echo '<option value =' .$myrow['Year'] . '>' .$myrow['Year']. '</option>';
                            }
			}
                        echo '</select>';
			echo '</div>';
//echo '<input type="submit" name="submit" value="Välj" />';
                    } else {
                    }}else{
					echo '<div align = "center">';
                    echo '<h2> Inga rapporter</h2>';
                    echo 'Företaget har inga rapporter om du vill skapa en ny rapport klicka länken nedan eller Rapport högst upp';
                    echo'<br><br>';
                    echo '<a id = "createRapport"href="rapport.php">Skapa ny rapport</a>';
					echo '</div>';
                }
		   ?>



            </form>





            <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
            <script type="text/javascript" src="../js/proto-script.js"></script>
            <script type="text/javascript" src="../js/historik-script.js"></script>





            <?php
            if (isset($_GET['yeardrop'])){
				if($selectedYear != -1){
					$_SESSION['Id'] = null;
				}
                $selectedYear = $_GET['yeardrop'];
                if($selectedYear != -1){
                    if ($ReportSql = mysqli_prepare($dbc, "SELECT Id,NameofReport,NameOfUser,DATE(ChangeDate) as ChangeDate ,finished,Comment from Report where Year = ? and User = ?")) {
                        $ReportSql ->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $ReportSql ->execute();
                        /* instead of bind_result: */
                        $ReportSqlres= $ReportSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
                    if ($LokalSql = mysqli_prepare($dbc, "SELECT EmissionSource,Amount,Unit,convFactor,Round(TonCO2/EmissionMwh,2),EmissionMwh,TonCO2 FROM PlacesAndProcesses, Report where PlacesAndProcesses.Id = Report.Id AND YEAR(Report.Year) =? AND Report.user = ?")) {
                        $LokalSql->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $LokalSql->execute();
                        /* instead of bind_result: */
                        $PlacesRes = $LokalSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
					 if ($LokalSqlSum = mysqli_prepare($dbc, "SELECT ROUND(IFNULL(sum(TonCO2),0),2) as tonSum FROM PlacesAndProcesses, Report where PlacesAndProcesses.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ? ")) {
                        $LokalSqlSum->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $LokalSqlSum->execute();
                        /* instead of bind_result: */
                        $PlacesResSum = $LokalSqlSum->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
                    if ($OtherLokalSql = mysqli_prepare($dbc, "SELECT PlacesOwned,PlacesRentedOut,ProducedSolarElectricity,ProducedSolarHeat,Comment FROM OtherPlacesAndProcesses, Report where OtherPlacesAndProcesses.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
                        $OtherLokalSql->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $OtherLokalSql->execute();
                        /* instead of bind_result: */
                        $OtherPlacesRes = $OtherLokalSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
                    if ($TransportSql = mysqli_prepare($dbc, "SELECT EmissionSource,Amount,Unit,convFactor,Round(TonCO2/EmissionMwh,2),EmissionMwh,TonCO2 FROM Transport, Report where Transport.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
                        $TransportSql->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $TransportSql->execute();
                        /* instead of bind_result: */
                        $TransportRes = $TransportSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
					if ($TransportSqlSum = mysqli_prepare($dbc, "SELECT ifnull(round(sum(TonCO2),2),0) as tonSum FROM Transport,Report where Transport.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ? ")) {
                        $TransportSqlSum->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $TransportSqlSum->execute();
                        /* instead of bind_result: */
                        $TransportResSum = $TransportSqlSum->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
                    if ($OtherTransportSql = mysqli_prepare($dbc, "SELECT BioTransportAmount,EnforcementPurchasePolicyVehicle,EnforcementTravelPolicy,EnvironmentReqOtherTransport,EnvironmentReqOtherTransportDescription,EnvironmentReqPurchased,EnvironmentReqPurchasedDescription,Comment FROM OtherTransport, Report where OtherTransport.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
                        $OtherTransportSql->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $OtherTransportSql->execute();
                        /* instead of bind_result: */
                        $OtherTransportRes = $OtherTransportSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
                    if ($FlightSql = mysqli_prepare($dbc, "SELECT Departure,Destination,LengthKM,KGCO2 FROM Flights, Report where Flights.Id = Report.Id AND YEAR(Report.Year) =? AND Report.user = ?")) {
                        $FlightSql->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $FlightSql->execute();
                        /* instead of bind_result: */
                        $FlightRes = $FlightSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
					 if ($FlightSqlSum = mysqli_prepare($dbc, "SELECT ifnull(round(sum(KGCO2)/1000,2),0) as tonSum FROM Flights, Report where Flights.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
                        $FlightSqlSum->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $FlightSqlSum->execute();
                        /* instead of bind_result: */
                        $FlightResSum = $FlightSqlSum->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
                    if ($OtherFlightSql = mysqli_prepare($dbc, "SELECT ROUND(IFNULL(TotalAmount,0),2) as TotalAmount FROM OtherFlight, Report where OtherFlight.Id = Report.Id AND YEAR(Report.Year) =? AND Report.user = ?")) {
                        $OtherFlightSql->bind_param("ss", $selectedYear,$login_session);
                        /* execute query */
                        $OtherFlightSql->execute();
                        /* instead of bind_result: */
                        $OtherFlightRes = $OtherFlightSql->get_result();
                        /* now you can fetch the results into an array - NICE */
                    }else{
                    }
					
            }}
            ?>





            <?php
            if(isset($_GET['yeardrop'])){
                if($selectedYear != -1){
                    echo '<form name = "historik" method = "get" id ="historik" >';
                   echo '<table align = "right">';
                    echo '<td>';
                    echo '<input name="Edit" type = "submit" form ="historik"  value = "Ändra" id = "EditButton" />'; // ändra css
                    echo '</td>';
                    echo '<td>';
		    echo '<form method="post">';
		    echo '<input type="submit" name="Delete" form = "historik" value = "Ta bort" id = "DeleteButton" onclick="return confirm(\'Är du säker på att du vill ta bort rapporten?\')"/>';
		    echo '</form>';
                 // echo '<input name="Delete" type = "submit" form = "historik"  value = "Ta bort" id = "DeleteButton"  />';                    echo '</td>';
                    echo '</table>';
					echo '<br><br>';
					echo '<h1>  Rapport för år '.$selectedYear.' </h1>';
                    if(!mysqli_num_rows($ReportSqlres) == 0){
                        while ($myrow = $ReportSqlres->fetch_assoc()){
                            $_SESSION["Id"] = $myrow['Id'];
                            echo '<table name="info">';
                            echo '<tr><th align = "left">Namn på rapport:</th>';
                            echo '<td>';
                            echo $myrow['NameofReport'];
                            echo '</td></tr>';
                            echo '<tr><th align = "left">Rapporterad av:</th>';
                            echo '<td>' ;
                            echo $myrow['NameOfUser'];
                            echo '</td></tr>';
                            echo '<tr><th align = "left">Senast ändrad:</th>';
                            echo '<td>';
                            echo $myrow['ChangeDate'];
                            echo '</td></tr>';
                            echo '<tr><th align = "left">Status:</th>';
                            echo '<td>' ;
                             echo $myrow['finished'] ? "Klar " : "Ej Klar ";
                            echo $myrow['finished'] ? "<img class='klar' src=\"../res/klar.png\" >" : "<img class='ejklar' src=\"../res/inte_klar.png\" >";
                            echo '</td></tr>';
                            echo '</table>';
							echo '<br>';
							//SUM TABLE
							$totalSum = 0;
							$flightsum = 0;
							
							while($sumrow = $OtherFlightRes->fetch_assoc()){
								$totalamountflight = $sumrow['TotalAmount'];
								
								
								if($totalamountflight >0){
									$flightsum = $totalamountflight;
									$flightsum = $flightsum/1000;
									$totalSum += $flightsum;
								}else{
									
									while($sumrow = $FlightResSum->fetch_assoc()){
									$flightsum +=  $sumrow['tonSum'];
									$totalSum += $sumrow['tonSum'];
									}
									
								}
								
							}
							 mysqli_data_seek($OtherFlightRes, 0);
							 mysqli_data_seek($FlightResSum, 0);
					
					echo '<table id = "Sum">';
					echo'<tr>';
					echo '<th id = "sumTH"> Summa av utsläpp </th>';
					echo '<th id = "sumTH"> Ton CO<sub>2</sub>e </th>';
					echo'</tr>';
					echo'<tr>';
					echo '<th> Lokaler och Proccesser: </th>';
					while($sumrow = $PlacesResSum->fetch_assoc()){
					echo '<td>' .$sumrow['tonSum'].'</td>';
					$totalSum += $sumrow['tonSum'];
					}
					echo'</tr>';
					
					echo'<tr>';
					echo '<th> Transport: </th>';
					while($sumrow = $TransportResSum->fetch_assoc()){
					echo '<td>' .$sumrow['tonSum'].'</td>';
					$totalSum += $sumrow['tonSum'];
					
					}
					echo'</tr>';
					
					echo'<tr>';
					echo '<th> Flyg: </th>';
					
					echo '<td> '.$flightsum.' </td>';
					
					
					
					echo'</tr>';
					
					echo'<tr>';
					echo '<th> Totalt: </th>';
					
					echo '<td> '.$totalSum.'</td>';
					
					
					echo'</tr>';
					echo '</table>';
					
                            echo'<div name = "Lokaler och Processer">';
                            echo '<h1>  Lokaler och Proccesser </h1>';
                        }
                        mysqli_data_seek($ReportSqlres, 0);
                    }
					
					
					
					
                    if(mysqli_num_rows($PlacesRes)> 0 || mysqli_num_rows($OtherPlacesRes) > 0 ){
                    if($selectedYear != -1 && !mysqli_num_rows($OtherPlacesRes) == 0){
                        echo '<table>';
                        while ($myrow = $OtherPlacesRes->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td> Lokaler som företaget äger:  </td>' ;
                            echo '<td>';
                            echo $myrow['PlacesOwned'];
                            echo '</td>';
                            echo '<td> m2 </td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td> Varav lokaler som hyrs ut  :  </td>' ;
                            echo '<td>';
                            echo $myrow['PlacesRentedOut'];
                            echo '</td>';
                            echo '<td> m2 </td>';
                            echo '</tr>';
                        }
                        mysqli_data_seek($OtherPlacesRes, 0);
                        echo '</table>';
                    }
                    if($selectedYear != -1 && !mysqli_num_rows($PlacesRes) == 0){
                        echo '<table id= "StatTable">';
                        echo '<tr>';
                        echo '<th> Utsläppskälla </th>';
                        echo '<th> Inköpt mängd</th>';
                        echo '<th> Enhet </th>';
                        echo '<th> Omräkningsfaktor </th>';
                        echo '<th> Energi i MWh </th>';
                        echo '<th> Utsläpp i Mwh </th>';
                        echo '<th> TonCO<sub>2</sub>e </th>';
                        echo '</tr>';
                    }else{
                        echo '<br>';
                        echo '<p> Inga utsläppskällor under Lokaler och Processer rapporterade</p>';
			echo '<br>';
                    }
                    while ($myrow = $PlacesRes->fetch_assoc()) {
                        if(!empty($myrow)){
                            echo '<tr>';
                            foreach($myrow as $field) {
                                echo '<td >' . htmlspecialchars($field) . '</td>';
                            }
                            echo '</tr>';
                            // use your $myrow array as you would with any other fetch
                        }
                    }
                    echo '</table>';
                    if($selectedYear != -1 && !mysqli_num_rows($OtherPlacesRes)==0){
                        echo '<table>';
                        while ($myrow = $OtherPlacesRes->fetch_assoc()) {
                            echo '<tr>';
                            echo '<th> Produktion av förnybar energi  </th>' ;
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td> Produktion av solvärme  :  </td>' ;
                            echo '<td>';
                            echo $myrow['ProducedSolarHeat'];
                            echo '</td>';
                            echo '<td> MWh </td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td> Produktion av solel   :  </td>' ;
                            echo '<td>';
                            echo $myrow['ProducedSolarElectricity'];
                            echo '</td>';
                            echo '<td> MWh </td>';
                            echo '</tr>';
                            echo '</table>';
                            /* echo '<h3> Övriga Kommentarer</h3>';
                            if(!empty($myrow['Comment'])){
                                echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
                                echo $myrow['Comment'];
                                echo '</textarea>';
                            }else{
                                echo "Ingen kommentar given";
                            }
                             */
                        }
                    }}else{
                        echo "Inget rapporterat i Lokaler och Processer";
                    }
                    echo '</div>';
                    echo'<div name = "Transport">';
                    echo '<h1> Transport </h1>';
                    if(mysqli_num_rows($TransportRes)> 0 || mysqli_num_rows($OtherTransportRes) > 0 ){
                    if($selectedYear !=-1 && !mysqli_num_rows($TransportRes)==0){
                        echo '<table id= "StatTable">';
                        echo '<tr>';
                        echo '<th> Utsläppskälla </th>';
                        echo '<th> Inköpt Mängd </th>';
                        echo '<th> Enhet </th>';
                        echo '<th> Omräkningsfaktor </th>';
                        echo '<th> Energi i Mwh </th>';
                        echo '<th> Utsläpp CO2 per Mwh </th>';
                        echo '<th> Ton CO<sub>2</sub>e </th>';
                        echo '</tr>';
                    }else{
			
                        echo "Inga utsläppskällor under transport rapporterade";
			
                    }
                    while ($myrow = $TransportRes->fetch_assoc()) {
                        if(!empty($myrow)){
                            echo '<tr>';
                            foreach($myrow as $field) { // borde fixa detta
                                if($field == null){
                                    echo '<td > 0 </td>';
                                }else{
                                    echo '<td >' . htmlspecialchars($field) . '</td>';
                                }
                            }
                            echo '</tr>';
                            // use your $myrow array as you would with any other fetch
                        }
                    }
                    echo '</table>';
                    echo '</div>';
                    echo '<h2>Övrigt Transport</h2>';
                    if(!mysqli_num_rows($OtherTransportRes)==0){
                        while($myrow = $OtherTransportRes->fetch_assoc()){
				
				echo '<table>';
                            echo '<tr><th>  Miljökrav vid inköp av fordon: </th>';
                            echo '<td>';
                            echo $myrow['EnvironmentReqPurchased'] ? "Ja" : "Nej";
                            echo '</td></tr>';
				echo '</table>';
				
                            echo '<table name = "otherTransport">';  
                            if($myrow['EnvironmentReqPurchased']) {
                              //  echo'<tr><th><br></th></tr>'; //kanske inte bästa sättet att göra detta
                                echo '<tr><th> Beskrivning av miljökrav </th><tr>';
				    echo '<tr><td>';
                                if (!empty($myrow['EnvironmentReqPurchasedDescription'])) {
                                    
                                    echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
                                    echo $myrow['EnvironmentReqPurchasedDescription'];
                                    echo '</textarea>';
                                } else {
                                    echo "Ingen beskrivning given";
                                }
                                echo '</td></tr>';
                            }
                            echo '</table>';
				
			echo '<h3>Biodrivmedel i köpta transporttjänster </h3>';
							echo '<table>';
                            echo '<tr><th>Andel i procent: </th>';
                            echo '<td>';
                            echo $myrow['BioTransportAmount'].' '.  '%';
                            echo '</td></tr>';
                            echo '<tr><th> Andra miljökrav på transporttjänster: </th>';
                            echo '<td>';
                            echo $myrow['EnvironmentReqOtherTransport'] ? "Ja" : "Nej";
                            echo '</td>';
				echo '</table>';
				
                          
                            echo '<table name = "otherTransport">';
                            if($myrow['EnvironmentReqOtherTransport']) {
                               // echo'<tr><th><br></th></tr>'; //kanske inte bästa sättet att göra detta
                            echo '<tr><th> Beskrivning av andra miljökrav </th><tr>';
			    echo '<tr><td>';
                            if(!empty($myrow['EnvironmentReqOtherTransportDescription'])){
                                
                                echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
                                echo $myrow['EnvironmentReqOtherTransportDescription'];
                                echo '</textarea>';
                            }else{
                                echo "Ingen beskrivning given";
                            }}
                            echo '</td></tr>';
                            echo '</table>';
                            echo '<h3> Inköps- och resepolicy  </h3>';
                            echo '<table name = "otherTransport">';
                            echo '<tr><th> Tillämpas inköpspolicyn för fordon: </th>';
                            echo '<td>';
                            echo $myrow['EnforcementPurchasePolicyVehicle'] ? "Ja" : "Nej";
                            echo '</td></tr>';
                            echo '<tr><th> Tillämpas resepolicy: </th>';
                            echo '<td>';
                            echo $myrow['EnforcementTravelPolicy'] ? "Ja" : "Nej";
                            echo '</td></tr>';
                            echo '</table>';
                        }
                    }}else{
                        echo "Inget rapporterat i Transport";
                    }
                    echo '<h1> Flygresor </h1>';
                    echo '<table>';
                    $myrow = $OtherFlightRes->fetch_assoc();
                    if(mysqli_num_rows($FlightRes)> 0 || mysqli_num_rows($OtherFlightRes) > 0 ){
                    echo '<tr>';
                    echo '<th> Totala flygutsläpp </th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>';
                    if(!empty($myrow)){
                        echo $myrow['TotalAmount'] .' '.  'kg CO2' ;
                    }else{
                        echo "Inte angivet";
                    }
                    echo'</td>';
                    echo '</tr>';
                    echo '</table>';
                    if($selectedYear != -1 && !mysqli_num_rows($FlightRes)==0){
                        echo '<table id= "StatTable">';
                        echo '<tr>';
                        echo '<th> Från </th>';
                        echo '<th> Till </th>';
                        echo '<th> Längd i KM</th>';
                        echo '<th> Kg CO<sub>2</sub>e </th>';
                        echo '</tr>';
                    }
                    while ($myrow = $FlightRes->fetch_assoc()) {
                        if(!empty($myrow)){
                            echo '<tr>';
                            foreach($myrow as $field) {
                                if(empty($field)){
                                    echo '<td > - </td>';
                                }else{
                                    echo '<td >' . htmlspecialchars($field) . '</td>';
                                }
                            }
                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                    }else{
                        echo "Inga flygresor angivna";
                    }
                    $myrow = $ReportSqlres->fetch_assoc();
                    echo '<h3>Övriga Kommentarer </h3>';
                    if(!empty($myrow['Comment'])){
                        echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
                        echo $myrow['Comment'];
                        echo '</textarea>';
                    }else{
                        echo "Inga kommentarer givna";
                    }
					echo '<br>';
                    echo '</form>';
			echo '<table align = "right">';
                    echo '<td>';
                    echo '<input name="Edit" type = "submit" form ="historik"  value = "Ändra" id = "EditButton" />'; // ändra css
                    echo '</td>';
                    echo '<td>';
		    echo '<form method="post">';
		    echo '<input type="submit" name="Delete" form = "historik" value = "Ta bort" id = "DeleteButton" onclick="return confirm(\'Är du säker på att du vill ta bort rapporten?\')"/>';
		    echo '</form>';
                 // echo '<input name="Delete" type = "submit" form = "historik"  value = "Ta bort" id = "DeleteButton"  />';                    echo '</td>';
                    echo '</table>';
                }
            }
            if (isset($_GET['Delete'])){
                //något som confirmar
                if ($DeleteSql = mysqli_prepare($dbc, "Delete from Report where id = ? and user = ?")) {
                    $id = $_SESSION['Id'];
					$message = $id;
					echo "<script type='text/javascript'>alert('$message');</script>";
                    $DeleteSql ->bind_param("is",$id,$login_session);
                    /* execute query */
                    $DeleteSql ->execute();
                    /* instead of bind_result: */
                    $DeleteSqlres= $DeleteSql->get_result();
                    /* now you can fetch the results into an array - NICE */
					 Header('Location: '.$_SERVER['PHP_SELF']);
					Exit();
                }
            }
            if(isset($_GET['Edit'])){
				header('Location: rapport_redigera.php');
				exit();
			}
            ?>
        </div>
    </div>
</div>



</body>

</html>