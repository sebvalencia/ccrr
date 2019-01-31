<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{asset('css/grayscale.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('fonts/icomoon/icomoon.css')}}" />

		<!-- Mian and Login css -->
		<link rel="stylesheet" href="{{asset('css/main.css')}}" />

    </head>

    <body id="page-top">

        @yield('content')


        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control"  type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="exampleInputPassword1">Password</label>
                                <input class="form-control"  type="password" placeholder="Password"  name="password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <button class="btn btn-primary btn-block" type="submit">
                                Login
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Password</label>
                            </div>
                        </div> <div class="form-group">                     
                        <a class="d-block small mt-3" href="#"  data-toggle="modal" data-target="#registerModal">Register an Account</a>
                        <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="exampleInputName">Nombre</label>
                                        <input class="form-control" type="text" aria-describedby="nameHelp" placeholder="Ingresa tu nombre" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="exampleInputEmail1">Email</label>
                                <input class="form-control" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword1">Contraseña</label>
                                        <input class="form-control" type="password" placeholder="Password" name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleConfirmPassword">Confirmar constraseña</label>
                                        <input class="form-control"  type="password" placeholder="Confirm password"  name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary  btn-block">
                                Registrar
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Password</label>
                            </div>
                        </div> <div class="form-group">                     
                        <a class="d-block small mt-3" href="#"  data-toggle="modal" data-target="#loginModal">login</a>
                        <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </body>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{asset('js/font-awesome/js/all.js')}}"></script>
    <script src="{{asset('js/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{asset('js/grayscale.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
	
	@yield('javascript')
	
    <script>

        @if ($errors->has('password') || $errors->has('email'))
        $('#loginModal').modal();
        @endif


        $('#registerModal').on('shown.bs.modal', function (e) {
            $('#loginModal').modal('hide');
        })
        
          $('#loginModal').on('shown.bs.modal', function (e) {
            $('#registerModal').modal('hide');
        })

    </script>


</html>