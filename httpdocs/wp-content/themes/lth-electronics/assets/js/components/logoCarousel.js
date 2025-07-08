import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

import 'swiper/css/bundle';

export default () => {

	const els = [...document.querySelectorAll('.logo-carousel__row')]

	els.map(el => {

		const carouselEl = el.querySelector('.logo-carousel')
		const carouselPrev = el.querySelector('.swiper-carousel__prev')
		const carouselNext = el.querySelector('.swiper-carousel__next')

		if (!carouselEl) return null

		return new Swiper(carouselEl, {
			modules: [ Navigation ],
			speed: 500,
			slidesPerView: 1,
			slidesPerGroup: 1,
			loop: true,
            navigation: {
                nextEl: carouselNext,
                prevEl: carouselPrev,
            },
			breakpoints: {
				780: { 
					slidesPerView: 2,
					slidesPerGroup: 1
				},
				1124: { 
					slidesPerView: 3,
					slidesPerGroup: 1
				},
				1650: { 
					slidesPerView: 4,
					slidesPerGroup: 1
				},
			},
		})
	})
}