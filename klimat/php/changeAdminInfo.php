<?php
  ob_start();
  include('anvandare.php');
  if(!empty($_POST)){
    $newRealName = mysqli_real_escape_string($dbc, $_POST['realName']);
    $newEmail = mysqli_real_escape_string($dbc, $_POST['email']);
    $newTelephone = mysqli_real_escape_string($dbc, $_POST['telefon']);

    if($newRealName == ''){
      $newRealName = $login_session;
    }

    $changeUserMySQL = "UPDATE Users SET realName='$newRealName', Email='$newEmail', Telephone='$newTelephone' WHERE Name='$login_session'";
    mysqli_query($dbc, $changeUserMySQL);
    header('Location: mina_sidor_admin.php');
  }
?>
