@extends('layouts.master')

@section('content')

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

	{{$item->descripcion}}


@endsection