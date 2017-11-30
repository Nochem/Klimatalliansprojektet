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

$category = NULL;

$transport = array();
$placesAndProcesses = array();

// While rader finns i frågan
	while($row = mysqli_fetch_assoc($response)){
		$category = $row['Category'];
		
		
					echo '<form name="rapport2" method="post" id="rapport2">';
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
			echo '<th> Energi i MWh </th>';
			echo '<th> Utsläpp CO<sub>2</sub> per MWh </th>';
			echo '<th> Ton CO2 </th>';
			
		while ($myrow = $emissionsqlresult->fetch_assoc()) {
			if(!empty($myrow)){
				//Lägger till alla utsläppskällor i en array beroende på vilken kategori den tillhör
				if($category == "Transport"){
					$transport[] = $myrow['EmissionSource'];
				}else if($category == "Lokaler och Processer"){
					$placesAndProcesses[] = $myrow['EmissionSource'];
				}

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
				echo '<td>' .$myrow['EmissionCO2perMWh']. '</td>';
				echo '</tr>';
											
			}
		}
		echo '</table>';
	}
	echo '</form>';
		
	
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
			foreach($transport as $value){
				echo 'T ';
				$query = mysqli_prepare($dbc, 
				"REPLACE INTO enVarTest(utslapp, tonCo2) VALUES (?,?)");
				
				$query->bind_param("ss", $value, $var);
				$var = $_POST[$value];
				$query->execute();
			}
			
			foreach($placesAndProcesses as $value){
				echo 'L o P ';
				$query = mysqli_prepare($dbc, 
				"REPLACE INTO enVarTest2(utslapp, tonCo2) VALUES (?,?)");
				
				$query->bind_param("ss", $value, $var);
				$var = $_POST[$value];
				$query->execute();
			}
		}
	
?>
</table>
</body>
</html>