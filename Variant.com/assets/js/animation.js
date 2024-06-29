
/* ********************************************************************************************** */
// @2024 UTTAM PRAJAPATI
/* ********************************************************************************************** */ 



let dropdownTarget = Array.from(document.querySelectorAll("[data-dropdownTarget]"));
let iteamTarget = Array.from(document.querySelectorAll("[data-iteamTarget]"));



// ALL NAVIGATION ITEAMS
dropdownTarget.forEach(iteam => {
    iteam.addEventListener("click", (event) => {
        event.stopPropagation()
        hideActiveContainers(iteam)
        showContainer(iteam.getAttribute("data-dropdownTarget"), iteam)
    })
})





// MENU ITEAMS SUB CATEGORY
iteamTarget.forEach(iteam => {
    iteam.addEventListener("click", (event) => {
        event.stopPropagation()
        showContainer(iteam.getAttribute("data-iteamTarget"), iteam)
    })
})


function showContainer(elem, iteam) {
    Array.from(document.querySelectorAll(`[data-dropdownContainer='${elem}']`))
    .forEach(e => {
        e.classList.toggle("active")
    })
}

function hideActiveContainers(iteam){
    let iteamAtr = iteam.getAttribute("data-dropdownTarget")
    Array.from(document.querySelectorAll(`[data-dropdownContainer]`))
    .forEach(e => {
        if(iteamAtr != e.getAttribute("data-dropdownContainer")){
            e.classList.remove("active")
        }
    })
}




// Cart controll buttons 
const leftButton = Array.from(document.querySelectorAll("[data-carouselBtnLeft]"));
const rightButton = Array.from(document.querySelectorAll("[data-carouselBtnRight]"));


function leftScroll(elem) {
    document.querySelector(`[carouselSlider=${elem}]`).scrollBy({
        left: -1000,
        behavior: "smooth"
    });
}

function rightScroll(elem) {
    document.querySelector(`[carouselSlider=${elem}]`).scrollBy({
        left: 1000,
        behavior: "smooth"
    });
}

leftButton.forEach((e) => {
    e.addEventListener("click", () => {
        leftScroll(e.getAttribute("data-carouselBtnLeft"))
    })
});

rightButton.forEach((e) => {
    e.addEventListener("click", () => {
        rightScroll(e.getAttribute("data-carouselBtnRight"))
    })
});




// BENNER CAROUSEL ANIMATION

document.addEventListener('DOMContentLoaded', function () {

    const carousels = document.querySelectorAll('[data-image_wrapper]');

    carousels.forEach(carousel => {
        let currentIndex = 0;

        let carouselLenght = Array.from(carousel.querySelectorAll("[data-images]")).length

        let indicators = Array.from(carousel.nextElementSibling.querySelectorAll("li"))

        setInterval(() => {
            ++currentIndex

            updateCarousel(carousel, currentIndex, carouselLenght);
            updateIndictor(indicators, currentIndex, carouselLenght)
            if (currentIndex === carouselLenght) {
                currentIndex = 0
            }

        }, 4000);
    });

    function updateCarousel(carousel, index, carouselLenght = null) {
        if (index == carouselLenght) {
            carousel.scrollBy({
                left: `-${index * carouselLenght}000`
            })
        }
        else {
            carousel.scrollBy({
                left: 1000
            })
        }
    }

    function updateIndictor(indicators, currentIndex, carouselLenght) {

        indicators.forEach(iteam => {
            if (iteam.className.match("active")) {
                iteam.classList.remove("active")
            }
        })

        if (currentIndex === carouselLenght) {
            indicators[0].classList.add("active")
            return
        }
        indicators[currentIndex].classList.add("active")
    }

});
