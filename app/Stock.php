<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['stock','distributeur_id'];

    public function distributeur(){
        return $this->belongsTo(Distributeur::class);
    }
}
