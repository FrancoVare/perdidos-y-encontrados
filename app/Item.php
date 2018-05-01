<?php

namespace App;

class Item extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function retiro()
    {
    	return $this->hasOne(Retiro::class);
    }

    public function materia()
    {
    	return $this->belongsTo(Materia::class);
    }

    public function tag()
    {
    	return $this->belongsTo(Tag::class);
    }

    public function laboratorio()
    {
    	return $this->belongsTo(Laboratorio::class);
    }
}
