<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Tamu Pernikahan | Wedding Guestbook</title>
    
    <!-- 
        VIEW: Bagian 'V' dalam MVC.
        Ini yang dilihat oleh user di browser.
    -->
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (for simple interactions) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Fallback / Extra styles */
        .floral-svg { fill: #9B1B30; opacity: 0.1; }
        .success-box { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: 500; }
        .error-message { color: #9B1B30; font-size: 0.85rem; margin-top: -10px; margin-bottom: 10px; display: block; }
    </style>
</head>
<body class="antialiased">

    <!-- Decoration Top Right -->
    <div class="floral-pattern top-right">
        <svg width="300" height="300" viewBox="0 0 100 100" class="floral-svg">
            <path d="M50 0C50 0 45 20 30 30C15 40 0 40 0 40C0 40 20 45 30 60C40 75 40 90 40 90C40 90 45 70 60 60C75 50 90 50 90 50C90 50 70 45 60 30C50 15 50 0 50 0Z" />
        </svg>
    </div>

    <!-- Decoration Bottom Left -->
    <div class="floral-pattern bottom-left">
        <svg width="300" height="300" viewBox="0 0 100 100" class="floral-svg">
            <path d="M50 0C50 0 45 20 30 30C15 40 0 40 0 40C0 40 20 45 30 60C40 75 40 90 40 90C40 90 45 70 60 60C75 50 90 50 90 50C90 50 70 45 60 30C50 15 50 0 50 0Z" />
        </svg>
    </div>

    <div class="container mx-auto px-4 py-12 max-w-6xl">
        
        <!-- Header -->
        <div class="text-center mb-16 animate-fade-in">
            <span class="text-rose-gold uppercase tracking-widest font-semibold text-sm">Selamat Datang di</span>
            <h1 class="text-5xl md:text-7xl font-bold mt-2 text-deep-red">Buku Tamu Pernikahan</h1>
            <p class="text-lg italic mt-4 text-gray-500 font-serif">Simpan Doa & Harapan Anda untuk Kedua Mempelai</p>
            <div class="w-16 h-1 bg-primary-red mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Left: Form -->
            <div class="wedding-card p-8 animate-fade-in" style="animation-delay: 0.2s">
                <h2 class="text-2xl font-bold mb-6 text-primary-red border-b border-pink-100 pb-2">Tinggalkan Pesan</h2>
                
                @if(session('success'))
                    <div class="success-box animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('guestbook.store') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-600">Nama Lengkap</label>
                        <input type="text" name="name" class="form-input" placeholder="Masukkan nama Anda" required value="{{ old('name') }}">
                        @error('name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-600">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-input" placeholder="Contoh: 08123456789" required value="{{ old('phone') }}">
                        @error('phone') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-600">Alamat</label>
                        <input type="text" name="address" class="form-input" placeholder="Kota atau Alamat singkat" required value="{{ old('address') }}">
                        @error('address') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-600">Ucapan & Doa</label>
                        <textarea name="message" rows="4" class="form-input" placeholder="Tuliskan ucapan selamat atau doa terbaik Anda..." required>{{ old('message') }}</textarea>
                        @error('message') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full text-lg mt-4">
                        Kirim Ucapan ❤️
                    </button>
                </form>
            </div>

            <!-- Right: Messages -->
            <div class="animate-fade-in" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-deep-red">Pesan dari Tamu</h2>
                    <span class="bg-primary-red text-white text-xs px-3 py-1 rounded-full">{{ count($entries) }} Pesan</span>
                </div>

                <div class="max-h-[600px] overflow-y-auto pr-4 custom-scrollbar">
                    @forelse($entries as $entry)
                        <div class="guest-entry group hover:-translate-y-1 transition-all duration-300">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-800">{{ $entry->name }}</h3>
                                <span class="text-xs text-gray-400 italic">{{ $entry->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-2 font-medium"><span class="text-primary-red opacity-50 font-bold">📍</span> {{ $entry->address }}</p>
                            <p class="text-gray-700 italic border-t border-pink-50 pt-3 mt-1">"{{ $entry->message }}"</p>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl shadow-inner border border-dashed border-pink-200">
                            <p class="text-gray-400 italic">Belum ada pesan. Jadilah yang pertama memberikan doa!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-24 text-center pb-8 border-t border-pink-100 pt-8 opacity-60">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Wedding Guestbook. Dibuat dengan cinta untuk hari bahagiaku.</p>
        </footer>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #fff;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: var(--soft-pink);
            border-radius: 20px;
        }
    </style>
</body>
</html>
