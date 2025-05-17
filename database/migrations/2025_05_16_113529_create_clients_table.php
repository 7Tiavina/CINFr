<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_session_id')->unique()->nullable();
            $table->string('type')->nullable();                      // majeur / mineur
            $table->string('raison')->nullable();                    // première / renouvellement
            $table->string('departement')->nullable();               // ex “02”
            $table->string('sexe')->nullable();                      // homme / femme
            $table->string('nom_naissance')->nullable();
            $table->string('deuxieme_nom')->nullable();
            $table->string('prenom1')->nullable();
            $table->string('prenom2')->nullable();
            $table->string('prenom3')->nullable();
            $table->decimal('taille', 4, 2)->nullable();             // ex 1.75
            $table->string('couleur_yeux')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('pays_naissance')->nullable();
            $table->string('departement_naissance')->nullable();
            $table->string('commune_naissance')->nullable();
            $table->string('adresse')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('situation_familiale')->nullable();       // célibataire, marié, etc.
            $table->string('nom_naissance_mere')->nullable();
            $table->string('prenom_mere')->nullable();
            $table->string('nom_naissance_pere')->nullable();
            $table->string('prenom_pere')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('a_carte_identite')->default(false);
            $table->string('numero_cni')->nullable();
            $table->date('date_delivrance_cni')->nullable();
            $table->string('lieu_delivrance_cni')->nullable();
            $table->string('photo_identite')->nullable();            // chemin du fichier
            $table->string('justificatif_domicile')->nullable();     // chemin du fichier
            $table->string('acte_naissance')->nullable();            // chemin du fichier
            $table->string('autre_document')->nullable();            // chemin du fichier
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
