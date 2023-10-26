document.addEventListener('scroll',function(){
    const navbarDetailMakanan = document.getElementById('navbar-detail-makanan')
    const titleDetail = document.getElementById('titleDetail');
    const scrolled = window.scrollY;
    if(scrolled > 100){
        navbarDetailMakanan.style.marginTop = "0";
        navbarDetailMakanan.classList.add('backdrop-blur')
        titleDetail.classList.add('visible')
        titleDetail.classList.remove('invisible')
    } else if (scrolled < 100){
        navbarDetailMakanan.style.marginTop = "2.5rem";
        navbarDetailMakanan.classList.remove('backdrop-blur')
        titleDetail.classList.add('invisible')
        titleDetail.classList.remove('visible')
    }
})