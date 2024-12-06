@extends('layouts.seller')

@section('title', 'Detail Pesanan - Seller Dashboard')

@section('search')
<form action="#" method="GET" class="flex">
  <input 
    type="text" 
    name="search" 
    placeholder="Cari pesanan..." 
    class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white"
  >
  <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
    <img src="{{ asset('assets/search.png') }}" alt="Search Icon" class="w-5 h-5">
  </button>
</form>
@endsection

@section('content')
<main class="flex-1 p-6">
  <h2 class="text-2xl font-bold mb-6">Detail Pesanan</h2>

  <!-- Filter Dropdown -->
  <div class="mb-4">
    <select class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
      <option value="all">Semua</option>
      <option value="masuk">Masuk</option>
      <option value="diproses">Diproses</option>
      <option value="dikirim">Dikirim</option>
    </select>
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

  <!-- Responsive Table -->
  <div class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
        <tr>
        <th class="p-4 text-center border-r border-gray-300">Nomor Pesanan</th>
        <th class="p-4 text-center border-r border-gray-300">Nama Pembeli</th>
        <th class="p-4 text-center border-r border-gray-300">Tanggal Pesanan</th>
        <th class="p-4 text-center border-r border-gray-300">Aksi</th>
        <th class="p-4 text-center">Detail</th>
        </tr>
    </thead>
    <tbody>
        <tr class="border-b border-gray-300">
        <td class="p-4 text-center border-r border-gray-300">001234</td>
        <td class="p-4 text-center border-r border-gray-300">Putri Maharani</td>
        <td class="p-4 text-center border-r border-gray-300">7/10/24</td>
        <td class="p-4 border-r border-gray-300">
            <div class="flex justify-center">
                <select class="status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-red-600" onchange="confirmStatusChange(this)" data-current-status="masuk">
                <option value="masuk" class="bg-red-600 text-white">Masuk</option>
                <option value="diproses" class="bg-yellow-500 text-white">Diproses</option>
                <option value="dikirim" class="bg-blue-500 text-white">Dikirim</option>
                </select>
            </div>
        </td>
        <td class="p-4 text-center">
            <button onclick="toggleModal()" class="text-blue-500">Lihat Detail</button>
        </td>
        </tr>
        <tr class="border-b border-gray-300">
        <td class="p-4 text-center border-r border-gray-300">001235</td>
        <td class="p-4 text-center border-r border-gray-300">Budi Santoso</td>
        <td class="p-4 text-center border-r border-gray-300">7/11/24</td>
        <td class="p-4 border-r border-gray-300">
            <div class="flex justify-center">
                <span class="bg-green-500 text-white py-2 px-4 w-40 text-center rounded-lg">Selesai</span>
            </div>
        </td>
        <td class="p-4 text-center">
            <button onclick="toggleModal()" class="text-blue-500">Lihat Detail</button>
        </td>
        </tr>
    </tbody>
    </table>
  </div>
  
  <!-- Pagination -->
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
<!-- Modal Popup for Order Detail -->
<div id="orderModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
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
            <button onclick="toggleModal()" class="w-full sm:w-40 bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Perubahan Status -->
<div id="statusConfirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Konfirmasi Perubahan Status</h3>
        <p class="text-sm sm:text-base text-center mb-4 sm:mb-6">Apakah Anda yakin ingin mengubah status pesanan?</p>
        <div class="flex justify-center space-x-6 sm:space-x-10 lg:space-x-16">
        <button id="confirmNo" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tidak</button>
            <button id="confirmYes" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Ya</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
  // Fungsi untuk toggle modal detail pesanan
  function toggleModal() {
    const modal = document.getElementById("orderModal");
    modal.classList.toggle("hidden");
  }

  // Fungsi untuk konfirmasi perubahan status
  function confirmStatusChange(selectElement) {
    const currentStatus = selectElement.dataset.currentStatus || "masuk";
    const selectedStatus = selectElement.value;

    if (currentStatus === selectedStatus) {
      return; // Tidak ada perubahan
    }

    // Tampilkan modal konfirmasi
    const modal = document.getElementById("statusConfirmModal");
    modal.classList.remove("hidden");

    // Tindakan saat klik "Ya"
    document.getElementById("confirmYes").onclick = function () {
      // Ubah status
      selectElement.dataset.currentStatus = selectedStatus;

      // Update warna dropdown berdasarkan status
      updateDropdownClass(selectElement, selectedStatus);

      // Disable semua opsi sebelumnya
      disablePreviousOptions(selectElement, selectedStatus);

      // Tutup modal
      modal.classList.add("hidden");
    };

    // Tindakan saat klik "Tidak"
    document.getElementById("confirmNo").onclick = function () {
      // Kembalikan nilai dropdown ke status sebelumnya
      selectElement.value = currentStatus;
      modal.classList.add("hidden");
    };
  }

  // Fungsi untuk memperbarui kelas dropdown berdasarkan status
  function updateDropdownClass(selectElement, status) {
    switch (status) {
      case "masuk":
        selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-red-600";
        break;
      case "diproses":
        selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-yellow-500";
        break;
      case "dikirim":
        selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-orange-500";
        break;
    }
  }

  // Fungsi untuk men-disable opsi status sebelumnya
  function disablePreviousOptions(selectElement, selectedStatus) {
    const options = selectElement.querySelectorAll("option");
    let disable = false;

    options.forEach((option) => {
      if (option.value === selectedStatus) {
        disable = true; // Mulai men-disable opsi sebelumnya setelah status saat ini ditemukan
      }

      if (!disable) {
        option.disabled = true; // Disable semua opsi sebelum status yang dipilih
      }
    });
  }

  // Pagination
  let currentPage = 1;
  const rowsPerPage = 2; // Set the number of rows you want to show per page
  let totalRows = 4; // Total rows in the table (manually set based on the static data you have)

  function showNextData() {
    currentPage++;

    // Logic for showing the next page of data
    // Here we simulate a page navigation. This is just for visual purposes.

    // Enable the 'Previous' button if it's not the first page
    document.getElementById('prevButton').disabled = currentPage === 1;

    // Disable the 'Next' button if it’s the last page (i.e., there's no more data to show)
    if (currentPage * rowsPerPage >= totalRows) {
      document.getElementById('nextButton').disabled = true;
    }
  }
</script>

@endpush
