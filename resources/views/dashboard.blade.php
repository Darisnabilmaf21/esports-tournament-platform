<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Manajemen Tim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form Buat Tim -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Buat Tim Baru</h3>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('teams.store') }}" method="POST" class="flex flex-col md:flex-row gap-4 items-start">
                    @csrf
                    <div class="w-full md:w-1/2">
                        <input type="text" name="name" placeholder="Masukkan nama tim (Misal: RRQ Hoshi)" required 
                               class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow transition">
                        Simpan Tim
                    </button>
                </form>
            </div>

            <!-- Daftar Tim -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Tim Saya</h3>
                
                @if($teams->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($teams as $team)
                            <div class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                                <span class="font-bold text-gray-800">{{ $team->name }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Anda belum memiliki tim. Buat tim pertama Anda pada form di atas.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>