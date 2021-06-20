<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Pharmcount') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- <link href="{{  asset('/dashboard/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{  asset('/dashboard/assets/js/loader.js') }}"></script> -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <!-- <link href="{{  asset('/dashboard/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{  asset('/dashboard/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('/dashboard/assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{  asset('/dashboard/assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{  asset('/dashboard/assets/css/apps/invoice-preview.css') }}" rel="stylesheet" type="text/css" />
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

        <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        .navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }


        .alt-menu #content .col-right {
            position: fixed;
            top: 0;
            width: 310px;
            right: -380px;
            border-radius: 0;
            z-index: 1029!important;
            transition: .3s ease all;
            width: 348px;
        }
        .alt-menu #content .col-right.show {
            right: 0;
        }
        .alt-menu.admin-header .toggle-notification-bar {
            display: block;
            cursor: pointer;
        }
        .alt-menu.overlay.show {
            display: block;
            opacity: .7;
        }
        .alt-menu.admin-header .toggle-notification-bar svg {
            width: 19px;
            height: 19px;
            stroke-width: 1.6px;
        }
        .alt-menu .col-right-content .col-right-content-container {
            position: relative;
            height: calc(100vh - 92px);
            padding: 0 0 0 0;
        }

        #content .col-left {
            margin-right: 0;
        }

        @media (max-width: 399px) {
            .alt-menu .col-right-content .col-right-content-container {
                padding-right: 15px;
            }
        }

        /*
            Just for demo purpose ---- Remove it.
        */
        /*<starter kit design>*/

        .widget-one {

        }
        .widget-one h6 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0px;
            margin-bottom: 22px;
        }
        .widget-one p {
            font-size: 15px;
            margin-bottom: 0;
        }

    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link class='remove' href="{{  asset('/dashboard/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" class="dashboard-analytics" />

    <link href="{{  asset('/dashboard/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('/dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />

    
    
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer ></script>
    

    <link rel="stylesheet" type="text/css" href="{{  asset('/dashboard/plugins/table/datatable/datatables.css') }}"> 
    <!-- <link rel="stylesheet" id="table" class='remove' type="text/css" href="{{  asset('/dashboard/plugins/table/datatable/dt-global_style.css') }}">  -->
    
    
    @routes
  </head>
  <body class="sidebar-noneoverflow starterkit admin-header alt-menu">

  @inertia
  <script src="{{  asset('/dashboard/assets/js/libs/jquery-3.1.1.min.js') }}"> </script>
  <script>
  @auth
    window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
  @else
    window.Permissions = [];
  @endauth
</script>
</body>
</html>
    
    <script src="{{  asset('/dashboard/bootstrap/js/popper.min.js') }}"></script>
    
    <!-- <script src="{{  asset('/dashboard/bootstrap/js/bootstrap.min.js') }}"></script> -->
    <script src="{{  asset('/dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{  asset('/dashboard/assets/js/app.js') }}"></script>

    <script src="{{ asset('/dashboard/assets/js/custom.js') }}"></script>
    <!--END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{  asset('/dashboard/assets/js/dashboard/dash_2.js') }}"></script>
    <script src="{{  asset('/dashboard/plugins/highlight/highlight.pack.js') }}"></script>
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{  asset('/dashboard/assets/js/scrollspyNav.js') }}"></script>
    <!-- <script src="{{  asset('/dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{  asset('/dashboard/plugins/select2/custom-select2.js') }}"></script> -->

    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- <script src="{{  asset('/dashboard/plugins/table/datatable/datatables.js') }}" defer></script> -->

        <script >
        $(document).ready(function() {
            App.init();
            $('#load_screen').remove();

      });
      

    </script>

