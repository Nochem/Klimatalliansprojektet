<?php
// Skapar en anslutning till databasen
require_once('mysqli_connect.php');

// Queryn som skickas till databasen
$query = "SELECT YEAR(birth_date) FROM student";

// Svar från databasen genom att skicka anslutningen och queryn
$response = @mysqli_query($dbc, $query);

// Om queryn fick ett korrekt svar, fortsätt
if($response){
echo '<select id="yeardrop">';
	
// mysqli_fetch_array returnerar en rad av data från queryn och fortsätter tills ingen mer data är tillgänglig
while($row = mysqli_fetch_array($response)){
echo '<option>'. 
	$row['YEAR(birth_date)']  . 
	'</option>';
}

echo '</select>';
} else {

echo "Förfrågan till databasen misslyckades <br/>";

echo mysqli_error($dbc);
}
// Stänger anslutningen till databasen
mysqli_close($dbc);
?>