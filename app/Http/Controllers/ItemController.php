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
   		return $this->middleware('auth')->except(['index','apiItems']);
   	}


   public function index(Tag $tag = null)
   {  
      return view('items.index');
   }

   public function apiItems()
   {  

      $items = Item::with(['materia','laboratorio','tag','user','laboratorio.sede','retiro'])
                        ->latest()
                        ->tag(request('tag'))
                        ->estado(request('estado'))
                        ->paginate(15);

                          
      return json_encode($items);
   }

   public function show(Item $item)
    {
    	return view('items.show',compact('item'));
    }
    
    public function create()
    {
    	return view('items.create');
    }

    public function store()
    {
    	$this->validate(request(),[

    		'descripcion' => 'required|string',
    		'materia_id' => 'required|numeric',
        'laboratorio_id' => 'required|numeric',
        'tag_id' => 'required|numeric',
        'foto_item' => 'required | mimes:jpeg,jpg,png| max:15360'

    	]);

      $foto_item = request()->file('foto_item')->store('images');

    	$descripcion = request('descripcion');
    	$materia_id = request('materia_id');
      $laboratorio_id = request('laboratorio_id');
      $tag_id = request('tag_id');

    	auth()->user()->publish(new Item(compact('descripcion','materia_id','tag_id','laboratorio_id','foto_item')));

      return response()->json(['message' => 'El item ha sido registrado']);
    }
}
