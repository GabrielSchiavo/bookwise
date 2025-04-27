<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('retiradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dataRetirada');
            $table->date('dataDevolucao');
            $table->string('pessoa', 250);
            $table->unsignedBigInteger('livro_id');
            $table->string('livro', 250);
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};