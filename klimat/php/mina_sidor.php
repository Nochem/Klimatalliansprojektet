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
            User: Företag
            <form style="float:right" id="logout" align="right" name="form1" method="post" action="statistik.php">
                <label>
                    <input class="menuitem flatbutton" name="submit2" type="submit" id="submit2" value="Log out">
                </label>
            </form>
        </p>
    </div>
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
            <form id="passwchange" onsubmit="return validateForm()">
                <p>
                    Befintligt Lösenord:
                </p>
                <input id="oldpass" type="password" name="oldPass" value="">
                <p>
                    Nytt Lösenord:
                </p>
                <input id="newpass" type="password" name="newPass" value="">
                <p>
                    Bekräfta nytt lösenord:
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
        </div>
    </div>
    <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/minasidor-script.js"></script>
    <script type="text/javascript" src="../js/proto-script.js"></script>
</body>
</html>
