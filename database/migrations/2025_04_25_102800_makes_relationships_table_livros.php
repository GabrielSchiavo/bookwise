<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('livros', function (Blueprint $table) {
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('set null');
        });

    }

    public function down()
    {
        //
    }
};