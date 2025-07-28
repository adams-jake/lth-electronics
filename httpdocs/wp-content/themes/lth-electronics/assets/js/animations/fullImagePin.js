import {ScrollTrigger } from "./gsapSetup";

function animateFullImageSections(el) {
    ScrollTrigger.create({
        trigger: el,
        start: "top top",  
        end:   "bottom top",
        pin: true,
        pinSpacing: false,
        anticipatePin: 1,
    })
}

document.addEventListener("DOMContentLoaded", () => {
    [...document.querySelectorAll('.full-image')].map(animateFullImageSections)
})