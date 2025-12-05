<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analisis AI - BrainLab</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: '#11929C' },
                    cursor: { grab: 'grab', grabbing: 'grabbing' }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-white text-slate-900 min-h-screen flex flex-col">

    <!-- 1. Header & Toolbar -->
    <header class="px-6 py-4 flex justify-between items-center border-b border-gray-100 shadow-sm z-20 bg-white sticky top-0">
        <!-- Back Button -->
        <a href="{{ url('/') }}" class="w-10 h-10 rounded-full bg-brand flex items-center justify-center text-white hover:bg-teal-700 transition shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>

        <!-- Toolbar Icons (Interaksi Front-End Murni) -->
        <div class="flex gap-2 bg-slate-800 p-2 rounded-lg shadow-lg">
            <button onclick="activateTool('pan')" id="btn-pan" class="tool-btn w-9 h-9 rounded bg-slate-600 text-white flex items-center justify-center hover:bg-brand transition ring-2 ring-transparent focus:ring-brand" title="Geser Gambar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg>
            </button>
            <button onclick="adjustZoom(0.1)" class="w-9 h-9 rounded bg-slate-700 text-white flex items-center justify-center hover:bg-brand transition" title="Perbesar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
            </button>
             <button onclick="adjustZoom(-0.1)" class="w-9 h-9 rounded bg-slate-700 text-white flex items-center justify-center hover:bg-brand transition" title="Perkecil">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path></svg>
            </button>
            <button onclick="toggleContrast()" id="btn-contrast" class="w-9 h-9 rounded bg-slate-700 text-white flex items-center justify-center hover:bg-brand transition" title="Mode Kontras">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
            <button onclick="resetImage()" class="w-9 h-9 rounded bg-slate-700 text-white flex items-center justify-center hover:bg-brand transition" title="Reset">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
        </div>
        <div class="w-10"></div>
    </header>

    <!-- 2. Main Workspace -->
    <main class="flex-grow flex flex-col items-center justify-start p-6 bg-gray-50 relative">
        
        <!-- Upload Input (Hidden) -->
        <input type="file" id="fileInput" accept="image/*" class="hidden" onchange="handleImageUpload(event)">

        <!-- Viewer Container -->
        <div id="viewerContainer" class="relative rounded-3xl overflow-hidden shadow-2xl bg-black max-w-4xl w-full h-[500px] flex items-center justify-center cursor-default shrink-0 group">
            
            <!-- STATE 1: Upload (Tampilan Awal) -->
            <div id="uploadState" class="text-center p-10 cursor-pointer hover:bg-gray-900 transition w-full h-full flex flex-col items-center justify-center" onclick="document.getElementById('fileInput').click()">
                <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mb-4 mx-auto animate-pulse group-hover:bg-gray-700 transition">
                    <svg class="w-10 h-10 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </div>
                <h3 class="text-white text-xl font-bold mb-2">Upload Gambar MRI</h3>
                <p class="text-gray-400 text-sm">Klik area ini untuk simulasi upload</p>
            </div>

            <!-- STATE 2: Image Viewer (Akan muncul setelah upload) -->
            <div id="imageWrapper" class="hidden w-full h-full relative items-center justify-center transform-gpu transition-transform duration-75 ease-out origin-center">
                
                <!-- Gambar yang diupload user -->
                <img id="mriImage" src="" alt="MRI Scan" class="max-w-none h-full object-contain pointer-events-none select-none transition-filter duration-300">
                
                <!-- 
                    [NOTE UNTUK BACKEND DEV]:
                    Ini adalah Kotak Hasil AI.
                    Nanti posisi (top, left) dan ukuran (w, h) harus diganti dinamis berdasarkan respon JSON dari AI.
                -->
                <div id="aiBox" class="hidden absolute top-1/2 left-[55%] transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 border-[3px] border-red-600 shadow-[0_0_15px_rgba(255,0,0,0.5)]">
                    <div class="absolute -top-7 left-0 bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-sm shadow-sm flex items-center gap-1">
                        <span class="animate-pulse w-2 h-2 bg-white rounded-full"></span>
                        Tumor Detected (98%)
                    </div>
                </div>
            </div>

            <!-- STATE 3: Loading (Spinner) -->
            <div id="loadingState" class="hidden absolute inset-0 bg-black/80 z-50 flex flex-col items-center justify-center">
                <div class="w-12 h-12 border-4 border-brand border-t-transparent rounded-full animate-spin mb-4"></div>
                <p class="text-brand font-mono animate-pulse">Processing Image...</p>
            </div>
        </div>

        <!-- Status Badge (Muncul setelah deteksi) -->
        <div id="statusBadge" class="mt-8 mb-4 opacity-0 transition-opacity duration-500">
            <span class="bg-red-500 text-white px-6 py-2 rounded-full text-sm font-bold shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Abnormal Detected
            </span>
        </div>

    </main>

    <!-- 3. Footer Actions -->
    <footer class="py-12 px-6 flex flex-col md:flex-row justify-center gap-4 bg-white border-t border-gray-100">
        <button class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-md transition shadow-md w-full md:w-auto">
            Buat Laporan Lengkap
        </button>
        <button class="bg-slate-800 hover:bg-slate-900 text-slate-200 font-medium px-8 py-3 rounded-md transition shadow-md w-full md:w-auto">
            Ekspor Data DICOM
        </button>
    </footer>

    <!-- 
        ================================================================
        JAVASCRIPT (UI LOGIC ONLY)
        Teman Backend Developer: Silakan modifikasi fungsi handleImageUpload
        ================================================================
    -->
    <script>
        // --- Variables UI ---
        let scale = 1;
        let pannedX = 0;
        let pannedY = 0;
        let isContrastHigh = false;
        let isDragging = false;
        let startX, startY;
        let currentTool = 'pan'; 

        const viewer = document.getElementById('viewerContainer');
        const wrapper = document.getElementById('imageWrapper');
        const img = document.getElementById('mriImage');
        const aiBox = document.getElementById('aiBox');

        // --- 1. HANDLE UPLOAD (MOCKUP) ---
        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    
                    // 1. Tampilkan Loading State UI
                    document.getElementById('uploadState').classList.add('hidden');
                    document.getElementById('loadingState').classList.remove('hidden');

                    // 2. Set Preview Gambar
                    img.src = e.target.result;

                    // -------------------------------------------------------------
                    // [AREA INTEGRASI AI]
                    // Di sini temanmu nanti akan melakukan fetch/axios ke API.
                    // Saat ini saya pakai setTimeout untuk simulasi loading 2 detik.
                    // -------------------------------------------------------------
                    setTimeout(() => {
                        // Sembunyikan Loading
                        document.getElementById('loadingState').classList.add('hidden');
                        
                        // Tampilkan Gambar
                        document.getElementById('imageWrapper').classList.remove('hidden');
                        document.getElementById('imageWrapper').classList.add('flex'); 
                        
                        // Tampilkan Kotak Merah & Badge (Simulasi Hasil AI)
                        aiBox.classList.remove('hidden');
                        document.getElementById('statusBadge').classList.remove('opacity-0');

                    }, 2000); // Simulasi delay 2 detik
                }
                reader.readAsDataURL(file);
            }
        }

        // --- 2. FITUR VIEWER (ZOOM, PAN, CONTRAST) ---
        // Ini murni UI Logic (Javascript Client Side), tidak perlu diubah backend dev.

        function updateTransform() {
            wrapper.style.transform = `translate(${pannedX}px, ${pannedY}px) scale(${scale})`;
        }

        function adjustZoom(delta) {
            if(document.getElementById('uploadState').classList.contains('hidden') === false) return; 
            scale += delta;
            if (scale < 0.5) scale = 0.5; 
            if (scale > 3) scale = 3;     
            updateTransform();
        }

        function toggleContrast() {
            if(document.getElementById('uploadState').classList.contains('hidden') === false) return;
            isContrastHigh = !isContrastHigh;
            const btn = document.getElementById('btn-contrast');
            if (isContrastHigh) {
                img.style.filter = "contrast(1.5) brightness(1.2) grayscale(100%)"; 
                btn.classList.replace('bg-slate-700', 'bg-brand');
            } else {
                img.style.filter = "none";
                btn.classList.replace('bg-brand', 'bg-slate-700');
            }
        }

        function resetImage() {
            scale = 1; pannedX = 0; pannedY = 0; isContrastHigh = false;
            img.style.filter = "none";
            document.getElementById('btn-contrast').classList.replace('bg-brand', 'bg-slate-700');
            updateTransform();
        }

        function activateTool(tool) { currentTool = tool; }

        // Mouse Drag Logic
        viewer.addEventListener('mousedown', (e) => {
            if (currentTool !== 'pan' || document.getElementById('imageWrapper').classList.contains('hidden')) return;
            isDragging = true;
            startX = e.clientX - pannedX;
            startY = e.clientY - pannedY;
            viewer.classList.add('cursor-grabbing');
        });

        viewer.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            pannedX = e.clientX - startX;
            pannedY = e.clientY - startY;
            updateTransform();
        });

        viewer.addEventListener('mouseup', () => { isDragging = false; viewer.classList.remove('cursor-grabbing'); });
        viewer.addEventListener('mouseleave', () => { isDragging = false; viewer.classList.remove('cursor-grabbing'); });
        
        // Mouse Wheel Zoom
        viewer.addEventListener('wheel', (e) => {
             if (document.getElementById('imageWrapper').classList.contains('hidden')) return;
             e.preventDefault();
             if(e.deltaY < 0) adjustZoom(0.1); else adjustZoom(-0.1);
        }, { passive: false });

    </script>
</body>
</html>