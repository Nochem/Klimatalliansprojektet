<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimat allians Lund - Mina Sidor
	</title>

	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link rel="stylesheet" type="text/css" href="../css/minasidor-style.css">
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
		<div id="wrapper">
			<div id="wrapper">
				<a href="rapport.php"></a>
				<div id="logo">
				</div>
				<div id="menu">
					<ul>
						<a href="rapport.php">
							<li class="menuitem" >
								Rapport
							</li>
						</a>
						<a href="historik.php">
							<li class="menuitem">
								Historik
							</li>
						</a>
						<a href="statistik.php">
							<li class="menuitem">
								Statistik
							</li>
						</a>
						<a href="mina_sidor.php">
							<li class="menuitem currentpage">
								Mina Sidor
							</li>
						</a>
						<a href="kontakt.php">
							<li class="menuitem">
								Kontakt
							</li>
						</a>

					</ul>
				</div>
				<div id="content">
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
            $query = mysqli_query($dbc, "SELECT LastLogIn, IpAddress FROM Users WHERE Name='$login_session'");
            $Date_Time_Ip = mysqli_fetch_array($query);
            echo '<p>';
            echo 'Senaste inloggning: '.$Date_Time_Ip['LastLogIn'];
            echo '</p>';
            echo '<p>';
            echo 'Från ip: '.$Date_Time_Ip['IpAddress'];
            echo '</p>';
          ?>
				</div>
			</div>
			<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
			<script type="text/javascript" src="../js/minasidor-script.js"></script>
			<script type="text/javascript" src="../js/proto-script.js"></script>
		</body>
		</html>
