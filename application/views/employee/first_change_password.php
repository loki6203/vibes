<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Change Password  | Vibho Employee Solutions</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Vibho Employee Solutions" name="description" />
      <meta content="Vibho Employee Solutions" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/images/logo-sm.png">
      <!-- Bootstrap Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="<?php echo base_url(); ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
      <script src='https://www.google.com/recaptcha/api.js'></script>
   </head>
   <body style="background-image: url('<?php echo base_url();?>assets/password_img.jpg');margin: 0px !important; height: 100%; overflow: hidden">
      <div class="home-btn d-none d-sm-block"  oncontextmenu="return false;">
      </div>
      <div class="account-pages my-5 pt-5">
         <div class="container">
            <div class="row justify-content-center" style="margin-top: -60px">
               <div class="col-md-8 col-lg-10 col-xl-10">
                  <div class="card overflow-hidden" style="-webkit-box-shadow: 0 0 0px 0 rgb(236 236 241 / 44%)!important">
                     <div class="bg-ss">
                        <div class="text-primary text-center p-4">
                           <h5 class="text-white font-size-20">Create a New Password </h5>
                           <a href="#" class="logo logo-admin">
                           <img src="<?php echo base_url(); ?>assets/admin/images/VIBES_Final.png" height="50" alt="logo">
                           </a>
                        </div>
                     </div>
                     <div class="card-body p-4 mt-4">
                         <?php if($this->session->flashdata('failed') !=''){ ?>
                           <div class="alert alert-danger mt-2 mb-0" role="alert">
                              <?php echo $this->session->flashdata('failed');?>
                           </div>
                         <?php } ?>
                        <div class="p-3">
                           <form method="post" class="form-horizontal" action="<?php echo base_url(); ?>employee/update_password" name="login_formvalidation" id="login_formvalidation" />
                              <div class="form-group">
                                 <label for="username">Old Password</label>
                                 <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Old Password" autocomplete="off">
                              </div>
                              <div class="form-group">
                                 <label for="userpassword">New Password</label>
                                 <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" autocomplete="off">
                              </div>
                              <div class="form-group">
                                 <label for="userpassword">Confirm Password</label>
                                 <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" autocomplete="off">
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-6 text-right">
                                    <button class="btn btn-ss w-md waves-effect waves-light" type="submit">Submit</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
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
            old_password: {
                required: true
            },
            new_password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#new_password"
            }

        },
        messages: {
            old_password: {
                required: 'Please enter old password'
            },
            new_password: {
                required: 'Please enter new password'
            },
            confirm_password: {
                required: 'Please enter confirm password',
                equalTo: "Please enter the new password and confirm password as same"
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

    $(document).ready(function(){ 
        $(document).bind("contextmenu",function(e){
            return false;
        }); 
    })
</script>
</html>