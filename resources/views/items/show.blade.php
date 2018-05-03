@extends('layouts.master')

@section('content')


<div class="row">
  <div class="col-sm-1">
    
  </div>
  <div class="col-sm-10">

  	<h1>{{$item->tag->nombre}}</h1>
  	<p class="blog-post-meta">

    	Lo encontro {{$item->user->name}} el 
      <?php 
        setlocale(LC_TIME, 'Spanish');
        echo $item->created_at->formatLocalized('%A %d de %B de %Y alrededor de las %R,'); 
      ?>
      despues de la cursada de 
      {{$item->materia->nombre}} en el laboratorio 
      {{$item->laboratorio->nombre}} de 
      {{$item->laboratorio->sede->nombre}}.

    </p>
  	<hr>
    <h3>Descripcion</h3>
  	{{$item->descripcion}}

    <hr>
    <h3>Pruebas minimas para la entrega</h3>
    <ul>
      @foreach($item->tag->pruebas as $prueba)
        <li>{{$prueba->nombre}}</li>
      @endforeach
    </ul>
  </div>
</div>


@endsection