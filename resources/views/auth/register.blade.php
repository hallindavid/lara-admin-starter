@extends('layouts.external')

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
            <center><img src="{{ asset('images/icon.png') }}" width="90px"/></center>
        <p class="login-box-msg">{{ __('Register For Plan To Crush') }}</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="{{ __('First Name') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" placeholder="{{ __('Last Name') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus placeholder="{{ __('First Name') }}">
                                        <option value="" disabled selected>Country</option>
                                        <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <select type="text" id="state" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state" placeholder="{{ __('Last Name') }}">
                                        <option disabled selected value="">State</option>
                                        <optgroup label="U.S. States/Territories">
                                            <option value="AK" {{ old('state') == 'AK' ? 'selected' : '' }}>Alaska</option>
                                            <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alabama</option>
                                            <option value="AR" {{ old('state') == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                            <option value="AZ" {{ old('state') == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                            <option value="CA" {{ old('state') == 'CA' ? 'selected' : '' }}>California</option>
                                            <option value="CO" {{ old('state') == 'CO' ? 'selected' : '' }}>Colorado</option>
                                            <option value="CT" {{ old('state') == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                            <option value="DC" {{ old('state') == 'DC' ? 'selected' : '' }}>District of Columbia</option>
                                            <option value="DE" {{ old('state') == 'DE' ? 'selected' : '' }}>Delaware</option>
                                            <option value="FL" {{ old('state') == 'FL' ? 'selected' : '' }}>Florida</option>
                                            <option value="GA" {{ old('state') == 'GA' ? 'selected' : '' }}>Georgia</option>
                                            <option value="HI" {{ old('state') == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                            <option value="IA" {{ old('state') == 'IA' ? 'selected' : '' }}>Iowa</option>
                                            <option value="ID" {{ old('state') == 'ID' ? 'selected' : '' }}>Idaho</option>
                                            <option value="IL" {{ old('state') == 'IL' ? 'selected' : '' }}>Illinois</option>
                                            <option value="IN" {{ old('state') == 'IN' ? 'selected' : '' }}>Indiana</option>
                                            <option value="KS" {{ old('state') == 'KS' ? 'selected' : '' }}>Kansas</option>
                                            <option value="KY" {{ old('state') == 'KY' ? 'selected' : '' }}>Kentucky</option>
                                            <option value="LA" {{ old('state') == 'LA' ? 'selected' : '' }}>Louisiana</option>
                                            <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                                            <option value="MD" {{ old('state') == 'MD' ? 'selected' : '' }}>Maryland</option>
                                            <option value="ME" {{ old('state') == 'ME' ? 'selected' : '' }}>Maine</option>
                                            <option value="MI" {{ old('state') == 'MI' ? 'selected' : '' }}>Michigan</option>
                                            <option value="MN" {{ old('state') == 'MN' ? 'selected' : '' }}>Minnesota</option>
                                            <option value="MO" {{ old('state') == 'MO' ? 'selected' : '' }}>Missouri</option>
                                            <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mississippi</option>
                                            <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Montana</option>
                                            <option value="NC" {{ old('state') == 'NC' ? 'selected' : '' }}>North Carolina</option>
                                            <option value="ND" {{ old('state') == 'ND' ? 'selected' : '' }}>North Dakota</option>
                                            <option value="NE" {{ old('state') == 'NE' ? 'selected' : '' }}>Nebraska</option>
                                            <option value="NH" {{ old('state') == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                                            <option value="NJ" {{ old('state') == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                                            <option value="NM" {{ old('state') == 'NM' ? 'selected' : '' }}>New Mexico</option>
                                            <option value="NV" {{ old('state') == 'NV' ? 'selected' : '' }}>Nevada</option>
                                            <option value="NY" {{ old('state') == 'NY' ? 'selected' : '' }}>New York</option>
                                            <option value="OH" {{ old('state') == 'OH' ? 'selected' : '' }}>Ohio</option>
                                            <option value="OK" {{ old('state') == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                                            <option value="OR" {{ old('state') == 'OR' ? 'selected' : '' }}>Oregon</option>
                                            <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                                            <option value="PR" {{ old('state') == 'PR' ? 'selected' : '' }}>Puerto Rico</option>
                                            <option value="RI" {{ old('state') == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                                            <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>South Carolina</option>
                                            <option value="SD" {{ old('state') == 'SD' ? 'selected' : '' }}>South Dakota</option>
                                            <option value="TN" {{ old('state') == 'TN' ? 'selected' : '' }}>Tennessee</option>
                                            <option value="TX" {{ old('state') == 'TX' ? 'selected' : '' }}>Texas</option>
                                            <option value="UT" {{ old('state') == 'UT' ? 'selected' : '' }}>Utah</option>
                                            <option value="VA" {{ old('state') == 'VA' ? 'selected' : '' }}>Virginia</option>
                                            <option value="VT" {{ old('state') == 'VT' ? 'selected' : '' }}>Vermont</option>
                                            <option value="WA" {{ old('state') == 'WA' ? 'selected' : '' }}>Washington</option>
                                            <option value="WI" {{ old('state') == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                                            <option value="WV" {{ old('state') == 'WV' ? 'selected' : '' }}>West Virginia</option>
                                            <option value="WY" {{ old('state') == 'WY' ? 'selected' : '' }}>Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Canadian Provinces">
                                            <option value="AB" {{ old('state') == 'AB' ? 'selected' : '' }}>Alberta</option>
                                            <option value="BC" {{ old('state') == 'BC' ? 'selected' : '' }}>British Columbia</option>
                                            <option value="MB" {{ old('state') == 'MB' ? 'selected' : '' }}>Manitoba</option>
                                            <option value="NB" {{ old('state') == 'NB' ? 'selected' : '' }}>New Brunswick</option>
                                            <option value="NF" {{ old('state') == 'NF' ? 'selected' : '' }}>Newfoundland</option>
                                            <option value="NT" {{ old('state') == 'NT' ? 'selected' : '' }}>Northwest Territories</option>
                                            <option value="NS" {{ old('state') == 'NS' ? 'selected' : '' }}>Nova Scotia</option>
                                            <option value="NU" {{ old('state') == 'NU' ? 'selected' : '' }}>Nunavut</option>
                                            <option value="ON" {{ old('state') == 'ON' ? 'selected' : '' }}>Ontario</option>
                                            <option value="PE" {{ old('state') == 'PE' ? 'selected' : '' }}>Prince Edward Island</option>
                                            <option value="QC" {{ old('state') == 'QC' ? 'selected' : '' }}>Quebec</option>
                                            <option value="SK" {{ old('state') == 'SK' ? 'selected' : '' }}>Saskatchewan</option>
                                            <option value="YT" {{ old('state') == 'YT' ? 'selected' : '' }}>Yukon Territory</option>
                                        </optgroup>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <select type="timezone" name="timezone" id="timezone" class="form-control @error('timezone') is-invalid @enderror" value="{{ old('timezone') }}" required autocomplete="timezone">
                                <option value="" disabled selected>Timezone</option>
                                <option value="America/Anchorage" {{ old('timezone') == 'America/Anchorage' ? 'selected' : '' }} selected>Alaska Time (AKST/AKDT)</option>
                                <option value="America/Halifax" {{ old('timezone') == 'America/Halifax' ? 'selected' : '' }} selected>Atlantic Time (AST/ADT)</option>
                                <option value="America/Winnipeg" {{ old('timezone') == 'America/Winnipeg' ? 'selected' : '' }} selected>Central Time (CST/CDT)</option>
                                <option value="America/Toronto" {{ old('timezone') == 'America/Toronto' ? 'selected' : '' }} selected>Eastern Time (EST/EDT)</option>
                                <option value="America/Adak" {{ old('timezone') == 'America/Adak' ? 'selected' : '' }} selected>Hawaii Time (HAST/HADT)</option>                                
                                <option value="America/Edmonton"{{ old('timezone') == 'America/Edmonton' ? 'selected' : '' }}  selected>Mountain Time (MST/MDT)</option>
                                <option value="America/St_Johns" {{ old('timezone') == 'America/St_Johns' ? 'selected' : '' }} selected>Newfoundland Time (NST/NDT)</option>
                                <option value="America/Vancouver" {{ old('timezone') == 'America/Vancouver' ? 'selected' : '' }} selected>Pacific Time (PST/PDT)</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('timezone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">
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

                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="off" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <!-- col -->
                            <div class="col-6 pt-2">
                                    <a href="{{ route('login') }}">{{ __('Already Registered?') }}</a>
                            </div>
                            <!-- /.col -->
                            <!-- col -->
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

        </div><!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection
