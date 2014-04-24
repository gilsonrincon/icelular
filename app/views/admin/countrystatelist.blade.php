@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/countries/'.$country->id.'/createstate','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	<div class="row">
		{{Form::open(array('url' => 'admin/countries/deletestate' ))}}
		<table id="countriesListReviews" class="table table-bordered">
			<thead>
				<tr>
					<th><input class="chkAll" name="selectall" type="checkbox" value=""></th>
					<th>Nombre del Pais</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($states as $state)
					<tr>
						<td>
							{{Form::checkbox($state->id, $state->id, false, array('class' => 'chkItem'))}}
						</td>
						<td>
							{{$state->state}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{Form::close()}}

		{{-- paginador de paises --}}
			{{ $states->links() }}
	</div>

	<script type="text/javascript">
		$(document).on('ready', function(){
			//seleccionar todos los elementos
			$('.chkAll').change(function(e){
				if($(this).context.checked){
					$('.chkItem').each(function(e){
						$(this).context.checked=true;
						$(this).change();
					});
				}else{
					$('.chkItem').each(function(e){
						$(this).context.checked=false;
						$(this).change();
					});
				}
			});

			$('#btEliminar').click(function(event) {
				$('form').submit();
			});
		})
	</script>
@stop
