<?php
  ob_start();
  include('anvandare.php');
  $nbr = mysqli_real_escape_string($dbc, $_POST['userNbrD']);
  $oldName = $_SESSION['name'][$nbr];

  $deleteUserMySQL = "DELETE FROM Users WHERE Name='$oldName'";
  mysqli_query($dbc, $deleteUserMySQL);
  header('Location: anvandare.php');
?>
