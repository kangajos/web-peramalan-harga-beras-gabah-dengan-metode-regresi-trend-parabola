<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js')}}" lang=" en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PT. Pertani | LOGIN</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{url('template-admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{url('template-admin/vendors/jqvmap/dist/jqvmap.min.css')}}">


    <link rel="stylesheet" href="{{url('template-admin/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="bg-dark">


<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    {{--                    <img class="align-content" src="{{url("template-admin/images/logo.png")}}" alt="">--}}
                    <h3>ADMIN LOGIN</h3>
                    <br><br>
                </a>
            </div>
            <div class="login-form">
                @if(Session::has('msg'))
                    <div class="alert alert-danger">{!! Session::get('msg') !!}</div>
                @endif
                <form method="post" action="{{route("auth_check")}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
{{--                    <div class="checkbox">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox"> Remember Me--}}
{{--                        </label>--}}
{{--                        <label class="pull-right">--}}
{{--                            <a href="#">Forgotten Password?</a>--}}
{{--                        </label>--}}

{{--                    </div>--}}
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    <div class="register-link m-t-15 text-center">
{{--                        <p>Don't have account ? <a href="#"> Sign Up Here</a></p>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{url('template-admin/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('template-admin/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{url('template-admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('template-admin/assets/js/main.js')}}"></script>

</body>
</html>
