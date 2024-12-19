@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin Dashboard')

<!-- Jika halaman ini memerlukan search bar, gunakan section 'search' -->
@section('search')
<form action="{{route('manajemen-produk')}}" method="GET" class="relative">
  @foreach (request()->except('search') as $key => $value)
  <input type="hidden" name="{{ $key }}" value="{{ $value }}">
  @endforeach
  <input type="text" name="search" placeholder="Cari Produk..." value="{{ Request::get('search') }}"
    class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5"
    alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6">
  <h2 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Produk</h2>
</div>

<!-- Dropdown Kategori -->
<div class="mb-6">
  <label for="categoryFilter" class="block mb-2 text-sm font-medium text-gray-700">Pilih Kategori Produk:</label>
  <select id="categoryFilter"
    class="block w-full md:w-1/4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600"
    onchange="filterByCategory()">
    <option value="all" {{ Request::get('category') == '' ? 'selected' : '' }}>Semua Kategori</option>
    @foreach ($categories as $category)
    <option value="{{ $category->name }}" {{ Request::get('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
    @endforeach
  </select>
</div>
<!-- Entries per page -->
<!-- <div class="mb-4">
    <label for="entriesPerPage" class="mr-2">Entries per page:</label>
    <select id="entriesPerPage" class="p-2 border border-gray-300 rounded-md" onchange="changeEntriesPerPage()">
      <option value="10">10</option>
      <option value="25" selected>25</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
  </div> -->

<!-- Tabel Produk -->
<div id="productsTable" class="overflow-x-auto rounded-lg shadow-md">
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
    <tbody id="productsBody">
      <!-- Data produk akan ditampilkan di sini berdasarkan filter kategori -->
      @foreach ($products as $product)
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$product->name}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Rp. {{ number_format($product->price, 0, ',',
          '.') }}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$product->seller->name}}</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">{{$product->is_publish?"publish":"Not Publish"}}</td>
        <td class="p-4 text-center align-middle flex justify-center">
          <form action="{{route('manajemen-produk.unpublish',$product->id)}}" method="post" id="toggleStatusForm{{$product->id}}">
            @csrf
            @method("PUT")
            <label for="toggleFour{{$product->id}}" class="flex items-center cursor-pointer select-none text-dark dark:text-white">
              <div class="relative">
                <input type="checkbox" id="toggleFour{{$product->id}}" class="peer sr-only" onchange="togglePublish(this, {{$product->id}})" {{ $product->is_publish ?'checked' : '' }} />
                <div class="block h-8 rounded-full bg-gray-300 w-14 peer-checked:bg-red-600"></div>
                <div class="absolute flex items-center justify-center w-6 h-6 transition bg-white rounded-full left-1 top-1 dark:bg-red-600 peer-checked:translate-x-full peer-checked:bg-white"></div>
              </div>
            </label>
          </form>
        </td>
      </tr>
      @endforeach


    </tbody>
  </table>
</div>
<!-- Pagination -->
<!-- <div class="overflow-x-auto mt-4">
      <nav class="flex items-center gap-x-4 justify-center">
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
  </div> -->

<!-- Pagination -->
<div class="mt-4">
  {{ $products->links() }}
</div>
@endsection

@section('modal')
<!-- Modal Konfirmasi Publish -->
<div id="publishConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Publish</h3>
    <p class="text-center">Apakah Anda yakin ingin mempublish produk ini?</p>
    <div class="flex justify-evenly mt-6">
      <button class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3" id="publishConfirmModalConfirmButton">Ya</button>
      <button class="bg-gray-300 py-2 px-4 rounded-lg w-1/3" id="publishConfirmModalCancelButton">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Unpublish -->
<div id="unpublishConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Unpublish</h3>
    <p class="text-center">Apakah Anda yakin ingin mengunpublish produk ini?</p>
    <div class="flex justify-evenly mt-6">
      <button class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3" id="unpublishConfirmModalConfirmButton" type="button">Ya</button>
      <button class="bg-gray-300 py-2 px-4 rounded-lg w-1/3" id="unpublishConfirmModalCancelButton" type="button">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Sukses Unpublish -->
@if (Session::get("success")==="unpublish")
<div id="successUnpublishModal"
  class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Produk Berhasil Unpublish</h3>
    <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button onclick="closeSuccessUnpublishModal()" type="button"
        class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3">Tutup</button>
    </div>
  </div>
</div>
@endif

@if (Session::get("success")==="publish")

<!-- Modal Sukses Publish -->
<div id="successPublishModal"
  class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Produk Berhasil publish</h3>
    <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button onclick="closeSuccessPublishModal()" type="button"
        class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3">Tutup</button>
    </div>
  </div>
</div>
@endif

@endsection

@push('scripts')
<script>
  // Filter Produk Berdasarkan Kategori
  function filterByCategory() {
    var selectedCategory = document.getElementById('categoryFilter').value;
    // Mengubah URL dengan parameter filter dan mengirimkan permintaan ke backend
    var searchQuery = "{{ Request::get('search') }}";
    var href = '?category=' + selectedCategory;
    if (selectedCategory == 'all') {
      href = '?';
    }
    if (searchQuery) {
      href += '&search=' + searchQuery;
    }
    window.location.href = href;
  }

  function togglePublish(checkbox, id) {
    var currentCheckbox = checkbox;
    var currentRow = checkbox.closest('tr');
    if (checkbox.checked) {
      openPublishConfirmModal();
      document.getElementById("publishConfirmModalConfirmButton").onclick = function() {
        submitForm(id);
      };
      document.getElementById("publishConfirmModalCancelButton").onclick = function() {
        closePublishConfirmModal(id);
      };
    } else {
      openUnpublishConfirmModal();
      document.getElementById("unpublishConfirmModalConfirmButton").onclick = function() {
        submitForm(id);
      };
      document.getElementById("unpublishConfirmModalCancelButton").onclick = function() {
        closeUnpublishConfirmModal(id);
      };
    }
  }

  function openPublishConfirmModal() {
    document.getElementById('publishConfirmModal').classList.remove('hidden');
  }

  function closePublishConfirmModal(id) {
    document.getElementById('publishConfirmModal').classList.add('hidden');
    console.log("toggleStatusForm" + id)

    document.getElementById("toggleFour" + id).checked = !document.getElementById("toggleFour" + id).checked;
  }

  function submitForm(id) {
    document.getElementById("toggleStatusForm" + id).submit();
  }


  // Modal Konfirmasi Hapus
  function openUnpublishConfirmModal() {
    document.getElementById('unpublishConfirmModal').classList.remove('hidden');

  }

  function closeUnpublishConfirmModal(id) {
    document.getElementById('unpublishConfirmModal').classList.add('hidden');
    document.getElementById("toggleFour" + id).checked = !document.getElementById("toggleFour" + id).checked;
  }


  // Modal Sukses Hapus
  function openSuccessUnpublishModal() {
    document.getElementById('successUnpublishModal').classList.remove('hidden');
  }

  function closeSuccessUnpublishModal() {
    document.getElementById('successUnpublishModal').classList.add('hidden');
  }

  function closeSuccessPublishModal() {
    document.getElementById('successUnpublishModal').classList.add('hidden');
  }

</script>
@endpush