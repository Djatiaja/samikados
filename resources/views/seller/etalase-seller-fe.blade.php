@extends('layouts.seller')

@section('title', 'Etalase - Samikados Seller')

@section('search')
<div class="relative w-full">
    <input type="text" placeholder="Search..." class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
<main class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">Etalase</h2>

    <!-- Merchandise Section -->
    <div class="mb-8">
        <div class="flex mb-4">
            <h2 class="text-xl font-semibold">Merchandise</h2>
        </div>
        <!-- Wrapper for horizontal scroll -->
        <div class="overflow-x-auto">
            <div class="grid grid-flow-col auto-cols-max gap-x-4 max-w-screen-lg">
                <!-- Product Card -->
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Merchandise+1" alt="Produk 1" class="w-full mb-4">
                    <h4 class="font-bold">Produk Merchandise 1</h4>
                    <p>Rp85.000</p>
                    <p class="text-sm">1.000+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Merchandise+2" alt="Produk 2" class="w-full mb-4">
                    <h4 class="font-bold">Produk Merchandise 2</h4>
                    <p>Rp90.000</p>
                    <p class="text-sm">2.000+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Merchandise+3" alt="Produk 3" class="w-full mb-4">
                    <h4 class="font-bold">Produk Merchandise 3</h4>
                    <p>Rp95.000</p>
                    <p class="text-sm">3.000+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Merchandise+4" alt="Produk 4" class="w-full mb-4">
                    <h4 class="font-bold">Produk Merchandise 4</h4>
                    <p>Rp100.000</p>
                    <p class="text-sm">4.000+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Merchandise+5" alt="Produk 5" class="w-full mb-4">
                    <h4 class="font-bold">Produk Merchandise 5</h4>
                    <p>Rp105.000</p>
                    <p class="text-sm">5.000+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Merchandise+6" alt="Produk 6" class="w-full mb-4">
                    <h4 class="font-bold">Produk Merchandise 6</h4>
                    <p>Rp110.000</p>
                    <p class="text-sm">6.000+ Terjual</p>
                </article>
            </div>
        </div>
    </div>

    <!-- Accessories Section -->
    <div class="mb-8">
        <div class="flex mb-4">
            <h2 class="text-xl font-semibold">Accessories</h2>
        </div>
        <!-- Wrapper for horizontal scroll -->
        <div class="overflow-x-auto">
            <div class="grid grid-flow-col auto-cols-max gap-x-4 max-w-screen-lg">
                <!-- Product Card -->
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Accessories+1" alt="Produk 1" class="w-full mb-4">
                    <h4 class="font-bold">Produk Accessories 1</h4>
                    <p>Rp55.000</p>
                    <p class="text-sm">500+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Accessories+2" alt="Produk 2" class="w-full mb-4">
                    <h4 class="font-bold">Produk Accessories 2</h4>
                    <p>Rp58.000</p>
                    <p class="text-sm">600+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Accessories+3" alt="Produk 3" class="w-full mb-4">
                    <h4 class="font-bold">Produk Accessories 3</h4>
                    <p>Rp61.000</p>
                    <p class="text-sm">700+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Accessories+4" alt="Produk 4" class="w-full mb-4">
                    <h4 class="font-bold">Produk Accessories 4</h4>
                    <p>Rp64.000</p>
                    <p class="text-sm">800+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Accessories+5" alt="Produk 5" class="w-full mb-4">
                    <h4 class="font-bold">Produk Accessories 5</h4>
                    <p>Rp67.000</p>
                    <p class="text-sm">900+ Terjual</p>
                </article>
                <article class="bg-red-600 text-white p-3 rounded-lg inline-block">
                    <img src="https://placehold.co/250x250?text=Accessories+6" alt="Produk 6" class="w-full mb-4">
                    <h4 class="font-bold">Produk Accessories 6</h4>
                    <p>Rp70.000</p>
                    <p class="text-sm">1.000+ Terjual</p>
                </article>
            </div>
        </div>
    </div>
</main>
@endsection
