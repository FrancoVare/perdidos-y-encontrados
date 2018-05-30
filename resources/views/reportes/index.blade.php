@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1"></div>

	<div class="col-sm-10">
		@if( isset($ptp) && ($ptp!==null))
			<div class="lg-card">
				En un total de {{$ptp['cantidad']}} items, el promedio de tiempo que permanecen perdidos es de {{$ptp['promedio']}} dias.
			</div>
			<hr>
		@endif
		@if( isset($ppa) && ($ppa!==null))
			<div class="lg-card">
				@foreach($ppa as $atributo => $cantidad)
					{{$atributo}}: {{$cantidad}} <br>
				@endforeach
			</div>
		@endif
	</div>
</div>

@endsection