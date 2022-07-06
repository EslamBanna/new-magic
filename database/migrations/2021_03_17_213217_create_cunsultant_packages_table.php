<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCunsultantPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cunsultant_packages', function (Blueprint $table) {
            $table->id();
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->float('price')->nullable();
            $table->string('consultation_type_en');
            $table->string('consultation_type_ar');
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
        Schema::dropIfExists('cunsultatnt_packages');
    }
}
