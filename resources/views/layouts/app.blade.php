<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pharmcount') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/dashboard/assets/img/favicon.ico') }}"/>
    <link href="{{ asset('/dashboard/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/dashboard/assets/js/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('/dashboard/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/dashboard/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/dashboard/assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{ asset('/dashboard/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/dashboard/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dashboard/assets/css/forms/switches.css') }}">
</head>

<body class="form">

<div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    @yield('content')                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
   <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
   <script src="{{ asset('/dashboard/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('/dashboard/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('/dashboard/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/dashboard/assets/js/authentication/form-2.js') }}"></script>