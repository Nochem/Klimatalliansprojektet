<?php
   include('session.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Admin mina sidor
	</title>
	<link rel="stylesheet" type="text/css" href="../css/minasidor-style.css">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="user">
		<p id="username">
			User: <?php echo $row['Name']; ?>
			<form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.php">
				<label>
					<input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
				</label>
			</form>
		</p>

	</div>
	<div id="wrapper">
		<div id="logo">
		</div>
		<div id="menu">
			<ul>
				<a href="anvandare.php">
					<li class="menuitem">
						Användare
					</li>
				</a>
				<a href="statistik_admin.php">
					<li class="menuitem">
						Statistik
					</li>
				</a>
				<a href="admin_redigera.php">
					<li class="menuitem">
						Redigera fält
					</li>
				</a>
				<a href="mina_sidor_admin.php">
					<li class="menuitem currentpage">
						Mina Sidor
					</li>
				</a>


			</ul>
		</div>
		<div id="content">
			<h2>
				Kontaktinformation
				<br>
			</h2>
			<form action="changeAdminInfo.php" method="post">
        <?php
          ob_start();
          $query = mysqli_query($dbc, "SELECT realName, Email, Telephone FROM users WHERE Admin = '1'");
          $admin = mysqli_fetch_array($query);
  				echo 'Namn:';
  				echo '<input type="text" name="RealName" value="'.$admin['RealName'].'">';
  				echo '<br><br>';
  				echo 'Epost:';
  				echo '<input type="text" name="email" value="'.$admin['Email'].'">';
  				echo '<br><br>';
  				echo 'Telefon :';
  				echo '<input type="text" name="telefon" value="'.$admin['Telephone'].'">';
          echo '<br><br>';
  				echo '<input class="flatbutton" type="submit" value="Spara">';
  				echo '<br><br>';
        ?>
			</form>

      <h2>
        Ändra Lösenord
      </h2>
      <p>
        <?php
          if(!empty($_SESSION['message']['passChanged'])){
            echo '<font color="green" size="2" style="margin-left:10px">'.$_SESSION['message']['passChanged'].'</font>';
            unset($_SESSION['message']['passChanged']);
          }
        ?>
      </p>
      <form action="changePassword.php" id="passwchange" method="post">
        <p>
          Befintligt Lösenord:
        </p>
        <p>
          <?php
            if(!empty($_SESSION['message']['fillOldPass'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['fillOldPass'].'</font>';
              unset($_SESSION['message']['fillOldPass']);
              //unset($_SESSION['message']['oldPassDontMatch']);
            } else if(!empty($_SESSION['message']['oldPassDontMatch'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['oldPassDontMatch'].'</font>';
              unset($_SESSION['message']['oldPassDontMatch']);
            }
          ?>
        </p>
        <input id="oldpass" type="password" name="oldPass" value="">
        <p>
          Nytt Lösenord:
        </p>
        <p>
          <?php
            if(!empty($_SESSION['message']['fillNewPass'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['fillNewPass'].'</font>';
              unset($_SESSION['message']['fillNewPass']);
              //unset($_SESSION['message']['wrongSize']);
            } else if(!empty($_SESSION['message']['wrongSize'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['wrongSize'].'</font>';
              unset($_SESSION['message']['wrongSize']);
            }
          ?>
        </p>
        <input id="newpass" type="password" name="newPass" value="">
        <p>
          Bekräfta nytt lösenord:
        </p>
        <p>
          <?php
            if(!empty($_SESSION['message']['fillConNewPass'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['fillConNewPass'].'</font>';
              unset($_SESSION['message']['fillConNewPass']);
            } else if(!empty($_SESSION['message']['passDontMatch'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['passDontMatch'].'</font>';
              unset($_SESSION['message']['passDontMatch']);
            }
          ?>
        </p>
        <input id="newpassconf" type="password" name="newPassconfirm" value="">
        <p id="nomatch">
        </p>
        <br>
        <input class="flatbutton"id="change" type="submit"value="Ändra Lösenord">
        <br>
        <br>
        <p>
          Det nya lösenordet måste vara mellan 6-20 tecken långt.
          <br>
          (Tillåtna tecken är A-Z, a-z och 0-9)
        </p>

      </form>
      <?php
        ob_start();
        $query = mysqli_query($dbc, "SELECT LastLogIn, IpAddress FROM users WHERE Admin = '1'");
        $admin = mysqli_fetch_array($query);
        echo '<p>';
        echo 'Senaste inloggning: '.$admin['LastLogIn'];
        echo '</p>';
        echo '<p>';
        echo 'Från ip: '.$admin['IpAddress'];
        echo '</p>';
      ?>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/minasidor-script.js"></script>
</body>
</html>
