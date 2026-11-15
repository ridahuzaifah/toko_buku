
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Models\Buku;
use App\Models\Pesanan;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ActivityLogController;

/*
|--------------------------------------------------------------------------
| Login dan Registrasi
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // LOGIN
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    // REGISTRASI
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Halaman Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // DASHBOARD ADMIN
    Route::get('/dashboard', function () {

        $totalBuku = Buku::count();

        $totalStok = Buku::sum('stok');

        $nilaiPersediaan = Buku::sum(
            DB::raw('harga_beli * stok')
        );

        $stokMenipis = Buku::whereBetween('stok', [1, 10])->count();

        $stokHabis = Buku::where('stok', 0)->count();

        $bukus = Buku::latest()
            ->take(5)
            ->get();

        return view('store.home', compact(
            'totalBuku',
            'totalStok',
            'nilaiPersediaan',
            'stokMenipis',
            'stokHabis',
            'bukus'
        ));

    })->name('admin.dashboard');


    // CRUD DATA BUKU
    Route::resource('buku', BukuController::class);


    // RIWAYAT AKTIVITAS
    Route::get('/riwayat-aktivitas', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');

    Route::get('/riwayat-aktivitas/{activityLog}', [ActivityLogController::class, 'show'])
        ->name('activity-logs.show');

});


/*
|--------------------------------------------------------------------------
| Halaman User
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {

    // BERANDA USER
    Route::get('/beranda', function () {

        $bukus = Buku::where('stok', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        $totalBuku = Buku::where('stok', '>', 0)->count();

        return view('user.home', compact(
            'bukus',
            'totalBuku'
        ));

    })->name('user.home');


    // KATALOG BUKU
    Route::get('/katalog', function () {

        $search = request('search');

        $bukus = Buku::query()
            ->when($search, function ($query, $search) {

                $query->where(function ($q) use ($search) {

                    $q->where('judul_buku', 'like', "%{$search}%")
                      ->orWhere('pengarang', 'like', "%{$search}%")
                      ->orWhere('penerbit', 'like', "%{$search}%")
                      ->orWhere('kode_buku', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('catalog.index', compact(
            'bukus',
            'search'
        ));

    })->name('catalog.index');


    // DETAIL BUKU
    Route::get('/katalog/{buku}', function (Buku $buku) {

        return view('catalog.show', compact('buku'));

    })->name('catalog.show');


    // KERANJANG BELANJA
    Route::get('/keranjang', [KeranjangController::class, 'index'])
        ->name('keranjang.index');

    Route::post('/keranjang/{buku}', [KeranjangController::class, 'store'])
        ->name('keranjang.store');

    Route::put('/keranjang/{keranjang}', [KeranjangController::class, 'update'])
        ->name('keranjang.update');

    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])
        ->name('keranjang.destroy');


    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');


    // DETAIL PESANAN
    Route::get('/pesanan/{id}', [CheckoutController::class, 'show'])
        ->name('pesanan.show');


    // RIWAYAT PESANAN
    Route::get('/riwayat-pesanan', function () {

        $pesanans = Pesanan::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pesanan.index', compact('pesanans'));

    })->name('pesanan.index');

});
