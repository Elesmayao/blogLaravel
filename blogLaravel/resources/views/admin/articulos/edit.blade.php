@extends('layouts.appAdmin')

@section('content')
{{-- CKEditor para el contenido --}}
<script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
<form method="POST" action="{{ route('articulos.update',$articulo->id) }}" enctype="multipart/form-data" class="temaFormuEdit">
	@csrf
	{{ method_field('PUT') }}
	<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
		@if(session('notificacion'))
			<div class="alert alert-success" role="alert">
				{{ session('notificacion') }}
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
						<input type="radio" name="activar" value="1" @if((old('activar',$articulo->activo))) checked @endif>
						Si
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="activar" value="0" @if(!(old('activar',$articulo->activo)))) checked @endif>
						No
					</label>
				</div>
				<hr>
				<div class="form-group">
					<label for="exampleInputPassword1">Título</label>
					<input type="text" class="form-control" name="titulo" value="{{ old('titulo',$articulo->titulo) }}">
				</div>
				<hr>
				<div class="form-group">
					<label for="exampleInputPassword1">Categoría</label>
					<select class="form-control" name="theme_id">
						@foreach($temasTodos as $tema)
							<option value="{{ $tema->id }}" @if(old('theme_id') == $tema->id) selected @endif>{{ $tema->nombre }}
							</option>
						@endforeach
					</select>
				</div>
				<hr>
				<div class="form-group">
					<label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido',$articulo->contenido) }}</textarea>
					{{-- PARA EJECUTAR EL CKEDITOR --}}
					<script>
						CKEDITOR.replace('contenido');
					</script>
				</div>
				<hr>
				{{-- Sacamos las imagenes que se han subido al artículo para poder eliminarlas --}}
				@foreach($articulo->images as $imagen)
					<img width="190px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
					<a href="{{ route('imagen.delete',$imagen) }}">
						<img style="margin-left: -26px; margin-top: -190px" width="20px" src="{{ asset('imagenes/admin/eliminar.png') }}">
					</a>
				@endforeach
				{{-- Contamos las imagenes que tiene el artículo --}}
				@if($articulo->images->count()<3)
					<p><h4>Añadir imágenes (El máximo de imagenes por artículo es 3)</h4></p>
				@endif
				<div class="container">
					{{-- Este for sirve para: Si tienes 2 fotos subidas , se te añade un Input File para que puedas añadir otra mas ( Tenemos un máximo de 3 imagenes por articulo ), si tienes 1 foto, te añade 2 input, etc.. --}}
					@for($i=3;$i>$articulo->images->count();$i--)
						<div style="margin-top: 20px" class="row">
							<div style="margin-top: 20px" class="col-1">
								<input type="file" name="foto{{ $i }}"></input>
							</div>
						</div>
					@endfor
				</div>
				<hr>
				<button type="submit" class="btn btn-info btn-sm">Editar</button>
			</div>
		</div>
	</div>
</form>