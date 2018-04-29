<?php

namespace App;

class Item extends Model
{
    public function loEncontro()
    {
    	return $this->hasOne(User::class);
    }

    public function retiro()
    {
    	return $this->hasOne(Retiro::class);
    }

    public function materia()
    {
    	return $this->hasOne(Materia::class);
    }

    public function tag()
    {
    	return $this->hasOne(Tag::class);
    }

    public function laboratorio()
    {
    	return $this->hasOne(Laboratorio::class);
    }
}
