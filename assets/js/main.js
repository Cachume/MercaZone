// const btnmenu = document.getElementById("btn-menu")
// const btnclose = document.getElementById("btn-close")
// const menu = document.getElementById("sub-menu-container")
// const submenu = document.getElementById("sub-menu")
const user_img = document.getElementById("user-img")

// btnmenu.addEventListener("click", function(){
//     menu.classList.toggle("active")
// })
// btnclose.addEventListener("click", function(){
//     menu.classList.toggle("active")
// })


user_img.addEventListener("click",function(){
    document.getElementById("user-options").classList.toggle("active")
})