@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="max-width: 380px; margin-top:100px; margin-bottom: 40px;">
    <div class="card-body">
        <h4 class="card-title mb-4">Sign in</h4>
        <form action="{{ route('login') }}" method="post">
            @csrf
                <a href="{{ route('fb.login') }}" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp;  Sign in with Facebook</a>
                <a href="#" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp;  Sign in with Google</a>
              
            <div class="form-group">
                <input id="email" type="email" placeholder="E-Mail Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                @if (Route::has('password.request'))
                    <a class="float-right" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <label class="float-left custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <div class="custom-control-label"> {{ __('Remember Me') }} </div>
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Login  </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.fbAsyncInit = function() {
    FB.init({
        appId      : '516715172545767',
        cookie     : true,
        xfbml      : true,
        version    : '46e28b1302e9c0d8aac10ed3d73c1438'
    });
    
    FB.AppEvents.logPageView();
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@endsection