@extends('layouts.view') <!-- Menggunakan layout utama dari view.blade.php -->

@section('title', 'Detail Produk - Samikados')

@section('content')
    <main class="container mx-auto p-8">
        <div class="lg:flex lg:justify-evenly">
            <!-- Product Image & Description -->
            <div class="lg:w-1/3 h-1/3">
                <!-- Slider Container -->
                <div class="relative">
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <!-- Slider Images -->
                        <div id="product-slider" class="flex transition-transform duration-300">
                            <img src="https://placehold.co/600x600" alt="Gambar 1" class="w-full">
                            <img src="https://placehold.co/600x600" alt="Gambar 2" class="w-full">
                            <img src="https://placehold.co/600x600" alt="Gambar 3" class="w-full">
                        </div>
                    </div>
                    <!-- Navigation Buttons -->
                    <button id="prevBtn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-3 py-2 rounded-full">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextBtn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-3 py-2 rounded-full">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <h2 class="text-3xl font-bold mt-4">PIN PENITI 58mm</h2>
                <p class="text-gray-500">10RB+ Terjual</p>
                <p class="mt-4 text-gray-700">
                    Temukan solusi praktis untuk menyatukan kain dan aksesoris dengan Pin Peniti 58mm. Dirancang dengan ukuran ideal untuk
                    penggunaan sehari-hari, pin ini terbuat dari bahan berkualitas tinggi yang memastikan daya tahan dan ketahanan terhadap
                    korosi.
                </p>
            </div>

            <!-- Product Details -->
            <div class="lg:w-1/2 lg:pl-12 mt-8 lg:mt-0">
                <!-- Harga -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold">Harga</h3>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-center">Rp4.500</p>
                </div>

                <!-- Catatan -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold">Catatan</h3>
                    <textarea class="w-full sm:w-3/4 h-24 sm:h-28 border p-2 rounded-lg mt-2 text-sm sm:text-base lg:text-lg" placeholder="Masukkan catatan untuk produk Anda"></textarea>
                    <p class="text-gray-500 mt-1 text-xs sm:text-sm lg:text-base">Contoh: packing pakai selongsong</p>
                </div>

                <!-- Ukuran -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold">Ukuran</h3>
                    <p class="text-gray-500 mb-2 text-xs sm:text-sm lg:text-base">Masukkan ukuran untuk produk Anda</p>
                    <div class="flex items-center">
                        <input type="text" class="border p-2 w-1/2 sm:w-1/3 lg:w-2/12 mr-2 rounded-lg text-sm sm:text-base lg:text-lg" placeholder="Panjang">
                        <span class="mx-2 text-sm sm:text-base lg:text-lg">X</span>
                        <input type="text" class="border p-2 w-1/2 sm:w-1/3 lg:w-2/12 rounded-lg text-sm sm:text-base lg:text-lg" placeholder="Lebar">
                        <span class="ml-2 text-sm sm:text-base lg:text-lg">cm</span>
                    </div>
                </div>

                <!-- Finishing -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-2">Finishing</h3>
                    <select id="finishingSelect" class="w-full sm:w-3/4 border p-2 mb-2 rounded-lg text-sm sm:text-base lg:text-lg" onchange="updatePrice()">
                        <option value="">Tidak Ada yang Dipilih</option>
                        <option value="0">Tanpa Finishing</option>
                        <option value="10000">Finishing + Paperbag (+ Rp10.000)</option>
                    </select>
                    <p id="additionalPrice" class="text-sm sm:text-base lg:text-lg mt-2">Harga Tambahan: Rp0</p>
                </div>
                <!-- Jumlah -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold">Jumlah</h3>
                    <div class="flex items-center mt-2">
                        <button class="bg-white px-4 py-2 rounded-lg text-sm sm:text-base lg:text-lg" id="decrease">-</button>
                        <span id="quantity" class="px-4 text-sm sm:text-base lg:text-lg">1</span>
                        <button class="bg-white px-4 py-2 rounded-lg text-sm sm:text-base lg:text-lg" id="increase">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <section class="mt-8 lg:mx-20">
            <h3 class="text-2xl font-bold mb-10">Ulasan</h3>
            <div class="mt-4">
              <!-- Review Item (Belum Ditanggapi) -->
              <div class="flex flex-col lg:flex-row items-start mb-8">
                <div class="flex flex-col lg:flex-row items-start mr-6 w-1/2">
                  <img src="https://placehold.co/50x50" alt="User profile picture" class="rounded-full mr-4">
                  <div>
                    <span class="font-bold block">Denada Ananda</span>
                    <span class="text-gray-500 text-sm">15.49 | 23 Desember 2023</span>
                    <div class="flex items-center mt-1">
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-1">
                  <p class="text-gray-700">
                    Bahan yang digunakan terasa kokoh dan tahan lama, sehingga saya tidak khawatir tentang
                    kerusakan setelah penggunaan berulang. Ujung pin yang runcing memudahkan untuk menembus berbagai jenis kain, dan saya sangat menghargai kenyamanan saat menggunakannya.
                  </p>
                </div>
              </div>

              <!-- Review Item with Seller Response -->
              <div class="flex flex-col lg:flex-row items-start mb-8">
                <div class="flex flex-col lg:flex-row items-start mr-6 w-1/2">
                  <img src="https://placehold.co/50x50" alt="User profile picture" class="rounded-full mr-4">
                  <div>
                    <span class="font-bold block">Denada Ananda</span>
                    <span class="text-gray-500 text-sm">15.49 | 23 Desember 2023</span>
                    <div class="flex items-center mt-1">
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                      <i class="fas fa-star text-yellow-500"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-1">
                  <p class="text-gray-700">
                    Bahan yang digunakan terasa kokoh dan tahan lama, sehingga saya tidak khawatir tentang
                    kerusakan setelah penggunaan berulang. Ujung pin yang runcing memudahkan untuk menembus berbagai jenis kain, dan saya sangat menghargai kenyamanan saat menggunakannya.
                  </p>
                  <!-- Tanggapan Seller -->
                  <div class="mt-4 p-4 bg-gray-100 rounded-lg border-l-4 border-red-600">
                    <p class="text-gray-800 font-semibold">Tanggapan Seller <span class="text-sm text-gray-500">10.55</span></p>
                    <p class="text-gray-700">Halo Denada Ananda! Terima kasih atas ulasan baiknya, semoga barang awet. Kami menantikan pembelian Anda selanjutnya!</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </main>
@endsection

@section('scripts')
    <!-- JavaScript to handle slider and quantity adjustment -->
    <script>
        // Slider
        const slider = document.getElementById('product-slider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentIndex = 0;

        function updateSlider() {
            const width = slider.clientWidth;
            slider.style.transform = `translateX(-${currentIndex * width}px)`;
        }

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentIndex < slider.children.length - 1) {
                currentIndex++;
                updateSlider();
            }
        });

        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const quantitySpan = document.getElementById('quantity');
        let quantity = 1;

        decreaseButton.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantitySpan.textContent = quantity;
            }
        });

        increaseButton.addEventListener('click', () => {
            quantity++;
            quantitySpan.textContent = quantity;
        });

        function updatePrice() {
        const select = document.getElementById('finishingSelect');
        const additionalPriceText = document.getElementById('additionalPrice');
        const selectedValue = select.value;

        // Update the additional price based on the selected option
        if (selectedValue) {
            additionalPriceText.textContent = `Harga Tambahan: Rp${selectedValue}`;
        } else {
            additionalPriceText.textContent = 'Harga Tambahan: Rp0';
        }
    }
    </script>
@endsection
