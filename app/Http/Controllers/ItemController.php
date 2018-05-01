<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Materia;
use App\Tag;
use App\Laboratorio;

class ItemController extends Controller
{

	public function __construct()
   	{
   		return $this->middleware('auth')->except('index');
   	}


   public function index()
   {

   		$items = Item::latest()->get();

   		return view('items.index',compact('items'));
   }

   public function show(Item $item)
    {
    	return view('items.show',compact('item'));
    }

    public function create()
    {
    	$materias = Materia::where('baja',false)->orderBy('nombre')->get();
      $tags = Tag::where('baja',false)->orderBy('nombre')->get();
      $laboratorios = Laboratorio::where('baja',false)->orderBy('nombre')->get();

    	return view('items.create',compact('materias','tags','laboratorios'));
    }

    public function store()
    {
    	$this->validate(request(),[

    		'descripcion' => 'required',
    		'materia_id' => 'required',
        'laboratorio_id' => 'required',
        'tag_id' => 'required'

    	]);

    	$fechaEncontrado = date('Y-m-d H:i:s');
    	$descripcion = request('descripcion');
    	$materia_id = request('materia_id');
      $laboratorio_id = request('laboratorio_id');
      $tag_id = request('tag_id');

    	auth()->user()->publish(new Item(compact('descripcion','fechaEncontrado','materia_id','tag_id','laboratorio_id')));

    	return redirect('/');
    }
}
