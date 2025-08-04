
"use strict"

// import componentName from './path/to/componentName'
import expand from './components/expand'
import asyncLoadOnScroll from './utility/asyncLoadOnScroll'
import videoLightbox from './components/video'
import logoCarousel from './components/logoCarousel'

import './components/navigation'
import './components/load-row'

// Animations
import './animations/gsapSetup'
import './animations/headings'
import './animations/fullImagePin'
import './animations/footerWaves'

// videoLightbox()
logoCarousel()

expand('.accordion__button', (open, button, content) => {
	const openClass = 'is-open'
	open ? button.parentNode.classList.add(openClass) : button.parentNode.classList.remove(openClass)
})

document.documentElement.classList.remove('no-js')
document.documentElement.classList.add('js')




// learn GSAP and ScrollTrigger today
// unlock over 200 premium video lessons
// https://www.creativecodingclub.com/bundles/creative-coding-club



// const sections = gsap.utils.toArray(".heading-2");

// window.onload = () => {

// 	sections.forEach((section, index) => {
// 		const heading = section.querySelector('.heading-2')
		
// 		let split = SplitText.create(section, { type: "words,chars" });
		
// 		//create an animation for each heading
// 		let animation = gsap.from(split.chars, { 
// 			y: 20,
// 			opacity: 0,
// 			stagger: 0.005,
// 			duration: 0.5,
// 			ease: "quad.out"
// 		});
		
// 			ScrollTrigger.create({
// 				trigger: section,
// 				start: "top 90%",
// 				toggleActions: "play none none",
// 				animation: animation,
// 				// markers: true
// 			});



// 	})
// }



// const fullImageSections = gsap.utils.toArray(".full-image");

// fullImageSections.forEach((section, index) => {
// 	ScrollTrigger.create({
// 		trigger: section,
// 		start: "top top",  
// 		end:   "bottom top",
// 		pin: true,
// 		pinSpacing: false,
// 		anticipatePin:
// 	});
// })




document.querySelectorAll('a.scroll-to-content').forEach(link => {
link.addEventListener('click', function(e) {
	e.preventDefault(); // Stop URL fragment from appearing

	const targetId = this.getAttribute('href').substring(1); // Remove '#'
	const target = document.getElementById(targetId);

	if (target) {
		target.scrollIntoView({ behavior: 'smooth' }); // Optional: smooth scroll
	}
});
});

