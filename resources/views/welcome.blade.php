<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Turnamen Esports</title>
    <!-- Memanggil Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
    
    <!-- Navbar Sederhana -->
    <nav class="p-6 flex justify-between items-center border-b border-gray-800">
        <div class="text-2xl font-black text-blue-500 uppercase tracking-wider">
            Esports<span class="text-white">Arena</span>
        </div>
        <div>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white mr-4">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white mr-4">Log in</a>
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg font-bold">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Daftar Turnamen -->
    <main class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-center mb-10">Turnamen Aktif</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($tournaments as $tournament)
                <!-- Kartu Turnamen -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700 hover:border-blue-500 transition duration-300">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-1">{{ $tournament->name }}</h2>
                        <p class="text-blue-400 font-semibold mb-4">{{ $tournament->game_title }}</p>
                        
                        <div class="flex justify-between items-center mb-4 text-sm text-gray-400">
                            <span>Slot: {{ $tournament->max_teams }} Tim</span>
                            <span>Mulai: {{ \Carbon\Carbon::parse($tournament->start_date)->format('d M Y') }}</span>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-700 flex justify-between items-center">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $tournament->status == 'registration' ? 'bg-green-600/20 text-green-400' : 'bg-yellow-600/20 text-yellow-400' }}">
                                {{ strtoupper($tournament->status) }}
                            </span>
                           <a href="{{ route('tournament.show', $tournament->id) }}" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded font-semibold transition text-sm">
                            Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-10">
                    Belum ada turnamen yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>