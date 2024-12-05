@extends('layouts.seller')

@section('title', 'Pengaturan Akun - Seller Dashboard')

@section('content')
<main class="w-full p-6 mt-10">
    <!-- Profile Section -->
    <section class="flex flex-col md:flex-row items-start md:space-x-20 justify-center">
        <!-- Profile Picture and Actions -->
        <div class="w-full md:w-1/4 flex flex-col items-center">
            <img src="https://placehold.co/300x300" class="rounded-lg shadow-lg w-full max-w-xs" alt="Profile Picture" />
            
            <!-- Button Ganti Foto Profil -->
            <button class="mt-5 w-full max-w-xs bg-red-600 text-white py-3 rounded-lg text-sm sm:text-base md:text-lg" onclick="openPhotoModal()">Ganti Foto Profil</button>

            <!-- Nonaktifkan Akun Toggle Switch -->
            <div class="flex items-center justify-center mt-3 md:mt-5 w-full">
                <label class="inline-flex justify-evenly items-center w-full max-w-xs bg-red-600 text-white py-3 rounded-lg text-sm sm:text-base md:text-lg px-4">
                    <span id="toggleLabel" class="text-xs sm:text-sm md:text-base lg:text-lg">Nonaktifkan Akun</span>
                    <input type="checkbox" id="toggleAccountStatus" value="" class="sr-only peer" checked onchange="toggleAccountStatus()">
                    <div class="relative w-10 h-5 bg-white rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-red-600 after:rounded-full after:h-4 after:w-4 after:transition-all"></div>
                </label>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg h-auto flex flex-col items-center justify-center mt-10 md:mt-0">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-semibold mb-4 text-center">Profil Saya</h2>
            <div class="space-y-4 w-5/6 mt-8">
                <div class="bg-gray-100 p-4 sm:p-5 lg:p-6 rounded-lg text-xs sm:text-sm md:text-base">RuangJayaPrint</div>
                <div class="bg-gray-100 p-4 sm:p-5 lg:p-6 rounded-lg text-xs sm:text-sm md:text-base">081212341234</div>
                <div class="bg-gray-100 p-4 sm:p-5 lg:p-6 rounded-lg text-xs sm:text-sm md:text-base">ruangjayaprint@gmail.com</div>
            </div>
            <button class="mt-10 w-full max-w-md bg-red-600 text-white py-3 rounded-lg mb-4 text-sm sm:text-base md:text-lg" onclick="openEditModal()">Edit Profil</button>
        </div>
    </section>

    <!-- Action Buttons -->
    <section class="mt-20 md:mt-32 space-y-4 flex flex-col items-center justify-center">
        <button class="w-full max-w-md sm:w-3/4 lg:w-1/3 bg-red-600 text-white py-3 rounded-xl text-sm sm:text-base" onclick="openChangePasswordModal()">Ganti Password</button>
        <button class="w-full max-w-md sm:w-3/4 lg:w-1/3 bg-red-600 text-white py-3 rounded-xl text-sm sm:text-base">Log Out</button>
    </section>
</main>
@endsection

@section('modal')
<!-- Modal Edit Profile -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-4 font-semibold text-center">Edit Profile</h3>
        <form id="editProfileForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 text-sm sm:text-base lg:text-lg">Username</label>
                <input type="text" id="editUsername" class="w-full p-2 sm:p-3 border border-gray-300 rounded-lg" placeholder="Enter new username">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 text-sm sm:text-base lg:text-lg">Email</label>
                <input type="email" id="editEmail" class="w-full p-2 sm:p-3 border border-gray-300 rounded-lg" placeholder="Enter new email">
            </div>
            <div class="flex justify-evenly mt-6 sm:mt-8">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" onclick="openConfirmModal()">Simpan</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" onclick="closeEditModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/3 lg:w-1/4">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-6 font-semibold text-center">Konfirmasi Perubahan</h3>
        <p class="text-sm sm:text-base lg:text-lg text-center">Apakah Anda yakin ingin mengubah profil?</p>
        <div class="flex justify-between mt-6">
            <button type="button" class="bg-red-600 w-1/3 sm:w-1/4 lg:w-1/3 text-white py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" onclick="submitForm()">Ya</button>
            <button type="button" class="bg-gray-300 w-1/3 sm:w-1/4 lg:w-1/3 py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" onclick="closeConfirmModal()">Batal</button>
        </div>
    </div>
</div>

<!-- Modal Data Berhasil Diubah -->
<div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/3 lg:w-1/4">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-4 font-semibold text-center">Data Berhasil Diubah</h3>
        <img 
            src="icon/Done (1).gif" 
            alt="Success Icon" 
            class="mx-auto mb-5 mt-6 w-12 sm:w-16 lg:w-20">
        <div class="flex justify-center mt-6 sm:mt-8">
            <button 
                type="button" 
                class="bg-red-600 text-white py-2 sm:py-3 px-4 rounded-lg w-1/3 sm:w-1/4 lg:w-1/3 text-sm sm:text-base lg:text-lg" 
                onclick="closeSuccessModal()">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Ganti Password -->
<div id="changePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-4 font-semibold text-center">Ganti Password</h3>
        <form id="changePasswordForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 text-sm sm:text-base lg:text-lg">Password Lama</label>
                <input 
                    type="password" 
                    id="oldPassword" 
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded-lg" 
                    placeholder="Enter old password">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 text-sm sm:text-base lg:text-lg">Password Baru</label>
                <input 
                    type="password" 
                    id="newPassword" 
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded-lg" 
                    placeholder="Enter new password">
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700 text-sm sm:text-base lg:text-lg">Konfirmasi Password Baru</label>
                <input 
                    type="password" 
                    id="confirmNewPassword" 
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded-lg" 
                    placeholder="Confirm new password">
            </div>
            <div class="flex justify-evenly mt-6 sm:mt-8">
                <button 
                    type="button" 
                    class="w-1/3 bg-red-600 text-white py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" 
                    onclick="openConfirmChangePasswordModal()">Ganti Password</button>
                <button 
                    type="button" 
                    class="w-1/3 bg-gray-300 py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" 
                    onclick="closeChangePasswordModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Sukses Ganti Password -->
<div id="successChangePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/3 lg:w-1/4">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-4 font-semibold text-center">Password Berhasil Diubah</h3>
        <img 
            src="icon/Done (1).gif" 
            alt="Success Icon" 
            class="mx-auto mb-5 mt-6 w-12 sm:w-16 lg:w-20">
        <div class="flex justify-center mt-6 sm:mt-8">
            <button 
                type="button" 
                class="bg-red-600 text-white py-2 sm:py-3 px-4 rounded-lg w-1/3 sm:w-1/4 lg:w-1/3 text-sm sm:text-base lg:text-lg" 
                onclick="closeSuccessChangePasswordModal()">Tutup</button>
        </div>
    </div>
</div>

<!-- Modal Ganti Foto Profil -->
<div id="photoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/3 lg:w-1/4">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-4 font-semibold text-center">Unggah Foto Profil Baru</h3>
        <form id="uploadPhotoForm">
            <div class="mb-4">
                <input 
                    type="file" 
                    id="newProfilePhoto" 
                    accept="image/*" 
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded-lg" />
            </div>
            <div class="flex justify-evenly mt-6 sm:mt-8">
                <button 
                    type="button" 
                    class="w-1/3 bg-red-600 text-white py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" 
                    onclick="openConfirmPhotoModal()">Ganti Foto</button>
                <button 
                    type="button" 
                    class="w-1/3 bg-gray-300 py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" 
                    onclick="closePhotoModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Ganti Foto -->
<div id="confirmPhotoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/3 lg:w-1/4">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-6 font-semibold text-center">Konfirmasi Penggantian Foto</h3>
        <p class="text-sm sm:text-base lg:text-lg text-center">Apakah Anda yakin ingin mengganti foto profil?</p>
        <div class="flex justify-between mt-6">
            <button 
                type="button" 
                class="bg-red-600 w-1/3 sm:w-1/4 lg:w-1/3 text-white py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" 
                onclick="submitPhotoForm()">Ya</button>
            <button 
                type="button" 
                class="bg-gray-300 w-1/3 sm:w-1/4 lg:w-1/3 py-2 sm:py-3 px-4 rounded-lg text-sm sm:text-base lg:text-lg" 
                onclick="closeConfirmPhotoModal()">Batal</button>
        </div>
    </div>
</div>

<!-- Modal Sukses Ganti Foto -->
<div id="successPhotoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/3 lg:w-1/4">
        <h3 class="text-xl sm:text-2xl lg:text-3xl mb-4 font-semibold text-center">Foto Berhasil Diubah</h3>
        <img 
            src="icon/Done (1).gif" 
            alt="Success Icon" 
            class="mx-auto mb-5 mt-6 w-12 sm:w-16 lg:w-20">
        <div class="flex justify-center mt-6 sm:mt-8">
            <button 
                type="button" 
                class="bg-red-600 text-white py-2 sm:py-3 px-4 rounded-lg w-1/3 sm:w-1/4 lg:w-1/3 text-sm sm:text-base lg:text-lg" 
                onclick="closeSuccessPhotoModal()">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
        function openEditModal() {
            document.getElementById("editModal").classList.remove("hidden");
        }

        function closeEditModal() {
            document.getElementById("editModal").classList.add("hidden");
        }

        function openConfirmModal() {
            document.getElementById("confirmModal").classList.remove("hidden");
        }

        function closeConfirmModal() {
            document.getElementById("confirmModal").classList.add("hidden");
        }

        function openSuccessModal() {
            document.getElementById("successModal").classList.remove("hidden");
        }

        function closeSuccessModal() {
            document.getElementById("successModal").classList.add("hidden");
        }

        function submitForm() {
            closeConfirmModal();
            closeEditModal();
            setTimeout(function() {
                openSuccessModal();
            }, 500);
        }


        // Functions to manage 'Ganti Password' modal
        function openChangePasswordModal() {
            document.getElementById("changePasswordModal").classList.remove("hidden");
        }

        function closeChangePasswordModal() {
            document.getElementById("changePasswordModal").classList.add("hidden");
        }

        // Functions to manage 'Konfirmasi Ganti Password' modal
        function openConfirmChangePasswordModal() {
            document.getElementById("confirmChangePasswordModal").classList.remove("hidden");
        }

        function closeConfirmChangePasswordModal() {
            document.getElementById("confirmChangePasswordModal").classList.add("hidden");
        }

        // Functions to manage 'Success Ganti Password' modal
        function openSuccessChangePasswordModal() {
            document.getElementById("successChangePasswordModal").classList.remove("hidden");
        }

        function closeSuccessChangePasswordModal() {
            document.getElementById("successChangePasswordModal").classList.add("hidden");
        }

        // Function to submit 'Ganti Password' form
        function submitChangePasswordForm() {
            closeConfirmChangePasswordModal();
            closeChangePasswordModal();
            setTimeout(function() {
                openSuccessChangePasswordModal();
            }, 500);
        }

        // Function to open the photo picker modal
        function openPhotoModal() {
            document.getElementById("photoModal").classList.remove("hidden");
        }

        // Function to close the photo picker modal
        function closePhotoModal() {
            document.getElementById("photoModal").classList.add("hidden");
        }

        // Function to open the confirmation modal
        function openConfirmPhotoModal() {
            const fileInput = document.getElementById("newProfilePhoto");
            if (fileInput.files.length === 0) {
                alert("Silakan pilih foto terlebih dahulu.");
                return;
            }
            document.getElementById("confirmPhotoModal").classList.remove("hidden");
        }

        // Function to close the confirmation modal
        function closeConfirmPhotoModal() {
            document.getElementById("confirmPhotoModal").classList.add("hidden");
        }

        // Function to submit the photo change form
        function submitPhotoForm() {
            closeConfirmPhotoModal();
            closePhotoModal();
            setTimeout(function () {
                openSuccessPhotoModal();
            }, 500);
        }

        // Function to open the success modal
        function openSuccessPhotoModal() {
            document.getElementById("successPhotoModal").classList.remove("hidden");
        }

        // Function to close the success modal
        function closeSuccessPhotoModal() {
            document.getElementById("successPhotoModal").classList.add("hidden");
        }
</script>
@endpush

