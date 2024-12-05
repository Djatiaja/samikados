@extends('layouts.seller')

@section('title', 'Manajemen Produk - Seller Dashboard')

@section('search')
<div class="relative w-full">
  <input type="text" placeholder="Search..." class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-red-600">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
<main class="flex-1 p-6">
  <h2 class="text-2xl font-bold mb-6">Manajemen Produk</h2>

  <!-- Filter and Add Product Button -->
  <div class="flex justify-between items-center mb-4">
    <select class="block w-24 md:w-32 lg:w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
      <option value="all">Semua</option>
      <option value="aktif">Aktif</option>
      <option value="nonaktif">Nonaktif</option>
    </select>
    <button onclick="toggleAddProductModal()" class="border border-black px-4 py-2 rounded-lg flex items-center space-x-2">
      <img src="{{ asset('assets/add (1).png') }}" alt="Add Icon">
      <span>Produk</span>
    </button>
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

  <!-- Product Table -->
  <div class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Kategori</th>
          <th class="p-4 text-center border-r border-gray-300">Nama</th>
          <th class="p-4 text-center border-r border-gray-300">Deskripsi</th>
          <th class="p-4 text-center border-r border-gray-300">Stok</th>
          <th class="p-4 text-center border-r border-gray-300">Harga</th>
          <th class="p-4 text-center border-r border-gray-300">Gambar</th>
          <th class="p-4 text-center border-r border-gray-300">Status</th>
          <th class="p-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">Merchandise</td>
          <td class="p-4 text-center border-r border-gray-300">PIN PENITI 58mm</td>
          <td class="p-4 text-center border-r border-gray-300">Temukan solusi praktis untuk kebutuhan promosi.</td>
          <td class="p-4 text-center border-r border-gray-300">250</td>
          <td class="p-4 text-center border-r border-gray-300">Rp4.500</td>
          <td class="p-4 text-center border-r border-gray-300">
            <div class="flex justify-center">
                <img src="https://placehold.co/48x48" alt="Gambar Produk" onclick="toggleImageModal()" class="cursor-pointer">
            </div>
          </td>
          <td class="p-4 text-center border-r border-gray-300">
            <select class="status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-green-500" data-current-status="aktif" onchange="confirmStatusChange(this)">
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </td>
          <td class="p-4 text-center">
            <button onclick="toggleEditProductModal()" class="text-blue-500 mr-2">
              <img src="{{ asset('assets/edit.png') }}" alt="Edit Icon">
            </button>
            <button onclick="toggleDeleteConfirmationModal()" class="text-red-500">
              <img src="{{ asset('assets/delete.png') }}" alt="Delete Icon">
            </button>
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
<!-- Add Product Modal -->
<div id="addProductModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Tambah Produk Baru</h3>
        <form class="space-y-4">
            <label class="block">
                <span class="text-gray-700 font-semibold">Kategori</span>
                <select class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
                    <option>Merchandise</option>
                    <option>T-Shirt</option>
                    <option>Accessories</option>
                    <option>Others</option>
                </select>
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Nama Produk</span>
                <input type="text" placeholder="Masukkan Nama Produk" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Deskripsi</span>
                <textarea class="w-full p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg" rows="3" placeholder="Masukkan deskripsi produk"></textarea>
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Stok Produk</span>
                <input type="number" placeholder="Masukkan Stok Produk" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Harga Produk (Rp)</span>
                <input type="text" placeholder="Masukkan Harga Produk (Rp)" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Gambar Produk</span>
                <input type="file" multiple class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
                <small class="text-gray-500">Dapat memilih lebih dari 1 file.</small>
            </label>
            <div class="flex justify-evenly mt-4">
                <button type="button" onclick="toggleAddProductModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Batal</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tambah Produk</button>
            </div>
        </form>
    </div>
</div>

 <!-- Edit Product Modal -->
<div id="editProductModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Edit Produk</h3>
        <form class="space-y-4">
            <label class="block">
                <span class="text-gray-700 font-semibold">Kategori</span>
                <select id="editProductCategory" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
                    <option>Merchandise</option>
                    <option>T-Shirt</option>
                    <option>Accessories</option>
                    <option>Others</option>
                </select>
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Nama Produk</span>
                <input id="editProductName" type="text" placeholder="Masukkan Nama Produk" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Deskripsi</span>
                <textarea id="editProductDescription" class="w-full p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg" rows="3" placeholder="Masukkan deskripsi produk"></textarea>
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Stok Produk</span>
                <input id="editProductStock" type="number" placeholder="Masukkan Stok Produk" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Harga Produk (Rp)</span>
                <input id="editProductPrice" type="text" placeholder="Masukkan Harga Produk (Rp)" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Gambar Produk</span>
                <input id="editProductImage" type="file" multiple class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
                <small class="text-gray-500">Dapat memilih lebih dari 1 file.</small>
            </label>
            <div class="flex justify-evenly mt-4">
                <button type="button" onclick="toggleEditProductModal()" class="border border-gray-300 px-4 py-2 sm:px-6 sm:py-3 md:px-8 md:py-4 rounded-lg text-sm sm:text-base md:text-lg w-24 sm:w-32 md:w-40">Batal</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 sm:px-6 sm:py-3 md:px-8 md:py-4 rounded-lg text-sm sm:text-base md:text-lg w-24 sm:w-32 md:w-40">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Hapus Produk</h3>
        <p class="text-sm sm:text-base md:text-lg text-center mb-6 sm:mb-8">Apakah Anda yakin ingin menghapus produk ini?</p>
        <div class="flex justify-evenly space-x-4 sm:space-x-6 md:space-x-8 mt-4 sm:mt-6">
            <button onclick="toggleDeleteConfirmationModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Batal</button>
            <button onclick="showSuccessModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Hapus</button>
        </div>
    </div>
</div>

<!-- Success Delete Modal -->
<div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Produk Berhasil Dihapus</h3>
        <img src="{{ asset('assets/success.gif') }}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12 sm:w-1/4">
        <div class="flex justify-center mt-6 sm:mt-8">
            <button type="button" class="bg-red-600 text-white px-4 py-2 sm:px-6 sm:py-3 md:px-8 md:py-4 rounded-lg text-sm sm:text-base md:text-lg w-24 sm:w-32 md:w-40" onclick="closeSuccessModal()">Tutup</button>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/2">
        <div class="flex justify-between items-center mb-4 sm:mb-6">
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold">Gambar Produk</h3>
            <button onclick="toggleImageModal()" class="text-red-600 font-bold text-lg sm:text-xl md:text-2xl">&times;</button>
        </div>
        <div class="flex justify-center items-center">
            <!-- Image Slider -->
            <div class="relative w-full">
                <img id="currentImage" src="https://placehold.co/400x300" alt="Gambar Produk" class="w-full h-auto rounded-md">
                <button class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white bg-black bg-opacity-50 px-2 py-1 sm:px-3 sm:py-2 rounded-full"
                    onclick="prevImage()">&#8249;</button>
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white bg-black bg-opacity-50 px-2 py-1 sm:px-3 sm:py-2 rounded-full"
                    onclick="nextImage()">&#8250;</button>
            </div>
        </div>
        <div class="flex justify-center mt-4 sm:mt-6">
            <button onclick="toggleAddImageModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tambah Gambar</button>
        </div>
    </div>
</div>

<!-- Add Image Modal -->
<div id="addImageModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-30">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Tambah Gambar Baru</h3>
        <form>
            <label class="block mb-4">
                <span class="text-gray-700 text-sm sm:text-base md:text-lg font-semibold">Upload Gambar</span>
                <input type="file" multiple class="w-full mt-2 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg">
            </label>
            <div class="flex justify-evenly space-x-4 sm:space-x-6 md:space-x-8">
                <button type="button" onclick="toggleAddImageModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Batal</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Status Confirmation Modal -->
<div id="statusConfirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Konfirmasi Perubahan Status</h3>
        <p class="text-sm sm:text-base md:text-lg text-center mb-4 sm:mb-6">Apakah Anda yakin ingin mengubah status ini?</p>
        <div class="flex justify-center space-x-2 sm:space-x-4 lg:space-x-16">
            <button id="confirmNo" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tidak</button>
            <button id="confirmYes" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Ya</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
  function toggleAddProductModal() {
    document.getElementById("addProductModal").classList.toggle("hidden");
  }

  function toggleEditProductModal() {
    document.getElementById("editProductModal").classList.toggle("hidden");
  }

  function toggleDeleteConfirmationModal() {
    document.getElementById("deleteConfirmationModal").classList.toggle("hidden");
  }

  function showSuccessModal() {
    document.getElementById("deleteConfirmationModal").classList.add("hidden");
    document.getElementById("successModal").classList.remove("hidden");
  }

  function closeSuccessModal() {
    document.getElementById("successModal").classList.add("hidden");
  }

  function toggleImageModal() {
    document.getElementById("imageModal").classList.toggle("hidden");
  }

  function toggleAddImageModal() {
    document.getElementById("addImageModal").classList.toggle("hidden");
  }
  //Slider Gambar Produk
  function updateImage() {
      document.getElementById("currentImage").src = images[currentIndex];
  }

  function nextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      updateImage();
  }

  function prevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateImage();
  }
  let images = [
      "https://placehold.co/400x300",
      "https://placehold.co/400x300?text=Image+2",
      "https://placehold.co/400x300?text=Image+3"
  ];
  let currentIndex = 0;

  let pendingStatusChange = null;

  function confirmStatusChange(selectElement) {
    const currentStatus = selectElement.dataset.currentStatus || "aktif";
    const selectedStatus = selectElement.value;

    if (currentStatus === selectedStatus) return;

    pendingStatusChange = selectElement;

    const modal = document.getElementById("statusConfirmModal");
    modal.classList.remove("hidden");

    document.getElementById("confirmYes").onclick = function () {
      pendingStatusChange.dataset.currentStatus = selectedStatus;
      updateDropdownClass(pendingStatusChange, selectedStatus);
      modal.classList.add("hidden");
      pendingStatusChange = null;
    };

    document.getElementById("confirmNo").onclick = function () {
      pendingStatusChange.value = currentStatus;
      modal.classList.add("hidden");
      pendingStatusChange = null;
    };
  }

  function updateDropdownClass(selectElement, status) {
    if (status === "aktif") {
      selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-green-500";
    } else if (status === "nonaktif") {
      selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-red-600";
    }
  }
</script>
@endpush
