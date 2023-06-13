<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>::Vibho Employee Solutions::</title>
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
   </head>
   <body style="background-image: url('<?php echo base_url();?>assets/admin/images/bg1.png');margin: 0px !important; height: 100%; overflow: hidden">
      <div class="account-pages my-5 pt-5">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-8 col-lg-6 col-xl-5">
                  <div class="card overflow-hidden" style="-webkit-box-shadow: 0 0 0px 0 rgb(236 236 241 / 44%)!important">
                     <div class="bg-primary">
                        <div class="text-primary text-center p-4">
                           <h5 class="text-white font-size-20 p-2">Reset Password</h5>
                           <a href="<?php echo base_url(); ?>" class="logo logo-admin">
                           <img src="<?php echo base_url(); ?>assets/admin/images/VIBES_Final.png" height="50" alt="logo">
                           </a>
                        </div>
                     </div>
                     <div class="card-body p-4">
                        <div class="p-3">
                           <?php if($this->session->flashdata('msg') !=''){ ?>
                           <div class="alert alert-danger mt-2 mb-0" role="alert">
                              <?php echo $this->session->flashdata('msg');?>
                           </div>
                         <?php } ?>
                         <?php if($this->session->flashdata('smsg') !=''){ ?>
                           <div class="alert alert-success mt-2 mb-0" role="alert">
                              <?php echo $this->session->flashdata('smsg');?>
                           </div>
                         <?php } ?>
                              <div class="form-group row  mb-0">
                                 <div class="col-12 text-center">
                                    <a href="<?php echo base_url(); ?>" style="color: #fff;" class="btn btn-primary w-md waves-effect waves-light">Login</a>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-5 text-center" style="color: #fff;">
                     <p style="margin-top: -45px;">Remember It ? <a href="<?php echo base_url(); ?>master" class="font-weight-medium text-primary"> <span style="color: #fff;">Sign In here </span></a> </p>
                     <p class="mb-0">
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
</html>