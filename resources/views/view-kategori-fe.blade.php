@extends('layouts.view') <!-- Menggunakan layout utama dari view.blade.php -->

@section('title', 'Kategori Produk - Samikados')

@section('searchbar')
<div class="relative w-1/2 mx-auto">
    <input type="text" placeholder="Cari Kategori..." class=" text-xs sm:text-sm lg:text-lg w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
<main class="container mx-auto">

<!-- Merchandise Section -->
<section class="lg:!flex lg:justify-between items-center mb-8">
    <img src="https://placehold.co/1800x1200" alt="Merchandise Image" class="w-full lg:w-1/2">
    <div class="w-full lg:w-1/2 lg:pl-8 mt-4 lg:mt-0 flex flex-col justify-center items-center text-center">
        <h2 class="text-xl lg:text-5xl font-bold">MERCHANDISE</h2>
        <p class="text-gray-700 mt-4 font-normal textsm lg:text-lg lg:w-5/12">
            Nikmati kualitas premium dari berbagai produk yang kami sediakan
        </p>
    </div>
</section>

<!-- Product Categories -->
<section class="flex justify-center items-center mb-8 relative">
    <!-- Tambahkan tombol Prev dan Next -->
    <button id="prevBtn" class="fas fa-chevron-left"></button> <!-- Tombol Prev -->
    <div class="swiper multiple-slide-carousel swiper-container w-11/12">
        <div id="category-slider" class="swiper-wrapper flex transition-transform duration-300">
            <!-- Category 1 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/90x90" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">AKRILIK</span>
            </div>
            <!-- Category 2 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">STIKER</span class="!text-xs sm:!ext-sm lg:!text-base">
            </div>
            <!-- Category 3 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">T-SHIRT</span>
            </div>
            <!-- Category 4 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">KANVAS</span>
            </div>
            <!-- Category 5 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">DISPLAY</span>
            </div>
                <!-- Category 1 -->
                <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">AKRILIK</span>
            </div>
            <!-- Category 2 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">STIKER</span>
            </div>
            <!-- Category 3 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">T-SHIRT</span>
            </div>
            <!-- Category 4 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">KANVAS</span>
            </div>
            <!-- Category 5 -->
            <div class="swiper-slide bg-red-600 text-white !p-7 md:!p-8 rounded-lg !flex items-center !space-x-4 !w-44 md:!w-56 lg:!w-64 !h-10 md:!h-14 lg:!h-20">
                <img src="https://placehold.co/50x50" alt="Category Icon" class="!w-8 !h-8 sm:!w-10 sm:!h-10 lg:!w-12 lg:!h-12">
                <span class="!text-xs sm:!ext-sm lg:!text-base">DISPLAY</span>
            </div>
        </div>
    </div>
    <button id="nextBtn" class="fas fa-chevron-right"></button> <!-- Tombol Next -->
</section>

<!-- Available Products -->
<section>
    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-2">PRODUK TERSEDIA</h3>
    <p class="text-gray-700 text-sm sm:text-base lg:text-lg mb-8">MACAM - MACAM PRODUK</p>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
        <!-- Product 1 -->
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="TUMBLR CUSTOM" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">TUMBLR CUSTOM</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp80.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <!-- Product 2 -->
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="TUMBLR TRAVEL" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">TUMBLR TRAVEL</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp115.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <!-- Product 3 -->
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="SMART TUMBLR LED" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">SMART TUMBLR LED</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp90.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <!-- Product 4 -->
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="PIN PENITI 58mm" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">PIN PENITI 58mm</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp4.500</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <!-- Additional Products -->
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="TOTEBAG PREMIUM" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">TOTEBAG PREMIUM</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp50.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="MUG COUPLE DINO" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">MUG COUPLE DINO</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp40.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="TUMBLR SPORT" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">TUMBLR SPORT</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp50.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
        <a href="{{ route('detail-produk-fe') }}" class="bg-red-600 text-white p-2 sm:p-3 rounded-lg">
            <img src="https://placehold.co/200x200" alt="SPUNBOND CUSTOM" class="w-full mb-2 sm:mb-4 lg:mb-6 rounded-md">
            <h4 class="font-bold text-sm sm:text-base lg:text-lg">SPUNBOND CUSTOM</h4>
            <p class="text-xs sm:text-sm lg:text-base">Rp8.000</p>
            <p class="text-xs sm:text-sm lg:text-base">10RB+ Terjual</p>
        </a>
    </div>
</section>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".multiple-slide-carousel", {
        loop: true,
        slidesPerView: 5, // Display 5 categories at once
        spaceBetween: 20,
        navigation: {
            nextEl: "#nextBtn",  // Menghubungkan tombol Next dengan slider
            prevEl: "#prevBtn",  // Menghubungkan tombol Prev dengan slider
        } 
    });
</script>

@endsection
