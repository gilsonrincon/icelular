@extends('admin.layout')

@section('head')
	<title>Reporte de clics de {{$store->name}}</title>
@stop

@section('body')
	<div class="row">
		<table id="storesListClicks" class="table table-bordered">
			<thead>
				<tr>
					<th>Oferta</th>
					<th>Fecha y hora</th>
					<th>Ip</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($offers as $offer)
					@foreach ($offer->clicks as $click)
						<tr>
							<td>{{$offer->product->name}}</td>
							<td>{{$click->created_at}}</td>
							<td>{{$click->ip}}</td>
						</tr>
					@endforeach
				@endforeach
			</tbody>
		</table>
	</div>
@stop
