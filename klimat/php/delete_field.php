<?php
  ob_start();
  include('admin_redigera.php');
  $name = mysqli_real_escape_string($dbc, $_POST['modalInputDeleteThis']);
  if ($deleteEmissionSourceSQL = mysqli_prepare($dbc, "DELETE FROM ConversionFactors WHERE EmissionSource=?")) {
    $deleteEmissionSourceSQL->bind_param("s", $name);
    $deleteEmissionSourceSQL->execute();
    $deleteEmissionSourceResult = $deleteEmissionSourceSQL->get_result();
    $deleteEmissionSourceSQL->close();
  }
  header('Location: admin_redigera.php');
?>
