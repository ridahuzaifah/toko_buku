
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('buku_id')
                ->nullable()
                ->constrained('bukus')
                ->cascadeOnDelete();

            $table->unsignedInteger('jumlah')->default(1);

            $table->unique(['user_id', 'buku_id']);
        });
    }

    public function down(): void
    {
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'buku_id']);
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('buku_id');
            $table->dropColumn('jumlah');
        });
    }
};
