<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributeur extends Model
{
    protected $fillable = ['nomcomplet','stock','contact','observation','departement_id','commande',
'latitude','longitude'];
    public function departement(){
        return $this->belongsTo(Departement::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }
    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
