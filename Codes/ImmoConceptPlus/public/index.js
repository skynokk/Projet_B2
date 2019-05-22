function changeImage(element) {
    var x = document.getElementById("favoris");
    var v = x.getAttribute("src");
    if (v == "/images/1.png")(v = "/images/2.png");
    else
        (v = "/images/1.png");
    x.setAttribute("src", v);
}