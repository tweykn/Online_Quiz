<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>Online Quiz</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><img src="assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
              <div class="panel-body">
                <div class="form-login" method="post" id="login-form">
<div id="error">
</div>
<div class="form-group">
<input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
<span id="check-e"></span>
</div>
<div class="form-group">
<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
</div>

                        <div class="be-radio inline">
                          <input type="radio" checked="" name="rad3" id="rad6">
                          <label for="rad6">Professor</label>
                        </div>
                        <div class="be-radio inline">
                          <input type="radio" checked="" name="rad3" id="rad7">
                          <label for="rad7">Student</label>
                        </div>

<hr />
<div class="form-group row login-tools">
  <div class="col-xs-6 login-remember">
    <div class="be-checkbox">
      <input type="checkbox" id="remember">
      <label for="remember">Remember Me</label>
    </div>
  </div>
  <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>
</div>
<div class="form-group">
  <div class="col-xs-6">
    <button data-dismiss="modal" onclick="window.location='/Register.php'" type="submit" class="btn btn-default btn-xl">Register</button>
  </div>
<button type="button" class="btn btn-primary btn-xl pull-right" name="login_button" onclick="Login();">
<span class="glyphicon glyphicon-log-in"></span>   Sign In
</button>
</div>
</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">

function  Login(){
  var data = $("#login-form").serialize();
var userType = (document.getElementById('rad6').checked?0:1);

  $.ajax({
  type : 'POST',
  url : 'loginMethod.php',
  data : {
                  username: $("#user_email").val(),
                  password: $("#password").val(),
                  userType: userType
              },
  beforeSend: function(){
  $("#error").fadeOut();
  $("#login_button").html('<span class="glyphicon glyphicon-transfer"></span>   sending ...');
  },
  success : function(response){
  if(response=="ok"){
  $("#login_button").html('<img src="ajax-loader.gif" />   Signing In ...');
  setTimeout(' window.location.href = "home.php"; ',100);
  } else {
  $("#error").fadeIn(1000, function(){
  $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response+'<br/> E-Mail or Password wrong</div>');
  $("#login_button").html('<span class="glyphicon glyphicon-log-in"></span>   Sign In');
  });
  }
  }
  });
}



    </script>
  </body>
</html>
