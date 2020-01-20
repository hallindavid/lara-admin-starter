@extends('layouts.external')

@section('content')

<div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
                <center><img src="{{ asset('images/icon.png') }}" width="90px"/></center>
            <p class="login-box-msg">Reset Password</p>
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-3 float-left">
                        <a href="{{ route('login') }}">{{ __('Go Back') }}</a>
                </div>
                <div class="col-lg-8 float-right">
                        <button type="submit" class="btn btn-primary btn-block ">{{ __('Reset My Password') }}</button>
                </div>
            </form>

          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
      <!-- /.login-box -->

@endsection
