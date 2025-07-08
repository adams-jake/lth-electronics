

export const duration = (el) => {
	const style = getComputedStyle(el)
	if (
		!style ||
		!style.transitionDuration ||
		!parseFloat(style.transitionDuration)
	) return false
	return style.transitionDuration
}


export const after = (el, callback = () => {}) => {

	const handler = (event) => {
		// stop events bubbling up to other elements
		event && event.stopPropagation()
		// make sure we're only firing on the current elem's event and not its children
		if (event && el !== event.target) return false
		event && el.removeEventListener(event.type, handler)
		callback(event)
	}

	// add to handler list & remove old event listeners
	if (!el.__prev) el.__prev = []
	if (el.__prev.length) el.__prev.map(listener => el.removeEventListener('transitionend', listener))
	el.__prev.push(handler)

	el.addEventListener('transitionend', handler, false)

	// run straight away if there's no transition duration
	if (!duration(el)) handler()
}


export const slideUp = (el, callback) => {

	el.style.display = 'block'
	el.style.height = 'auto'
	el.style.overflow = 'hidden'
	if (!duration(el)) el.style.transition = 'height 200ms'
	el.getBoundingClientRect()

	el.style.height = `${el.clientHeight}px`
	el.getBoundingClientRect()

	after(el, () => {
		el.style.height = ''
		el.style.display = 'none'
		el.style.overflow = ''
		el.style.transition = ''
		typeof callback === 'function' && callback(el, false)
	})

	el.style.height = '0'
}


export const slideDown = (el, callback) => {

	el.style.display = 'block'
	el.style.height = 'auto'
	el.style.overflow = 'hidden'
	if (!duration(el)) el.style.transition = 'height 200ms'

	el.getBoundingClientRect() 
	const height = el.clientHeight

	el.style.height = '0'
	el.getBoundingClientRect()

	after(el, () => {
		el.style.height = ''
		el.style.overflow = ''
		el.style.transition = ''
		typeof callback === 'function' && callback(el, true)
	})

	el.style.height = `${height}px`
}


export const show = (el, className = '', callback = () => {}) => {
	el.style.display = 'block'
	el.getBoundingClientRect()
	after(el, () => {
		callback(el)
	})
	el.classList.add(className)
}


export const hide = (el, className = '', callback = () => {}) => {
	el.style.display = 'block'
	el.getBoundingClientRect()
	after(el, () => {
		el.style.display = 'none'
		callback(el)
	})
	el.classList.remove(className)
}