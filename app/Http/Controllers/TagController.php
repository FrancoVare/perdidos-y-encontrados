<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Prueba;

class TagController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth','first-login'])->except('apiTags');
    }

   	public function index()
   	{
     		$tags = Tag::where('baja',false)->orderBy('nombre')->get();
     		$pruebas = Prueba::where('baja',false)->orderBy('nombre')->get();

      	return view('tags.index',compact('tags','pruebas'));
   	}

    public function apiTags()
    {
      return Tag::has('items')->pluck('nombre');
    }

   	public function show()
    {
    	
    }

    public function create()
    {

    }

    public function store()
    {
        $this->validate(request(),[

          'nombre' => 'required',
          'pruebas' => 'required'

        ]);

        $tag = new Tag;

        $tag->nombre = request('nombre');
        $tag->save();

        $tag->pruebas()->attach(request('pruebas'));

        $tag->save();

        $this->flash('El tag ha sido agregado');
        return redirect('/tags');
    }

    public function destroy()
    {

      $this->validate(request(),[

        'nombre_tag' => 'required'

      ]);

      $tag = Tag::find(request('nombre_tag'));
      $tag-> baja = true;
      $tag->save();

      $this->flash('El tag ha sido eliminado');
      return redirect('/tags');

    }
}
