<?php
ob_start();
include('admin_redigera.php');
if(!empty($_POST)){
  $name = mysqli_real_escape_string($dbc, $_POST['modalInputEmissionSource']);
  $unit = mysqli_real_escape_string($dbc, $_POST['editFieldOptionBox']);
  $factor = mysqli_real_escape_string($dbc, $_POST['modalInputChangeFactor']);
  $CO2perMWh = mysqli_real_escape_string($dbc, $_POST['modalInputChangeCO2perMWh']);
  $Category = mysqli_real_escape_string($dbc, $_POST['editFieldOptionBoxCategory']);

  if ($changeEmissionSourceSQL = mysqli_prepare($dbc, "UPDATE ConversionFactors SET Unit=?, ConvFactor=?, EmissionCO2perMWh=?, DateChanged=Default, Category=? WHERE EmissionSource=?")) {
    $changeEmissionSourceSQL->bind_param("sddss", $unit, $factor, $CO2perMWh, $Category, $name);
    $changeEmissionSourceSQL->execute();
            $changeEmissionSourceResult = $changeEmissionSourceSQL->get_result();
            $changeEmissionSourceSQL->close();
  }
  header('Location: admin_redigera.php');
}
?>
