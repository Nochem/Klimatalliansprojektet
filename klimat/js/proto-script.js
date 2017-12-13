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
                output.val("");
            }
        });
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

        }
    })


});
