<?php

namespace App;

class Tag extends Model
{

	// protected $casts = [

	// 	'pruebasMinimas' => 'array'

	// ];

    public function items()
    {
    	return $this->hasMany(Item::class);
    }

    public function pruebas()
    {
    	return $this->belongsToMany(Prueba::class);
    }

    public function getRouteKeyName()
    {
        return 'nombre';
    }
}
