<?php
   include('mysqli_connect.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($dbc,"select Name, Password from Users where Name = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
