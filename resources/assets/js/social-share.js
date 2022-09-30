const socialShareLink = document.querySelectorAll('[data-share=true]');
if (socialShareLink && socialShareLink.length) {
    const size = {width: 500, height: 500}
    Array.from(socialShareLink).forEach(i => {
        i.addEventListener('click', e => {
            e.preventDefault();
            const verticalPos = Math.floor((window.innerWidth - size.width) / 2),
                horizontalPos = Math.floor((window.innerHeight - size.width) / 2);
            const url = i.getAttribute('href');
            const popup = window.open(url, "", "width=" + size.width + ",height=" + size.height + ",left=" + verticalPos + ",top=" + horizontalPos + ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1")
            if (popup) popup.focus();
        })
    })
}
