import asyncLoadOnScroll from '../utility/asyncLoadOnScroll'

// load
const els = [...document.querySelectorAll('.load')]

els.map(scroll => {
    asyncLoadOnScroll(scroll, function(el) {
        el.classList.add('loaded')
    })
})
