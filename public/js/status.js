const listMakananSatuan = document.getElementById('contentStatus');
const toggleShowMore = document.getElementById('toggleShowMore');
const iconToggle = document.getElementById('iconToggle');

const state = {
    condition: false,
}
function render(){
    if(state.condition){
        listMakananSatuan.style.height = '20rem';
        iconToggle.style.transform = 'rotate(0deg)';
    }else{
        listMakananSatuan.style.height = '27rem';
        iconToggle.style.transform = 'rotate(180deg)';
    }
}
state.condition = !state.condition
function toggleState(){
    state.condition = !state.condition;
    render()
}
toggleShowMore.addEventListener('click',toggleState);
render()