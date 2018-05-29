@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-sm-1"></div>

	<div class="col-sm-10 lg-card">
		@if( isset($reporte) && ($reporte!==null))
			En un total de {{$reporte['cantidad']}} items, el promedio de tiempo que permanecen perdidos es de {{$reporte['promedio']}} dias.
		@endif
	</div>
</div>

@endsection