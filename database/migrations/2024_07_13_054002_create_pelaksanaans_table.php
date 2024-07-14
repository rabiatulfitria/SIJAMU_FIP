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
        Schema::create('pelaksanaans', function (Blueprint $table) {
            $table->integer('id_pelaksanaan',false, true)->length(11)->autoIncrement();
            $table->string('level_pelaksanaan', 20);
            $table->string('namaDokumen_pelaksanaan', 1000);
            $table->string('unggahDokumen_pelaksanaan', 1000);
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
        Schema::dropIfExists('pelaksanaans');
    }
};
