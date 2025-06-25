btnlogin = document.getElementById("login");
btnregister = document.getElementById("register");
formlogin = document.getElementById("auth-login");
formregister = document.getElementById("auth-register");
textform = document.getElementById("textform")

var estadoform = 'login';

btnlogin.addEventListener('click',function(){
    
    if(estadoform != "login"){
        formregister.classList.add("hidden")
        formlogin.classList.remove("hidden")
        estadoform = "login"
        btnregister.classList.remove("selected");
        btnlogin.classList.add("selected");
        textform.innerHTML = "Inicia sesión para continuar"
    }
})

btnregister.addEventListener('click',function(){
    
    if(estadoform != "register"){
        formlogin.classList.add("hidden")
        formregister.classList.remove("hidden")
        estadoform = "register"
        btnregister.classList.add("selected");
        btnlogin.classList.remove("selected");
        textform.innerHTML = "Completa los campos para crear una cuenta nueva"
    }
})