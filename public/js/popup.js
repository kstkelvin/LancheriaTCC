var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[1];

var close = document.getElementsByClassName("shutoff")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

close.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function disablefield(){
  if (document.getElementById('payment_1').checked == 1){
    document.getElementById('payment').disabled='disabled';
    document.getElementById('payment').value='disabled';
  }else{
    document.getElementById('payment').disabled='';
    document.getElementById('payment').value='Allowed'; }
  }
