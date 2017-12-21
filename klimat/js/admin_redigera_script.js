$(document).ready(function() {});

function addEmissionSource() {
  var modal = document.getElementById('addFieldModal');
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];

  modal.style.display = "block";
  $(".close").click(function() {
    modal.style.display = "none";
  });
  $("#confirmNew").click(function() {
    modal.style.display = "none";
  });
  $("#window").click(function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
}

function changeEmissionSource(EmissionSource, ConvFactor, EmissionCO2perMWh, Unit, Category) {
	document.getElementById("mInputName").value = EmissionSource;
	document.getElementById("mInputConvFactor").value = ConvFactor;
	document.getElementById("mInputCO2perMWh").value = EmissionCO2perMWh;
	document.getElementById("editFieldOptionBoxUnit").value = Unit;
	document.getElementById("editFieldOptionBoxCategory").value = Category;
	
  var modal = document.getElementById('changeUserModal');
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];
	
  modal.style.display = "block";
  $(".close").click(function() {
    modal.style.display = "none";
  });
  $("#confirmEdit").click(function() {
    modal.style.display = "none";
  });
  $("#window").click(function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
  
}

function refreshPage(){
	return confirm("hss");
	
}
	

