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
        $terms[] = explode('-',str_slug($this->created_at->formatLocalized('%A')));

        //mes
        $terms[] = explode('-',str_slug($this->created_at->formatLocalized('%B')));

        //año
        $terms[] = explode('-',str_slug($this->created_at->year));

        //tag
        $terms[] = explode('-',str_slug($this->tag->nombre));

        //laboratorio
        $terms[] = explode('-',str_slug($this->laboratorio->nombre));

        //sede
        $terms[] = explode('-',str_slug($this->laboratorio->sede->nombre));

        //materia
        $terms[] = explode('-',str_slug($this->materia->nombre));

        if($this->retiro){
            $terms[] = explode('-',str_slug($this->retiro->created_at->formatLocalized('%A')));
            $terms[] = explode('-',str_slug($this->retiro->created_at->formatLocalized('%B')));
            $terms[] = explode('-',str_slug($this->retiro->created_at->year));
            $terms[] = explode('-',str_slug($this->retiro->laboratorio->nombre));
            $terms[] = explode('-',str_slug($this->retiro->laboratorio->sede->nombre));
            $terms[] = explode('-',str_slug($this->retiro->laboratorio->sede->nombre));
        }

        return array_where(array_flatten($terms),function($str){return strlen($str)>2;});
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
                $date = Carbon::createFromFormat($dateFormat,$searchQuery);
                break;
            } catch (\InvalidArgumentException $e){}
        }
    
        if($date) {//aca ya tengo la fecha en $date, compararla con created_at
            $ret = $this->created_at->toDateString() == $date->toDateString();
            if($this->retiro) $ret = $ret || $this->retiro->created_at->toDateString() == $date->toDateString();
            if($ret) return 1; 
            else return 0;
        } else { //si es null comparar $searchQuery con los $item->busqueda
            $searchQuery = str_slug($searchQuery);
            $searchQuery = explode('-',$searchQuery);
            $searchQuery = array_where($searchQuery,function($str){return strlen($str)>2;});
            return count(array_intersect($searchQuery,$this->busqueda));
        } 
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
