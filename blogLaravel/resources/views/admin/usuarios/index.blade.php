@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	@if(session('notificacion'))
		<div class="alert alert-success" role="alert">
			{{ session('notificacion') }}
		</div>
	@endif
	<div class="row" style="margin-left: 50%;">
		<strong>{{ $usuarios->count() }} Usuarios</strong>
	</div>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nombre</th>
				<th scope="col">Alias</th>
				<th scope="col">Rol</th>
				<th scope="col">Web</th>
				<th scope="col">Email</th>
				<th scope="col">Fecha Subscripción</th>
				<th scope="col">Bloqueado</th>
				<th scope="col">Editar</th>
			</tr>
		</thead>
		{{-- sacamos todos los usuarios --}}
		{{-- Creamos variable llamada key para que saque un número en vez del id del usuario --}}
		@foreach($usuarios as $key => $usuario)
			<tbody>
				<tr>
					<th scope="row">{{ $key+1 }}</th>
					<td>{{ $usuario->name }}</td>
					<td>{{ $usuario->alias }}</td>
					<td>{{ $usuario->UsuarioRoles }}</td>
					<td>{{ $usuario->web }}</td>
					<td>{{ $usuario->email }}</td>
					<td>{{ $usuario->created_at->toDayDateTimeString() }}</td>
					<td>{{ $usuario->UsuarioBloqueado }}</td>
					<td>
						<a href="{{ route('usuarios.edit',$usuario) }}">
							<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="title 1" title="title 1">
						</a>
					</td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<div class="row">
		<div class="col-xs-12 col-lg-10 col-lg-offset-1">
			{{ $usuarios->links() }}
		</div>
	</div>
</div>