<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Login  | Vibho Employee Solutions</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Vibho Employee Solutions" name="description" />
      <meta content="Vibho Employee Solutions" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/images/VIBES Final-sm.png">
      <!-- Bootstrap Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="<?php echo base_url(); ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
      <script src='https://www.google.com/recaptcha/api.js'></script>
   </head>
   <body style="background-image: url('<?php echo base_url(); ?>assets/admin/images/bg1.png'); height: 100%;">
      
      <div class="account-pages my-5 pt-5">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-8 col-lg-6 col-xl-5">
                  <div class="card">
                     <div class="bg-ss">
                        <div class="login-header-box text-primary text-center p-4">
                           <h5 class="text-white font-size-20">Welcome </h5>
                           <div class="south-africa-logo">
                           <div class="sa-logo">
                              <img src="<?php echo base_url(); ?>assets/admin/images/flags/south-africa.png"  alt="SA-logo">
                              </div>
                           <!-- <div class="sa-content">
                           <h4> South Africa</h4>
                           </div> -->
                           </div>
                           <p class="text-white">Sign in to continue to Vibho Employee Solutions</p>
                           <a href="<?php echo base_url(); ?>" class="logo logo-admin">
                           <img src="<?php echo base_url(); ?>assets/admin/images/VIBES Final.png" height="65" alt="logo">
                           </a>
                        </div>
                     </div>
                     <div class="card-body p-4 mt-4">
                         <?php if($this->session->flashdata('msg') !=''){ ?>
                           <div class="alert alert-danger mt-2 mb-0" role="alert">
                              <?php echo $this->session->flashdata('msg');?>
                           </div>
                         <?php } ?>
                        <div class="p-3">
                           <form method="post" class="form-horizontal" action="<?php echo base_url(); ?>master/check_login" name="login_formvalidation" id="login_formvalidation" />
                              <input type="hidden" name="approve_reject" id="approve_reject" value="<?php echo $approve_reject; ?>">
                              <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" class="form-control" name="username" id="username" placeholder="Enter Emp Code" autocomplete="off" onkeydown="upperCaseF(this)">
                              </div>
                              <div class="form-group">
                                 <label for="userpassword">Password</label>
                                 <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="off">
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customControlInline">
                                       <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div>
                                 </div>
                                 <div class="col-sm-6 text-right">
                                    <button class="btn btn-ss w-md waves-effect waves-light" type="submit">Log In</button>
                                 </div>
                              </div>
                              <div class="form-group mt-2 mb-0 row">
                                 <div class="col-12">
                                    <a href="<?php echo base_url(); ?>master/reset_password"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="mt-5 text-center" style="color: #fff">
                     <p class="mb-0" style="margin-top: -30px;">
                        © <script>document.write(new Date().getFullYear())</script> VIBHO - Vibho Employee Solutions
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- JAVASCRIPT -->
      <script src="<?php echo base_url(); ?>assets/admin/libs/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/metismenu/metisMenu.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/simplebar/simplebar.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/node-waves/waves.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/app.js"></script>
   </body>

<script>
$(document).ready(function() {
    $("#login_formvalidation").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }

        },
        messages: {
            username: {
                required: 'Please enter username'
            },
            password: {
                required: 'Please enter password'
            }
        },
        ignore: []
    });
    $("#forgotpassword").validate({
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Please enter username or email id'
            }
        },
        ignore: []
    });
});

</script>
<script>
function checkcaptcha()
{
        var googleResponse = $('#g-recaptcha-response').val();

    if (!googleResponse) {
        $('<p style="color:red !important" class=error-captcha"><span class="glyphicon glyphicon-remove " ></span> Please fill up the captcha.</p>" ').insertAfter("#html_element");
        return false;
    } else {
        return true;
    }
}
function upperCaseF(a)
{
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}

    $(document).ready(function()
    { 
        $(document).bind("contextmenu",function(e){
          return false;
        }); 
    })
</script>
</html>