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
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=name&order_dir=desc',"NOMBRE ▼") }}
						@else
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=name&order_dir=asc',"NOMBRE ▲") }}
						@endif
					</th>
					<th @if($order_field=="email")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
						@if($order_dir=='asc')
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=email&order_dir=desc',"E-MAIL") }}
						@else
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=email&order_dir=asc',"E-MAIL") }}
						@endif
					</th>
					<th @if($order_field=="url")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
						@if($order_dir=='asc')
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=url&order_dir=desc',"URL") }}
						@else
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=url&order_dir=asc',"URL") }}
						@endif
					</th>
					<th @if($order_field=="url")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
						@if($order_dir=='asc')
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=clics&order_dir=desc',"CLICS DISPONIBLES") }}
						@else
							{{ link_to('admin/calificaciones?page='.$page.'&order_field=clics&order_dir=asc',"CLICS DISPONIBLES") }}
						@endif
					</th>
					<th>LOGO</th>
				</tr>
			</thead>
			<tbody>
					@foreach($stores as $store)
						<tr>
							<td>{{link_to('admin/calificaciones/'.$store->id, $store->name)}}</td>
							<td><a href="mailto:{{$store->email}}" target="_blank">{{$store->email}}</a></td>
							<td><a href="{{$store->url}}" target="_blank">{{$store->url}}</a></td>
							<td>{{link_to('admin/calificaciones/'.$store->id, $store->clics)}}</td>
							<td><img style="max-height: 130px;" alt="" class="img-responsive" src="/img/t/{{$store['logo']}}" /></td>
						</tr>
					@endforeach
				</tbody>
		</table>
	</div>
@stop
