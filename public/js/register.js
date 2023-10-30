const modal_email_confirm = document.getElementById("modal_confirm_email");
const overlay_email_confirm = document.getElementById("overlayDaftar");
const validationEmail = document.getElementById("validation_email");
const email = document.getElementById("email");
const inputs = document.getElementById("inputs");
const daftar = document.getElementById("daftar");

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
