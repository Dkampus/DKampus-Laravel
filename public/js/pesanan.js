const CardPesananCheckbox = document.getElementById('CardPesananCheckbox');
const CardPesananLikeButton = document.getElementById('CardPesananLikeButton');
CardPesananCheckbox.addEventListener('change', function () {
    CardPesananLikeButton.classList.toggle('active', CardPesananCheckbox.checked);
});