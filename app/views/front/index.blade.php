@extends('front.base')

<script type="text/javascript">
	$(document).ready(function(){$('body').attr('id','index');});
		
	
</script>

@section("body")
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
@stop
