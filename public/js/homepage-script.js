const topBarMobile = document.getElementById('topBarMobile')
window.addEventListener('scroll', () => {
    // Check the scroll position, for example, when it goes beyond 100 pixels
    if (window.scrollY >= 100) {
        // Show the scroll indicator
        topBarMobile.style.boxShadow = '0px 10px 20px 0px rgba(0,0,0,0.1)';
        topBarMobile.style.transition = "all 1s"
    } else if (window.scrollY < 100){
         topBarMobile.style.boxShadow = "none";
         topBarMobile.style.transition = "all 1s"
    }
});
 
 // swiper for banner
 const banner = document.getElementById('banner')
 // swiper parameters
 const bannerParams = {
    injectStyles: [`
    'path/to/navigation-element.min.css',
    'path/to/pagination-element.min.css',
    .swiper-pagination-bullet {
      width: 8px;
      height: 8px;
      text-align: center;
      line-height: 20px;
      font-size: 12px;
      color: #000;
      opacity: 1;
      background: rgba(0, 0, 0, 0.2);
      transition-property: all;
      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      transition-duration: 150ms;
    }

    .swiper-pagination-bullet-active {
      color: #fff;
      background: #F9832A;
      width: 20px;
      height: 8px;
      border-radius: 50px;
      transition-property: all;
      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      transition-duration: 150ms;
    }

    .swiper-button-disabled{
    position: absolute;
    /* left: -2rem; */
    display: none;
    transition: all;
    }
    `],
   slidesPerView: 1,
   breakpoints: {
     640: {
       slidesPerView: 1,
     },
     1024: {
       slidesPerView: 1,
     },
   },
   on: {
     init() {
       // ...
     },
   },
 };
 // now we need to assign all parameters to Swiper element
 Object.assign(banner, bannerParams);
 // and now initialize it
 banner.initialize();


  // swiper for carousel category
  const carouselCategory = document.getElementById('category-desktop')
  // swiper parameters
  const carouselCategoryParams = {
    slidesPerView: 1,
    breakpoints: {
      640: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 10,
      },
    },
    on: {
      init() {
        // ...
      },
    },
  };
  // now we need to assign all parameters to Swiper element
  Object.assign(carouselCategory, carouselCategoryParams);
  // and now initialize it
  carouselCategory.initialize();

  // swiper for Rekomendasi Warung
  const RekomendasiWarung = document.getElementById('rekomendasiWarung')
  // swiper parameters
  const RekomendasiWarungParams = {
      slidesPerView: 1,
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 7,
        },
      },
      on: {
        init() {
          // ...
        },
      },
  };
  // now we need to assign all parameters to Swiper element
  Object.assign(RekomendasiWarung, RekomendasiWarungParams);
  // and now initialize it
  RekomendasiWarung.initialize();


  // swiper for Rekomendasi Makanan
  const RekomendasiMakanan = document.getElementById('rekomendasiMakanan')
  // swiper parameters
  const RekomendasiMakananParams = {
        slidesPerView: 1,
        breakpoints: {
          640: {
            slidesPerView: 2,
          },
          1024: {
            slidesPerView: 4.5,
          },
        },
        on: {
          init() {
            // ...
          },
        },
  };
  // now we need to assign all parameters to Swiper element
  Object.assign(RekomendasiMakanan, RekomendasiMakananParams);
  // and now initialize it
  RekomendasiMakanan.initialize();



document.addEventListener('scroll',function(){

    const scrollable = document.documentElement.scrollHeight - window.innerHeight;
    const scrolled = window.scrollY;
    const scrollButton = document.querySelector('#scrollBehaviour');

    const viewportWidth = window.innerWidth;

    if(scrolled > 100){
        scrollButton.style.opacity = "100";
        scrollButton.style.zIndex = "1";
        if(viewportWidth >= 768){
          scrollButton.style.bottom = "4rem"; 
        }else if(viewportWidth < 768){
          scrollButton.style.bottom = "7rem"; 
        }
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
        barMenu.style.top = '0rem';
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


const searchResults = document.getElementById('search-results');
const overlayResults = document.getElementById('overlay-results');
function showResults(){
    if(searchResults.style.display === 'none' || searchResults.style.display === ''){
        searchResults.style.height = '28rem';
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


const searchResultsDesktop = document.getElementById('search-results-desktop');
const overlayResultsDesktop = document.getElementById('overlay-results-desktop');
function showResultsDesktop(){
    if(searchResultsDesktop.style.display === 'none' || searchResultsDesktop.style.display === ''){
        searchResultsDesktop.style.height = '26rem';
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

const seeMore = document.getElementById('seeMore') ?? "";
const cardList = document.getElementById('cardList');
const addRow = 2 //initial number

if(seeMore){
  seeMore.addEventListener('click',() => {
    addRow += 1;
    console.log('hello')
    cardList.style.maxHeight = `${addRow * 110}px`;
 })
}