const CardPesananCheckbox = document.getElementById('CardPesananCheckbox');
const CardPesananLikeButton = document.getElementById('CardPesananLikeButton');
CardPesananCheckbox.addEventListener('change', function () {
    CardPesananLikeButton.classList.toggle('active', CardPesananCheckbox.checked);
});


// const listAddNewAddress = document.getElementById('addNewAddress');
// const overlayAddNewAddress = document.getElementById('overlayAddNewAddress');
// function showListAddress(){
//     if(listAddNewAddress.style.display === 'none' || listAddNewAddress.style.display === ''){
//         listAddNewAddress.style.height = '24rem'
//         listAddNewAddress.style.bottom = '10rem'

//         document.body.style.overflow = 'hidden';

//         overlayAddNewAddress.style.visibility = 'visible';
//         overlayAddNewAddress.style.opacity = '100';
//         overlayAddNewAddress.style.zIndex = '0';
//     }
// }
// function hideListAddress(){
//     listAddNewAddress.style.height = '0rem'
//     listAddNewAddress.style.bottom = '-99rem'

//     document.body.style.overflow = 'auto';

//     overlayAddNewAddress.style.visibility = 'invisible';
//     overlayAddNewAddress.style.opacity = '0';
//     overlayAddNewAddress.style.zIndex = '-10';
// }

const number = document.getElementById('number')
const decrement = document.getElementById('decrement');
const increment = document.getElementById('increment');

const Delete = document.getElementById('delete');

const listAddNewAddress = document.getElementById('addNewAddress');
const overlayAddNewAddress = document.getElementById('overlayAddNewAddress');
const ToggleAddress = document.getElementById('alamat');

const state = {
    condition: false,
    count: 1
}

function renderHideListAddress(){
    listAddNewAddress.style.height = '0rem'
    listAddNewAddress.style.bottom = '-99rem'

    document.body.style.overflow = 'auto';

    overlayAddNewAddress.style.visibility = 'invisible';
    overlayAddNewAddress.style.opacity = '0';
    overlayAddNewAddress.style.zIndex = '-10';
} 

function renderShowListAddress(){
    if(state.condition){
        listAddNewAddress.style.height = '24rem'
        listAddNewAddress.style.bottom = '10rem'

        document.body.style.overflow = 'hidden';

        overlayAddNewAddress.style.visibility = 'visible';
        overlayAddNewAddress.style.opacity = '100';
        overlayAddNewAddress.style.zIndex = '0';
    }else{
        listAddNewAddress.style.height = '0rem'
        listAddNewAddress.style.bottom = '-99rem'

        document.body.style.overflow = 'auto';

        overlayAddNewAddress.style.visibility = 'invisible';
        overlayAddNewAddress.style.opacity = '0';
        overlayAddNewAddress.style.zIndex = '-10';
    }
}

function toggleState(){
    state.condition = !state.condition;
    renderShowListAddress()
}

overlayAddNewAddress.addEventListener('click',toggleState);
ToggleAddress.addEventListener('click',toggleState);
renderShowListAddress()


function renderCount(){
    number.value = state.count
    decrement.disabled = state.count === 1;
    if(state.count > 1){
        decrement.style.visibility = 'visible';
        decrement.style.position = 'relative';
        decrement.style.opacity = '100';
        decrement.style.display = 'flex'
        Delete.style.visibility = 'invisible';
        Delete.style.position = 'absolute';
        Delete.style.opacity = '0';
        Delete.style.display = 'none';
    }else if (state.count === 1){
        decrement.style.visibility = 'invisible';
        decrement.style.position = 'absolute';
        decrement.style.opacity = '0';
        decrement.style.display = 'none'
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
const cardPesanan01 = document.getElementById('cardPesanan01')
function DeleteItem(){
    cardPesanan.remove()
}
function DeleteItem2(){
    cardPesanan01.remove()
}

const cardList = document.getElementById('cardList');
const contentCard = document.getElementById('contentCard');
const titleWarung = document.getElementById('titleWarung');
if(cardList.children.length === 0){
    titleWarung.remove();

    const imageElement = document.createElement('div');
    imageElement.innerHTML = "<h1>HElllo </h1>"

    contentCard.appendChild(imageElement)
}

const checkAllCheckbox = document.getElementById("checkboxWarung");
const checkboxes = document.querySelectorAll("#checkboxMakanan");

// Add an event listener to the "Check All" checkbox
checkAllCheckbox.addEventListener("change", function () {
  checkboxes.forEach(function (checkbox) {
    checkbox.checked = checkAllCheckbox.checked;
  });
});
