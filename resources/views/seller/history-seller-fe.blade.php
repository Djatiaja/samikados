@extends('layouts.seller')

@section('title', 'History - Seller Dashboard')

@section('search')
<div class="relative w-full">
    <input type="text" placeholder="Cari Riwayat.." class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
<main class="flex-1 p-6">
    <h2 class="text-2xl font-bold mb-6">History Pesanan</h2>

    <!-- Filter Dropdown and Add History Button -->
    <div class="flex justify-between items-center mb-4">
        <select class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
            <option value="all">Semua</option>
            <option value="selesai">Selesai</option>
            <option value="batal">Batal</option>
        </select>
        <button onclick="toggleAddHistoryModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg">+ Tambah History</button>
    </div>

    <!-- Entries per page -->
    <div class="mb-4">
        <label for="entriesPerPage" class="mr-2">Entries per page:</label>
        <select id="entriesPerPage" class="p-2 border border-gray-300 rounded-md" onchange="changeEntriesPerPage()">
        <option value="10">10</option>
        <option value="25" selected>25</option>
        <option value="50">50</option>
        <option value="100">100</option>
        </select>
    </div>

    <!-- Order History Table -->
    <div class="overflow-auto rounded-lg shadow-md">
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="p-4 text-center border-r border-gray-300">Nomor Pesanan</th>
                    <th class="p-4 text-center border-r border-gray-300">Nama Pembeli</th>
                    <th class="p-4 text-center border-r border-gray-300">Tanggal Mulai</th>
                    <th class="p-4 text-center border-r border-gray-300">Tanggal Selesai</th>
                    <th class="p-4 text-center border-r border-gray-300">Pendapatan</th>
                    <th class="p-4 text-center border-r border-gray-300">Status</th>
                    <th class="p-4 text-center">Detail</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Order Row -->
                <tr class="border-b border-gray-300">
                    <td class="p-4 text-center border-r border-gray-300">001234</td>
                    <td class="p-4 text-center border-r border-gray-300">Putri Maharani</td>
                    <td class="p-4 text-center border-r border-gray-300">7/10/24</td>
                    <td class="p-4 text-center border-r border-gray-300">10/10/24</td>
                    <td class="p-4 text-center border-r border-gray-300">Rp225.000</td>
                    <td class="p-4 text-center border-r border-gray-300 text-green-500">Selesai</td>
                    <td class="p-4 text-center text-blue-500 cursor-pointer" onclick="toggleDetailModal()">Lihat Detail</td>
                </tr>
                
                <tr class="border-b border-gray-300">
                    <td class="p-4 text-center border-r border-gray-300">001234</td>
                    <td class="p-4 text-center border-r border-gray-300">Putri Maharani</td>
                    <td class="p-4 text-center border-r border-gray-300">7/10/24</td>
                    <td class="p-4 text-center border-r border-gray-300">10/10/24</td>
                    <td class="p-4 text-center border-r border-gray-300">Rp225.000</td>
                    <td class="p-4 text-center border-r border-gray-300 text-red-600">Batal</td>
                    <td class="p-4 text-center text-blue-500 cursor-pointer" onclick="toggleDetailModal()">Lihat Detail</td>
                </tr>
            </tbody>
        </table>
    </div>
    <nav class="flex items-center gap-x-4 min-w-max mt-4 justify-center">
        <a id="prevButton" class="text-gray-500 hover:text-gray-900 p-4 inline-flex items-center" href="javascript:;" onclick="changePage('prev')" disabled>
        <span>Back</span>
        </a>
        <a id="page1" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;" aria-current="page">1</a>
        <a id="page2" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;">2</a>
        <a id="page3" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;">3</a>
        <a id="page4" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-red-600 hover:bg-red-50" href="javascript:;">4</a>
        <a class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-indigo-600 hover:bg-indigo-50" href="javascript:;">...</a>
        <a id="page10" class="w-10 h-10 text-gray-500 p-2 inline-flex items-center justify-center border border-gray-200 bg-gray-50 rounded-full transition-all duration-150 hover:text-indigo-900 hover:border-indigo-600 hover:bg-indigo-50" href="javascript:;">10</a>
        <a id="nextButton" class="text-gray-500 hover:text-gray-900 p-4 inline-flex items-center" href="javascript:;" onclick="changePage('next')">
        <span>Next</span>
        </a>
    </nav>
</main>
@endsection

@section('modal')
<!-- Add History Modal -->
<div id="addHistoryModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Tambah History Pembelian</h3>
        <form class="space-y-4">
            <label class="block">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Nama Pembeli</span>
                <input type="text" placeholder="Masukkan Nama Pembeli" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Nama Produk</span>
                <input type="text" placeholder="Masukkan Nama Produk" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Kategori Produk</span>
                <select class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
                    <option>Merchandise</option>
                    <option>Banner</option>
                    <option>Accessories</option>
                    <option>Others</option>
                </select>
            </label>
            <label class="block">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Catatan</span>
                <textarea class="w-full p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg" rows="3" placeholder="Tambahkan catatan jika diperlukan"></textarea>
            </label>
            <label class="block">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Jumlah Pembelian</span>
                <input type="number" placeholder="Masukkan Jumlah Pembelian" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Tanggal Pembelian</span>
                <input type="date" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <div class="flex justify-evenly space-x-4 sm:space-x-6 md:space-x-8 mt-4 sm:mt-6">
                <button type="button" onclick="toggleAddHistoryModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Batal</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tambah History</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Popup for Order Detail -->
<div id="detailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Detail Pesanan</h3>
        <div class="grid grid-cols-[120px_10px_auto] gap-y-2 sm:gap-y-4 md:gap-y-6 px-4 sm:px-6 md:px-8">
            <div class="font-semibold text-sm sm:text-base text-left">Kategori</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">Merchandise</div>

            <div class="font-semibold text-sm sm:text-base text-left">Nama Produk</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">PIN PENITI 58mm</div>

            <div class="font-semibold text-sm sm:text-base text-left">Catatan</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">Packing pakai selongsong</div>

            <div class="font-semibold text-sm sm:text-base text-left">Ukuran</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">15 X 15 cm</div>

            <div class="font-semibold text-sm sm:text-base text-left">Finishing</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">Dengan Finishing</div>

            <div class="font-semibold text-sm sm:text-base text-left">Jumlah</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">50</div>
        </div>
        <div class="mt-6 sm:mt-8 text-center">
            <button onclick="toggleDetailModal()" class="w-full sm:w-40 bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleAddHistoryModal() {
        document.getElementById('addHistoryModal').classList.toggle('hidden');
    }

    function toggleDetailModal() {
        document.getElementById('detailModal').classList.toggle('hidden');
    }
</script>
@endpush
