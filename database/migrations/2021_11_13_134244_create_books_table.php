<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->default(0); //no of copies avalable
            $table->enum('status', ['Available', 'Lended', 'Damaged'])->default('Available');
            $table->string('isbn', 30)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('photo', 60)->nullable(); //cover photo filename
            $table->foreignId('author_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //who added this record
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
        Schema::dropIfExists('books');
    }
}
