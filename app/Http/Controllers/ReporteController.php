<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ReporteController extends Controller
{
    public function __construct()
   	{
   		return $this->middleware(['first-login','auth']);
   	}


    public function index()
    {  
    	$items = Item::has('retiro')->with('retiro')->get();
    	$calc = $items->map(function($item){
    		return ['perdido'=>$item->created_at,'encontrado'=>$item->retiro->created_at, 'diferencia' => $item->created_at->diffInDays($item->retiro->created_at)];
    	});

    	$reporte = ['promedio'=>round($calc->avg('diferencia'),2),'cantidad'=>$calc->count()];
      	return view('reportes.index')->with(compact('reporte'));
    }

    public function promedioTiempoPerdido()
    {  
    	$items = Item::has('retiro')->with('retiro')->get();
    	$calc = $items->map(function($item){
    		return ['perdido'=>$item->created_at,'encontrado'=>$item->retiro->created_at, 'diferencia' => $item->created_at->diffInDays($item->retiro->created_at)];
    	});

    	$reporte = ['promedio'=>round($calc->avg('diferencia'),2),'cantidad'=>$calc->count()];
      	return view('reportes.index')->with(compact('reporte'));
    }
}
