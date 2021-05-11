@extends('layouts.app')

@section('content')

<div class="form-content">

                        <h1 class="">Verify Your Email Address</h1>
                        <p class="">Before proceeding, please check your email for a verification link.</p>
                        <p>If you did not receive the email</p>
                        
                        @if (session('resent'))
                        <div class="alert alert-info mb-4 mt-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                        <strong>Error!</strong> A fresh verification link has been sent to your email address.
                        </div>
                        @endif
                        <form class="text-left" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                            <div class="form">

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    @error('password')
                                    <div class="alert alert-danger mb-4 mt-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                        <strong>Error!</strong> {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">click here to request another</button>
                                    </div>
                                </div>



                            </div>
                        </form>

                    </div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
