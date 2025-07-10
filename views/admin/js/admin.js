var ventanatema = document.getElementById("ventanatema");
var fondotema = document.getElementById("fondotema");

btncatalogo.addEventListener("click", function (){

    ventanatema.style.display = "flex";

})

fondotema.addEventListener("click", function () {
    
    ventanatema.style.display ="none";

})

document.getElementById("closev").addEventListener("click", function (){
    ventanatema.style.display ="none";
})