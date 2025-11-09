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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('deuxieme_nom_origine')->nullable();
            $table->string('mot_devant')->nullable();
            $table->string('mot_a_afficher')->nullable();
            $table->string('pere_prenom3')->nullable();
            $table->string('mere_prenom3')->nullable();
            $table->string('pere_pays_naissance')->nullable();
            $table->string('mere_pays_naissance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'deuxieme_nom_origine',
                'mot_devant',
                'mot_a_afficher',
                'pere_prenom3',
                'mere_prenom3',
                'pere_pays_naissance',
                'mere_pays_naissance'
            ]);
        });
    }
};
