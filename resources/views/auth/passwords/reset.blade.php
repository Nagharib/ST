<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <meta id="token" name="token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/css/app.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
<div class="login-box" id="login">
  <div class="login-logo">
    <a href="../../index2.html"><b>Nagharib</b>House</a>
  </div>

<div class="login-box-body">
 @if (session('status'))
    <div class="alert alert-success">
            {{ session('status') }}
    </div>
 @endif   
<p class="login-box-msg">Reset Password</p>    
<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
{{ csrf_field() }}
<input type="hidden" name="token" value="{{ $token }}">
<div class="form-group has-feedback">
<div class="col-md-12">
        <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ $email or old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </span>
</div>    
</div> 

<div class="form-group has-feedback">
<div class="col-md-12">
        <input id="password" type="password" class="form-control" name="password" placeholder="New Password"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    
</div>    
</div>  

<div class="form-group has-feedback">
<div class="col-md-12">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    
</div>    
</div>

<div class="row">
<div class="col-xs-7">
  <div class="checkbox">
    <label>
     
    </label>
  </div>
</div>
        
<!-- /.col -->
<div class="col-xs-4">
  <button type="submit" class="btn btn-primary">Reset Password</button>
</div>

<!-- /.col -->
</div>                  
</form>
             
</div>
</div>
</body>
</html>
