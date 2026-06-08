// script sudah diupdate

// EFEK HOVER MENU
const menu = document.querySelectorAll("nav a");

menu.forEach(function(item){

    item.addEventListener("mouseover", function(){

        item.style.color = "#c2185b";

    });

    item.addEventListener("mouseout", function(){

        item.style.color = "#333";

    });

});

// ANIMASI CARD PRODUK
const card =
document.querySelectorAll(".card");

card.forEach(function(item){

    item.addEventListener("mouseover", function(){

        item.style.transform = "scale(1.03)";

    });

    item.addEventListener("mouseout", function(){

        item.style.transform = "scale(1)";

    });

});

// ANIMASI MUNCUL SAAT SCROLL
const cards =
document.querySelectorAll(".service-card");

window.addEventListener("scroll", function(){

    cards.forEach(function(card){

        const posisi =
        card.getBoundingClientRect().top;

        const layar =
        window.innerHeight;

        if(posisi < layar - 100){

            card.style.opacity = "1";

            card.style.transform =
            "translateY(0px)";

        }

    });

});

// BACK TO TOP
const topBtn =
document.getElementById("topBtn");

window.onscroll = function(){

    if(document.documentElement.scrollTop > 200){

        topBtn.style.display = "block";

    }else{

        topBtn.style.display = "none";

    }

}

topBtn.onclick = function(){

    window.scrollTo({

        top: 0,

        behavior: "smooth"

    });

}

