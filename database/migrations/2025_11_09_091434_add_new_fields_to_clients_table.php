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
            $columnsToDrop = [];
            
            if (Schema::hasColumn('clients', 'deuxieme_nom_origine')) {
                $columnsToDrop[] = 'deuxieme_nom_origine';
            }
            if (Schema::hasColumn('clients', 'mot_devant')) {
                $columnsToDrop[] = 'mot_devant';
            }
            if (Schema::hasColumn('clients', 'mot_a_afficher')) {
                $columnsToDrop[] = 'mot_a_afficher';
            }
            if (Schema::hasColumn('clients', 'pere_prenom3')) {
                $columnsToDrop[] = 'pere_prenom3';
            }
            if (Schema::hasColumn('clients', 'mere_prenom3')) {
                $columnsToDrop[] = 'mere_prenom3';
            }
            if (Schema::hasColumn('clients', 'pere_pays_naissance')) {
                $columnsToDrop[] = 'pere_pays_naissance';
            }
            if (Schema::hasColumn('clients', 'mere_pays_naissance')) {
                $columnsToDrop[] = 'mere_pays_naissance';
            }
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
