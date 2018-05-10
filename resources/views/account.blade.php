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
    <p class="login-box-msg">Create New Account</p>
      <form method="post" action='addAccount/{{ $idna }}'>
        {{ csrf_field()}}
          <div class="form-group has-feedback">
            <input type='text' name='name' class='form-control' required placeholder='Insert Your Account Name here..!'>
            <input type="hidden" name="user_id" value="{{ $idna }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            <input type='text' name='address' class='form-control' required placeholder='Insert Address Here..!'>
            
            <?php
        $now            = date("Y-m-d");
        $satubulan        = mktime(0,0,0,date("n")+1,date("j"),date("Y"));
        $dateto        = date("Y-m-d", $satubulan);            
            ?>
            <input type='hidden' name='valid_dateto' class='form-control' value="<?php echo $dateto ?>" >

            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div> 

          <div class="form-group has-feedback">
            <input type='text' name='region' class='form-control' required placeholder='Insert Region Here..!'>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>                    

          <div class="form-group has-feedback">
            <input type='text' name='province' class='form-control' required placeholder='Insert Province Here..!'>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>          


          <div class="form-group has-feedback">
            <input type='tel' name='phone_number' class='form-control' required placeholder='Insert Phone Number Here..!'>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type='email' name='email' class='form-control' required placeholder='Insert Email Here..!'>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

		  <div class="form-group has-feedback">
            <input type='text' name='website' class='form-control' required placeholder='Insert Werbsite Here..!'>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

		  <div class="form-group has-feedback">
            <input type='text' name='comp_number' class='form-control' required placeholder='Insert Comp Number Here..!'>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

      <div class="form-group has-feedback">
            <input type='text' name='tax_number' class='form-control' required placeholder='Insert Tax Number Here..!'>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

             


               
		  <div class="form-group has-feedback">
			<button class='btn btn-sm btn-primary'>Add</button>
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
