<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_last_name', 100);
            $table->string('phone', 15);
            $table->string('email', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
};
