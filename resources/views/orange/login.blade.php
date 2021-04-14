<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->


</head>

<body>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log To Alforsan Service</div>
            <div class="panel-body">
                @include("orange/alerts")
                {!! Form::open(['url'=> route("orange.login.submit")]) !!}
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="User Name" name="user_name" type="text"  value="{{ old('user_name') }}">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                        </div>
                    </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
</body>
