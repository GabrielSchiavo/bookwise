<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books_loans', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
        });
    }

    public function down()
    {
        //
    }
};