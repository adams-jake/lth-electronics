import { gsap, ScrollTrigger, SplitText } from './gsapSetup';

function animateHeadings(el) {

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
}


document.fonts.ready.then(() => {
    [...document.querySelectorAll('.heading-1, .heading-2')].map(animateHeadings)
})