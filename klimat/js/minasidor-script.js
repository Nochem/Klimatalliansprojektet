$(document).ready(function(){
    $("#change").submit(function(){

    });
});

function validateForm() {
    
    var newPassconf = document.forms["passwchange"]["newpassconf"].value;
    var newpass = document.forms["passwchange"]["newpass"].value;
    var numMin=6;
	var numMax=20;

    if(newPassconf != "" &&  newpass!= ""){
        if (newpass != newPassconf) {
            document.getElementById("nomatch").innerHTML = "Lösenorden matchar inte";
            consol(newpass + " " + newpassconf);
            return false;
        }
        if(newpass.length < 6 && newPassconf.length < 6){
             document.getElementById("nomatch").innerHTML = "Lösenordet måste vara mellan " + numMin + " och " + numMax + " tecken långt.";
             return false;
        }
        alert("Lösenordet har ändrats");
        return true;

    }else{
        document.getElementById("nomatch").innerHTML = "Fälten matchar inte";
        return false;
    }
            

       
};
