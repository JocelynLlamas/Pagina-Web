function mostrarSM(sm, m) {
    var menu = document.getElementById(m);
    var smenu = document.getElementById(sm);
    smenu.style.visibility = "visible";
    smenu.style.display = "block";

    var l = menu.offsetLeft;
    var t = menu.offsetTop;
    var h = menu.offsetHeight;

    smenu.style.left = l + "px";
    smenu.style.top = (t + h) + "px";
}
function ocultaSM(sm) {
    document.getElementById(sm).style.visibility = "hidden";
    document.getElementById(sm).style.display = "none"
}