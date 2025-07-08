
"use strict"

// import componentName from './path/to/componentName'
import expand from './components/expand'
import asyncLoadOnScroll from './utility/asyncLoadOnScroll'
import videoLightbox from './components/video'
import logoCarousel from './components/logoCarousel'
import './components/navigation'
import './components/load-row'

videoLightbox()
logoCarousel()

expand('.accordion__button', (open, button, content) => {
	const openClass = 'is-open'
	open ? button.parentNode.classList.add(openClass) : button.parentNode.classList.remove(openClass)
})

document.documentElement.classList.remove('no-js')
document.documentElement.classList.add('js')