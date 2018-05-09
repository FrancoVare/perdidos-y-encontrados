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

    public function scopeEstado($query,$estado)
    {
        if($estado == 'Perdidos'){
            return $query->has('retiro','<',1);
        } else {
            return $query->has('retiro');
        }
        
    }

    public function scopeTag($query,$tag)
    {
        if($tag == 'Todos'){
            return $query;
        } else {
            return $query->where('tag_id','=',Tag::where('nombre','=',$tag)->first()->id);
        }
    }
}
