<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SB Admin - Start Bootstrap Template</title>
        <!-- Bootstrap core CSS-->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom fonts for this template-->
          <link href="{{asset('js/font-awesome/css/all.css')}}" rel="stylesheet">
        <!-- <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">--> 
        <!-- Page level plugin CSS-->
        @yield('css')
       
        <!-- Custom styles for this template-->
        <link href="{{asset('adminstyle/css/sb-admin.css')}}" rel="stylesheet">
    </head>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">


        @include('layoutsdashboard/header')

        <div class="content-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @include('layoutsdashboard/footer')
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('js/font-awesome/js/all.js')}}"></script>
        <script src="{{asset('js/jquery-easing/jquery.easing.min.js')}}"></script>
        <!-- Page level plugin JavaScript-->
        <!-- Custom scripts for all pages-->
        <script src="{{asset('adminstyle/js/sb-admin.js')}}"></script>
        <!-- Custom scripts for this page-->
        @yield('js')
        </div>
    </body>

</html>