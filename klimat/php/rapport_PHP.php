<?php
if(isset($_POST['submit'])){
    $data_missing = array();

    if(empty($_POST['bensin'])){
        $data_missing[] = 'Bensin';
		
    } else {
        $bensin = trim($_POST['bensin']);
    }
	
    if(empty($data_missing)){
		require_once('mysqli_connect.php');
       
        $query = "INSERT INTO enVarTest(utslapp, tonCo2) VALUES (?, ?)";

        $stmt = mysqli_prepare($dbc, $query);
		/*	
			i Integers
			d Doubles
			b Blobs
			s Everything Else  
		*/
	
		mysqli_stmt_bind_param($stmt, "ss" , $text , $bensin);
		
		$text = "Bensin";
        
		mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if($affected_rows == 1){
			echo "<script language='javascript' type='text/javascript'>";
			echo "alert('Rapport skapad');";
			echo "</script>";
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
			
        } else {
			echo 'Error Occurred';
			
			echo mysqli_error($dbc);
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    } else {
			
		echo 'Du måste fylla i följande data<br />';
        foreach($data_missing as $missing){
            echo "$missing <br />";
        }
    }  
}
?>