@include('layouts.head')

@include('layouts.navbar')

@if(Auth::check())
	@include('layouts.sidebar')
	<div class="blog-main logged-in">
@else
	<div class="blog-main"> 
@endif  

@yield('content')

</div>



@include('layouts.footer')
