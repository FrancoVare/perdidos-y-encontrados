@extends('layouts.master')

@section('content')


<div class="row" id="app">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-9" >
		<items auth-check={{Auth::check()}}></items>
	</div>
</div>

@endsection