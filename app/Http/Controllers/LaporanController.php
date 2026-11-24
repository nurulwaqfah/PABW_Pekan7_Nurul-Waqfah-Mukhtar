<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    // Menampilkan seluruh laporan
    public function index()
    {
        $laporans = Laporan::latest()->paginate(6);

        return view('laporan.index', compact('laporans'));
    }

    // Menampilkan form laporan masyarakat
    public function create()
    {
        return view('laporan.create');
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'lokasi' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tinggi_air' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['foto'] = $request->file('foto')
            ->store('foto-laporan', 'public');

        $validated['status'] = 'Menunggu';

        Laporan::create($validated);

        return redirect()
            ->route('laporan.create')
            ->with('success', 'Laporan banjir berhasil dikirim!');
    }

    // Menampilkan detail laporan
    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    // Menampilkan form edit
    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    // Memperbarui laporan
    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'lokasi' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tinggi_air' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Menunggu,Diproses,Selesai',
        ]);

        if ($request->hasFile('foto')) {
            $fotoBaru = $request->file('foto')
                ->store('foto-laporan', 'public');

            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }

            $validated['foto'] = $fotoBaru;
        }

        $laporan->update($validated);

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    // Menghapus laporan
    public function destroy(Laporan $laporan)
    {
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}