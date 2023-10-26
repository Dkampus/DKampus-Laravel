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

const state = {
    condition: false,
    count: 0
}
const number = document.getElementById('number')
const decrement = document.getElementById('decrement');
const increment = document.getElementById('increment')
if(state.count !== 0){
    decrement.classList.add('text-[#F9832A')
}else if (state.count === 0){
    decrement.classList.add('text-[#F9832A')
}
function renderCount(){
    number.textContent = state.count
    decrement.disabled = state.count === 0;
}
function incrementCounter(){
    state.count += 1;
    renderCount();
}
function decrementCounter(){
    if(state.count > 0){
        state.count -= 1;
        renderCount();
    }
}
increment.addEventListener('click',incrementCounter);
decrement.addEventListener('click',decrementCounter);
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