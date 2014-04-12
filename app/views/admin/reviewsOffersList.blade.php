@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<table id="storesListReviews" class="table table-bordered">
			<thead>
				<tr>
					<th>Oferta</th>
					<th>Producto</th>
					<th>Precio</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($offers as $offer)
					<td>{{link_to('admin/calificaciones/'.$offer->id.'/reviews', $offer->title)}}</td>
					<td>{{link_to('admin/calificaciones/'.$offer->id.'/reviews', $offer->product->name)}}</td>
					<td>{{link_to('admin/calificaciones/'.$offer->id.'/reviews', $offer->price)}}</td>
				@endforeach
			</tbody>
		</table>
	</div>
@stop
