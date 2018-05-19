@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1">
		
	</div>
	<retiro p-item="{{json_encode($item)}}"></retiro>
	<div class="col-sm-1"></div>
	<div class="col-sm-2">
		<div class="filter-module filter-module-inset" style="word-wrap: break-word; width: 25vh;">
        <h4 style="text-align: center;">Pruebas Minimas</h4>
        <ul class="fa-ul">
        	@foreach($item->tag->pruebas as $prueba)
        	<li><i class="fa-li fa fa-chevron-circle-right"></i>{{$prueba->nombre}}</li>
        	@endforeach
        </ul>
    </div>
	</div>
</div>
		


@endsection