import MediaBox from 'mediabox'

export default function videoLightbox() {
	let mb = document.querySelector(".mediabox")
    console.log(mb)
	if (mb) {
		mb.addEventListener('click', function (e) {
			e.preventDefault()
		})
		MediaBox('.mediabox', {
			'rel' : '0'
		})
	}
}