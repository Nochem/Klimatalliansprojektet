$(document).ready(function(){
<?php 
include "mysqli_connect.php";
include "session.php";


$sql = "select a.User, a.Year, sum(b.TonCO2) as TonCO2 from Report as a left join Transport as b on a.id = b.id where a.user = '{$row['Name']}' group by a.User, a.year";
$sql1 = "select a.User, a.Year, sum(b.TonCO2) as TonCO2 from Report as a left join PlacesAndProcesses as b on a.id = b.id where a.user = '{$row['Name']}' group by a.User, a.year";
$sql2 = "select a.Year, a.User, (ifnull(sum(TotalAmount),0) + ifnull(sum(b.KgCO2)/1000,0)) as TonCO2 from Report as a left join Flights as b on a.id = b.id left join OtherFlight as c on a.id = c.id where a.user = '{$row['Name']}' group by a.user, a.year ";


$resultTransport = $dbc->query($sql);
$resultLokala = $dbc->query($sql1);
$resultFlygresor = $dbc->query($sql2);
$x = 0;
while($rowTransport = $resultTransport->fetch_array())
{
$rowLokala = $resultLokala->fetch_array();
$rowFlygresor = $resultFlygresor->fetch_array();
	
$years[$x] = $rowTransport['Year'];
$transportValues[$x] = $rowTransport['TonCO2'];
$lokalaValues[$x] = $rowLokala['TonCO2'];
$flygresorValues[$x] = $rowFlygresor['TonCO2'];
$x++;
}


?>
	
		
		var yearfrom = "<?php echo $years[0]; ?>"
		var yearto = "<?php echo $years[$x-1]; ?>"
		var labels= [];
		var lokala = [];
		var transporter = [];
		var flygresor = [];

			
			<?php 
			for($i = 0; $i < sizeof($years); $i++){
			?>
		    labels.push("<?php echo $years[$i]; ?>");
			transporter.push("<?php echo $transportValues[$i]; ?>");
			lokala.push("<?php echo $lokalaValues[$i]; ?>");
			flygresor.push("<?php echo $flygresorValues[$i]; ?>");
			<?php 
			} 
			?>
			
			
		
		var ctx = document.getElementById("myChart").getContext('2d');
		
			var myChart = new Chart(ctx, {	
				type: 'bar',
			
				data: {
				labels: labels,
				datasets: [{
								label:"Transport",
					data: transporter, // data: transport,
					backgroundColor: "rgba(180,50,50,1)",
					hoverBackgroundColor: "rgba(150,50,50,1)"
				},{
								label:"Lokala processer",
					data: lokala,//data:lokala,
					backgroundColor: "rgba(50,180,50,1)",
					hoverBackgroundColor: "rgba(50,150,50,1)"
				},{

								label:"Flygresor",
					data: flygresor,//data:flygresor,
					backgroundColor: "rgba(50,50,180,1)",
					hoverBackgroundColor: "rgba(50,50,150,1)"
				}]
			},
			options: {
					responsive:true,
				scales: {
					xAxes: [{
						barThickness:50,
						stacked:true
					}],
					yAxes: [{
						stacked:true
					}]
				}
			}
		});
			
	
});
