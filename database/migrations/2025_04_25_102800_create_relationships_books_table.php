<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('literary_gender_id')->references('id')->on('literary_genres')->onDelete('set null');
        });

    }

    public function down()
    {
        //
    }
};