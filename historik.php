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
					
					<form action="#" method="post" name="histDrop">
					
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
   $selectedYear = isset($_POST['yeardrop']) ? $_POST['yeardrop'] : false;
   
   if ($stmt = mysqli_prepare($dbc, "SELECT EmissionSource,Unit,TonCO2,convFactor,EmissionMwh FROM PlacesAndProcesses, Report where PlacesAndProcesses.Id = Report.Id AND YEAR(Report.Date) =?")) {
   $stmt->bind_param("s", $selectedYear);

    /* execute query */
    $stmt->execute();

    /* instead of bind_result: */
    $result = $stmt->get_result();

    /* now you can fetch the results into an array - NICE */
	
   }else{
	   
   }
  
	
	
	
	
	
	
   
   
   
   
   
   


   
   
   
   
   
  
	
		
		
		?>
		


		
		
	
	
	}
	
	
	</script>
	
	
	
	 
	
	
	<?php
	while ($myrow = $result->fetch_assoc()) {
		if(!empty($myrow)){
			echo '<table>';
	echo '<tr>';
	echo '<th> Utsläppskälla </th>';
	echo '<th> Enhet </th>';
	echo '<th> TonCO2 </th>';
	echo '<th> Omräkningsfaktor </th>';
	echo '<th> Utsläpp i Mwh </th>';
	echo '</tr>';
			
		
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
       

    echo '</table>';}
		
	}
	
	 
	
	
	
	
	
	?>
	
	
	
	
	
			
			
		
		
	
	
	
	
	
	


		


	</body>
</html>
