<?php
   include('session.php');
   if($row['Admin'] == 0){
     header("location: rapport.php");
   }
?>
<!DOCTYPE  html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimatallians - Användare (Admin)
	</title>
	<link rel="stylesheet" type="text/css" href="../css/anvandare-style.css">
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
                    <li class="menuitem currentpage">
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
                    <li class="menuitem">
                        Mina Sidor
                    </li>
                </a>
		<a href="rapporter_admin.php">
                    <li class="menuitem">
                        Rapporter
                    </li>
                </a>

                <li style="padding:0em">
                    <form id="logout" name="form1" action="logout.php" method="post" onsubmit="return confirm('Är du säker du vill logga ut?')">
        				<input name="submit2" type="submit" id="submit2" value="Logga ut">
        			</form>
                </li>
			</ul>
		</div>
		<div id="sidebar">
		</div>
    <div id="addUserModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
              <form action="addUser.php" method="post">
                Användarnamn:
                <input id="InputName" name="modalInputNewName" type="text">
                <br>
                Lösenord:
                <input id="InputPassword" name="modalInputNewPassword" type="text">
                <br>
                Email:
                <input id="InputEmail" name="modalInputNewEmail" type="text">
                <br>
                Telefon:
                <input id="InputTelephone" name="modalInputNewTelephone" type="text">
                <br>
                <br>
                <Button class="flatbutton" name="submitNew" id="submitNew">Lägg till medlem</button>
              </form>
        </div>
    </div>
    <div id="changeUserModal" class="modal">
      <form action="changeUser.php" method="post">
        <div class="modal-content">
          <span class="close">&times;</span>
            <form action="changeUser.php" method="post">
                <input id="userNbr" name="userNbr" type="hidden">
                Användarnamn:
                <input id="mInputName" name="modalInputChangeName" type="text">
                <br>
                Lösenord:
                <input id="mInputPassword" name="modalInputChangePassword" type="text">
                <br>
                Email:
                <input id="mInputEmail" name="modalInputChangeEmail" type="text">
                <br>
                Telefon:
                <input id="mInputTelephone" name="modalInputChangeTelephone" type="text">
                <br>
                Aktiv:
                <input id="mInputActiveYes" name="modalInputActive" type="radio" value="1">Ja
                <input id="mInputActiveNo" name="modalInputActive" type="radio" value="0">Nej
                <br>
                <br>
                <Button class="savebutton" id="submitChange" style="margin-bottom: 10px;">Spara</Button>
                <br>
            </form>
            <form action="deleteUser.php" method="post" onsubmit="return confirm('Är du säker du vill ta bort denna medlem?');">
                <input id="userNbrD" name="userNbrD" type="hidden">
                <button id="submitDelete" class="deletebutton">tabort</button>
            </form>
        </div>
    </div>
		<div id="content">
			<div id="stat">
				<h1>
					Användare
				</h1>
				<button class="flatbutton" onclick='addUser()'>Lägg till användare</button>
				<table>
					<tr style="font-size:21px;">
            <th style="text-align:left">Aktiv</th>
						<th style="text-align:left">Användarnamn</th>
						<th style="text-align:left">Lösenord</th>
            <th style="text-align:left">E-post</th>
            <th style="text-align:left">Telefon</th>
            <th style="text-align:left">Senast inloggad</th>
            <th style="text-align:left">Senaste IP-adress</th>
            <th style="text-align:left">Registrerad</th>
	    <th style="text-align:left">Senast klarmarkerade rapport</th>
					</tr>
          <?php
              ob_start();
              $a = 0;
              $query = mysqli_query($dbc, "SELECT Active, Name, Password, Email,
                  Telephone, LastLogin, IpAddress, DATE(RegisterDate), max(Year), finished
                  FROM Users JOIN Report on Report.User = Users.Name GROUP BY User");
              while($row = mysqli_fetch_array($query)){
                $a++;
                if(!$row['Admin']){
                  $_SESSION['name'][$a] = $row['Name'];
                  if($row['Active']){
                    $active = 'Ja';
                  } else {
                    $active = 'Nej';
                  }
                  echo "<tr id=".$row['Name'].">";
                  echo "<td id=".$a."-active>".$active."</td>";
                  echo "<td id=".$a."-name>".$row['Name']."</td>";
                  echo "<td id=".$a."-password>".$row['Password']."</td>";
                  echo "<td id=".$a."-email>".$row['Email']."</td>";
                  echo "<td id=".$a."-telephone>".$row['Telephone']."</td>";
                  echo "<td>".$row['LastLogin']."</td>";
                  echo "<td>".$row['IpAddress']."</td>";
                  echo "<td>".$row['RegisterDate']."</td>";
		          $lfyMySQL = mysqli_query($dbc, "SELECT max(Year) FROM Report WHERE User = \"".$row['Name']."\" AND finished = 1");
                  $lfy = mysqli_fetch_array($lfyMySQL);
                  if($lfy['max(Year)'] == ''){
                    echo "<td>Ingen färdig rapport</td>";
                  } else {
                    echo "<td>".$lfy['max(Year)']."</td>";
                  }
                  echo "<td style='text-align:left' class='editbtn'>
                        <button id=change-".$row['Name']."
                        class='flatbutton'
                        type='editMemberButton'
                        onclick='changeUser(\"".$a."\")'>Redigera användare
                        </button></td>";
                  echo "</tr>";
                }
              }
            ?>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
    <script type="text/javascript" src="../js/anvandare-script.js"></script>
	</body>
</html>
