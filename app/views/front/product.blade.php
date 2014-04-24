@extends ('front.base')

@section ('body')
	<ul class="nav nav-tabs">
		<li class="active"><a href="#general" data-toggle="tab">general</a></li>
		<li><a href="#caracteristicas" data-toggle="tab">caracteristicas</a></li>
		@if ($product->video != "")
		  	<li><a href="#video" data-toggle="tab">video</a></li>
		@endif
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="general">
	  		<h1>{{$product->name}}</h1>

	  		<div id="productImage" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php
						$index = 0;
					?>
					@foreach ($product->images as $image)
						<li data-target="#productImage" data-slide-to="{{$index}}"></li>
						<?php
							$index = $index + 1;
						?>
					@endforeach
					
				</ol>
				<div class="carousel-inner">
				 	@foreach ($product->images as $image)
				 		<div class="item">
					    	<img src="{{asset('img/p/'.$image->image)}}" alt="Banner">
					    </div>
				 	@endforeach
				</div>
			</div>
			<script>
				$('#productImage .item').first().addClass('active');
				$('.carousel-indicators li').first().addClass('active');
			</script>

			<p>{{$product->description}}</p>
		</div>
		<div class="tab-pane" id="caracteristicas">
			@foreach ($product->attributes as $attribute)
				<div>
					<b>{{$attribute->attribute->attribute}}:</b>
					{{$attribute->value}}
				</div>
			@endforeach
		</div>
		@if ($product->video != "")
			<div class="tab-pane" id="video">
				<iframe width="420" height="315" src="//youtube.com/embed/{{$product->video}}" frameborder="0" allowfullscreen=""></iframe>
			</div>
		@endif
	</div>
		<!--ofertas-->
		<h2>Ofertas</h2>
		@if ($order == "desc")
			{{link_to('producto/'.$product->id.'-'.$product->url.'.html?order=asc', 'De menor a mayor precio')}}
		@else
			{{link_to('producto/'.$product->id.'-'.$product->url.'.html?order=desc', 'De mayor a menor precio')}}
		@endif
		<ol>
			@foreach ($offers as $offer)
				<li>
					<b>{{$offer->title}}:</b> <span class="price">{{$offer->price}}</span><br>
					<b>Descripción:</b><br> <p class="description">{{$offer->description}}</p><br>
					<b>Tienda:</b> {{link_to('tienda/'.$offer->store->id.'-'.$offer->store->url_seo.'.html', $offer->store->name)}}<br>
					<b>Logo:</b><br>
					<a href="/tienda/{{$offer->store->id}}-{{$offer->store->url_seo}}.html"><img src="{{asset('img/t/'.$offer->store->logo)}}"></a>
					<br>
					<a target="_blank" href="{{$offer->store->url}}">Visitar sitio web</a> |
					<a target="_blank" href="{{$offer->url}}">Visitar tienda online</a> | 
					{{link_to('oferta/'.$offer->id, 'Ver Calificaciones | Calificar')}}
				</li>
			@endforeach
		</ol>


@stop