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
$enVarArray = array();
$category = NULL;
$catArray = array();

// While rader finns i frågan
	while($row = mysqli_fetch_assoc($response)){
		$category = $row['Category'];
		$catArray[] = $row['Category'];
		
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
			// echo '<th> Energi i MWh </th>';
			echo '<th> Utsläpp CO<sub>2</sub> per MWh </th>';
			// echo '<th> Ton CO2 </th>';
			
			

			
		while ($myrow = $emissionsqlresult->fetch_assoc()) {
			if(!empty($myrow)){
				$enVarArray[] = $myrow['EmissionSource'];
				
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
			
			
			foreach($enVarArray as $utslapp){
				foreach($catArray as $cat){
				if($cat == "Transport"){
					echo 'T ';
					$query = mysqli_prepare($dbc, 
					"REPLACE INTO enVarTest(utslapp, tonCo2) VALUES (?,?)");
					
					$query->bind_param("ss", $utslapp, $var);
				
					$var = $_POST[$utslapp];
			
					$query->execute();
				
				}else if($cat == "Lokaler och Processer"){
					echo 'L o P ';
					
					$query = mysqli_prepare($dbc, 
					"REPLACE INTO enVarTest2(utslapp, tonCo2) VALUES (?,?)");
					
					$query->bind_param("ss", $utslapp, $var);
				
					$var = $_POST[$utslapp];
			
					$query->execute();
					
				}else {
					echo 'H';
				}
				}
			}
			/*												//~~OCH~~ PlacesAndProcesses						  Category = Transport eller Lokaler och Processer
			$query = mysqli_prepare($dbc, 
			"INSERT INTO Transport(EmissionSource, Unit, TonCO2, ConvFactor,EmissionMWh, Id) VALUES (?,?,?,?,?,?)");
			/*
			INSERT INTO Transport(EmissionSource, Unit, TonCO2, ConvFactor, EnergyMWh, EmissionMWh, Id) VALUES ('Tes', 'mwh', 1 , 7.7 , 5.4 , 0.23, 1)
			*/
	/*
					foreach($data as $emissionSource){
						$query->bind_param("ssddddi", $emissionSource, $unit , $tonCO2 ,$ConvFactor,$EnergyMWh ,$EmissionMWh, $Id);
						$unit = "MWh";
						$tonCO2 = 2; // trim($_POST['$myrow['EmissionSource']'];  //Från fältet med namnet EmissionSource från databasen
						$ConvFactor = 7.7;
						$EnergyMWh = 5.4;
						$EmissionMWh = 0.23;
						$Id =  1;
					
						$query->execute();
					}*/
					//$emissionSource = "Tes11t";
					
			/*
			while ($myrow2 = $emissionsqlresult->fetch_assoc()) {
				if(!empty($myrow2)){
					$emissionSource = trim($_POST['$myrow2['EmissionSource']'];
					$unit = trim($_POST['$myrow2['Unit']'];
					$tonCO2 = trim($_POST['$myrow2['TonCO2']'];
					$ConvFactor = trim($_POST['$myrow2['ConvFactor']'];
					$EnergyMWh = trim($_POST['$myrow2['EnergyMWh']'];
					$EmissionMWh = trim($_POST['$myrow2['EmissionMWh']'];
					$Id =  1;
					
					$query->execute();
				}
			}
			*/
	 	}
		//$emissionsql->close();
?>
</table>
</body>
</html>