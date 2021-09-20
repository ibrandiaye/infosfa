<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['nomd','latituded','longituded','region_id'];

    public function Region(){
        return $this->belongsTo(Region::class);
    }
    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
