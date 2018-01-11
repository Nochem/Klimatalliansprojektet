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
		Klimatallians - Statistik (Admin)
	</title>
	<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
	<style>
	#yeardrop{
		width:500px;
		height: 40px;
	}
	</style>

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
					<li class="menuitem currentpage">
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
                    <form id="logout" name="form1" action="logout.php" method="post" onsubmit="return confirm('Är du säker du vill logga ut?'")>
        				<input name="submit2" type="submit" id="submit2" value="Logga ut">
        			</form>
                </li>
			</ul>
		</div>
		<div class="chart-container" style="font-family: 'Barlow',sans-serif;">
			
			Ton CO<sub>2</sub>

			<div id="chart">

			<canvas id="myChart" styles="width=100px height=100px"></canvas>
			</div>
			<p align="right">
				År
			</p>
			
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/proto-script.js"></script>
	<script type="text/javascript" src="../js/chartjs_min.js"></script>
	<script type="text/javascript" src="../php/statistikscript_admin.php"></script>
</body>
</html>
