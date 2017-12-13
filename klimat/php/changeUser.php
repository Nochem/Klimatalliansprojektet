<?php
  ob_start();
  include('anvandare.php');
  if(!empty($_POST)){
    $nbr = mysqli_real_escape_string($dbc, $_POST['userNbr']);
    $oldName = $_SESSION['name'][$nbr];
    $newName = mysqli_real_escape_string($dbc, $_POST['modalInputChangeName']);
    $newPassword = mysqli_real_escape_string($dbc, $_POST['modalInputChangePassword']);
    $newEmail = mysqli_real_escape_string($dbc, $_POST['modalInputChangeEmail']);
    $newTelephone = mysqli_real_escape_string($dbc, $_POST['modalInputChangeTelephone']);
    $active = mysqli_real_escape_string($dbc, $_POST['modalInputActive']);

    if($newName == ''){
      $newName = $oldName;
    }

    $changeUserMySQL = "UPDATE Users SET Name='$newName', Password='$newPassword', Email='$newEmail', Telephone='$newTelephone', Active='$active' WHERE Name='$oldName'";
    mysqli_query($dbc, $changeUserMySQL);
    header('Location: anvandare.php');
  }
?>
