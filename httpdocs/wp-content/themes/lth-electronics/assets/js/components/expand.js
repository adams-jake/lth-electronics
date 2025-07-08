
import { slideUp, slideDown } from '../utility/transition'

/*
	usage: 
		expand(selector, (isOpen, button, content) => {})
	
		use aria-expanded="true" attribute to set initial state

		uses button's next sibling as content, or id provided in data-expand attribute:
			<button aria-expanded="false" data-expand="unique-expand-id"></button>
			<div id="unique-expand-id">
				Expandable content
			</div>
*/

const createExpand = (button, callback = () => { }, context = document) => {

	const expandState = button.getAttribute('aria-expanded') || "false"
	const contentId = button.getAttribute('data-expand')
	const content = contentId ? context.querySelector(`#${contentId}`) : button.nextElementSibling
	let isOpen = expandState.trim() === 'true' || expandState === ''
	let isFirstLoad = true

	const open = () => {
		isOpen = true
		button.setAttribute('aria-expanded', true)
		content.removeAttribute('hidden')

		if (isFirstLoad) {
			content.style.display = 'block'
		} else {
			slideDown(content)
		}
		callback(isOpen, button, content)
	}

	const close = () => {
		isOpen = false
		button.setAttribute('aria-expanded', false)
		content.setAttribute('hidden', '')
		callback(isOpen, button, content)

		if (isFirstLoad) {
			content.style.display = 'none'
		} else {
			slideUp(content)
		}
	}

	const toggle = (e) => {
		if (e) e.preventDefault()
		isOpen ? close() : open()
	}

	// initial state
	isOpen ? open() : close()
	isFirstLoad = false

	button.addEventListener('click', toggle)

	return {
		open, close, toggle
	}
}

export default (input, callback, context = document) => {
	if (input instanceof HTMLElement)
		return createExpand(input, callback, context)

	if (typeof input === 'string')
		return [...context.querySelectorAll(input)].map(el => createExpand(el, callback, context))
}