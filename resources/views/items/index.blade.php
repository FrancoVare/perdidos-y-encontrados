@extends('layouts.master')

@section('content')

          @foreach($items as $item)

          @include('items.item')

          @endforeach

{{--           <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav> --}}


@endsection