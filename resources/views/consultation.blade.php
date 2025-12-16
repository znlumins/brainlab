<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konsultasi AI - BrainLab</title>

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
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
                            DEFAULT: '#11929C', // Warna Teal BrainLab
                            hover: '#0d7a82',
                            dark: '#0a636a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .typing-cursor { animation: blink 1s step-end infinite; }
        @keyframes blink { from, to { color: transparent } 50% { color: #334155; } }

        /* CSS untuk Tooltip Kustom */
        .group:hover .group-hover-tooltip {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 font-sans flex flex-col h-screen overflow-hidden">

    <!-- Navbar (Menggunakan Komponen Blade) -->
    <header class="w-full bg-white border-b border-slate-200 shrink-0 z-50">
        <x-navbar />
    </header>

    <!-- Main Content Area -->
    <div class="flex-grow flex overflow-hidden">
        <main class="flex-grow flex flex-col p-6 bg-slate-100">
            <div id="chat-container" class="flex-grow overflow-y-auto space-y-6 custom-scrollbar pr-4">
                <!-- Chat messages will be appended here -->
            </div>
            
            <form id="chat-form" class="mt-6 flex items-center gap-3">
    
                <textarea id="prompt-input" placeholder="Tanyakan tentang istilah, perawatan, atau kondisi..." rows="1" autofocus 
                          class="flex-grow p-3 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-brand focus:border-transparent resize-none"></textarea>
                
                <button type="button" id="reset-button"
                        class="group relative p-3 bg-slate-200 text-slate-600 rounded-lg hover:bg-slate-300 transition-colors shrink-0">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    
                    <span class="group-hover-tooltip absolute bottom-full mb-2 left-1/2 -translate-x-1/2 w-max px-3 py-1.5 bg-slate-800 text-white text-xs font-semibold rounded-md opacity-0 visibility-hidden transition-opacity duration-200">
                        Reset Chat
                    </span>
                </button>
                
                <button type="submit" class="px-5 py-3 bg-brand text-white font-bold rounded-lg shadow-md shadow-brand/30 hover:bg-brand-hover transition-all flex items-center justify-center gap-2 shrink-0">
                    Kirim
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-90" viewBox="0 0 20 20" fill="currentColor">
                         <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </form>
        </main>
    </div>

    <!-- JavaScript (Tidak ada perubahan di sini) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chatForm = document.getElementById('chat-form');
            const promptInput = document.getElementById('prompt-input');
            const chatContainer = document.getElementById('chat-container');
            const resetButton = document.getElementById('reset-button');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            let chatHistory = [];

            function addMessageToUI(role, content) {
                const messageWrapper = document.createElement('div');
                const messageDiv = document.createElement('div');
                let formattedContent = content.replace(/\n/g, '<br>');

                messageDiv.innerHTML = formattedContent;
                messageDiv.classList.add('px-5', 'py-3', 'rounded-xl', 'max-w-xl', 'lg:max-w-2xl', 'leading-relaxed');

                if (role === 'user') {
                    messageWrapper.classList.add('flex', 'justify-end');
                    messageDiv.classList.add('bg-brand', 'text-white');
                } else {
                    messageWrapper.classList.add('flex', 'justify-start');
                    messageDiv.classList.add('bg-white', 'text-slate-700', 'border', 'border-slate-200');
                }
                
                messageWrapper.appendChild(messageDiv);
                chatContainer.appendChild(messageWrapper);
                chatContainer.scrollTop = chatContainer.scrollHeight;
                return messageDiv;
            }

            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const prompt = promptInput.value.trim();
                if (!prompt) return;

                addMessageToUI('user', prompt);
                chatHistory.push({ role: 'user', content: prompt });
                promptInput.value = '';
                promptInput.disabled = true;

                const aiMessagePlaceholder = addMessageToUI('assistant', '<span class="typing-cursor">▌</span>');
                let fullResponse = '';

                try {
                    const response = await fetch('/chat', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                        body: JSON.stringify({ messages: chatHistory.slice(-8) })
                    });

                    if (!response.ok) { throw new Error(`HTTP error! Status: ${response.status}, Pesan: ${await response.text()}`); }
                    
                    const reader = response.body.getReader();
                    const decoder = new TextDecoder();

                    while (true) {
                        const { done, value } = await reader.read();
                        if (done) { break; }

                        const chunk = decoder.decode(value, { stream: true });
                        const lines = chunk.split('\n').filter(line => line.trim().startsWith('data:'));
                        
                        for (const line of lines) {
                            const data = line.substring(6).trim();
                            if (data === '[DONE]') break;
                            try {
                                const parsed = JSON.parse(data);
                                if (parsed.error) { throw new Error(`API Error: ${parsed.error}`); }
                                
                                if (parsed.choices && parsed.choices[0].delta.content) {
                                    let originalContent = parsed.choices[0].delta.content;
                                    let cleanedContent = originalContent.replace(/[*_]/g, '');
                                    fullResponse += cleanedContent;
                                    aiMessagePlaceholder.innerHTML = fullResponse.replace(/\n/g, '<br>').replace(/---/g, '<hr class="my-3 border-slate-300">') + '<span class="typing-cursor">▌</span>';
                                }
                            } catch (error) { /* Abaikan error parsing */ }
                        }
                    }
                    
                    aiMessagePlaceholder.innerHTML = fullResponse.replace(/\n/g, '<br>').replace(/---/g, '<hr class="my-3 border-slate-300">');
                    if (fullResponse) { chatHistory.push({ role: 'assistant', content: fullResponse }); }

                } catch (error) {
                    console.error('Fetch error:', error);
                    aiMessagePlaceholder.innerHTML = `<strong class="text-red-600">Terjadi Kesalahan:</strong><br>${error.message}`;
                } finally {
                    promptInput.disabled = false;
                    promptInput.focus();
                }
            });

            resetButton.addEventListener('click', () => {
                chatHistory = [];
                chatContainer.innerHTML = '';
                addMessageToUI('assistant', 'Sesi telah direset. Saya siap untuk konsultasi baru.');
            });
            
            addMessageToUI('assistant', 'Selamat datang di sesi konsultasi AI BrainLab. Silakan ajukan pertanyaan Anda mengenai kesehatan tumor.');
        });
    </script>
</body>
</html>