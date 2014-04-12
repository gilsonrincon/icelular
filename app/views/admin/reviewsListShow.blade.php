@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<table id="storesListReviews" class="table table-bordered">
			<thead>
				<tr>
					<th>Calificación</th>
					<th>Comentario</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reviews as $review)
					<tr>
						<td>{{link_to('admin/calificaciones/'.$review->id.'/edit', $review->vote)}}</td>
						<td>{{link_to('admin/calificaciones/'.$review->id.'/edit', $review->comment)}}</td>
						<td>{{link_to('admin/calificaciones/'.$review->id.'/edit', $review->created_at)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop
