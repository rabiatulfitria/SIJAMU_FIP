<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropJamutimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('jamutims');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('jamutims', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nip');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('PJ');
            $table->timestamps();
        });
    }
}