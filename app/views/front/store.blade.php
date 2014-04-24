@extends ('front.base')

@section ('body')
	<div id="store" class="col-md-12">
		<h2>{{$store->name}}</h2>
		<div class="col-md-6">
			<b>Logo:</b><br>
			<img src="{{asset('img/t/'.$store->logo)}}"><br>
		</div>
		<div class="col-md-6">
			<b>Mapa:</b><br>
			{{$store->map}}<br>
		</div>
		{{link_to($store->url, 'Sitio web', array('target' => '_blank'))}}<br>
		{{link_to($store->fan_page, 'Fan Page', array('target' => '_blank'))}}<br>
		{{link_to($store->twitter, 'Twitter', array('target' => '_blank'))}}<br>
		{{link_to($store->google_plus, 'Google Plus', array('target' => '_blank'))}}<br>
		{{link_to($store->youtube, 'Youtube', array('target' => '_blank'))}}<br>
		
		<p>{{$store->description}}</p>
	</div>
@stop