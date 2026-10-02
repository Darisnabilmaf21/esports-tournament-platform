<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Turnamen - {{ $tournament->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased flex items-center justify-center min-h-screen">
    
    <div class="bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Pendaftaran Turnamen</h2>
        <p class="text-gray-400 text-center mb-6">Pilih tim yang akan bertanding di <strong class="text-white">{{ $tournament->name }}</strong></p>

        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-400 p-3 rounded mb-4 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('tournament.store', $tournament->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="team_id" class="block text-sm font-medium text-gray-400 mb-2">Pilih Tim Anda</label>
                <select name="team_id" id="team_id" required class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:border-blue-500">
                    <option value="" disabled selected>-- Pilih Tim --</option>
                    @forelse($userTeams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @empty
                        <option value="" disabled>Anda belum memiliki tim.</option>
                    @endforelse
                </select>
            </div>
            
            <div class="flex justify-between items-center mt-8">
                <a href="{{ route('tournament.show', $tournament->id) }}" class="text-gray-400 hover:text-white transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Konfirmasi Pendaftaran</button>
            </div>
        </form>
    </div>

</body>
</html>