<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>247ureport | Login Page</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-v3.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/maruti-login.css') }}" />
    <style>
        body {
            background-image: url({{ asset('images/in-background.jpg' )}});
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row"> 
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
                <div class="panel panel-body">
                    <center><img src="{{ asset('images/logo.png') }}" alt="logo" class="img-responsive"></center><br/>
                    <form method="POST" action="{{ route('login') }}">{{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Login</button>
                            <center><a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a></center>
                        </div>
                    </form>
                </div>
                <center>
                    <p>&copy; 2017. <a href="{{ config('constants.WEB_URL') }}" target="_blank">{{ config('constants.COMPANY_NAME') }}</a>.</p>
                </center>
            </div>
        </div>
    </div>
</body>
</html>
