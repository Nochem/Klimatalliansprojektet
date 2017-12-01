<?php include "mysqli_connect.php";
	session_start();
	if(empty($_POST['username']) && empty($_POST['password'])){
		$error = '';
	} else {
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$myusername = mysqli_real_escape_string($dbc,$_POST['username']);
			$mypassword = mysqli_real_escape_string($dbc,$_POST['password']);
			$sql = "SELECT Name, Password FROM Users WHERE Name = '$myusername' and password = '$mypassword'";
			$result = mysqli_query($dbc,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$active = $row['active'];
			$count = mysqli_num_rows($result);
			if($count == 1){
				$_SESSION['login_user'] = $myusername;
				if($myusername == "testadmin"){
					header("Location: anvandare.php");
				}else{
					header("location: rapport.php");
				}
				session_register("myusername"); //Får ej ligga över header
			}else{
				$error = "Användarnamn eller Lösenord felaktigt";
			}
		}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			Klimatallians - Inloggning
		</title>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<link rel="stylesheet" type="text/css" href="../css/style-proto.css">
		<style>
			#wrapperL{
				text-align:center;
				width:500px;
				height:500px;
			}
			#contentT{
				text-align:center;
				width:300px;
				height:300px;
			}
		</style>
		<link rel="icon" href="../res/icon.png">
	</head>
	<body>
		<div id="wrapperL">
			<div id="logo"></div>
			<div id="content">
				<form action = "" method = "post">
					<label>Användarnamn</label>
					<br>
					<input type = "text" name = "username"/><br/><br/>
					<label>Lösenord</label>
					<br>
					<input type = "password" name = "password"/><br/><br/>

					<input type = "submit" value = " Logga in "/><br/>


				</form><div style = "font-size:14px; color:#cc0000; maargin-top:10px">
					<?php echo $error; ?>
					<br/><br/>
					<a class="help" href="glomt_losenord.html"onclick="window.open('glomt_losenord.html','newwindow','width=600,height=300');return false;">Glömt lösenord?</a>
					<br>
					<a class="help" href="hjalp_inloggningssida.html" onclick="window.open('hjalp_inloggningssida.html', 'newwindow', 'width=600,height=300');return false;">Hjälp</a>
					<br>

				</div>
			</div>
		</div>
	</body>
</html>
