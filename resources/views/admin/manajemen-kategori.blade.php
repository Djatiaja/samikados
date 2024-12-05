@extends('layouts.admin')

@section('title', 'Manajemen Kategori - Admin Dashboard')

@section('search')
  <form action="{{route('manajemen-kategori')}}" method="GET" class="relative">
    @foreach (request()->except('search') as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <input type="text" name="search" placeholder="Cari Kategori..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
  </form>
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-sm sm:text-md lg:text-2xl font-bold mb-4 md:mb-0">Manajemen Kategori</h2>
    <button onclick="openAddCategoryModal()" class="border border-black px-4 py-2 rounded-lg flex items-center space-x-2 text-sm sm:text-base">
        <img src="{{ asset('assets/add (1).png') }}" alt="Add Icon" class="w-3 h-3">
        <span class="text-sm sm:text-md">Kategori</span>
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
<!-- Tabel Kategori -->
<div class="overflow-x-auto rounded-lg shadow-md">
<table class="min-w-full w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
        <tr>
            <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[150px]">Nama Kategori</th>
            <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[200px]">Deskripsi</th>
            <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[150px]">Jumlah Produk</th>
            <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[100px]">Icon</th>
            <th class="p-4 text-center border-gray-300 text-sm sm:text-base lg:text-lg min-w-[120px]">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Example category with products -->
         @foreach ($categories as $category)
        <tr class="border-b border-gray-300">
            <td class="p-4 text-center border-r border-gray-300">
                <a href="{{ route('kategori-fe') }}" class="text-sm sm:text-base lg:text-lg">{{$category->name}}</a>
            </td>
            <td class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg">{{$category->description}}</td>
            <td class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg" id="productCount">{{$category->product_count}}</td>
            <td class="p-4 text-center border-r border-gray-300">
                <img src="{{ asset($category->icon) }}" alt="Icon" class="mx-auto w-8 h-8 sm:w-9 sm:h-9 object-cover">
            </td>
            <td class="p-4 text-center flex justify-center items-center space-x-2">
                <button class="editCategory p-2" onclick="openEditCategoryModal({{$category->id}})" id="editCategory{{$category->id}}">
                    <img src="{{ asset('assets/edit.png') }}" alt="Edit Icon" class="w-6 h-6 lg:w-8 lg:h-8">
                </button>
                <button class="p-2" onclick="checkDeleteCategory({{$category->product_count}},{{$category->id}})">
                    <img src="{{ asset('assets/delete.png') }}" alt="Delete Icon" class="w-6 h-6 lg:w-8 lg:h-8">
                </button>
            </td>
        </tr>
         @endforeach

        <tr class="border-b border-gray-300">
            <td class="p-4 text-center border-r border-gray-300">
                <a href="{{ route('kategori-fe') }}" class="text-sm sm:text-base lg:text-lg">Empty Category</a>
            </td>
            <td class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg">Kategori tanpa produk</td>
            <td class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg" id="emptyCategoryProductCount">0</td>
            <td class="p-4 text-center border-r border-gray-300">
                <img src="https://placehold.co/48x48" alt="Icon" class="mx-auto w-8 h-8 sm:w-9 sm:h-9 object-cover">
            </td>
            <td class="p-4 text-center flex justify-center items-center space-x-2">
                <button class="p-1" onclick="openEditCategoryModal()">
                    <img src="{{ asset('assets/edit.png') }}" alt="Edit Icon" class="w-6 h-6 lg:w-8 lg:h-8">
                </button>
                <button class="p-1" onclick="checkDeleteCategory(0)">
                    <img src="{{ asset('assets/delete.png') }}" alt="Delete Icon" class="w-6 h-6 lg:w-8 lg:h-8">
                </button>
            </td>
        </tr>
    </tbody>
</table>
</div>

<!-- Pagination -->
<div class="overflow-x-auto mt-4">
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
  </div>
@endsection

@section('modal')

<!-- Modal: Add Category -->
<div id="addCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Tambah Kategori Baru</h3>
        <form id="addCategoryForm" action="{{route('manajemen-kategori.store')}}" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Nama Kategori</label>
                <input type="text" id="categoryName" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan nama kategori" name="name">
                <p id="categoryNameError" class="text-red-500 text-sm hidden">Nama kategori harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Deskripsi</label>
                <textarea id="categoryDescription" class="w-full p-2 border border-gray-300 rounded-lg" rows="3" placeholder="Masukkan deskripsi kategori" name="description"></textarea>
                <p id="categoryDescriptionError" class="text-red-500 text-sm hidden">Deskripsi harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Icon</label>
                <input type="file" id="categoryIcon" class="w-full p-2 border border-gray-300 rounded-lg"  accept="image/*" name="icon">
                <p id="categoryIconError" class="text-red-500 text-sm hidden">Ikon harus dipilih.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Banner</label>
                <input type="file" id="categoryBanner" class="w-full p-2 border border-gray-300 rounded-lg"  accept="image/*" name="banner">
                <p id="categoryBannerError" class="text-red-500 text-sm hidden">Banner harus dipilih.</p>
            </div>
            <div class="flex justify-evenly">
                <button type="submit" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg">Tambah Kategori</button>
                <button type="button" onclick="closeAddCategoryModal()" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg">Batal</button>
            </div>
        </form>
    </div>
</div>

  @if (session('add-success'))
  <!-- Modal: Success Add Category -->
  <div id="successAddModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
      <h3 class="text-2xl mb-4 font-semibold text-center">Kategori Berhasil Ditambahkan</h3>
      <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
      <div class="flex justify-center mt-10">
        <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessAddModal()">Tutup</button>
      </div>
    </div>
  </div>

  @endif

  <!-- Modal: Confirm Add Category -->
  <div id="addConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
      <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Tambah Kategori</h3>
      <p class="text-center">Apakah Anda yakin ingin menambahkan kategori ini?</p>
      <div class="flex justify-evenly mt-6">
        <button onclick="submitCategory()" class="bg-red-600 w-1/3 text-white py-2 px-4 mx-2 rounded-lg">Ya</button>
        <button onclick="closeAddConfirmModal()" class="bg-gray-300 w-1/3 py-2 px-4 mx-2 rounded-lg">Batal</button>
      </div>
    </div>
  </div>

 <!-- Modal: Edit Category -->
<div id="editCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Edit Kategori</h3>
    <form action="" method="POST" id="FormEdit" enctype="multipart/form-data">
      @csrf
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Nama Kategori</label>
                <input type="text" id="editCategoryName" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nama Kategori" name="name">
                <p id="editCategoryNameError" class="text-red-500 text-sm hidden">Nama kategori harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Deskripsi</label>
                <textarea id="editCategoryDescription" class="w-full p-2 border border-gray-300 rounded-lg" rows="3" placeholder="Deskripsi Kategori" name="description"></textarea>
                <p id="editCategoryDescriptionError" class="text-red-500 text-sm hidden">Deskripsi harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Icon</label>
                <input type="file" id="editCategoryIcon" class="w-full p-2 border border-gray-300 rounded-lg" name="icon"  accept="image/*">
                <p id="editCategoryIconError" class="text-red-500 text-sm hidden">Ikon harus dipilih.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Banner</label>
                <input type="file" id="editCategoryBanner" class="w-full p-2 border border-gray-300 rounded-lg" name="banner" accept="image/*">
                <p id="editCategoryBannerError" class="text-red-500 text-sm hidden">Banner harus dipilih.</p>
            </div>
            <div class="flex justify-evenly">
                <button type="submit" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg">Edit Kategori</button>
                <button type="button" onclick="closeEditCategoryModal()" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Confirm Edit Category -->
<div id="editConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
    <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Edit Kategori</h3>
    <p class="text-center">Apakah Anda yakin ingin menyimpan perubahan kategori ini?</p>
    <div class="flex justify-evenly mt-6">
      <button onclick="submitEditCategory()" class="bg-red-600 w-1/3 text-white py-2 px-4 mx-2 rounded-lg">Ya</button>
      <button onclick="closeEditConfirmModal()" class="bg-gray-300 w-1/3 py-2 px-4 mx-2 rounded-lg">Batal</button>
    </div>
  </div>
</div>

@if (session("update-success"))
<!-- Modal: Success Edit Category -->
<div id="successEditModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Kategori Berhasil Diedit</h3>
    <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessEditModal()">Tutup</button>
    </div>
  </div>
</div>

@endif

  <!-- Modal: Confirm Delete Category -->
  <div id="deleteConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <form action="" id="FormDelete" method="POST">
      @csrf
      @method('DELETE')
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
      <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Hapus Kategori</h3>
      <p class="text-center">Apakah Anda yakin ingin menghapus kategori ini?</p>
      <div class="flex justify-evenly mt-6">
        <button onclick="submitDeleteCategory()" class="bg-red-600 w-1/3 text-white py-2 px-4 mx-2 rounded-lg">Ya</button>
        <button onclick="closeDeleteConfirmModal()" class="bg-gray-300 w-1/3 py-2 px-4 mx-2 rounded-lg">Batal</button>
      </div>
    </div>
    </form>
  </div>

@if (session('delete-success'))
  <!-- Modal: Success Delete Category -->
  <div id="successDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
      <h3 class="text-2xl mb-4 font-semibold text-center">Kategori Berhasil Dihapus</h3>
      <img src="{{asset('assets/SuccessAnimation.gif')}}" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
      <div class="flex justify-center mt-10">
        <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessDeleteModal()">Tutup</button>
      </div>
    </div>
  </div>

@endif



  <!-- Modal: Warning Cannot Delete Category -->
  <div id="cannotDeleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
      <h3 class="text-2xl mb-4 font-semibold text-center text-red-600">Kategori Tidak Bisa Dihapus</h3>
      <p class="text-center">Kategori ini masih memiliki produk dan tidak dapat dihapus.</p>
      <div class="flex justify-center mt-10">
        <button type="button" class="bg-gray-300 py-3 px-4 rounded-lg w-1/3" onclick="closeCannotDeleteModal()">Tutup</button>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  // Tambah Kategori
function openAddCategoryModal() {
  document.getElementById('addCategoryModal').classList.remove('hidden');
}

function closeAddCategoryModal() {
  document.getElementById('addCategoryModal').classList.add('hidden');
}

function openAddConfirmModal() {
  document.getElementById('addConfirmModal').classList.remove('hidden');
}

function closeAddConfirmModal() {
  document.getElementById('addConfirmModal').classList.add('hidden');
}

function submitCategory() {
  closeAddConfirmModal();
  closeAddCategoryModal();
  setTimeout(() => {
    document.getElementById('successAddModal').classList.remove('hidden');
  }, 500);
}

function closeSuccessAddModal() {
  document.getElementById('successAddModal').classList.add('hidden');
}

// Edit Kategori
  function openEditCategoryModal(id) {
  document.getElementById('editCategoryModal').classList.remove('hidden');
    var editButton = document.getElementById("editCategory"+id);
    var row = editButton.closest("tr");
    var data = row.getElementsByTagName('td');

    document.getElementById("FormEdit").action = "{{route('manajemen-kategori.update', '')}}/" + id;  
    document.getElementById("editCategoryName").value = data[0].innerText;  
    document.getElementById("editCategoryDescription").value = data[1].innerText;  
}

function closeEditCategoryModal() {
  document.getElementById('editCategoryModal').classList.add('hidden');
}

function openEditConfirmModal() {
  document.getElementById('editConfirmModal').classList.remove('hidden');
}

function closeEditConfirmModal() {
  document.getElementById('editConfirmModal').classList.add('hidden');
}

function submitEditCategory() {
  closeEditConfirmModal();
  closeEditCategoryModal();
  setTimeout(() => {
    document.getElementById('successEditModal').classList.remove('hidden');
  }, 500);
}

function closeSuccessEditModal() {
  document.getElementById('successEditModal').classList.add('hidden');
}

// Hapus Kategori
function openDeleteConfirmModal(id) {
  document.getElementById('deleteConfirmModal').classList.remove('hidden');
  document.getElementById('FormDelete').action = '{{route('manajemen-kategori.delete', '')}}/' + id;
}

function closeDeleteConfirmModal() {
  document.getElementById('deleteConfirmModal').classList.add('hidden');
}

function submitDeleteCategory() {
  closeDeleteConfirmModal();
  setTimeout(() => {
    document.getElementById('successDeleteModal').classList.remove('hidden');
  }, 500);
}

function closeSuccessDeleteModal() {
  document.getElementById('successDeleteModal').classList.add('hidden');
}

function openCannotDeleteModal() {
  document.getElementById('cannotDeleteModal').classList.remove('hidden');
}

function closeCannotDeleteModal() {
  document.getElementById('cannotDeleteModal').classList.add('hidden');
}

// Logika Penghapusan Berdasarkan Jumlah Produk
function checkDeleteCategory(productCount, id) {
  if (productCount > 0) {
    openCannotDeleteModal(); // Kategori tidak bisa dihapus karena masih memiliki produk
  } else {
    openDeleteConfirmModal(id); // Tampilkan modal konfirmasi hapus jika tidak ada produk
    }
}
</script>
@endpush
