<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samikados Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen font-roboto">

    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 to-black p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center text-white">
                <h1 class="text-3xl lg:text-4xl font-bold">SAMIKADOS</h1>
                <span class="text-lg lg:text-xl ml-4">LOGIN</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-20 flex flex-col lg:flex-row justify-evenly items-center lg:items-start lg:justify-self-center flex-grow">
        
        <!-- Image Section (Hidden on mobile) -->
        <section class="w-full lg:w-1/2 mb-8 lg:mb-0 hidden lg:flex">
            <figure>
                <img src="{{ asset('storage/assets/Transparent.png') }}" 
                     alt="Placeholder image" 
                     class="w-full">
            </figure>
        </section>
        
        <!-- Login Form -->
        <section class="w-full lg:w-1/3 bg-white p-8 shadow-xl rounded-lg">
            <h2 class="text-xl lg:text-2xl font-bold mb-4 text-gray-800">LOGIN</h2>
            <form>
                <!-- Email / Username -->
                <div class="mb-4">
                    <label for="username" class="sr-only">Email / Username</label>
                    <input id="username" 
                           class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                           placeholder="Email / Username" 
                           type="text" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" 
                           class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600" 
                           placeholder="Password" 
                           type="password" />
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex justify-between items-center mb-4">
                    <label class="flex items-center text-gray-700 text-sm lg:text-base">
                        <input class="mr-2" type="checkbox" /> Ingat Saya
                    </label>
                    <a class="text-xs lg:text-sm text-red-600 hover:underline" href="{{ route('forgot-password-fe') }}">Lupa Password?</a>
                </div>

                <!-- Submit Button -->
                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg mb-4 transition duration-300 shadow-lg" type="button" onclick="window.location.href='Dashboard.html'">
                    Masuk
                </button>

                <!-- Google Sign-up -->
                <div class="text-center mb-4 text-gray-700">atau</div>
                <button class="w-full bg-white border border-gray-400 text-gray-700 py-3 rounded-lg flex items-center justify-center hover:bg-gray-50 transition duration-300 shadow-sm" type="button" onclick="window.location.href='Dashboard.html'">
                    <img src="{{ asset('storage/assets/google.png') }}" alt="Google placeholder" class="mr-2"> Sign In with Google
                </button>

            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-red-600 to-black p-8 mt-auto shadow-lg text-white">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between">
            <!-- Company Info -->
            <section class="mb-8 lg:mb-0">
                <h2 class="text-3xl lg:text-4xl font-bold">SAMIKADOS</h2>
                <p class="text-lg lg:text-xl">SOLUSI TEPAT, PRINT DI MANA SAJA</p>
            </section>

            <!-- Contact Information -->
            <section class="mb-8 lg:mb-0">
                <h3 class="text-xl font-bold">HUBUNGI KAMI</h3>
                <address>
                    DKI JAKARTA<br>
                    Jl. Gilimanuk Raya No.60<br>
                    Daan Mogot Baru - Kalideres<br>
                    Jakarta Barat 11840<br>
                    <a href="tel:+622154399642">(021) 54399642</a>
                </address>
                <h3 class="text-xl font-bold mt-4">OPERASIONAL</h3>
                <p class="text-sm lg:text-base">
                    Senin - Jumat: 08.30 s/d 21.00 WIB<br>
                    Sabtu: 08.30 s/d 15.00 WIB<br>
                    Minggu / Tanggal Merah: Libur
                </p>
            </section>

            <!-- Payment Information -->
            <section>
                <h3 class="text-xl font-bold">PEMBAYARAN</h3>
                <img src="{{ asset('storage/assets/Midtrans.png') }}" alt="Payment placeholder" class="w-24 h-15">
            </section>
        </div>
    </footer>

</body>
</html>
