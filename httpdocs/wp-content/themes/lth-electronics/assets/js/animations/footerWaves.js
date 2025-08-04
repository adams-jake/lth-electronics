import { gsap, ScrollTrigger, SplitText } from './gsapSetup';

function waveFooters(el) {

    const waveOne =  gsap.to([`.footer-wave__one`], {
        x: "-80vw",
        ease: "none",
        scrollTrigger: {
            trigger: el,
            start: "top bottom",
            end: "top top",
            scrub: 1.5,
            // markers: true
        }
    });


    const waveTwo =  gsap.to([`.footer-wave__two`], {
       x: "-110vw",
        ease: "none",
        scrollTrigger: {
            trigger: el,
            start: "top bottom",
            end: "top top",
            scrub: 1.5,
            // markers: true
        }
    });

}



[...document.querySelectorAll('.footer-wave')].map(waveFooters)





//   const container = document.querySelector('.footer');
//   const containerWidth = container.offsetWidth;

//   gsap.to(['.footer-wave__one', '.footer-wave__two'], {
//     x: containerWidth, // Moves 100% of footer width
//     duration: 2,
//     ease: "power2.inOut",
//     stagger: {
//       each: 0.2, // Slight stagger delay
//       from: "start"
//     },
// 	markers: true
//   });