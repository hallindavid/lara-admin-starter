@extends('layouts.external')

@section('title','Change Password')
@section('content')
<div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Change your Password</p>
                <form method="POST" action="{{ route('store_password') }}">
                @csrf


                <div class="input-group mb-3">
                        <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required autocomplete="current-password" placeholder="Current Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                <div class="input-group mb-3">
                    <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required autocomplete="new-password" placeholder="New Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="password-co4nfirm" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" required autocomplete="off" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <!-- col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Change Password') }}</button>
                    </div>
                    <!-- /.col -->
                </div>



    </form>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

@endsection
