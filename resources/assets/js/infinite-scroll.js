export const infiniteScroll = (callback) => {
    window.addEventListener('scroll',() => {
        const {
            scrollTop,
            scrollHeight,
            clientHeight
        } = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 5) {
            callback();
        }
    });
}
