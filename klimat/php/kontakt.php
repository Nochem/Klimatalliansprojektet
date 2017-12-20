<?php
   include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>
		Klimatallians - Kontakt
	</title>
	<style>
	</style>
	<link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<link rel="stylesheet" type="text/css" href="../css/minasidor-style.css">
	<link rel="icon" href="../res/icon.png">
</head>
<body>
	<div id="wrapper">
		<a href="rapport.php">
			<div id="logo">

                	<div id="user">
                    		<p id="username">
                			Inloggad som: <b><?php echo $login_session; ?></b>

                		</p>
                	</div>
            </div>
		</a>
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
					<li class="menuitem">
						Mina Sidor
					</li>
				</a>
				<a href="kontakt.php">
					<li class="menuitem currentpage">
						Kontakt
					</li>
				</a>

                <li style="padding:0em">
                    <form id="logout" name="form1" action="logout.php" method="post">
        				<input name="submit2" type="submit" id="submit2" value="Log out">
        			</form>
                </li>
			</ul>
		</div>
		<div id="content">
      <?php
        $query = mysqli_query($dbc, "SELECT RealName, Email, Telephone FROM Users WHERE Admin = '1'");
        $admin = mysqli_fetch_array($query);

  			echo '<p style="font-size:22px; text-align:left;"> Administratör: ';
  			echo $admin['RealName'];
  			echo '</p>';
        echo '<p style="font-size:22px; text-align:left;"> E-post: ';
        echo $admin['Email'];
        echo '</p>';
        echo '<p style="font-size:22px; text-align:left;"> Telefonnummer: ';
        echo $admin['Telephone'];
        echo '</p>';
      ?>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/minasidor-script.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>
