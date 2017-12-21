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
		Klimat allians Lund - Användare
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
                    User: <?php echo $login_session; ?>
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
                    <li class="menuitem currentpage">
                        Redigera fält
                    </li>
                </a>
                <a href="mina_sidor_admin.php">
                    <li class="menuitem">
                        Mina Sidor
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
			   Utsläppskälla:
                <input id="InputName" name="modalInputNewName" type="text">
                <br>
                Enhet:
                <select id="addFieldOptionBox">
				  <option value="m3">m3</option>
				  <option value="kg">kg</option>
				  <option value="MWh">MWh</option>
				  <option value="mil">mil</option>
				</select>
                <br>
                Omräkningsfaktor:
                <input id="InputEmail" name="modalInputNewEmail" type="text">
                <br>
                Utsläpp i CO2 per MWh:
                <input id="InputTelephone" name="modalInputNewTelephone" type="text">
                <br>
				Kategori:
				<input id="mInputTelephone" name="modalInputChangeTelephone" type="text">
                <br>
                <Button class="flatbutton" name="submitNew" id="submitNew">Lägg till fält</button>
            </form>
        </div>
    </div>
    <div id="changeUserModal" class="modal">

        <div class="modal-content">
          <span class="close">&times;</span>
            <form action="admin_redigera.php" name="form" method="post">
                <input id="userNbr" name="userNbr" type="hidden">
                Utsläppskälla:
                <input id="mInputName" name="modalInputChangeName" type="text" readonly>
                <br>
                Enhet:
                <select id="editFieldOptionBoxUnit" name="editFieldOptionBox">
				  <option value="m3">m3</option>
				  <option value="kg">kg</option>
				  <option value="MWh">MWh</option>
				  <option value="mil">mil</option>
				</select>
                <br>
                Omräkningsfaktor:
                <input id="mInputConvFactor" name="modalInputChangeFactor" type="text">
                <br>
                Utsläpp i CO2 per MWh:
                <input id="mInputCO2perMWh" name="modalInputChangeCO2perMWh" type="text">
                <br>
                Kategori:
				<select id="editFieldOptionBoxCategory" name="editFieldOptionBoxCategory">
				  <option value="Transport">Transport</option>
				  <option value="Lokaler och Processer">Lokaler och Processer</option>
				</select>

                <br>
                <br>
               <button class="savebutton" name="confirmEdit" id="confirmEdit" onclick="" style="margin-bottom: 10px;">Spara</button>

			   <form action="admin_redigera.php" method="post" onsubmit="return confirm('Är du säker du vill ta bort detta fält?');">
                <button name="delete" id="submitDelete" class="deletebutton">Ta bort</button>
            </form>

                <br>
            </form>

        </div>
    </div>
		<div id="content">
			<div id="stat">
				<h1>
					Transporter
				</h1>
				<button class="flatbutton" onclick='addUser()'>Lägg till fält</button>

				<table>
					<tr style="font-size:21px;">
						<th style="text-align:left">Utsläppskälla</th>
						<th style="text-align:left">Enhet</th>
						<th style="text-align:left">Omräkningsfaktor</th>
						<th style="text-align:left">Utsläpp i CO2 per MWh</th>
						<th style="text-align:left">Senast ändrad</th>
						<th style="text-align:left">Senast inloggad tid och datum</th>


					</tr>

          <?php
              ob_start();
              $a = 0;

              $query = mysqli_query($dbc, "SELECT * FROM ConversionFactors Where Category = 'Transport'");
              while($row = mysqli_fetch_array($query)){

                $a++;
                if(!$row['Admin']){
                  $_SESSION['name'][$a] = $row['Name'];
                  if($row['Active']){
                    $active = 'Ja';
                  } else {
                    $active = 'Nej';
                  }
					echo '<tr>';
					echo '<td>';
					echo $row['EmissionSource'];
					echo '</td>';
					echo '<td>';
					echo $row['Unit'];
					echo '</td>';
					echo '<td>';
					echo $row['ConvFactor'];
					echo '</td>';
					echo '<td>';
					echo $row['EmissionCO2perMWh'];
					echo '</td>';
					echo '<td>';
					echo $row['DateChanged'];
					echo '</td>';
					echo '<td>';
					echo $row['Category'];
					echo '</td>';
					  echo "<td style='text-align:left' class='editbtn'>
                        <button id=change-".$row['EmissionSource']."
                        class='flatbutton'
                        type='editMemberButton'
                        onclick='changeEmissionSource(\"".$row['EmissionSource']."\",\"".$row['ConvFactor']."\",\"".$row['EmissionCO2perMWh']."\", \"".$row['Unit']."\", \"".$row['Category']."\")'>Redigera
                        </button></td>";
                  echo "</tr>";
                }
              }
            ?>
			</table>
			<h1>
			Lokaler och Processer
			</h1>
			<button class="flatbutton" onclick='addUser()'>Lägg till fält</button>
			<table>
			<tr style="font-size:21px;">
						<th style="text-align:left">Utsläppskälla</th>
						<th style="text-align:left">Enhet</th>
						<th style="text-align:left">Omräkningsfaktor</th>
						<th style="text-align:left">Utsläpp i CO2 per MWh</th>
						<th style="text-align:left">Senast ändrad</th>
						<th style="text-align:left">Senast inloggad tid och datum</th>


					</tr>
			<?php
              ob_start();
              $a = 0;

              $query = mysqli_query($dbc, "SELECT * FROM ConversionFactors Where Category = 'Lokaler och Processer'");
              while($row = mysqli_fetch_array($query)){

                $a++;
                if(!$row['Admin']){
                  $_SESSION['name'][$a] = $row['Name'];
                  if($row['Active']){
                    $active = 'Ja';
                  } else {
                    $active = 'Nej';
                  }
					echo '<tr>';
					echo '<td>';
					echo $row['EmissionSource'];
					echo '</td>';
					echo '<td id="unit">';
					echo $row['Unit'];
					echo '</td>';
					echo '<td>';
					echo $row['ConvFactor'];
					echo '</td>';
					echo '<td>';
					echo $row['EmissionCO2perMWh'];
					echo '</td>';
					echo '<td>';
					echo $row['DateChanged'];
					echo '</td>';
					echo '<td>';
					echo $row['Category'];
					echo '</td>';
					  echo "<td style='text-align:left' class='editbtn'>
                        <button id=change-".$row['EmissionSource']."
                        class='flatbutton'
                        type='editMemberButton'
                        onclick='changeEmissionSource(\"".$row['EmissionSource']."\",\"".$row['ConvFactor']."\",\"".$row['EmissionCO2perMWh']."\", \"".$row['Unit']."\", \"".$row['Category']."\")'>Redigera
                        </button></td>";
                  echo "</tr>";
                }
              }
            ?>
			</table>
				</div>
			</div>
		</div>
		<?php
		  ob_start();

		   if(isset($_POST['delete']) ){
			   $name = mysqli_real_escape_string($dbc, $_POST['modalInputChangeName']);
				if ($deleteEmissionSourceSQL = mysqli_prepare($dbc, "DELETE FROM ConversionFactors WHERE EmissionSource=?")) {
					$deleteEmissionSourceSQL->bind_param("s", $name);
                    $deleteEmissionSourceSQL->execute();
                    $deleteEmissionSourceResult = $deleteEmissionSourceSQL->get_result();
                    $deleteEmissionSourceSQL->close();
				}
		   }
		   $removeField = false;
		  if(isset($_POST['confirmEdit'])){
			$removeField = '<script type="text/javascript">confirm("Säker på att du vill ta bort fältet");</script>';
			echo $removeField;
			  if($removeField){
			$name = mysqli_real_escape_string($dbc, $_POST['modalInputChangeName']);
			$unit = mysqli_real_escape_string($dbc, $_POST['editFieldOptionBox']);
			$factor = mysqli_real_escape_string($dbc, $_POST['modalInputChangeFactor']);
			$CO2perMWh = mysqli_real_escape_string($dbc, $_POST['modalInputChangeCO2perMWh']);
			$Category = mysqli_real_escape_string($dbc, $_POST['editFieldOptionBoxCategory']);

			if ($changeEmissionSourceSQL = mysqli_prepare($dbc, "UPDATE ConversionFactors SET Unit=?, ConvFactor=?, EmissionCO2perMWh=?, DateChanged=Default, Category=? WHERE EmissionSource=?")) {
				$changeEmissionSourceSQL->bind_param("sddss", $unit, $factor, $CO2perMWh, $Category, $name);
                $changeEmissionSourceSQL->execute();
                $changeEmissionSourceResult = $changeEmissionSourceSQL->get_result();
                $changeEmissionSourceSQL->close();
			}
			}
			sleep(2);
			header("Refresh:0");
			//header('Location: admin_redigera.php');
		  }
		?>

		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
    <script type="text/javascript" src="../js/admin_redigera_script.js"></script>
	</body>
</html>
