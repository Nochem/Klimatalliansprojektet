$(document).ready(function(){
    
	// window.onbeforeunload = function(){
	// 	return "";
	// };

	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 	
	$(".modalSave").click(function() {
		
	    modal.style.display = "block";

	})
	// When the user clicks on <span> (x), close the modal
	$(".close").click(function() {
	    modal.style.display = "none";
	   // modal.attr("display","none");
	})
	$("#save").click(function() {
	    modal.style.display = "none";
	   // modal.attr("display","none");
	})

	// When the user clicks anywhere outside of sthe modal, close it
	$("#window").click(function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	})
	// kontrollerar så att året består av 4 tecken
	$("#saveCheck").click(function(){
			var year = $("#modalInputYear");
			var reportName = $("#modalInputReportName");
			var name = $("#modalInputName");
			
			if(year.val()<2050 && year.val()>1999){
				confirm("Rapport sparad");
				
			return true;
			}else{
				confirm("kontrollera år");
			return false;

			}


		})



});
