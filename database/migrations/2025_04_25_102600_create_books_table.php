<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cover_image', 260)->nullable();
            $table->string('title', 250);
            $table->string('series', 250)->nullable();
            $table->string('volume', 250)->nullable();
            $table->string('author', 250);
            $table->unsignedBigInteger('literary_gender_id');
            $table->string('literary_gender', 250);
            $table->string('publisher', 250);
            $table->integer('year');
            $table->string('isbn',  17)->nullable();
            $table->enum('status', ['RETIRADO', 'RENOVADO', 'DISPONIVEL', 'ATRASADO']);
            $table->timestamps();
        });

    }
    
    public function down()
    {
        //
    }
};