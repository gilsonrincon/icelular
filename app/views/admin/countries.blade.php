@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<table id="countriesListReviews" class="table table-bordered">
			<thead>
				<tr>
					<th>Nombre del Pais</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($countries as $country)
					<tr>
						<td>
							{{link_to('admin/countries/'.$country->id.'/show', $country->country)}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{{-- paginador de paises --}}
			{{ $countries->links() }}
	</div>
@stop
