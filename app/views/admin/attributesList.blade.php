@extends('admin.layout')


@section('body')

	<div class="row">
		<div class="well well-lg" id="option_buttons">
			{{link_to('admin/attributes/new-group','Nuevo grupo',array('class'=>'bt_new'))}}
			@if(AttributesGroup::count()>0)
				{{ link_to("admin/attributes/add","Añadir atributos",array("class"=>"bt_add")) }}
			@endif
		</div>
	</div>

	@foreach($groups as $group)
		<div class="item_attr_group">
			<h3>
				<span class="txt">
					{{$group["attributes_group"]}} ({{$group->attributes()->count()}})
				</span>
				
				{{Form::open(array('url'=>'admin/attributes/edit-group','action'=>'POST', 'class'=>'form-horizontal edit_attributes_group', 'role'=>'form'))}}
					{{Form::text("attributes_group",$group["attributes_group"],array("id"=>"attributes_group","class"=>"it"))}}
					{{Form::hidden("id",$group["id"])}}
					{{Form::submit("Gardar",array("class"=>"btn btn-default btn-primary"))}}
					{{Form::button("Cancelar",array("class"=>"btn btn-default btn-danger cancel"))}}
				{{Form::close()}}
				
				{{Form::open(array('url'=>'admin/attributes/delete-group','action'=>'POST', 'class'=>'form-horizontal delete_attributes_group',"style"=>"display:none;", 'role'=>'form'))}}
					{{Form::hidden("id",$group["id"])}}
				{{Form::close()}}
			</h3>
			<ul class="commands">
				<li class="attributes">Atributos</li>
				<li class="edit">Editar</li>
				@if($group->attributes()->count()==0)
					<li class="delete">Eliminar</li>
				@endif
			</ul>
			<div class="attr">
				<ul>
					@foreach($group->attributes()->get() as $attribute)
						<li>
							<div>
								<span class="attr_edit">Editar</span> <span class="attr_delete">Eliminar</span> <span class="txt">{{$attribute["attribute"]}}</span>
							</div>
							
							{{Form::open(array('url'=>'admin/attributes/edit','action'=>'POST', 'class'=>'form-horizontal edit_attribute', 'role'=>'form'))}}
								{{Form::text("attribute",$attribute['attribute'],array("id"=>"attribute","class"=>"it"))}}
								{{Form::hidden("id",$attribute["id"])}}
								{{Form::submit("Gardar",array("class"=>"btn btn-default btn-primary"))}}
								{{Form::button("Cancelar",array("class"=>"btn btn-default btn-danger cancel"))}}
							{{Form::close()}}
							
							{{Form::open(array('url'=>'admin/attributes/delete','action'=>'POST', 'class'=>'form-horizontal delete_attribute',"style"=>"display:none;", 'role'=>'form'))}}
								{{Form::hidden("id",$attribute["id"])}}
							{{Form::close()}}
						</li>
					
					@endforeach
				</ul>
			</div>
		</div>
	@endforeach
	
	<script type="text/javascript">
		$(document).ready(function(e){
			//despliega la lista de atributos de un grupo
			$('.item_attr_group .commands .attributes, .item_attr_group h3 .txt').click(function(e){
				if($(this).parent().parent().children('.attr').css('display')!='block'){
					$('.item_attr_group .attr').slideUp('slow');
					$(this).parent().parent().children('.attr').slideDown('slow');
				}
			});
			
			//para editar el grupo de atributos
			$('.item_attr_group .commands .edit').click(function(e){
				$(this).parent().parent().children('h3').children('.txt').hide();
				$(this).parent().parent().children('h3').children('.edit_attributes_group').show();
			});
			
			//oculta el formulario de edición de grupos
			$('.edit_attributes_group .cancel').click(function(e){
				$(this).parent().parent().children('.edit_attributes_group').hide();
				$(this).parent().parent().children('.txt').show();
			});
			
			//para eliminar un grupo
			$('.item_attr_group .commands .delete').click(function(e){
				if(confirm('¿Realmente desea eliminar el grupo de atributo?')){
					$(this).parent().parent().children('h3').children('.delete_attributes_group').submit();
				}
			});
			
			//para editar un atributo
			$('.item_attr_group .attr .attr_edit').click(function(e){
				$(this).parent().hide();
				$(this).parent().parent().children('.edit_attribute').show();
			});
			
			//cancela la edición del atributo
			$('.edit_attribute .cancel').click(function(e){
				$(this).parent().hide();
				$(this).parent().parent().children('div').show();
			});
			
			//para eliminar un atributo
			$('.item_attr_group .attr .attr_delete').click(function(e){
				if(confirm('¿Realmente desea eliminar el atributo?')){
					$(this).parent().parent().children('.delete_attribute').submit();
				}
			});
		});
	</script>
@stop