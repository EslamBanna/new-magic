<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCunsultantTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cunsultant_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->integer('user_id');
            $table->integer('consult_id');
            $table->integer('age');
            // $table->string('consult_price');
            $table->string('phone');
            $table->string('job');
            $table->string('social_status');
            $table->string('apperance');
            $table->string('feel');
            $table->string('interest');
            $table->string('budget');
            $table->string('amount');
            $table->string('brand');
            $table->string('formats');
            $table->longText('want');
            // $table->longText('what_want');
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
        Schema::dropIfExists('cunsultant_tests');
    }
}
