<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Turnamen - {{ $tournament->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
    
    <!-- Navigasi Kembali -->
    <nav class="p-6 border-b border-gray-800">
        <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-400 font-bold transition">
            &larr; Kembali ke Beranda
        </a>
    </nav>

    <!-- Konten Detail -->
    <main class="container mx-auto px-6 py-12 max-w-4xl">
        <div class="bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-700">
            <h1 class="text-4xl font-bold mb-2">{{ $tournament->name }}</h1>
            <p class="text-xl text-blue-400 font-semibold mb-8">{{ $tournament->game_title }}</p>

            <!-- Grid Informasi -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
                    <p class="text-gray-400 text-sm mb-1">Status Pendaftaran</p>
                    <p class="font-bold text-lg uppercase {{ $tournament->status == 'registration' ? 'text-green-400' : 'text-yellow-400' }}">
                        {{ $tournament->status }}
                    </p>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
                    <p class="text-gray-400 text-sm mb-1">Slot Maksimal</p>
                    <p class="font-bold text-lg">{{ $tournament->max_teams }} Tim</p>
                </div>
                <div class="bg-gray-700 p-4 rounded-lg border border-gray-600">
                    <p class="text-gray-400 text-sm mb-1">Tanggal Mulai</p>
                    <p class="font-bold text-lg">{{ \Carbon\Carbon::parse($tournament->start_date)->format('d F Y') }}</p>
                </div>
            </div>

            <!-- Notifikasi Sukses Pendaftaran -->
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg mb-8 text-center font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Daftar Tim yang Berpartisipasi -->
            <div class="mt-12 mb-8">
                <h2 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">
                    Tim yang Mendaftar ({{ $tournament->teams()->count() }} / {{ $tournament->max_teams }})
                </h2>
                
                @if($tournament->teams->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($tournament->teams as $team)
                            <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 text-center shadow">
                                <span class="font-bold text-lg text-blue-300">{{ $team->name }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-4 bg-gray-800 rounded-lg border border-gray-700">
                        Belum ada tim yang mendaftar. Jadilah yang pertama!
                    </p>
                @endif
            </div>

            <!-- Bagan / Jadwal Pertandingan -->
            <div class="mt-12 mb-8 border-t border-gray-700 pt-8">
                <h2 class="text-2xl font-bold mb-6">Jadwal & Hasil Pertandingan</h2>
                
                @if($tournament->games->count() > 0)
                    <div class="space-y-6">
                        <!-- Mengelompokkan pertandingan berdasarkan babak (round) -->
                        @foreach($tournament->games->groupBy('round') as $round => $matches)
                            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                                <h3 class="text-xl font-bold text-blue-400 mb-4 capitalize">Babak: {{ $round }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($matches as $game)
                                        <div class="bg-gray-700 p-4 rounded-lg flex flex-col justify-center shadow-md">
                                            <!-- Tim A -->
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="font-semibold {{ $game->score_a > $game->score_b ? 'text-green-400' : 'text-gray-200' }}">
                                                    {{ $game->teamA ? $game->teamA->name : 'TBD (Menunggu)' }}
                                                </span>
                                                <span class="font-bold text-lg bg-gray-900 px-3 py-1 rounded">{{ $game->score_a }}</span>
                                            </div>
                                            <!-- Tim B -->
                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold {{ $game->score_b > $game->score_a ? 'text-green-400' : 'text-gray-200' }}">
                                                    {{ $game->teamB ? $game->teamB->name : 'TBD (Menunggu)' }}
                                                </span>
                                                <span class="font-bold text-lg bg-gray-900 px-3 py-1 rounded">{{ $game->score_b }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-4 bg-gray-800 rounded-lg border border-gray-700">
                        Bagan pertandingan belum tersedia.
                    </p>
                @endif
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 pt-8 border-t border-gray-700 text-center">
                @if($tournament->status == 'registration')
                    <a href="{{ route('tournament.register', $tournament->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg w-full md:w-auto transition duration-300">
                    Daftarkan Tim Anda Sekarang
                    </a>
                @else
                    <button class="bg-gray-600 text-gray-400 font-bold py-3 px-8 rounded-lg text-lg w-full md:w-auto cursor-not-allowed" disabled>
                        Pendaftaran Ditutup
                    </button>
                @endif
            </div>
        </div>
    </main>

</body>
</html>