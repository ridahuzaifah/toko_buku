
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alamats', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama_penerima');
            $table->string('no_hp', 20);
            $table->text('alamat_lengkap');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos', 10);
            $table->text('catatan')->nullable();
            $table->boolean('is_default')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('alamats', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'nama_penerima',
                'no_hp',
                'alamat_lengkap',
                'kota',
                'provinsi',
                'kode_pos',
                'catatan',
                'is_default',
            ]);
        });
    }
};
