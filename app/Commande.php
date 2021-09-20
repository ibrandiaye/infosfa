<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['nbfacom','adresse','mois','annee','distributeur_id','departement_id'];

    public function distributeur(){
        return $this->belongsTo(Distributeur::class);
    }
    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
