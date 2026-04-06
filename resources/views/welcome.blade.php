<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Tamu Digital | The Wedding of ...</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Icons & JS -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased scroll-smooth">

    <!-- HERO / COVER SECTION -->
    <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-subtitle mb-4">You are Invited to</span>
            <h1 class="hero-title">The Wedding of</h1>
            <h2 class="text-4xl font-serif text-gold mb-8 mt-4 tracking-widest italic">Fulan & Fulanah</h2>
            <div class="w-24 h-0.5 bg-gold mx-auto mb-10"></div>
            <a href="#guestbook"
                class="bg-primary-red text-white px-10 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-gold transition-all duration-300 shadow-xl">
                Buka Buku Tamu
            </a>
        </div>
    </header>

    <div class="main-wrapper" id="guestbook">

        <!-- FORM SECTION -->
        <div class="wedding-card animate-up">
            <h1 class="form-title">Tanda Kehadiran & Doa</h1>
            <p class="text-center text-gray-400 mb-8 font-serif italic">"Kehadiran dan doa Anda adalah anugerah terindah
                bagi kami."</p>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('guestbook.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-input" placeholder="Contoh: Budi Santoso" required
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" name="phone" class="form-input" placeholder="Contoh: 08123456xxx" required
                            value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Kota / Alamat</label>
                    <input type="text" name="address" class="form-input" placeholder="Masukkan alamat Anda" required
                        value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Ucapan & Doa Suci</label>
                    <textarea name="message" rows="4" class="form-input"
                        placeholder="Berikan doa terbaik Anda untuk kedua mempelai..."
                        required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Ucapan Suci ❤️
                </button>
            </form>
        </div>

        <!-- MESSAGES FEED -->
        <div class="messages-section">
            <div class="flex items-center gap-4 mb-10">
                <div class="h-px bg-gold flex-grow"></div>
                <h2 class="text-3xl text-primary-red font-bold">Untaian Doa Tamu</h2>
                <div class="h-px bg-gold flex-grow"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($entries as $entry)
                    <div class="message-card animate-up" style="animation-delay: 0.2s">
                        <div class="message-header">
                            <span class="guest-name">{{ $entry->name }}</span>
                            <span class="guest-date">{{ $entry->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="guest-address">📍 {{ $entry->address }}</span>
                        <p class="guest-message italic mt-3">"{{ $entry->message }}"</p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 text-gray-400 font-serif italic">
                        Belum ada doa yang terucap. Jadilah yang pertama memberikan restu.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-20 text-center text-gray-400 py-10">
            <p class="font-serif italic">&copy; {{ date('Y') }} Fulan & Fulanah Wedding. Dibuat dengan cinta.</p>
        </footer>
    </div>

    <!-- FLOATING ADMIN LINK -->
    <a href="{{ route('admin.index') }}"
        class="fixed bottom-6 right-6 bg-white/50 backdrop-blur-sm p-3 rounded-full hover:bg-white transition-all shadow-lg text-gray-400 hover:text-primary-red"
        title="Admin Panel">
        <i data-lucide="settings" class="w-5 h-5"></i>
    </a>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>