<swiper-container class="h-56 my-5 w-[29rem] rounded-lg overflow-hidden" pagination='true' space-between="30" 
    {{-- pagination="true" --}}
    centered-slides="true" direction="horizontal" autoplay-delay="3000" mousewheel="true" loop="true" autoplay-disable-on-interaction="false">
    {{$slot}}
</swiper-container>
<script>
    const swiperEl = document.querySelector('swiper-container')
    const params = {
        injectStyles: [
        `.swiper-pagination-bullet {
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
          }`
        ],
    }
  
    Object.assign(swiperEl, params)
  
    swiperEl.initialize();
  </script>