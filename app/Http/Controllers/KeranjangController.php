<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        $keranjangs = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $total = $keranjangs->sum(function ($item) {
            return $item->jumlah * $item->buku->harga_jual;
        });

        return view('keranjang.index', compact(
            'keranjangs',
            'total'
        ));
    }

    // Menambahkan buku ke keranjang
    public function store(Request $request, Buku $buku)
    {
        $request->validate([
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('buku_id', $buku->id)
            ->first();

        if ($keranjang) {
            $jumlahBaru = $keranjang->jumlah + $request->jumlah;

            if ($jumlahBaru > $buku->stok) {
                return back()->with('error', 'Jumlah melebihi stok tersedia.');
            }

            $keranjang->update([
                'jumlah' => $jumlahBaru,
            ]);
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'buku_id' => $buku->id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('keranjang.index')
            ->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    // Mengubah jumlah buku
    public function update(Request $request, Keranjang $keranjang)
    {
        $request->validate([
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        if ($request->jumlah > $keranjang->buku->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $keranjang->update([
            'jumlah' => $request->jumlah,
        ]);

        return back()->with('success', 'Jumlah buku berhasil diperbarui.');
    }

    // Menghapus buku dari keranjang
    public function destroy(Keranjang $keranjang)
    {
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $keranjang->delete();

        return back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}
