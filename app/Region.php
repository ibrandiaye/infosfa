<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['nom','latitude','longitude'];

        public function departements(){
            return $this->hasMany(Departement::class);
        }
        public function users(){
            return $this->hasMany(Region::class);
        }
}
