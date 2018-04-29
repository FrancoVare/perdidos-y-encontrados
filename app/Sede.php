<?php

namespace App;

class Sede extends Model
{
    public function laboratorios()
    {
    	return $this->hasMany(Laboratorio::class);
    }
}
