<?php
   include('session.php');
   if($row['Admin'] == 0){
     header("location: rapport.php");
   }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimatallians - Mina sidor (Admin)
	</title>
	<link rel="stylesheet" type="text/css" href="../css/minasidor-style.css">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="wrapper">
		<div id="logo">

            	<div id="user">
                		<p id="username">
            			Inloggad som: <b><?php echo $login_session; ?></b>

            		</p>
            	</div>
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
				<a href="rapporter_admin.php">
                  		<li class="menuitem">
                      			Rapporter
                   		</li>
                		</a>

                <li style="padding:0em">
                    <form id="logout" name="form1" action="logout.php" method="post" onsubmit="return confirm('Är du säker du vill logga ut?'")>
                        <input name="submit2" type="submit" id="submit2" value="Logga ut">
                    </form>
                </li>

			</ul>
		</div>
		<div id="content">
			<h2>
				Kontaktinformation
				<?php
         			  if(!empty($_SESSION['message']['AdminChanged'])){
          	 		    echo '<br><font color="green" size="2" style="margin-left:10px">'.$_SESSION['message']['AdminChanged'].'</font>';
          			    unset($_SESSION['message']['AdminChanged']);
          			  }
        			?>
				<br>
			</h2>
			<form action="changeAdminInfo.php" method="post">
        <?php
          ob_start();
          $query = mysqli_query($dbc, "SELECT RealName, Email, Telephone FROM Users WHERE Admin = '1'");
          $admin = mysqli_fetch_array($query);
  				echo 'Namn: ';
  				echo '<input type="text" name="RealName" value="'.$admin['RealName'].'">';
  				echo '<br><br>';
  				echo 'E-post: ';
  				echo '<input type="text" name="email" value="'.$admin['Email'].'">';
  				echo '<br><br>';
  				echo 'Telefon: ';
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
            } else if(!empty($_SESSION['message']['newPassNotAlpha'])){
              echo '<font color="red" size="2" style="margin-left:10px">'.$_SESSION['message']['newPassNotAlpha'].'</font>';
              unset($_SESSION['message']['newPassNotAlpha']);
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
        $query = mysqli_query($dbc, "SELECT LastLogIn, IpAddress FROM Users WHERE Admin = '1'");
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
