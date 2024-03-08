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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('mat')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naiss')->nullable();
            $table->date('date_recrutement')->nullable();
            $table->string('fonction');
            $table->string('situation_fam')->nullable();
            $table->integer('nbr_enfants')->nullable();
            $table->string('secteur')->nullable();
            $table->string('grade')->nullable();
            $table->string('echelle')->nullable();
            $table->string('statue')->nullable();
            $table->year('annee_report')->nullable();
            $table->integer('solde_report')->nullable();
            $table->string('psw_cnx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
