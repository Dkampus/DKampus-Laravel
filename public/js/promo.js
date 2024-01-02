const promoTerlaris = document.getElementById('promoTerlaris')
// swiper parameters
const promoTerlarisParams = {
//    injectStyles: [`
//    'path/to/navigation-element.min.css',
//    'path/to/pagination-element.min.css',
//    .swiper-pagination-bullet {
//      width: 8px;
//      height: 8px;
//      text-align: center;
//      line-height: 20px;
//      font-size: 12px;
//      color: #000;
//      opacity: 1;
//      background: rgba(0, 0, 0, 0.2);
//      transition-property: all;
//      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
//      transition-duration: 150ms;
//    }

//    .swiper-pagination-bullet-active {
//      color: #fff;
//      background: #F9832A;
//      width: 20px;
//      height: 8px;
//      border-radius: 50px;
//      transition-property: all;
//      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
//      transition-duration: 150ms;
//    }

//    .swiper-button-disabled{
//    position: absolute;
//    /* left: -2rem; */
//    display: none;
//    transition: all;
//    }
//    `],
  slidesPerView:3,
  breakpoints: {
    640: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 3.5,
    },
  },
  on: {
    init() {
      // ...
    },
  },
};
// now we need to assign all parameters to Swiper element
Object.assign(promoTerlaris, promoTerlarisParams);
// and now initialize it
promoTerlaris.initialize();