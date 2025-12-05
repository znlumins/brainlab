<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kurikulum Edukasi - BrainLab</title>

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            DEFAULT: '#11929C',
                            hover: '#0d7a82',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-white text-slate-900 font-sans">

    <!-- 1. Navbar (Konsisten dengan halaman Home) -->
    <nav class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-6 flex justify-between items-center border-b border-gray-100 mb-10">
        <a href="{{ url('/') }}" class="text-3xl font-bold text-brand tracking-tight">
            BrainLab.
        </a>
    </nav>

    <!-- 2. Page Header -->
    <header class="max-w-7xl mx-auto px-6 lg:px-12 mb-16">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
            <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight">
                Kurikulum Edukasi Kesehatan
            </h1>
            <p class="text-slate-500 max-w-xl text-lg leading-relaxed lg:text-right">
                Pelajari tentang tumor otak dan cara membaca hasil MRI secara bertahap. Materi disusun sistematis untuk pasien dan tenaga medis.
            </p>
        </div>
        <hr class="mt-12 border-gray-100">
    </header>

    <!-- 3. Course Section 1: Anatomi -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-24">
        <!-- Top Info -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Anatomi & Jenis Tumor Otak</h2>
                <p class="text-slate-500">Memahami struktur otak manusia, bagaimana tumor terbentuk, dan perbedaan antara tumor jinak dengan ganas.</p>
            </div>
            <button class="px-6 py-2.5 border border-slate-200 rounded-lg font-bold text-slate-700 hover:border-brand hover:text-brand transition-colors text-sm">
                View Course
            </button>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl" alt="Study 1">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl" alt="Study 2">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl" alt="Study 3">
        </div>

        <!-- Meta Info -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex gap-3">
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">4 Weeks</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">Beginner</span>
            </div>
            <span class="text-slate-900 font-semibold">By Daffa Ahmad Al Attas</span>
        </div>

        <!-- Curriculum Steps Strip -->
        <div class="border border-slate-100 rounded-2xl p-8 grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-100 bg-white shadow-sm">
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">01</span>
                <span class="text-sm font-medium text-slate-600">Struktur Otak</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">02</span>
                <span class="text-sm font-medium text-slate-600">Apa itu Tumor?</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">03</span>
                <span class="text-sm font-medium text-slate-600">Jinak vs Ganas</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">04</span>
                <span class="text-sm font-medium text-slate-600">Gejala Umum</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">05</span>
                <span class="text-sm font-medium text-slate-600">Kuis Pemahaman</span>
            </div>
        </div>
    </section>

    <!-- 4. Course Section 2: Panduan MRI -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-24">
        <!-- Top Info -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Panduan Membaca MRI</h2>
                <p class="text-slate-500">Panduan praktis untuk orang awam dalam memahami visualisasi hasil scan MRI dan mengenali anomali.</p>
            </div>
            <button class="px-6 py-2.5 border border-slate-200 rounded-lg font-bold text-slate-700 hover:border-brand hover:text-brand transition-colors text-sm">
                View Course
            </button>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Placeholder images matching the "designing/studying" vibe from reference -->
            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl" alt="MRI Study 1">
            <img src="https://images.unsplash.com/photo-1531538606174-0f90ff5dce83?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl" alt="MRI Study 2">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1000&auto=format&fit=crop" class="w-full h-64 object-cover rounded-2xl" alt="MRI Study 3">
        </div>

        <!-- Meta Info -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex gap-3">
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">6 Weeks</span>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-md text-sm font-semibold">Intermediate</span>
            </div>
            <span class="text-slate-900 font-semibold">By Daffa Ahmad Al Attas</span>
        </div>

        <!-- Curriculum Steps Strip -->
        <div class="border border-slate-100 rounded-2xl p-8 grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-100 bg-white shadow-sm">
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">01</span>
                <span class="text-sm font-medium text-slate-600">Dasar Radiologi</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">02</span>
                <span class="text-sm font-medium text-slate-600">Orientasi Gambar</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">03</span>
                <span class="text-sm font-medium text-slate-600">Identifikasi Tumor</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">04</span>
                <span class="text-sm font-medium text-slate-600">Edema & Nekrosis</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-4xl font-bold text-slate-900 mb-1">05</span>
                <span class="text-sm font-medium text-slate-600">Studi Kasus</span>
            </div>
        </div>
    </section>

</body>
</html>