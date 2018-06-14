function delete_confirm_product() {
  if (confirm("Tem certeza de que deseja excluir este produto?")) {
    return true;
  } else {
    return false;
  }
}

function delete_confirm_client() {
  if (confirm("Tem certeza de que deseja excluir este cliente?")) {
    return true;
  } else {
    return false;
  }
}

function delete_confirm_sell() {
  if (confirm("Tem certeza de que deseja apagar esta venda?")) {
    return true;
  } else {
    return false;
  }
}

function delete_confirm_cancel() {
  if (confirm("Tem certeza de que deseja cancelar a venda?")) {
    return true;
  } else {
    return false;
  }
}

function i_dont_know(){
  location.reload(true);
  setTimeout(window.open('/pagamento/abrir'), 5000);
}

$(document).ready(function() {
  var sideslider = $('[data-toggle=collapse-side]');
  var sel = sideslider.attr('data-target');
  var sel2 = sideslider.attr('data-target-2');
  sideslider.click(function(event){
    $(sel).toggleClass('in');
    $(sel2).toggleClass('out');
  });
});

var modal3 = document.getElementById("myModal3");

// Get the button that opens the modal
var btn3 = document.getElementById("myBtn3");

// Get the <span> element that closes the modal
var span3 = document.getElementsByClassName("close")[0];


// When the user clicks on the button, open the modal
btn3.onclick = function() {
  modal3.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span3.onclick = function() {
  modal3.style.display = "none";
}

close3.onclick = function() {
  modal3.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal3) {
    modal3.style.display = "none";
    modal2.style.display = "none";
    modal.style.display = "none";
  }

}
