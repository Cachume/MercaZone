const btnmenu = document.getElementById("btn-menu")
const btnclose = document.getElementById("btn-close")
const menu = document.getElementById("sub-menu-container")
const submenu = document.getElementById("sub-menu")

btnmenu.addEventListener("click", function(){
    menu.classList.toggle("active")
})
btnclose.addEventListener("click", function(){
    menu.classList.toggle("active")
})