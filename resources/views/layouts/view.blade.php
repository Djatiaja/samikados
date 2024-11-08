<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Samikados')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 to-black text-white p-4 sticky top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">SAMIKADOS</h1>
            @yield('searchbar') <!-- Bagian dinamis untuk searchbar -->
            <a href="{{ route('dashboard-fe') }}">
                <span class="text-lg">ADMIN</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-8 flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-red-600 to-black text-white p-8 mt-8">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between">
            <section class="mb-8 lg:mb-0">
                <h2 class="text-3xl lg:text-4xl font-bold">SAMIKADOS</h2>
                <p class="text-lg lg:text-xl">SOLUSI TEPAT, PRINT DI MANA SAJA</p>
            </section>
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
                <p>Senin - Jumat: 08.30 s/d 21.00 WIB</p>
                <p>Sabtu: 08.30 s/d 15.00 WIB</p>
                <p>Minggu / Tanggal Merah: Libur</p>
            </section>
            <section>
                <h3 class="text-xl font-bold">PEMBAYARAN</h3>
                <img src="{{ asset('/assets/MidtransLogo.png') }}" alt="Payment placeholder" class="w-24 h-15 mt-2">
            </section>
        </div>
    </footer>

    @yield('scripts') <!-- Tempat untuk menyertakan script halaman yang mewarisi -->

</body>
</html>
