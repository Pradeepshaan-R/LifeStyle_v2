<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_extras', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['Mr', 'Ms', 'Mrs', 'Dr', 'Rev'])->default('Mr');
            $table->string('phone', 15)->nullable();
            $table->string('nic', 15)->nullable();
            $table->string('designation', 20)->nullable();
            $table->string('address', 120)->nullable();
            $table->string('city', 30)->nullable();
            $table->integer('theme')->default(1); //custom theme
            $table->text('settings')->nullable(); //json data for user settings
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //main user record
            //$table->foreignId('tenant_id')->default(1)->constrained()->onDelete('cascade'); //for multi tenant
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_extras');
    }
}