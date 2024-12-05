@extends('layouts.admin')

@section('title', 'Pengaturan Akun - Admin Dashboard')

@section('content')
<div class="flex flex-col md:flex-row items-start md:space-x-10 justify-center">
    <!-- Profile Picture -->
    <div class="w-full md:w-1/4 mr-20">
        <img src="https://placehold.co/300x300" class="rounded-lg shadow-lg w-full" />
        <button class="mt-5 w-full bg-red-600 text-white py-3 rounded-lg" onclick="openPhotoModal()">Ganti Foto Profil</button>
    </div>

    <!-- Profile Details -->
    <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg h-auto flex flex-col items-center justify-center">
        <h2 class="text-3xl mt-4 font-semibold mb-4 text-center">Profil Saya</h2>
        <div class="space-y-4 w-5/6 mt-8">
            <div class="bg-gray-100 p-5 mb-90 rounded-lg">AdminSamikados</div>
            <div class="bg-gray-100 p-5 mb-90 rounded-lg">adminsamikados@gmail.com</div>
            <div class="bg-gray-100 p-5 mb-90 rounded-lg">Super Admin</div>
        </div>
        <button class="mt-10 w-full md:w-96 bg-red-600 text-white py-3 rounded-lg mb-4" onclick="openEditModal()">Edit Profil</button>
    </div>
</div>

<!-- Action Buttons -->
<section class="mt-32 space-y-4 flex flex-col items-center justify-center">
    <button class="w-2/5 bg-red-600 text-white py-3 rounded-xl" onclick="openAddAdminModal()">Tambah Akun</button>
    <button class="w-2/5 bg-red-600 text-white py-3 rounded-xl" onclick="openChangePasswordModal()">Ganti Password</button>
    <button class="w-2/5 bg-red-600 text-white py-3 rounded-xl">Log Out</button>
</section>

<!-- Modal Edit Profile -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Edit Profile</h3>
        <form id="editProfileForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Username</label>
                <input type="text" id="editUsername" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter new username">
                <p id="editUsernameError" class="text-red-500 text-sm hidden">Username harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" id="editEmail" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter new email">
                <p id="editEmailError" class="text-red-500 text-sm hidden">Email harus diisi.</p>
            </div>
            <div class="flex justify-evenly mt-10">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="validateEditProfile()">Simpan</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closeEditModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
            <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Perubahan</h3>
            <p>Apakah Anda yakin ingin mengubah profil?</p>
            <div class="flex justify-between mt-6">
                <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg" onclick="submitForm()">Ya</button>
                <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg" onclick="closeConfirmModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Data Berhasil Diubah -->
    <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Data Berhasil Diubah</h3>
            <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
            <div class="flex justify-center mt-10">
                <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessModal()">Tutup</button>
            </div>
        </div>
    </div>

    <div id="addAdminModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Tambah Admin Baru</h3>
        <form id="addAdminForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" id="addAdminEmail" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter email">
                <p id="addAdminEmailError" class="text-red-500 text-sm hidden">Email harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Username</label>
                <input type="text" id="addAdminUsername" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter username">
                <p id="addAdminUsernameError" class="text-red-500 text-sm hidden">Username harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password</label>
                <input type="password" id="addAdminPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter password">
                <p id="addAdminPasswordError" class="text-red-500 text-sm hidden">Password harus diisi.</p>
            </div>
            <div class="flex justify-evenly mt-10">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="validateAddAdmin()">Tambah Admin</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closeAddAdminModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

    <!-- Modal Konfirmasi Tambah Admin -->
    <div id="confirmAddAdminModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
            <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Penambahan Admin</h3>
            <p>Apakah Anda yakin ingin menambahkan admin baru?</p>
            <div class="flex justify-between mt-6">
                <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg" onclick="submitAddAdminForm()">Ya</button>
                <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg" onclick="closeConfirmAddModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Sukses Tambah Admin -->
    <div id="successAddAdminModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Admin Baru Berhasil Ditambahkan</h3>
            <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
            <div class="flex justify-center mt-10">
                <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessAddAdminModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Modal Ganti Password -->
    <div id="changePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
        <h3 class="text-2xl mb-4 font-semibold text-center">Ganti Password</h3>
        <form id="changePasswordForm">
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password Lama</label>
                <input type="password" id="oldPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter old password">
                <p id="oldPasswordError" class="text-red-500 text-sm hidden">Password lama harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Password Baru</label>
                <input type="password" id="newPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter new password">
                <p id="newPasswordError" class="text-red-500 text-sm hidden">Password baru harus diisi.</p>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" id="confirmNewPassword" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Confirm new password">
                <p id="confirmNewPasswordError" class="text-red-500 text-sm hidden">Konfirmasi password harus diisi.</p>
            </div>
            <div class="flex justify-evenly mt-10">
                <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="validateChangePassword()">Ganti Password</button>
                <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closeChangePasswordModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

    <!-- Modal Konfirmasi Ganti Password -->
    <div id="confirmChangePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
            <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Penggantian Password</h3>
            <p class="text-center">Apakah Anda yakin ingin mengganti password?</p>
            <div class="flex justify-between mt-6">
                <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg" onclick="submitChangePasswordForm()">Ya</button>
                <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg" onclick="closeConfirmChangePasswordModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Sukses Ganti Password -->
    <div id="successChangePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Password Berhasil Diubah</h3>
            <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
            <div class="flex justify-center mt-10">
                <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessChangePasswordModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Modal Ganti Foto Profil -->
    <div id="photoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Unggah Foto Profil Baru</h3>
            <form id="uploadPhotoForm">
                <div class="mb-4">
                    <input type="file" id="newProfilePhoto" accept="image/*" class="w-full p-2 border border-gray-300 rounded-lg" />
                    <p id="photoError" class="text-red-500 text-sm hidden mt-2">Silakan pilih foto terlebih dahulu.</p>
                </div>
                <div class="flex justify-evenly mt-10">
                    <button type="button" class="w-1/3 bg-red-600 text-white py-2 px-4 rounded-lg" onclick="openConfirmPhotoModal()">Ganti Foto</button>
                    <button type="button" class="w-1/3 bg-gray-300 py-2 px-4 rounded-lg" onclick="closePhotoModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Ganti Foto -->
    <div id="confirmPhotoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-fit">
            <h3 class="text-2xl mb-6 font-semibold text-center">Konfirmasi Penggantian Foto</h3>
            <p>Apakah Anda yakin ingin mengganti foto profil?</p>
            <div class="flex justify-between mt-6">
                <button type="button" class="bg-red-600 w-1/2 text-white py-2 px-4 mx-2 rounded-lg" onclick="submitPhotoForm()">Ya</button>
                <button type="button" class="bg-gray-300 w-1/2 py-2 px-4 mx-2 rounded-lg" onclick="closeConfirmPhotoModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Sukses Ganti Foto -->
    <div id="successPhotoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-1/3">
            <h3 class="text-2xl mb-4 font-semibold text-center">Foto Berhasil Diubah</h3>
            <img src="icon/Done (1).gif" alt="Success Icon" class="mx-auto mb-5 mt-6 w-2/12">
            <div class="flex justify-center mt-10">
                <button type="button" class="bg-red-600 text-white py-3 px-4 rounded-lg w-1/3" onclick="closeSuccessPhotoModal()">Tutup</button>
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

        // Functions to manage 'Tambah Akun' modal
        function openAddAdminModal() {
            document.getElementById("addAdminModal").classList.remove("hidden");
        }

        function closeAddAdminModal() {
            document.getElementById("addAdminModal").classList.add("hidden");
        }

        // Functions to manage 'Konfirmasi Tambah Admin' modal
        function openConfirmAddModal() {
            document.getElementById("confirmAddAdminModal").classList.remove("hidden");
        }

        function closeConfirmAddModal() {
            document.getElementById("confirmAddAdminModal").classList.add("hidden");
        }

        // Functions to manage 'Success Tambah Admin' modal
        function openSuccessAddModal() {
            document.getElementById("successAddAdminModal").classList.remove("hidden");
        }

        function closeSuccessAddAdminModal() {
            document.getElementById("successAddAdminModal").classList.add("hidden");
        }

        // Function to submit 'Tambah Admin' form
        function submitAddAdminForm() {
            closeConfirmAddModal();
            closeAddAdminModal();
            setTimeout(function() {
                openSuccessAddModal();
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
            const errorText = document.getElementById("photoError");

            if (fileInput.files.length === 0) {
                // Tampilkan pesan error
                errorText.classList.remove("hidden");
                return;
        }

    // Sembunyikan pesan error jika ada file yang dipilih
    errorText.classList.add("hidden");
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

        // Validasi Form Edit Profil
function validateEditProfile() {
    const username = document.getElementById("editUsername");
    const email = document.getElementById("editEmail");

    const usernameError = document.getElementById("editUsernameError");
    const emailError = document.getElementById("editEmailError");

    let valid = true;

    if (username.value.trim() === "") {
        usernameError.classList.remove("hidden");
        valid = false;
    } else {
        usernameError.classList.add("hidden");
    }

    if (email.value.trim() === "") {
        emailError.classList.remove("hidden");
        valid = false;
    } else {
        emailError.classList.add("hidden");
    }

    if (valid) {
        openConfirmModal();
    }
}

// Validasi Form Tambah Admin
function validateAddAdmin() {
    const adminEmail = document.getElementById("addAdminEmail");
    const adminUsername = document.getElementById("addAdminUsername");
    const adminPassword = document.getElementById("addAdminPassword");

    const adminEmailError = document.getElementById("addAdminEmailError");
    const adminUsernameError = document.getElementById("addAdminUsernameError");
    const adminPasswordError = document.getElementById("addAdminPasswordError");

    let valid = true;

    if (adminEmail.value.trim() === "") {
        adminEmailError.classList.remove("hidden");
        valid = false;
    } else {
        adminEmailError.classList.add("hidden");
    }

    if (adminUsername.value.trim() === "") {
        adminUsernameError.classList.remove("hidden");
        valid = false;
    } else {
        adminUsernameError.classList.add("hidden");
    }

    if (adminPassword.value.trim() === "") {
        adminPasswordError.classList.remove("hidden");
        valid = false;
    } else {
        adminPasswordError.classList.add("hidden");
    }

    if (valid) {
        openConfirmAddModal();
    }
}
// Validasi Form Ganti Password
function validateChangePassword() {
    const oldPassword = document.getElementById("oldPassword");
    const newPassword = document.getElementById("newPassword");
    const confirmNewPassword = document.getElementById("confirmNewPassword");

    const oldPasswordError = document.getElementById("oldPasswordError");
    const newPasswordError = document.getElementById("newPasswordError");
    const confirmNewPasswordError = document.getElementById("confirmNewPasswordError");

    let valid = true;

    if (oldPassword.value.trim() === "") {
        oldPasswordError.classList.remove("hidden");
        valid = false;
    } else {
        oldPasswordError.classList.add("hidden");
    }

    if (newPassword.value.trim() === "") {
        newPasswordError.classList.remove("hidden");
        valid = false;
    } else {
        newPasswordError.classList.add("hidden");
    }

    if (confirmNewPassword.value.trim() === "") {
        confirmNewPasswordError.classList.remove("hidden");
        valid = false;
    } else if (newPassword.value !== confirmNewPassword.value) {
        confirmNewPasswordError.classList.remove("hidden");
        confirmNewPasswordError.textContent = "Password baru dan konfirmasi harus sama.";
        valid = false;
    } else {
        confirmNewPasswordError.classList.add("hidden");
        confirmNewPasswordError.textContent = "Konfirmasi password harus diisi.";
    }

    if (valid) {
        openConfirmChangePasswordModal();
    }
}
    </script>
@endpush
