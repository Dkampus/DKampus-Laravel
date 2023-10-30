const listMakananSatuan = document.getElementById('contentStatus');
const toggleShowMore = document.getElementById('toggleShowMore');
const iconToggle = document.getElementById('iconToggle');

const state = {
    condition: false,
}
function render01(){
    if(state.condition){
        listMakananSatuan.style.height = 'max-content';
        iconToggle.style.transform = 'rotate(0deg)';
    }else{
        listMakananSatuan.style.height = '20rem';
        iconToggle.style.transform = 'rotate(180deg)';
    }
}
function toggleState(){
    state.condition = !state.condition;
    render01()
}
toggleShowMore.addEventListener('click',toggleState);
render01()