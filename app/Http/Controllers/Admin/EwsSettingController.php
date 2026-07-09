<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EwsSetting;
use Illuminate\Http\Request;

class EwsSettingController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika kosong maka buat data default
        $settings = EwsSetting::firstOrCreate([], [
            'min_durasi_sterilisasi' => 7,
            'maks_hari_panen' => 4,
            'kondisi_udara_kritis' => 'Panas/Gersang',
        ]);

        return view('admin.ews.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_durasi_sterilisasi' => 'required|integer|min:1',
            'maks_hari_panen' => 'required|integer|min:1',
            'kondisi_udara_kritis' => 'required|string',
        ]);

        $settings = EwsSetting::first();
        if (!$settings) {
            $settings = new EwsSetting();
        }

        $settings->min_durasi_sterilisasi = $request->min_durasi_sterilisasi;
        $settings->maks_hari_panen = $request->maks_hari_panen;
        $settings->kondisi_udara_kritis = $request->kondisi_udara_kritis;
        $settings->save();

        return redirect()->route('admin.ews.settings')->with('success', 'Pengaturan Batas EWS berhasil diperbarui.');
    }
}
