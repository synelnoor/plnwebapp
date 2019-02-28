<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ isset($appName) ? $appName : 'PLN' }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins//font-awesome/css/font-awesome.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/ionicons/v2/css/ionicons.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/_all.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('vendor/adminlte/plugins/html5shiv/html5shiv.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/respond/respond.min.js') }}"></script>
    <![endif]-->
    <style type="text/css">
        


        .left {
           /* background-color: aqua;  */
        background-image:  linear-gradient(rgba(63, 191, 191, 0.5), rgba(255, 255, 0, 0.5)),
                           url('img/pln/vintage-wedding-venue-1-2.png');      }
        }
        .right {
          background-color: #F3F5F7; 
        }

        .main-wrapper {
          height: 100vh;  
        }

        .section {
          height: 100%;  
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
        }
        .section h4{
             font-size: 48px;
        }
        .section p{
             font-size: 24px;
        }
        .l-align{
           /* justify-content: center;*/
          align-items: left;
        }

       
    </style>

</head>
<body>
<div class="main-wrapper">
    <div class="section left col-md-6" >
        <div class="login-logo">
            
            <a href="#">
                <img src="{{asset('img/pln/Group.png')}}" style="width:100%; heigth:auto"/>
            </a>
        </div>
    </div>
    <div class="section right col-md-6 ">
        <div class="col-md-10 l-align">
        <h4>SELAMAT DATANG.</h4>
        <p>Monitoring Pengisian Bahan Bakar Minyak </p>
        <form method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-danger btn-block btn-flat">Log In</button>
                </div>
                <!-- /.col -->
            </div>
            <label>jika tidak terdaftar,mohon hubungi admin</label>
        </form>

        </div>
        

    </div>
</div>

<script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
