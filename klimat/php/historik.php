<?php
   include('session.php');
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
			</div>
			<div id="content">
			<h1 name= "Rubrik" align= "Center"> Historik </h1>
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
   if ($LokalSql = mysqli_prepare($dbc, "SELECT EmissionSource,Round(TonCO2/(EmissionMwh*convFactor),2),Unit,convFactor,Round(TonCO2/EmissionMwh,2),EmissionMwh,TonCO2 FROM PlacesAndProcesses, Report where PlacesAndProcesses.Id = Report.Id AND YEAR(Report.Year) =? AND Report.user = ?")) {
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
   
   if ($TransportSql = mysqli_prepare($dbc, "SELECT EmissionSource,Round(TonCO2/(EmissionMwh*convFactor),2),Unit,convFactor,Round(TonCO2/EmissionMwh,2),EmissionMwh,TonCO2 FROM Transport, Report where Transport.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
   $TransportSql->bind_param("ss", $selectedYear,$login_session);
    /* execute query */
    $TransportSql->execute();
    /* instead of bind_result: */
    $TransportRes = $TransportSql->get_result();
    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
   if ($OtherTransportSql = mysqli_prepare($dbc, "SELECT BioTransport,BioTransportAmount,EnforcementPurchasePolicyVehicle,EnforementTravelPolicy,EnviormentReqOtherTransport,EnviormentReqOtherTransportDescription,EnviormentReqPurchased,EnviormentReqPurchasedDescription,Comment FROM OtherTransport, Report where OtherTransport.Id = Report.Id AND YEAR(Report.Year) = ? AND Report.user = ?")) {
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
	}else{
		
	
		
		
	}
	}
  
?>
	
	
	
	
	
	<?php 
	
	if(isset($_GET['yeardrop'])){
		
		
		
	
	if($selectedYear != -1 && !mysqli_num_rows($PlacesRes) == 0){
		
		echo '<h2>  Lokaler och Proccesser </h2>'; 
		
		echo '<table>';
		echo '<tr>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Mått</th>';
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
	
	
	
		
	
		
			
										
	if($selectedYear != -1 && !mysqli_num_rows($OtherPlacesRes)==0){
	echo '<h3> Övrigt Lokaler och Proccesser </h3>'; 
	echo '<table align= "center">';
	echo '<tr>';
	echo '<th> Lokaler som företaget äger (m2)</th>';
	echo '<th> Lokaler som hyrs ut </th>';
	echo '<th> Produktion av solel </th>';
	echo '<th> Produktion av solvärme </th>';
	echo '<th> Kommentar </th>';
	echo '</tr>';
		
		
	}
	
	while ($myrow = $OtherPlacesRes->fetch_assoc()) {
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
	
	
	if($selectedYear !=-1 && !mysqli_num_rows($TransportRes)==0){
	echo '<h2> Transport </h2>'; 
	echo '<table align= "center">';
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
	if($selectedYear != -1 && !mysqli_num_rows($FlightRes)==0){	
	
	echo '<h2> Flygresor </h2>'; 
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
	}
	?>
	</div>
	</div>
	</div>
	</body>
	
</html>