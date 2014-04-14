@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	{{Form::open(array('url'=>'admin/calificaciones/delete', 'method'=>'POST'))}}
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	<div class="row">
		
		<table id="storesListReviews" class="table table-bordered">
			<thead>
				<tr>
					<th>
						{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
					</th>
					<th>Calificación</th>
					<th>Comentario</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reviews as $review)
					<tr>
						<td>{{Form::checkbox($review->id, $review->id, false, array('class'=>'chkItem'))}}</td>
						<td>{{link_to('admin/calificaciones/'.$review->id.'/edit',$review->vote)}}</td>
						<td>{{link_to('admin/calificaciones/'.$review->id.'/edit',$review->comment)}}</td>
						<td>{{link_to('admin/calificaciones/'.$review->id.'/edit',$review->created_at)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{{Form::close()}}
	<script>
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
		
		
	</script>
@stop
