const timerElement = document.getElementById('timerSeconds')
let timeLeft = 30;

function updateTimer() {
    timerElement.textContent = timeLeft;
}

function runTimer() {
    updateTimer();
    const intervalId = setInterval(function() {
        if (timeLeft > 0) {
            timeLeft--;
            updateTimer();
        } else {
            clearInterval(intervalId);
            timeLeft = 30; 
            runTimer(); 
        }
    }, 1000); 
}
runTimer();

// const verificationInput = document.getElementById('verificationInput')
// function validateVerificationCode(input){
//     const code = input.value

//     if(/^\d{6}$/.test(code)){

//     }
// }

const disableSpaceKeyboard = document.getElementById('verificationInput');

disableSpaceKeyboard.addEventListener('keydown', function (event) {
    if (event.key === ' ') {
        event.preventDefault(); // Prevent the space key from being entered
    }
});

function validateNumbersOnly(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}
function allowAlphabetNumbersSpaces(input) {
    input.value = input.value.replace(/[^A-Za-z0-9\s]/g, '');
}
