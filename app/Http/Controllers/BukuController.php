<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $bukus = Buku::latest()->get();

        return view('buku.index', compact('bukus'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $kodeBuku = $this->generateKodeBuku();

        return view('buku.create', compact('kodeBuku'));
    }

    // Menyimpan data buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:2100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $validated['kode_buku'] = $this->generateKodeBuku();

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan!');
    }

    // Menampilkan detail buku
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    // Menampilkan form edit buku
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    // Memperbarui data buku
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:2100',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    // Menampilkan daftar buku yang sudah dihapus
    public function trashed()
    {
        $bukus = Buku::onlyTrashed()
            ->latest('deleted_at')
            ->get();

    return view('buku.trashed', compact('bukus'));
    }
    // Memulihkan buku yang sudah dihapus
    public function restore($id)
    {
        $buku = Buku::withTrashed()->findOrFail($id);

        $buku->restore();

         return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dipulihkan!');
    }
    // Menghapus data buku
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    // Membuat kode buku otomatis
    private function generateKodeBuku()
    {
        $bukuTerakhir = Buku::withTrashed()
            ->orderBy('id', 'desc')
            ->first();

        if (!$bukuTerakhir) {
            return 'BK0001';
        }

        $nomorTerakhir = (int) substr(
            $bukuTerakhir->kode_buku,
            2
        );

        $nomorBaru = $nomorTerakhir + 1;

        return 'BK' . str_pad(
            $nomorBaru,
            4,
            '0',
            STR_PAD_LEFT
        );
    }
}
