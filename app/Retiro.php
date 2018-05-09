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
    	return $this->belongsTo(User::class);
    }

    public function laboratorio()
    {
    	return $this->belongsTo(Laboratorio::class);
    }
}
