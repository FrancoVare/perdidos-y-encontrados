<?php

namespace App;

class Tag extends Model
{

	protected $casts = [

		'pruebasMinimas' => 'array'

	];

    public function items()
    {
    	return $this->hasMany(Item::class);
    }

    public function getPruebasAttribute()
    {
	  return json_decode($this->attributes['pruebas']);
	}

	public function setPruebasAttribute(Array $val) 
	{
	  $this->attributes['pruebas'] = json_encode($val);
	}
}
