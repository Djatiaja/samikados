@extends('layouts.admin')

@section('title', 'Manajemen Kategori - Admin Dashboard')

@section('search')
  <form action="#" method="GET" class="relative">
    <input type="text" name="search" placeholder="Cari Kategori..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
  </form>
@endsection

@section('content')
  <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h2 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Kategori</h2>
    <button onclick="openAddCategoryModal()" class="border border-black px-4 py-2 rounded-lg flex items-center space-x-2">
      <img src="{{ asset('assets/add (1).png') }}" alt="Add Icon">
      <span>Kategori</span>
    </button>
  </div>

  <!-- Tabel Kategori -->
  <div class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Nama Kategori</th>
          <th class="p-4 text-center border-r border-gray-300">Deskripsi</th>
          <th class="p-4 text-center border-r border-gray-300">Jumlah Produk</th>
          <th class="p-4 text-center border-r border-gray-300">Icon</th>
          <th class="p-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example category with products -->
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">
            <a href="{{ route('kategori-fe') }}">Merchandise</a>
          </td>
          <td class="p-4 text-center border-r border-gray-300">Nikmati kualitas premium</td>
          <td class="p-4 text-center border-r border-gray-300" id="productCount">20</td>
          <td class="p-4 text-center border-r border-gray-300">
            <img src="{{ asset('assets/printer.png') }}" alt="Icon" class="mx-auto">
          </td>
          <td class="p-4 text-center">
            <button class="p-2" onclick="openEditCategoryModal()"><img src="{{ asset('assets/edit.png') }}" alt="Edit Icon"></button>
            <button class="p-2" onclick="checkDeleteCategory(20)"><img src="{{ asset('assets/delete.png') }}" alt="Delete Icon"></button>
          </td>
        </tr>

        <!-- New example category with 0 products for delete testing -->
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">
            <a href="{{ route('kategori-fe') }}">Empty Category</a>
          </td>
          <td class="p-4 text-center border-r border-gray-300">Kategori tanpa produk</td>
          <td class="p-4 text-center border-r border-gray-300" id="emptyCategoryProductCount">0</td>
          <td class="p-4 text-center border-r border-gray-300">
            <img src="{{ asset('assets/placeholder.png') }}" alt="Icon" class="mx-auto">
          </td>
          <td class="p-4 text-center">
            <button class="p-2" onclick="openEditCategoryModal()"><img src="{{ asset('assets/edit.png') }}" alt="Edit Icon"></button>
            <button class="p-2" onclick="checkDeleteCategory(0)"><img src="{{ asset('assets/delete.png') }}" alt="Delete Icon"></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

 <!-- Modal: Add Category -->
  <div id="addCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
      <h3 class="text-2xl mb-4 font-semibold text-center">Tambah Kategori Baru</h3>
      <form>
        <div class="mb-4">
          <label class="block mb-2 text-gray-700">Nama Kategori</label>
          <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan nama kategori">
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-gray-700">Deskripsi</label>
          <textarea class="w-full p-2 border border-gray-300 rounded-lg" rows="3" placeholder="Masukkan deskripsi kategori"></textarea>
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-gray-700">Icon</label>
          <input type="file" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>
        <div class="mb-4">
          <label class="block mb-2 text-gray-700">Banner</label>
          <input type="file" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>
        <div class="flex justify-evenly">
          <button type="button" onclick="openAddConfirmModal()" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg">Tambah Kategori</button>
          <button type="button" onclick="closeAddCategoryModal()" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg">Batal</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Success Add Category -->
  <div id="successAddModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
      <h3 class="text-2xl mb-4 font-semibold text-center">Kategori Berhasil Ditambahkan</h3>
      <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
      <div class="flex justify-center mt-10">
        <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessAddModal()">Tutup</button>
      </div>
    </div>
  </div>

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
    <form>
      <div class="mb-4">
        <label class="block mb-2 text-gray-700">Nama Kategori</label>
        <input type="text" id="editCategoryName" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nama Kategori">
      </div>
      <div class="mb-4">
        <label class="block mb-2 text-gray-700">Deskripsi</label>
        <textarea id="editCategoryDescription" class="w-full p-2 border border-gray-300 rounded-lg" rows="3" placeholder="Deskripsi Kategori"></textarea>
      </div>
      <div class="mb-4">
        <label class="block mb-2 text-gray-700">Icon</label>
        <input type="file" id="editCategoryIcon" class="w-full p-2 border border-gray-300 rounded-lg">
      </div>
      <div class="mb-4">
        <label class="block mb-2 text-gray-700">Banner</label>
        <input type="file" id="editCategoryBanner" class="w-full p-2 border border-gray-300 rounded-lg">
      </div>
      <div class="flex justify-evenly">
        <button type="button" onclick="openEditConfirmModal()" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg">Edit Kategori</button>
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

<!-- Modal: Success Edit Category -->
<div id="successEditModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Kategori Berhasil Diedit</h3>
    <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessEditModal()">Tutup</button>
    </div>
  </div>
</div>

  <!-- Modal: Confirm Delete Category -->
  <div id="deleteConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
      <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Hapus Kategori</h3>
      <p class="text-center">Apakah Anda yakin ingin menghapus kategori ini?</p>
      <div class="flex justify-evenly mt-6">
        <button onclick="submitDeleteCategory()" class="bg-red-600 w-1/3 text-white py-2 px-4 mx-2 rounded-lg">Ya</button>
        <button onclick="closeDeleteConfirmModal()" class="bg-gray-300 w-1/3 py-2 px-4 mx-2 rounded-lg">Batal</button>
      </div>
    </div>
  </div>

  <!-- Modal: Success Delete Category -->
  <div id="successDeleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
      <h3 class="text-2xl mb-4 font-semibold text-center">Kategori Berhasil Dihapus</h3>
      <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
      <div class="flex justify-center mt-10">
        <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessDeleteModal()">Tutup</button>
      </div>
    </div>
  </div>

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
function openEditCategoryModal() {
  document.getElementById('editCategoryModal').classList.remove('hidden');
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
function openDeleteConfirmModal() {
  document.getElementById('deleteConfirmModal').classList.remove('hidden');
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
function checkDeleteCategory(productCount) {
  if (productCount > 0) {
    openCannotDeleteModal(); // Kategori tidak bisa dihapus karena masih memiliki produk
  } else {
    openDeleteConfirmModal(); // Tampilkan modal konfirmasi hapus jika tidak ada produk
  }
}
</script>
@endpush
