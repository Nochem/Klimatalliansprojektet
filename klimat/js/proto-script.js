$(document).ready(function(){
    /*
    För rapport.html
    */
    
    
	
	$("#logout").click(function(){
		var r = confirm("är du säker på att du vill logga ut?")
		if(r){
			document.getElementById("logout").action = "login.php";
		}
	})

   


});


