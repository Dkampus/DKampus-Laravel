<swiper-container id="banner" init="false" pagination="true" autoplay-delay="4000" autoplay-disable-on-interaction="false" loop="true" init="false" pagination-clickable="true" space-between="20"
slides-per-view="1" id="Banner" class="h-[20vh] mb-5 mt-3 w-full mx-auto rounded-lg overflow-hidden">
    {{$slot}}
    <div class="swiper-pagination"></div>
    <div class="swiper-button-disabled"></div>
</swiper-container>