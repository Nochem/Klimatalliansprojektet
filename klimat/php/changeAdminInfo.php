<?php
  ob_start();
  include('anvandare.php');
  if(!empty($_POST)){
    $newRealName = mysqli_real_escape_string($dbc, $_POST['RealName']);
    $newEmail = mysqli_real_escape_string($dbc, $_POST['email']);
    $newTelephone = mysqli_real_escape_string($dbc, $_POST['telefon']);

    if($newRealName == ''){
      $newRealName = $login_session;
    }

    $changeUserMySQL = "UPDATE Users SET RealName='$newRealName', Email='$newEmail', Telephone='$newTelephone' WHERE Name='$login_session'";
    if(mysqli_query($dbc, $changeUserMySQL)){
      $_SESSION['message']['AdminChanged'] = 'Kontaktinformation ändrad.';
    }
    header('Location: mina_sidor_admin.php');
  }
?>
