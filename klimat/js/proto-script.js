$(document).ready(function(){
    /*
    För rapport.html
    */
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
            }
            else{
                output.text("");
            }
        });
    });
	$("#addrow").click(function(){
		var table = document.getElementById("reportTable");
		var placement = table.length;
		var row = table.insertRow(placement);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		cell1.innerHTML = "<input type='text' class='inputbox'/>";
		cell2.innerHTML = "<input type='text' class='inputbox'/>";
		cell3.innerHTML = "<input type='text' class='inputbox'/>";
		cell4.innerHTML = "<input type='text' class='inputbox'/>";
        window.scrollBy(0,50);
	});
	$("#logout").click(function(){
		var r = confirm("är du säker på att du vill logga ut?")
		if(r){
			document.getElementById("logout").action = "login.php";
		}
	})

    $(".rensa").click(function(){
        var r = confirm("Rensa inmatad data?")
        if(r){
            $('.inputbox').val('');
            $( ".output" ).empty();


        }
    })


});


