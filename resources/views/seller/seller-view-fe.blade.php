@extends('layouts.view-seller')

@section('title', 'Seller View Product - Samikados')

@section('searchbar')
<div class="relative w-1/2 mx-auto">
    <input type="text" placeholder="Search..." class=" text-xs sm:text-sm lg:text-lg w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
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
    <h2 class="text-md sm:text-lg md:text-xl font-bold">PILIH KATEGORI ANDA</h2>
    <section class="text-center mt-4 mb-6 border border-gray-300 shadow-lg p-6 rounded-lg">
        <div class="grid grid-cols-5 gap-4 max-h-72 overflow-y-auto">
            <div class="flex flex-col items-center">
                <a href="{{route('view-kategori-seller-fe')}}"><img src="https://placehold.co/100x100" alt="Icon for Merchandise" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">MERCHANDISE</span></a>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for T-Shirt" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">T-SHIRT</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for Kanvas" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">KANVAS</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for Indoor" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">INDOOR</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for Akrilik" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">AKRILIK</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for UV Print" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">UV PRINT</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for A3" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">A3</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for Display" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">DISPLAY</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for Reklame" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">REKLAME</span>
            </div>
            <div class="flex flex-col items-center">
                <img src="https://placehold.co/100x100" alt="Icon for Stiker" class="mb-2 w-10 h-10 sm:w-16 sm:h-16 lg:w-24 lg:h-24">
                <span class="text-xs sm:text-base lg:text-md">STIKER</span>
            </div>
        </div>
    </section>
</main>

<!-- Products -->
<section class="container grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto">
        <div class="p-4 mx-auto">
            <a href="{{route('detail-produk-seller-fe')}}">
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
                1028: { slidesPerView: 3, spaceBetween: 10 },
                990: { slidesPerView: 2, spaceBetween: 0 }
            }
        });
    </script>
@endsection
