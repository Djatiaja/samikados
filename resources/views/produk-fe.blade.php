@extends('layouts.view')

@section('title', 'Admin View Product - Samikados')

@section('searchbar')
<div class="relative w-1/2">
    <input type="text" placeholder="Search..." class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
    <!-- Full-width Banner with Swiper Carousel -->
    <section class="relative my-8" style="margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); width: 100vw;">
        <button id="prevBtn" class="absolute left-2 top-1/2 transform -translate-y-1/2 z-10 bg-white text-black p-3 rounded-full mx-2">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="swiper centered-slide-carousel swiper-container relative w-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://placehold.co/1500x500" alt="Banner image 1" class="w-full h-full object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="https://placehold.co/1500x500" alt="Banner image 2" class="w-full h-full object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="https://placehold.co/1500x500" alt="Banner image 3" class="w-full h-full object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="https://placehold.co/1500x500" alt="Banner image 4" class="w-full h-full object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="https://placehold.co/1500x500" alt="Banner image 5" class="w-full h-full object-cover">
                </div>
            </div>
            <!-- Swiper Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <button id="nextBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 z-10 bg-white text-black p-3 rounded-full mx-2">
            <i class="fas fa-chevron-right"></i>
        </button>
    </section>

    <!-- Categories -->
    <main class="container mx-auto mt-8">
        <h2 class="text-lg lg:text-xl font-bold">PILIH KATEGORI ANDA</h2>
        <section class="text-center mt-2 mb-6 border border-gray-300 shadow-lg p-6 rounded-lg">
            <div class="grid grid-cols-3 lg:grid-cols-5 gap-3 max-h-72 overflow-y-scroll">
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Merchandise" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">MERCHANDISE</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for T-Shirt" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">T-SHIRT</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Kanvas" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">KANVAS</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Indoor" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">INDOOR</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Akrilik" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">AKRILIK</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for UV Print" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">UV PRINT</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for A3" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">A3</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Display" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">DISPLAY</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Reklame" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">REKLAME</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/100x100" alt="Icon for Stiker" class="mb-2" width="100" height="100">
                    <span class="text-sm lg:text-base">STIKER</span>
                </div>

            </div>
        </section>
    </main>

    <!-- Products -->
    <section class="container grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto">
        <div class="p-4 mx-auto">
            <a href="{{route('detail-produk-fe')}}">
                <img src="https://placehold.co/400x400" alt="Product image 1" class="w-full mb-2">
                <div class="text-sm lg:text-base">STIKER VINYL CHINA</div>
                <div class="text-gray-500 text-sm lg:text-base">Rp72.800</div>
            </a>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 2" class="w-full mb-2">
            <div class="text-sm lg:text-base">KANVAS ART PREMIUM</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp291.200</div>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 3" class="w-full mb-2">
            <div class="text-sm lg:text-base">KARTU NAMA (2 SIDE)</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp45.500</div>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 4" class="w-full mb-2">
            <div class="text-sm lg:text-base">CUSTOM T-SHIRT 1 SIZE</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp91.000</div>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 5" class="w-full mb-2">
            <div class="text-sm lg:text-base">PRINT & CUT STIKER HVS</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp11.830</div>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 6" class="w-full mb-2">
            <div class="text-sm lg:text-base">POSTER A2 PHOTOPAPER</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp22.300</div>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 7" class="w-full mb-2">
            <div class="text-sm lg:text-base">POSTER A2 ALBATROS</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp22.300</div>
        </div>
        <div class="p-4 mx-auto">
            <img src="https://placehold.co/400x400" alt="Product image 8" class="w-full mb-2">
            <div class="text-sm lg:text-base">ROLL UP BANNER</div>
            <div class="text-gray-500 text-sm lg:text-base">Rp127.400</div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        var swiper = new Swiper('.centered-slide-carousel', {
            centeredSlides: true,
            loop: true,
            initialSlide: 2,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#nextBtn',
                prevEl: '#prevBtn',
            },
            breakpoints: {
                1920: { slidesPerView: 4, spaceBetween: 30 },
                1028: { slidesPerView: 2, spaceBetween: 10 },
                990: { slidesPerView: 1, spaceBetween: 0 }
            }
        });
    </script>
@endsection
