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
					<h1 id="header">
						Inventering av CO<sub>2</sub> utsläpp från transporter
					</h1>
					
					<form action="#" method="get" name="histDrop">
					
<?php
// Skapar en anslutning till databasen
require_once('mysqli_connect.php');

// Queryn som skickas till databasen
$query = "SELECT YEAR(Date) FROM Report";

// Svar från databasen genom att skicka anslutningen och queryn
$response = @mysqli_query($dbc, $query);


// Om queryn fick ett korrekt svar, fortsätt
if($response){

echo '<select id="yeardrop" name="yeardrop" onchange="histDrop.popHist()">';
echo '&nbsp';
echo "<option value = '0'> Välj ett år </option>";
	
// mysqli_fetch_array returnerar en rad av data från queryn och fortsätter tills ingen mer data är tillgänglig
while($row = mysqli_fetch_array($response)){
echo '<option 
	value =' .$row['YEAR(Date)'] . '>' .$row['YEAR(Date)'].
	'</option>';
	 
}

echo '</select>';


} else {

echo "Förfrågan till databasen misslyckades <br/>";

echo mysqli_error($dbc);
}
?>

<input type="submit" name="submit" value="Välj" />

</form>

				
						

					
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
		<script type="text/javascript" src="../js/historik-script.js"></script>
		
		
	<script>
	 function popHist(){
		 
		 
		 
		
		
		
	
    <?php
   $selectedYear = isset($_GET['yeardrop']) ? $_GET['yeardrop'] : false;
   
   if ($LokalSql = mysqli_prepare($dbc, "SELECT EmissionSource,Round(TonCO2/(EmissionMwh*convFactor),2),Unit,Round(TonCO2/EmissionMwh,2),convFactor,EmissionMwh,TonCO2 FROM PlacesAndProcesses, Report where PlacesAndProcesses.Id = Report.Id AND YEAR(Report.Date) =?")) {
   $LokalSql->bind_param("s", $selectedYear);

    /* execute query */
    $LokalSql->execute();

    /* instead of bind_result: */
    $PlacesRes = $LokalSql->get_result();

    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
   
   
   if ($OtherLokalSql = mysqli_prepare($dbc, "SELECT PlacesOwned,PlacesRentedOut,ProducedSolarElectricity,ProducedSolarHeat,Comment FROM OtherPlacesAndProcesses, Report where OtherPlacesAndProcesses.Id = Report.Id AND YEAR(Report.Date) = ?")) {
   $OtherLokalSql->bind_param("s", $selectedYear);

    /* execute query */
    $OtherLokalSql->execute();

    /* instead of bind_result: */
    $OtherPlacesRes = $OtherLokalSql->get_result();

    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
   
   if ($TransportSql = mysqli_prepare($dbc, "SELECT EmissionSource,Round(TonCO2/(EmissionMwh*convFactor),2),Unit,Round(TonCO2/EmissionMwh,2),TonCO2,convFactor,EnergyMwh,EmissionMwh FROM Transport, Report where Transport.Id = Report.Id AND YEAR(Report.Date) = ?")) {
   $TransportSql->bind_param("s", $selectedYear);

    /* execute query */
    $TransportSql->execute();

    /* instead of bind_result: */
    $TransportRes = $TransportSql->get_result();

    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
   if ($OtherTransportSql = mysqli_prepare($dbc, "SELECT BioTransport,BioTransportAmount,EnforcementPurchasePolicyVehicle,EnforementTravelPolicy,EnviormentReqOtherTransport,EnviormentReqOtherTransportDescription,EnviormentReqPurchased,EnviormentReqPurchasedDescription,Comment FROM OtherTransport, Report where OtherTransport.Id = Report.Id AND YEAR(Report.Date) = ?")) {
   $OtherTransportSql->bind_param("s", $selectedYear);

    /* execute query */
    $OtherTransportSql->execute();

    /* instead of bind_result: */
    $OtherTransportRes = $OtherTransportSql->get_result();

    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
   
   if ($FlightSql = mysqli_prepare($dbc, "SELECT Departure,Destination,LengthKM,KGCO2 FROM Flights, Report where Flights.Id = Report.Id AND YEAR(Report.Date) =?")) {
   $FlightSql->bind_param("s", $selectedYear);

    /* execute query */
    $FlightSql->execute();

    /* instead of bind_result: */
    $FlightRes = $FlightSql->get_result();

    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
  
?>
		


		
		
	
	
	}
	
	
	</script>
	
	
	
	 
	
	
	<?php 
	
		
	
	if($selectedYear != 0){
		
		echo '<h2 align= "center">  Lokaler och Proccesser </h2>'; 
		
		echo '<table align= "center">';
		echo '<tr>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Mått </th>';
	echo '<th> Enhet </th>';
	echo '<th> Energi i MWh </th>';
	echo '<th> Omräkningsfaktor </th>';
	echo '<th> Utsläpp i Mwh </th>';
	echo '<th> TonCO22 </th>';
	echo '</tr>';
	}

		
		
	
	
	
	
	while ($myrow = $PlacesRes->fetch_assoc()) {
	
	
	
	if(!empty($myrow)){
			
		
	echo '<tr>';
    foreach($myrow as $field) {
		if(empty($field)){
		echo '<td align="center"> - </td>';
		}else{
        echo '<td align="center">' . htmlspecialchars($field) . '</td>';
		}
		
    }
	echo '</tr>';
    

        // use your $myrow array as you would with any other fetch
       

		}
	}
	echo '</table>';
	echo '<br>';
	
		
	
		
		
	
	if($selectedYear != 0){
	echo '<h3 align= "center"> Övrigt Lokaler och Proccesser </h3>'; 
	echo '<table align= "center">';
	echo '<tr>';
	echo '<th> Lokaler som företaget äger (m2)  </th>';
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
		echo '<td align="center"> - </td>';
		}else{
        echo '<td align="center">' . htmlspecialchars($field) . '</td>';
		}
    }
    echo '</tr>';

        // use your $myrow array as you would with any other fetch
       

    }
		
	}
	echo '</table>';
	echo '<br>';
	
	if($selectedYear != 0){
	echo '<h2 align= "center"> Transport </h2>'; 
	echo '<table align= "center">';
	echo '<tr>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Enhet </th>';
	echo '<th> Energi i MWh </th>';
	echo '<th> TonCO2 </th>';
	echo '<th> Omräkningsfaktor </th>';
	echo '<th> Energi i Mwh </th>';
	echo '<th> Utsläpp i Mwh </th>';
	echo '</tr>';
	}
	
	while ($myrow = $TransportRes->fetch_assoc()) {
		
		if(!empty($myrow)){
	
			
		
		 echo '<tr>';
    foreach($myrow as $field) {
		if(empty($field)){
		echo '<td align="center"> - </td>';
		}else{
        echo '<td align="center">' . htmlspecialchars($field) . '</td>';
		}
    }
    echo '</tr>';

        // use your $myrow array as you would with any other fetch
       

    }
		
	}
	echo '</table>';
	if($selectedYear != 0){	echo '<h2 align= "center"> Flygresor </h2>'; 
			echo '<table align= "center">';
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
		echo '<td align="center"> - </td>';
		}else{
        echo '<td align="center">' . htmlspecialchars($field) . '</td>';
		}
    }
    echo '</tr>';

        // use your $myrow array as you would with any other fetch
       

   }
		
	}
	 echo '</table>';
	 echo '<br>';
	 
	 
	 
	
	 
	
	
	
	
	
	?>
	
	
	
	
	
	
			
			
		
		
	
	
	
	
	
	


		


	</body>
</html>
