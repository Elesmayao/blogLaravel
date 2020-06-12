@extends('layouts.app')

@section('content')
<div class="container">
    <div style=" margin-top: 150px; margin-bottom: 230px" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('verifica-formulario.Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('verifica-formulario.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('verifica-formulario.Before proceeding, please check your email for a verification link.') }}
                    {{ __('verifica-formulario.If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('verifica-formulario.click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
