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
        Schema::create('penetapans', function (Blueprint $table) {
            $table->integer('id_penetapan',false, true)->length(11)->autoIncrement();
            $table->string('level_penetapan', 20);
            $table->string('namaDokumen_penetapan', 255);
            $table->string('unggahDokumen_penetapan', 255);
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
        Schema::dropIfExists('penetapans');
    }
};
