/*  JS Navigation */
const burger = document.getElementById('burger');
const menuBurger = document.getElementById('menu-burger')
burger.addEventListener('click', event => {
    menuBurger.classList.toggle('sidebar-nav')
    burger.classList.toggle('burger-menu-white')
    document.getElementById('menu-burger').classList.toggle('display-block-nav');
})

/* End JS Navigation */

const stars = document.getElementsByClassName('fa-star');
for (let i = 0 ; i <stars.length; i++) {
    stars[i].addEventListener('click', (event)=>    {
        event.target.classList.add('fas')
        fetch('/favorite/add', {
            method: 'POST',
            headers: {
                'Accept' : 'application/json',
                'Content-type' : 'application/json'
            },
            body: JSON.stringify({
                'cheatsheet': event.target.dataset.postid,
                'userid' :event.target.dataset.userid
            })
        })
            .then(response => response.json())

    })
}