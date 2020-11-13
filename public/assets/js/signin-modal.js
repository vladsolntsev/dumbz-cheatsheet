$(document).ready(function () {
    if (window.location.href.indexOf('#registration') != -1) {
        $('#registration').modal('show');
    }
});

$(document).ready(function () {
    if (window.location.href.indexOf('#login') != -1) {
        $('#login').modal('show');
    }
});

/*
$.ajax({
    url: "/MySpace/add",
    type: "POST",
    dataType: "json",
    data: {action:"errorsAjax",name:nameError, password:passwordError},
    success: function(res){
        $('#login').modal()
        console.log(res);

    }
})

const error = document.getElementById('sendLogin');

    error.addEventListener('click', (event) => {
        fetch('/MySpace/check', {
            method: 'POST',
            headers: {
                'Accept' : 'application/json',
                'Content-type' : 'application/json'
            },
            body: JSON.stringify({
                'nameError': error,
                'passwordError' : error
            })
        })
            .then(response => response.json())
            .then(data => console.log(data))
    })
    */



