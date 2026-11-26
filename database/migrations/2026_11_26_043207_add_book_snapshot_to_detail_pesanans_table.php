
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pesanans', function (Blueprint $table) {
            // Menambahkan snapshot informasi buku
            $table->string('kode_buku')->nullable();
            $table->string('judul_buku')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('penerbit')->nullable();

            // Menghapus foreign key buku yang lama
            $table->dropForeign(['buku_id']);
        });

        Schema::table('detail_pesanans', function (Blueprint $table) {
            // Buku boleh dihapus tanpa menghapus detail transaksi
            $table->unsignedBigInteger('buku_id')
                ->nullable()
                ->change();

            $table->foreign('buku_id')
                ->references('id')
                ->on('bukus')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->dropForeign(['buku_id']);

            $table->dropColumn([
                'kode_buku',
                'judul_buku',
                'pengarang',
                'penerbit',
            ]);

            // Mengembalikan aturan foreign key sebelumnya.
            // Kolom tetap nullable agar rollback tidak gagal
            // jika sudah ada transaksi dengan buku_id NULL.
            $table->foreign('buku_id')
                ->references('id')
                ->on('bukus')
                ->cascadeOnDelete();
        });
    }
};
