document.addEventListener('scroll',function(){
    const navbarDetailFood = document.getElementById('navbar-detail-warung')
    const titleDetail = document.getElementById('titleDetail');
    const scrolled = window.scrollY;
    if(scrolled > 100){
        navbarDetailFood.style.marginTop = "0";
        navbarDetailFood.classList.add('backdrop-blur')
        titleDetail.classList.add('visible')
        titleDetail.classList.remove('invisible')
    } else if (scrolled < 100){
        navbarDetailFood.style.marginTop = "2.5rem";
        navbarDetailFood.classList.remove('backdrop-blur')
        titleDetail.classList.add('invisible')
        titleDetail.classList.remove('visible')
    }
})