const myCheckbox = document.getElementById('myCheckbox');
const myButton = document.getElementById('myButton');

myCheckbox.addEventListener('change', function () {
    myButton.classList.toggle('active', myCheckbox.checked);
});

document.addEventListener('scroll',function(){
    const navbarDetailWarung = document.getElementById('navbar-detail-warung')
    const titleDetail = document.getElementById('titleDetail');
    const scrolled = window.scrollY;
    if(scrolled > 100 && scrolled < 150){
        navbarDetailWarung.style.marginTop = "0rem";
        navbarDetailWarung.classList.add('backdrop-blur')
        titleDetail.classList.add('visible')
        titleDetail.classList.remove('invisible')
    } else if (scrolled > 400){
        navbarDetailWarung.style.marginTop = "0";
        navbarDetailWarung.classList.remove('backdrop-blur')
        navbarDetailWarung.classList.add('bg-[#F9832A]')
        navbarDetailWarung.classList.add('shadow-md')
    } else if (scrolled <= 400 && scrolled > 400){
        navbarDetailWarung.style.marginTop = "2.5rem";
        navbarDetailWarung.classList.add('backdrop-blur')
        navbarDetailWarung.classList.remove('bg-[#F9832A]')
        navbarDetailWarung.classList.remove('shadow-md')
    } else if (scrolled < 100){
        navbarDetailWarung.style.marginTop = "2.5rem";
        titleDetail.classList.add('invisible')
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