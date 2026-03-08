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
        'deuxieme_nom_origine',
        'mot_devant',
        'mot_a_afficher',
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
        'adresse_complement',
        'code_postal',
        'ville',
        'pays',
        'situation_familiale',
        'nom_naissance_mere',
        'prenom_mere',
        'mere_prenom2',
        'mere_prenom3',
        'nom_naissance_pere',
        'prenom_pere',
        'pere_prenom2',
        'pere_prenom3',
        'nationalite',
        'motif_nationalite',
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
        'pere_inconnu',
        'mere_inconnue',
        'pere_naissance_date',
        'pere_naissance_ville',
        'pere_nationalite',
        'pere_pays_naissance',
        'mere_naissance_date',
        'mere_naissance_ville',
        'mere_nationalite',
        'mere_pays_naissance',
    ];

    protected $casts = [
        'a_carte_identite' => 'boolean',
        'pere_inconnu' => 'boolean',
        'mere_inconnue' => 'boolean',
        'date_naissance' => 'date',
        'date_delivrance_cni' => 'date',
        'pere_naissance_date' => 'date',
        'mere_naissance_date' => 'date',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
