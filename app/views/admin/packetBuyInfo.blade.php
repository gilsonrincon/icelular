@extends('admin.layout')

@section('body')
	<h2>Comprar un paquete de clicks</h2>
	<div class="well well-lg col-md-12">
		Se ha agregado el paquete {{$packet->name}} a su lista de paquetes. Pero este se encontrara en espado de aprovación hasta que se confirme que usted consigno la suma de {{$packet->value}} a la cuenta xxxxx, de xxxxx o a la cuenta xxxxx de xxxxx. <br><br><br>
		{{link_to('admin/profile', 'Volver a mi perfil')}}
	</div>
@stop

