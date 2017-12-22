<?php
  include('mina_sidor.php');
  if(!empty($_POST)){
    $passwordNew = mysqli_real_escape_string($dbc, $_POST['newPass']);
    $passwordNewC = mysqli_real_escape_string($dbc, $_POST['newPassconfirm']);
    $oldPassword = mysqli_real_escape_string($dbc, $_POST['oldPass']);

    if(empty($passwordNew)){
        $_SESSION['message']['fillNewPass'] = 'Fyll i fältet.';
    }
    if(empty($passwordNewC)){
        $_SESSION['message']['fillConNewPass'] = 'Fyll i fältet.';
    }
    if(empty($oldPassword)){
        $_SESSION['message']['fillOldPass'] = 'Fyll i fältet.';
    }
    if(!ctype_alnum($passwordNew)){
        $_SESSION['message']['newPassNotAlpha'] = 'Nya Lösenordet är har fel karaktärer, använd A-Z.';
    }
    if (($passwordNew != $passwordNewC)){
        $_SESSION['message']['passDontMatch'] = 'Nya lösenordet matchar inte.';
    }
    if((strlen($passwordNew) < 6) && !empty($passwordNew)){
        $_SESSION['message']['wrongSize'] = 'Lösenordet som angivits innehåller färre än 6 tecken.';
    }
    if((strlen($passwordNew) > 20) && !empty($passwordNew)){
        $_SESSION['message']['wrongSize'] = 'Lösenordet som angivits innehåller fler än 20 tecken.';
    }
    if(($oldPassword != $row['Password']) && !empty($oldPassword)){
        $_SESSION['message']['oldPassDontMatch'] = 'Befintligt lösenord stämmer inte.';
    }

    $adminCheckMysql = mysqli_query($dbc,"SELECT Admin FROM Users WHERE Name = '$login_session'");
    $adminCheck = mysqli_fetch_array($adminCheckMysql);
    if (!(empty($_SESSION['message']))){
        if($adminCheck['Admin']){
          header('Location: mina_sidor_admin.php');
        } else {
          header('Location: mina_sidor.php');
        }
    } else {
        $changePassMySQL = "UPDATE Users SET Password='$passwordNew' WHERE Name='$login_session'";
        mysqli_query($dbc, $changePassMySQL);
        $_SESSION['message']['passChanged'] = 'Lösenordet är nu ändrat.';

        if($adminCheck['Admin']){
          header('Location: mina_sidor_admin.php');
        } else {
          header('Location: mina_sidor.php');
        }
    }
  }

  mysqli_close($dbc);
?>
