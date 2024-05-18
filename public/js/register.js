const modal_email_confirm = document.getElementById("modal_confirm_email");
const overlay_email_confirm = document.getElementById("overlayDaftar");
const validationEmail = document.getElementById("validation_email");
const email = document.getElementById("email");
const inputs = document.getElementById("inputs");
const daftar = document.getElementById("daftar");
const modal_error_msg = document.getElementById("modal_error_msg");
const overlayErrorMsg = document.getElementById("overlayErrorMsg");
const errorMsg = document.getElementById("errorMsg");

function showErrorModal(message) {
    errorMsg.innerHTML = message;

    modal_error_msg.style.visibility = "visible";
    modal_error_msg.style.opacity = "100";
    modal_error_msg.style.zIndex = "99";
    modal_error_msg.classList.add("scale-100");
    modal_error_msg.classList.remove("scale-0");

    document.body.style.overflow = "hidden";

    overlayErrorMsg.style.visibility = "visible";
    overlayErrorMsg.style.opacity = "100";
    overlayErrorMsg.style.zIndex = "90";
}

function hideErrorModal() {
    modal_error_msg.style.visibility = "invisible";
    modal_error_msg.style.opacity = "0";
    modal_error_msg.style.zIndex = "-2";
    modal_error_msg.classList.remove("scale-100");
    modal_error_msg.classList.add("scale-0");

    document.body.style.overflow = "auto";

    overlayErrorMsg.style.visibility = "invisible";
    overlayErrorMsg.style.opacity = "0";
    overlayErrorMsg.style.zIndex = "-2";
}

inputs.addEventListener("submit", function (event) {
    event.preventDefault();
});

function showModal() {
    if (
        modal_email_confirm.style.display === "" ||
        modal_email_confirm.style.display === "none"
    ) {
        validationEmail.innerHTML = email.value;

        modal_email_confirm.style.visibility = "visible";
        modal_email_confirm.style.opacity = "100";
        modal_email_confirm.style.zIndex = "99";
        modal_email_confirm.classList.add("scale-100");
        modal_email_confirm.classList.remove("scale-0");

        document.body.style.overflow = "hidden";

        overlay_email_confirm.style.visibility = "visible";
        overlay_email_confirm.style.opacity = "100";
        overlay_email_confirm.style.zIndex = "90";
    }
}
function hideModal() {
    modal_email_confirm.style.visibility = "invisible";
    modal_email_confirm.style.opacity = "0";
    modal_email_confirm.style.zIndex = "-2";
    modal_email_confirm.classList.remove("scale-100");
    modal_email_confirm.classList.add("scale-0");

    document.body.style.overflow = "auto";

    overlay_email_confirm.style.visibility = "invisible";
    overlay_email_confirm.style.opacity = "0";
    overlay_email_confirm.style.zIndex = "-2";
}

const form = document.getElementById("formRegister");
const submitButton = document.getElementById("submit_btn");

submitButton.addEventListener("click", function (event) {
    event.preventDefault();

    form.submit();
});
