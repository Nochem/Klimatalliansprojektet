<?php
  ob_start();
  include('admin_redigera.php');
  if(isset($_POST)){
    $name = mysqli_real_escape_string($dbc, $_POST['modalInputNewEmission']);
    $unit = mysqli_real_escape_string($dbc, $_POST['addFieldOptionBox']);
    $factor = mysqli_real_escape_string($dbc, $_POST['modalInputNewConvFac']);
    $CO2perMWh = mysqli_real_escape_string($dbc, $_POST['addModalInputChangeCO2perMWh']);
    $Category = mysqli_real_escape_string($dbc, $_POST['addEditFieldOptionBoxCategory']);
    $info = mysqli_real_escape_string($dbc, $_POST['modalInputAddInfo']);

    if ($addEmissionSource = mysqli_prepare($dbc, "INSERT INTO ConversionFactors (EmissionSource, Unit, ConvFactor , EmissionCO2perMWh, DateChanged, Category, Info) VALUES (?, ?, ?, ?, DEFAULT, ?, ?);")) {
      $addEmissionSource->bind_param("ssddss", $name,$unit,$factor,$CO2perMWh,$Category,$info);
      $addEmissionSource->execute();
      $result = $addEmissionSource->get_result();
      $addEmissionSource->close();
      header('Location: admin_redigera.php');
    }

  }
?>
