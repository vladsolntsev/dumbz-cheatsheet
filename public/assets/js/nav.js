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
        if (event.target.classList.contains('fas')) {
            event.target.classList.remove('fas');
            event.target.classList.add('far');
        }  else {
            event.target.classList.add('fas');
        }

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
const dislike = document.getElementsByClassName('fa-thumbs-down');

for (let i = 0 ; i <like.length; i++) {
    like[i].addEventListener('click', (event) => {
        if (event.target.classList.contains('fas')) {
            event.target.classList.replace('fas', 'far');
        } else {
            event.target.classList.add('fas');
        }
        for ( let i = 0; i < dislike.length; i++ ) {
            if (dislike[i].classList.contains('fas')) {
                dislike[i].classList.remove('fas');
                dislike[i].classList.add('far');
            }
        }

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



for ( let i = 0; i < dislike.length; i++ ) {
    dislike[i].addEventListener('click', (event) => {
        if (event.target.classList.contains('fas')) {
            event.target.classList.replace('fas', 'far');
        } else {
            event.target.classList.add('fas');
        }
        for ( let i = 0; i < like.length; i++ ) {
            if (like[i].classList.contains('fas')) {
                like[i].classList.remove('fas');
                like[i].classList.add('far');
            }
        }

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

