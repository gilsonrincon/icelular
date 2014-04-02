@extends('admin.layout')

@section('head')
	<title>Gestor de contenidos</title>
@stop

@section('body')
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/cms/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($cms->count()>0)
		<div class="row">
			<table id="cmsList" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="title")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/cms?page='.$page.'&order_field=title&order_dir=desc',"TÍTULO ▼") }}
							@else
								{{ link_to('admin/cms?page='.$page.'&order_field=title&order_dir=asc',"TÍTULO ▲") }}
							@endif
						</th>
						<th>DESCRIPCIÓN</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cms as $item)
						<tr>
							<td>{{Form::checkbox('selectall', $item->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{link_to('admin/cms/'.$item->id.'/edit',$item->title)}}</td>
							<td>{{$item->description}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{-- paginador de CMS --}}
			{{ $cms->links() }}
		</div>
		
		<!-- formulario oculto que se ocupa de la eliminación de los ítems seleccionadas -->
		{{ Form::open(array('url'=>'admin/cms/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
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
						alert('No ha seleccionado ningún elemento.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar los elementos seleccionados?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
