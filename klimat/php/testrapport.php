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
		
		
		
		
		 if ($emissionsql = mysqli_prepare($dbc,"SELECT EmissionSource from ConversionFactors where Category = ?")) {
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
		echo '<br>';
		echo '<table>';
		while ($myrow = $emissionsqlresult->fetch_assoc()) {
			if(!empty($myrow)){
			echo '<tr>';
			echo '<td>' .$myrow['EmissionSource']. '</td>';
			echo '<td>';
			echo '<input type="text" name='.$myrow['EmissionSource'].'>';
			echo '</td>';
			echo '</tr>';	
				
			}
			
		}
		echo '</table>';
		
		
	}
	
	
	
   
		
		
		
			
	
	
	       // $query2 = "INSERT INTO Transport(EmissionSource, Id) VALUES (?, 1)";
        // $stmt = mysqli_prepare($dbc, $query);
		// /*	
			// i Integers
			// d Doubles
			// b Blobs
			// s Everything Else  
		// */
	
		// mysqli_stmt_bind_param($stmt, "si" , $text , $bensin);
		
		// $text = "Bensin";
        
		// mysqli_stmt_execute($stmt);
        
        // $affected_rows = mysqli_stmt_affected_rows($stmt);
?>

</table>
</body>
</html>