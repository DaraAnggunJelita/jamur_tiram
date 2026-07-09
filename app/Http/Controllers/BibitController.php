<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibitController extends Controller
{
    public function index()
    {
        $bibits = Bibit::with('user')->orderBy('tanggal_masuk', 'desc')->get();
        return view('bibit.index', compact('bibits'));
    }

    public function create()
    {
        return view('bibit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bibit' => 'required|string|unique:bibits,kode_bibit|max:50',
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        Bibit::create([
            'user_id' => Auth::id(),
            'kode_bibit' => $request->kode_bibit,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'status' => 'tersedia',
        ]);

        return redirect()->route('bibit.index')->with('success', 'Data bibit berhasil ditambahkan.');
    }
}
