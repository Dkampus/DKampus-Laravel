const searchResults = document.getElementById('search-results');
const overlayResults = document.getElementById('overlay-results');
function show(){
    if(searchResults.style.display === 'none' || searchResults.style.display === ''){
        searchResults.style.height = '24rem';
        searchResults.style.visibility = 'visible';
        searchResults.style.opacity = '100';
        searchResults.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";

        // style body
        document.body.style.overflow = 'hidden';

        overlayResults.style.opacity = '100';
        overlayResults.style.display = 'block';
        overlayResults.style.visibility = 'visible';
    }
}

function hide(){
    searchResults.style.height = '0rem';
    searchResults.style.visibility = 'invisible';
    searchResults.style.opacity = '0';
    searchResults.style.boxShadow = "0px";

    // style body
    document.body.style.overflow = 'auto';

    overlayResults.style.display = 'none';
    overlayResults.style.opacity = '0';
}

const searchInput = document.getElementById('search-input');
const clearInput = document.getElementById('clear-input');
clearInput.addEventListener("click",function(){
    searchInput.value = "";
    clearInput.style.display = 'none';
})
searchInput.addEventListener("input",function(){
    if(searchInput.value.trim() !== ''){
        clearInput.style.display = 'flex';
        clearInput.style.flexDirection = 'row';
        clearInput.style.justifyContent = 'center';
        clearInput.style.alignItems = 'center';
        clearInput.style.visibility = 'visible';
       
    }else{
        clearInput.style.display = 'none';
        clearInput.style.visibility = 'invisible';
       
    }
})