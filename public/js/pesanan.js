const BtnLikePesananCheckbox = document.querySelectorAll("#BtnLikePesananCheckbox");
const BtnPesananLikeIcon = document.querySelectorAll("#BtnPesananLikeIcon");


CardPesananCheckbox.addEventListener("change", function () {
    CardPesananLikeButton.classList.toggle(
        "active",
        CardPesananCheckbox.checked
    );
});

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

console.log("memek");

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

// Loop through all quantity inputs
quantityInputs.forEach(function (quantityInput, index) {
    const itemQuantity = parseInt(quantityInput.value);
    const decrementBtn = decrementBtns[index];
    const incrementBtn = incrementBtns[index];

    // Show or hide decrement button based on quantity value
    if (itemQuantity == 1) {
        decrementBtn.style.display = "none";
        decrementBtn.style.pointerEvents = "none";
        incrementBtn.style.pointerEvents = "auto";
        deleteBtn[index].style.display = "flex";
    }

    // Show or hide increment button based on quantity value
    if (itemQuantity === 100) {
        incrementBtn.style.opacity = "0";
        incrementBtn.style.pointerEvents = "none";
    }

    // Add click event listener to decrement button
    decrementBtn.addEventListener("click", function (e) {
        e.preventDefault();
        let currentQuantity = parseInt(quantityInput.value);

        if (currentQuantity > 1) {
            decrementBtn.style.display = "absolute";
            decrementBtn.style.pointerEvents = "auto";
            quantityInput.value = currentQuantity - 1;
            currentQuantity--;
        }

        if (currentQuantity == 1) {
            decrementBtn.style.display = "none";
            decrementBtn.style.pointerEvents = "none";
            incrementBtn.style.pointerEvents = "auto";
            deleteBtn[index].style.display = "flex";
        }

        calculateTotal();
    });

    // Add click event listener to increment button
    incrementBtn.addEventListener("click", function (e) {
        e.preventDefault();
        let currentQuantity = parseInt(quantityInput.value);

        if (currentQuantity < 100) {
            currentQuantity++;
            quantityInput.value = currentQuantity;
            incrementBtn.style.opacity = currentQuantity === 100 ? "0" : "1";
            incrementBtn.style.pointerEvents =
                currentQuantity === 100 ? "none" : "auto";
        }

        if (currentQuantity == 2) {
            deleteBtn[index].style.display = "none";
            decrementBtn.style.display = "flex";
            decrementBtn.style.pointerEvents = "auto";
        }

        calculateTotal();
    });
});
