@if(Auth::check())
    <a href="/items/{{$item->id}}">
@endif
    <div class="blog-post">
      <h2 class="blog-post-title">{{$item->tag->nombre}} @if(!is_null($item->retiro)) => Retirado @endif</h2>

      <p class="blog-post-meta">

      	Lo encontro {{$item->user->name}} el 
        <?php 
          setlocale(LC_TIME, 'Spanish');
          echo $item->created_at->formatLocalized('%A %d de %B de %Y alrededor de las %R,'); 
        ?>
        despues de la cursada de 
        {{$item->materia->nombre}} en el laboratorio 
        {{$item->laboratorio->nombre}} de 
        {{$item->laboratorio->sede->nombre}}.

      </p>

    </div><!-- /.blog-post -->
@if(Auth::check())
  </a>
@endif
