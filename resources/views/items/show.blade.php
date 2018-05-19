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
          \Carbon\Carbon::setLocale('es');
          \Carbon\Carbon::setUtf8(true);
        echo $item->created_at->formatLocalized('%A %d de %B de %Y alrededor de las %R,'); 
      ?>
      despues de la cursada de 
      {{$item->materia->nombre}} en el laboratorio 
      {{$item->laboratorio->nombre}} de 
      {{$item->laboratorio->sede->nombre}}.

    </p>
  	<hr>
    <h3>Descripcion</h3>
  	<p>{{$item->descripcion}}</p>

    @if(!is_null($item->retiro))
      <hr>
      <h3>Retiro</h3>
      <p>
        Retirado el 
        <?php 
          setlocale(LC_TIME, 'Spanish');
          \Carbon\Carbon::setLocale('es');
          \Carbon\Carbon::setUtf8(true);
          echo $item->retiro->created_at->formatLocalized('%A %d de %B de %Y alrededor de las %R'); 
        ?> 
        por {{$item->retiro->nombre}}, {{$item->retiro->tipoDoc}}: {{$item->retiro->numeroDoc}}.
        Entregado por {{$item->retiro->user->name}} en el laboratorio {{$item->retiro->laboratorio->nombre}} de {{$item->retiro->laboratorio->sede->nombre}}
      </p>
      <img src="{{url($item->retiro->foto_retiro)}}" style="max-width: 85%; max-height: 85%; margin: auto; display: block; border-radius: 15px;">
    @else
    <hr>
    <form action="/retiros" method="GET" style="text-align: right;">
      <input type="hidden" name="item" value="{{$item->id}}" /> 
      <button type="submit" class="btn btn-primary">Retiro</button>
    </form>
    @endif
  </div>
</div>


@endsection