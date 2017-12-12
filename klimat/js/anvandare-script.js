$(document).ready(function() {});

function changeUser(row) {
  var name = document.getElementById(row + "-name").innerHTML;
  var password = document.getElementById(row + "-password").innerHTML;
  var email = document.getElementById(row + "-email").innerHTML;
  var telephone = document.getElementById(row + "-telephone").innerHTML;
  var active = document.getElementById(row + "-active").innerHTML;

  document.getElementById("userNbr").value = row;
  document.getElementById("userNbrD").value = row;

  if (active == 1) {
    document.getElementById("mInputActiveYes").checked = active;
  } else {
    document.getElementById("mInputActiveNo").checked = true;
  }
  document.getElementById("mInputName").value = name;
  document.getElementById("mInputPassword").value = password;
  document.getElementById("mInputEmail").value = email;
  document.getElementById("mInputTelephone").value = telephone;

  var modal = document.getElementById('changeUserModal');
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

function addUser() {
  var modal = document.getElementById('addUserModal');
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
