@extends('layouts.Root')
@section('content')
    <header class="bg-[#F9832A] w-full h-max pb-5">
        <div class="flex flex-row justify-between items-center py-10 px-5">
            <div id="titlePromo" class="flex flex-row gap-2 items-center">
                <svg height="30" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.1519 0.974141C10.4394 -0.323059 12.5411 -0.323059 13.8396 0.964239L14.6429 1.76632C14.951 2.0744 15.3692 2.25154 15.8093 2.25154H16.9427C18.7694 2.25154 20.2549 3.73578 20.2549 5.5622V6.69656C20.2549 7.13557 20.431 7.55366 20.7391 7.86173L21.5314 8.65392C22.1586 9.27006 22.4997 10.1063 22.4997 10.9865C22.5107 11.8667 22.1696 12.704 21.5534 13.33L20.7391 14.1442C20.431 14.4523 20.2549 14.8704 20.2549 15.3116V16.4437C20.2549 18.2701 18.7694 19.7566 16.9427 19.7566H15.8093C15.3692 19.7566 14.951 19.9315 14.6429 20.2396L13.8506 21.0318C13.2014 21.682 12.3541 22 11.5068 22C10.6595 22 9.81214 21.682 9.16291 21.0439L8.35962 20.2396C8.0515 19.9315 7.63335 19.7566 7.19319 19.7566H6.05978C4.23312 19.7566 2.74758 18.2701 2.74758 16.4437V15.3116C2.74758 14.8704 2.57152 14.4523 2.26341 14.1332L1.47112 13.352C0.183653 12.0658 0.172649 9.96322 1.46012 8.66602L2.26341 7.86173C2.57152 7.55366 2.74758 7.13557 2.74758 6.68446V5.5622C2.74758 3.73578 4.23312 2.25154 6.05978 2.25154H7.19319C7.63335 2.25154 8.0515 2.0744 8.35962 1.76632L9.1519 0.974141ZM14.3348 12.8679C13.7956 12.8679 13.3664 13.2981 13.3664 13.8251C13.3664 14.3642 13.7956 14.7933 14.3348 14.7933C14.863 14.7933 15.2921 14.3642 15.2921 13.8251C15.2921 13.2981 14.863 12.8679 14.3348 12.8679ZM15.006 7.48765C14.6319 7.11466 14.0267 7.11466 13.6525 7.48765L7.99649 13.143C7.62235 13.517 7.62235 14.1332 7.99649 14.5073C8.17255 14.6943 8.41464 14.7933 8.66773 14.7933C8.93182 14.7933 9.17391 14.6943 9.34998 14.5073L15.006 8.85306C15.3802 8.47898 15.3802 7.86173 15.006 7.48765ZM8.67873 7.21258C8.15054 7.21258 7.71038 7.64168 7.71038 8.1698C7.71038 8.71003 8.15054 9.13803 8.67873 9.13803C9.20692 9.13803 9.63608 8.71003 9.63608 8.1698C9.63608 7.64168 9.20692 7.21258 8.67873 7.21258Z" fill="#fff"/>
                </svg>
                <h1 class="text-white font-bold text-2xl">Promo Special</h1>
            </div>
            <a href="" class="text-white text-lg">Lihat semua</a>
        </div>
        <x-promo-carousel.carousel>
            @foreach ($CarouselPromo as $Item)
                <swiper-slide style="background-image: url('/{{$Item['Img']}}')" class="w-52 h-full bg-no-repeat rounded-2xl mx-auto bg-cover">
                <div class="bg-[#D83F31] w-60 h-full flex flex-col justify-center items-center rounded-2xl">
                    <div class="flex flex-col gap-2">
                    <h1 class="text-white font-semibold text-2xl text-left w-[8.5rem]">{{$Item['Desc']}}</h1>
                    <div class="flex flex-row items-center gap-1">
                        <svg class="fill-white" height="20" viewBox="0 0 8 10" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.99216 3.6371L7.88067 2.57221C7.71921 1.41121 7.19253 0.938354 6.06617 0.938354H5.15886H4.58993H3.42125H2.85226H1.92962C0.799373 0.938354 0.276539 1.41121 0.111232 2.58374L0.00743402 3.64094C-0.0310096 4.05229 0.0804769 4.4521 0.322672 4.7635C0.614843 5.14409 1.06463 5.35937 1.5644 5.35937C2.04879 5.35937 2.51396 5.11718 2.80613 4.7289C3.06755 5.11718 3.51351 5.35937 4.00944 5.35937C4.50532 5.35937 4.93977 5.12871 5.20499 4.74427C5.50105 5.12487 5.95849 5.35937 6.43519 5.35937C6.94649 5.35937 7.40781 5.13256 7.69614 4.73274C7.9268 4.42519 8.03064 4.03691 7.99216 3.6371Z"/>
                        <path d="M3.75962 6.86267C3.27139 6.91265 2.90234 7.32784 2.90234 7.81992V8.87327C2.90234 8.97707 2.98692 9.06165 3.09072 9.06165H4.92446C5.02826 9.06165 5.11284 8.97707 5.11284 8.87327V7.95447C5.11668 7.151 4.64383 6.77041 3.75962 6.86267Z"/>
                        <path d="M7.61207 5.99289V7.13851C7.61207 8.19955 6.75093 9.06069 5.68988 9.06069C5.58609 9.06069 5.50151 8.97611 5.50151 8.87231V7.95351C5.50151 7.46143 5.35158 7.077 5.05941 6.81558C4.80184 6.58107 4.452 6.46574 4.01759 6.46574C3.92148 6.46574 3.82537 6.46959 3.72157 6.48112C3.03726 6.55032 2.51827 7.12697 2.51827 7.81896V8.87231C2.51827 8.97611 2.43369 9.06069 2.3299 9.06069C1.26885 9.06069 0.407715 8.19955 0.407715 7.13851V6.00058C0.407715 5.73147 0.672976 5.55079 0.922859 5.63921C1.02666 5.6738 1.13046 5.70072 1.2381 5.71609C1.28423 5.72378 1.33421 5.73147 1.38034 5.73147C1.44185 5.73916 1.50336 5.743 1.56487 5.743C2.01081 5.743 2.44907 5.5777 2.79506 5.29321C3.12568 5.5777 3.55626 5.743 4.0099 5.743C4.46738 5.743 4.89026 5.58538 5.22087 5.3009C5.56686 5.58154 5.99743 5.743 6.43569 5.743C6.50489 5.743 6.57409 5.73916 6.63944 5.73147C6.68558 5.72763 6.72786 5.72378 6.77015 5.71609C6.88933 5.70072 6.99697 5.66612 7.10461 5.63152C7.35449 5.54694 7.61207 5.73147 7.61207 5.99289Z"/>
                        </svg>
                        <h1 class="text-white text-promo-warung-carousel text-sm">{{$Item['Warung']}}</h1>
                    </div>
                    </div>
                </div>
                </swiper-slide>
            @endforeach
        </x-promo-carousel.carousel>
    </header>
    <main class="mb-28">
    <nav class="px-5 my-3 transition-all duration-300 flex flex-row items-center gap-4">
    <a href="/promo" class="transition-all duration-300 font-semibold  {{$NavPromo === 'Semua' ? 'text-white bg-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl':'text-[#F9832A] bg-white border-2 border-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl'}}">Semua</a>
    <a href="/promo/makanan" class="transition-all duration-300 font-semibold {{$NavPromo === 'Makanan' ? 'text-white bg-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl':'text-[#F9832A] bg-white border-2 border-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl'}}">Makanan</a>
    <a href="/promo/minuman" class="transition-all duration-300 font-semibold {{$NavPromo === 'Minuman' ? 'text-white bg-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl':'text-[#F9832A] bg-white border-2 border-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl'}}">Minuman</a>
    <a href="/promo/cemilan" class="transition-all duration-300 font-semibold {{$NavPromo === 'Camilan' ? 'text-white bg-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl':'text-[#F9832A] bg-white border-2 border-[#F9832A] h-10 px-3 flex flex-row items-center rounded-xl'}}">Cemilan</a>
    </nav>
    <div>
    @yield('contentPromo')
    </div>
    </main>
@endsection