@extends('admin.layout')

@section('head')
	<title>Administración de usuarios</title>
@stop

@section('body')
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/users/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($users->count() > 0)
		<div class="row">
			<table id="categorylist" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="email")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/users?page='.$page.'&order_field=email&order_dir=desc',"EMAIL") }}
							@else
								{{ link_to('admin/users?page='.$page.'&order_field=email&order_dir=asc',"EMAIL") }}
							@endif
						</th>
						<th @if($order_field=="user_type")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/users?page='.$page.'&order_field=user_type&order_dir=desc',"CATEGORÍA PADRE") }}
							@else
								{{ link_to('admin/users?page='.$page.'&order_field=user_type&order_dir=asc',"CATEGORÍA PADRE") }}
							@endif
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{Form::checkbox('selectall', $user->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{link_to('admin/users/'.$user->id.'/edit', $user->email)}}</td>
							<td>{{link_to('admin/users/'.$user->id.'/edit', $user->usertype->type)}}</td>
						
							
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de usuarios --}}
			{{ $users->links() }}
		</div>
		
		<!-- formulario oculto que se ocupa de la eliminación de los usuarios -->
		{{ Form::open(array('url'=>'admin/users/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
			{{ Form::hidden('ids','', array('id'=>'ids')) }}
		{{ Form::close() }}
		
		<script type="text/javascript">
			$(document).ready(function(e){
				
				//se examinan todos los checks para ver qué registros se encuentran seleccionados
				$('.chkItem').each(function(e){
					if($(this).context.checked){
						$(this).parent().parent().addClass('selected_row');
					}
				});
				
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
				
				//slección individual
				$('.chkItem').change(function(e){
					if($(this).context.checked){
						$(this).parent().parent().addClass('selected_row');
					}else{
						$(this).parent().parent().removeClass('selected_row');
					}
				});
				
				//al enviar el formulario de eliminación
				$('#form_delete').submit(function(e){
					var ids='';
					
					$('.selected_row .chkItem').each(function(e){
						ids+=$(this).val()+',';
					});
					
					$('#ids').val(ids);
					
					return true;
				});
				
				//envía el formulario
				$('#btEliminar').click(function(e){
					if($('.selected_row').length==0){
						alert('No ha seleccionado ningun usuario.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar los usuarios seleccionados?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
