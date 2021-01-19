
let boutons = document.querySelectorAll(".signalerBouton");

boutons.forEach(element => {
    
    element.addEventListener('click', (e) => {

        e.preventDefault();
        e.originalTarget.parentNode.querySelector(".content").innerHTML = "Ce commentaire est en cours de validation après signalement";
        
        e.originalTarget.style.backgroundColor = "red";
        e.originalTarget.innerHTML = "Déjà signalé";
        
    
        fetch(e.originalTarget.dataset.href)
            .then(function(response) {
                var contentType = response.headers.get("content-type");
                if(contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json().then(function(json) {
                        console.log(json);
                    });
                    } else {
                    console.log("Oops, nous n'avons pas du JSON!");
                    }
                }
            )
            .catch(function(error) {
                console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
        });

        let url = e.originalTarget.dataset.href;
        console.log(url);
    });
});
