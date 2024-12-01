@extends('layouts.admin')

@section('title', 'Approval Penarikan - Admin Dashboard')

<!-- Search Bar -->
@section('search')
<form action="#" method="GET" class="relative">
  <input type="text" name="search" placeholder="Cari Nama Seller..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
  <h2 class="text-2xl font-bold mb-6">Approval Penarikan</h2>

  <!-- Filter dan Tabel Permintaan Penarikan -->
  <div class="flex justify-between items-center mb-4">
    <select class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
      <option value="all">Semua</option>
      <option value="pending">Menunggu</option>
      <option value="approved">Disetujui</option>
      <option value="rejected">Ditolak</option>
    </select>

    <select id="sortOrder" class="block w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" onchange="filterAndSortTable()">
        <option value="terbaru">Terbaru</option>
        <option value="terlama">Terlama</option>
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

  <!-- Tabel Permintaan Penarikan -->
  <div class="overflow-auto rounded-lg shadow-md">
  <table class="w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
      <tr>
        <th class="p-4 text-center border-r border-gray-300">Nama Seller</th>
        <th class="p-4 text-center border-r border-gray-300">Jumlah Penarikan</th>
        <th class="p-4 text-center border-r border-gray-300">Tanggal Pengajuan</th>
        <th class="p-4 text-center border-r border-gray-300">Status</th>
        <th class="p-4 text-center border-r border-gray-300">Aksi</th>
        <th class="p-4 text-center">Detail</th>
      </tr>
    </thead>
    <tbody>
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center border-r border-gray-300">RuangJayaPrint</td>
        <td class="p-4 text-center border-r border-gray-300">Rp1.500.000</td>
        <td class="p-4 text-center border-r border-gray-300">15/09/2024</td>
        <td class="p-4 text-center border-r border-gray-300" id="statusText1">Menunggu</td>
        <td class="p-4 text-center border-r border-gray-300">
          <select class="status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-orange-500" 
                  onchange="confirmStatusChange(this)" data-current-status="pending">
            <option value="pending" class="bg-orange-500 text-white">Menunggu</option>
            <option value="approved" class="bg-green-500 text-white">Disetujui</option>
            <option value="rejected" class="bg-red-500 text-white">Ditolak</option>
          </select>
        </td>
        <td class="p-4 text-center border-r border-gray-300">
          <button onclick="toggleWithdrawDetailModal()" class="text-blue-500">Lihat Detail</button>
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
  </div>`
@endsection

@section('modal')
<!-- Modal untuk Detail Penarikan -->
<div id="withdrawDetailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
<div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Detail Penarikan</h3>
        <div class="grid grid-cols-[150px_50px_auto] gap-y-2 sm:gap-y-4 md:gap-y-6 px-4 sm:px-6 md:px-8">
            <div class="font-semibold text-sm sm:text-base text-left">Nama Seller</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">RuangJayaPrint</div>

            <div class="font-semibold text-sm sm:text-base text-left">Jumlah Penarikan</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">Rp1.500.000</div>

            <div class="font-semibold text-sm sm:text-base text-left">Tanggal Pengajuan</div>
            <div class="text-center">:</div>
            <div class="text-sm sm:text-base">15/09/2024</div>
        </div>
        <div class="mt-6 sm:mt-8 text-center">
            <button onclick="toggleWithdrawDetailModal()" class="w-full sm:w-40 bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Perubahan Status -->
<div id="statusConfirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 sm:mb-6 text-center">Konfirmasi Perubahan Status</h3>
        <p class="text-sm sm:text-base text-center mb-4 sm:mb-6">Apakah Anda yakin ingin mengubah status penarikan?</p>
        <div class="flex justify-center space-x-6 sm:space-x-10 lg:space-x-16">
        <button id="confirmNo" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Tidak</button>
            <button id="confirmYes" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-24 sm:w-32 lg:w-40">Ya</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
  // Fungsi toggle untuk modals
  function toggleWithdrawDetailModal() {
    const modal = document.getElementById("withdrawDetailModal");
    modal.classList.toggle("hidden")
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

    // Perbarui teks status di kolom tabel
    const statusCell = selectElement.parentElement.previousElementSibling; // Elemen <td> status
    switch (selectedStatus) {
      case "pending":
        statusCell.textContent = "Menunggu";
        break;
      case "approved":
        statusCell.textContent = "Disetujui";
        break;
      case "rejected":
        statusCell.textContent = "Ditolak";
        break;
    }

    // Disable opsi lainnya
    disableOtherOptions(selectElement, selectedStatus);

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
    case "pending":
      selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-orange-500";
      break;
    case "approved":
      selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-green-500";
      break;
    case "rejected":
      selectElement.className = "status-dropdown w-40 text-white py-2 px-4 rounded-lg bg-red-600";
      break;
  }
}

// Fungsi untuk men-disable opsi yang tidak dipilih
function disableOtherOptions(selectElement, selectedStatus) {
  const options = selectElement.querySelectorAll("option");

  options.forEach((option) => {
    if (option.value !== selectedStatus) {
      option.disabled = true; // Disable opsi yang tidak dipilih
    } else {
      option.disabled = false; // Pastikan opsi yang dipilih tetap bisa diakses
    }
  });
}

</script>
@endpush