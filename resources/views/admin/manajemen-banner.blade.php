@extends('layouts.admin')

@section('title', 'Manajemen Banner - Seller Dashboard')

@section('search')
<form action="#" method="GET" class="relative">
    <input type="text" name="search" placeholder="Cari Banner..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-sm sm:text-md lg:text-2xl font-bold mb-4 md:mb-0">Manajemen Banner</h2>
    <button onclick="openAddBanner()" class="border border-black px-4 py-2 rounded-lg flex items-center space-x-2 text-sm sm:text-base">
        <img src="{{ asset('assets/add (1).png') }}" alt="Add Icon" class="w-3 h-3">
        <span class="text-sm sm:text-md">Banner</span>
    </button>
</div>

<!-- <div class="mb-4">
    <label for="entriesPerPage" class="mr-2">Entries per page:</label>
    <select id="entriesPerPage" class="p-2 border border-gray-300 rounded-md" onchange="changeEntriesPerPage()">
        <option value="10">10</option>
        <option value="25" selected>25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div> -->

<!-- Tabel Banner -->
<div class="overflow-x-auto rounded-lg shadow-md">
    <table class="min-w-full w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[150px]">Nama</th>
                <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[200px]">Deskripsi</th>
                <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[150px]">Gambar</th>
                <th class="p-4 text-center border-r border-gray-300 text-sm sm:text-base lg:text-lg min-w-[100px]">Status</th>
                <th class="p-4 text-center border-gray-300 text-sm sm:text-base lg:text-lg min-w-[110px]">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)

            <tr class="border-b border-gray-300">
                <td class="p-4 text-center border-r border-gray-300">{{$banner->name}}</td>
                <td class="p-4 text-center border-r border-gray-300">{{$banner->description}}</td>
                <td class="p-4 text-center border-r border-gray-300">
                    <div class="flex justify-center">
                        <img src="{{asset($banner->picture)}}" alt="Gambar Banner" onclick="toggleImageModal()" class="cursor-pointer">
                    </div>
                </td>
                <td class="p-4 text-center border-r border-gray-300">
                    <select class="status-dropdown w-40 text-white py-2 px-4 rounded-lg {{$banner->is_active?'bg-green-500':'bg-red-500'}}" onchange="confirmStatusChange(this)">
                        <option value="aktif" {{ $banner->is_active ? 'selected' : '' }} class="bg-green-500 text-white">Aktif</option>
                        <option value="nonaktif" {{ !$banner->is_active ? 'selected' : '' }} class="bg-red-500 text-white">Nonaktif</option>
                    </select>
                </td>
                <td class="p-4 text-center flex justify-center items-center h-full space-x-2">
                    <button onclick="openEditBannerModal({{$banner->id}})" class="p-1" id="editBanner{{$banner->id}}">
                        <div class="flex items-center justify-center h-full my-auto">
                            <img src="{{ asset('assets/edit.png') }}" alt="Edit Icon" class="w-6 h-6 lg:w-8 lg:h-8 object-cover">
                        </div>
                    </button>
                    <button onclick="openDeleteConfirmModal({{$banner->id}})" class="p-1">
                        <div class="flex items-center justify-center h-full my-auto">
                            <img src="{{ asset('assets/delete.png') }}" alt="Delete Icon" class="w-6 h-6 lg:w-8 lg:h-8 object-cover">
                        </div>
                    </button>
                </td>
            </tr>
            @endforeach

            <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
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
<div class="mt-4">
    {{ $banners->links() }}
</div>

@endsection

@section('modal')
<div id="addModalBanner" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-20 ">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Tambah Banner Baru</h3>
        <form class="space-y-4" action="{{route("manajemen-banner.store")}}" method="post" id="addForm" enctype="multipart/form-data">
            @csrf
            <label class="block">
                <span class="text-gray-700 font-semibold">Nama Banner</span>
                <input type="text" placeholder="Masukkan Nama Banner" class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg" name="name">
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Deskripsi Banner</span>
                <textarea class="w-full p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg" rows="3" placeholder="Masukkan deskripsi banner" name="description"></textarea>
            </label>
            <label class="block">
                <span class="text-gray-700 font-semibold">Gambar Banner</span>
                <input type="file" multiple class="w-full mt-1 p-2 sm:p-3 md:p-4 border border-gray-300 rounded-lg" name="picture" accept="image/*">
            </label>
            <div class="flex justify-evenly mt-4">
                <button type="button" onclick="closeAddBanner()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Batal</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tambah Banner</button>
            </div>
        </form>
    </div>
</div>

<div id="editBannerModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-20 ">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Edit Banner</h3>
        <form action="" method="POST" id="FormEdit" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Nama Banner</label>
                <input type="text" id="editBannerName" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nama Kategori" name="name">
                <p id="editBannerNameError" class="text-red-500 text-sm hidden">Nama harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Deskripsi</label>
                <textarea id="editBannerDescription" class="w-full p-2 border border-gray-300 rounded-lg" rows="3" placeholder="Deskripsi Kategori" name="description"></textarea>
                <p id="editBannerDescriptionError" class="text-red-500 text-sm hidden">Deskripsi harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Gambar</label>
                <input type="file" id="editBannerGambar" class="w-full p-2 border border-gray-300 rounded-lg" name="picture" accept="image/*">
                <p id="editBannerIconError" class="text-red-500 text-sm hidden">Gambar harus dipilih.</p>
            </div>
            <div class="flex justify-evenly">
                <button type="submit" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg">Edit Kategori</button>
                <button type="button" onclick="closeEditBannerModal()" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Confirm Delete Category -->
<div id="deleteConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <form action="" id="FormDelete" method="POST">
        @csrf
        @method('DELETE')
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
            <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Hapus Banner</h3>
            <p class="text-center">Apakah Anda yakin ingin menghapus Banner ini?</p>
            <div class="flex justify-evenly mt-6">
                <button onclick="submitDeleteBanner()" class="bg-red-600 w-1/3 text-white py-2 px-4 mx-2 rounded-lg">Ya</button>
                <button onclick="closeDeleteConfirmModal()" class="bg-gray-300 w-1/3 py-2 px-4 mx-2 rounded-lg">Batal</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal lainnya (Edit, Delete, dll) disesuaikan dengan gaya yang sama seperti di Manajemen Kategori -->
@endsection

@push('scripts')
<script>
    function openAddBanner() {
        document.getElementById("addModalBanner").classList.remove("hidden");
    }

    function closeAddBanner() {
        document.getElementById("addModalBanner").classList.add("hidden");
        document.getElementById("addForm").reset();
    }

    function openEditBannerModal(id) {
        document.getElementById('editBannerModal').classList.remove('hidden');
        var editButton = document.getElementById("editBanner" + id);
        var row = editButton.closest("tr");
        var data = row.getElementsByTagName('td');

        document.getElementById("FormEdit").action = "{{route('manajemen-banner.update', '')}}/" + id;
        document.getElementById("editBannerName").value = data[0].innerText;
        document.getElementById("editBannerDescription").value = data[1].innerText;
    }

    function closeEditBannerModal() {
        document.getElementById('editBannerModal').classList.add('hidden');
    }

    function openDeleteConfirmModal(id) {
        document.getElementById('deleteConfirmModal').classList.remove('hidden');
        document.getElementById('FormDelete').action = '{{route('manajemen-banner.delete', '')}}/' + id;
    }

    function closeDeleteConfirmModal() {
        document.getElementById('deleteConfirmModal').classList.add('hidden');
    }


    // Tambahkan fungsi lainnya sesuai kebutuhan
</script>
@endpush