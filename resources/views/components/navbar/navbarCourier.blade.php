<nav class="w-full md:w-2/3 shadow-top fixed z-[2] h-24 border-2 rounded-tl-3xl rounded-tr-3xl items-center bottom-0 bg-white md:flex md:justify-center md:w-auto md:left-1/2 md:transform md:-translate-x-1/2 md:top-auto md:bottom-4">
    <div class="flex flex-row justify-around mt-4 w-full md:w-auto md:gap-10">
        <a href="/" class="flex flex-col items-center gap-1.5 md:gap-2">
            <svg class="w-[1.7rem] transition-all duration-300" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.68238 20.6507V17.2872C7.68238 16.4286 8.42041 15.7325 9.33082 15.7325H12.6588C13.096 15.7325 13.5153 15.8963 13.8244 16.1879C14.1336 16.4794 14.3073 16.8749 14.3073 17.2872V20.6507C14.3045 21.0076 14.4529 21.3509 14.7196 21.6042C14.9863 21.8575 15.3491 22 15.7276 22H17.9981C19.0585 22.0026 20.0764 21.6071 20.8272 20.9009C21.578 20.1946 22 19.2357 22 18.2356V8.65354C22 7.8457 21.6203 7.07942 20.9632 6.56113L13.2394 0.743456C11.8958 -0.276582 9.97076 -0.243648 8.66729 0.821676L1.1197 6.56113C0.431594 7.06414 0.0203237 7.8327 0 8.65354V18.2258C0 20.3102 1.7917 22 4.00188 22H6.22055C7.00668 22 7.64558 21.4018 7.65127 20.6604L7.68238 20.6507Z" fill='{{str_contains($Title, 'Dashboard') ? '#F9832A' : '#AAAAAA'}}'/>
            </svg>
            <h1 class="text-sm md:text-base transition-all duration-300 {{str_contains($Title, 'Dashboard') ? 'text-[#F9832A]' : 'text-[#AAAAAA]'}}">Home</h1>
        </a>
        <a href="{{ route('courierorder') }}" class="flex flex-col items-center gap-1.5 md:gap-2">
            <svg width="27.19px" height="27.19px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.735 5.507A3 3 0 0 1 6.695 3h6.61a3 3 0 0 1 2.96 2.507L17 10v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5l.735-4.493ZM6.695 5a1 1 0 0 0-.987.836L5 10v1h1.394a3 3 0 0 1 1.665.504l.832.555a2 2 0 0 0 2.218 0l.832-.555A3 3 0 0 1 13.607 11H15v-1l-.708-4.164A1 1 0 0 0 13.306 5H6.694Z" fill="{{str_contains($Title, 'Order') ? '#F9832A' : '#AAAAAA'}}"/>
            </svg>
            <h1 class="text-sm md:text-base transition-all duration-300 {{str_contains($Title, 'Order') ? 'text-[#F9832A]' : 'text-[#AAAAAA]'}}">Order</h1>
        </a>
        <a href="history" class="flex flex-col items-center gap-1.5 md:gap-2">
            <svg class="w-[1.7rem] transition-all duration-300"  viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.916 1C3.6407 1.63079 3.49906 2.31176 3.5 3C3.5 3.53044 3.71071 4.03914 4.08579 4.41422C4.46086 4.78929 4.96957 5 5.5 5H11.5C12.0304 5 12.5391 4.78929 12.9142 4.41422C13.2893 4.03914 13.5 3.53044 13.5 3C13.5 2.289 13.352 1.612 13.084 1H14.5C15.0304 1 15.5391 1.21072 15.9142 1.58579C16.2893 1.96086 16.5 2.46957 16.5 3V18C16.5 18.5304 16.2893 19.0391 15.9142 19.4142C15.5391 19.7893 15.0304 20 14.5 20H2.5C1.96957 20 1.46086 19.7893 1.08579 19.4142C0.710714 19.0391 0.5 18.5304 0.5 18V3C0.5 2.46957 0.710714 1.96086 1.08579 1.58579C1.46086 1.21072 1.96957 1 2.5 1H3.916ZM8.5 12H5.5C5.23478 12 4.98043 12.1054 4.79289 12.2929C4.60536 12.4804 4.5 12.7348 4.5 13C4.5 13.2652 4.60536 13.5196 4.79289 13.7071C4.98043 13.8946 5.23478 14 5.5 14H8.5C8.76522 14 9.01957 13.8946 9.20711 13.7071C9.39464 13.5196 9.5 13.2652 9.5 13C9.5 12.7348 9.39464 12.4804 9.20711 12.2929C9.01957 12.1054 8.76522 12 8.5 12ZM11.5 8H5.5C5.24512 8.00029 4.99997 8.09788 4.81463 8.27285C4.6293 8.44782 4.51776 8.68696 4.50283 8.9414C4.48789 9.19584 4.57067 9.44638 4.73426 9.64184C4.89785 9.83729 5.1299 9.9629 5.383 9.993L5.5 10H11.5C11.7652 10 12.0196 9.89465 12.2071 9.70711C12.3946 9.51957 12.5 9.26522 12.5 9C12.5 8.73479 12.3946 8.48043 12.2071 8.2929C12.0196 8.10536 11.7652 8 11.5 8ZM8.5 3.24631e-06C8.92218 -0.000618833 9.3397 0.088171 9.7251 0.26053C10.1105 0.432888 10.455 0.684908 10.736 1C11.164 1.478 11.44 2.093 11.491 2.772L11.5 3H5.5C5.5 2.275 5.757 1.61 6.185 1.092L6.264 1C6.814 0.386003 7.612 3.24631e-06 8.5 3.24631e-06Z" fill='{{str_contains($Title, 'History') ? '#F9832A' : '#AAAAAA'}}'/>
            </svg>
            <h1 class="text-sm md:text-base transition-all duration-300 {{str_contains($Title, 'History') ? 'text-[#F9832A]' : 'text-[#AAAAAA]'}}">History</h1>
        </a>
        <a href="profile" class="flex flex-col items-center gap-1.5 md:gap-2">
            <svg class="w-[1.7rem] transition-all duration-300" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.49968 10.4098C12.4452 10.4098 14.833 8.28869 14.833 5.67218C14.833 3.05567 12.4452 0.93457 9.49968 0.93457C6.55416 0.93457 4.16634 3.05567 4.16634 5.67218C4.16634 8.28869 6.55416 10.4098 9.49968 10.4098Z" fill="{{str_contains($Title, 'Profile') ? '#F9832A' : '#AAAAAA'}}"/>
                <path d="M12.2775 12.3839H6.7219C3.49967 12.3839 0.833008 14.7527 0.833008 17.615C0.833008 18.3059 1.16634 18.8981 1.83301 19.1942C2.83301 19.6877 5.05523 20.2799 9.49968 20.2799C13.9441 20.2799 16.1663 19.6877 17.1663 19.1942C17.7219 18.8981 18.1663 18.3059 18.1663 17.615C18.1663 14.654 15.4997 12.3839 12.2775 12.3839Z" fill="{{str_contains($Title, 'Profile') ? '#F9832A' : '#AAAAAA'}}"/>
            </svg>
            <h1 class="text-sm md:text-base transition-all duration-300 {{str_contains($Title, 'Profil') ? 'text-[#F9832A]' : 'text-[#AAAAAA]'}}">Profile</h1>
        </a>
    </div>
</nav>
