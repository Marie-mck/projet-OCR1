
let menuDrop = document.querySelector('.subMenuNav');

    menuDrop.addEventListener('click', (e) => {

        if (document.querySelector('.dropMenu').style.display === "none") {
            document.querySelector('.dropMenu').style.display = "block";
        } else {
            document.querySelector('.dropMenu').style.display = "none";
        }
    });