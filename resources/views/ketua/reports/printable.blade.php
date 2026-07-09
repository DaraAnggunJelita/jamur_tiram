@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold">Laporan Panen KUPS</h2>
        <div class="space-x-2">
            <button onclick="window.print()" class="px-3 py-1 bg-slate-800 text-white rounded">Print / Save PDF</button>
        </div>
    </div>

    <table class="min-w-full divide-y divide-slate-200 border">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Petugas</th>
                <th class="px-4 py-2 text-left">Jumlah (Kg)</th>
                <th class="px-4 py-2 text-left">Kondisi</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $r)
                <tr>
                    <td class="px-4 py-2">{{ optional($r->tanggal)->format('Y-m-d') ?: $r->tanggal }}</td>
                    <td class="px-4 py-2">{{ optional($r->user)->name ?: '-' }}</td>
                    <td class="px-4 py-2">{{ number_format($r->jumlah_panen,1) }}</td>
                    <td class="px-4 py-2">{{ $r->kualitas_panen }}</td>
                    <td class="px-4 py-2">{{ $r->status_validasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center">Tidak ada data laporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
