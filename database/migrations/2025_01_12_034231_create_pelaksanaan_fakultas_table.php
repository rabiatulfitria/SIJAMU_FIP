<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksanaan_fakultas', function (Blueprint $table) {
            $table->id('id_plks_fklts');
            $table->foreignId('periode_tahunakademik')->references('id_plks')->on('pelaksanaans')->onDelete('restrict');
            $table->string('namafile');
            $table->foreignId('nama_kategori')->references('id_kategori')->on('kategori')->onDelete('restrict');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelaksanaan_fakultas');
    }
};
