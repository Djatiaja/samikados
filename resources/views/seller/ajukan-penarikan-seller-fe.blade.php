@extends('layouts.seller')

@section('title', 'Ajukan Penarikan - Seller Dashboard')

@section('search')
<div class="relative w-full">
    <input type="text" placeholder="Cari Penarikan..." class="w-full pl-10 text-black pr-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-white">
    <img src="{{ asset('assets/search.png') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2" alt="Search Icon">
</div>
@endsection

@section('content')
<main class="flex-1 p-6">
  <h2 class="text-2xl font-bold mb-6">Ajukan Penarikan</h2>

  <!-- Filter Dropdown and Add Withdrawal Button -->
  <div class="flex justify-between items-center mb-4">
    <select class="block w-24 md:w-32 lg:w-60 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600">
      <option value="all">Semua</option>
      <option value="berhasil">Berhasil</option>
      <option value="gagal">Gagal</option>
    </select>
    <button onclick="toggleWithdrawModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg">+ Permintaan</button>
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

  <!-- Withdrawal History Table -->
  <div class="overflow-auto rounded-lg shadow-md">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-red-600 text-white">
        <tr>
          <th class="p-4 text-center border-r border-gray-300">Penarikan Ke -</th>
          <th class="p-4 text-center border-r border-gray-300">Bank Tujuan</th>
          <th class="p-4 text-center border-r border-gray-300">Rekening Tujuan</th>
          <th class="p-4 text-center border-r border-gray-300">Jumlah Penarikan</th>
          <th class="p-4 text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sample Withdrawal Row -->
        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">1</td>
          <td class="p-4 text-center border-r border-gray-300">BCA</td>
          <td class="p-4 text-center border-r border-gray-300">1234567890</td>
          <td class="p-4 text-center border-r border-gray-300">Rp1.000.000</td>
          <td class="p-4 text-center text-green-500">Berhasil</td>
        </tr>

        <tr class="border-b border-gray-300">
          <td class="p-4 text-center border-r border-gray-300">1</td>
          <td class="p-4 text-center border-r border-gray-300">BCA</td>
          <td class="p-4 text-center border-r border-gray-300">1234567890</td>
          <td class="p-4 text-center border-r border-gray-300">Rp1.000.000</td>
          <td class="p-4 text-center text-red-600">Ditolak</td>
        </tr>
      </tbody>
    </table>
  </div>
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
<!-- Withdraw Modal -->
<div id="withdrawModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
  <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-bold">Formulir Penarikan</h3>
      <button onclick="toggleAddAccountModal()" class="border-2 px-4 py-2 rounded-lg text-sm sm:text-base w-32 sm:w-40 lg:w-45">+ Tujuan Baru</button>
    </div>
    <form class="space-y-4" onsubmit="submitWithdrawal(event)">
      <label class="block">
        <span class="text-gray-700 font-semibold">Nama Bank</span>
        <select id="bankSelect" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" onchange="updateAccountList()">
          <option value="">Pilih Bank</option>
          <option value="BCA">BCA</option>
          <option value="BNI">BNI</option>
          <option value="BNI">BRI</option>
        </select>
        <span id="bankError" class="text-red-500 text-sm"></span>
      </label>
      <label class="block">
        <span class="text-gray-700 font-semibold">Rekening Tujuan</span>
        <select id="accountSelect" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" onchange="populateAccountName()">
          <option value="">Pilih Rekening</option>
        </select>
        <span id="accountError" class="text-red-500 text-sm"></span>
      </label>
      <label class="block">
        <span class="text-gray-700 font-semibold">Nama Pemilik Rekening</span>
        <input id="accountNameField" type="text" class="w-full mt-1 p-2 border border-gray-300 rounded-lg bg-gray-100" disabled>
      </label>
      <label class="block">
        <span class="text-gray-700 font-semibold">Jumlah Penarikan</span>
        <input type="number" id="withdrawAmount" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" placeholder="Masukkan jumlah penarikan" oninput="validateWithdrawal()">
        <small id="maxAmountInfo" class="text-gray-500">Jumlah maksimal: Rp10.000.000</small>
        <span id="amountError" class="text-red-500 text-sm"></span>
      </label>
      <div class="flex justify-evenly mt-4">
        <button type="button" onclick="toggleWithdrawModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-32 sm:w-40 lg:w-45">Batal</button>
        <button type="submit" id="submitWithdraw" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-32 sm:w-40 lg:w-45" disabled>Ajukan Penarikan</button>
      </div>
    </form>
  </div>
</div>

<!-- Add Account Modal -->
<div id="addAccountModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-20">
  <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
    <h3 class="text-xl font-bold mb-4">Tambah Rekening Baru</h3>
    <form class="space-y-4" onsubmit="addNewAccount(event)">
      <label class="block">
        <span class="text-gray-700 font-semibold">Nama Bank</span>
        <select id="newBank" class="w-full mt-1 p-2 border border-gray-300 rounded-lg">
          <option value="">Pilih Bank</option>
          <option value="BCA">BCA</option>
          <option value="BNI">BNI</option>
        </select>
        <span id="bankError" class="text-red-500 text-sm"></span>
      </label>
      <label class="block">
        <span class="text-gray-700 font-semibold">Nomor Rekening</span>
        <input id="newAccountNumber" type="text" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Nomor Rekening">
        <span id="accountNumberError" class="text-red-500 text-sm"></span>
      </label>
      <label class="block">
        <span class="text-gray-700 font-semibold">Nama Pemilik Rekening</span>
        <input id="accountName" type="text" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Nama Pemilik Rekening">
        <span id="accountNameError" class="text-red-500 text-sm"></span>
      </label>
      <div class="flex justify-evenly mt-4">
        <button type="button" onclick="toggleAddAccountModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-sm sm:text-base w-32 sm:w-40 lg:w-45">Batal</button>
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm sm:text-base w-32 sm:w-40 lg:w-45">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
  <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-1/3">
    <h3 class="text-2xl mb-4 font-semibold text-center">Penarikan Berhasil Diajukan</h3>
    <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
        <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessModal()">Tutup</button>
    </div>
  </div>
</div>

<!-- Success Add Account Modal -->
<div id="addAccountSuccessModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20">
  <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4">
    <h3 class="text-2xl mb-4 font-semibold text-center">Rekening Baru Berhasil Ditambahkan</h3>
    <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
    <div class="flex justify-center mt-10">
        <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeAddAccountSuccessModal()">Tutup</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Define the accounts variable
    const accounts = {};

    // Function to toggle the withdrawal modal
    function toggleWithdrawModal() {
        document.getElementById("withdrawModal").classList.toggle("hidden");
    }

    // Function to toggle the add account modal
    function toggleAddAccountModal() {
        document.getElementById("addAccountModal").classList.toggle("hidden");
    }

    // Function to update the account list based on selected bank
    function updateAccountList() {
        const bank = document.getElementById("bankSelect").value;
        const accountSelect = document.getElementById("accountSelect");
        const accountNameField = document.getElementById("accountNameField");

        // Reset dropdown and account name
        accountSelect.innerHTML = '<option value="">Pilih Rekening</option>';
        accountNameField.value = "";

        if (bank && accounts[bank]) {
            accounts[bank].forEach((account) => {
                const option = document.createElement("option");
                option.value = account.accountNumber;
                option.textContent = account.accountNumber;
                accountSelect.appendChild(option);
            });
        }
    }

    // Function to populate the account name based on selected account number
    function populateAccountName() {
        const bank = document.getElementById("bankSelect").value;
        const accountNumber = document.getElementById("accountSelect").value;
        const accountNameField = document.getElementById("accountNameField");

        // Reset account owner name
        accountNameField.value = "";

        if (bank && accountNumber && accounts[bank]) {
            const account = accounts[bank].find(acc => acc.accountNumber === accountNumber);
            if (account) {
                accountNameField.value = account.accountName;
            }
        }
    }

    // Function to validate withdrawal amount
    function validateWithdrawal() {
        const maxAmount = 10000000; // Rp10.000.000
        const amount = parseInt(document.getElementById("withdrawAmount").value) || 0;
        const submitButton = document.getElementById("submitWithdraw");
        const info = document.getElementById("maxAmountInfo");
        const amountError = document.getElementById("amountError");

        // Reset error message
        amountError.textContent = "";

        if (amount > maxAmount) {
            amountError.textContent = "Jumlah penarikan melebihi batas maksimal.";
            submitButton.disabled = true;
        } else if (amount <= 0) {
            amountError.textContent = "Jumlah penarikan harus lebih dari 0.";
            submitButton.disabled = true;
        } else {
            amountError.textContent = "";
            submitButton.disabled = false;
        }
    }

    // Function to submit withdrawal request
    function submitWithdrawal(event) {
        event.preventDefault();

        const bank = document.getElementById("bankSelect").value.trim();
        const accountNumber = document.getElementById("accountSelect").value.trim();
        const amount = document.getElementById("withdrawAmount").value.trim();

        const bankError = document.getElementById("bankError");
        const accountError = document.getElementById("accountError");
        const amountError = document.getElementById("amountError");

        let hasError = false;

        // Reset error messages
        bankError.textContent = "";
        accountError.textContent = "";
        amountError.textContent = "";

        // Validate inputs
        if (!bank) {
            bankError.textContent = "Nama bank wajib diisi.";
            hasError = true;
        }

        if (!accountNumber) {
            accountError.textContent = "Nomor rekening wajib dipilih.";
            hasError = true;
        }

        if (!amount || amount <= 0) {
            amountError.textContent = "Jumlah penarikan harus lebih dari 0.";
            hasError = true;
        }

        if (!hasError) {
            toggleWithdrawModal();
            showSuccessModal();
        }
    }

    // Function to show success modal
    function showSuccessModal() {
        const successModal = document.getElementById("successModal");
        successModal.classList.remove("hidden");
    }

    // Function to close success modal
    function closeSuccessModal() {
        const successModal = document.getElementById("successModal");
        successModal.classList.add("hidden");
    }

    // Function to add a new account
    function addNewAccount(event) {
        event.preventDefault();

        const bank = document.getElementById("newBank").value.trim();
        const accountNumber = document.getElementById("newAccountNumber").value.trim();
        const accountName = document.getElementById("accountName").value.trim();

        const bankError = document.getElementById("bankError");
        const accountNumberError = document.getElementById("accountNumberError");
        const accountNameError = document.getElementById("accountNameError");

        let hasError = false;

        // Reset error messages
        bankError.textContent = "";
        accountNumberError.textContent = "";
        accountNameError.textContent = "";

        // Validate bank input
        if (!bank) {
            bankError.textContent = "Nama bank wajib diisi.";
            hasError = true;
        }

        // Validate account number input (only numbers allowed)
        if (!accountNumber) {
            accountNumberError.textContent = "Nomor rekening wajib diisi.";
            hasError = true;
        } else if (!/^\d+$/.test(accountNumber)) {
            accountNumberError.textContent = "Nomor rekening harus berupa angka.";
            hasError = true;
        }

        // Validate account name input
        if (!accountName) {
            accountNameError.textContent = "Nama pemilik rekening wajib diisi.";
            hasError = true;
        }

        if (!hasError) {
            // Add account if no errors
            if (!accounts[bank]) {
                accounts[bank] = [];
            }
            accounts[bank].push({ accountNumber, accountName });

            // Reset form inputs
            document.getElementById("newBank").value = "";
            document.getElementById("newAccountNumber").value = "";
            document.getElementById("accountName").value = "";

            toggleAddAccountModal();

            // Show success modal
            showAddAccountSuccessModal();
        }
    }

    // Function to show add account success modal
    function showAddAccountSuccessModal() {
        const modal = document.getElementById("addAccountSuccessModal");
        modal.classList.remove("hidden");
    }

    // Function to close add account success modal
    function closeAddAccountSuccessModal() {
        const modal = document.getElementById("addAccountSuccessModal");
        modal.classList.add("hidden");
    }
</script>
@endpush
