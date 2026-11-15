
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->foreignId('pesanan_id')
                ->constrained('pesanans')
                ->cascadeOnDelete();

            $table->foreignId('buku_id')
                ->constrained('bukus')
                ->cascadeOnDelete();

            $table->unsignedInteger('jumlah');
            $table->decimal('harga', 12, 2);
            $table->decimal('subtotal', 12, 2);
        });
    }

    public function down(): void
    {
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->dropForeign(['buku_id']);

            $table->dropColumn([
                'pesanan_id',
                'buku_id',
                'jumlah',
                'harga',
                'subtotal',
            ]);
        });
    }
};
