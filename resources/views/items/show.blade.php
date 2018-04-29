@extends('layouts.master')

@section('content')

	<h1>{{$item->user->name}} on {{$item->created_at->toFormattedDateString()}}</h1>

	<hr>

	{{$item->descripcion}}


@endsection