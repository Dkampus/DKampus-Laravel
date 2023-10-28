const CardPesananCheckbox = document.getElementById('CardPesananCheckbox');
const CardPesananLikeButton = document.getElementById('CardPesananLikeButton');
CardPesananCheckbox.addEventListener('change', function () {
    CardPesananLikeButton.classList.toggle('active', CardPesananCheckbox.checked);
});


const number = document.getElementById('number')
const decrement = document.getElementById('decrement');
const increment = document.getElementById('increment');
const Delete = document.getElementById('delete');
const state = {
    condition: false,
    count: 1
}
function renderCount(){
    number.value = state.count
    decrement.disabled = state.count === 1;
    if(state.count > 1){
        decrement.style.visibility = 'visible';
        decrement.style.position = 'relative';
        decrement.style.opacity = '100';
        Delete.style.visibility = 'invisible';
        Delete.style.position = 'absolute';
        Delete.style.opacity = '0';
        Delete.style.display = 'none';
    }else if (state.count === 1){
        decrement.style.visibility = 'invisible';
        decrement.style.position = 'absolute';
        decrement.style.opacity = '0';
        Delete.style.visibility = 'visible';
        Delete.style.position = 'relative';
        Delete.style.opacity = '100';
        Delete.style.display = 'flex';
    }
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

const cardPesanan = document.getElementById('cardPesanan');
function DeleteItem(){
    cardPesanan.style.display = 'none';
}


const checkAllCheckbox = document.getElementById("checkboxWarung");
const checkboxes = document.querySelectorAll("#checkboxMakanan");

// Add an event listener to the "Check All" checkbox
checkAllCheckbox.addEventListener("change", function () {
  checkboxes.forEach(function (checkbox) {
    checkbox.checked = checkAllCheckbox.checked;
  });
});
