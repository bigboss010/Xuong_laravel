<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('binh_luans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tai_khoan_id');
            $table->unsignedBigInteger('pet_id');
            $table->text('noi_dung');
            $table->timestamp('thoi_gian')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('trang_thai');
            $table->timestamps();

            $table->foreign('tai_khoan_id')->references('id')->on('tai_khoans')->onDelete('cascade');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luans');
    }
};
