
// run callback when an element is scrolled into view
// uses IntersectionObserver (polyfilled) in common-init.js

export default function asyncLoadOnScroll(el, callback, intPixelThreshold = -200) {
	if (!window.IntersectionObserver) return callback(el);
	const observer = new IntersectionObserver(handleIntersection, {
		rootMargin: `${intPixelThreshold}px 0px`,
		threshold: 0.01
	});
	observer.observe(el);
	function handleIntersection(entries, observer) {
		if (entries[0] && entries[0].intersectionRatio > 0) {
			observer.unobserve(el);
			callback(el);
		}
	}
}