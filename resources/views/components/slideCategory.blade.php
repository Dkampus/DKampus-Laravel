<swiper-container id="Swiper" class="h-56 my-5 w-[29rem] rounded-lg overflow-hidden" pagination='true' space-between="30" 
    {{-- pagination="true" --}}
    centered-slides="true" direction="horizontal" autoplay-delay="3000" mousewheel="true" loop="true" autoplay-disable-on-interaction="false">
    {{$slot}}
</swiper-container>