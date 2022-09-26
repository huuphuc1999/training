<!DOCTYPE html>
<html lang="en">
  <head>
   @include('backend.layouts.head')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form  id="loginForm"  method="POST" action="{{ route('login') }}">
              @csrf
              <h1><img style="height: 160px" src="{{asset('backend/images/logorcvn.png')}}" alt="Logo"></h1>
              <div>
                <input id="email" placeholder="Username" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
              </div>
              <div>
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
              <div>
                <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
              </button>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw"></i> River Crane!</h1>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>