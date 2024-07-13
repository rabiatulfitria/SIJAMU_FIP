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
        Schema::create('pengendalians', function (Blueprint $table) {
            $table->integer('id_pengendalian',false, true)->length(11)->autoIncrement();
            $table->string('namaDokumen_pengendalian', 255);
            $table->string('unggahDokumen_pengendalian', 255);
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
        Schema::dropIfExists('pengendalians');
    }
};
