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

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link href="{{  asset('/dashboard/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" class="dashboard-analytics" />

    <link href="{{  asset('/dashboard/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('/dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />

    <!-- <link href="{{  asset('/dashboard/assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" /> -->
    

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer ></script>

    <link rel="stylesheet" type="text/css" href="{{  asset('/dashboard/plugins/table/datatable/datatables.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{  asset('/dashboard/plugins/table/datatable/dt-global_style.css') }}"> -->

    @routes
  </head>
  <body class="dashboard-sales admin-header">

  @inertia
  <script src="{{  asset('/dashboard/assets/js/libs/jquery-3.1.1.min.js') }}"> </script>
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
    <script src="{{  asset('/dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{  asset('/dashboard/plugins/select2/custom-select2.js') }}"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{  asset('/dashboard/plugins/table/datatable/datatables.js') }}" defer></script>

        <script >
        $(document).ready(function() {
            App.init();
            $('#load_screen').remove();

       
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });

      });

    </script>

