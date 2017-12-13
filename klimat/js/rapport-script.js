$(document).ready(function(){
	var edited = false;
	$("#stattable > tr").each(function() {

        /*
        Tar fram outputboxen
        */
        var output=$(this).find('p.output');

        /*
        Hanterar avfokusering på inputboxen
        */
        $(this).find('input.inputbox').focusout(function(event) {
            var val=parseInt($(this).val());

            console.log(val);
            if(!isNaN(val)){
                var out=$(this).val();
                output.text(out);
                edited = true;
            }
            else{
                output.text("");
            }
        });
    });

     $(".rensa").click(function(){
        var r = confirm("Rensa inmatad data?")
        if(r){
            edited = false;
            $('.inputbox').val('');
            $( ".output" ).empty();


        }
    })
    
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
			var d = new Date();
			var n = d.getFullYear();
			var year = $("#modalInputYear");
			var reportName = $("#modalInputReportName");
			var name = $("#modalInputName");
			
			if(year.val()<=n && year.val()>1999){
				confirm("Rapport sparad");
				edited = false;
			return true;
			}else{
				confirm("kontrollera år");
			return false;

			}
		})

	$("#logout").click(function(){
		if(edited){
			var r = confirm("Du har inte sparat rapporten! Vill du logga ut ändå?")
		}else{
		var r = confirm("är du säker på att du vill logga ut?")
		}
		if(r){
			document.getElementById("logout").action = "login.php";
		}else{
			return false;
		}
	})
	$(".changeSite").click(function(){
		if(edited){
		alert("Du har inte sparat rapporten! Spara rapporten med sparaknappen eller rensa rapporten med rensaknappen om du inte vill spara")
			return false;
		}
	})

	$("#addrow").click(function(){
		alert("ny resa");
		var table = document.getElementById("reportTable");
		var placement = table.length;
		var row = table.insertRow(placement);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);

		cell1.innerHTML = "<input name='Departure[]' type='text' class='inputbox'/>";
		cell2.innerHTML = "<input name='Destination[]' type='text' class='inputbox'/>";
		cell3.innerHTML = "<input name='lengthKM[]' type='text' class='inputbox'/>";
		cell4.innerHTML = "<input name='kgCO2[]' type='text' class='inputbox'/>";
		
		/*
		cell1.innerHTML = "<input type='text' class='inputbox'/>";
		cell2.innerHTML = "<input type='text' class='inputbox'/>";
		cell3.innerHTML = "<input type='text' class='inputbox'/>";
		cell4.innerHTML = "<input type='text' class='inputbox'/>";
		
		*/
        window.scrollBy(0,50);
	});

});

