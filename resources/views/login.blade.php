@extends('layouts.base')


@section('content')


    </header>

    <body class="login-bg">
			
		<div class="container">
			<div class="login-screen row align-items-center">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
					<div class="login-box">
											<a href="#" class="login-logo">
											<img src="{{asset('img/logo-web.png')}}" alt="Unify Admin Dashboard" />
										</a>
										<div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Bienvenido</h5>
                        
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input class="form-control"  type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input class="form-control"  type="password" placeholder="Password"  name="password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <button class="btn btn-primary btn-block" type="submit">
                                Inicia sesión
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }}>Recordar contraseña</label>
                            </div>
                        </div> <div class="form-group">                     
                        <a class="d-block small mt-3" href="#"  data-toggle="modal" data-target="#registerModal">Crear cuenta</a>
                        <a class="d-block small" href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                </div>
									</div>
								</div>
								<div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
									<div class="login-slider"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<footer class="main-footer no-bdr fixed-btm">
			<div class="container">
				Comisión Colombiana de recursos y reservas.
			</div>
		</footer>
	</body>


@endsection

@section('javascript')

@endsection