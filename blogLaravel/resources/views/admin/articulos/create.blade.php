@extends('layouts.appAdmin')

@section('content')
{{-- CKEditor para el contenido --}}
<script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
{{-- enctype para enviar archivos al servidor --}}
<form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data" class="temaFormuEdit">
	@csrf
	<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
		@if(session('notificacion'))
			<div class="alert alert-success" role="alert">
				{{ session('notificacion') }}
			</div>
		@endif
		@if(session('notificacion2'))
			<div class="alert alert-danger" role="alert">
				{{ session('notificacion2') }}
			</div>
		@endif
		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<p><b>Activar</b></p>
				<div class="radio">
					<label>
						<input type="radio" name="activo" value="1" @if((old('activar'))) checked @endif>
						Si
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="activo" value="0" @if(!(old('activar'))) checked @endif>
						No
					</label>
				</div>
				<hr>
				<div class="form-group">
					<label for="exampleInputPassword1">Título</label>
					<input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Categoría</label>
					<select class="form-control" name="theme_id">
						@foreach($temasTodos as $tema)
							<option value="{{ $tema->id }}" @if(old('theme_id') == $tema->id) selected @endif>{{ $tema->nombre }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido') }}</textarea>
					{{-- PARA EJECUTAR EL CKEDITOR --}}
					<script>
						CKEDITOR.replace('contenido');
					</script>
				</div>
				<hr>
				@for($i=0;$i<3;$i++)
					<div class="col-1">
						<input type="file" name="foto{{ $i }}"></input>
					</div>
					<hr>
				@endfor
				<button type="submit" class="btn btn-info btn-sm">Añadir</button>
			</div>
		</div>
	</div>
</form>