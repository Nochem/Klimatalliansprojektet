$(document).ready(function(){
    var labels=[];
    $("#content > form").each(function() {
        $(this).children('input').each(function() {
        });
    });
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
    		data: {
            labels: ["2014", "2015", "2016"],
            datasets: [{
    						label:"Transport",
                data: [500,500,400],
                backgroundColor: "rgba(180,50,50,1)",
                hoverBackgroundColor: "rgba(150,50,50,1)"
            },{
    						label:"Lokala processer",
                data: [600,600,500],
                backgroundColor: "rgba(50,180,50,1)",
                hoverBackgroundColor: "rgba(50,150,50,1)"
            },{

    						label:"Flygresor",
                data: [600,700,1000],
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
