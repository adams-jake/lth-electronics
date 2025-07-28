function animateHeadings(sections) {
    sections.forEach((el) => {

        let split = SplitText.create(el, { type: "words,chars" });

        let animation = gsap.from(split.chars, {
            y: 20,
            opacity: 0,
            stagger: 0.005,
            duration: 0.5,
            ease: "quad.out"
        })

        ScrollTrigger.create({
            trigger: el,
            start: "top 90%",
            toggleActions: "play none none",
            animation: animation,
            // markers: true
        })
    })
}


const fullImageSections = gsap.utils.toArray(".full-image");

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

window.onload = () => {
    const headingOne = gsap.utils.toArray(".heading-1");
    const headingTwo = gsap.utils.toArray(".heading-2");
    animateHeadings(headingOne)
    animateHeadings(headingTwo)

    const fullImageSections = gsap.utils.toArray(".full-image");
    animateFullImageSections(fullImageSections)
}
