<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>Analisis AI - BrainLab</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: '#11929C' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-slate-900 min-h-screen flex flex-col font-sans">

    <!-- Header (Struktur diperbaiki agar tombol lebih dekat) -->
    <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <!-- Container utama dengan max-width dan flexbox -->
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex justify-between items-center">
            
            <!-- Sisi Kiri: Logo -->
            <a href="/" class="text-3xl font-bold text-brand tracking-tight py-6">BrainLab.</a>

            <!-- Sisi Kanan: Grup link dan tombol aksi -->
            <div class="flex items-center gap-6 lg:gap-8">
                
                <!-- Link navigasi (disembunyikan di mobile) -->
                <div class="hidden lg:flex items-center gap-8 text-sm font-medium text-slate-600">
                    <a href="/" class="hover:text-brand transition-colors">Home</a>
                    <a href="/analysis" class="hover:text-brand transition-colors">Scan MRI</a>
                    <a href="/consultation" class="hover:text-brand transition-colors">Consultation</a>
                    <a href="/team" class="hover:text-brand transition-colors">Our Team</a>
                </div>
                
                <!-- Tombol Aksi Khusus untuk halaman ini -->
                <button onclick="resetImage()" class="bg-slate-800 hover:bg-slate-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">
                    Reset Scan
                </button>
            </div>

        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center p-6 w-full max-w-5xl mx-auto">
        
        <input type="file" id="fileInput" accept="image/*" class="hidden" onchange="handleImageUpload(event)">

        <!-- Viewer Area -->
        <div id="viewerContainer" class="relative rounded-2xl overflow-hidden shadow-2xl bg-black w-full max-w-3xl aspect-video flex items-center justify-center border border-gray-800">
            
            <!-- State 1: Upload Button -->
            <div id="uploadState" class="text-center cursor-pointer hover:bg-gray-900 w-full h-full flex flex-col items-center justify-center transition group" onclick="document.getElementById('fileInput').click()">
                <div class="w-20 h-20 rounded-full bg-gray-800 flex items-center justify-center mb-4 group-hover:scale-110 transition duration-300">
                    <svg class="w-10 h-10 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h3 class="text-white text-xl font-bold">Upload Gambar MRI/CT</h3>
                <p class="text-gray-400 text-sm mt-2">Klik untuk memilih file (JPG, PNG)</p>
            </div>

            <!-- State 2: Image Preview & Boxes -->
            <div id="imageWrapper" class="hidden w-full h-full relative">
                <img id="mriImage" src="" class="w-full h-full object-contain select-none">
                <div id="overlayLayer" class="absolute inset-0 pointer-events-none"></div>
            </div>

            <!-- State 3: Loading -->
            <div id="loadingState" class="hidden absolute inset-0 bg-black/90 z-50 flex flex-col items-center justify-center backdrop-blur-sm">
                <div class="w-12 h-12 border-4 border-brand border-t-transparent rounded-full animate-spin mb-4"></div>
                <p class="text-brand font-semibold animate-pulse tracking-wide">MENGANALISA AI...</p>
            </div>
        </div>

        <!-- Status Result -->
        <div id="statusBadge" class="mt-8 opacity-0 transition-all duration-500 transform translate-y-4">
            <div id="statusContent" class="flex flex-col items-center gap-2">
                <span id="statusText" class="px-6 py-2 rounded-full text-white font-bold shadow-lg text-sm"></span>
                <p id="statusDetail" class="text-gray-500 text-sm"></p>
            </div>
        </div>
    </main>

    <!-- Javascript Logic -->
    <script>
        const img = document.getElementById('mriImage');
        const overlay = document.getElementById('overlayLayer');
        
        async function handleImageUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            overlay.innerHTML = '';
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                document.getElementById('uploadState').classList.add('hidden');
                document.getElementById('imageWrapper').classList.remove('hidden');
                document.getElementById('loadingState').classList.remove('hidden');
            }
            reader.readAsDataURL(file);

            const formData = new FormData();
            formData.append('image', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch('/analysis/predict', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                });

                const data = await response.json();
                if (!response.ok) throw new Error(data.error || 'Gagal melakukan prediksi');

                setTimeout(() => {
                    document.getElementById('loadingState').classList.add('hidden');
                    renderDetections(data);
                }, 500);

            } catch (error) {
                console.error(error);
                alert("Error: " + error.message);
                resetImage();
            }
        }

        function renderDetections(detections) {
            const statusBadge = document.getElementById('statusBadge');
            const statusText = document.getElementById('statusText');
            const statusDetail = document.getElementById('statusDetail');
            
            statusBadge.classList.remove('opacity-0', 'translate-y-4');

            if (detections.length === 0) {
                statusText.innerText = "Tidak Ditemukan Kelainan (Normal)";
                statusText.className = "bg-emerald-500 px-6 py-2 rounded-full text-white font-bold shadow-lg";
                statusDetail.innerText = "AI tidak mendeteksi objek yang dikenali pada model ini.";
            } else {
                const top = detections.reduce((prev, current) => (prev.conf > current.conf) ? prev : current);
                
                statusText.innerText = `Terdeteksi: ${top.label.toUpperCase()}`;
                statusText.className = "bg-red-600 px-6 py-2 rounded-full text-white font-bold shadow-lg animate-bounce";
                statusDetail.innerText = `Akurasi tertinggi: ${(top.conf * 100).toFixed(1)}%`;
            }

            detections.forEach(det => {
                const box = document.createElement('div');
                box.className = 'absolute border-2 border-red-500 shadow-[0_0_10px_rgba(255,0,0,0.5)] z-10 transition-all duration-300 hover:bg-red-500/10';
                
                const left = (det.x - (det.w / 2)) * 100;
                const top = (det.y - (det.h / 2)) * 100;
                const width = det.w * 100;
                const height = det.h * 100;

                box.style.left = `${left}%`;
                box.style.top = `${top}%`;
                box.style.width = `${width}%`;
                box.style.height = `${height}%`;

                const label = document.createElement('div');
                label.className = "absolute -top-7 left-0 bg-red-600 text-white text-[10px] uppercase font-bold px-2 py-1 rounded shadow-sm whitespace-nowrap";
                label.innerText = `${det.label} ${(det.conf * 100).toFixed(0)}%`;
                
                box.appendChild(label);
                overlay.appendChild(box);
            });
        }
        
        function resetImage() {
             location.reload();
        }
    </script>
</body>
</html>