<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('loan_date');
            $table->date('return_date');
            $table->unsignedBigInteger('person_id');
            $table->string('person', 250);
            $table->unsignedBigInteger('book_id');
            $table->string('book', 250);
            $table->enum('status', ['RETIRADO', 'RENOVADO', 'DISPONIVEL', 'ATRASADO']);
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};