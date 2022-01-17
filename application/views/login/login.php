<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>webroot/plugins/fontawesome-free/css/all.min.css">

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url()?>webroot/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>webroot/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    label.error {
        color: red;
        font-size: 16px;
        font-style: italic;
        display: block;
        margin-top: 3px;
        font-weight: normal!important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>
       <?php echo $this->session->flashdata('login_error'); ?>
      <form action="<?php echo base_url();?>Login/login_user" method="post" id="loginform">
        <div class="form-group mb-3">
          <label>Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Username">
          <span class="text-danger"><?php echo form_error('username'); ?></span>
        </div>
        <div>
        </div>
        <div class="form-group mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="text-danger"><?php echo form_error('password'); ?></span>
        </div>
        <div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url()?>webroot/plugins/jquery/jquery.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url()?>webroot/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  $('#loginform').validate({
    rules: {
      username: {
        required: true,
      },
      password: {
        required: true,
      }
    },
    messages: {
      username: {
        required: "This field is required",
      },
      password: {
        required: "This field is required",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });  
</script>
</body>
</html>