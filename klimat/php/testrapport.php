<html>
<head>
<title>
testrapport
</title>
<meta charset="UTF-8">
</head>
<body>
<table>
<th> Utsläppskälla </th>
<?php 
require_once('mysqli_connect.php');
$query = "SELECT EmissionSource from ConversionFactors";
$response = @mysqli_query($dbc, $query);

	while($row = mysqli_fetch_array($response)){
			echo '<tr>';
			echo '<td>' .$row['EmissionSource']. '</td>';
			echo '<td>';
			echo '<input type="text" name='.$row['EmissionSource'].'/>';
			echo '</td>';
			echo '</tr>';	
	}
?>

</table>
</body>
</html>