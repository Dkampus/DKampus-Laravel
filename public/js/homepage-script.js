document.addEventListener('scroll',function(){
    const scrollable = document.documentElement.scrollHeight - window.innerHeight;
    const scrolled = window.scrollY;
    const scrollButton = document.querySelector('#scrollBehaviour');
    if(scrolled > 100){
        scrollButton.style.opacity = "100";
        scrollButton.style.bottom = "7rem";
    } else if (scrolled < 100){
        scrollButton.style.opacity = "0";
        scrollButton.style.bottom = "-99rem"
    }
    scrollButton.addEventListener("click", function(){
        window.scrollTo({top: 0,behavior: "smooth"});
     })
})


const barMenu = document.getElementById('bar-menu');
const overlayMenu = document.getElementById('overlay-menu');
function showMenu(){
    if(barMenu.style.display === 'none' || barMenu.style.display === ''){
        barMenu.style.width = '23rem';
        barMenu.style.right = '0rem';
        barMenu.style.visibility = 'visible';
        barMenu.style.opacity = '100';
        barMenu.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";

        // style body
        document.body.style.overflow = 'hidden';

        overlayMenu.style.opacity = '100';
        overlayMenu.style.display = 'block';
        overlayMenu.style.visibility = 'visible';
    }
}

function hideMenu(){
    barMenu.style.visibility = 'invisible';
    barMenu.style.opacity = '0';
    barMenu.style.boxShadow = "0px";
    barMenu.style.right = "-99rem"

    // style body
    document.body.style.overflow = 'auto';

    overlayMenu.style.display = 'none';
    overlayMenu.style.opacity = '0';
}

const searchResults = document.getElementById('search-results');
const overlayResults = document.getElementById('overlay-results');
function showResults(){
    if(searchResults.style.display === 'none' || searchResults.style.display === ''){
        searchResults.style.height = '24rem';
        searchResults.style.visibility = 'visible';
        searchResults.style.opacity = '100';
        searchResults.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";
        searchResults.style.bottom = "0rem";

        // style body
        document.body.style.overflow = 'hidden';

        overlayResults.style.opacity = '100';
        overlayResults.style.display = 'block';
        overlayResults.style.visibility = 'visible';
    }
}

function hideResults(){
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
        clearInput.style.visibility = 'invisible';
       
    }
})
