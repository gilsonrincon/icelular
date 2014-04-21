@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<table id="storesListReviews" class="table table-bordered">
			<thead>
				<tr>
					<th @if($order_field=="name")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
						@if($order_dir=='asc')
							{{ link_to('admin/quejas?page='.$page.'&order_field=status&order_dir=desc',"Estado ▼") }}
						@else
							{{ link_to('admin/quejas?page='.$page.'&order_field=status&order_dir=asc',"Estado ▲") }}
						@endif
					</th>
					<th @if($order_field=="description")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
						@if($order_dir=='asc')
							{{ link_to('admin/quejas?page='.$page.'&order_field=description&order_dir=desc',"Descripción") }}
						@else
							{{ link_to('admin/quejas?page='.$page.'&order_field=description&order_dir=asc',"Descripción") }}
						@endif
					</th>
					<th @if($order_field=="created_at")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
						@if($order_dir=='asc')
							{{ link_to('admin/quejas?page='.$page.'&order_field=created_at&order_dir=desc',"Fecha") }}
						@else
							{{ link_to('admin/quejas?page='.$page.'&order_field=created_at&order_dir=asc',"Fecha") }}
						@endif
					</th>
				</tr>
			</thead>
			<tbody>
					@foreach($complaints as $complaint)
						<tr>
							<td>{{link_to('admin/quejas/'.$complaint->id, $complaint->status)}}</td>
							<td>{{link_to('admin/quejas/'.$complaint->id, $complaint->description)}}</td>
							<td>{{link_to('admin/quejas/'.$complaint->id, $complaint->created_at)}}</td>
						</tr>
					@endforeach
				</tbody>
		</table>
	</div>
@stop
