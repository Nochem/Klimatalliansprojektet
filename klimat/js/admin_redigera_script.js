$(document).ready(function() {});

function changeEmissionSource(EmissionSource, ConvFactor, EmissionCO2perMWh, Unit, Category, EmissionSourceInfo) {
	document.getElementById("mInputName").value = EmissionSource;
  document.getElementById("mInputDeleteThis").value = EmissionSource;
	document.getElementById("mInputConvFactor").value = ConvFactor;
	document.getElementById("mInputCO2perMWh").value = EmissionCO2perMWh;
	document.getElementById("editFieldOptionBoxUnit").value = Unit;
	document.getElementById("editFieldOptionBoxCategory").value = Category;
		document.getElementById("editInfo").value = EmissionSourceInfo;


  var modal = document.getElementById('changeFieldModal');
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
function addEmissionSource() {
  var modal = document.getElementById('addFieldModal');
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];

  modal.style.display = "block";
  $(".close").click(function() {
    modal.style.display = "none";
  });
  $("#save").click(function() {
    modal.style.display = "none";
  });
  $("#window").click(function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
}
