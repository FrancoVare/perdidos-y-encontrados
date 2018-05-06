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


    @if(is_null($item->retiro))
    <form action="/retiros" method="GET">
      <input type="hidden" name="item" value="{{$item->id}}" /> 
      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    @endif
  </div>
</div>


@endsection