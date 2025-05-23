<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'stripe_session_id',
        'type',
        'raison',
        'departement',
        'sexe',
        'nom_naissance',
        'deuxieme_nom',
        'prenom1',
        'prenom2',
        'prenom3',
        'taille',
        'couleur_yeux',
        'date_naissance',
        'pays_naissance',
        'departement_naissance',
        'commune_naissance',
        'adresse',
        'code_postal',
        'ville',
        'pays',
        'situation_familiale',
        'nom_naissance_mere',
        'prenom_mere',
        'nom_naissance_pere',
        'prenom_pere',
        'nationalite',
        'telephone',
        'email',                
        'a_carte_identite',
        'numero_cni',
        'date_delivrance_cni',
        'lieu_delivrance_cni',
        'photo_identite',
        'justificatif_domicile',
        'acte_naissance',
        'autre_document',
        // …
        'pere_inconnu',
        'mere_inconnue',
        'adresse_complement',
        'nationalite',
        'pere_naissance_date',
        'pere_naissance_ville',
        'pere_nationalite',
        'mere_naissance_date',
        'mere_naissance_ville',
        'mere_nationalite',
        // …
        'motif_nationalite',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
