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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('statue')->default('en attendant');
            $table->string('mat_emp');
            $table->foreignId('id_type')->constrained('type_conges', 'id_type')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mat_emp')->references('mat')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
