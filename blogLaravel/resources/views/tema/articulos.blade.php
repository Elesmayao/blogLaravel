@extends('layouts.app')

@section('title') {{ $tema->nombre }} @endsection
@section('content')

<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 180px; padding-bottom: 120px;">
    
    {{-- Si el usuario está autenticado mostramos todos los artículos --}}
	@if($usuarioAutenticado && !$usuarioBloqueado)
	    <div class="container-fluid">
	    	<div class="row">
	    		<div class="col-xs-12 col-lg-10 col-lg-offset-6">{{ $tema->nombre }}</div>
	    	</div>     
	        <div class="row">
	            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
	            	@foreach($articulos as $articulo)
		                <div class="col-xs-12 col-lg-4">
		                    <div class="jsNewsCard news__card" modal-id="#{{ $articulo->id }}">
		                        <div class="news__image">
		                            <img class="news__img" alt="" src="{{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}">
		                        </div>
		                        <div class="news__inner">
		                            <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}</h5>
		                            <p class="mbr-section-text lead">{{ $articulo->contenido }}</p>
		                            <div class="news__date">
		                                <span class="cm-icon cm-icon-clock"></span>
		                                <p>{{ $articulo->created_at->diffForHumans() }}</p>
		                            </div>
		                            
		                        </div>  
		                    </div>                                                
		                </div>
	            	@endforeach
	            </div>
	        </div>
			{{-- Paginador --}}
			<div class="row">
				<div class="col-xs-12 col-lg-10 col-lg-offset-1">
					{{ $articulos->links() }}
				</div>
			</div>

	    </div>
		
		@foreach($articulos as $articulo)
		    <div data-app-prevent-settings="" class="modal fade" tabindex="-1" data-keyboard="true" data-interval="false" id="{{ $articulo->id }}">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-body">
		                    <div class="news__card" href="#{{ $articulo->id }}">
		                    	@if($articulo->images->first())                        
		                            <div class="news__image">
		                            	{{-- Sacamos las imagenes en el modal (hemos puesto que aparezcan 3) --}}
		                            	@foreach($articulo->images as $imagen)
		                            	<img class="news__img" alt="" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
		                            	@endforeach
		                            </div>
		                        @endif    
		                        <div class="news__inner">
		                            <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}</h5>
		                            {{-- PONEMOS LAS !! PARA QUE FUNCIONE EL CSKEDITOR --}}
		                            <p class="mbr-section-text lead">{!! $articulo->contenido !!}</p>
		                            <div class="news__date">
		                                <span class="cm-icon cm-icon-clock"></span>
		                                <p>{{ $articulo->created_at }}</p>
		                            </div>
		                            <a class="close" href="#" role="button" data-dismiss="modal">
		                                <span aria-hidden="true">×</span>
		                                <span class="sr-only">Cerrar</span>
		                            </a>
		                        </div>          
		                    </div>   
		                </div>
		            </div>
		        </div>
		    </div>
		@endforeach
	{{-- si no está autenticado le saldrá el siguiente mensaje y le damos una url para que se registre --}}
	@elseif(!$usuarioAutenticado)
		<div style="width: 500px;margin: 20px auto 50px auto;">
			<h4 class="alert-heading">Lo Siento!</h4>
			<p>Para acceder a este contenido debes registrarte primero y luego iniciar sesión</p>
			<hr>
			<p class="mb-0"><a href="{{ url('/register') }}">Registrarse</a></p>
		</div>
		
	@elseif($usuarioBloqueado)
	<div style="width: 500px;margin: 20px auto 50px auto;">
		<div class="alert alert-danger" role="alert">
			<h4>Lo sentimos!</h4>
			<p>Este usuario ha sido bloqueado</p>
		</div>
	</div>
	@endif

</section>
@include('includes.login-modal')
@endsection

@if($errors->any())
    @section('include-login-modal')
    <script src="{{ asset('js/login-modal.js') }}"></script>
    @endsection
@endif