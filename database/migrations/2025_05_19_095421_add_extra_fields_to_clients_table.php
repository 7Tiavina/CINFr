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
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('pere_inconnu')->default(false)->after('prenom_pere');
            $table->boolean('mere_inconnue')->default(false)->after('pere_inconnu');

            $table->string('adresse_complement')->nullable()->after('code_postal');

            $table->date('pere_naissance_date')->nullable()->after('prenom_mere');
            $table->string('pere_naissance_ville')->nullable()->after('pere_naissance_date');
            $table->string('pere_nationalite')->nullable()->after('pere_naissance_ville');

            $table->date('mere_naissance_date')->nullable()->after('pere_nationalite');
            $table->string('mere_naissance_ville')->nullable()->after('mere_naissance_date');
            $table->string('mere_nationalite')->nullable()->after('mere_naissance_ville');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'pere_inconnu','mere_inconnue',
                'adresse_complement',
                'pere_naissance_date','pere_naissance_ville','pere_nationalite',
                'mere_naissance_date','mere_naissance_ville','mere_nationalite',
            ]);
        });
    }

};
