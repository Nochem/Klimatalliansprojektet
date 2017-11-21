$(document).ready(function(){
    /*
    För rapport.html
    */
    $("#stattable > tr").each(function() {

        /*
        Tar fram outputboxen
        */
        var output=$(this).find('input.inputbox').eq(1);

        /*
        Hanterar avfokusering på inputboxen
        */
        $(this).find('input.inputbox').eq(0).focusout(function(event) {
            var val=parseInt($(this).val());
            if(!isNaN(val)){
                output.val(val.toFixed(2));
            }
            else{
                output.val("");
            }
        });
    });
	$("#addrow").click(function(){
		var table = document.getElementById("reportTable");
		var row = table.insertRow(table.length);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		cell1.innerHTML = "<input type='text' class='inputbox'/>";
		cell2.innerHTML = "<input type='text' class='inputbox'/>";
		cell3.innerHTML = "<input type='text' class='inputbox'/>";
		cell4.innerHTML = "<input type='text' class='inputbox'/>";

	});
	$("#logout").click(function(){
		var r = confirm("är du säker på att du vill logga ut?")
		if(r){
			document.getElementById("logout").action = "inloggning.html";
		}
	})

    $(".rensa").click(function(){
        var r = confirm("Rensa inmatad data?")
        if(r){
            $('.inputbox').val('');

        }
    })


});


