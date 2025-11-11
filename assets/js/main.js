const btnmenu = document.getElementById("btn-menu")
const btnclose = document.getElementById("btn-close")
const menu = document.getElementById("sidebar")
// const submenu = document.getElementById("sub-menu")

btnmenu.addEventListener("click", function(){
    menu.style.left = "0px"
})

btnclose.addEventListener("click", function(){
    menu.style.left = "-300px"
})
// btnclose.addEventListener("click", function(){
//     menu.classList.toggle("active")
// })
