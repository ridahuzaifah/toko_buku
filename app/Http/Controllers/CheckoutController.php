<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $keranjangs = Keranjang::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        $alamats = Alamat::where('user_id', Auth::id())->get();

        $total = $keranjangs->sum(function ($item) {
            return $item->jumlah * $item->buku->harga_jual;
        });

        return view('checkout.index', compact(
            'keranjangs',
            'alamats',
            'total'
        ));
    }

    // Memproses checkout
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat_id' => ['nullable', 'integer'],
            'nama_penerima' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat_lengkap' => ['required', 'string'],
            'kota' => ['required', 'string', 'max:100'],
            'provinsi' => ['required', 'string', 'max:100'],
            'kode_pos' => ['required', 'string', 'max:10'],
            'catatan' => ['nullable', 'string'],
        ]);

        $userId = Auth::id();

        $pesanan = DB::transaction(function () use ($validated, $userId) {

            // Simpan alamat baru atau gunakan alamat lama
            if (!empty($validated['alamat_id'])) {
                $alamat = Alamat::where('user_id', $userId)
                    ->findOrFail($validated['alamat_id']);
            } else {
                $alamat = Alamat::create([
                    'user_id' => $userId,
                    'nama_penerima' => $validated['nama_penerima'],
                    'no_hp' => $validated['no_hp'],
                    'alamat_lengkap' => $validated['alamat_lengkap'],
                    'kota' => $validated['kota'],
                    'provinsi' => $validated['provinsi'],
                    'kode_pos' => $validated['kode_pos'],
                    'catatan' => $validated['catatan'] ?? null,
                ]);
            }

            $keranjangs = Keranjang::where('user_id', $userId)
                ->with('buku')
                ->get();

            if ($keranjangs->isEmpty()) {
                throw ValidationException::withMessages([
                    'keranjang' => 'Keranjang belanja kosong.',
                ]);
            }

            $total = 0;
            $items = [];

            foreach ($keranjangs as $item) {
                $buku = $item->buku()
                    ->lockForUpdate()
                    ->first();

                if (!$buku || $item->jumlah > $buku->stok) {
                    throw ValidationException::withMessages([
                        'stok' => 'Stok buku ' .
                            ($buku->judul_buku ?? '') .
                            ' tidak mencukupi.',
                    ]);
                }

                $subtotal = $item->jumlah * $buku->harga_jual;
                $total += $subtotal;

                $items[] = [
                    'buku' => $buku,
                    'jumlah' => $item->jumlah,
                    'harga' => $buku->harga_jual,
                    'subtotal' => $subtotal,
                ];
            }

            $pesanan = Pesanan::create([
                'kode_pesanan' => 'ORD-' .
                    now()->format('YmdHis') . '-' .
                    strtoupper(Str::random(4)),
                'user_id' => $userId,
                'alamat_id' => $alamat->id,
                'tanggal_pesanan' => now(),
                'total_harga' => $total,
                'status' => 'menunggu',
                'catatan' => $validated['catatan'] ?? null,
            ]);

            foreach ($items as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'buku_id' => $item['buku']->id,
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['subtotal'],
                ]);

                $item['buku']->decrement('stok', $item['jumlah']);
            }

            Keranjang::where('user_id', $userId)->delete();

            return $pesanan;
        });

        return redirect()->route('pesanan.show', $pesanan->id)
            ->with('success', 'Pesanan berhasil dibuat.');
    }


    // Menampilkan detail pesanan
    public function show($id)
    {
        $pesanan = Pesanan::with([
            'alamat',
            'detailPesanans.buku'
        ])
        ->where('user_id', Auth::id())
        ->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }

}
