/*  JS Navigation */
const burger = document.getElementById('burger');
const menuBurger = document.getElementById('menu-burger')
burger.addEventListener('click', event => {
    menuBurger.classList.toggle('sidebar-nav')
    burger.classList.toggle('burger-menu-white')
    document.getElementById('menu-burger').classList.toggle('display-block-nav');
})

/* End JS Navigation */

/* JS Favorites */
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

/* END JS Favorites */

/* JS Like and dislike */

const like = document.getElementsByClassName('fa-thumbs-up');
for (let i = 0 ; i <like.length; i++) {
    like[i].addEventListener('click', (event)=> {
        event.target.classList.add('fas');
        console.log(event.target.dataset.postid);
        console.log(event.target.dataset.userid);
        fetch('/like/addLike', {
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
            .then(data => console.log(data))
    })
}



const dislike = document.getElementsByClassName('fa-thumbs-down');
for (let i = 0 ; i < dislike.length; i++) {
    dislike[i].addEventListener('click', (event)=> {
        event.target.classList.add('fas');
        fetch('/like/addDislike', {
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
            .then(data => console.log(data))
    })
}