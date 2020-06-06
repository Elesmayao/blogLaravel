@extends('layouts.app')

@section('title') {{ $tema->nombre }} @endsection
@section('content')

<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 180px; padding-bottom: 120px;">
    

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
	                            <img class="news__img" alt="" src="assets/images/01.jpeg">
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
    </div>
	
	@foreach($articulos as $articulo)
	    <div data-app-prevent-settings="" class="modal fade" tabindex="-1" data-keyboard="true" data-interval="false" id="{{ $articulo->id }}">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-body">
	                    <div class="news__card" href="#{{ $articulo->id }}">
	                        <div class="news__image">
	                            <img class="news__img" alt="" src="assets/images/01.jpeg">
	                        </div>
	                        <div class="news__inner">
	                            <h5 class="mbr-section-title display-6">{{ $articulo->titulo }}</h5>
	                            <p class="mbr-section-text lead">{{ $articulo->contenido }}</p>
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
</section>
@include('includes.login-modal')
@endsection

@if($errors->any())
    @section('include-login-modal')
    <script src="{{ asset('js/login-modal.js') }}"></script>
    @endsection
@endif