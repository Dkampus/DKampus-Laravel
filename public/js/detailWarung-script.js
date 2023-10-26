document.addEventListener('scroll',function(){
    const navbarDetailWarung = document.getElementById('navbar-detail-warung')
    const titleDetail = document.getElementById('titleDetail');
    const scrolled = window.scrollY;
    if(scrolled > 100){
        navbarDetailWarung.style.marginTop = "0";
        navbarDetailWarung.classList.add('backdrop-blur')
        titleDetail.classList.add('visible')
        titleDetail.classList.remove('invisible')
    } else if (scrolled < 100){
        navbarDetailWarung.style.marginTop = "2.5rem";
        navbarDetailWarung.classList.remove('backdrop-blur')
        titleDetail.classList.add('invisible')
        titleDetail.classList.remove('visible')
    }
})
const state = {
    condition: false,
}
function render(){
    const fillButton = document.getElementById('iconLike');
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
    render()
}
document.getElementById('buttonLike').addEventListener('click',toggleState);
render()