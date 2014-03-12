@extends('admin.layout')

@section('head')
	<title>Administración de banners</title>
@stop

@section('body')
	<h2>Administración de banners</h2>
	
	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/banners/new','Nuevo',array('class'=>'bt_new'))}}
			{{link_to('#','Eliminar',array('class'=>'bt_remove', 'id'=>'btEliminar'))}}
		</div>
	</div>
	
	@if($banners->count()>0)
		<div class="row">
			<table id="bannerlist" class="table table-bordered">
				<thead>
					<tr>
						<th>
							{{Form::checkbox('selectall','', false, array('class'=>'chkAll'))}}
						</th>
						<th @if($order_field=="position")class="ordering @if($order_dir=='asc') asc @else desc @endif"@endif>
							@if($order_dir=='asc')
								{{ link_to('admin/banners?page='.$page.'&order_field=name&order_dir=desc',"TÍTULO", array('title'=>'Título del banner', 'class'=>'tip')) }}
							@else
								{{ link_to('admin/banners?page='.$page.'&order_field=name&order_dir=asc',"TÍTULO", array('title'=>'Título del banner', 'class'=>'tip')) }}
							@endif
						</th>
						<th>POSICIÓN</th>
						<th>IMAGEN</th>
						<th>CLICS</th>
						<th>IMPRESIONES</th>
					</tr>
				</thead>
				<tbody>
					@foreach($banners as $banner)
						<tr>
							<td>{{Form::checkbox('selectall', $banner->id, false, array('class'=>'chkItem'))}}</td>
							<td>{{link_to("admin/banners/update/".$banner["id"],$banner->name)}}</td>
							<td><span class="tip" title="{{BannerHook::find($banner["hook_id"])->description}}">{{BannerHook::find($banner["hook_id"])->title}}</span></td>
							<td style="max-width:150px;">
								<a href="{{$banner['url_click']}}" target="_blank">
									<img class="img-responsive" alt="" src="/img/b/{{$banner['image']}}" />
								</a>
							</td>
							<td>{{BannerClick::where("banner_id","=",$banner["banner_id"])->count()}}</td>
							<td>{{BannerHit::where("banner_id","=",$banner["banner_id"])->count()}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
			{{ $banners->links() }}
		</div>
		
		{{ Form::open(array('url'=>'admin/banners/destroy','id'=>'form_delete', 'style'=>'display:none;')) }}
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
						alert('No ha seleccionado ningun banner.');
						return false;
					}
					if(confirm('¿Realmente desea eliminar los banners seleccionados?')){
						$('#form_delete').submit();
					}
					return false;
				})
			});
		</script>
	@endif
@stop
