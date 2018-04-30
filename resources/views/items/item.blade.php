<div class="blog-post">
  <h2 class="blog-post-title">

    @if(Auth::check())
    <a href="/items/{{$item->id}}">
        {{$item->tag->nombre}}
    </a>
    @else
        {{$item->tag->nombre}}
    @endif
    
  </h2>

  <p class="blog-post-meta">

  	Lo encontro {{$item->user->name}} el 
    <?php 
      setlocale(LC_TIME, 'Spanish');
      echo $item->created_at->formatLocalized('%A %d de %B de %Y alrededor de las %R,'); 
    ?>
    despues de la cursada de 
    {{$item->materia->nombre}}

  </p>

  <hr>

</div><!-- /.blog-post -->