		$(document).ready(function(){
		<?php 
		include "mysqli_connect.php";
		include "session.php";

		$sqlSum = "select a.id, a.User, a.Year, ( ifnull(sum(b.transport),0) + ifnull(sum(c.lokala), 0) + ifnull(sum(d.flyg),0) + ifnull(sum(e.flyg2),0) ) as TonCO2 from Report as a left join (select id, sum(TonCO2) as transport from Transport group by id) as b on a.id = b.id left join (select id, sum(TonCO2) as lokala from PlacesAndProcesses group by id) as c on a.id = c.id left join (select id, sum(KgCO2/1000) as flyg from Flights group by id) as d on a.id = d.id left join (select id, sum(TotalAmount/1000) as flyg2 from OtherFlight group by id) as e on a.id = e.id group by a.id order by a.year, a.user asc"; 
		$sqlUsers = "select distinct User from Report order by User asc";
		$sqlYears = "select distinct Year from Report order by Year asc";

		$resultSum = $dbc->query($sqlSum);
		$resultUsers = $dbc->query($sqlUsers);
		$resultYears = $dbc->query($sqlYears);
		 

		$x = 0;
		while($rowUsers = $resultUsers->fetch_array()	)
		{
			
		$users[$x] = $rowUsers['User'];

		$x++;
		}
		$x = 0;
		while($rowSum = $resultSum->fetch_array()	)
		{
			
		$reportYears[$x] = $rowSum['Year'];
		$values[$x] = $rowSum['TonCO2'];
		$name[$x] = $rowSum['User'];

		$x++;
		}
		$x = 0;

		while($rowYears = $resultYears->fetch_array()	)
		{
			
		$years[$x] = $rowYears['Year'];

		$x++;
		}

		?>
			
				
				var yearfrom = "<?php echo $years[0]; ?>"
				var yearto = "<?php echo $years[$x-1]; ?>"
				var labels = [];
				var namn = [];
				var varden = [];
				var ar = [];
				var users = [];
				
				<?php 
					for($i = 0; $i < sizeof($users); $i++){
				?>
					users.push("<?php echo $users[$i]; ?>");
				<?php 
					} 
				?>
				
				var values = [];
				for(i = 0; i < users.length; i++){
					values.push([]);
				}
				
				<?php 
					for($i = 0; $i < sizeof($values); $i++){
				?>
				
					varden.push("<?php echo $values[$i]; ?>");
					ar.push("<?php echo $reportYears[$i]; ?>");
					namn.push("<?php echo $name[$i]; ?>");
					
				<?php 
					} 
				?>
				
				var y = 0;
				<?php 
					for($i = 0; $i < sizeof($years); $i++){
				?>
					labels.push("<?php echo $years[$i]; ?>");
					for(i = 0; i < users.length; i++){
						if(users[i] == namn[y] && labels[<?php echo $i ?>] == ar[y]){
							values[i].push(varden[y]);
							y++;
						} else {
							values[i].push(0);
						}
					}
				<?php 
					} 
				?>
				
				
				var backgroundColors = []
				var hoverBackgroundColors = []
				for(i = 0; i < users.length; i++){
					
					backgroundColors.push("rgba(0," + parseInt((255/users.length)*i) + ",255,1)");
					hoverBackgroundColors.push("rgba(0,0,200,1)");
				}
				var bars = [];
				for(i = 0; i < users.length; i++){
					var hej = 	{
									label: users[i],
									data: values[i], 
									backgroundColor: backgroundColors[i]
									//hoverBackgroundColor: hoverBackgroundColors[i]
								}
					bars.push(hej);
				}
					
					
				
				var ctx = document.getElementById("myChart").getContext('2d');
				
					var myChart = new Chart(ctx, {	
						type: 'bar',
					
						data: {
						labels: labels,
						datasets: bars
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
