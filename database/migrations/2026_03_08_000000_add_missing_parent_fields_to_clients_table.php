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
            // Ajouter pere_prenom1 et mere_prenom1 s'ils n'existent pas déjà (champs manquants)
            if (!Schema::hasColumn('clients', 'pere_prenom1')) {
                $table->string('pere_prenom1')->nullable()->after('nom_naissance_pere');
            }
            if (!Schema::hasColumn('clients', 'mere_prenom1')) {
                $table->string('mere_prenom1')->nullable()->after('nom_naissance_mere');
            }
            // Ajouter pere_prenom2 et mere_prenom2 s'ils n'existent pas déjà
            if (!Schema::hasColumn('clients', 'pere_prenom2')) {
                $table->string('pere_prenom2')->nullable()->after('pere_prenom1');
            }
            if (!Schema::hasColumn('clients', 'mere_prenom2')) {
                $table->string('mere_prenom2')->nullable()->after('mere_prenom1');
            }
            // Ajouter pere_pays_naissance et mere_pays_naissance s'ils n'existent pas déjà
            if (!Schema::hasColumn('clients', 'pere_pays_naissance')) {
                $table->string('pere_pays_naissance')->nullable()->after('pere_nationalite');
            }
            if (!Schema::hasColumn('clients', 'mere_pays_naissance')) {
                $table->string('mere_pays_naissance')->nullable()->after('mere_nationalite');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'pere_prenom1',
                'mere_prenom1',
                'pere_prenom2',
                'mere_prenom2',
                'pere_pays_naissance',
                'mere_pays_naissance'
            ]);
        });
    }
};
