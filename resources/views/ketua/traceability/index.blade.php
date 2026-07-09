<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-[#26201B] leading-tight font-heading tracking-tight">
            {{ __('Lacak Investigasi Batch') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F6F1E6] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Pilih Batch Baglog untuk melacak seluruh riwayatnya dari hulu ke hilir:</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($baglogs as $baglog)
                        <a href="{{ route('ketua.traceability.detail', $baglog->id) }}" class="block p-4 border rounded-xl hover:bg-gray-50 transition">
                            <h4 class="font-bold">Batch #{{ $baglog->kode_batch }}</h4>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($baglog->tanggal_pembuatan)->format('d M Y') }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
