@extends('layouts.admin')

@section('title', 'Manajemen Akun - Admin Dashboard')

<!-- Jika halaman ini memerlukan search bar, gunakan section 'search' -->
@section('search')
<form action="#" method="GET" class="relative">
  <input type="text" name="search" placeholder="Cari Akun..." class="w-full pl-12 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
  <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5" alt="Search Icon">
</form>
@endsection

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6">
  <h2 class="text-2xl font-bold mb-4 md:mb-0">Manajemen Akun</h2>
</div>

<!-- Dropdown Filter -->
<div class="mb-6">
  <label for="accountFilter" class="block mb-2 text-sm font-medium text-gray-700">Filter Akun:</label>
  <select id="accountFilter" class="block w-1/2 md:w-1/4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" onchange="filterAccounts()">
    <option value="all">Semua Akun</option>
    <option value="customer">Akun Customer</option>
    <option value="seller">Akun Seller</option>
  </select>
</div>

<!-- Tabel Akun -->
<div id="accountsTable" class="overflow-x-auto rounded-lg shadow-md">
  <table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-red-600 text-white">
      <tr>
        <th class="p-4 text-center border-r border-gray-300 min-w-[150px]md:min-w-0">Nama</th>
        <th class="p-4 text-center border-r border-gray-300 min-w-[200px]md:min-w-0">Email</th>
        <th class="p-4 text-center border-r border-gray-300 min-w-[100px]md:min-w-0">Tipe</th>
        <th class="p-4 text-center border-r border-gray-300 min-w-[100px]md:min-w-0">Status</th>
        <th class="p-4 text-center border-r border-gray-300 min-w-[150px]md:min-w-0">Tanggal Bergabung</th>
        <th class="p-4 text-center border-gray-300 min-w-[100px]">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <!-- Contoh data statis di bawah ini hanya sebagai placeholder dan harus diganti oleh backend -->
      <tr class="border-b border-gray-300">
        <td class="p-4 text-center align-middle border-r border-gray-300">Nama Akun</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">email@example.com</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Customer</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Suspended</td>
        <td class="p-4 text-center align-middle border-r border-gray-300">Tanggal Bergabung</td>
        <td class="p-4 text-center align-middle flex justify-center space-x-2">
            <button class="p-1" onclick="openSuspendConfirmModal()">
                <img src="{{ asset('assets/block.png') }}" alt="Suspend Icon" class="w-6 h-6">
            </button>
            <button class="p-1" onclick="openUnsuspendConfirmModal()">
                <img src="{{ asset('assets/checkmark.png') }}" alt="Unsuspend Icon" class="w-6 h-6">
            </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>


<!-- Modal Konfirmasi Suspend -->
<div id="suspendConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Suspend Akun</h3>
    <p class="text-center">Apakah Anda yakin ingin suspend akun ini?</p>
    <div class="flex justify-evenly mt-6">
      <button onclick="submitSuspendAccount()" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Ya</button>
      <button onclick="closeSuspendConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Unsuspend -->
<div id="unsuspendConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Konfirmasi Unsuspend Akun</h3>
    <p class="text-center">Apakah Anda yakin ingin unsuspend akun ini?</p>
    <div class="flex justify-evenly mt-6">
      <button onclick="submitUnsuspendAccount()" class="bg-red-600 text-white py-2 px-4 rounded-lg w-1/3">Ya</button>
      <button onclick="closeUnsuspendConfirmModal()" class="bg-gray-300 py-2 px-4 rounded-lg w-1/3">Batal</button>
    </div>
  </div>
</div>

<!-- Modal Sukses Suspend -->
<div id="successSuspendModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Akun Berhasil di-Suspend</h3>
    <img src="assets/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessSuspendModal()">Tutup</button>
    </div>
  </div>
</div>

<!-- Modal Sukses Unsuspend -->
<div id="successUnsuspendModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Akun Berhasil di-Unsuspend</h3>
    <img src="assets/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
      <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessUnsuspendModal()">Tutup</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function filterAccounts() {
    var filter = document.getElementById('accountFilter').value;
    // Mengubah URL untuk menyertakan filter yang dipilih dan mengirimkan request ke backend
    window.location.href = '?filter=' + filter;
  }
  // Modal Suspend
  function openSuspendConfirmModal() {
    document.getElementById('suspendConfirmModal').classList.remove('hidden');
  }

  function closeSuspendConfirmModal() {
    document.getElementById('suspendConfirmModal').classList.add('hidden');
  }

  function submitSuspendAccount() {
    closeSuspendConfirmModal();
    setTimeout(() => {
      document.getElementById('successSuspendModal').classList.remove('hidden');
    }, 500);
  }

  function closeSuccessSuspendModal() {
    document.getElementById('successSuspendModal').classList.add('hidden');
  }

  // Modal Unsuspend
  function openUnsuspendConfirmModal() {
    document.getElementById('unsuspendConfirmModal').classList.remove('hidden');
  }

  function closeUnsuspendConfirmModal() {
    document.getElementById('unsuspendConfirmModal').classList.add('hidden');
  }

  function submitUnsuspendAccount() {
    closeUnsuspendConfirmModal();
    setTimeout(() => {
      document.getElementById('successUnsuspendModal').classList.remove('hidden');
    }, 500);
  }

  function closeSuccessUnsuspendModal() {
    document.getElementById('successUnsuspendModal').classList.add('hidden');
  }
</script>
@endpush
