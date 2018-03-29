function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginRight = "0";
}

function openNav() {
  if ($(window).width() < 768) {
    document.getElementById("mySidenav").style.width = "100%";
    document.getElementById("main").style.marginRight = "30%";
  }
  else {
    document.getElementById("mySidenav").style.width = "20%";
    document.getElementById("main").style.marginRight = "20%";
  }


}
