<?php
include('session.php');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        Klimat allians Lund - Historik
    </title>
    <link rel="stylesheet" type="text/css" href="../css/style-proto.css">
    <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/historik-style.css">
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
                    <li class="menuitem currentpage">
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
                    <li class="menuitem">
                        Kontakt
                    </li>
                </a>

            </ul>
        </div>
        <div id="sidebar">
        </div>
        <div id="content">
            <div id="stat">
                <h1>
                    Inventering av CO<sub>2</sub> utsläpp från transporter
                </h1>
                <select id="yeardrop" onselect= "myfunction()">
                    <option>
                        2016
                    </option>
                    <option>
                        1337
                    </option>
                </select>
                <table>
                    <tr>
                        <th>Utsläppskälla</th>
                        <th>Inköpt mängd</th>
                        <th> Enhet</th>
                        <th> ton CO<sub>2</sub></th>
                    </tr>
                    <tbody id = "gentable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/proto-script.js"></script>
    <script type="text/javascript" src="../js/historik-script.js"></script>
</body>
</html>
