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
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table -> id();
            $table->string('anh_dai_dien',255);
            $table->string('ho_ten',255);
            $table->string('email',255);
            $table->integer('so_dien_thoai');
            $table->string('gioi_tinh',255);
            $table->string('dia_chi',255);
            $table->date('ngay_sinh',255);
            $table->string('mat_khau',255);
            $table->unsignedBigInteger('chuc_vu_id');
            $table->boolean('trang_thai')->default(0);

            $table->foreign('chuc_vu_id')->references('id')->on('chuc_vus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoans');
    }
};
