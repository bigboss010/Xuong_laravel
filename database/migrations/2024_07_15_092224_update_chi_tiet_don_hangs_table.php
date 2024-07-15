<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            // $table->integer('so_luong')->after('pet_id');
            $table->double('gia', 10,2)->after('pet_id');
            $table->double('thanh_tien', 10,2)->after('pet_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            // $table -> dropColumn('so_luong');
            $table -> dropColumn('gia');
            $table -> dropColumn('thanh_tien');
        });
    }
};