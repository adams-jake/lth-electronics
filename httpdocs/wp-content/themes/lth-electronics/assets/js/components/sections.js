function animateFullImageSections(sections) {
    sections.forEach((el) => {
        ScrollTrigger.create({
            trigger: el,
            start: "top top",  
            end:   "bottom top",
            pin: true,
            pinSpacing: false,
            anticipatePin: 1,
        })
    })
}


document.addEventListener("DOMContentLoaded", () => {
    const fullImageSections = gsap.utils.toArray(".full-image")
    animateFullImageSections(fullImageSections)
)}