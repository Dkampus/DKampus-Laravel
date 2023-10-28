// const timerElement = document.getElementById('timerSeconds')
// let timeLeft = 30;
// function updateTimer() {
//     timerElement.textContent = timeLeft;
// }
// function runTimer() {
//     updateTimer();
//     const intervalId = setInterval(function() {
//         if (timeLeft > 0) {
//             timeLeft--;
//             updateTimer();
//         } else {
//             clearInterval(intervalId);
//             timeLeft = 30; 
//             runTimer(); 
//         }
//     }, 1000); 
// }
// runTimer();


let countdown = 30;
const timer = document.getElementById('timer');
const timerSeconds = document.getElementById('timerSeconds');
const link = document.getElementById('link')
function updateTimer() {
  if (countdown > 0) {
    countdown--;
    timerSeconds.textContent = countdown;
  } else if (countdown === 0) {
    timer.classList.add('invisible');
    timer.classList.remove('visible');
    timerSeconds.textContent = countdown;
    timerSeconds.classList.add('invisible')
    link.classList.add('visible');
    link.classList.remove('invisible');
  }
}

const timerInterval = setInterval(updateTimer, 1000);
setTimeout(() => {
  clearInterval(timerInterval);
}, 30000);



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
