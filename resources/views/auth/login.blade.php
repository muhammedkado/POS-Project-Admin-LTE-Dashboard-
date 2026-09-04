@extends('layouts.app')

@section('title', __('Sign in'))

@section('content')
    <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

    <div class="callout callout-info" style="margin-bottom:18px">
        <p style="margin:0 0 6px;font-weight:600">{{ __('Demo accounts') }} <small>({{ __('password is the same for all') }}: <code>password</code>)</small></p>
        <div style="display:flex;flex-wrap:wrap;gap:6px">
            <button type="button" class="btn btn-xs btn-default demo-fill" data-email="superadmin@app.com">superadmin@app.com</button>
            <button type="button" class="btn btn-xs btn-default demo-fill" data-email="admin@app.com">admin@app.com</button>
            <button type="button" class="btn btn-xs btn-default demo-fill" data-email="user@app.com">user@app.com</button>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group has-feedback @error('email') has-error @enderror">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autocomplete="email" autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group has-feedback @error('password') has-error @enderror">
            <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @error('password')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>
            </div>
        </div>
    </form>

    <p style="margin-top:12px;color:#777;font-size:12px">
        {{ __('This is a live public demo. Data resets every night.') }}
        <a href="https://github.com/muhammedkado/POS-Project-Admin-LTE-Dashboard-" target="_blank" rel="noopener">{{ __('View source on GitHub') }}</a>
    </p>

    <script>
        document.querySelectorAll('.demo-fill').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('email').value = btn.dataset.email;
                document.getElementById('password').value = 'password';
            });
        });
    </script>
@endsection
