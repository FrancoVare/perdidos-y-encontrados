<?php

namespace App;

class Materia extends Model
{
    public function items()
    {
    	return $this->hasMany(Item::class);
    }
}
