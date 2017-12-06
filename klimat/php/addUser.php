<?php
  ob_start();
  include('anvandare.php');
  if(isset($_POST)){
    $newName = mysqli_real_escape_string($dbc, $_POST['modalInputNewName']);
    $newPassword = mysqli_real_escape_string($dbc, $_POST['modalInputNewPassword']);
    $newEmail = mysqli_real_escape_string($dbc, $_POST['modalInputNewEmail']);
    $newTelephone = mysqli_real_escape_string($dbc, $_POST['modalInputNewTelephone']);

    if($newName == ''){
      header('Location: anvandare.php');
    } else {
      $addUserMySQL = "INSERT INTO users (Name, Password, Email, Telephone) VALUES ('$newName', '$newPassword', '$newEmail', '$newTelephone')";
      mysqli_query($dbc, $addUserMySQL);
      header('Location: anvandare.php');
    }
  }
?>
