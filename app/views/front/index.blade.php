@extends('front.base')

<script type="text/javascript">
	$(document).ready(function(){$('body').attr('id','index');});
		
	
</script>

@section("body")
	<!--Banner principal -->
	<section>
		<div id="banner">
			<div id="mainBanner" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php
						$index = 0;
					?>
					@foreach ($mainBanners as $banner)
						<li data-target="#mainBanner" data-slide-to="{{$index}}"></li>
						<?php
							$index = $index + 1;
						?>
					@endforeach
					
				</ol>
				<div class="carousel-inner">
				 	@foreach ($mainBanners as $banner)
				 		<div class="item">
					    	<img src="{{asset('img/b/'.$banner->image)}}" alt="Banner">
					    </div>
				 	@endforeach
				</div>
			</div>
		</div>
	</section>
	<script>
		$('#banner .item').first().addClass('active');
		$('.carousel-indicators li').first().addClass('active');
	</script>

	<section class="col1">
		@include("front.modules.categoryList")
	</section>
	<section class="col2">
		@if(count($featuredOffers)>0)
			<h2>Ofertas para productos destacados</h2>
			<ul class="featuredOffers">
				@foreach($featuredOffers as $it)
					<li>
						<h3>{{link_to('producto/'.$it["product"]->id.'-'.$it["product"]->url.'.html', $it["product"]->name)}}</h3>
						{{HTML::imageLink('img/p/'.ProductImage::where('product_id','=',$it['product']->id)->first()->image,'producto/'.$it["product"]->id.'-'.$it["product"]->url.'.html','_self',$it["product"]->name,array('class'=>'item'))}}
						<p class="description">{{$it["product"]->short_description}}</p>
						<p class="price">${{$it["offers"]->first()->price}}</p>
						<span class="nOffers">{{$it["offers"]->count()}}</span>
					</li>
					
				@endforeach
			</ul>
		@else
			<h2>No hay productos destacados.</h2>
		@endif
	</section>

	<!-- Banner Secundario -->
	<section>
		<div id="secundaryBanner">
			<div id="secBanner" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php
						$index = 0;
					?>
					@foreach ($secBanners as $banner)
						<li data-target="#secBanner" data-slide-to="{{$index}}"></li>
						<?php
							$index = $index + 1;
						?>
					@endforeach
					
				</ol>
				<div class="carousel-inner">
				 	@foreach ($secBanners as $banner)
				 		<div class="item">
					    	<img src="{{asset('img/b/'.$banner->image)}}" alt="Banner">
					    </div>
				 	@endforeach
				</div>
			</div>
		</div>
	</section>
	<script>
		$('#secBanner .item').first().addClass('active');
		$('#secBanner .carousel-indicators li').first().addClass('active');
	</script>
@stop
