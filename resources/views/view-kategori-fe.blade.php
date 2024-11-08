@extends('layouts.view') <!-- Menggunakan layout utama dari view.blade.php -->

@section('title', 'Kategori Produk - Samikados')

@section('searchbar')
<div class="relative w-1/2">
    <input type="text" placeholder="Search..." class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
    <!-- Merchandise Section -->
    <section class="lg:flex lg:justify-between items-center mb-8">
        <img src="https://placehold.co/600x400" alt="Merchandise Image" class="w-full lg:w-1/2">
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
                <!-- Category List -->
                @foreach(['AKRILIK', 'STIKER', 'T-SHIRT', 'KANVAS', 'DISPLAY'] as $category)
                <div class="swiper-slide bg-red-600 text-white p-8 rounded-lg flex items-center space-x-2 w-1/6 h-20">
                    <img src="https://placehold.co/50x50" alt="Category Icon" class="w-10 h-10">
                    <span>{{ $category }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <button id="nextBtn" class="fas fa-chevron-right"></button> <!-- Tombol Next -->
    </section>

    <!-- Available Products -->
    <section>
        <h3 class="text-xl font-bold mb-2">PRODUK TERSEDIA</h3>
        <p class="text-gray-700 mb-8">MACAM - MACAM PRODUK</p>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['TUMBLR CUSTOM', 'Rp80.000', '10RB+ Terjual'],
                ['TUMBLR TRAVEL', 'Rp115.000', '10RB+ Terjual'],
                ['SMART TUMBLR LED', 'Rp90.000', '10RB+ Terjual'],
                ['PIN PENITI 58mm', 'Rp4.500', '10RB+ Terjual']
            ] as $product)
            <article class="bg-red-600 text-white p-4 rounded-lg">
                <img src="https://placehold.co/200x200" alt="{{ $product[0] }}" class="w-full mb-4">
                <h4 class="font-bold">{{ $product[0] }}</h4>
                <p>{{ $product[1] }}</p>
                <p class="text-sm">{{ $product[2] }}</p>
            </article>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".multiple-slide-carousel", {
            loop: true,
            slidesPerView: 5,
            spaceBetween: 20,
            navigation: {
                nextEl: "#nextBtn",
                prevEl: "#prevBtn",
            },
            breakpoints: {
                1920: { slidesPerView: 6, spaceBetween: 30 },
                1028: { slidesPerView: 5, spaceBetween: 20 },
                990: { slidesPerView: 2, spaceBetween: 15 },
                400: { slidesPerView: 1, spaceBetween: 10 },
                300: { slidesPerView: 1, spaceBetween: 10 }
            }
        });
    </script>
@endsection
