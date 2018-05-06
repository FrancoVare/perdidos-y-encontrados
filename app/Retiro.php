<?php

namespace App;

class Retiro extends Model
{
    public function item()
    {
    	return $this->belongsTo(Item::class);
    }

    public function user()
    {
    	return $this->hasOne(User::class);
    }

    public function laboratorio()
    {
    	return $this->hasOne(Laboratorio::class);
    }
}
