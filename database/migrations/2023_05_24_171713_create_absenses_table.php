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
        Schema::create('absenses', function (Blueprint $table) {
            $table->id('idAbs');
            $table->string('raisons');
            $table->date('dateDebeut');
            $table->date('dateFin');
            $table->integer('dureeJours');
            $table->string('Jusifications')->nullable();
            $table->string('mat_emp');
            $table->foreign('mat_emp')->references('mat')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absenses');
    }
};
