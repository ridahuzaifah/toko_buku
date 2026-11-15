
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('kode_pesanan')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('alamat_id')
                ->nullable()
                ->constrained('alamats')
                ->nullOnDelete();

            $table->dateTime('tanggal_pesanan');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->string('status')->default('menunggu');
            $table->text('catatan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['alamat_id']);

            $table->dropColumn([
                'kode_pesanan',
                'user_id',
                'alamat_id',
                'tanggal_pesanan',
                'total_harga',
                'status',
                'catatan',
            ]);
        });
    }
};
