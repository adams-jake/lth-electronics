const body = document.querySelector('body')
const button = document.querySelector('.mobile-nav')
const navigation = document.querySelector('.site-menu')
// const ove\rlay = document.querySelector('.mobile-nav__overlay')

let isOpen = false

function close() {
    isOpen = false
    animateOut(button)
    animateOut(navigation)
	body.classList.remove('overflow-fixed')
}

function open() {
    isOpen = true
    animateIn(button)
    animateIn(navigation)
    body.classList.add('overflow-fixed')
}

function toggle() {
	isOpen ? close() : open()
}

button.addEventListener('click', toggle)

// detect esc key
window.addEventListener('keydown', event => {
	const escKey = (event.key === 'Escape' || event.keyCode === 27)
	const isOpen = button.classList.contains('open')
	if (isOpen && escKey) toggle()
})

// Animations
function animateIn(el) {
	el.classList.add('state')
	setTimeout(() => {
		el.classList.add('open') 
	}, 200);
}

function animateOut(el) {
	el.classList.remove('open')
	setTimeout(() => {
		el.classList.remove('state')
	}, 500); 
}
