<html style="height: auto;"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="token" name="token" content="{{ csrf_token() }}">
  <title>SOERJA TRAVEL</title>
  <meta id="token" name="token" content="KanZWMjqMEVSYwhtdikjG8xVciPV5hDyXiIawH2U">
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
  <link rel="stylesheet" href="/css/slider.css">

  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- ADMIN -->
  <style>
  .hoverbtn {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 20px;
    
}  
  </style>

<!-- END ADMIN -->

<style type="text/css">
  div:hover > p{
  display:block;

}

p{
  display: none;  
  height:100%;
  width:100%;
  background-color: white;
  position:absolute;
  top:0;
  left:0;
  padding:30% 0 0;
  margin:0;
  cursor: pointer;
  opacity: 0.4;
}

.p2{
  display: none;  
  height:100%;
  width:100%;
  background-color: white;
  top:0;
  left:0;
  padding:30% 0 0;
  margin:0;
  cursor: pointer;
  opacity: 0.4;
}

.fadeout{
  opacity: 0 !important;
}


</style>

  <style>
.all {
    box-sizing: border-box;
}

.top-left {
    position: absolute;
    top: 8px;
    left: 16px;
    font-size: 32px;
    font-weight: bold;
}

.top-left2 {
    position: absolute;
    top: 48px;
    left: 16px;
    font-size: 20px;
   
}

.bottom-right {
    position: absolute;
    bottom: 8px;
    right: 16px;
}
.container2 {
    position: relative;
    text-align: center;
    color: white;
}

.all-row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
    -ms-flex: 25%; /* IE10 */
    flex: 25%;
    max-width: 100%;
    padding: 0 4px;
}

.column img {
    margin-top: 8px;
    vertical-align: middle;
}



/* Responsive layout - makes a two column-layout instead of four columns */
@media (max-width: 800px) {
    .column {
        -ms-flex: 50%;
        flex: 50%;
        max-width: 50%;
    }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .column {
        -ms-flex: 100%;
        flex: 100%;
        max-width: 100%;
    }
}
</style>




  <style>
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}

div.asd:hover {
    border: 2px solid #db4939;
    cursor: pointer;
    width: auto;
    height: 32%;
   }

   div.asd2:hover {
    border: 1px solid #777;
    margin-bottom:25px;
    width: auto;
    height: 32%;
   }

div.asd img {
    width: 100%;
    height: 150px;
}

div.aho {

    width: ;
    height: 185px;
    text-align: left;
    line-height: 1.3em;
}

div.asd2 img {
    width: 100%;
    height: 15%;
    margin-top: 10px;
    
}

div.desc {
    padding: 15px;
    text-align: center;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/bootstrap.min.js"></script>



</head>
<body class="skin-red-light  sidebar-collapse" style="height: auto;">
<div class="wrapper" style="height: auto;">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Soerja</b>Travel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <div class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      
      <a href="#" class="navbar-brand">
            <b></b>  
           
      </a>
      
<!-- ##################################################### -->

   <div class="navbar-custom-menu">
        <div  class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#login-data">
              
             <b>Login</b>
            </a>
        
          </li>
        </div>
      </div>

<!-- ##################################################### -->



    </div>  



  </header>
  <!-- Left side column. contains the logo and sidebar -->


<!-- Modal Tambah Data -->
        <div class="modal fade" id="login-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div id="login">
                <form method="post" @submit.prevent="cekLogin">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-name" id="myModalLabel">Login</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" class="form-control" placeholder="Username" v-model="dataLogin.username">
                        
                </div>
                <div class="form-group">
                   <input type="password" class="form-control" placeholder="Password" v-model="dataLogin.password">
                   
                </div>
               
                
              </div>
              <div class="modal-footer">
              
                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
              
              </form>
              <a href="reg" class="btn btn-success btn-block btn-flat">Register</a>
                <br><br>
           
                <div class="pull-left">
                 <a href='password/reset'>I forgot my password</a><br>
    
                </div>
            </div>

               
                
               
              
     
                
              </div>
            </div>
          </div>
        </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 741px;">
    <!-- Content Header (Page header) -->

    <br>
   
  <section class="content">
    @yield('content')
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Nagharib Tech</b> 
    </div>
    <strong>Copyright © 2018 <a href="#">Nagharib Tech</a>.</strong> All rights
    reserved.  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<!-- ./wrapper -->

<script type="text/javascript" src="/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.2.1/vue-resource.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>
<script>  var base_url = "http://127.0.0.1:8000";</script>
<script>
	var dash = new Vue({
		el : '#dashboard',
		data : {
			dataEdit: {'user': []}
		},
		methods : {
			ambilBerita:function(id){
				axios.get(base_url+'/admin/berita/'+id).then(response => {
					this.dataEdit = response.data;
				}).catch(errors => {

				})
				$("#edit-data").modal('show');
			}
		}
	})
</script>

<!-- LOGIN -->

<script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
</script>

<script>

  $(function () {
    var login = new Vue({
      el : "#login",
      data : {
        dataLogin : {},
        loginAlert: false,
      },
      methods: {
        cekLogin:function(){
          var input = this.dataLogin;
          axios.post('/ceklogin',input).then(response => {
            if(response.data){
              window.location.href = response.data;
            } else {
              this.loginAlert = true; 
            }
          }).catch(errors => {
            console.error(errors);
          })
        }
      }
    });
  });

$('.hoverme').hover(
     function(){ $('.hover').addClass('fadeout') },
     function(){ $('.hover').removeClass('fadeout') }
)

</script>
</body></html>