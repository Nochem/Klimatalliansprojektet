<?php
if(isset($_POST['submit'])){
    $data_missing = array();
	
    if(empty($_POST['bensin'])){
        $data_missing[] = 'Bensin';
		
    } else {
        $bensin = trim($_POST['bensin']);
    }
	
	 if(empty($_POST['diesel'])){
        $data_missing[] = 'Diesel';
		
    } else {
        $diesel = trim($_POST['diesel']);
    }
	
	 if(empty($_POST['diesel24'])){
        $data_missing[] = 'Diesel 24% förnyrbar';
		
    } else {
        $diesel24 = trim($_POST['diesel24']);
    }
	
	 if(empty($_POST['dieselPreemEvo'])){
        $data_missing[] = 'Diesel Preem Evolution';
		
    } else {
        $dieselPreemEvo = trim($_POST['dieselPreemEvo']);
    }
	
	 if(empty($_POST['rme'])){
        $data_missing[] = 'RME';
		
    } else {
        $rme = trim($_POST['rme']);
    }
	
	 if(empty($_POST['etanol'])){
        $data_missing[] = 'Etanol';
		
    } else {
        $etanol = trim($_POST['etanol']);
    }
	
	 if(empty($_POST['hvo'])){
        $data_missing[] = 'HVO';
		
    } else {
        $hvo = trim($_POST['hvo']);
    }
	
	 if(empty($_POST['miljoMarktElFordon'])){
        $data_missing[] = 'Miljömärkt el till fordon';
		
    } else {
        $miljoMarktElFordon = trim($_POST['miljoMarktElFordon']);
    }
	
	 if(empty($_POST['ospecElFordon'])){
        $data_missing[] = 'Ospecifierad el till fordon';
		
    } else {
        $ospecElFordon = trim($_POST['ospecElFordon']);
    }
	
	 if(empty($_POST['ovrigtDrivmedel'])){
        $data_missing[] = 'Övrigt drivmedel';
		
    } else {
        $ovrigtDrivmedel = trim($_POST['ovrigtDrivmedel']);
    }
	
	 if(empty($_POST['bilTjanst'])){
        $data_missing[] = 'Privatbil';
		
    } else {
        $bilTjanst = trim($_POST['bilTjanst']);
    }
	
	 if(empty($_POST['hyrbil'])){
        $data_missing[] = 'Hyrbil';
		
    } else {
        $hyrbil = trim($_POST['hyrbil']);
    }
	
    if(empty($data_missing)){
		require_once('mysqli_connect.php');
       
		foreach($data){
			
			
		}
		$convFactor = "SELECT convFactor FROM ConversionFactors WHERE EmissionSource = ?"
		$stmt1 = mysqli_prepare($dbc, $convFactor);
		
		foreach($dataAdded as $data){
			$emissionSource = $data
			
		}
				mysqli_stmt_execute($stmt1);

		
		mysqli_stmt_bind_param($stmt1, "s" , $emissionSource);
		$affected_rows = mysqli_stmt_affected_rows($stmt1);
		
		
        $query = "INSERT INTO Transport(EmissionSource, Unit, TonCO2, convFactor, EnergyMWh, EmissionMWh, Id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $query);
		/*	
			i Integers
			d Doubles
			b Blobs
			s Everything Else  
		*/
	
		mysqli_stmt_bind_param($stmt, "ssddddi" , $ , $bensin);
		
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
			echo 'Error Occurred: ';
			
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