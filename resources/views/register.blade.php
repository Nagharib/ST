<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nagharib | House</title>
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


</head>
<body class="hold-transition login-page">
<div class="login-box" id="login">
  <div class="login-logo">
    <a href="#"><b>Nagharib</b>House</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign up to start your session</p>
      <form method="post" action='/regins'>
        {{ csrf_field()}}
          <div class="form-group has-feedback">
            <input type='text' name='name' class='form-control' required placeholder='Insert Your name here..!'>
         

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type='tel' name='no_telp' class='form-control' required placeholder='Insert Phone Number Here..!'>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type='email' name='email' class='form-control' required placeholder='Insert Email Here..!'>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type='text' name='username' class='form-control' required placeholder='Insert Username Here..!'>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type='password' name='password' class='form-control' required placeholder='Insert Password Here..!'>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

               
		  <div class="form-group has-feedback">
			<button class='btn btn-sm btn-primary'>Sign Up</button>
          </div>
		  
      </form>
		<div id="app">
		  
		</div>
    </div> 
  </div>  
 

<!--     <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

<!--     <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
 -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->

<script src="/js/app.js"></script>
</body>
<script>
function app
</script>
</html>
