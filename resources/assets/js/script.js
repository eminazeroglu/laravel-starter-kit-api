import {Fancybox} from "@fancyapps/ui";

require('./social-share')

const mobileButton = document.querySelectorAll('.js-mobileButton');
const mobileMenu = document.getElementById('mobileMenu');
Array.from(mobileButton).forEach((i) => {
    i.addEventListener('click', () => {
        const actionType = i.getAttribute('data-type')
        if (actionType === 'open') {
            mobileMenu.classList.add('!left-0')
        } else if (actionType === 'close') {
            mobileMenu.classList.remove('!left-0')
        }
    })
})

Fancybox.bind('[data-fancybox="image"]', {
    Toolbar: {
        display: [
            "fullscreen",
            "zoom",
            "download",
            "close",
        ]
    }
});

