$(document).ready(function(){
    $("#change").submit(function(){

    });
});

function validateForm() {
    
    var newPassconf = document.forms["passwchange"]["newpassconf"].value;
    var newpass = document.forms["passwchange"]["newpass"].value;
    var num=6;

    if(newPassconf != "" &&  newpass!= ""){
        if (newpass != newPassconf) {
            document.getElementById("nomatch").innerHTML = "Passwords don't match";
            consol(newpass + " " + newpassconf);
            return false;
        }
        if(newpass.length < 6 && newPassconf.length < 6){
             document.getElementById("nomatch").innerHTML = "Password must be longer than " + num + " characters.";
             return false;
        }
        alert("Password change");
        return true;

    }else{
        document.getElementById("nomatch").innerHTML = "Fill in both feilds";
        return false;
    }
            

       
};
