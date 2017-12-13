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
$lokalcount = 0;
$transportcount = 0;
$arrayindex = 0;
// While rader finns i frågan
while ($row = mysqli_fetch_assoc($response)) {
    $category = $row['Category'];
    if ($emissionsql = mysqli_prepare($dbc, "SELECT EmissionSource,Unit,convFactor,EmissionCO2perMWh from ConversionFactors where Category = ?")) {
        $emissionsql->bind_param("s", $category);
        /* execute query */
        $emissionsql->execute();
        /* instead of bind_result: */
        $emissionsqlresult = $emissionsql->get_result();
        /* now you can fetch the results into an array - NICE */
    }
    echo '<h1>';
    echo $category;
    echo '</h1>';
    echo '<form action="#" method="get" name="form">';
    echo '<table name= ' . htmlspecialchars($category) . ' cellspacing="10">';
    // Skapar rubriker till table
    echo '<th> Utsläppskälla </th>';
    echo '<th> Inköpt mängd</th>';
    echo '<th> Mått </th>';
    echo '<th> Omräknings Faktor </th>';
    // echo '<th> Energi i MWh </th>';
    echo '<th> Utsläpp CO2 per MWh </th>';
    echo '<th> Ton CO2 </th>';
    // echo '<th> Ton CO2 </th>';
    while ($myrow = $emissionsqlresult->fetch_assoc()) {
        if (!empty($myrow)) {
            // Skapar innehåll i table
            echo '<tr name="row[]">';
            if ($category == "Lokaler och Processer") {
                $lokalcount++;
            }
            if ($category == "Transport") {
                $transportcount++;
            }
            // Utsläppskälla
            echo '<td >';
            echo $myrow['EmissionSource'];
            echo '</td>';
            echo '<input type="hidden" name="emissionSource[]" value=' . $myrow['EmissionSource'] . '>';
            // Mått name='.$myrow['EmissionSource'].'
            echo '<td>';
            echo '<input type="text" name="amount[]" oninput="tonCO2(' . $arrayindex . ')" onchange ="tonCO2(' . $arrayindex . ')"/>'; // onChange funktion behövs för att räkna ut enrgi i mwh
            echo '</td>';
            // Enhet
            echo '<td>';
            echo '<select name="unit[]">';
            echo '<option
	value =' . $myrow['Unit'] . '>' . $myrow['Unit'] .
                '</option>';
            echo '</select>';
            echo '</td>';
            // Omräkningsfaktor
            echo '<td>' . $myrow['convFactor'] . '</td>';
            echo '<input type="hidden" name="convFactor[]" value=' . $myrow['convFactor'] . '>';
            // echo '<script>';
            // echo energiFunction(){}
            // echo '</script>'
            echo '<td id= >' . $myrow['EmissionCO2perMWh'] . '</td>';
            echo '<input type="hidden" name="emissionCO2[]" value=' . $myrow['EmissionCO2perMWh'] . '>';
            // echo '<script>';
            // echo tonCO2Function(){}
            // echo '</script>'
            echo '<td name=tonCO[]>';
            echo '</td>'; // behövs matte
            echo '<input type="hidden" name="ton[]" value="0">';
            echo '</tr>';
            $arrayindex++;
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
echo '<input type="submit" value = "spara" name ="Spara">';
echo '</form>';
if (isset($_GET['Spara'])) {
    for ($i = 0; $i <= 1; $i++) {
        $emissionSource = $_GET['emissionSource'][$i];
        $amount = $_GET['amount'][$i];
        $unit = $_GET['unit'][$i];
        $convFactor = $_GET['convFactor'][$i];
        $emissionCO2 = $_GET['emissionCO2'][$i];
        $Ton = $_GET['ton'][$i];
        $id = "101";
        /*  echo "<script type='text/javascript'>alert('$emissionSource');</script>";
          echo "<script type='text/javascript'>alert('$unit');</script>";
           echo "<script type='text/javascript'>alert('$convFactor');</script>";
            echo "<script type='text/javascript'>alert('$emissionCO2');</script>";
             echo "<script type='text/javascript'>alert('$Ton');</script>"; */
        if (!empty($amount)) {
            if ($insertTransportsql = mysqli_prepare($dbc, "INSERT INTO Transport (EmissionSource,Unit,ConvFactor,EmissionMwh,TonCO2,Id) values (?,?,?,?,?,?)")) {
                $insertTransportsql->bind_param("ssdddi", $emissionSource, $unit, $convFactor, $emissionCO2, $Ton, $id);
                $insertTransportsql->execute();
                $transportqlresult = $insertTransportsql->get_result();
                $insertTransportsql->close();
            }
        }
    }
}
echo '<form method="get" action="#">';
echo '<input type="submit" name="delete" value="ta bort test data från databas" />';
echo '</form>';
if (isset($_GET['delete'])) {
    $deleteSQL = "DELETE FROM Transport where Id = 101";
    @mysqli_query($dbc, $deleteSQL);
}
?>
</table>
</body>
<script>
    function tonCO2(nbr) {
        var amount = document.getElementsByName("amount[]")[nbr].value;
        var convFac = document.getElementsByName("convFactor[]")[nbr].value;
        var emission = document.getElementsByName("emissionCO2[]")[nbr].value;
        amount = noLetters(amount);
        update(nbr, amount, emission, convFac);
        amount = noPeriodFirst(amount);
        update(nbr, amount, emission, convFac);
        amount = checkTwoDot(amount);
        update(nbr, amount, emission, convFac);


        document.getElementsByName("amount[]")[nbr].value = amount;


    }

    function update(nbr, amount, emission, convFac) {
        var amount1 = amount.replace(',', '.');
        document.getElementsByName("amount[]")[nbr].value = amount;

        var ton = amount1 * emission * convFac;
        if (!isNaN(ton) && ton > 0) {

            document.getElementsByName("tonCO[]")[nbr].innerHTML = round(ton, 2);
        } else {

            document.getElementsByName("tonCO[]")[nbr].innerHTML = "";
        }

    }


    function noLetters(str) {

        str = str.replace(/[^0-9,.]/gi, '');
        return str;

    }

    function noPeriodFirst(str) {


        if (str.charAt(0) == '.') {
            str = setCharAt(str, 0, "");
        }
        if (str.charAt(0) == ',') {
            str = setCharAt(str, 0, "");
        }
        return str;
    }

    function checkTwoDot(str) {


        if (str.match(/[.,]/gi).length > 1) {

            str = setCharAt(str, str.length - 1, '');
            return str;
        }
        return str;
    }

    function setCharAt(str, index, chr) {
        if (index > str.length - 1) return str;
        return str.substr(0, index) + chr + str.substr(index + 1);
    }

    function round(value, decimals) {
        return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
    }

</script>
</html>
