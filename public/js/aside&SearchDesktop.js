const barMenuDesktop = document.getElementById('bar-menu-desktop');
const overlayMenuDesktop = document.getElementById('overlay-menu-desktop');
const viewportWidthDesktop = window.innerWidth;
function showMenuDesktop(){
    if(barMenuDesktop.style.display === 'none' || barMenuDesktop.style.display === ''){
        barMenuDesktop.style.width = '23rem';
        barMenuDesktop.style.right = '0rem';
        barMenuDesktop.style.top = '0rem';
        barMenuDesktop.style.visibility = 'visible';
        barMenuDesktop.style.opacity = '100';
        barMenuDesktop.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";

        // style body
        if(viewportWidthDesktop >= 768 ){
          document.body.style.overflow = 'hidden';
        }else if (viewportWidthDesktop < 768){
          document.body.style.overflow = 'auto';
        }

        overlayMenuDesktop.style.opacity = '100';
        overlayMenuDesktop.style.display = 'block';
        overlayMenuDesktop.style.visibility = 'visible';
    }
}
function hideMenuDesktop(){
    barMenuDesktop.style.visibility = 'invisible';
    barMenuDesktop.style.opacity = '0';
    barMenuDesktop.style.boxShadow = "0px";
    barMenuDesktop.style.right = "-99rem"

    // style body
    document.body.style.overflow = 'auto';

    overlayMenuDesktop.style.display = 'none';
    overlayMenuDesktop.style.opacity = '0';
}

const searchResultsDesktop = document.getElementById('search-results-desktop');
const overlayResultsDesktop = document.getElementById('overlay-results-desktop');
function showResultsDesktop(){
    if(searchResultsDesktop.style.display === 'none' || searchResultsDesktop.style.display === ''){
        searchResultsDesktop.style.height = '24rem';
        searchResultsDesktop.style.visibility = 'visible';
        searchResultsDesktop.style.opacity = '100';
        searchResultsDesktop.style.boxShadow = "0px 10px 15px -3px rgba(0,0,0,0.1)";
        searchResultsDesktop.style.bottom = "0rem";

        // style body
        document.body.style.overflow = 'hidden';

        overlayResultsDesktop.style.opacity = '100';
        overlayResultsDesktop.style.display = 'block';
        overlayResultsDesktop.style.visibility = 'visible';
    }
}

function hideResultsDesktop(){
    searchResultsDesktop.style.height = '0rem';
    searchResultsDesktop.style.visibility = 'invisible';
    searchResultsDesktop.style.opacity = '0';
    searchResultsDesktop.style.boxShadow = "0px";

    // style body
    document.body.style.overflow = 'auto';

    overlayResultsDesktop.style.display = 'none';
    overlayResultsDesktop.style.opacity = '0';
}

const searchInputDesktop = document.getElementById('search-input-desktop');
const clearInputDesktop = document.getElementById('clear-input-desktop');
clearInputDesktop.addEventListener("click",function(){
    searchInputDesktop.value = "";
    clearInputDesktop.style.display = 'none';
})
searchInputDesktop.addEventListener("input",function(){
    if(searchInputDesktop.value.trim() !== ''){
        clearInputDesktop.style.display = 'flex';
        clearInputDesktop.style.flexDirection = 'row';
        clearInputDesktop.style.justifyContent = 'center';
        clearInputDesktop.style.alignItems = 'center';
        clearInputDesktop.style.visibility = 'visible';
       
    }else{
        clearInputDesktop.style.visibility = 'invisible';
       
    }
})