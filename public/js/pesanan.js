// const BtnLikeCheckbox = document.querySelectorAll("#BtnLikeCheckbox");
// const BtnLikeIcon = document.querySelectorAll("#BtnLikeIcon");
// const BtnLikeButton = document.querySelectorAll("#BtnLikeButton");
const btnLikes =  document.querySelectorAll('#BtnLikes');
btnLikes.forEach(function(like){
    //console.log(like);
    like.addEventListener("click", function() {
        like.children[0].classList.toggle("active");
    });
})
// BtnPesananLikeIcon.forEach((like,index)=>{
//     const BtnLike = like[index]
//     BtnLike.addEventListener("click",function(e){
//         e.preventDefault()
//         BtnLike.classList.toggle(
//             "active", 
//         )
//     }) 
// })


// function checkedButttonLike() {
//     BtnLikeButton.classList.toggle("active",BtnLikeCheckbox.checked);
// }
//BtnLikeCheckbox.addEventListener("change", checkedButttonLike);

//test

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

// const Delete = document.getElementById("delete");

const listAddNewAddress = document.getElementById("addNewAddress");
const overlayAddNewAddress = document.getElementById("overlayAddNewAddress");
const ToggleAddress = document.getElementById("alamat");

const state = {
    condition: false,
    count: 1,
};

function renderHideListAddress() {
    listAddNewAddress.style.height = "0rem";
    listAddNewAddress.style.bottom = "-99rem";

    document.body.style.overflow = "auto";

    overlayAddNewAddress.style.visibility = "invisible";
    overlayAddNewAddress.style.opacity = "0";
    overlayAddNewAddress.style.zIndex = "-10";
}

function renderShowListAddress() {
    if (state.condition) {
        listAddNewAddress.style.height = "24rem";
        listAddNewAddress.style.bottom = "10rem";

        document.body.style.overflow = "hidden";

        overlayAddNewAddress.style.visibility = "visible";
        overlayAddNewAddress.style.opacity = "100";
        overlayAddNewAddress.style.zIndex = "0";
    } else {
        listAddNewAddress.style.height = "0rem";
        listAddNewAddress.style.bottom = "-99rem";

        document.body.style.overflow = "auto";

        overlayAddNewAddress.style.visibility = "invisible";
        overlayAddNewAddress.style.opacity = "0";
        overlayAddNewAddress.style.zIndex = "-10";
    }
}

function toggleState() {
    state.condition = !state.condition;
    renderShowListAddress();
}

overlayAddNewAddress.addEventListener("click", toggleState);
ToggleAddress.addEventListener("click", toggleState);
renderShowListAddress();

const checkAllCheckbox = document.getElementById("checkboxWarung");
const checkboxes = document.querySelectorAll("#checkboxMakanan");
checkAllCheckbox.addEventListener("change", function () {
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });
});

const incrementBtns = document.querySelectorAll("#increment");
const decrementBtns = document.querySelectorAll("#decrement");
const quantityInputs = document.querySelectorAll("#number");
const deleteBtn = document.querySelectorAll("#delete");

function calculateTotal() {
    const quantities = document.querySelectorAll(
        'input[name="items[quantity][]"]'
    );
    const prices = document.querySelectorAll('input[name="items[harga][]"]');

    let totalPrice = 0;

    quantities.forEach((input, index) => {
        const quantity = parseInt(input.value);
        const price = parseInt(prices[index].value);
        const itemTotal = price * quantity;
        totalPrice += itemTotal;
    });

    // Format totalPrice as Indonesian Rupiah
    const formatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    });
    const formattedTotalPrice = formatter.format(totalPrice);

    const totalPriceInput = document.getElementById("total_harga");
    totalPriceInput.textContent = formattedTotalPrice;
}


