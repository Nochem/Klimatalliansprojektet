<?php
   include('session.php');
   session_start();
?>
<!DOCTYPE html>
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

		<div id="user">
			<p id="username">

				User: <?php
				echo $login_session;
					?>

				<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.php">
					<label>
						<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
					</label>
				</form>
			</p>
	</div>
		<div id="wrapper">
			<a href="rapport.html"></a>
			<div id="logo">
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

			</ul>
			</div>
			<div id="sidebar">
			<h1 name= "Rubrik" align= "Center"> Historik </h1>
			</div>
			<div id="content">

				<div id="stat">



					<form action="#" method="get" name="histDrop">

<?php



 if ($yearSQL = mysqli_prepare($dbc, "SELECT Year from Report where User = ?")) {
        $yearSQL->bind_param("s", $login_session);
        /* execute query */
        $yearSQL->execute();
        /* instead of bind_result: */
        $yearSQLresult = $yearSQL->get_result();
        /* now you can fetch the results into an array - NICE */
    }
if(isset($yearSQLresult)){
	
echo '<select id="yeardrop" name="yeardrop" onchange="this.form.submit()">';
echo '&nbsp';
echo "<option value = '-1'> Välj ett år </option>";
// mysqli_fetch_array returnerar en rad av data från queryn och fortsätter tills ingen mer data är tillgänglig
while( $myrow = $yearSQLresult->fetch_assoc()){
	
echo '<option
	value =' .$myrow['Year'] . '>' .$myrow['Year'].
	'</option>';
}
echo '</select>';
//echo '<input type="submit" name="submit" value="Välj" />';
} else {
echo '<h1> Du har inga raporter <h1>';
}
?>



</form>

				<br>



		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
		<script type="text/javascript" src="../js/historik-script.js"></script>





    <?php
		
	
	if (isset($_GET['yeardrop'])){
		
		
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
   if ($OtherTransportSql = mysqli_prepare($dbc, "SELECT BioTransport,BioTransportAmount,EnforcementPurchasePolicyVehicle,EnforcementTravelPolicy,EnvironmentReqOtherTransport,EnvironmentReqOtherTransportDescription,EnvironmentReqPurchased,EnvironmentReqPurchasedDescription,Comment FROM OtherTransport, Report where OtherTransport.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
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
		if ($OtherFlightSql = mysqli_prepare($dbc, "SELECT TotalAmount FROM OtherFlight, Report where OtherFlight.Id = Report.Id AND YEAR(Report.Year) =? AND Report.user = ?")) {
   $OtherFlightSql->bind_param("ss", $selectedYear,$login_session);
    /* execute query */
    $OtherFlightSql->execute();
    /* instead of bind_result: */
    $OtherFlightRes = $OtherFlightSql->get_result();
    /* now you can fetch the results into an array - NICE */
		}else{
		}
	}else{
	}
	}
?>





	<?php

	if(isset($_GET['yeardrop'])){
		
		if($selectedYear != -1){
			echo '<form name = "historik" method = "get" id ="historik" >';
			echo '<h1>  Rapport för år '.$selectedYear.' </h1>';
			echo '<table align = "right">';
	 echo '<td>';
	 echo '<button name="Ändra"  class = "menubutton flatbutton savebutton modalSave"> Ändra </button>'; // ändra css
	 echo '</td>';
	 echo '<td>';
	echo '<input name="Delete" type = "submit" form ="historik"  value = "Ta bort" />';
	 echo '</td>';
	 echo '</table>';
					echo '<br>';
			if(!mysqli_num_rows($ReportSqlres) == 0){
				while ($myrow = $ReportSqlres->fetch_assoc()){
					$_SESSION["Id"] = $myrow['Id'];
					
					//echo '<input type="hidden" name="id" value="'.$myrow['Id'].'">';
				
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
					echo $myrow['finished'] ? "Färdig" : "Ej Färdig";
					echo '</td></tr>';
					echo '</table>';
					echo'<div name = "Lokaler och Processer">';
					echo '<h1>  Lokaler och Proccesser </h1>';
				}
				mysqli_data_seek($ReportSqlres, 0);
			}
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
			echo '<br>';
		}
	if($selectedYear != -1 && !mysqli_num_rows($PlacesRes) == 0){
		echo '<table>';
		echo '<tr>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Inköpt mängd</th>';
	echo '<th> Enhet </th>';
	echo '<th> Omräkningsfaktor </th>';
	echo '<th> Energi i MWh </th>';
	echo '<th> Utsläpp i Mwh </th>';
	echo '<th> TonCO22 </th>';
	echo '</tr>';
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
	echo '<br>';
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
			echo '<br>';
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
		}
		echo '</div>';
			echo'<div name = "Transport">';
	if($selectedYear !=-1 && !mysqli_num_rows($TransportRes)==0){
	echo '<h1> Transport </h1>';
	echo '<table>';
	echo '<tr>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Inköpt Mängd </th>';
	echo '<th> Enhet </th>';
	echo '<th> Omräkningsfaktor </th>';
	echo '<th> Energi i Mwh </th>';
	echo '<th> Utsläpp CO2 per Mwh </th>';
	echo '<th> Ton CO2 </th>';
	echo '</tr>';
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
	echo '<h1>Övrigt Transport</h1>';
	if(!mysqli_num_rows($OtherTransportRes)==0){
		 while($myrow = $OtherTransportRes->fetch_assoc()){
			echo '<h3>Biodrivmedel i köpta transporttjänster </h3>';
			echo '<h4> Krav Ja/Nej </h4>';
			echo $myrow['EnvironmentReqPurchased'] ? "Ja" : "Nej";
			echo '<h4> Om ja beskriv krav: </h4>';
			if(!empty($myrow['EnvironmentReqPurchasedDescription'])){
					echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
					echo $myrow['EnvironmentReqPurchasedDescription'];
					echo '</textarea>';
				}else{
					echo "Ingen beskrivning given";
				}
		echo '<h3>Biodrivmedel i köpta transporttjänster </h3>';
		echo '<table>';
		echo '<tr>';
		echo '<th>';
		echo "Andel i procent:" ;
		echo '</th>';
		echo '</tr>';
		echo '<td>';
		echo $myrow['BioTransportAmount'].' '.  '%';
		echo '</td>';
		echo '</table>';
		echo '<h4> Krav Ja/Nej </h4>';
		echo $myrow['EnvironmentReqOtherTransport'] ? "Ja" : "Nej";
		echo '<h4> Om ja beskriv krav: </h4>';
			if(!empty($myrow['EnvironmentReqOtherTransportDescription'])){
					echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
					echo $myrow['EnvironmentReqOtherTransportDescription'];
					echo '</textarea>';
				}else{
					echo "Ingen beskrivning given";
				}
		echo '<h3> Inköps- och resepolicy  </h3>';
		echo '<h4> Tillämpas inköpspolicyn för fordon  </h4>';
		echo $myrow['EnforcementPurchasePolicyVehicle'] ? "Ja" : "Nej";
		echo '<h4> Tillämpas resepolicy </h4>';
		echo $myrow['EnforcementTravelPolicy'] ? "Ja" : "Nej";
		/* BioTransport,BioTransportAmount,EnforcementPurchasePolicyVehicle,EnforementTravelPolicy,
		EnviormentReqOtherTransport,EnviormentReqOtherTransportDescription,
		EnviormentReqPurchased,EnviormentReqPurchasedDescription,Comment */
		 }
	}
	echo '<br>';
	echo '<h1> Flygresor </h1>';
	$myrow = $OtherFlightRes->fetch_assoc();
	echo '<table>';
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
	echo '<table>';
	echo '<tr>';
	echo '<th> Från </th>';
	echo '<th> Till </th>';
	echo '<th> Längd i KM</th>';
	echo '<th> Kg CO2 </th>';
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
        // use your $myrow array as you would with any other fetch
   }
	}
	 echo '</table>';
	 echo '<br>';
	 $myrow = $ReportSqlres->fetch_assoc();
	 echo '<h3>Övriga Kommentarer </h3>';
	 if(!empty($myrow['Comment'])){
					echo '<textarea style="width: 500px; height: 100px;" class="field left" readonly>';
					echo $myrow['Comment'];
					echo '</textarea>';
				}else{
					echo "Ingen kommentar given";
				}
	 echo '<br>';
	 echo '<br>';
	 echo '<br>';
	 echo '<table align = "right">';
	 echo '<td>';
	 echo '<button name="Ändra"  class = "menubutton flatbutton savebutton modalSave"> Ändra </button>'; // ändra css
	 echo '</td>';
	 echo '<td>';
	 echo '<input name="Delete" type = "submit" form = "historik"  value = "Ta bort" />';
	 echo '</td>';
	 echo '</table>';
	 echo '<br>';
	 echo '<br>';
	 echo '<br>';
		
	echo '</form>';
	 
	
	 
	}
	
	}
		
	 if (isset($_GET['Delete'])){
		  
		if ($DeleteSql = mysqli_prepare($dbc, "Delete from Report where id = ? and user = ?")) {	
		$id = $_SESSION['Id'];
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
	
	
	
		

	 

	
	
	?>
	</div>
	</div>
	</div>



	</body>

</html>