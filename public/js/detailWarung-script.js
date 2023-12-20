const NavCheckbox = document.getElementById('NavCheckbox');
const NavLikeButton = document.getElementById('NavLikeButton');
NavCheckbox.addEventListener('change', function () {
    NavLikeButton.classList.toggle('active', NavCheckbox.checked);
});

const CardCheckbox = document.getElementById('CardCheckbox');
const CardLikeButton = document.getElementById('CardLikeButton');
CardCheckbox.addEventListener('change', function () {
    CardLikeButton.classList.toggle('active', CardCheckbox.checked);
});

document.addEventListener('scroll',function(){
    const navbarDetailWarung = document.getElementById('navbar-detail-warung')
    const titleDetail = document.getElementById('titleDetail');
    const scrolled = window.scrollY;
    if(scrolled > 100 ){
        navbarDetailWarung.style.marginTop = "0rem";
        navbarDetailWarung.classList.add('backdrop-blur')
        titleDetail.classList.add('visible')
        navbarDetailWarung.classList.add('bg-[#F9832A]')
        navbarDetailWarung.classList.add('py-20')
        titleDetail.classList.remove('invisible')
    } else if (scrolled < 100){
        navbarDetailWarung.style.marginTop = "2.5rem";
        titleDetail.classList.add('invisible')
        titleDetail.classList.remove('visible')
        navbarDetailWarung.classList.remove('py-20')
        navbarDetailWarung.classList.remove('bg-[#F9832A]')
        navbarDetailWarung.classList.remove('backdrop-blur')
        navbarDetailWarung.classList.remove('shadow-md')
    }
})
const state = {
    condition: false,
    count: 0,
}
function renderCondition(){
    // const fillButton = document.getElementById('iconLike');

    if(state.condition){
        fillButton.classList.add('fill-[#F9832A]')
        fillButton.classList.remove('fill-[#5e5e5e]')
    }else{
        fillButton.classList.add('fill-[#5e5e5e]')
        fillButton.classList.remove('fill-[#F9832A]')
    }
    // fillButton.classList.add(`${state.condition ? 'fill-[#5e5e5e]' : 'fill-[#F9832A]'}`)
}
function toggleState(){
    state.condition = !state.condition;
    renderCondition()
}
document.getElementById('buttonLike').addEventListener('click',toggleState);
renderCondition()