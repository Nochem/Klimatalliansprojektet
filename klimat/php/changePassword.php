<?php
  include('mina_sidor.php');
  if(!empty($_POST)){
    $passwordNew = mysqli_real_escape_string($dbc, $_POST['newPass']);
    $passwordNewC = mysqli_real_escape_string($dbc, $_POST['newPassconfirm']);
    $oldPassword = mysqli_real_escape_string($dbc, $_POST['oldPass']);

    if(empty($passwordNew)){
        $_SESSION['message']['fillNewPass'] = 'Fyll i nytt lösenord.';
    }
    if(empty($passwordNewC)){
        $_SESSION['message']['fillConNewPass'] = 'Fyll i bekräfta nytt lösenord.';
    }
    if(empty($oldPassword)){
        $_SESSION['message']['fillOldPass'] = 'Fyll i befintligt Lösenord.';
    }
    if (($passwordNew != $passwordNewC)){
        $_SESSION['message']['passDontMatch'] = 'Nya lösenordet matchar inte.';
    }
    if((strlen($passwordNew) < 6) && !empty($passwordNew)){
        $_SESSION['message']['wrongSize'] = 'Nya lösenordet är mindre än 6.';
    }
    if((strlen($passwordNew) > 20) && !empty($passwordNew)){
        $_SESSION['message']['wrongSize'] = 'Nya lösenordet är större än 20.';
    }
    if(($oldPassword != $row['Password']) && !empty($oldPassword)){
        $_SESSION['message']['oldPassDontMatch'] = 'Befintligt Lösenord stämmer inte.';
    }

    if (!(empty($_SESSION['message']))){
        header('Location: mina_sidor.php');
    } else {
        $changePassMySQL = "UPDATE Users SET Password='$passwordNew' WHERE Name='$login_session'";
        mysqli_query($dbc, $changePassMySQL);
        $_SESSION['message']['passChanged'] = 'Lösenordet är nu ändrat.';

        $adminCheckMysql = mysqli_query($dbc,"SELECT Admin FROM Users WHERE Name = '$login_session'");
        $adminCheck = mysqli_fetch_array($adminCheckMysql);
        if($adminCheck['Admin']){
          header('Location: mina_sidor_admin.php');
        } else {
          header('Location: mina_sidor.php');
        }
    }
  }

  mysqli_close($dbc);
?>
