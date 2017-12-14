<?php
   include "session.php";
   $date_and_time = date('Y-m-d H:i:s');
   function get_client_ip() {
     $ipaddress = '';
     if (isset($_SERVER['HTTP_CLIENT_IP']))
       $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
       $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_X_FORWARDED']))
       $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
       $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_FORWARDED']))
       $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if(isset($_SERVER['REMOTE_ADDR']))
       $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
       $ipaddress = 'UNKNOWN';
     return $ipaddress;
   }
   $ip=get_client_ip();
   mysqli_query($dbc, "UPDATE Users SET LastLogIn='$date_and_time', IpAddress='$ip' WHERE Name='$login_session'");
   
   if(session_destroy()) {
      header("Location: login.php");
   }
?>
