<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitTable extends Migration
{

    public function up()
    {
        Schema::create('kit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 100);
            $table->string('descricao', 100)->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('kit');
    }
}
