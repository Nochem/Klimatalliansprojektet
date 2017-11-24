$(document).ready(function(){
	
		var labels=[];
		var yearfrom = $("#yearselectfrom option:selected").text();
		var yearto = $("#yearselectto option:selected").text();
		var cars = [];
		var lokala = [];
		var transporter = [];
		var flygresor = [];
		for (i = yearfrom; i <= yearto; i++) { 
			cars.push(i);
			var x = Math.floor((Math.random() * 1000));
			lokala.push(x);
			var x = Math.floor((Math.random() * 1000));
			transporter.push(x);
			var x = Math.floor((Math.random() * 1000));
			flygresor.push(x);
			//lokala.push($sql select from lokalaprocesser where companyname = companyname;) 
			//transporter.push($sql select from lokalaprocesser where companyname = companyname;
			//lokala.push($sql select from lokalaprocesser where companyname = companyname;)
			}


		
		var ctx = document.getElementById("myChart").getContext('2d');
		
			var myChart = new Chart(ctx, {	
				type: 'bar',
			
				data: {
				labels: cars,
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
