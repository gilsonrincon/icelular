@extends ('front.base')

@section ('body')
	<div id="store">
		<h2>{{$store->name}}</h2>
		<b>Logo:</b><img src="{{asset('img/t/'.$store->logo)}}"><br>
		{{link_to($store->url, 'Sitio web', array('target' => '_blank'))}}<br>
		{{link_to($store->fan_page, 'Fan Page', array('target' => '_blank'))}}<br>
		{{link_to($store->twitter, 'Twitter', array('target' => '_blank'))}}<br>
		{{link_to($store->google_plus, 'Google Plus', array('target' => '_blank'))}}<br>
		{{link_to($store->youtube, 'Youtube', array('target' => '_blank'))}}<br>
		
		<p>{{$store->description}}</p>
	</div>
@stop