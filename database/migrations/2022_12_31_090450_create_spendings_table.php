<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->dateTime('date');
            $table->string("name");
            $table->string('image')->default("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWTqw904jpS-ZP6ID9-Z9jSH9vQg6IdIarlQ&usqp=CAU");
            $table->string("kind");
            $table->integer("cost")->unsigned();
            $table->string("info")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spendings');
    }
};
