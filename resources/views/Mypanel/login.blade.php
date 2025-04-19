@extends('Frontend.Layout.master')

@section('content')
    <div class="row login_form"><br>
        <h4 class="text-center lead">Please sign in</h4>
        <form method="POST" action="{{ url('mypanel/login') }}">
            @csrf
            <div class="col-md-4"></div>
            <div class="col-md-4 login_">
                <div class="row">
                    <label for="email">Email</label>
                    <input id="email" type="email" placeholder="Enter your email address..." class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div><br>
                <div class="row">
                    <label for="password">Password</label>
                    <input id="password" type="password" placeholder="Enter your password..." class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="remember">
                                <p class="">
                                    &nbsp;<a href="forgot-password.html">I forgot my password</a>
                                </p>
                            </label>
                        </div>
                </div>
                <div class="row">
                        <button type="submit" class="btn btn-warning">Sign In</button>
                </div>

            </div>
            <div class="col-md-4"></div>
        </form>

    </div>



@endsection

@section("style")
<style type="text/css">
.login_{
    border: 1px solid orange;
    padding: 60px;

}
.login_form{
    margin-bottom: 60px;
}

</style>
@endsection