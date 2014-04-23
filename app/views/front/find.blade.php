@extends ('front.base')

@section ('body')
	<div id="find">
		@foreach ($result as $r)
			<div class="result">
				<b>{{link_to('producto/'.$r->id.'-'.$r->url.'.html', $r->name)}}</b><br>
				<span class="shotdescription">
					{{link_to('producto/'.$r->id.'-'.$r->url.'.html', $r->short_description)}}
				</span>
			</div>
		@endforeach
	</div>
@stop