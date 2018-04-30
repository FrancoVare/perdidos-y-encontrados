<?php

namespace App;

class Prueba extends Model
{
    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
}
