$(document).ready(function(){
    var edited = false;

    $(".rensa").click(function(){
        var r = confirm("Rensa inmatad data?")
        if(r){
            edited = false;
            $('.inputbox').val('');
            $('.outputbox').val('');
            var x = document.getElementsByName("tonCO[]");
            for(i = 0; i< x.length; i++){
                document.getElementsByName("tonCO[]")[i].innerHTML = "";
                document.getElementsByName("ton[]")[i].innerHTML = "";
            }


        }
    })

    $(".inputbox").keypress(function(){
        edited = true;
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
    /*$("body").click(function(event) {
        console.log("Here");
        if (!$(event.target).closest('#myModal').length && !$(event.target).is('#myModal')) {
            modal.style.display="none";
        }
    })*/
    // kontrollerar sÃƒÂ¥ att ÃƒÂ¥ret bestÃƒÂ¥r av 4 tecken
    $("#saveCheck").click(function(){
        var d = new Date();
        var n = d.getFullYear();
        var year = $("#modalInputYear");
        var reportName = $("#modalInputReportName");
        var name = $("#modalInputName");
	var oldYears = $("#reportedYears");
		
	if(name.val() == "" || reportName.val() == "" || year.val() == ""){
		alert("Kontrollera tomma fält");
        	edited = false;
		return false;
        }else if(year.val()> n || year.val()<1999){
		alert("Kontrollera året");
		return false;
	}else if(oldYears.val().includes(year.val())){
  		alert("Detta år är redan inrapporterat");
  		return false;
	}else{
		alert("Rapporten är sparad");
		return true;
        }
    })

    $("#logout").click(function(){
        if(edited){
            var r = confirm("Du har inte sparat rapporten! Vill du logga ut ändå?")
        }else{
            var r = confirm("Är du säker på att du vill logga ut?")
        }
        if(r){
            document.getElementById("logout").action = "logout.php";
        }else{
            return false;
        }
    })
  $(".changeSite").click(function(){
        if(edited){
            var c = confirm("Du har inte sparat rapporten! Är du säker på att du vill lämna sidan utan att spara?")
            if(c){
				return true;
			}else{
				return false;
				
            }
        }
    });
    $("#addrow").click(function(){
        var table = document.getElementById("reportTable");
        var nbr = document.getElementById("nbrofRowsFlight").value;
        nbr = parseInt(nbr);
        nbr = nbr + 1;
        document.getElementById("nbrofRowsFlight").value = nbr;
        var placement = table.length;
        var row = table.insertRow(placement);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        cell1.innerHTML = "<input name='Departure[]'type='text' class='inputbox'/>";
        cell2.innerHTML = "<input name='Destination[]' type='text' class='inputbox'/>";
        cell3.innerHTML = "<input name='lengthKM[]' type='text' class='inputbox'/>";
        cell4.innerHTML = "<input name='kgCO2[]' type='text' class='inputbox'/>";
        cell5.innerHTML = "<input type='button' value='X' id='close-button'>";
        window.scrollBy(0,50);
    });
    $("#reportTable").on('click', 'input[type="button"]', function(){

        $(this).closest('tr').remove();
        var nbr = document.getElementById("nbrofRowsFlight").value;
        nbr = parseInt(nbr);
        nbr = nbr - 1;
        document.getElementById("nbrofRowsFlight").value = nbr;


    });
});
