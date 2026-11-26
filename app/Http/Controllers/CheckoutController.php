<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Buku;
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
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
    {
        $userId = Auth::id();

        $keranjangs = Keranjang::with('buku')
            ->where('user_id', $userId)
            ->get();

        if ($keranjangs->isEmpty()) {
            return redirect()
                ->route('keranjang.index')
                ->with('error', 'Keranjang masih kosong!');
        }

        // Memastikan semua buku masih tersedia.
        foreach ($keranjangs as $item) {
            if (!$item->buku) {
                return redirect()
                    ->route('keranjang.index')
                    ->with('error', 'Terdapat buku yang sudah tidak tersedia.');
            }
        }

        $alamats = Alamat::where('user_id', $userId)->get();

        $total = $keranjangs->sum(function ($item) {
            return $item->jumlah * $item->buku->harga_jual;
        });

        return view('checkout.index', compact(
            'keranjangs',
            'alamats',
            'total'
        ));
    }

    /**
     * Memproses checkout dan membuat pesanan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat_id' => 'nullable|integer',

            'nama_penerima' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',

            'catatan' => 'nullable|string',
        ]);

        $pesanan = DB::transaction(function () use ($validated) {

            $userId = Auth::id();

            /*
             * 1. Mengambil alamat milik pengguna
             * atau membuat alamat baru.
             */
            if (!empty($validated['alamat_id'])) {

                $alamat = Alamat::where('id', $validated['alamat_id'])
                    ->where('user_id', $userId)
                    ->first();

                if (!$alamat) {
                    throw ValidationException::withMessages([
                        'alamat_id' => 'Alamat tidak ditemukan atau bukan milik Anda.',
                    ]);
                }

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

            /*
             * 2. Mengambil ulang keranjang pengguna.
             */
            $keranjangs = Keranjang::where('user_id', $userId)
                ->get();

            if ($keranjangs->isEmpty()) {
                throw ValidationException::withMessages([
                    'checkout' => 'Keranjang kosong. Silakan tambahkan buku terlebih dahulu.',
                ]);
            }

            $detailPesanan = [];
            $totalHarga = 0;

            /*
             * 3. Memeriksa stok dan mengunci data buku.
             */
            foreach ($keranjangs as $item) {

                $buku = Buku::where('id', $item->buku_id)
                    ->lockForUpdate()
                    ->first();

                if (!$buku) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Buku tidak ditemukan atau sudah tidak tersedia.',
                    ]);
                }

                if ($item->jumlah <= 0) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Jumlah buku tidak valid.',
                    ]);
                }

                if ($buku->stok < $item->jumlah) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Stok buku "' . $buku->judul_buku .
                            '" tidak mencukupi. Stok tersedia: ' . $buku->stok,
                    ]);
                }

                /*
                 * 4. Menghitung harga dan subtotal.
                 */
                $harga = $buku->harga_jual;
                $subtotal = $harga * $item->jumlah;

                $totalHarga += $subtotal;

                /*
                 * 5. Menyiapkan snapshot informasi buku.
                 */
                $detailPesanan[] = [
                    'buku' => $buku,
                    'jumlah' => $item->jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                    'kode_buku' => $buku->kode_buku,
                    'judul_buku' => $buku->judul_buku,
                    'pengarang' => $buku->pengarang,
                    'penerbit' => $buku->penerbit,
                ];
            }

            /*
             * 6. Membuat data pesanan.
             */
            $pesanan = Pesanan::create([
                'kode_pesanan' => 'ORD-' .
                    now()->format('YmdHis') .
                    '-' . strtoupper(Str::random(4)),

                'user_id' => $userId,
                'alamat_id' => $alamat->id,
                'tanggal_pesanan' => now(),
                'total_harga' => $totalHarga,
                'status' => 'menunggu',
                'catatan' => $validated['catatan'] ?? null,
            ]);

            /*
             * 7. Menyimpan detail pesanan
             * dan snapshot buku.
             */
            foreach ($detailPesanan as $detail) {

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'buku_id' => $detail['buku']->id,

                    'kode_buku' => $detail['kode_buku'],
                    'judul_buku' => $detail['judul_buku'],
                    'pengarang' => $detail['pengarang'],
                    'penerbit' => $detail['penerbit'],

                    'jumlah' => $detail['jumlah'],
                    'harga' => $detail['harga'],
                    'subtotal' => $detail['subtotal'],
                ]);

                /*
                 * 8. Mengurangi stok buku.
                 */
                $buku = $detail['buku'];

                $buku->stok -= $detail['jumlah'];
                $buku->save();
            }

            /*
             * 9. Mengosongkan keranjang pengguna.
             */
            Keranjang::where('user_id', $userId)->delete();

            return $pesanan;
        });

        /*
         * 10. Mengarahkan pengguna ke detail pesanan.
         */
        return redirect()
            ->route('pesanan.show', $pesanan->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Menampilkan detail pesanan milik pengguna.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with([
            'alamat',
            'detailPesanans.buku',
        ])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }
}
