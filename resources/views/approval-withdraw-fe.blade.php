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

  <!-- Tabel Permintaan Penarikan -->
  <div class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Nama Seller</th>
          <th class="p-4 text-center border-r border-gray-300">Jumlah Penarikan</th>
          <th class="p-4 text-center border-r border-gray-300">Tanggal Pengajuan</th>
          <th class="p-4 text-center border-r border-gray-300">Status</th>
          <th class="p-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contoh data penarikan -->
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">RuangJayaPrint</td>
          <td class="p-4 text-center border-r border-gray-300">Rp1.500.000</td>
          <td class="p-4 text-center border-r border-gray-300">15/09/2024</td>
          <td class="p-4 text-center border-r border-gray-300">Menunggu</td>
          <td class="p-4 text-center border-r border-gray-300">
            <select class="w-40 bg-red-600 text-white p-2 rounded-lg">
                <option value="aktif">Menunggu</option>
                <option value="nonaktif">Disetujui</option>
                <option value="nonaktif">Ditolak</option>
            </select>
        </td>
        </tr>
        <!-- Tambahkan lebih banyak data jika diperlukan -->
      </tbody>
    </table>
  </div>


<!-- Modals -->
<div id="withdrawDetailModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
    <h3 class="text-xl font-bold mb-4 text-center">Detail Penarikan</h3>
    <p><strong>Nama Seller:</strong> RuangJayaPrint</p>
    <p><strong>Jumlah Penarikan:</strong> Rp1.500.000</p>
    <p><strong>Tanggal Pengajuan:</strong> 15/09/2024</p>
    <p><strong>Status:</strong> Menunggu</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleWithdrawDetailModal()" class="border border-gray-300 px-4 py-2 rounded-lg w-1/3">Tutup</button>
    </div>
  </div>
</div>

<div id="approveWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Konfirmasi Persetujuan</h3>
    <p>Apakah Anda yakin ingin menyetujui penarikan ini?</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleApproveWithdrawModal()" class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-green-600 text-white px-4 py-2 rounded-lg w-36" onclick="showSuccessApproveModal()">Setujui</button>
    </div>
  </div>
</div>

<div id="rejectWithdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Konfirmasi Penolakan</h3>
    <p>Apakah Anda yakin ingin menolak penarikan ini?</p>
    <div class="flex justify-evenly mt-4">
      <button onclick="toggleRejectWithdrawModal()" class="border border-gray-300 px-4 py-2 rounded-lg w-36">Batal</button>
      <button class="bg-red-600 text-white px-4 py-2 rounded-lg w-36" onclick="showSuccessRejectModal()">Tolak</button>
    </div>
  </div>
</div>

<!-- Modal Sukses Approve -->
<div id="successApproveModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Penarikan Disetujui</h3>
    <p>Penarikan telah berhasil disetujui.</p>
    <div class="flex justify-center mt-4">
      <button onclick="toggleSuccessApproveModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg w-36">Tutup</button>
    </div>
  </div>
</div>

<!-- Modal Sukses Reject -->
<div id="successRejectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg text-center w-1/3">
    <h3 class="text-xl font-bold mb-4">Penarikan Ditolak</h3>
    <p>Penarikan telah berhasil ditolak.</p>
    <div class="flex justify-center mt-4">
      <button onclick="toggleSuccessRejectModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg w-36">Tutup</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Toggle Modals
  function toggleWithdrawDetailModal() {
    document.getElementById("withdrawDetailModal").classList.toggle("hidden");
  }

  function toggleApproveWithdrawModal() {
    document.getElementById("approveWithdrawModal").classList.toggle("hidden");
  }

  function toggleRejectWithdrawModal() {
    document.getElementById("rejectWithdrawModal").classList.toggle("hidden");
  }

  // Toggle Success Modals
  function showSuccessApproveModal() {
    toggleApproveWithdrawModal();
    setTimeout(() => {
      document.getElementById("successApproveModal").classList.remove("hidden");
    }, 500);
  }

  function toggleSuccessApproveModal() {
    document.getElementById("successApproveModal").classList.add("hidden");
  }

  function showSuccessRejectModal() {
    toggleRejectWithdrawModal();
    setTimeout(() => {
      document.getElementById("successRejectModal").classList.remove("hidden");
    }, 500);
  }

  function toggleSuccessRejectModal() {
    document.getElementById("successRejectModal").classList.add("hidden");
  }
</script>
@endpush
