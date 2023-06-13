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
                  <div class="card overflow-hidden" style="-webkit-box-shadow: 0 0 0px 0 rgb(236 236 241 / 44%)!important">
                     <div class="bg-ss login-header-box">
                     <div class="south-africa-logo">
                           <div class="sa-logo-2">
                              <img src="<?php echo base_url(); ?>assets/admin/images/flags/south-africa.png"  alt="SA-logo">
                              </div>
                           </div>
                        <div class="text-primary text-center p-4">
                           <h5 class="text-white font-size-20">Welcome </h5>
                           <a href="#" class="logo logo-admin">
                           <img src="<?php echo base_url(); ?>assets/admin/images/VIBES_Final.png" height="50" alt="logo">
                           </a>
                        </div>
                     </div>
                     <div class="card-body p-4 mt-4">
                         <?php if($this->session->flashdata('msg') !=''){ ?>
                           <div class="alert alert-danger mt-2 mb-0" role="alert">
                              <?php echo $this->session->flashdata('msg');?>
                           </div>
                         <?php } ?>
                          <div class="row mt-4">
                           <div class="col-12">
                              <p class="text-black text-center mb-2"><b>Navigate To </b></p>
                           </div>
                            <div class="col-12 col-md-6 mt-2">
                                <?php 
                                  $emp_id=$this->session->userdata('emp_id');
                                  $role_id=$this->session->userdata('role_id');
                                  $GetRoleName=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles` WHERE `roles_id`='$role_id'")->row_array();
                                  $GetEmpDetails=$this->db->query("SELECT `id`, `emp_id`, `username`, `email`, `pwd`, `is_cron_generate_pwd`, `is_cron_forgot_pwd`, `is_active`, `role_id`, `is_chk_login`, `created_at`, `updated_at` FROM `admin_login` WHERE `emp_id`=$emp_id")->row_array();
                                  if(!empty($GetRoleName)) { 
                                    if($GetEmpDetails['is_chk_login']==0){ ?>
                                    <a href="<?php echo base_url(); ?>admin/first_change_password" class="btn btn-ss w-100 waves-effect waves-light"><?php echo ucfirst($GetRoleName['role_name']); ?> Portal</a>
                                <?php }else{ ?>
                                    <a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-ss w-100 waves-effect waves-light"><?php echo ucfirst(@$GetRoleName['role_name']); ?> Portal</a>
                                <?php } } ?>
                            </div> 
                            <div class="col-12 col-md-6 mt-2">
                              <?php 
                                  $emp_id=$this->session->userdata('emp_id');
                                  $GetEmpDetails=$this->db->query("SELECT `id`, `emp_id`, `username`, `email`, `pwd`, `is_cron_generate_pwd`, `is_cron_forgot_pwd`, `is_active`, `role_id`, `is_chk_login`, `created_at`, `updated_at` FROM `admin_login` WHERE `emp_id`=$emp_id")->row_array();
                                  if($GetEmpDetails['is_chk_login']==0){ ?>
                                    <a href="<?php echo base_url(); ?>employee/first_change_password" class="btn btn-ss w-100 waves-effect waves-light">Employee Portal</a>
                                  <?php }else{ ?>
                                    <a href="<?php echo base_url(); ?>employee/dashboard" class="btn btn-ss w-100 waves-effect waves-light">Employee Portal</a>
                                <?php } ?>
                            </div>
                          </div>
                          <p style="margin-top: 30px;text-align:center;">
                            © <script>document.write(new Date().getFullYear())</script> VIBHO - Vibho Employee Solutions
                          </p>
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
</html>