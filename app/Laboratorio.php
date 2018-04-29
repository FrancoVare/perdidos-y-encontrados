<?php

namespace App;

class Laboratorio extends Model
{
    public function items()
    {
    	return $this->hasMany(Item::class);
    }

    public function sede()
    {
    	return $this->belongsTo(Sede::class);
    }

    public function retiros()
    {
    	return $this->hasMany(Retiro::class);
    }
}
