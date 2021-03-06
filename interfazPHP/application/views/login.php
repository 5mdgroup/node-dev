<?php echo $head;?>
<style>
	.login-page{
		background-image: url('<?php echo base_url('images/One-Minute-Chores.png');?>');
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url('inicio')?>" style="text-shadow: 2px 2px 2px #A5A5A5;"><b>Login Task Manager</b>1.0</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="border-radius: 5px;box-shadow: 0px 3px 15px black;">
    <p class="login-box-msg"><?php if(isset($message)){echo $message;}else{echo "Introduce tus datos para ingresar al sistema";}?></p>

    <form action="<?php echo site_url('inicio/ingresoUsuario');?>" method="post" id="login_form">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="user">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pwr">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <span id="message"></span> 
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" ><span style="padding-right:15px;"> Ingresar </span> <div style="margin-left:-15px;display:inline-block;"><i id="login_loader" style="display:none;"  class="fa fa-spinner fa-pulse fa-fw"></i></div></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">Olvide mi clave</a><br>
    <a href="register.html" class="text-center">Registrarse</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('resources');?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('resources');?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('resources');?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    $("#login_form").submit((e)=>{
      e.preventDefault();
      $.ajax({
        method: "POST",
        url: "<?php echo site_url('ajax_process/login')?>",
        data: $("#login_form").serialize(),
        beforeSend : function(){$("#login_loader").fadeIn();}
      }).done(function( msg ) {
         $("#login_loader").fadeOut('slow');
         r = JSON.parse( msg );
         if( r.code == 400 ){
            showMessage('Datos incorrectos');
         }else{
            window.location.replace('<?=site_url('taskManager')?>');
         }
         console.log(r);

      });
    })

  });
  function showMessage(message){
    var mcont = document.getElementById('message');
    mcont.innerHTML = message;
    setTimeout(() => {mcont.innerHTML = '';}, 5000);
  }
</script>
</body>
</html>
