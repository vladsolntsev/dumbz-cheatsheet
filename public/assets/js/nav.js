/*  JS Navigation */
const burger = document.getElementById('burger');
const menuBurger = document.getElementById('menu-burger')
burger.addEventListener('click', event => {
    menuBurger.classList.toggle('sidebar-nav')
    burger.classList.toggle('burger-menu-white')
    document.getElementById('menu-burger').classList.toggle('display-block-nav');
})

/* End JS Navigation */