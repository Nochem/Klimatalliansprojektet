<?php 

DEFINE('DB_USER', 'u4522484_LuDat');
DEFINE('DB_PASS','asd1');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','u4522484_Rapport');

$con =  mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(mysqli_errno()){
	echo "Failed to connect: " . mysqli_connect_errno();  
	
}
	











?>