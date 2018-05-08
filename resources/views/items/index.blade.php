@extends('layouts.master')

@section('content')


<div class="row">
	<div class="col-sm-1">
		
	</div>
	<div class="col-sm-9">
		@foreach($items as $item)

	    	@include('items.item')

   		@endforeach
        <div class="container">
            {{$items->links()}}
        </div>
	</div>
      <div class="filter-module filter-module-inset">
        <h4 style="text-align: center;">Tags</h4>
        <ul class="fa-ul">
        	@foreach($tags as $tag)
        		<li><a class="side" href="/items/tags/{{$tag}}"><i class="fa-li fa fa-chevron-circle-right"></i>{{$tag}}</a></li>
        	@endforeach
        	<li><a class="side" href="/"><i class="fa-li fa fa-chevron-circle-right"></i>Todos</a></li>
        </ul>
    </div>
</div>

@endsection