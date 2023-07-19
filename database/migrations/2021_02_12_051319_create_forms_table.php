<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('rec_id')->nullable();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('sex')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook_name')->nullable();
            $table->string('youtube_name')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('forms');
    }
}
