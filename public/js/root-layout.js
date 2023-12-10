const topBarDesktop = document.getElementById('topBarDekstop')
window.addEventListener('scroll', () => {
    // Check the scroll position, for example, when it goes beyond 100 pixels
    if (window.scrollY >= 100) {
        // Show the scroll indicator
        topBarDesktop.style.boxShadow = '0px 10px 20px 0px rgba(0,0,0,0.1)';
        topBarDesktop.style.transition = "all 1s"
    } else if (window.scrollY < 100){
         topBarDesktop.style.boxShadow = "none";
         topBarDesktop.style.transition = "all 1s"
    }
});