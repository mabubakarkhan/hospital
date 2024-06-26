<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from admin.pixelstrap.com/tivo/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2024 10:42:47 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="tivo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tivo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?=IMG?>favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=IMG?>favicon/favicon.png" type="image/x-icon">
    <title><?=$page_title?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=CSS?>vendors/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>vendors/feather-icon.css">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>style.css">
    <link id="color" rel="stylesheet" href="<?=CSS?>color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?=CSS?>responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"> </div>
      <div class="dot"></div>
    </div>
    <!-- Loader ends-->
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card">
            <div>
              <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="<?=IMG?>logo/logo2.png" alt="looginpage"></a></div>
              <div class="login-main"> 
                <form class="theme-form ajaxForm" action="<?=BASEURL."login/process-login"?>">
                  <h4 class="text-center">Sign in to account</h4>
                  <p class="text-center">Enter your username & password to login</p>
                  <div class="alert alert-danger showError" style="display: none;" role="alert"></div>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" name="username" type="text" required="" placeholder="username">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********">
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Remember password</label>
                    </div>
                    <a class="link" href="javascript://">Forgot password?</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="<?=JS?>jquery-3.6.0.min.js"></script>
      <!-- Bootstrap js-->
      <script src="<?=JS?>bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="<?=JS?>icons/feather-icon/feather.min.js"></script>
      <script src="<?=JS?>icons/feather-icon/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="<?=JS?>config.js"></script>
      <!-- Template js-->
      <script src="<?=JS?>script.js"></script>
      <!-- login js-->
      <script>
      $(function(){
        $(document).on('submit', '.ajaxForm', function(event) {
          event.preventDefault();
          $form = $(this);
          $(".ajaxForm button").html('<i class="fas fa-spinner fa-spin"></i>');
          $(".showError").hide(0);
          $.post('<?=BASEURL."login/submit"?>', {data: $form.serialize()}, function(resp) {
            resp = $.parseJSON(resp);
            if (resp.status == true) {
              $(".ajaxForm button").html('Redirecting...');
              window.location.replace("<?=BASEURL.'home'?>");
            }
            else{
              $(".ajaxForm button").html('Sign in');
              $(".showError").text(resp.msg);
              $(".showError").show(0);
            }
          });
        });
      });//onload
      </script>
    </div>
  </body>

<!-- Mirrored from admin.pixelstrap.com/tivo/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2024 10:42:47 GMT -->
</html>