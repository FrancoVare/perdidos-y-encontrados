<?php

namespace App;
use Carbon\Carbon;

class Item extends Model
{

    protected $appends = ['busqueda'];

    public function getBusquedaAttribute()
    {
    
        $terms = [];

        //dia
        $terms[] = $this->created_at->formatLocalized('%A');

        //mes
        $terms[] = $this->created_at->formatLocalized('%B');

        //año
        $terms[] = $this->created_at->year;

        //dia de mes
        $terms[] = $this->created_at->formatLocalized('%d de %B');

        //tag
        $terms[] = $this->tag->nombre;

        //laboratorio
        $terms[] = $this->laboratorio->nombre;

        //sede
        $terms[] = $this->laboratorio->sede->nombre;

        //materia
        $terms[] = $this->materia->nombre;

        return $terms;
    }

    public function filtrar($searchQuery)
    {
        $dateFormats = [
                        'd/m/y',
                        'd-m-y',
                        'd/m/Y',
                        'd-m-Y',
                        'd-m',
                        'd/m',
                        ];
        
        $date = null;
        foreach ($dateFormats as $dateFormat) {
            try {
                $date = Carbon::createFromFormat($dateFormat,$date);
                break;
            } catch (\InvalidArgumentException $e){}
        }
    
        //aca ya tengo la fecha en $date, compararla con created_at
        //si es null comparar $searchQuery con los $item->busqueda

        return true;
    }

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
