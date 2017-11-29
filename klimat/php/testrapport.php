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
		echo  '<form action="#" method="get">';
		echo '<table name= '.htmlspecialchars($category).' cellspacing="10">';
		// Skapar rubriker till table
			echo '<th> Utsläppskälla </th>';
			echo '<th> Inköpt mängd</th>';
			echo '<th> Mått </th>';
			echo '<th> Omräknings Faktor </th>';
			// echo '<th> Energi i MWh </th>';
			echo '<th> Utsläpp CO2 per MWh </th>';
			// echo '<th> Ton CO2 </th>';
		while ($myrow = $emissionsqlresult->fetch_assoc()) {
			if(!empty($myrow)){
				
			
			
			// Skapar innehåll i table
				
			echo '<tr>';
			// Utsläppskälla
			echo '<td>' .$myrow['EmissionSource']. '</td>';
			
			// Mått
			echo '<td>';
			echo '<input type="text" name='.$myrow['EmissionSource'].'  >'; // onChange funktion behövs för att räkna ut enrgi i mwh
			echo '</td>';
			// Enhet
			echo '<td>';
			echo '<select id="unitdrop" >';
			echo '<option 
	value =' .$myrow['Unit'] . '>' .$myrow['Unit'].
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
	
	echo '<h1> Flygresor </h1>';
	
	echo '<table name ="Flygresor" cellspacing ="10">';
		echo '<tr>';
		echo '<th> Från </th>';
		echo '<th> Till </th>';
		echo '<th> Längd i km </th>';
		echo '<th> KG CO2 </th>';
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
		echo '<input type="submit" value = "spara">';
		
		
		echo '</form>';
		
		
		echo '<p>'
		 
		
		
			
			
			
			
			
			
		
		
		
		
		
		
		
		
		
		
		?>

		
	
	
	
   
		
		
		
			
	
	
	    


</table>
</body>
</html>