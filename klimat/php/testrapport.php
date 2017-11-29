<html>
<head>
<title>
testrapport
</title>
<meta charset="UTF-8">
</head>
<body>

<?php 
require_once('mysqli_connect.php');
// Hämtar alla unika kategorier
$categorySQL = "SELECT Distinct Category from ConversionFactors";

// Skickar frågan till DB
$response = @mysqli_query($dbc, $categorySQL);
$emissionsqlresult = NULL;

$data = array();

// While rader finns i frågan
	while($row = mysqli_fetch_assoc($response)){
		$category = $row['Category'];
			
		 if ($emissionsql = mysqli_prepare($dbc,"SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
				$emissionsql->bind_param("s", $category);
				/* execute query */
				$emissionsql->execute();
				/* instead of bind_result: */
				$emissionsqlresult = $emissionsql->get_result();
				/* now you can fetch the results into an array - NICE */
		}
			echo '<h1>';
			echo $category ;
			echo '</h1>';
			echo '<table cellspacing="10">';
			// Skapar rubriker till table
			echo '<th> Utsläppskälla </th>';
			echo '<th> Inköpt mängd</th>';
			echo '<th> Mått </th>';
			echo '<th> Omräknings Faktor </th>';
			// echo '<th> Energi i MWh </th>';
			echo '<th> Utsläpp CO<sub>2</sub> per MWh </th>';
			// echo '<th> Ton CO2 </th>';
			
			
			echo '<form name="rapport2" method="post" id="rapport2">';
			
		while ($myrow = $emissionsqlresult->fetch_assoc()) {
			if(!empty($myrow)){
			//Lägger in alla utsläppskällor från databasen i en array 
			$data[] = $myrow['EmissionSource'];
		
			// Skapar innehåll i table
				
				echo '<tr>';
			// Utsläppskälla
				echo '<td>' .$myrow['EmissionSource']. '</td>';
				
			// Mått
				echo '<td>';
				echo '<input type="text" name='.$myrow['EmissionSource'].' >'; // onChange funktion behövs för att räkna ut energi i mwh
				echo '</td>';
			// Enhet
				echo '<td>';
				echo '<select id="unitdrop" >';
				echo '<option value =' .$myrow['Unit'] . '>' .$myrow['Unit'].
				'</option>';
				echo '</select>';
	
				echo '</td>';
			// Omräkningsfaktor 
				echo '<td>' .$myrow['convFactor']. '</td>';
			
			// echo '<script>';
			// echo energiFunction(){} 
			// echo '</script>'
				echo '<td>' .$myrow['EmissionCO2perMWh']. '</td>';
			// echo '<script>';
			// echo tonCO2Function(){} 
			// echo '</script>'
				echo '</tr>';
											
			}
		}
		
		echo '</form>';
		echo '</table>';	
	}
	echo '<h1> Flygresor </h1>';
	
	echo '<table cellspacing ="10">';
		echo '<tr>';
		echo '<th> Från </th>';
		echo '<th> Till </th>';
		echo '<th> Längd i km </th>';
		echo '<th> kg CO<sub>2</sub> </th>';
		echo '</tr>';
		echo '<td>';
			echo '<input type="text" name="Från" >'; 
			echo '</td>';
			echo '<td>';
			echo '<input type="text" name="Till" >'; 
			echo '</td>';
			echo '<td>';
			echo '<input type="text" name="Längd i KM" >'; 
			echo '</td>';
			echo '<td>';
			echo '<input type="text" name="KGCO2" >'; 
			echo '</td>';	
		echo '</table>';
	
		//Spara knappen
		echo '<button name="submit" form="rapport2" onclick = "alert(\'Rapport sparad\')">
			Spara
		</button>'; 
		
		//om spara knappen har blivit klickad på
		if(isset($_POST['submit'])){
			//beroende på vilken kategori , kör en viss queryn
			
			/*
			if($category == "Lokaler och processer"){
				$query = mysqli_prepare($dbc, 
				"INSERT INTO PlacesAndProcesses(EmissionSource, Unit, TonCO2, ConvFactor,  EmissionMWh, Id) VALUES (?,?,?,?,?,?)");
				
				
			}else if($category == "Transport"){
				$query = mysqli_prepare($dbc, 
				"INSERT INTO Transport(EmissionSource, Unit, TonCO2, ConvFactor, EmissionMWh, Id) VALUES (?,?,?,?,?,?)");
				
				
			}else if($category == "Flygresor"){
				$query = mysqli_prepare($dbc, 
				"INSERT INTO Flights(Departure, Destination, LenghtKM , KgCO2, Id) VALUES (?,?,?,?,?)");
				
				
			}
			*/
				$query = mysqli_prepare($dbc, 
				"INSERT INTO Transport(EmissionSource, Unit, TonCO2, ConvFactor, EmissionMWh, Id) VALUES (?,?,?,?,?,?)");
				
					foreach($data as $emissionSource){
						
						$query->bind_param("ssddddi", $emissionSource, $unit , $tonCO2 ,$ConvFactor ,$EmissionMWh, $Id);
						
						$unit = "MWh"; // ska in från användaren
						
						$tonCO2 = 2; //Från användaren						// trim($_POST['$myrow['EmissionSource']'];  
						
						$ConvFactor = 7.7; 
						
						$EmissionMWh = 0.23; 
						
						$Id =  1; //Från sessionen
					
						$query->execute();
					}
	 	}
		//$emissionsql->close();
?>
</table>
</body>
</html>