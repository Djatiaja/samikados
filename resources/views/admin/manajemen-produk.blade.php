@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin Dashboard')

<!-- Jika halaman ini memerlukan search bar, gunakan section 'search' -->
@section('search')
<form action="{{route('manajemen-produk.search')}}" method="GET" class="relative">
  <input type="text" name="search" placeholder="Cari Produk..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-bold">Manajemen Produk</h2>
</div>

<!-- Dropdown Kategori -->
<div class="mb-6">
  <label for="categoryFilter" class="block mb-2 text-sm font-medium text-gray-700">Pilih Kategori Produk:</label>
  <select id="categoryFilter" class="block w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" onchange="filterByCategory()">
    <option value="all">Semua Kategori</option>
    <option value="merchandise">Merchandise</option>
    <option value="kanvas">Kanvas</option>
    <option value="tshirt">T-Shirt</option>
  </select>
</div>

<!-- Tabel Produk -->
<div id="productsTable" class="overflow-auto rounded-lg shadow-md">
  <table class="w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
      <tr>
        <th class="p-4 text-center border-r border-gray-300">Nama Produk</th>
        <th class="p-4 text-center border-r border-gray-300">Harga</th>
        <th class="p-4 text-center border-r border-gray-300">Seller</th>
        <th class="p-4 text-center border-r border-gray-300">Status</th>
        <th class="p-4 text-center">Aksi</th>
      </tr>
    </thead>
    <tbody id="productsBody">
      <!-- Data produk akan ditampilkan di sini berdasarkan filter kategori -->
      @foreach ($products as $product)
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$product->name}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$product->seller->name}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$product->is_publish?"publish":"Not Publish"}}</td>
        <td class="p-4 text-center align-middle">
          <button onclick="openUnpublishConfirmModal({{$product->id}})" class="text-white p-2 rounded">
            <img src="{{ asset('assets/Delete.png') }}" alt="Ikon Hapus">
          </button>
        </td>
      </tr>
      @endforeach


    </tbody>
  </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="UnpublishConfirmModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
  <form class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3" method="POST" id="unpublishForm">
    @csrf
    @method("PUT")
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Unpublish</h3>
    <p class="text-center">Apakah Anda yakin ingin Unpublish produk ini?</p>
    <div class="flex justify-evenly mt-6">
      <button onclick="UnpublishProduct()" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Unpublish</button>
      <button onclick="closeUnpublishConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
    </div>
  </form>
</div>

<!-- Modal Sukses Hapus -->
<div id="successUnpublishModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Produk Berhasil Unpublish</h3>
    <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button onclick="closeSuccessUnpublishModal()" type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3">Tutup</button>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  // Filter Produk Berdasarkan Kategori
  function filterByCategory() {
    var selectedCategory = document.getElementById('categoryFilter').value;
    // Mengubah URL dengan parameter filter dan mengirimkan permintaan ke backend
    window.location.href = '?category=' + selectedCategory;
  }

  // Modal Konfirmasi Hapus
  function openUnpublishConfirmModal(id) {
    document.getElementById('UnpublishConfirmModal').classList.remove('hidden');
    document.getElementById('unpublishForm').action = "{{route('manajemen-produk.unpublish','')}}/" + id;

  }

  function closeUnpublishConfirmModal() {
    document.getElementById('UnpublishConfirmModal').classList.add('hidden');
  }

  // Modal Sukses Hapus
  function openSuccessUnpublishModal() {
    document.getElementById('successUnpublishModal').classList.remove('hidden');
  }

  function closeSuccessUnpublishModal() {
    document.getElementById('successUnpublishModal').classList.add('hidden');
  }

  // Fungsi Hapus Produk
  function UnpublishProduct() {
    closeUnpublishConfirmModal();
    // Simulasi penghapusan produk dengan delay sebelum modal sukses muncul
    setTimeout(() => {
      openSuccessUnpublishModal();
    }, 500);
  }
</script>
@endpush