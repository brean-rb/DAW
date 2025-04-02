<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frutas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio',5,2);
            $table->unsignedBigInteger("temporada_id")->nullable();
            $table->unsignedBigInteger("origen_id")->nullable();


            $table->foreign('temporada_id')->references('id')->on('temporadas');
            $table->foreign('origen_id')->references('id')->on('origenes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frutas');
    }
};
