<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>::Vibho Employee Solutions::</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Vibho Employee Solutions" name="description" />
      <meta content="Vibho Employee Solutions" name="author" />
      <!-- App favicon -->

      <script>
         var base_url ='<?php echo base_url(); ?>';
      </script>
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/images/VIBES Final-sm.png">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <link href="<?php echo base_url(); ?>assets/admin/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <!-- DataTables -->
      <link href="<?php echo base_url(); ?>assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <!-- Sweet Alert-->
      <link href="<?php echo base_url(); ?>assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <!-- Bootstrap Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/admin/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="<?php echo base_url(); ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/admin/css/zebra_datepicker.min.css" rel="stylesheet" type="text/css" />
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/sweetalert2@10.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/sweetalert.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/zebra_datepicker.min.js"></script>
      <?php
         $success=($this->session->flashdata('success')!='')?strip_tags($this->session->flashdata('success')):((isset($success) && $success!='')?$success:'');
         $error=($this->session->flashdata('failed')!='')?strip_tags($this->session->flashdata('failed')):((isset($failed) && $failed!='')?$failed:'');
         $notif=($this->session->flashdata('notif')!='')?strip_tags($this->session->flashdata('notif')):((isset($notif) && $notif!='')?$notif:'');
         ?>
      <script type="text/javascript">
         $(document).ready(function(){
             <?php
            if($success!=''){
            ?>
             Swal.fire({
                icon: 'success',
                title: '<?php echo $success;?>',
             });
             
             <?php
            }
            if($error!=''){
            ?>
             Swal.fire({
                 title: "<?php echo $error;?>",
                 icon: "error",
             });
             <?php
            }
            if($notif!=''){
            ?>
             Swal.fire({
                 title: "<?php echo $notif;?>",
                 icon: "error",
             });
             <?php
            }
            ?>
         });
      </script>
   </head>
   <body data-sidebar="dark" class="sidebar-enable vertical-collpsed">
      <!-- Begin page -->
      <div id="layout-wrapper">
      <header id="page-topbar">
         <div class="navbar-header">
            <div class="d-flex">
               <!-- LOGO -->
               <div class="navbar-brand-box p-0">
                  <a href="<?php echo base_url(); ?>employee/dashboard" class="logo top-ad-logo logo-dark">
                  <span class="logo-sm">
                  <img src="<?php echo base_url(); ?>assets/admin/images/logo.svg" alt="" height="22">
                  </span>
                  <span class="logo-lg">
                  <img src="<?php echo base_url(); ?>assets/admin/images/VIBHO-New-Logo-R3.png" alt="" height="17">
                  </span>
                  </a>
                  <a href="<?php echo base_url(); ?>employee/dashboard" class="logo top-ad-logo logo-light">
                  <span class="logo-sm">
                  <img src="<?php echo base_url(); ?>assets/admin/images/logo-sm.png" alt="" height="22">
                  </span>
                  <span class="logo-lg">
                  <img src="<?php echo base_url(); ?>assets/admin/images/VIBES Final.png" alt="" height="18">
                  </span>
                  </a>
               </div>
               <div class="d-flex align-items-center d-lg-none ml-2">
                  <button type="button" class="btn btn-sm waves-effect" id="vertical-menu-btn">
                     <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1H18" stroke="black" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M9.5 6.66797L18 6.66797" stroke="black" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M3 12.332H18" stroke="black" stroke-width="1.8" stroke-linecap="round"/>
                     </svg>
                  </button>
               </div>
            </div>
            <div class="d-flex">
          
               <div class="dropdown d-none ml-2">
                  <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-magnify"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-search-dropdown">
                     <form class="p-3">
                        <div class="form-group m-0">
                           <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                              <div class="input-group-append">
                                 <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="dropdown d-inline-block">
                   <a href="https://support.vibhotech.com/" class="btn btn-danger" target="_blank"><i class='fas fa-headset align-middle mr-1' style='font-size:19px'></i><span>Support </span></a>
                  <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span>
                        <?php 
                           $emp_id = $this->session->userdata('emp_id');
                           $get_emp_details = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
                           $emp_name = ucfirst($get_emp_details['fname']).' '.ucfirst($get_emp_details['lname']);
                           echo $emp_name;
                        ?>
                     </span>
                     <i class="fa fa-caret-down ml-1" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                     <!-- item-->
                     <?php 
                        if($this->session->userdata('role_id')!='Admin' && $this->session->userdata('role_id')!='' && $this->session->userdata('role_id')!='Employee'){
                          $role_id=$this->session->userdata('role_id'); 
                          $GetRoleName=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles` WHERE `roles_id`='$role_id'")->row_array();
                        ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-toggle-on" aria-hidden="true"></i> Switch To <?php echo ucfirst(@$GetRoleName['role_name']); ?></a>
                     <?php } ?>
                     <a class="dropdown-item" href="<?php echo base_url(); ?>employee/change_password"><i class="mdi mdi-lock font-size-17 align-middle mr-1"></i> Change Password</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item text-danger" href="<?php echo base_url(); ?>employee/logout"><i class="mdi mdi-power font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- ========== Left Sidebar Start ========== -->
      <div class="vertical-menu">
         <div class="menu-toggle-sidebar d-lg-flex d-none">
                  <span>MENU</span>
                  <button type="button" class="btn btn-sm waves-effect" id="vertical-menu-btn2">
                     <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1H18" stroke="black" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M9.5 6.66797L18 6.66797" stroke="black" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M3 12.332H18" stroke="black" stroke-width="1.8" stroke-linecap="round"/>
                     </svg>
                  </button>
               </div>
         <div data-simplebar class="h-100">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
               <!-- Left Menu Start -->
               <ul class="metismenu list-unstyled" id="side-menu">
                  <li>
                     <a href="<?php echo base_url(); ?>employee/dashboard" class="waves-effect">
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <mask id="mask0_1_2" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                           <path d="M1 1H20V20H1V1Z" fill="white"/>
                           </mask>
                           <g mask="url(#mask0_1_2)">
                           <path d="M9.16406 9.16406C9.16406 9.98385 8.49947 10.6484 7.67969 10.6484H3.22656C2.40678 10.6484 1.74219 9.98385 1.74219 9.16406V3.22656C1.74219 2.40678 2.40678 1.74219 3.22656 1.74219H7.67969C8.49947 1.74219 9.16406 2.40678 9.16406 3.22656V9.16406Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M19.2578 17.7734C19.2578 18.5932 18.5932 19.2578 17.7734 19.2578H13.3203C12.5005 19.2578 11.8359 18.5932 11.8359 17.7734V11.8359C11.8359 11.0162 12.5005 10.3516 13.3203 10.3516H17.7734C18.5932 10.3516 19.2578 11.0162 19.2578 11.8359V17.7734Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M9.16406 17.7734C9.16406 18.5932 8.49947 19.2578 7.67969 19.2578H3.22656C2.40678 19.2578 1.74219 18.5932 1.74219 17.7734V14.8047C1.74219 13.9849 2.40678 13.3203 3.22656 13.3203H7.67969C8.49947 13.3203 9.16406 13.9849 9.16406 14.8047V17.7734Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M19.2578 6.19531C19.2578 7.0151 18.5932 7.67969 17.7734 7.67969H13.3203C12.5005 7.67969 11.8359 7.0151 11.8359 6.19531V3.22656C11.8359 2.40678 12.5005 1.74219 13.3203 1.74219H17.7734C18.5932 1.74219 19.2578 2.40678 19.2578 3.22656V6.19531Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           </g>
                           </svg>
                           <span>Dashboard</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>employee/my_profile" <?php if($active_menu=='my_profile'){echo 'class="active_menu"';}?>>
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <mask id="mask0_13_1135" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                           <path d="M1 1H20V20H1V1Z" fill="white"/>
                           </mask>
                           <g mask="url(#mask0_13_1135)">
                           <path d="M19.4434 10.5C19.4434 15.4393 15.4393 19.4434 10.5 19.4434C5.56063 19.4434 1.55664 15.4393 1.55664 10.5C1.55664 5.56063 5.56063 1.55664 10.5 1.55664C15.4393 1.55664 19.4434 5.56063 19.4434 10.5Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M14.0774 9.30754C14.0774 11.2832 12.4758 12.8849 10.5 12.8849C8.5242 12.8849 6.92267 11.2832 6.92267 9.30754C6.92267 7.33188 8.5242 5.73024 10.5 5.73024C12.4758 5.73024 14.0774 7.33188 14.0774 9.30754Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M5.16412 17.6779C5.45024 14.9837 7.72994 12.8849 10.5 12.8849C13.2701 12.8849 15.5497 14.9838 15.8357 17.6779" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           </g>
                           </svg>
                        <span>My Profile</span>
                     </div>
                     </a>
                  </li>
                 
                  <li>
                     <a href="<?php echo base_url(); ?>employee/timesheet" <?php if($active_menu=='timesheet'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_4_160)">
                        <path d="M11.0937 17.5954H1.79167C1.35443 17.5954 1 17.2425 1 16.8071V1.78838C1 1.35296 1.35443 0.999999 1.79167 0.999999H13.2708C13.7081 0.999999 14.0625 1.35296 14.0625 1.78838V10.5394" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20 15.2697C20 17.8822 17.8733 20 15.25 20C12.6267 20 10.5 17.8822 10.5 15.2697C10.5 12.6572 12.6267 10.5394 15.25 10.5394C17.8733 10.5394 20 12.6572 20 15.2697Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.4688 15.2303H15.25V12.8651" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.63333 6.78216H11.0333" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.63333 9.43776H11.0333" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.63333 12.0934H11.0333" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_4_160">
                        <rect width="21" height="21" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>
                     <span>Timesheet</span>
                     </div>
                  </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>employee/timesheet_report" <?php if($active_menu=='timesheet_report'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.276 16.9083V19.1807H1V2H10.7618L14.276 5.51424V7.78658" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.0807 5.51423H10.7617V2.19522" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.75714 8.90674H9.48451" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.75714 10.6638H8.23023" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.75714 12.4209H5.19759" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.39283 14.9832L3.6357 16.7403L2.75714 15.8617" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.8939 15.4536C18.6094 13.7381 18.6094 10.9568 16.8939 9.24134C15.1784 7.52588 12.3971 7.52588 10.6816 9.24134C8.96616 10.9568 8.96616 13.7381 10.6816 15.4536C12.3971 17.1691 15.1784 17.1691 16.8939 15.4536Z" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.7879 9.71182V12.3475L14.9613 13.5208" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.957 12.3475V12.3472" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.7879 15.1783H13.7876" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.6188 12.3475V12.3478" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     <span>Timesheet Report</span>
                     </div>
                  </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>employee/payslips" <?php if($active_menu=='payslips'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.0968 1H3.61289C3.27441 1 3 1.27441 3 1.61289V19.3871C3 19.7256 3.27441 20 3.61289 20H17.0968C17.4353 20 17.7097 19.7256 17.7097 19.3871V1.61289C17.7097 1.27441 17.4353 1 17.0968 1Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.6283 6.96918C10.3017 6.95888 10.3193 6.71621 10.117 6.71621C9.99049 6.71621 9.88879 6.85584 9.88879 6.97142C9.88879 7.29846 10.4173 7.42196 10.4206 7.42375H10.4225V7.63327C10.4225 7.77066 10.5341 7.88221 10.6715 7.88221C10.809 7.88221 10.9204 7.77066 10.9204 7.63327V7.41853H10.9214C10.94 7.40479 11.4543 7.30981 11.4543 6.66992C11.4543 6.04257 10.9388 5.92892 10.8899 5.89234C10.66 5.80707 10.4331 5.76271 10.4331 5.56903C10.4331 5.23751 10.8681 5.37236 11.1775 5.47181C11.3847 5.45912 11.6524 5.0253 10.9204 4.89897V4.6905C10.9204 4.55296 10.809 4.44156 10.6715 4.44156C10.5341 4.44156 10.4225 4.55296 10.4225 4.6905V4.93287C10.4191 4.93541 9.94405 5.02859 9.94405 5.5874C9.94405 6.07064 10.2887 6.19996 10.5656 6.30405C10.8426 6.40814 10.965 6.46369 10.965 6.68844C10.965 6.97486 10.7554 6.94693 10.6283 6.96918Z" fill="black"/>
                        <path d="M7.09259 10.034H14.5856" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.09259 11.8981H14.5856" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.09259 13.7623H14.5856" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.16052 15.6264H15.4812" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     <span>Payslips</span>
                     </div>
                  </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>employee/other_documents" <?php if($active_menu=='other_documents'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M17.0968 1H3.61289C3.27441 1 3 1.27441 3 1.61289V19.3871C3 19.7256 3.27441 20 3.61289 20H17.0968C17.4353 20 17.7097 19.7256 17.7097 19.3871V1.61289C17.7097 1.27441 17.4353 1 17.0968 1Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M6.16052 7.23777H15.4812" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round"/>
                           <path d="M6.16052 9.10191H15.4812" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round"/>
                           <path d="M6.16052 10.9661H15.4812" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round"/>
                           <path d="M6.16052 12.8302H15.4812" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round"/>
                           </svg>
                           <span>Other Documents</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>employee/leaves" <?php if($active_menu=='leaves'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <mask id="mask0_4_271" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                           <path d="M1 1H20V20H1V1Z" fill="white"/>
                           </mask>
                           <g mask="url(#mask0_4_271)">
                           <path d="M12.0395 14.5051L12.9492 12.1167C12.9678 12.0713 13.0321 12.0712 13.0508 12.1166L13.9522 14.5051" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M12.3232 13.9103H13.673" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M8.12024 12.0826V14.5031C8.147 14.5077 8.96856 14.5031 8.96856 14.5031" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M18.1516 12.0936H17.1401V14.4941H18.1516" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M18.077 13.2939H17.1401" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M11.022 12.0936H10.0105V14.4941H11.022" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M10.9474 13.2939H10.0105" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M14.3914 12.0826L15.2197 14.4688C15.2371 14.5176 15.3063 14.5172 15.323 14.4681L16.114 12.087" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M5.14548 16.152H18.8293C19.3222 16.152 19.7217 15.7524 19.7217 15.2596V11.3924C19.7217 10.8995 19.3222 10.5 18.8293 10.5H7.2278C6.73495 10.5 6.33539 10.8995 6.33539 11.3924V14.9621L5.14548 16.152Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M9.60759 16.1519V16.152C9.60759 16.8092 9.07485 17.3419 8.41772 17.3419H2.46823C1.81106 17.3419 1.27832 16.8092 1.27832 16.152V4.84799C1.27832 4.19085 1.81106 3.65811 2.46823 3.65811H8.41772C9.07485 3.65811 9.60759 4.19085 9.60759 4.84799V9.31009" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M5.44295 7.22779C4.95006 7.22779 4.55051 6.82824 4.55051 6.33539V5.74041C4.55051 5.57613 4.68373 5.44294 4.84798 5.44294H6.03789C6.20217 5.44294 6.33536 5.57613 6.33536 5.74041V6.33539C6.33536 6.82824 5.9358 7.22779 5.44295 7.22779Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M7.22781 10.5V9.60759C7.22781 8.78613 6.56188 8.12021 5.74043 8.12021H5.14549C4.32404 8.12021 3.65811 8.78613 3.65811 9.60759V10.7975" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M1.27832 10.7975H5.14545" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M2.76572 12.8798H5.1455" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M2.76572 14.0697H4.57524" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           </g>
                           </svg>
                           <span>Leaves</span>
                        </div>
                     </a>
                     </li>
                     <li>
                     <a href="<?php echo base_url(); ?>employee/public_holidays" <?php if($active_menu=='public_holidays'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_6_386" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                        <path d="M1 1H20V20H1V1Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_6_386)">
                        <path d="M19.6289 5.48512H1.37109V4.35432C1.37109 3.67641 1.92068 3.12686 2.5986 3.12686H18.4014C19.0793 3.12686 19.6289 3.67641 19.6289 4.35432V5.48512Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.27167 3.78289V2.62029" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.5 3.78289V2.62029" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.7283 3.78289V2.62029" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19.6289 16.8607V5.48511H1.37109V16.8607C1.37109 17.6996 2.05213 18.3797 2.89217 18.3797H18.1078C18.9479 18.3797 19.6289 17.6996 19.6289 16.8607Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.2943 18.3797L19.6289 15.0495H17.8154C16.9753 15.0495 16.2943 15.7296 16.2943 16.5685V18.3797Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.9049 15.791C11.6556 15.7911 10.5454 14.9597 10.1927 13.7522C10.0579 13.2909 10.3207 12.8072 10.7796 12.6718C11.2387 12.5363 11.7199 12.8005 11.8547 13.2617C11.9931 13.7358 12.4346 14.06 12.9271 14.0499C13.497 14.0384 13.9665 13.582 13.996 13.0108C14.0118 12.7055 13.9056 12.4158 13.697 12.195C13.4882 11.974 13.2066 11.8522 12.9041 11.8522C12.4339 11.8522 12.2522 11.9191 12.009 12.0291C11.988 12.0386 11.9734 12.0456 11.9665 12.0491C11.6758 12.2033 11.3275 12.1767 11.0606 11.9839C10.7932 11.7906 10.6621 11.4593 10.716 11.1327L11.1928 8.23998C11.262 7.81987 11.6235 7.51179 12.0472 7.51179H14.4544C14.9327 7.51179 15.3205 7.90147 15.3205 8.38222C15.3205 8.86297 14.9327 9.25266 14.4544 9.25266H12.7816L12.6391 10.1174C12.723 10.1134 12.8111 10.1114 12.9041 10.1114C13.675 10.1114 14.4219 10.4339 14.9532 10.9963C15.4921 11.5667 15.7665 12.3142 15.7259 13.1011C15.6495 14.5793 14.4355 15.7606 12.9619 15.7904C12.9429 15.7908 12.9239 15.791 12.9049 15.791Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.59011 15.681C6.3298 15.681 6.23224 15.6483 6.1172 15.6097C5.83443 15.515 5.62272 15.2991 5.53652 15.0176C5.4037 14.5836 5.63107 14.2509 5.71665 14.1257C5.78326 14.0283 5.87733 13.9045 6.01972 13.7171C6.34446 13.2897 6.94886 12.4943 7.96206 11.0394C8.30514 10.5468 8.44426 10.1972 8.49992 9.98166L8.51711 9.84633C8.49373 9.43868 8.1564 9.11427 7.74508 9.11427C7.37625 9.11427 7.05719 9.37737 6.98631 9.7399C6.89409 10.2117 6.43902 10.519 5.96951 10.4262C5.50019 10.3336 5.19437 9.87605 5.28662 9.40435C5.51659 8.22754 6.55057 7.37339 7.74508 7.37339C9.12663 7.37339 10.2506 8.503 10.2506 9.89149C10.2506 9.92837 10.2483 9.96522 10.2436 10.0018L10.2119 10.2509C10.2083 10.2799 10.2031 10.3087 10.1965 10.3372C10.0753 10.8626 9.80102 11.4348 9.38127 12.0376C8.80853 12.86 8.36321 13.4767 8.0234 13.9375C8.52957 13.9355 9.10202 13.9306 9.64519 13.9238C9.6489 13.9237 9.65262 13.9237 9.65629 13.9237C10.1295 13.9237 10.5161 14.3062 10.5221 14.7832C10.5281 15.2638 10.1452 15.6584 9.66694 15.6645C8.75089 15.676 8.08192 15.681 7.59011 15.681Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        </svg>
                     <span>Public Holidays</span> 
                     </div>
                  </a>
                  </li>
                  <?php $type = $this->session->userdata('type');
                     if($type==4){ ?>
                  <li>
                     <a href="<?php echo base_url(); ?>employee/recruitment" <?php if($active_menu=='recruitment'){echo 'class="active_menu"';}?> target="_blank">
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.1012 5.01876C12.6382 2.37741 10.1216 0.610679 7.47915 1.07371C4.83668 1.53674 3.07103 4.05439 3.53406 6.69686C3.99709 9.33821 6.51366 11.105 9.15613 10.642C11.7986 10.1789 13.5653 7.66123 13.1012 5.01876Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.31764 3.46875C9.33016 3.46875 10.1511 4.28973 10.1511 5.30225C10.1511 6.31481 9.33016 7.13579 8.31764 7.13579C7.30511 7.13579 6.48413 6.31481 6.48413 5.30225C6.48413 4.28973 7.30511 3.46875 8.31764 3.46875Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.09931 6.67276C6.06817 7.11281 5.3413 8.13738 5.3413 9.32508V9.69616M11.294 9.69616V9.32508C11.294 8.13738 10.5672 7.11281 9.53598 6.67276" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.9353 9.80015C14.3207 9.25066 15.0858 9.116 15.6353 9.50132L18.674 11.6337C19.2235 12.019 19.3582 12.7852 18.9729 13.3348C18.5864 13.8843 17.8224 14.0178 17.2718 13.6325L14.233 11.5001C13.6836 11.1148 13.55 10.3486 13.9353 9.80015Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.2688 2.00085H14.9402C15.3233 2.00085 15.6353 2.31393 15.6353 2.69594V9.5013M15.6353 12.4842V19.3049C15.6353 19.687 15.3233 20 14.9402 20H1.69508C1.31304 20 1 19.6869 1 19.3049V2.69598C1 2.31393 1.31308 2.00089 1.69508 2.00089H5.36433" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.2934 8.64749L13.9353 9.80016" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.46074 14.219H5.24937M7.00301 14.219H13.1746" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.1746 16.1631H11.3859M9.63231 16.1631H3.46074" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                     <span>Recruitment </span>
                     </div>
                  </a>
                  </li>
               <?php } ?>
               <?php
                    $mnth =date("m");
                    $mnthName =date("M");
                    $ChkMonthData = $this->db->query("SELECT `confirmation_of_employment_id`, `emp_id`, `emp_data`, `is_generated`, `created_at`, `updated_at` FROM `confirmation_of_employment` WHERE `emp_id`=$emp_id AND MONTH(`created_at`)='$mnth'")->num_rows();
                ?>
               <li>
                    <a href="#" onclick="ConfirmationofEmployment();">
                    <div class="menu-item-left">
                           <svg width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.0833 13.823V11.3615C18.0833 10.5221 17.7238 9.71711 17.0838 9.12358C16.4438 8.53006 15.5758 8.19662 14.6708 8.19662H13.1541C12.8524 8.19662 12.5631 8.08548 12.3498 7.88764C12.1365 7.6898 12.0166 7.42147 12.0166 7.14168V5.73509C12.0166 4.89572 11.6571 4.09073 11.0171 3.49721C10.3772 2.90369 9.50918 2.57025 8.60413 2.57025H6.70829M6.70829 14.5263H14.2916M6.70829 17.3395H10.5M8.98329 2.57025H4.05413C3.42623 2.57025 2.91663 3.04287 2.91663 3.6252V19.801C2.91663 20.3833 3.42623 20.856 4.05413 20.856H16.9458C17.5737 20.856 18.0833 20.3833 18.0833 19.801V11.0098C18.0833 8.7715 17.1245 6.62487 15.418 5.04214C13.7114 3.45942 11.3968 2.57025 8.98329 2.57025V2.57025Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                    <span>Confirmation of Employment </span>
                    </div>
                  </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>employee/notifications">
                    <div class="menu-item-left">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_10_881" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                        <path d="M1 1H20V20H1V1Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_10_881)">
                        <path d="M17.7363 16.6602C16.8141 16.6602 16.0664 15.9125 16.0664 14.9902V9.44617C16.0664 6.33447 13.5155 3.82707 10.4043 3.88058C7.36782 3.93279 4.93359 6.40921 4.93359 9.44617V14.9902C4.93359 15.9125 4.18595 16.6602 3.26367 16.6602" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M11.6133 2.66992C11.6133 3.28475 11.1148 3.7832 10.5 3.7832C9.88517 3.7832 9.38672 3.28475 9.38672 2.66992C9.38672 2.05509 9.88517 1.55664 10.5 1.55664C11.1148 1.55664 11.6133 2.05509 11.6133 2.66992Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M2.70703 16.6602H18.293" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                        <path d="M12.1699 16.6602V17.7734C12.1699 18.6957 11.4223 19.4434 10.5 19.4434C9.57772 19.4434 8.83008 18.6957 8.83008 17.7734V16.6602" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        </g>
                        </svg>
                    <span>Notifications </span>
                    </div>
                  </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>employee/claims">
                    <div class="menu-item-left">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_13_896" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="2" width="18" height="18">
                        <path d="M2 2H20V20H2V2Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_13_896)">
                        <path d="M18.3125 5.02344H15.5V2.21094" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M7.0625 13.0391V2.21094H15.5L18.3125 5.02344V17.9609H10.0859" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        </g>
                        <path d="M8.75 8.39844H13.0357" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M8.75 7.27344H16.625" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M8.75 11.2109H13.0357" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M8.75 10.0859H16.625" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <mask id="mask1_13_896" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="2" width="18" height="18">
                        <path d="M2 2H20V20H2V2Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask1_13_896)">
                        <path d="M3.6875 16.4141C3.6875 14.5501 5.19852 13.0391 7.0625 13.0391C8.92648 13.0391 10.4375 14.5501 10.4375 16.4141C10.4375 18.278 8.92648 19.7891 7.0625 19.7891C5.19852 19.7891 3.6875 18.278 3.6875 16.4141Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                        <path d="M7.48438 14.1641H6.64062V16.9766H7.48438V14.1641Z" stroke="black" stroke-width="0.6" stroke-miterlimit="10"/>
                        <path d="M7.48438 17.8203H6.64062V18.6641H7.48438V17.8203Z" stroke="black" stroke-width="0.6" stroke-miterlimit="10"/>
                        </g>
                        </svg>
                    <span>Claims </span>
                    </div>
                  </a>
                </li>
               </ul>
            </div>
            <!-- Sidebar -->
         </div>
      </div>
      <!-- Left Sidebar End -->

    <script>
    function ConfirmationofEmployment()
    {
       var ChkMonthData='<?php echo $ChkMonthData; ?>';
       Swal.fire({
         text: "Are you sure want to generate the confirmation of employment ?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes'
          }).then((result) => {
                if (result.isConfirmed)
                {
                    if(ChkMonthData==0){
                      window.open('<?php echo base_url();?>employee/ConfirmationofEmployment/', '_blank');
                    }else{
                      window.location='<?php echo base_url();?>employee/ConfirmationofEmployment/';
                    }
              }
       });
    }
    </script>