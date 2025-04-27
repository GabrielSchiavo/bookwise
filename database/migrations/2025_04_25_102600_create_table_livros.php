<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imgCapa', 260)->nullable();
            $table->string('titulo', 250);
            $table->string('autor', 250);
            $table->unsignedBigInteger('genero_id');
            $table->string('genero', 250);
            $table->string('editora', 250);
            $table->integer('ano');
            $table->string('isbn',  17)->nullable();
            $table->integer('status');
            $table->timestamps();
        });

    }

    public function down()
    {
        //
    }
};