@extends('layouts.base')

@section('content')



<section id="signup" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">

                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">Forgot your password?</h2>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form class="form-inline d-flex"  role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address..."  name="emails" value="{{ old('email') }}">
                   
                    <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
                </form>
                 @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
            </div>
        </div>
    </div>
</section>


@endsection
