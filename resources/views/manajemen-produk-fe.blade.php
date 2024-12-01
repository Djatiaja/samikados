@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin Dashboard')

@section('search')
<form action="#" method="GET" class="relative">
  <input type="text" name="search" placeholder="Cari Produk..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6">
  <h2 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Produk</h2>
</div>

<!-- Dropdown Kategori -->
<div class="mb-6">
  <label for="categoryFilter" class="block mb-2 text-sm font-medium text-gray-700">Pilih Kategori Produk:</label>
  <select id="categoryFilter" class="block w-full md:w-1/4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" onchange="filterByCategory()">
    <option value="all">Semua Kategori</option>
    <option value="merchandise">Merchandise</option>
    <option value="kanvas">Kanvas</option>
    <option value="tshirt">T-Shirt</option>
  </select>
</div>

<!-- Tabel Produk -->
<div id="accountsTable" class="overflow-x-auto rounded-lg shadow-md">
<table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
        <tr>
            <th class="p-4 text-center border-r border-gray-300 min-w-[150px] md:min-w-0">Nama Produk</th>
            <th class="p-4 text-center border-r border-gray-300 min-w-[200px] md:min-w-0">Harga</th>
            <th class="p-4 text-center border-r border-gray-300 min-w-[100px] md:min-w-0">Seller</th>
            <th class="p-4 text-center border-r border-gray-300 min-w-[100px] md:min-w-0">Status</th>
            <th class="p-4 text-center border-gray-300 min-w-[100px] md:min-w-0">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="border-b border-gray-300">
            <td class="p-4 text-center align-middle border-r border-gray-300">Nama Produk</td>
            <td class="p-4 text-center align-middle border-r border-gray-300">Rp0</td>
            <td class="p-4 text-center align-middle border-r border-gray-300">Nama Seller</td>
            <td class="p-4 text-center align-middle border-r border-gray-300">Published</td>
            <td class="p-4 text-center align-middle flex justify-center">
                <label for="toggleFour" class="flex items-center cursor-pointer select-none text-dark dark:text-white">
                    <div class="relative">
                        <input type="checkbox" id="toggleFour" class="peer sr-only" onchange="togglePublish(this)" />
                        <div class="block h-8 rounded-full bg-gray-300 w-14 peer-checked:bg-red-600"></div>
                        <div class="absolute flex items-center justify-center w-6 h-6 transition bg-white rounded-full left-1 top-1 dark:bg-red-600 peer-checked:translate-x-full peer-checked:bg-white"></div>
                    </div>
                </label>
            </td>
       <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
    </tbody>
</table>

</div>

<!-- Modal Konfirmasi Publish -->
<div id="publishConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Publish</h3>
        <p class="text-center">Apakah Anda yakin ingin mempublish produk ini?</p>
        <div class="flex justify-evenly mt-6">
            <button onclick="confirmPublish()" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Ya</button>
            <button onclick="closePublishConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Unpublish -->
<div id="unpublishConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Unpublish</h3>
        <p class="text-center">Apakah Anda yakin ingin mengunpublish produk ini?</p>
        <div class="flex justify-evenly mt-6">
            <button onclick="confirmUnpublish()" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Ya</button>
            <button onclick="closeUnpublishConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
  function filterByCategory() {
    var selectedCategory = document.getElementById('categoryFilter').value;
    window.location.href = '?category=' + selectedCategory;
  }

  let currentCheckbox; 
  let currentRow; 

  function togglePublish(checkbox) {
    currentCheckbox = checkbox; 
    currentRow = checkbox.closest('tr'); 
    const statusCell = currentRow.querySelector('td:nth-child(4)'); 

    if (checkbox.checked) {
      openPublishConfirmModal();
    } else {
      openUnpublishConfirmModal();
    }
  }

  function openPublishConfirmModal() {
    document.getElementById('publishConfirmModal').classList.remove('hidden');
  }

  function closePublishConfirmModal() {
    document.getElementById('publishConfirmModal').classList.add('hidden');
  }

  function confirmPublish() {
    const statusCell = currentRow.querySelector('td:nth-child(4)');
    statusCell.textContent = 'Published'; // Update status
    closePublishConfirmModal();
  }

  function openUnpublishConfirmModal() {
    document.getElementById('unpublishConfirmModal').classList.remove('hidden');
  }

  function closeUnpublishConfirmModal() {
    document.getElementById('unpublishConfirmModal').classList.add('hidden');
  }

  function confirmUnpublish() {
    const statusCell = currentRow.querySelector('td:nth-child(4)');
    statusCell.textContent = 'Unpublished'; // Update status
    closeUnpublishConfirmModal();
  }
</script>
@endpush
