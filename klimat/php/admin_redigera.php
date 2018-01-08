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
		Klimatallians - Redigera fält (Admin)
	</title>
	<link rel="stylesheet" type="text/css" href="../css/redigera-style.css">
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
                    <li class="menuitem currentpage">
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
    <div id="addFieldModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
              <form action="add_field.php" name="form" method="post">
			   Utsläppskälla:
                <input id="addInputEmission" name="modalInputNewEmission" type="text">
                <br>
                Enhet:
                <select id="addFieldOptionBox" name="addFieldOptionBox">
				  <option value="m3">m3</option>
				  <option value="kg">kg</option>
				  <option value="MWh">MWh</option>
				  <option value="mil">mil</option>
				</select>
                <br>
                Omräkningsfaktor:
                <input id="addInputConvFac" name="modalInputNewConvFac" type="text">
                <br>
                Utsläpp i CO2 per MWh:
                <input id="addInputCO2perMWh" name="addModalInputChangeCO2perMWh" type="text">
                <br>
				Kategori:
				<select id="addEditFieldOptionBoxCategory" name="addEditFieldOptionBoxCategory">
				  <option value="Transport">Transport</option>
				  <option value="Lokaler och Processer">Lokaler och Processer</option>
				</select>
				<br>

				Info:
				<input id="addInfo" name="modalInputAddInfo" type="text">
				<br>
                <Button class="flatbutton" name="create" id="create">Lägg till fält</button>
            </form>
        </div>
    </div>
    <div id="changeFieldModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
            <form action="edit_field.php" name="form" method="post">
                Utsläppskälla:
                <input id="mInputName" name="modalInputEmissionSource" type="text" readonly>
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
				Info:
				<input id="editInfo" name="inputEditInfo" type="text">
                <br>
                <button class="savebutton" name="confirmEdit" id="confirmEdit" onclick="" style="margin-bottom: 10px;">Spara</button>
                <br>
            </form>
            <form action="delete_field.php" method="post" onsubmit="return confirm('Är du säker du vill ta bort detta fält?');">
                <input type="hidden" id="mInputDeleteThis" name="modalInputDeleteThis" type="text" readonly>
                <input type="submit" name="delete" id="submitDelete" class="deletebutton" value="Ta bort">
            </form>

        </div>
    </div>
		<div id="content">
			<div id="stat">
				<h1>
					Transporter
				</h1>
				<button class="flatbutton" onclick='addEmissionSource()'>Lägg till fält</button>

				<table>
					<tr style="font-size:21px;">
						<th style="text-align:left">Utsläppskälla</th>
						<th style="text-align:left">Enhet</th>
						<th style="text-align:left">Omräkningsfaktor</th>
						<th style="text-align:left">Utsläpp i CO2 per MWh</th>
						<th style="text-align:left">Senast ändrad</th>
						<th style="text-align:left">Info</th>


					</tr>

          <?php
              ob_start();
              $query = mysqli_query($dbc, "SELECT * FROM ConversionFactors Where Category = 'Transport'");
              while($row = mysqli_fetch_array($query)){
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
      					echo $row['Info'];
      					echo '</td>';
    					  echo "<td style='text-align:left' class='editbtn'>
                            <button id=change-".$row['EmissionSource']."
                            class='flatbutton'
                            type='editMemberButton'
                            onclick='changeEmissionSource(\"".$row['EmissionSource']."\",\"".$row['ConvFactor']."\",\"".$row['EmissionCO2perMWh']."\", \"".$row['Unit']."\", \"".$row['Category']."\", \"".$row['Info']."\")'>Redigera
                            </button></td>";
                echo "</tr>";
              }
            ?>
			</table>
			<h1>
			Lokaler och Processer
			</h1>
			<button class="flatbutton" onclick='addField()'>Lägg till fält</button>
			<table>
			<tr style="font-size:21px;">
						<th style="text-align:left">Utsläppskälla</th>
						<th style="text-align:left">Enhet</th>
						<th style="text-align:left">Omräkningsfaktor</th>
						<th style="text-align:left">Utsläpp i CO2 per MWh</th>
						<th style="text-align:left">Senast ändrad</th>
						<th style="text-align:left">Info</th>


					</tr>
			<?php
          ob_start();
          $query = mysqli_query($dbc, "SELECT * FROM ConversionFactors Where Category = 'Lokaler och Processer'");
          while($row = mysqli_fetch_array($query)){
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
  					echo $row['Info'];
  					echo '</td>';
					  echo "<td style='text-align:left' class='editbtn'>
                        <button id=change-".$row['EmissionSource']."
                        class='flatbutton'
                        type='editMemberButton'
                        onclick='changeEmissionSource(\"".$row['EmissionSource']."\",\"".$row['ConvFactor']."\",\"".$row['EmissionCO2perMWh']."\", \"".$row['Unit']."\", \"".$row['Category']."\", \"".$row['Info']."\")'>Redigera
                        </button></td>";
            echo "</tr>";
          }
        ?>
			</table>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/proto-script.js"></script>
    <script type="text/javascript" src="../js/admin_redigera_script.js"></script>
	</body>
</html>
