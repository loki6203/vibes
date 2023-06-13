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
                  <a href="<?php echo base_url(); ?>admin/dashboard" class="logo top-ad-logo logo-dark">
                  <span class="logo-sm">
                  <img src="<?php echo base_url(); ?>assets/admin/images/logo.svg" alt="" height="22">
                  </span>
                  <span class="logo-lg">
                  <img src="<?php echo base_url(); ?>assets/admin/images/VIBHO-New-Logo-R3.png" alt="" height="17">
                  </span>
                  </a>
                  <a href="<?php echo base_url(); ?>admin/dashboard" class="logo top-ad-logo logo-light">
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
                  <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span>
                        <?php 
                           $emp_id = $this->session->userdata('emp_id');
                           $role_id=$this->session->userdata('role_id');
                           $GetRoleName=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles` WHERE `roles_id`='$role_id'")->row_array();
                           if($emp_id!=''){
                              $get_emp_details = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
                              $emp_name = ucfirst($get_emp_details['fname']).' '.ucfirst($get_emp_details['lname']);
                              echo $emp_name.' ('.(ucfirst($GetRoleName['role_name']).')');
                           }else{
                              echo "Admin";
                           }
                        ?> 
                     </span>
                     <i class="fa fa-caret-down ml-1" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                     <!-- item-->
                      <?php if($this->session->userdata('role_id')!='Admin'){ ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>employee/dashboard"><i class="fa fa-toggle-on" aria-hidden="true"></i> Switch To Employee</a>
                     <?php } ?>
                     <a class="dropdown-item" href="<?php echo base_url(); ?>admin/change_password"><i class="mdi mdi-lock font-size-17 align-middle mr-1"></i> Change Password</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item text-danger" href="<?php echo base_url(); ?>admin/logout"><i class="mdi mdi-power font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
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
              <?php if($this->session->userdata('role_id')=='Admin'){ ?>
               <ul class="metismenu list-unstyled" id="side-menu">
                  <li>
                     <a href="<?php echo base_url(); ?>admin/dashboard" class="waves-effect">
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
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M14.35 15.25V20" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M6.75 15.25V20" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M6.75 20H2V16.2C2 13.0517 4.5517 10.5 7.7 10.5H13.4C16.5483 10.5 19.1 13.0517 19.1 16.2V20H6.75Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M14.35 4.8C14.35 6.89855 12.6485 8.6 10.55 8.6C8.45145 8.6 6.75 6.89855 6.75 4.8C6.75 2.70145 8.45145 1 10.55 1C12.6485 1 14.35 2.70145 14.35 4.8Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                           <span>Employee </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/employee"<?php if($active_menu=='employee'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_13_1169" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M20 1H1V20H20V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_13_1169)">
                                    <mask id="mask1_13_1169" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask1_13_1169)">
                                    <path d="M15.1758 17.5508V19.0352" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.1758 19.0352H13.6914V17.5508C13.6914 16.7908 14.0721 16.1198 14.6533 15.7179C15.0125 15.4697 15.4482 15.3242 15.918 15.3242H17.4023C18.6321 15.3242 19.6289 16.321 19.6289 17.5508V19.0352H15.1758Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.1445 19.0352V17.5508" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.1445 13.0977C18.1445 13.9174 17.4799 14.582 16.6602 14.582C15.8404 14.582 15.1758 13.9174 15.1758 13.0977C15.1758 12.2779 15.8404 11.6133 16.6602 11.6133C17.4799 11.6133 18.1445 12.2779 18.1445 13.0977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.85547 17.5508V19.0352" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.85547 19.0352H1.37109V17.5508C1.37109 16.321 2.36785 15.3242 3.59766 15.3242H5.08203C5.55184 15.3242 5.9875 15.4697 6.34672 15.7179C6.92785 16.1198 7.30859 16.7908 7.30859 17.5508V19.0352H2.85547Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.82422 19.0352V17.5508" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.82422 13.0977C5.82422 13.9174 5.15959 14.582 4.33984 14.582C3.5201 14.582 2.85547 13.9174 2.85547 13.0977C2.85547 12.2779 3.5201 11.6133 4.33984 11.6133C5.15959 11.6133 5.82422 12.2779 5.82422 13.0977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 9.38672V13.0977L14.6533 15.718" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 13.0977L6.34673 15.718" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.9844 7.53125V9.38672" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.01562 7.53125V9.38672" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.01562 9.38672H7.16016V7.90234C7.16016 6.67254 8.15691 5.67578 9.38672 5.67578H11.6133C12.8431 5.67578 13.8398 6.67254 13.8398 7.90234V9.38672H9.01562Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.9844 3.44922C11.9844 4.26896 11.3197 4.93359 10.5 4.93359C9.68025 4.93359 9.01562 4.26896 9.01562 3.44922C9.01562 2.62947 9.68025 1.96484 10.5 1.96484C11.3197 1.96484 11.9844 2.62947 11.9844 3.44922Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </g>
                                    </svg>
                                 <span>Employee Management</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/asset"<?php if($active_menu=='asset'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_2_18" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_2_18)">
                                    <path d="M11.511 8.38926C11.511 8.38926 10.9356 7.88947 10.0487 8.14111C9.23432 8.37211 9.03207 9.42146 9.58548 9.83022C9.90325 10.0649 10.3814 10.2579 11.0258 10.4724C12.468 10.9525 11.9348 12.868 10.4678 12.8772C9.89527 12.8808 9.62764 12.8465 9.12469 12.5367" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.4678 7.61783V13.3822" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.7217 11.1517V9.84834C19.7217 9.24064 19.2291 8.74801 18.6213 8.74801H18.6045C18.1353 8.74801 17.7207 8.44935 17.5645 8.00686C17.4756 7.75474 17.3736 7.50882 17.2592 7.26987C17.0563 6.84582 17.1371 6.34061 17.4695 6.00815L17.4815 5.9962C17.9112 5.56647 17.9112 4.86982 17.4815 4.44009L16.5599 3.51852C16.1302 3.08879 15.4335 3.08879 15.0038 3.51852L14.9918 3.53047C14.6594 3.86293 14.1542 3.94376 13.7301 3.74077C13.4912 3.62643 13.2453 3.52438 12.9932 3.43543C12.5507 3.27931 12.252 2.86473 12.252 2.39552V2.37867C12.252 1.77096 11.7594 1.2783 11.1517 1.2783H9.84832C9.24062 1.2783 8.74799 1.77096 8.74799 2.37867V2.39552C8.74799 2.86473 8.44934 3.27931 8.00684 3.43543C7.75472 3.52438 7.50884 3.62643 7.26989 3.74077C6.8458 3.94376 6.34063 3.86293 6.00817 3.53047L5.99622 3.51852C5.56649 3.08879 4.86977 3.08879 4.44008 3.51852L3.5185 4.44009C3.08878 4.86982 3.08878 5.56647 3.5185 5.9962L3.53045 6.00815C3.86291 6.34061 3.94374 6.84582 3.74075 7.26987C3.62642 7.50882 3.52437 7.75474 3.43545 8.00686C3.27933 8.44935 2.86475 8.74801 2.3955 8.74801H2.37865C1.77095 8.74801 1.27832 9.24064 1.27832 9.84834V11.1517C1.27832 11.7594 1.77095 12.252 2.37865 12.252H2.3955C2.86475 12.252 3.27933 12.5506 3.43545 12.9931C3.52437 13.2453 3.62642 13.4912 3.74075 13.7301C3.94374 14.1542 3.86291 14.6593 3.53045 14.9918L3.5185 15.0038C3.08878 15.4335 3.08878 16.1302 3.5185 16.5599L4.44008 17.4815C4.86977 17.9112 5.56649 17.9112 5.99622 17.4815L6.00817 17.4695C6.34063 17.1371 6.8458 17.0562 7.26989 17.2592C7.50884 17.3736 7.75472 17.4756 8.00684 17.5646C8.44934 17.7207 8.74799 18.1352 8.74799 18.6045V18.6213C8.74799 19.229 9.24062 19.7217 9.84832 19.7217H11.1517C11.7594 19.7217 12.252 19.229 12.252 18.6213V18.6045C12.252 18.1352 12.5507 17.7207 12.9932 17.5646C13.2453 17.4756 13.4912 17.3736 13.7301 17.2592C14.1542 17.0562 14.6594 17.1371 14.9918 17.4695L15.0038 17.4815C15.4335 17.9112 16.1302 17.9112 16.5599 17.4815L17.4815 16.5599C17.9112 16.1302 17.9112 15.4335 17.4815 15.0038L17.4695 14.9918C17.1371 14.6593 17.0563 14.1542 17.2592 13.7301C17.3736 13.4912 17.4756 13.2453 17.5645 12.9931C17.7207 12.5506 18.1353 12.252 18.6045 12.252H18.6213C19.2291 12.252 19.7217 11.7594 19.7217 11.1517Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.81262 14.2142C5.00319 13.194 4.5197 11.9034 4.5197 10.5C4.5197 7.19715 7.19717 4.51971 10.5 4.51971C11.8934 4.51971 13.1755 4.99623 14.1922 5.79523" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.1392 6.72586C15.9776 7.7552 16.4803 9.06891 16.4803 10.5C16.4803 13.8028 13.8028 16.4803 10.5 16.4803C9.06846 16.4803 7.75442 15.9773 6.72493 15.1384" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.0645 10.5C15.0645 13.0209 13.0209 15.0645 10.5 15.0645C7.97912 15.0645 5.93555 13.0209 5.93555 10.5C5.93555 7.97912 7.97912 5.93555 10.5 5.93555C13.0209 5.93555 15.0645 7.97912 15.0645 10.5Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span>Asset</span>
                              </div>
                           </a>
                        </li>
                         <li>
                           <a href="<?php echo base_url(); ?>admin/employee_performance" <?php if($active_menu=='employee_performance'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_2_37" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_2_37)">
                                    <path d="M15.8381 16.193C14.9545 18.2674 12.8971 19.7217 10.5 19.7217C7.29701 19.7217 4.7005 17.1251 4.7005 13.9222C4.7005 10.7192 7.29701 8.12263 10.5 8.12263C13.703 8.12263 16.2995 10.7192 16.2995 13.9222C16.2995 14.2716 16.2686 14.6138 16.2094 14.9462" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.56752 18.1846C6.66289 17.1827 7.13269 16.2894 7.83517 15.6471C8.18363 15.3283 8.58886 15.0715 9.03455 14.893" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.9655 14.893C13.3099 15.4307 14.29 16.6854 14.4325 18.1846" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 15.4743C9.31929 15.4743 8.36209 14.5171 8.36209 13.3364V12.615C8.36209 11.4343 9.31929 10.4772 10.5 10.4772C11.6807 10.4772 12.6379 11.4343 12.6379 12.615V13.3364C12.6379 14.5171 11.6807 15.4743 10.5 15.4743Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.55621 5.97393H4.06152C3.44669 5.97393 2.94823 5.47547 2.94823 4.86064V2.39161C2.94823 1.77674 3.44669 1.27833 4.06152 1.27833H16.9385C17.5533 1.27833 18.0518 1.77674 18.0518 2.39161V4.86064C18.0518 5.47547 17.5533 5.97393 16.9385 5.97393H11.7209C11.652 5.97393 11.5859 6.00127 11.5372 6.05L10.6837 6.90351C10.5822 7.00493 10.4178 7.00493 10.3163 6.90351L9.46279 6.05C9.41406 6.00127 9.34801 5.97393 9.27913 5.97393H6.85504" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.6096 2.37971L10.9401 3.04932C10.9579 3.08542 10.9923 3.1104 11.0322 3.11622L11.7711 3.22354C11.8713 3.23817 11.9114 3.36137 11.8388 3.43206L11.3041 3.9533C11.2753 3.98139 11.2622 4.02184 11.269 4.06147L11.3952 4.79746C11.4123 4.89736 11.3075 4.97351 11.2178 4.92635L10.5569 4.57889C10.5213 4.56015 10.4787 4.56015 10.4431 4.57889L9.78216 4.92635C9.6925 4.97351 9.58767 4.89736 9.60481 4.79746L9.73102 4.06147C9.73781 4.02184 9.72468 3.98139 9.69588 3.9533L9.16117 3.43206C9.08862 3.36137 9.12863 3.23817 9.22889 3.22354L9.96785 3.11622C10.0077 3.1104 10.0421 3.08542 10.0599 3.04932L10.3904 2.37971C10.4352 2.28887 10.5648 2.28887 10.6096 2.37971Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.6194 2.37971L15.9498 3.04932C15.9677 3.08542 16.0021 3.1104 16.0419 3.11622L16.7808 3.22354C16.8811 3.23817 16.9211 3.36137 16.8486 3.43206L16.3139 3.9533C16.2851 3.98139 16.2719 4.02184 16.2787 4.06147L16.405 4.79746C16.4221 4.89736 16.3173 4.97351 16.2276 4.92635L15.5667 4.57889C15.531 4.56015 15.4885 4.56015 15.4529 4.57889L14.7919 4.92635C14.7023 4.97351 14.5974 4.89736 14.6146 4.79746L14.7408 4.06147C14.7476 4.02184 14.7344 3.98139 14.7056 3.9533L14.1709 3.43206C14.0984 3.36137 14.1384 3.23817 14.2387 3.22354L14.9776 3.11622C15.0174 3.1104 15.0519 3.08542 15.0697 3.04932L15.4001 2.37971C15.445 2.28887 15.5746 2.28887 15.6194 2.37971Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.59986 2.37971L5.93032 3.04932C5.94813 3.08542 5.98257 3.1104 6.02239 3.11622L6.76131 3.22354C6.86158 3.23817 6.90162 3.36137 6.82907 3.43206L6.29436 3.9533C6.26553 3.98139 6.25239 4.02184 6.25922 4.06147L6.38543 4.79746C6.40257 4.89736 6.29774 4.97351 6.20808 4.92635L5.54713 4.57889C5.5115 4.56015 5.46897 4.56015 5.43335 4.57889L4.77239 4.92635C4.68274 4.97351 4.5779 4.89736 4.59505 4.79746L4.72126 4.06147C4.72805 4.02184 4.71491 3.98139 4.68611 3.9533L4.1514 3.43206C4.07886 3.36137 4.11886 3.23817 4.21913 3.22354L4.95809 3.11622C4.99791 3.1104 5.03234 3.08542 5.05016 3.04932L5.38062 2.37971C5.42544 2.28887 5.55503 2.28887 5.59986 2.37971Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span>Employee Annual Performance</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/employee_documents" <?php if($active_menu=='employee_documents'){echo 'class="active_menu"';}?> >
                           <div class="menu-item-left">
                           <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <mask id="mask0_2_60" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                 <path d="M1 1H20V20H1V1Z" fill="white"/>
                                 </mask>
                                 <g mask="url(#mask0_2_60)">
                                 <path d="M4.64337 13.2638V3.14691H16.5062V19.6289H4.64337V18.5512" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M14.5921 8.68498C14.5921 10.9037 12.7935 12.7023 10.5748 12.7023C8.35611 12.7023 6.55749 10.9037 6.55749 8.68498C6.55749 6.46628 8.35611 4.6677 10.5748 4.6677C12.7935 4.6677 14.5921 6.46628 14.5921 8.68498Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M12.1755 10.3479H8.97404V10.3229C8.97404 9.43876 9.69074 8.72207 10.5748 8.72207C11.4589 8.72207 12.1755 9.43876 12.1755 10.3229V10.3479Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M11.6963 7.59976C11.6963 8.2196 11.1942 8.7221 10.5748 8.7221C9.95542 8.7221 9.45333 8.2196 9.45333 7.59976C9.45333 6.97988 9.95542 6.47742 10.5748 6.47742C11.1942 6.47742 11.6963 6.97988 11.6963 7.59976Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8.23809 14.5714H15.3447" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8.2381 16.381H11.5988" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M5.42662 18.5871C3.93645 18.5871 2.72409 17.3748 2.72409 15.8846C2.72409 14.3945 3.93645 13.1821 5.42662 13.1821C6.91678 13.1821 8.12911 14.3945 8.12911 15.8846C8.12911 17.3748 6.91678 18.5871 5.42662 18.5871Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.76666 15.9783L5.42661 16.4793L6.25471 15.4772" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </g>
                                 </svg>
                              <span>Employee Checks</span>
                           </div>
                        </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/employee_compensation"<?php if($active_menu=='employee'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_2_83" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_2_83)">
                                    <path d="M7.90023 10.7761C7.90023 9.88868 7.18209 9.17053 6.29462 9.17053" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.4045 10.7761C17.4045 9.88868 18.1226 9.17053 19.0101 9.17053" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.4045 3.99384C17.4045 4.88131 18.1226 5.59945 19.0101 5.59945" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.6523 3.96875H18.4331C18.7656 3.96875 19.0352 4.23831 19.0352 4.57085V10.1991C19.0352 10.5317 18.7656 10.8012 18.4331 10.8012H14.3223" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.9824 10.8012H6.87163C6.53913 10.8012 6.26953 10.5317 6.26953 10.1991V6.97678" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.0548 6.54347C11.3578 5.97095 11.9595 5.58085 12.6524 5.58085C13.6499 5.58085 14.4587 6.38958 14.4587 7.38715C14.4587 8.38476 13.6499 9.19349 12.6524 9.19349C11.8872 9.19349 11.2332 8.71778 10.9699 8.04599" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.63672 1.96484H10.0178C10.5462 1.96484 11.0598 2.13985 11.4783 2.46255L13.4316 3.96875H9.39633C8.97087 3.96875 8.62598 4.31364 8.62598 4.7391C8.62598 5.01939 8.77824 5.27756 9.02349 5.41319L10.9327 6.4691C11.3285 6.68801 11.5045 7.16375 11.3464 7.58758C11.1928 7.99957 10.7674 8.24356 10.3342 8.16827L8.99369 7.93518C7.74526 7.71809 6.56103 7.22513 5.52734 6.49218H4.63672" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.63672 7.30859H1.37109V1.37109H4.63672V7.30859Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.3605 19.1836H9.09037C7.8046 19.1836 6.5715 18.6728 5.66232 17.7636L3.64627 15.7476C3.28539 15.3867 3.28676 14.8011 3.64935 14.4419C4.00957 14.085 4.59052 14.0864 4.94904 14.445L6.753 16.2495C7.35758 16.8542 8.17763 17.194 9.03274 17.194H11.0374" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.2282 17.194H9.1873C8.67998 17.194 8.26869 16.7827 8.26869 16.2754C8.26869 15.768 8.67998 15.3567 9.1873 15.3567H11.5303L12.015 14.7814C12.618 14.0656 13.5063 13.6524 14.4424 13.6524C15.112 13.6524 15.7645 13.8642 16.3065 14.2575L16.3605 14.2966" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.6289 19.6289H16.3633V13.6914H19.6289V19.6289Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span>Employee Compensation</span>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <mask id="mask0_2_18" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                              <path d="M1 1H20V20H1V1Z" fill="white"/>
                              </mask>
                              <g mask="url(#mask0_2_18)">
                              <path d="M11.511 8.38926C11.511 8.38926 10.9356 7.88947 10.0487 8.14111C9.23432 8.37211 9.03207 9.42146 9.58548 9.83022C9.90325 10.0649 10.3814 10.2579 11.0258 10.4724C12.468 10.9525 11.9348 12.868 10.4678 12.8772C9.89527 12.8808 9.62764 12.8465 9.12469 12.5367" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.4678 7.61783V13.3822" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M19.7217 11.1517V9.84834C19.7217 9.24064 19.2291 8.74801 18.6213 8.74801H18.6045C18.1353 8.74801 17.7207 8.44935 17.5645 8.00686C17.4756 7.75474 17.3736 7.50882 17.2592 7.26987C17.0563 6.84582 17.1371 6.34061 17.4695 6.00815L17.4815 5.9962C17.9112 5.56647 17.9112 4.86982 17.4815 4.44009L16.5599 3.51852C16.1302 3.08879 15.4335 3.08879 15.0038 3.51852L14.9918 3.53047C14.6594 3.86293 14.1542 3.94376 13.7301 3.74077C13.4912 3.62643 13.2453 3.52438 12.9932 3.43543C12.5507 3.27931 12.252 2.86473 12.252 2.39552V2.37867C12.252 1.77096 11.7594 1.2783 11.1517 1.2783H9.84832C9.24062 1.2783 8.74799 1.77096 8.74799 2.37867V2.39552C8.74799 2.86473 8.44934 3.27931 8.00684 3.43543C7.75472 3.52438 7.50884 3.62643 7.26989 3.74077C6.8458 3.94376 6.34063 3.86293 6.00817 3.53047L5.99622 3.51852C5.56649 3.08879 4.86977 3.08879 4.44008 3.51852L3.5185 4.44009C3.08878 4.86982 3.08878 5.56647 3.5185 5.9962L3.53045 6.00815C3.86291 6.34061 3.94374 6.84582 3.74075 7.26987C3.62642 7.50882 3.52437 7.75474 3.43545 8.00686C3.27933 8.44935 2.86475 8.74801 2.3955 8.74801H2.37865C1.77095 8.74801 1.27832 9.24064 1.27832 9.84834V11.1517C1.27832 11.7594 1.77095 12.252 2.37865 12.252H2.3955C2.86475 12.252 3.27933 12.5506 3.43545 12.9931C3.52437 13.2453 3.62642 13.4912 3.74075 13.7301C3.94374 14.1542 3.86291 14.6593 3.53045 14.9918L3.5185 15.0038C3.08878 15.4335 3.08878 16.1302 3.5185 16.5599L4.44008 17.4815C4.86977 17.9112 5.56649 17.9112 5.99622 17.4815L6.00817 17.4695C6.34063 17.1371 6.8458 17.0562 7.26989 17.2592C7.50884 17.3736 7.75472 17.4756 8.00684 17.5646C8.44934 17.7207 8.74799 18.1352 8.74799 18.6045V18.6213C8.74799 19.229 9.24062 19.7217 9.84832 19.7217H11.1517C11.7594 19.7217 12.252 19.229 12.252 18.6213V18.6045C12.252 18.1352 12.5507 17.7207 12.9932 17.5646C13.2453 17.4756 13.4912 17.3736 13.7301 17.2592C14.1542 17.0562 14.6594 17.1371 14.9918 17.4695L15.0038 17.4815C15.4335 17.9112 16.1302 17.9112 16.5599 17.4815L17.4815 16.5599C17.9112 16.1302 17.9112 15.4335 17.4815 15.0038L17.4695 14.9918C17.1371 14.6593 17.0563 14.1542 17.2592 13.7301C17.3736 13.4912 17.4756 13.2453 17.5645 12.9931C17.7207 12.5506 18.1353 12.252 18.6045 12.252H18.6213C19.2291 12.252 19.7217 11.7594 19.7217 11.1517Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M5.81262 14.2142C5.00319 13.194 4.5197 11.9034 4.5197 10.5C4.5197 7.19715 7.19717 4.51971 10.5 4.51971C11.8934 4.51971 13.1755 4.99623 14.1922 5.79523" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.1392 6.72586C15.9776 7.7552 16.4803 9.06891 16.4803 10.5C16.4803 13.8028 13.8028 16.4803 10.5 16.4803C9.06846 16.4803 7.75442 15.9773 6.72493 15.1384" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.0645 10.5C15.0645 13.0209 13.0209 15.0645 10.5 15.0645C7.97912 15.0645 5.93555 13.0209 5.93555 10.5C5.93555 7.97912 7.97912 5.93555 10.5 5.93555C13.0209 5.93555 15.0645 7.97912 15.0645 10.5Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </g>
                              </svg>
                           <span>Assets </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/assets"<?php if($active_menu=='assets'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_2_18" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_2_18)">
                                    <path d="M11.511 8.38926C11.511 8.38926 10.9356 7.88947 10.0487 8.14111C9.23432 8.37211 9.03207 9.42146 9.58548 9.83022C9.90325 10.0649 10.3814 10.2579 11.0258 10.4724C12.468 10.9525 11.9348 12.868 10.4678 12.8772C9.89527 12.8808 9.62764 12.8465 9.12469 12.5367" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.4678 7.61783V13.3822" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.7217 11.1517V9.84834C19.7217 9.24064 19.2291 8.74801 18.6213 8.74801H18.6045C18.1353 8.74801 17.7207 8.44935 17.5645 8.00686C17.4756 7.75474 17.3736 7.50882 17.2592 7.26987C17.0563 6.84582 17.1371 6.34061 17.4695 6.00815L17.4815 5.9962C17.9112 5.56647 17.9112 4.86982 17.4815 4.44009L16.5599 3.51852C16.1302 3.08879 15.4335 3.08879 15.0038 3.51852L14.9918 3.53047C14.6594 3.86293 14.1542 3.94376 13.7301 3.74077C13.4912 3.62643 13.2453 3.52438 12.9932 3.43543C12.5507 3.27931 12.252 2.86473 12.252 2.39552V2.37867C12.252 1.77096 11.7594 1.2783 11.1517 1.2783H9.84832C9.24062 1.2783 8.74799 1.77096 8.74799 2.37867V2.39552C8.74799 2.86473 8.44934 3.27931 8.00684 3.43543C7.75472 3.52438 7.50884 3.62643 7.26989 3.74077C6.8458 3.94376 6.34063 3.86293 6.00817 3.53047L5.99622 3.51852C5.56649 3.08879 4.86977 3.08879 4.44008 3.51852L3.5185 4.44009C3.08878 4.86982 3.08878 5.56647 3.5185 5.9962L3.53045 6.00815C3.86291 6.34061 3.94374 6.84582 3.74075 7.26987C3.62642 7.50882 3.52437 7.75474 3.43545 8.00686C3.27933 8.44935 2.86475 8.74801 2.3955 8.74801H2.37865C1.77095 8.74801 1.27832 9.24064 1.27832 9.84834V11.1517C1.27832 11.7594 1.77095 12.252 2.37865 12.252H2.3955C2.86475 12.252 3.27933 12.5506 3.43545 12.9931C3.52437 13.2453 3.62642 13.4912 3.74075 13.7301C3.94374 14.1542 3.86291 14.6593 3.53045 14.9918L3.5185 15.0038C3.08878 15.4335 3.08878 16.1302 3.5185 16.5599L4.44008 17.4815C4.86977 17.9112 5.56649 17.9112 5.99622 17.4815L6.00817 17.4695C6.34063 17.1371 6.8458 17.0562 7.26989 17.2592C7.50884 17.3736 7.75472 17.4756 8.00684 17.5646C8.44934 17.7207 8.74799 18.1352 8.74799 18.6045V18.6213C8.74799 19.229 9.24062 19.7217 9.84832 19.7217H11.1517C11.7594 19.7217 12.252 19.229 12.252 18.6213V18.6045C12.252 18.1352 12.5507 17.7207 12.9932 17.5646C13.2453 17.4756 13.4912 17.3736 13.7301 17.2592C14.1542 17.0562 14.6594 17.1371 14.9918 17.4695L15.0038 17.4815C15.4335 17.9112 16.1302 17.9112 16.5599 17.4815L17.4815 16.5599C17.9112 16.1302 17.9112 15.4335 17.4815 15.0038L17.4695 14.9918C17.1371 14.6593 17.0563 14.1542 17.2592 13.7301C17.3736 13.4912 17.4756 13.2453 17.5645 12.9931C17.7207 12.5506 18.1353 12.252 18.6045 12.252H18.6213C19.2291 12.252 19.7217 11.7594 19.7217 11.1517Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.81262 14.2142C5.00319 13.194 4.5197 11.9034 4.5197 10.5C4.5197 7.19715 7.19717 4.51971 10.5 4.51971C11.8934 4.51971 13.1755 4.99623 14.1922 5.79523" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.1392 6.72586C15.9776 7.7552 16.4803 9.06891 16.4803 10.5C16.4803 13.8028 13.8028 16.4803 10.5 16.4803C9.06846 16.4803 7.75442 15.9773 6.72493 15.1384" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.0645 10.5C15.0645 13.0209 13.0209 15.0645 10.5 15.0645C7.97912 15.0645 5.93555 13.0209 5.93555 10.5C5.93555 7.97912 7.97912 5.93555 10.5 5.93555C13.0209 5.93555 15.0645 7.97912 15.0645 10.5Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span>Assets</span>
                              </div>
                           </a>
                        </li>
                         <li>
                           <a href="<?php echo base_url(); ?>admin/components" <?php if($active_menu=='components'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_13_1094" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_13_1094)">
                                    <path d="M4.93359 6.00977H3.82031C3.20548 6.00977 2.70703 5.51131 2.70703 4.89648V2.66992C2.70703 2.05509 3.20548 1.55664 3.82031 1.55664H4.93359C5.54842 1.55664 6.04688 2.05509 6.04688 2.66992V4.89648C6.04688 5.51131 5.54842 6.00977 4.93359 6.00977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M17.1797 6.00977H16.0664C15.4516 6.00977 14.9531 5.51131 14.9531 4.89648V2.66992C14.9531 2.05509 15.4516 1.55664 16.0664 1.55664H17.1797C17.7945 1.55664 18.293 2.05509 18.293 2.66992V4.89648C18.293 5.51131 17.7945 6.00977 17.1797 6.00977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M9.38672 3.7832H6.04688" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M4.93359 19.4434H3.82031C3.20548 19.4434 2.70703 18.9449 2.70703 18.3301V16.1035C2.70703 15.4887 3.20548 14.9902 3.82031 14.9902H4.93359C5.54842 14.9902 6.04688 15.4887 6.04688 16.1035V18.3301C6.04688 18.9449 5.54842 19.4434 4.93359 19.4434Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M17.1797 19.4434H16.0664C15.4516 19.4434 14.9531 18.9449 14.9531 18.3301V16.1035C14.9531 15.4887 15.4516 14.9902 16.0664 14.9902H17.1797C17.7945 14.9902 18.293 15.4887 18.293 16.1035V18.3301C18.293 18.9449 17.7945 19.4434 17.1797 19.4434Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M9.38672 17.2168H6.04688" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M11.6133 3.7832C11.6133 4.39803 11.1148 4.89648 10.5 4.89648C9.88517 4.89648 9.38672 4.39803 9.38672 3.7832C9.38672 3.16837 9.88517 2.66992 10.5 2.66992C11.1148 2.66992 11.6133 3.16837 11.6133 3.7832Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M11.6133 17.2168C11.6133 17.8316 11.1148 18.3301 10.5 18.3301C9.88517 18.3301 9.38672 17.8316 9.38672 17.2168C9.38672 16.602 9.88517 16.1035 10.5 16.1035C11.1148 16.1035 11.6133 16.602 11.6133 17.2168Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M11.6133 17.2168H14.9531" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M10.5 16.1035V14.4336" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M10.5 6.56641V4.89648" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M11.6133 3.7832H14.9531" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M10.5 8.23633L9.38672 10.5H11.6133L10.5 12.7266" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    <path d="M14.3965 10.5C14.3965 12.652 12.652 14.4336 10.5 14.4336C8.34803 14.4336 6.60352 12.652 6.60352 10.5C6.60352 8.34803 8.34803 6.56641 10.5 6.56641C12.652 6.56641 14.3965 8.34803 14.3965 10.5Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                    </g>
                                    </svg>
                                 <span>Components</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/maintenances" <?php if($active_menu=='maintenances'){echo 'class="active_menu"';}?> >
                           <div class="menu-item-left">
                           <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <mask id="mask0_13_1053" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                 <path d="M20 1H1V20H20V1Z" fill="white"/>
                                 <path d="M16.0664 11.8359C16.2712 11.8359 16.4375 12.0022 16.4375 12.207C16.4375 12.4119 16.2712 12.5781 16.0664 12.5781C15.8616 12.5781 15.6953 12.4119 15.6953 12.207C15.6953 12.0022 15.8616 11.8359 16.0664 11.8359Z" fill="white"/>
                                 </mask>
                                 <g mask="url(#mask0_13_1053)">
                                 <mask id="mask1_13_1053" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                 <path d="M1 1H20V20H1V1Z" fill="white"/>
                                 </mask>
                                 <g mask="url(#mask1_13_1053)">
                                 <path d="M16.0664 11.8359C16.2712 11.8359 16.4375 12.0022 16.4375 12.207C16.4375 12.4119 16.2712 12.5781 16.0664 12.5781C15.8616 12.5781 15.6953 12.4119 15.6953 12.207C15.6953 12.0022 15.8616 11.8359 16.0664 11.8359Z" fill="black"/>
                                 <path d="M4.37695 11.8359C3.86447 11.8359 3.44922 11.4207 3.44922 10.9082C3.44922 10.6521 3.55312 10.4198 3.72086 10.2521C3.88859 10.0844 4.1209 9.98047 4.37695 9.98047H6.23242C6.7449 9.98047 7.16016 10.3957 7.16016 10.9082C7.16016 11.1643 7.05625 11.3966 6.88852 11.5643C6.72078 11.732 6.48848 11.8359 6.23242 11.8359" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.37695 13.6914C3.86447 13.6914 3.44922 13.2762 3.44922 12.7637C3.44922 12.5076 3.55312 12.2753 3.72086 12.1076C3.88859 11.9398 4.1209 11.8359 4.37695 11.8359H6.23242C6.7449 11.8359 7.16016 12.2512 7.16016 12.7637C7.16016 13.0197 7.05625 13.252 6.88852 13.4198C6.72078 13.5875 6.48848 13.6914 6.23242 13.6914" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.37695 15.5469C3.86447 15.5469 3.44922 15.1316 3.44922 14.6191C3.44922 14.3631 3.55312 14.1308 3.72086 13.963C3.88859 13.7953 4.1209 13.6914 4.37695 13.6914H6.23242C6.7449 13.6914 7.16016 14.1067 7.16016 14.6191C7.16016 14.8752 7.05625 15.1075 6.88852 15.2752C6.72078 15.443 6.48848 15.5469 6.23242 15.5469" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M6.23242 15.5469C6.7449 15.5469 7.16016 15.9621 7.16016 16.4746C7.16016 16.7307 7.05625 16.963 6.88852 17.1307C6.72078 17.2984 6.48848 17.4023 6.23242 17.4023H4.37695C3.86447 17.4023 3.44922 16.9871 3.44922 16.4746C3.44922 16.2186 3.55312 15.9863 3.72086 15.8185C3.88859 15.6508 4.1209 15.5469 4.37695 15.5469H6.23242Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.75781 9.79641V7.11711C10.6529 6.51816 11.2422 5.49766 11.2422 4.33984C11.2422 3.0284 10.4863 1.91772 9.38672 1.37109V4.33984H6.41797V1.37109C5.31619 1.91883 4.5625 3.031 4.5625 4.33984C4.5625 5.49766 5.1518 6.51816 6.04688 7.11711V9.98047" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.75781 12.3154V17.7734C9.75781 18.798 8.92693 19.6289 7.90234 19.6289C7.39023 19.6289 6.92637 19.4211 6.59053 19.0853C6.25469 18.7494 6.04688 18.2855 6.04688 17.7734V17.4023" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M14.0573 10.9401C14.1916 10.8058 14.3772 10.7227 14.582 10.7227H17.5508V18.1445H14.582C14.172 18.1445 13.8398 17.8124 13.8398 17.4023V11.4648C13.8398 11.26 13.923 11.0745 14.0573 10.9401Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M13.8398 17.4023H9.75781" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M14.0573 10.9401L12.3803 9.26314C11.7951 8.67793 10.8462 8.68127 10.2696 9.27502C10.1256 9.42309 9.1444 10.4091 8.7306 10.8088C8.36845 11.1713 8.36845 11.7584 8.7306 12.1209C8.9121 12.302 9.14923 12.3926 9.38673 12.3926C9.51327 12.3926 9.63978 12.367 9.75782 12.315C9.86136 12.2705 9.95821 12.2055 10.0428 12.1209L10.8711 11.2923" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.0664 18.1445V13.6914" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.5625 4.33984H6.41797" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.38672 4.33984H11.2422" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.16016 5.82422H8.64453" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </g>
                                 </g>
                                 </svg>
                              <span>Maintenances</span>
                           </div>
                        </a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17.502 15.1995V17.2749L14.7769 20H3.8765V1.37849H17.502V11.7869" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.4595 4.1937H13.1368" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.4595 5.61393H13.1368" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M14.7769 20V17.2749H17.502L14.7769 20Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11.4462 8.19812V9.73402C11.2017 9.68443 10.9485 9.65832 10.6893 9.65832C10.43 9.65832 10.1768 9.68443 9.93228 9.73402V8.19812C10.1794 8.16254 10.4323 8.14437 10.6893 8.14437C10.9462 8.14437 11.1991 8.16254 11.4462 8.19812Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M9.17529 8.3639C9.65483 8.22121 10.1631 8.14437 10.6892 8.14437C11.2153 8.14437 11.7236 8.22121 12.2032 8.3639" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M13.7125 9.0912C13.9175 9.23373 14.1151 9.39258 14.303 9.56786C14.491 9.74314 14.6632 9.92913 14.8197 10.1237" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.6892 17.228C12.7796 17.228 14.4741 15.5335 14.4741 13.4432C14.4741 11.3529 12.7796 9.65832 10.6892 9.65832C8.59893 9.65832 6.90439 11.3529 6.90439 13.4432C6.90439 15.5335 8.59893 17.228 10.6892 17.228Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.6893 14.2002C11.1073 14.2002 11.4462 13.8612 11.4462 13.4432C11.4462 13.0251 11.1073 12.6862 10.6893 12.6862C10.2712 12.6862 9.93228 13.0251 9.93228 13.4432C9.93228 13.8612 10.2712 14.2002 10.6893 14.2002Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11.2245 13.9784L12.295 15.0489" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M14.303 9.56787L13.2705 10.6751" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.55875 10.1237C6.71525 9.92913 6.8875 9.74314 7.07546 9.56786C7.26341 9.39258 7.46098 9.23373 7.66597 9.0912" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.07547 9.56787L8.10798 10.6751" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           <span>Timesheet Management </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li>
                           <a href="<?php echo base_url(); ?>admin/timesheet" <?php if($active_menu=='timesheet'){echo 'class="active_menu"';}?> >
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
                           <a href="<?php echo base_url(); ?>admin/timesheet_freezed" <?php if($active_menu=='timesheet_freezed'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M10.2742 5.29032H12.4194C13.0964 5.29032 13.6452 5.83914 13.6452 6.51614V18.7742C13.6452 19.4512 13.0964 20 12.4194 20H3.22582C2.54882 20 2 19.4512 2 18.7742V6.5161C2 5.8391 2.54882 5.29028 3.22582 5.29028H5.37098" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.04836 5.29032C9.04836 4.61332 8.49954 4.0645 7.82258 4.0645C7.14558 4.0645 6.59679 4.61332 6.59679 5.29028H5.37097V6.51611C5.37097 6.85459 5.64538 7.129 5.98386 7.129H9.66129C9.99977 7.129 10.2742 6.85459 10.2742 6.51611V5.29028L9.04836 5.29032Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.8226 5.29032H7.82588" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M5.67744 12.3387C6.01593 12.3387 6.29033 12.0643 6.29033 11.7258C6.29033 11.3873 6.01593 11.1129 5.67744 11.1129C5.33895 11.1129 5.06454 11.3873 5.06454 11.7258C5.06454 12.0643 5.33895 12.3387 5.67744 12.3387Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.5806 11.7258H7.51614" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M5.67744 15.5645C6.01593 15.5645 6.29033 15.2901 6.29033 14.9516C6.29033 14.6131 6.01593 14.3387 5.67744 14.3387C5.33895 14.3387 5.06454 14.6131 5.06454 14.9516C5.06454 15.2901 5.33895 15.5645 5.67744 15.5645Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.5806 14.9516H7.51614" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M11.3002 4.0645C11.7152 2.30748 13.2936 1 15.1774 1C17.3776 1 19.1613 2.78363 19.1613 4.98388C19.1613 7.18412 17.3777 8.96775 15.1774 8.96775C15.0743 8.96775 14.9721 8.96385 14.871 8.95613" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M15.1774 5.59677C14.8389 5.59677 14.5645 5.32236 14.5645 4.98388C14.5645 4.64539 14.8389 4.37098 15.1774 4.37098C15.5159 4.37098 15.7903 4.64539 15.7903 4.98388C15.7903 5.32236 15.5159 5.59677 15.1774 5.59677Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M15.8132 4.74544L17.629 4.0645" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M13.3387 3.14516L14.6961 4.50261" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                                 <span>Freeze Timesheet</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/item_management" <?php if($active_menu=='item_management'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.2927 15.6314V6.25203H12.6586V1.77236H3.39026V20H13.0717" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.6585 1.77236L17.2927 6.25203" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.8064 18.4553L16.3511 20L19.4406 16.9106" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.7077 9.34146H13.2985" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.7077 12.4309H13.2985" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.7077 15.5203H13.2985" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 <span>Task Management</span>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </li>
                  
                  <li>
                     <a href="<?php echo base_url(); ?>admin/payslips" <?php if($active_menu=='payslips'){echo 'class="active_menu direct_menu"';}?> >
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <mask id="mask0_4_233" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                              <path d="M1 1H20V20H1V1Z" fill="white"/>
                              </mask>
                              <g mask="url(#mask0_4_233)">
                              <path d="M4.53778 6.45428L1.55667 8.58361V18.8044H19.4433V8.58361L16.4622 6.45428" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              <path d="M12.2887 13.694L19.4433 8.58363" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              <path d="M1.55667 8.58361L8.71132 13.694" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              <path d="M19.4433 18.8044L10.5 12.4164L1.55667 18.8044" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              <path d="M16.4622 10.7162V2.19563H4.53778V10.7162" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              </g>
                              <path d="M7.33334 10.5H12.7619" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              <path d="M7.33334 9.14286H12.7619" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                              <path d="M10.4647 4.28225C10.4647 4.28225 10.146 3.98827 9.65467 4.13626C9.20355 4.27215 9.09154 4.8894 9.39808 5.12983C9.57411 5.26791 9.83896 5.38141 10.1959 5.50758C10.9948 5.78998 10.6995 6.91665 9.88684 6.92206C9.56971 6.92417 9.42144 6.90403 9.14285 6.72179" stroke="black" stroke-width="0.456483" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M9.88684 3.71428V7.33333" stroke="black" stroke-width="0.456483" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           <span>Payslip Management</span>
                        </div>
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>admin/other_documents" <?php if($active_menu=='other_documents'){echo 'class="active_menu direct_menu"';}?> >
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
                     <a href="<?php echo base_url(); ?>admin/leaves" <?php if($active_menu=='leaves'){echo 'class="active_menu direct_menu"';}?> >
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
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <mask id="mask0_4_309" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                              <path d="M1 1H20V20H1V1Z" fill="white"/>
                              </mask>
                              <g mask="url(#mask0_4_309)">
                              <path d="M13.8528 18.33H17.7734C18.3857 18.33 18.8866 17.829 18.8866 17.2167V6.00998H2.11328V17.2167C2.11328 17.829 2.61426 18.33 3.22656 18.33H7.14717" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.5 3.78312V1.55663" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.78888 3.78312V1.55663" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M14.2111 3.78312V1.55663" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M17.7734 2.66999H3.22656C2.61426 2.66999 2.11328 3.17097 2.11328 3.78327V6.00998H18.8866V3.78327C18.8866 3.17097 18.3857 2.66999 17.7734 2.66999Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M16.1034 13.8399C16.1034 16.9347 13.5947 19.4434 10.5 19.4434C7.40531 19.4434 4.89661 16.9347 4.89661 13.8399C4.89661 10.7452 7.40531 8.23655 10.5 8.23655C13.5947 8.23655 16.1034 10.7452 16.1034 13.8399Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11.6859 12.2269C11.6096 12.1697 10.9562 11.6136 10.0958 11.8728C9.30582 12.1108 9.19531 13.0218 9.7668 13.3944C9.7668 13.3944 10.3277 13.6446 10.9497 13.874C12.4472 14.4264 11.8022 15.8751 10.5967 15.8751C9.99301 15.8751 9.26218 15.39 9.17969 15.2723" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.44 11.8048V11.0195" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.5 16.6603V15.8751" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </g>
                              </svg>
                           <span>Payroll Management </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/payroll" <?php if($active_menu=='payroll'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_5_334" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_5_334)">
                                    <path d="M10.6693 16.8235H18.4414C19.0973 16.8235 19.6289 16.2918 19.6289 15.636V4.99295C19.6289 4.33712 19.0973 3.80545 18.4414 3.80545H2.55859C1.90276 3.80545 1.37109 4.33712 1.37109 4.99295V15.636C1.37109 16.2918 1.90276 16.8235 2.55859 16.8235H3.12544" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.993 9.5203H16.0788C18.0395 9.5203 19.6289 7.93087 19.6289 5.9702V4.99296C19.6289 4.33712 19.0972 3.80546 18.4414 3.80546H2.55859C1.90276 3.80546 1.37109 4.33712 1.37109 4.99296V5.9702C1.37109 7.93087 2.96056 9.5203 4.92124 9.5203H8.97659" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.1124 3.80546V2.76001C14.1124 1.99292 13.4905 1.37108 12.7235 1.37108H8.1982C7.43111 1.37108 6.80927 1.99292 6.80927 2.76001V3.80546" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5047 11.4942C9.68275 11.4942 9.01642 10.8278 9.01642 10.0059V8.67648C9.01642 8.46225 9.19009 8.28854 9.40436 8.28854H11.6051C11.8194 8.28854 11.993 8.46225 11.993 8.67648V10.0059C11.993 10.8278 11.3267 11.4942 10.5047 11.4942Z" fill="black"/>
                                    <path d="M3.01508 15.7695C3.01508 13.638 4.74293 11.9102 6.87445 11.9102C9.00598 11.9102 10.7338 13.638 10.7338 15.7695C10.7338 17.9011 9.00598 19.6289 6.87445 19.6289C4.74293 19.6289 3.01508 17.9011 3.01508 15.7695Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.88785 14.921C7.88785 14.4154 7.43619 14.0055 6.879 14.0055C6.32184 14.0055 5.87018 14.4154 5.87018 14.921C5.87018 15.4267 6.32184 15.8366 6.879 15.8366" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.87903 15.8366C7.43619 15.8366 7.88789 16.2465 7.88789 16.7522C7.88789 17.2579 7.43619 17.6678 6.87903 17.6678C6.32187 17.6678 5.87018 17.2579 5.87018 16.7522" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.87909 13.9243V13.6246" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.87909 18.0004V17.7007" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span>Payroll</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/finance_report" <?php if($active_menu=='finance_report'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.3431 17.9501H3V1H12.8547L16.4024 4.5477V12.4274" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.2053 4.54771H12.8547V1.19709" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.77386 12.3329H10.5882" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.77386 14.1068H7.05552" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.77386 15.8806H9.33721" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.77386 10.5591H14.6286V7.0114" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.04041 10.362V7.0114H8.81426V10.362" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5881 10.362V8.7852H12.362V10.362" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.934 20C17.0512 20 18.7675 18.2837 18.7675 16.1664C18.7675 14.0492 17.0512 12.3329 14.934 12.3329C12.8168 12.3329 11.1005 14.0492 11.1005 16.1664C11.1005 18.2837 12.8168 20 14.934 20Z" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.4439 14.9354L15.2637 14.8607C14.9251 14.7205 14.5334 14.8827 14.3932 15.2213C14.2529 15.5598 14.4152 15.9516 14.7537 16.0918L14.934 16.1664L15.1143 16.2411C15.4528 16.3813 15.6151 16.773 15.4748 17.1116C15.3346 17.4502 14.9429 17.6124 14.6043 17.4721L14.4241 17.3975" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.934 14.6996V14.3266" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.934 18.0062V17.5997" stroke="black" stroke-width="0.96" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 <span>Finance Reports</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/reports" <?php if($active_menu=='reports'){echo 'class="active_menu"';}?> >
                           <div class="menu-item-left">
                           <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M17.0968 1H3.61289C3.27441 1 3 1.27441 3 1.61289V19.3871C3 19.7256 3.27441 20 3.61289 20H17.0968C17.4353 20 17.7097 19.7256 17.7097 19.3871V1.61289C17.7097 1.27441 17.4353 1 17.0968 1Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M13.6171 14.6943V5.37363" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.8209 14.6943V8.16984" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8.02466 14.6943V10.9661" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              <span> Reports</span>
                           </div>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>admin/public_holidays" <?php if($active_menu=='public_holidays'){echo 'class="active_menu direct_menu"';}?> >
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
                   <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_6_414)">
                              <path d="M14.0874 3.74181C14.1972 3.79992 14.3054 3.86109 14.4116 3.92455C14.5454 4.00445 14.7136 3.99718 14.8383 3.90429L15.7412 3.23145C16.0456 3.00437 16.4703 3.03533 16.7387 3.3037L17.6963 4.26135C17.9647 4.52972 17.9956 4.95445 17.7686 5.25875L17.0957 6.16173C17.0028 6.28636 16.9956 6.45457 17.0755 6.58837C17.4486 7.21304 17.7349 7.89505 17.9184 8.61759C17.9566 8.76821 18.0805 8.88175 18.2342 8.90431L19.3459 9.0664C19.7213 9.12145 20 9.44334 20 9.82296V11.177C20 11.5567 19.7213 11.8786 19.3459 11.9336L18.2342 12.0957C18.0805 12.1182 17.9566 12.2318 17.9184 12.3824C17.7349 13.1049 17.4486 13.787 17.0755 14.4116C16.9956 14.5454 17.0028 14.7136 17.0957 14.8383L17.7686 15.7412C17.9956 16.0456 17.9647 16.4703 17.6963 16.7387L16.7387 17.6963C16.4703 17.9647 16.0456 17.9956 15.7412 17.7686L14.8383 17.0957C14.7136 17.0028 14.5454 16.9956 14.4116 17.0755C13.787 17.4486 13.1049 17.7349 12.3824 17.9184C12.2318 17.9566 12.1182 18.0805 12.0957 18.2342L11.9336 19.3459C11.8786 19.7213 11.5567 20 11.177 20H9.82296C9.44334 20 9.12145 19.7213 9.0664 19.3459L8.90431 18.2342C8.88175 18.0805 8.76821 17.9566 8.61759 17.9184C7.89505 17.7349 7.21304 17.4486 6.58837 17.0755C6.45457 16.9956 6.28636 17.0028 6.16173 17.0957L5.25875 17.7686C4.95445 17.9956 4.52972 17.9647 4.26135 17.6963L3.3037 16.7387C3.03533 16.4703 3.00437 16.0456 3.23145 15.7412L3.90429 14.8383C3.99718 14.7136 4.00445 14.5454 3.92455 14.4116C3.55143 13.787 3.26509 13.1049 3.08159 12.3824C3.04336 12.2318 2.9195 12.1182 2.76581 12.0957L1.6541 11.9336C1.27869 11.8786 1 11.5567 1 11.177V9.82296C1 9.44334 1.27869 9.12145 1.6541 9.0664L2.76581 8.90431C2.9195 8.88175 3.04336 8.76821 3.08159 8.61759C3.26509 7.89505 3.55143 7.21304 3.92455 6.58837C4.00445 6.45457 3.99718 6.28636 3.90429 6.16173L3.23145 5.25875C3.00437 4.95445 3.03533 4.52972 3.3037 4.26135L4.26135 3.3037C4.52972 3.03533 4.95445 3.00437 5.25875 3.23145L6.16173 3.90429C6.28636 3.99718 6.45457 4.00445 6.58837 3.92455C7.21304 3.55143 7.89505 3.26509 8.61759 3.08159C8.76821 3.04336 8.88175 2.9195 8.90431 2.76581L9.0664 1.6541C9.12145 1.27869 9.44334 1 9.82296 1H11.177C11.5567 1 11.8786 1.27869 11.9336 1.6541L12.0957 2.76581C12.1182 2.9195 12.2318 3.04336 12.3824 3.08159C12.5422 3.12211 12.7001 3.16761 12.8557 3.21845" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.7491 10.5C15.7491 7.60455 13.3989 5.25711 10.5 5.25711C9.05053 5.25711 7.73827 5.84397 6.78854 6.79294" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M14.721 9.56395L15.7491 10.5L16.6167 9.41386" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M5.25092 10.5C5.25092 13.3955 7.6011 15.7429 10.5 15.7429C11.9495 15.7429 13.2617 15.156 14.2115 14.2071" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.27898 11.436L5.25092 10.5L4.3833 11.5861" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11.4374 9.45367L12.3128 8.57783C12.4436 8.44709 12.6145 8.38171 12.7857 8.38171C12.957 8.38171 13.1279 8.44709 13.2586 8.57745C13.5197 8.83894 13.5197 9.26252 13.2586 9.52363L10.5 12.2823C10.052 12.7303 9.32598 12.7303 8.87793 12.2823L7.74137 11.1457C7.61062 11.0153 7.54564 10.8441 7.54564 10.6728C7.54564 10.5015 7.61062 10.3303 7.74137 10.1995C8.00248 9.93841 8.42644 9.93841 8.68755 10.1995L9.55421 11.0662C9.62875 11.1407 9.74994 11.1407 9.82449 11.0662L10.4912 10.3998" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </g>
                              <defs>
                              <clipPath id="clip0_6_414">
                              <rect width="21" height="21" fill="white"/>
                              </clipPath>
                              </defs>
                              </svg>
                           <span>Configuration Menu  </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/designations"<?php if($active_menu=='designations'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6_425)">
                                    <path d="M16.6268 12.5791C16.6787 12.2156 16.5703 11.8475 16.3298 11.5701C16.0892 11.2927 15.7401 11.1333 15.3729 11.1333C12.9352 11.1333 8.06489 11.1333 5.62718 11.1333C5.25999 11.1333 4.91085 11.2927 4.67028 11.5701C4.42966 11.8475 4.3213 12.2156 4.37326 12.5791C4.73221 15.092 5.43335 20 5.43335 20H15.5667C15.5667 20 16.2678 15.092 16.6268 12.5791Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 16.8333C11.1995 16.8333 11.7666 16.2662 11.7666 15.5667C11.7666 14.8671 11.1995 14.3 10.5 14.3C9.80044 14.3 9.23334 14.8671 9.23334 15.5667C9.23334 16.2662 9.80044 16.8333 10.5 16.8333Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.3 7.33334C14.3 9.43201 12.5987 11.1333 10.5 11.1333C8.40132 11.1333 6.69999 9.43201 6.69999 7.33334V6.38334L8.59999 4.48334C8.59999 4.48334 8.60011 4.48342 8.6003 4.48361C9.10412 4.98743 9.78749 5.2705 10.5 5.2705C11.2125 5.2705 11.8959 4.98743 12.3997 4.48361C12.3999 4.48342 12.4 4.48334 12.4 4.48334L14.3 6.38334V7.33334Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.5625 13.9041C4.5625 13.9041 2.73223 15.7345 1.69547 16.7712C1.25015 17.2165 1 17.8204 1 18.4501C1 18.4503 1 18.4506 1 18.4508C1 18.8616 1.16323 19.2557 1.45375 19.5462C1.74427 19.8368 2.1383 20 2.54917 20C3.82785 20 5.43335 20 5.43335 20L4.5625 13.9041Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.4375 13.9041C16.4375 13.9041 18.2812 15.7478 19.3159 16.7825C19.7539 17.2206 20 17.8147 20 18.4341C20 18.4342 20 18.4343 20 18.4344C20 19.299 19.299 20 18.4344 20C17.1584 20 15.5666 20 15.5666 20L16.4375 13.9041Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.7 6.38335C6.7 3.85 6.35756 2.71587 6.35756 2.71587C6.95512 2.11832 7.78907 1.87073 8.48233 1.98721C8.89016 1.41461 9.65493 1 10.5 1C11.3451 1 12.1099 1.41461 12.5177 1.98717C13.211 1.87069 14.0449 2.11832 14.6425 2.71583C14.6425 2.71583 14.3 3.84996 14.3 6.38331" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_6_425">
                                    <rect width="21" height="21" fill="white"/>
                                    </clipPath>
                                    </defs>
                                    </svg>
                                 <span> Designations</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/email_id"<?php if($active_menu=='email_id'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M15.7767 10.6455C15.0839 10.98 14.5856 11.6882 14.5123 12.5277C14.5021 12.6436 14.5949 12.7429 14.7112 12.7429H18.6408C18.7572 12.7429 18.85 12.6436 18.8398 12.5277C18.7665 11.6882 18.2681 10.98 17.5754 10.6455" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.676 10.9344C17.5299 10.9344 18.222 10.2423 18.222 9.38842C18.222 8.53459 17.5299 7.84242 16.676 7.84242C15.8222 7.84242 15.13 8.53459 15.13 9.38842C15.13 10.2423 15.8222 10.9344 16.676 10.9344Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M15.7767 3.80305C15.084 4.13756 14.5856 4.84572 14.5123 5.68521C14.5021 5.80112 14.5949 5.90048 14.7112 5.90048H15.4196" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.7576 5.90052H18.6408C18.7572 5.90052 18.85 5.80116 18.8398 5.68525C18.7665 4.84577 18.2681 4.13765 17.5754 3.8031" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.676 4.092C17.5299 4.092 18.222 3.39983 18.222 2.546C18.222 1.69217 17.5299 1 16.676 1C15.8222 1 15.13 1.69217 15.13 2.546C15.13 3.39983 15.8222 4.092 16.676 4.092Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M15.7766 17.9026C15.0839 18.2371 14.5856 18.9453 14.5122 19.7847C14.5021 19.9007 14.5949 20 14.7112 20H18.6408C18.7572 20 18.85 19.9007 18.8398 19.7847C18.7665 18.9453 18.2681 18.2371 17.5754 17.9026" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M15.2964 17.3431C15.5514 17.8463 16.0732 18.1915 16.676 18.1915C17.5298 18.1915 18.222 17.4993 18.222 16.6455C18.222 15.7917 17.5298 15.0995 16.676 15.0995C16.0507 15.0995 15.5125 15.471 15.269 16.0051" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.74422 10.7094C7.74422 9.78165 8.28715 8.98093 9.07254 8.60709C8.64147 7.96644 8.04317 7.46135 7.34465 7.16396C6.92145 7.42434 6.42339 7.57482 5.89005 7.57482C5.35668 7.57482 4.85858 7.42434 4.43538 7.16393C3.1131 7.72682 2.14792 9.03335 2.00166 10.5959C1.98082 10.8187 2.15901 11.0102 2.38273 11.0102H7.76421C7.75148 10.9116 7.74422 10.8114 7.74422 10.7094Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M6.329 8.67854H5.4511L4.97197 11.0102H6.80813L6.329 8.67854Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M5.89007 7.57482C5.56925 7.57482 5.26142 7.51981 4.9747 7.41984L5.45112 8.67831L6.32898 8.67854L6.80543 7.4198C6.51871 7.51981 6.21089 7.57482 5.89007 7.57482Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M3.21456 5.54931C3.54345 6.71786 4.61632 7.57482 5.89005 7.57482C7.42538 7.57482 8.67002 6.33018 8.67002 4.79485C8.67002 3.25951 7.42538 2.01488 5.89005 2.01488C4.55496 2.01488 3.44015 2.9562 3.17197 4.21124" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.94543 4.39175V4.73884" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M6.83466 4.39175V4.73884" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.0714 13.0366C11.3567 13.0366 12.3987 11.9946 12.3987 10.7094C12.3987 9.42407 11.3567 8.38214 10.0714 8.38214C8.78616 8.38214 7.74423 9.42407 7.74423 10.7094C7.74423 11.9946 8.78616 13.0366 10.0714 13.0366Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8.93535 10.5955L9.83267 11.4928L11.3316 9.99393" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.0714 7.12069V2.75882C10.0714 2.44213 10.3282 2.18538 10.6449 2.18538H13.6257" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.0715 14.298V18.6599C10.0715 18.9766 10.3282 19.2333 10.6449 19.2333H13.6257" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                                 <span>Management</span>
                              </div>
                           </a>
                        </li>
                         <li>
                           <a href="<?php echo base_url(); ?>admin/identifications" <?php if($active_menu=='identifications'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <mask id="mask0_7_461" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                 <path d="M1 1H20V20H1V1Z" fill="white"/>
                                 </mask>
                                 <g mask="url(#mask0_7_461)">
                                 <path d="M8.83207 3.7832H4.89648L1.55663 7.12305V19.4434H12.6894V10.4629" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                 <path d="M15.8383 9.1586L19.2133 12.5707" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                                 <path d="M1.55664 7.12305H4.89648V3.7832" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                 </g>
                                 <path d="M3.7832 15.8208H10.4629" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                                 <path d="M3.7832 13.5942H10.4629" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                                 <path d="M3.7832 11.3676H7.12305" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                                 <path d="M17.1426 6.00977C17.1426 8.46915 15.1488 10.4629 12.6895 10.4629C10.2301 10.4629 8.23633 8.46915 8.23633 6.00977C8.23633 3.55038 10.2301 1.55664 12.6895 1.55664C15.1488 1.55664 17.1426 3.55038 17.1426 6.00977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                                 <path d="M13.8027 4.89648C13.8027 5.51131 13.3043 6.00977 12.6895 6.00977C12.0746 6.00977 11.5762 5.51131 11.5762 4.89648C11.5762 4.28166 12.0746 3.7832 12.6895 3.7832C13.3043 3.7832 13.8027 4.28166 13.8027 4.89648Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="square"/>
                                 <path d="M14.916 9.86716V9.34963C14.916 8.11994 13.9191 7.12307 12.6895 7.12307C11.4598 7.12307 10.4629 8.11994 10.4629 9.34963V9.86716" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                                 </svg>
                                 <span>Identification Type</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/clients" <?php if($active_menu=='clients'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_10_818" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_10_818)">
                                    <path d="M19.6289 11.7617V9.23828C19.6289 9.03333 19.4628 8.86719 19.2578 8.86719H17.8693C17.6768 7.99263 17.3329 7.17492 16.8659 6.44324L17.8473 5.46188C17.9922 5.31693 17.9922 5.08199 17.8473 4.93704L16.063 3.15271C15.918 3.0078 15.6831 3.0078 15.5381 3.15271L14.5568 4.13411C13.8251 3.66709 13.0074 3.32319 12.1328 3.13074V1.74219C12.1328 1.53723 11.9667 1.37109 11.7617 1.37109H9.23828C9.03333 1.37109 8.86719 1.53723 8.86719 1.74219V3.13279C7.99389 3.32616 7.17738 3.6705 6.44688 4.13775L5.46188 3.15271C5.31693 3.0078 5.08199 3.0078 4.93704 3.15271L3.15272 4.93704C3.0078 5.08199 3.0078 5.31693 3.15272 5.46188L4.1399 6.44907C3.67473 7.17923 3.33214 7.99493 3.14017 8.86719H1.74219C1.53723 8.86719 1.37109 9.03333 1.37109 9.23828V11.7617C1.37109 11.9667 1.53723 12.1328 1.74219 12.1328H3.14221C3.33507 13.0038 3.67818 13.8183 4.14354 14.5473L3.15272 15.5381C3.0078 15.6831 3.0078 15.918 3.15272 16.063L4.93704 17.8473C5.08199 17.9922 5.31693 17.9922 5.46188 17.8473L6.45267 16.8565C7.18172 17.3218 7.99619 17.6649 8.86719 17.8578V19.2578C8.86719 19.4628 9.03333 19.6289 9.23828 19.6289H11.7617C11.9667 19.6289 12.1328 19.4628 12.1328 19.2578V17.8598C13.0051 17.6679 13.8208 17.3253 14.5509 16.8601L15.5381 17.8473C15.6831 17.9922 15.918 17.9922 16.063 17.8473L17.8473 16.063C17.9922 15.918 17.9922 15.6831 17.8473 15.5381L16.8623 14.5531C17.3295 13.8226 17.6738 13.0061 17.8672 12.1328H19.2578C19.4628 12.1328 19.6289 11.9667 19.6289 11.7617Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.8714 14.1182V13.6016C13.8714 13.0671 13.4992 12.6048 12.9771 12.4906L11.5734 12.1837C11.3969 12.1451 11.2711 11.9889 11.2711 11.8083" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.12862 14.1182V13.6009C7.12862 13.0668 7.50039 12.6046 8.02218 12.4901L9.41831 12.1839C9.59465 12.1452 9.72031 11.989 9.72031 11.8084V11.8083" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.778 12.232L10.4957 15.5469L9.2134 12.232" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.9857 9.2331V10.5271C11.9857 11.3477 11.3205 12.0128 10.5 12.0128C9.67948 12.0128 9.0143 11.3477 9.0143 10.5271V9.60419" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.2324 7.59975H12.2144V8.58333C12.2144 9.09347 11.8008 9.50702 11.2907 9.50702H9.01433V8.81786C9.01433 8.14511 9.55969 7.59975 10.2324 7.59975Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.0988 5.71161C14.1025 6.38032 15.5469 8.27149 15.5469 10.5C15.5469 13.2873 13.2873 15.5469 10.5 15.5469C7.71268 15.5469 5.45312 13.2873 5.45312 10.5C5.45312 8.18755 7.00838 6.23834 9.12992 5.64129" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span>Client Management</span>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <!-- <li>
                     <a href="<?php echo base_url(); ?>admin/employee_email_id" <?php if($active_menu=='employee_email_id'){echo 'class="active_menu"';}?> ><i class="fa fa-list-alt" aria-hidden="true"></i><span>Employee Assign Email Id's</span></a>
                  </li> -->
                <li>
                    <a href="<?php echo base_url(); ?>admin/certificate_of_service_letter" <?php if($active_menu=='certificate_of_service_letter'){echo 'class="active_menu"';}?> >
                     <div class="menu-item-left">
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <mask id="mask0_7_530" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                           <path d="M1 1H20V20H1V1Z" fill="white"/>
                           </mask>
                           <g mask="url(#mask0_7_530)">
                           <path d="M16.9166 5.56003H14.1661V2.80955" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M5.91467 12.1612V2.80957H14.1661L16.9166 5.56004V18.2122H7.2899" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M7.56496 7.76042H15.2663" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M7.56496 10.7604H15.2663" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M8.66515 12.1612H14.1661" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M7.56496 9.26038H15.2663" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M11.9657 14.8114H15.2663" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M13.0659 15.9116H15.2663" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M8.11505 14.3615C8.11505 15.5767 7.12993 16.5619 5.91467 16.5619C4.6994 16.5619 3.71429 15.5767 3.71429 14.3615C3.71429 13.1462 4.6994 12.1611 5.91467 12.1611C7.12993 12.1611 8.11505 13.1462 8.11505 14.3615Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M7.01486 14.3615C7.01486 14.9691 6.52228 15.4617 5.91467 15.4617C5.30705 15.4617 4.81448 14.9691 4.81448 14.3615C4.81448 13.7539 5.30705 13.2613 5.91467 13.2613C6.52228 13.2613 7.01486 13.7539 7.01486 14.3615Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           <path d="M7.2899 16.0118V20H7.01486L5.91467 18.8998L4.81448 20H4.53943V16.0118" stroke="black" stroke-width="0.96" stroke-miterlimit="10"/>
                           </g>
                           </svg>
                           <span>Certificate Of Service Letter </span>
                     </div>
                     </a>
                </li>
                <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <mask id="mask0_8_555" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                              <path d="M1 1H20V20H1V1Z" fill="white"/>
                              </mask>
                              <g mask="url(#mask0_8_555)">
                              <path d="M5.30469 16.4746H3.82031C2.59062 16.4746 1.59375 17.4715 1.59375 18.7012V19.4434H7.53125V18.7012C7.53125 17.4715 6.53438 16.4746 5.30469 16.4746Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M11.2422 16.4746H9.75781C8.52812 16.4746 7.53125 17.4715 7.53125 18.7012V19.4434H13.4688V18.7012C13.4688 17.4715 12.4719 16.4746 11.2422 16.4746Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M17.1797 16.4746H15.6953C14.4656 16.4746 13.4688 17.4715 13.4688 18.7012V19.4434H19.4062V18.7012C19.4062 17.4715 18.4094 16.4746 17.1797 16.4746Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.41797 14.6191C6.41797 15.6439 5.58724 16.4746 4.5625 16.4746C3.53776 16.4746 2.70703 15.6439 2.70703 14.6191C2.70703 13.5944 3.53776 12.7637 4.5625 12.7637C5.58724 12.7637 6.41797 13.5944 6.41797 14.6191Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M12.3555 14.6191C12.3555 15.6439 11.5247 16.4746 10.5 16.4746C9.47526 16.4746 8.64453 15.6439 8.64453 14.6191C8.64453 13.5944 9.47526 12.7637 10.5 12.7637C11.5247 12.7637 12.3555 13.5944 12.3555 14.6191Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M18.293 14.6191C18.293 15.6439 17.4622 16.4746 16.4375 16.4746C15.4128 16.4746 14.582 15.6439 14.582 14.6191C14.582 13.5944 15.4128 12.7637 16.4375 12.7637C17.4622 12.7637 18.293 13.5944 18.293 14.6191Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M17.966 8.23633C17.8118 7.71869 17.6087 7.22217 17.356 6.75574L18.3721 5.73965L15.2233 2.5908L14.2071 3.60693C13.7407 3.35418 13.2443 3.15112 12.7266 2.99693V1.55664H8.27347V2.99693C7.75576 3.15112 7.25931 3.35418 6.79288 3.60693L5.77679 2.5908L2.62794 5.73965L3.64404 6.75574C3.39128 7.22217 3.18822 7.71869 3.03403 8.23633H1.59378V10.4629H4.93362C4.93362 7.38864 7.42578 4.89648 10.5 4.89648C13.5742 4.89648 16.0664 7.38864 16.0664 10.4629H19.4063V8.23633H17.966Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M16.0664 10.4629H13.8398C13.8398 8.61833 12.3446 7.12305 10.5 7.12305C8.65544 7.12305 7.16016 8.61833 7.16016 10.4629H4.93359" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </g>
                              </svg>
                           <span>Role Management  </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/roles"<?php if($active_menu=='roles'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_8_578" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_8_578)">
                                    <path d="M9.09363 15.8662L9.56073 17.1797H11.4396L11.9064 15.8662C12.3896 15.74 12.8592 15.5478 13.3006 15.2892L14.5585 15.8871L15.8872 14.5587L15.2892 13.3007C15.5478 12.8592 15.74 12.3896 15.8662 11.9064L17.1797 11.4393V9.56035L15.8662 9.09363C15.74 8.61039 15.5478 8.14081 15.2892 7.69935L15.8871 6.44146L14.5586 5.11283L13.3006 5.71077C12.8592 5.45223 12.3896 5.26001 11.9064 5.13383L11.4392 3.82031H9.56032L9.09363 5.13383C8.61035 5.26001 8.14081 5.45223 7.69932 5.71077L6.44146 5.11287L5.11283 6.44138L5.71078 7.69935C5.4522 8.14081 5.26001 8.61039 5.13384 9.09363L3.82031 9.56076V11.4396L5.13384 11.9064C5.26001 12.3896 5.4522 12.8592 5.71078 13.3006L5.11283 14.5585L6.44139 15.8872L7.69932 15.2892C8.14081 15.5478 8.61035 15.74 9.09363 15.8662Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.6289 2.70703C19.6289 3.44484 19.0308 4.04297 18.293 4.04297C17.5552 4.04297 16.957 3.44484 16.957 2.70703C16.957 1.96922 17.5552 1.37109 18.293 1.37109C19.0308 1.37109 19.6289 1.96922 19.6289 2.70703Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.37109 2.70703C1.37109 3.44484 1.96922 4.04297 2.70703 4.04297C3.44484 4.04297 4.04297 3.44484 4.04297 2.70703C4.04297 1.96922 3.44484 1.37109 2.70703 1.37109C1.96922 1.37109 1.37109 1.96922 1.37109 2.70703Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.6289 18.293C19.6289 17.5552 19.0308 16.957 18.293 16.957C17.5552 16.957 16.957 17.5552 16.957 18.293C16.957 19.0308 17.5552 19.6289 18.293 19.6289C19.0308 19.6289 19.6289 19.0308 19.6289 18.293Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.37109 18.293C1.37109 17.5552 1.96922 16.957 2.70703 16.957C3.44484 16.957 4.04297 17.5552 4.04297 18.293C4.04297 19.0308 3.44484 19.6289 2.70703 19.6289C1.96922 19.6289 1.37109 19.0308 1.37109 18.293Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.3054 17.3053L16.3766 16.3766" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.3054 3.69466L16.3766 4.6234" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.69464 17.3053L4.62338 16.3766" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.69464 3.69466L4.62338 4.6234" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.87674 7.33039C7.72795 7.92162 6.94223 9.11906 6.94223 10.5C6.94223 12.4675 8.53719 14.0625 10.5047 14.0625C12.4722 14.0625 14.0672 12.4675 14.0672 10.5C14.0672 9.11576 13.2777 7.9159 12.1244 7.32616" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5047 9.13373C9.86488 9.13373 9.34616 9.65241 9.34616 10.2922V10.4919C9.34616 11.1317 9.86488 11.6504 10.5047 11.6504C11.1446 11.6504 11.6632 11.1317 11.6632 10.4919V10.2922C11.6632 9.65241 11.1446 9.13373 10.5047 9.13373Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.8218 13.1811C12.8218 12.3357 12.1365 11.6504 11.291 11.6504H9.71841C8.87299 11.6504 8.18765 12.3357 8.18765 13.1811" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> Roles</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/role_access"<?php if($active_menu=='role_access'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M10.5769 5.41224C11.7953 5.41224 12.7831 4.42453 12.7831 3.20612C12.7831 1.98771 11.7953 1 10.5769 1C9.35853 1 8.37082 1.98771 8.37082 3.20612C8.37082 4.42453 9.35853 5.41224 10.5769 5.41224Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8.37082 7.44284V9.55811" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M12.783 7.44284V9.55811" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M12.8513 17.7699V14.2558C12.8513 13.9233 12.5818 13.6538 12.2494 13.6538H8.90461C8.57216 13.6538 8.30264 13.9234 8.30264 14.2558V19.398C8.30264 19.7305 8.57216 20 8.90461 20H10.6212L12.8513 17.7699Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.6212 18.3718V19.9999L12.8512 17.7699H11.2231C10.8907 17.7699 10.6212 18.0394 10.6212 18.3718Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M6.54868 17.7699V14.2558C6.54868 13.9233 6.27916 13.6538 5.94676 13.6538H2.60196C2.26952 13.6538 2 13.9234 2 14.2558V19.398C2 19.7305 2.26952 20 2.60196 20H4.31859L6.54868 17.7699Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.31863 18.3718V19.9999L6.54866 17.7699H4.92055C4.58811 17.7699 4.31863 18.0394 4.31863 18.3718Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.9238 18.3718V19.9999L19.1538 17.7699H17.5257C17.1933 17.7699 16.9238 18.0394 16.9238 18.3718Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M10.5769 9.84111V13.5494" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.8795 13.5494V12.1656C16.8795 11.9058 16.6689 11.6953 16.4091 11.6953H4.74469C4.48492 11.6953 4.27435 11.9058 4.27435 12.1656V13.5494" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M19.1538 15.144V14.2558C19.1538 13.9233 18.8843 13.6538 18.5519 13.6538H15.2071C14.8747 13.6538 14.6052 13.9234 14.6052 14.2558V19.398C14.6052 19.7304 14.8747 20 15.2071 20H16.9238L19.1538 17.7699V16.482" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M14.4376 7.39743V7.24195C14.4376 6.23559 13.6142 5.4122 12.6079 5.4122H8.54596C7.5396 5.4122 6.71625 6.23555 6.71625 7.24191V9.30077C6.71625 9.51474 6.8897 9.68819 7.10367 9.68819H14.0502C14.2642 9.68819 14.4376 9.51474 14.4376 9.30077V8.73543" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                                 <span>Role Access</span>
                              </div>
                           </a>
                        </li>
                     </ul>
                     <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M17.0968 1H3.61289C3.27441 1 3 1.27441 3 1.61289V19.3871C3 19.7256 3.27441 20 3.61289 20H17.0968C17.4353 20 17.7097 19.7256 17.7097 19.3871V1.61289C17.7097 1.27441 17.4353 1 17.0968 1Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M13.6171 14.6943V5.37363" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M10.8209 14.6943V8.16984" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M8.02466 14.6943V10.9661" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                           <span>Reports  </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/employee_roles"<?php if($active_menu=='employee_roles'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_9_649" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M20 1H1V20H20V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_9_649)">
                                    <mask id="mask1_9_649" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask1_9_649)">
                                    <path d="M10.3286 3.87472C10.2627 3.80391 10.1554 3.79074 10.0743 3.84369C9.20608 4.41091 8.05776 4.76946 6.92938 4.68841C6.81493 4.67973 6.71619 4.77106 6.71619 4.88669V6.6302C6.71619 7.75075 7.59423 8.77423 8.92234 8.77423C10.1046 8.77423 11.0664 7.81239 11.0664 6.6302V4.74593C11.0664 4.64173 11.0709 4.67261 10.3286 3.87472Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.92233 8.77423C8.45082 8.77423 8.03645 8.64479 7.69757 8.42826V9.41897L8.91706 10.9243L10.1365 9.41897V8.39597C9.7911 8.63425 9.37284 8.77423 8.92233 8.77423Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.0664 5.03149V6.6302C11.0664 6.64753 11.0655 6.66467 11.0651 6.68193C11.6308 6.76757 12.0739 6.35881 12.0739 5.85676C12.0739 5.35374 11.6305 4.94695 11.0664 5.03149Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.71617 6.63021V5.03213C6.22362 4.96633 5.70862 5.34433 5.70862 5.85677C5.70862 6.35816 6.15074 6.76766 6.71744 6.6819C6.71699 6.66468 6.71617 6.6475 6.71617 6.63021Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.31244 18.2531V12.9867" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.3896 11.6977L11.3015 9.87013L10.1366 9.419L8.91711 10.9243L10.1061 11.7687C10.2023 11.837 10.3368 11.8034 10.3896 11.6977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.44635 11.6977L6.53442 9.87013L7.69932 9.419L8.91881 10.9243L7.72983 11.7687C7.6336 11.837 7.49908 11.8034 7.44635 11.6977Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.91867 10.9253V10.9243L8.91793 10.9248L8.91719 10.9243V10.9253L8.05243 11.5395L8.46119 12.1547H8.91719H8.91867H9.37467L9.78343 11.5395L8.91867 10.9253Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.1573 16.779L9.37468 12.1547H8.91868H8.91719H8.46119L7.67852 16.779C7.67028 16.8385 7.68776 16.899 7.72509 16.9401L8.91719 18.2515V18.2531L8.91793 18.2523L8.91868 18.2531V18.2515L10.1107 16.9401C10.1481 16.899 10.1656 16.8385 10.1573 16.779Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.77041 14.4928L7.87635 15.6101L7.67852 16.7789C7.67028 16.8385 7.68776 16.899 7.72509 16.9401L7.9054 17.1384L10.0082 15.8979L9.77041 14.4928Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.52226 13.0266L9.37467 12.1547H8.91867H8.91723H8.46123L8.17957 13.8186L9.52226 13.0266Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.3208 14.0656C15.3877 14.0003 15.3507 13.8867 15.2583 13.8732L14.5439 13.7695C14.5072 13.7641 14.4754 13.741 14.459 13.7077L14.1396 13.0604C14.0982 12.9767 13.9787 12.9767 13.9374 13.0604L13.6179 13.7077C13.6014 13.741 13.5697 13.7641 13.533 13.7695L12.8187 13.8732C12.7262 13.8867 12.6892 14.0003 12.7562 14.0656L13.2731 14.5694C13.2996 14.5953 13.3118 14.6326 13.3055 14.6693L13.1834 15.3806C13.1676 15.4728 13.2643 15.543 13.3471 15.4995L13.986 15.1636C14.0189 15.1464 14.0581 15.1464 14.0909 15.1636L14.7299 15.4995C14.8126 15.543 14.9093 15.4728 14.8934 15.3806L14.7714 14.6693C14.7652 14.6326 14.7773 14.5953 14.8039 14.5694L15.3208 14.0656Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.7061 18.5022L16.261 15.9858C15.7784 16.623 15.0282 17.0463 14.1777 17.0882L15.6635 19.6752C15.7006 19.74 15.7957 19.7352 15.826 19.6669L16.3186 18.5591C16.3347 18.5229 16.3725 18.5011 16.412 18.5055L17.6169 18.6384C17.6912 18.6467 17.7433 18.567 17.7061 18.5022Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.8159 15.9858L10.3708 18.5022C10.3336 18.567 10.3857 18.6466 10.4599 18.6384L11.6649 18.5055C11.7044 18.5011 11.7422 18.5228 11.7584 18.5592L12.2508 19.6669C12.2812 19.7352 12.3762 19.7401 12.4134 19.6753L13.8992 17.0881C13.0487 17.0463 12.2985 16.623 11.8159 15.9858Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.3627 10.6684L10.1366 9.41898L8.91708 10.9243L7.69759 9.41898L4.47483 10.6684C4.47483 10.6684 3.28162 11.1589 3.28162 12.5192V17.8555C3.28162 18.0751 3.45967 18.2531 3.67924 18.2531H10.5138L11.8147 15.9879V15.9835C11.4618 15.5166 11.252 14.9355 11.252 14.3052C11.252 12.7663 12.4995 11.5187 14.0384 11.5187C14.1282 11.5187 14.2169 11.5234 14.3044 11.5317C13.9544 10.9123 13.3627 10.6684 13.3627 10.6684Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.26937 1.34599C6.9564 1.63102 5.97278 2.799 5.97278 4.1974V5.27498C6.16783 5.09418 6.44533 4.99588 6.71619 5.0321V4.88667C6.71619 4.77103 6.81494 4.67971 6.92938 4.68839C8.05773 4.76947 9.20608 4.41092 10.0743 3.84371C10.1554 3.79075 10.2627 3.80389 10.3286 3.87473C11.0709 4.67262 11.0664 4.64174 11.0664 4.74587V5.03143C11.3633 4.98694 11.6267 5.07871 11.8097 5.24885V4.1974C11.8097 2.81867 10.8535 1.66405 9.56819 1.35868" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.7363 13.6057C16.426 12.4054 15.3358 11.5188 14.0384 11.5188C12.4996 11.5188 11.252 12.7663 11.252 14.3052C11.252 15.8441 12.4996 17.0916 14.0384 17.0916C15.3715 17.0916 16.4853 16.1553 16.7595 14.9046" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </g>
                                    </svg>
                                 <span> Employee Roles</span>
                              </div>
                           </a>
                        </li>
                  </li>
               </ul>
             <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
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
                           <span>Recruitment</span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <a href="<?php echo base_url(); ?>admin/create_job"<?php if($active_menu=='create_job'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <mask id="mask0_9_707" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                 <path d="M1 1H20V20H1V1Z" fill="white"/>
                                 </mask>
                                 <g mask="url(#mask0_9_707)">
                                 <path d="M12.758 17.2468H10.462C9.98057 17.2468 9.49978 17.2119 9.0234 17.1423L8.52013 17.0688" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M16.5277 8.03097C16.1867 11.0579 13.6181 13.4105 10.5 13.4105C7.1498 13.4105 4.43391 10.6946 4.43391 7.34441C4.43391 3.99421 7.1498 1.27832 10.5 1.27832C13.6325 1.27832 16.2105 3.65277 16.5322 6.69997" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M15.0608 11.3432C14.901 10.9184 14.5766 10.5651 14.146 10.3756C13.5808 10.1268 12.5138 9.9694 11.9885 9.90346L10.4513 10.8739L8.90605 9.91645C8.38136 9.98677 7.31566 10.1532 6.7526 10.4068C6.3579 10.5845 6.0542 10.9001 5.88635 11.2813" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M11.2698 2.84056L9.54949 2.8478C9.23544 2.84909 8.96936 3.0516 8.87251 3.33263C8.83625 3.43795 8.73613 3.5079 8.62473 3.50838C8.22435 3.51009 7.90113 3.83602 7.90284 4.23639L7.90915 5.74808C7.90915 5.74808 8.54528 5.7378 8.76129 5.9491C8.80675 5.99352 8.88305 5.96172 8.88279 5.89822L8.87859 4.90447C8.87711 4.55943 9.15565 4.27855 9.50069 4.2771L9.50819 4.27706C9.61158 4.27662 9.71385 4.29213 9.81171 4.32252C9.99792 4.38026 10.1906 4.41459 10.3855 4.41377L10.4627 4.41344C10.6577 4.41259 10.85 4.3767 11.0357 4.31733C11.1333 4.28615 11.2354 4.26979 11.3388 4.26934L11.3464 4.26931C11.6914 4.26786 11.9723 4.54637 11.9737 4.89145L11.9779 5.88516C11.9782 5.94869 12.3568 5.97857 12.4019 5.93377C12.6161 5.72065 12.9502 5.72682 12.9502 5.72682L12.9451 4.50169C12.9411 3.58037 12.1912 2.83666 11.2698 2.84056Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.90967 5.74806C7.78294 5.81456 7.69655 5.94745 7.69718 6.10045L7.69903 6.53942C7.7 6.75822 7.87805 6.93478 8.09685 6.93385L8.24666 6.93322C8.26143 7.50808 8.50535 8.06038 8.94335 8.43433C9.29596 8.7354 9.791 8.9974 10.4435 9.00192C11.0958 8.99187 11.5887 8.72572 11.9387 8.42172C12.3736 8.04406 12.6128 7.48975 12.6227 6.91474L12.7726 6.91415C12.9913 6.91322 13.1679 6.73513 13.167 6.51637L13.1651 6.07741C13.1645 5.92437 13.077 5.79222 12.9497 5.7268" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M11.9885 9.90347C11.8124 9.88136 11.68 9.73221 11.6792 9.55472L11.6753 8.62168" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.20846 8.63209L9.21236 9.56513C9.21314 9.74259 9.082 9.89292 8.9061 9.91644" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.84059 10.0936L8.84414 11.19C9.03203 11.3953 9.3341 11.4493 9.5815 11.3219L10.4513 10.8739" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M13.0554 10.0716L12.0618 11.1781C11.8754 11.3857 11.5729 11.4423 11.324 11.3162L10.4513 10.8739" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.96652 12.0388L9.66159 13.3522" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M11.265 13.3617L10.9451 12.0347" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M9.58151 11.3219C9.57999 11.3227 9.5784 11.3233 9.57687 11.3241L9.96652 12.0388L10.9451 12.0347L11.3294 11.3186C11.3276 11.3178 11.3258 11.3171 11.324 11.3162" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M3.97219 16.0789V18.7009C3.97219 18.9777 3.74779 19.2021 3.47099 19.2021H2.61967C2.34287 19.2021 2.11847 18.9777 2.11847 18.7009V13.2642C2.11847 12.9874 2.34287 12.763 2.61967 12.763H3.47099C3.74779 12.763 3.97219 12.9874 3.97219 13.2642V14.7498" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M3.9722 18.3386L7.19942 19.5398C7.52264 19.6601 7.86472 19.7217 8.20957 19.7217H12.1314C12.6803 19.7217 13.2178 19.5657 13.6814 19.272L18.5919 16.5016C18.9159 16.2139 18.9759 15.7304 18.7322 15.3722C18.4655 14.9803 18.0243 14.9122 17.5389 15.1418L12.758 17.2468L12.7637 16.7917C12.7004 16.1551 12.2101 15.6441 11.5767 15.5545L8.66528 15.2193C7.99363 15.1243 7.65802 14.8992 7.07258 14.5567C6.27324 14.0891 5.36384 13.8427 4.43778 13.8427H3.9722" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </g>
                                 </svg>
                                 <span> Create Job</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/job_position"<?php if($active_menu=='job_position'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_9_742" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_9_742)">
                                    <path d="M13.001 10.4629H7.99898C7.34767 10.4629 6.83545 9.90621 6.88955 9.25717L7.4462 2.57748C7.49425 2.00047 7.9766 1.55664 8.55562 1.55664H12.4444C13.0234 1.55664 13.5057 2.00047 13.5538 2.57748L14.1104 9.25717C14.1646 9.90621 13.6523 10.4629 13.001 10.4629Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.16016 19.4434V18.3301L10.5 17.2168" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 19.0723V17.2168" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.8398 19.4434V18.3301L10.5 17.2168V14.916" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.7266 14.916H8.27344C7.65861 14.916 7.16016 14.4176 7.16016 13.8027V12.6895H13.8398V13.8027C13.8398 14.4176 13.3414 14.916 12.7266 14.916Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.5625 8.60742V11.2051C4.5625 12.0249 5.22709 12.6895 6.04688 12.6895H14.9531C15.7729 12.6895 16.4375 12.0249 16.4375 11.2051V8.60742" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.82031 8.60742H5.30469" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.1797 8.60742H15.6953" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.38672 10.4629V12.6895" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.6133 10.4629V12.6895" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> Job Positions</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/candidate_filters"<?php if($active_menu=='job_position'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <g clip-path="url(#clip0_13_1129)">
                                 <path d="M5.66949 18.3898H1" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M12.1102 18.3898H20" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M8.4565 7.95187L4.49266 3.70915C4.22385 3.42141 4.05933 3.03501 4.05933 2.61017C4.05933 1.72091 4.78024 1 5.6695 1H15.3305C16.2198 1 16.9407 1.72091 16.9407 2.61017C16.9407 3.03501 16.7762 3.42141 16.5073 3.70915L12.5436 7.95187C12.2747 8.2396 12.1102 8.626 12.1102 9.05085V10.339C12.1102 12.1175 10.6684 13.5593 8.88983 13.5593V9.05085C8.88983 8.626 8.72532 8.2396 8.4565 7.95187Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.27966 20C8.16894 20 8.88983 19.2791 8.88983 18.3898C8.88983 17.5006 8.16894 16.7797 7.27966 16.7797C6.39039 16.7797 5.66949 17.5006 5.66949 18.3898C5.66949 19.2791 6.39039 20 7.27966 20Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 </g>
                                 <defs>
                                 <clipPath id="clip0_13_1129">
                                 <rect width="21" height="21" fill="white"/>
                                 </clipPath>
                                 </defs>
                                 </svg>
                                 <span> Filters</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/rate_calculator_config"<?php if($active_menu=='rate_calculator_config'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.13559 10.795H4.39389" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.13559 13.2225H4.39389" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.13559 15.65H4.39389" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.2569 12.3191H11.8476" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.0514 12.3191H13.6421" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.8458 12.3191H15.4365" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6403 12.3191H17.2309" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.2569 13.7664H11.8476" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.0514 13.7664H13.6421" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.8458 13.7664H15.4365" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6403 13.7664H17.2309" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.2569 15.2137H11.8476" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.0514 15.2137H13.6421" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.8458 15.2137H15.4365" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6403 15.2137H17.2309" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <mask id="mask0_9_769" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_9_769)">
                                    <path d="M6.94035 4.13017C6.94035 4.13017 6.43763 3.66649 5.66272 3.89991C4.95118 4.11425 4.7745 5.08782 5.258 5.46704C5.53565 5.68483 5.95339 5.86385 6.51642 6.06286C7.7765 6.50829 7.31067 8.28534 6.02891 8.29388C5.52871 8.29722 5.29485 8.26545 4.85544 7.978" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.0289 3.23433V8.94257" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.80899 10.5189V16.653C9.80899 17.0329 10.117 17.3409 10.4969 17.3409H17.991C18.3709 17.3409 18.6789 17.0329 18.6789 16.653V8.2814C18.6789 7.90151 18.3709 7.59354 17.991 7.59354H10.4969C10.117 7.59354 9.80899 7.90151 9.80899 8.2814V9.21774M17.2309 10.581C17.2309 10.6992 17.1351 10.795 17.0169 10.795H11.471C11.3528 10.795 11.2569 10.6992 11.2569 10.581V9.15659C11.2569 9.03836 11.3528 8.94254 11.471 8.94254H17.0169C17.1351 8.94254 17.2309 9.03836 17.2309 9.15659V10.581Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.0169 8.94251H11.471C11.3528 8.94251 11.2569 9.03837 11.2569 9.15656V10.581C11.2569 10.6992 11.3528 10.795 11.471 10.795H17.0169C17.1351 10.795 17.2309 10.6992 17.2309 10.581V9.15656C17.2309 9.03837 17.1351 8.94251 17.0169 8.94251Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6219 6.28771V4.95905C16.6219 4.71732 16.5233 4.495 16.3635 4.33524C15.9559 3.92759 13.565 1.53675 13.565 1.53675C13.4906 1.46235 13.4028 1.40141 13.3066 1.35759C13.193 1.30585 13.0685 1.27832 12.9412 1.27832H3.20337C2.71612 1.27832 2.32117 1.67331 2.32117 2.16056V18.8395C2.32117 19.3267 2.71612 19.7217 3.20337 19.7217H15.7397C16.2269 19.7217 16.6219 19.3267 16.6219 18.8395V18.6405" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.5416 4.59366H14.0093C13.6212 4.59366 13.3066 4.27905 13.3066 3.89096V1.35761" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> Rate Calculator Config</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/client_based_rate_config"<?php if($active_menu=='client_based_rate_config'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_7_489)">
                                    <path d="M13.3935 8.20872C13.8069 8.80908 14.049 9.53661 14.049 10.3207C14.049 12.3798 12.3797 14.049 10.3207 14.049C8.26161 14.049 6.59241 12.3798 6.59241 10.3207C6.59241 8.26163 8.26161 6.5924 10.3207 6.5924C11.216 6.5924 12.0376 6.90799 12.6803 7.43399" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.70505 11.0839L9.12671 10.6623" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.31501 11.6938L9.73667 11.2722" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.6916 10.8392L12.2691 11.4167C12.3874 11.5349 12.5791 11.5349 12.6973 11.4167L12.879 11.235C12.9973 11.1167 12.9973 10.925 12.879 10.8068L12.3015 10.2293C12.1331 10.0608 11.86 10.0608 11.6916 10.2293C11.5232 10.3977 11.5232 10.6707 11.6916 10.8392Z" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.0816 11.4491L11.6592 12.0266C11.7774 12.1449 11.9691 12.1449 12.0874 12.0266L12.2691 11.8449C12.3873 11.7266 12.3873 11.5349 12.2691 11.4167L11.6915 10.8392C11.5231 10.6707 11.2501 10.6707 11.0816 10.8392C10.9132 11.0076 10.9132 11.2806 11.0816 11.4491Z" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.4717 12.059L11.0492 12.6365C11.1675 12.7548 11.3592 12.7548 11.4774 12.6365L11.6591 12.4548C11.7774 12.3365 11.7774 12.1448 11.6591 12.0266L11.0816 11.4491C10.9132 11.2806 10.6401 11.2806 10.4717 11.4491C10.3033 11.6175 10.3033 11.8905 10.4717 12.059Z" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.9093 12.7164L10.3246 13.1318C10.4429 13.25 10.6346 13.25 10.7528 13.1318L10.9345 12.9501C11.0528 12.8318 11.0528 12.6401 10.9345 12.5219L10.5192 12.1065C10.3508 11.9381 10.0777 11.9381 9.9093 12.1065C9.74087 12.275 9.74087 12.548 9.9093 12.7164Z" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.23855 8.77223C9.30049 8.89199 9.40092 8.98861 9.5235 9.04575" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.5234 9.04574C9.60163 9.08219 9.68889 9.10254 9.7809 9.10254H10.0332V9.19256C10.0332 9.61876 10.3786 9.96423 10.8048 9.96423C10.8289 9.96423 10.8521 9.95466 10.8691 9.93762C10.8862 9.92057 10.8957 9.89747 10.8957 9.87337C10.8957 9.60234 10.8957 8.82221 10.8956 8.81363C10.8903 8.3534 10.5157 7.9814 10.0536 7.9814H9.33904H9.33841C9.2967 7.9814 9.25667 7.96484 9.22717 7.93534L8.41025 7.11842" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.87004 8.90653L7.56915 9.60564C7.59721 9.6337 7.61395 9.67154 7.61404 9.71124C7.61497 10.0443 7.71172 10.3772 7.90436 10.6649C7.9579 10.7448 8.01701 10.8188 8.08078 10.8867" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.2311 7.11842L11.413 7.93648C11.3848 7.96475 11.3466 7.98149 11.3066 7.9814C11.0506 7.98077 10.7944 8.0368 10.5585 8.14948" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.7371 10.6649C12.9298 10.3771 13.0265 10.0443 13.0274 9.71122C13.0275 9.67152 13.0443 9.63368 13.0723 9.60562L13.7714 8.90651" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.27577 10.2934L8.09516 10.474C7.97618 10.593 7.97759 10.7846 8.09516 10.9022L8.27688 11.0839C8.39514 11.2022 8.58683 11.2022 8.70509 11.0839C8.58683 11.2022 8.58683 11.3939 8.70509 11.5121L8.88678 11.6938C9.00504 11.8121 9.19673 11.8121 9.31499 11.6938C9.19673 11.8121 9.19673 12.0038 9.31499 12.122L9.90941 12.7165" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.52345 9.04573L9.03409 9.5351" stroke="black" stroke-width="0.753534" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.8924 9.0664L18.6442 8.63632C18.4329 7.70926 18.0672 6.84107 17.5759 6.05977L18.1551 4.87229C17.8746 4.4916 17.5621 4.12709 17.2175 3.78249C16.8729 3.43789 16.5084 3.12544 16.1277 2.84487L14.9402 3.42412C14.1589 2.9328 13.2907 2.5671 12.3637 2.3558L11.9336 1.10762C11.466 1.03685 10.9873 1 10.5 1C10.0127 1 9.53398 1.03685 9.0664 1.10762L8.63632 2.3558C7.70926 2.5671 6.84107 2.9328 6.05977 3.42412L4.87229 2.84487C4.49164 3.12544 4.12709 3.43789 3.78249 3.78249C3.43789 4.12709 3.12544 4.49164 2.84487 4.87229L3.42412 6.05977C2.9328 6.84107 2.5671 7.70926 2.35584 8.63632L1.10765 9.0664C1.03685 9.53398 1 10.0127 1 10.5C1 10.9873 1.03685 11.466 1.10762 11.9336L2.3558 12.3637C2.56706 13.2907 2.9328 14.1589 3.42412 14.9402L2.84487 16.1277C3.12544 16.5084 3.43789 16.8729 3.78249 17.2175C4.12709 17.5621 4.49164 17.8746 4.87229 18.1551L6.05977 17.5759C6.84107 18.0672 7.70922 18.4329 8.63632 18.6442L9.0664 19.8924C9.53398 19.9631 10.0127 20 10.5 20C10.9873 20 11.466 19.9631 11.9336 19.8924L12.3637 18.6442C13.2907 18.4329 14.1589 18.0672 14.9402 17.5759L16.1277 18.1551C16.5084 17.8746 16.8729 17.5621 17.2175 17.2175C17.5621 16.8729 17.8746 16.5084 18.1551 16.1277L17.5759 14.9402C18.0672 14.1589 18.4329 13.2908 18.6442 12.3637L19.8924 11.9336C19.9631 11.466 20 10.9873 20 10.5C20 10.0127 19.9631 9.53398 19.8924 9.0664Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.01531 5.82627C3.94202 7.08459 3.29376 8.71648 3.29376 10.5C3.29376 14.4799 6.52009 17.7062 10.5 17.7062C14.4799 17.7062 17.7062 14.4799 17.7062 10.5C17.7062 6.52009 14.4799 3.29376 10.5 3.29376C8.71648 3.29376 7.08459 3.94202 5.82627 5.01531" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_7_489">
                                    <rect width="21" height="21" fill="white"/>
                                    </clipPath>
                                    </defs>
                                    </svg>
                                 <span> Client Based Rate Config</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/candidate_based_rate_config"<?php if($active_menu=='candidate_based_rate_config'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5001 8.20451V11.4265" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <mask id="mask0_10_840" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_10_840)">
                                    <path d="M16.8902 6.65507V8.99029C16.8902 9.44366 16.5189 9.81497 16.0655 9.81497H4.93472C4.48135 9.81497 4.11003 9.44366 4.11003 8.99029V6.65507" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.9362 13.0232V11.7557C12.9362 11.5748 12.788 11.4264 12.607 11.4264H8.39324C8.21233 11.4264 8.06401 11.5748 8.06401 11.7557V13.0232" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.83472 14.9987H7.33823" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.1656 14.9987H13.6621" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.9706 16.5586H13.6631C14.3889 16.5586 14.9842 15.9643 14.9842 15.2375V13.9163M6.01603 13.9163V15.2375C6.01603 15.9643 6.61034 16.5586 7.3372 16.5586H9.02961" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.85848 13.0232H6.65869C6.3053 13.0232 6.01603 13.3125 6.01603 13.6659V19.079C6.01603 19.4324 6.3053 19.7217 6.65869 19.7217H9.85848M11.1428 19.7217H14.3416C14.695 19.7217 14.9842 19.4324 14.9842 19.079V13.6659C14.9842 13.3125 14.695 13.0232 14.3416 13.0232H11.1428" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.35464 15.9086H11.6456C11.8244 15.9086 11.9706 16.0548 11.9706 16.2325V16.8837C11.9706 17.0625 11.8244 17.2087 11.6456 17.2087H9.35464C9.17584 17.2087 9.02959 17.0625 9.02959 16.8837V16.2325C9.02959 16.0548 9.17584 15.9086 9.35464 15.9086Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8902 2.55268C16.3106 2.55268 15.8405 3.02181 15.8405 3.60246C15.8405 4.18208 16.3106 4.65225 16.8902 4.65225C17.4698 4.65225 17.94 4.18208 17.94 3.60246C17.94 3.02181 17.4698 2.55268 16.8902 2.55268Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.11005 2.76624C3.53048 2.76624 3.0603 3.23538 3.0603 3.81603C3.0603 4.3956 3.53048 4.86581 4.11005 4.86581C4.68963 4.86581 5.1598 4.3956 5.1598 3.81603C5.1598 3.23538 4.68963 2.76624 4.11005 2.76624Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5001 4.31565C9.92057 4.31565 9.45036 4.78482 9.45036 5.36543C9.45036 5.94505 9.92057 6.41522 10.5001 6.41522C11.0797 6.41522 11.5499 5.94505 11.5499 5.36543C11.5499 4.78482 11.0797 4.31565 10.5001 4.31565Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.4943 5.88297C18.4943 5.23396 18.1051 4.67223 17.5487 4.41978M16.2317 4.41978C15.6753 4.67223 15.2861 5.23396 15.2861 5.88297" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.7152 5.68523C17.7075 6.69294 16.0729 6.69294 15.0652 5.68523C14.0565 4.67753 14.0565 3.04286 15.0652 2.03411C16.0729 1.02641 17.7075 1.02641 18.7152 2.03411C19.7239 3.04286 19.7239 4.67753 18.7152 5.68523Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.71416 6.09653C5.71416 5.44748 5.32496 4.8858 4.76854 4.63334M3.45157 4.63334C2.89515 4.8858 2.50494 5.44748 2.50494 6.09653" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.93503 5.89876C4.92737 6.90647 3.29277 6.90647 2.28399 5.89876C1.27632 4.89106 1.27632 3.25639 2.28399 2.24765C3.29277 1.23994 4.92737 1.23994 5.93503 2.24765C6.9427 3.25639 6.9427 4.89106 5.93503 5.89876Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.1042 7.64594C12.1042 6.99693 11.7151 6.4352 11.1586 6.18275M9.84166 6.18275C9.28521 6.4352 8.89604 6.99693 8.89604 7.64594" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.3251 7.4482C11.3174 8.45591 9.68283 8.45591 8.67516 7.4482C7.66642 6.4405 7.66642 4.80586 8.67516 3.79708C9.68283 2.78938 11.3174 2.78938 12.3251 3.79708C13.3339 4.80586 13.3339 6.4405 12.3251 7.4482Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> Candidate Based Rate Config</span>
                              </div>
                           </a>
                        </li>
                  </li>
               </ul>
               <li>
                     <a href="<?php echo base_url(); ?>admin/notifications" <?php if($active_menu=='notifications'){echo 'class="active_menu direct_menu"';}?> >
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
                           <span>Notifications</span>
                        </div>
                     </a>  
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>admin/claims" <?php if($active_menu=='claims'){echo 'class="active_menu direct_menu"';}?> >
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
                           <span>Claims</span>
                        </div>
                     </a>  
                  </li>
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <mask id="mask0_13_926" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                              <path d="M1 1H20V20H1V1Z" fill="white"/>
                              </mask>
                              <g mask="url(#mask0_13_926)">
                              <path d="M16.4685 1.90475H4.26882C3.96257 1.90475 3.71429 2.15303 3.71429 2.45928V18.5407C3.71429 18.847 3.96257 19.0952 4.26882 19.0952H16.4685C16.7748 19.0952 17.0231 18.847 17.0231 18.5407V2.45928C17.0231 2.15303 16.7748 1.90475 16.4685 1.90475Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M12.4104 5.68719L11.836 4.25106C11.7629 4.06811 11.5858 3.94825 11.3888 3.94825H9.61121C9.4142 3.94825 9.23719 4.06811 9.16408 4.25106L8.58963 5.68719" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.9685 5.68717H12.8457C13.0402 5.68717 13.1795 5.87501 13.123 6.06119L12.4295 8.34617C12.3924 8.46829 12.2798 8.55179 12.1522 8.55179H8.84787C8.72025 8.55179 8.60762 8.46829 8.57055 8.34617L7.87701 6.06119C7.82049 5.87501 7.9598 5.68717 8.15437 5.68717H9.66969" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M5.9747 11.3145H6.37044V13.1659" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M6.87896 16.5166C6.87896 16.5166 5.97821 16.5279 5.93553 16.5137C5.89286 16.4995 6.00393 16.4243 6.59448 15.5805C6.70481 15.4229 6.76552 15.29 6.79135 15.1786L6.80048 15.107C6.80048 14.8453 6.5884 14.6332 6.32674 14.6332C6.09655 14.6332 5.90466 14.7974 5.86191 15.0152" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.97577 11.3145H15.1381" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.97577 12.4278H12.9116" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.97577 14.6332H15.1381" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M7.97577 15.7465H12.9116" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </g>
                              </svg>
                           <span>Purchase Orders</span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                          <li>
                           <a href="<?php echo base_url(); ?>admin/nature_of_business"<?php if($active_menu=='nature_of_business'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1984 16.6629L12.2047 15.4818" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.9579 17.5581L11.4889 16.6878" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.4544 18.2974L10.8788 17.9564" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <mask id="mask0_13_951" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_13_951)">
                                    <path d="M10.4692 11.7688L10.368 11.7089C9.78558 11.3747 9.5132 11.3129 8.9878 11.516L8.41509 11.7374C8.0666 11.8721 7.67558 11.8396 7.35413 11.6491L7 11.4404" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.80606 15.1057L5.39948 15.4559" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.78949 18.9412L10.7396 19.504C11.0728 19.7014 11.5029 19.5914 11.7003 19.2582C11.8977 18.925 11.7876 18.4949 11.4544 18.2974L12.243 18.7646C12.5762 18.962 13.0064 18.852 13.2037 18.5188C13.4011 18.1856 13.291 17.7555 12.9579 17.5581L13.4836 17.8695C13.8167 18.0669 14.2469 17.9569 14.4443 17.6237V17.6236C14.6417 17.2905 14.5316 16.8604 14.1984 16.663L14.8418 17.0441C15.175 17.2415 15.605 17.1314 15.8024 16.7983C15.9998 16.4651 15.8898 16.035 15.5565 15.8376" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.084 11.6011L14.0014 11.6491C13.68 11.8396 13.2889 11.8721 12.9405 11.7374L12.2946 11.4836C12.0926 11.4043 11.8708 11.3902 11.6604 11.4435L10.6709 11.6939C10.2103 11.8105 9.88763 12.225 9.88763 12.7001V14.021C9.88763 14.2078 10.039 14.3597 10.2257 14.3598C10.7889 14.3602 11.2456 13.9038 11.2456 13.3406V13.2847L15.4811 15.7929C15.5595 15.7093 15.6495 15.6371 15.7485 15.5784L16.2963 15.2584" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.07017 16.9098C5.84439 17.2243 5.40639 17.2962 5.09189 17.0704C4.77739 16.8446 4.70547 16.4066 4.93128 16.0922L5.32835 15.539C5.55412 15.2245 5.99212 15.1526 6.30663 15.3784C6.62113 15.6042 6.69305 16.0422 6.46727 16.3567" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.04438 16.5639L7.20905 17.7274C6.98328 18.0419 6.54531 18.1138 6.23077 17.8881C5.91627 17.6623 5.84435 17.2243 6.07016 16.9098L6.9055 15.7463C7.13127 15.4317 7.56923 15.3598 7.88374 15.5856C8.19824 15.8114 8.27016 16.2493 8.04438 16.5639Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.04438 16.5639C8.27016 16.2493 8.70816 16.1775 9.02266 16.4032C9.33716 16.629 9.40908 17.067 9.18327 17.3815L8.34798 18.545C8.1222 18.8595 7.6842 18.9315 7.3697 18.7057C7.0552 18.4799 6.98328 18.0419 7.20905 17.7274" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.81213 17.8985C9.03791 17.584 9.47591 17.5121 9.79041 17.7379C10.1049 17.9637 10.1768 18.4016 9.95102 18.7161L9.67329 19.1031C9.44748 19.4176 9.00948 19.4895 8.69502 19.2637C8.38051 19.0379 8.3086 18.5999 8.53437 18.2854" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.12396 2.75818V2.03885C9.12396 1.6849 9.41078 1.39797 9.76473 1.39797H11.2353C11.5893 1.39797 11.8761 1.6849 11.8761 2.03885V2.75818" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.43057 4.66656V5.83551" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.5695 4.66656V5.83551" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.7955 14.5341L19.3217 14.2204C19.5697 14.0726 19.7217 13.805 19.7217 13.5163V7.94346C19.7217 7.69854 19.4548 7.54695 19.2444 7.67234L14.2521 10.6481C13.9715 10.8154 13.8791 11.1783 14.0457 11.4594L16.3285 15.3127C16.4956 15.5949 16.8602 15.6877 17.1419 15.5197L17.6689 15.2056" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.75558 7.67234L6.74787 10.6481C7.02857 10.8154 7.12093 11.1783 6.95435 11.4594L4.67156 15.3127C4.50439 15.5949 4.13982 15.6877 3.85809 15.5197L1.67836 14.2204C1.43028 14.0726 1.27832 13.8051 1.27832 13.5163V7.9435C1.27832 7.69854 1.54521 7.54695 1.75558 7.67234Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.54022 5.6189V3.5276C6.54022 3.10262 6.88471 2.75818 7.30961 2.75818H13.6904C14.1153 2.75818 14.4598 3.10262 14.4598 3.5276V7.32393C14.4598 7.74887 14.1153 8.09335 13.6904 8.09335H7.30961C6.88471 8.09335 6.54022 7.74887 6.54022 7.32393V6.92007" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.54022 3.85684C6.54022 4.62683 7.1644 5.25101 7.93438 5.25101H13.0656C13.8356 5.25101 14.4598 4.62683 14.4598 3.85684" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> Nature Of Business</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/eco_system_practice"<?php if($active_menu=='eco_system_practice'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_13_994" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="1" width="19" height="19">
                                    <path d="M1 1H20V20H1V1Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_13_994)">
                                    <path d="M2.64105 8.74603C3.24512 6.03493 5.23611 3.71307 8.07219 2.82219L8.83568 2.58239" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.83347 1.54911L8.84108 2.59961L7.79475 4.60938" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.327 12.2561C17.7227 14.9668 15.7318 17.2883 12.896 18.1791L12.1325 18.4189" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.1343 19.4509L12.1267 18.4004L13.173 16.3906" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.74161 18.355C6.03489 17.7467 3.71496 15.7501 2.82199 12.9088L2.58112 12.1418" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.55261 14.146L2.59895 12.1362L4.60653 13.1867" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.227 2.64644C14.934 3.25488 17.254 5.25196 18.1466 8.09376C18.1467 8.09417 18.1469 8.09454 18.147 8.09499L18.3927 8.87729" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.4474 6.82286L18.3749 8.88287L16.3171 7.80614" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.446 10.5C13.446 12.127 12.127 13.446 10.5 13.446C8.87296 13.446 7.55402 12.127 7.55402 10.5C7.55402 8.87296 8.87296 7.55398 10.5 7.55398C12.127 7.55398 13.446 8.87296 13.446 10.5Z" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.1232 7.1232L8.35694 8.35693" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.6431 12.6431L13.8768 13.8768" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.1232 13.8768L8.35694 12.6431" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.6431 8.35693L13.8768 7.1232" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.72449 10.5H7.46926" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.5308 10.5H15.2755" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 15.2755V13.5307" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 7.46924V5.72447" stroke="black" stroke-width="0.96" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> ECO System Practice</span>
                              </div>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo base_url(); ?>admin/work_orders"<?php if($active_menu=='work_orders'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                              <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_6_874" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="21" height="21">
                                    <path d="M0 1.90735e-06H21V21H0V1.90735e-06Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_6_874)">
                                    <path d="M17.4727 19.6821V20.2822C17.4727 20.5088 17.289 20.6924 17.0625 20.6924H3.9375C3.71101 20.6924 3.52734 20.5088 3.52734 20.2822V5.23277" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.7445 0.307621H17.0625C17.289 0.307621 17.4727 0.491248 17.4727 0.717777V18.3696" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.52734 3.91689V0.71779C3.52734 0.491261 3.71101 0.307634 3.9375 0.307634H14.4396" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.0684 6.82068C13.3435 6.82068 12.7559 6.23305 12.7559 5.50818C12.7559 4.78331 13.3435 4.19568 14.0684 4.19568C14.7932 4.19568 15.3809 4.78331 15.3809 5.50818C15.3809 6.23305 14.7932 6.82068 14.0684 6.82068Z" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.0684 12.3435C13.3435 12.3435 12.7559 11.7558 12.7559 11.031C12.7559 10.3061 13.3435 9.71848 14.0684 9.71848C14.7932 9.71848 15.3809 10.3061 15.3809 11.031C15.3809 11.7558 14.7932 12.3435 14.0684 12.3435Z" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.0684 17.8663C13.3435 17.8663 12.7559 17.2786 12.7559 16.5538C12.7559 15.8289 13.3435 15.2413 14.0684 15.2413C14.7932 15.2413 15.3809 15.8289 15.3809 16.5538C15.3809 17.2786 14.7932 17.8663 14.0684 17.8663Z" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.5762 5.16483L13.9674 5.7075L16.1254 4.66001" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.5762 10.8199L13.9674 11.3625L16.1254 10.315" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.52734 2.03029H17.4727" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.2885 6.62292H5.21823C5.12759 6.62292 5.05417 6.54947 5.05417 6.45886V4.57214C5.05417 4.48154 5.12759 4.40808 5.21823 4.40808H11.2885C11.3791 4.40808 11.4526 4.48154 11.4526 4.57214V6.45886C11.4526 6.54947 11.3791 6.62292 11.2885 6.62292Z" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.2885 12.1384H5.21823C5.12759 12.1384 5.05417 12.0649 5.05417 11.9743V10.0876C5.05417 9.99701 5.12759 9.92355 5.21823 9.92355H11.2885C11.3791 9.92355 11.4526 9.99701 11.4526 10.0876V11.9743C11.4526 12.0649 11.3791 12.1384 11.2885 12.1384Z" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.2885 17.6539H5.21823C5.12759 17.6539 5.05417 17.5804 5.05417 17.4898V15.6031C5.05417 15.5125 5.12759 15.439 5.21823 15.439H11.2885C11.3791 15.439 11.4526 15.5125 11.4526 15.6031V17.4898C11.4526 17.5804 11.3791 17.6539 11.2885 17.6539Z" stroke="black" stroke-width="0.4" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    </svg>
                                 <span> Work Orders</span>
                              </div>
                           </a>
                        </li>
               <?php } else { ?>
                    <ul class="metismenu list-unstyled" id="side-menu">
                  <li>
                     <a href="<?php echo base_url(); ?>admin/dashboard" class="waves-effect">
                        <div class="menu-item-left">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M16.1136 8.11364V5.93182C16.1136 5.35316 15.8838 4.79821 15.4746 4.38904C15.0654 3.97987 14.5105 3.75 13.9318 3.75H5.93182C5.35316 3.75 4.79821 3.97987 4.38904 4.38904C3.97987 4.79821 3.75 5.35316 3.75 5.93182V13.9318C3.75 14.5105 3.97987 15.0654 4.38904 15.4746C4.79821 15.8838 5.35316 16.1136 5.93182 16.1136H8.11364M16.1136 8.11364H17.5682C18.1468 8.11364 18.7018 8.34351 19.111 8.75268C19.5201 9.16185 19.75 9.7168 19.75 10.2955V17.5682C19.75 18.1468 19.5201 18.7018 19.111 19.111C18.7018 19.5201 18.1468 19.75 17.5682 19.75H10.2955C9.7168 19.75 9.16185 19.5201 8.75268 19.111C8.34351 18.7018 8.11364 18.1468 8.11364 17.5682V16.1136M16.1136 8.11364H10.2955C9.7168 8.11364 9.16185 8.34351 8.75268 8.75268C8.34351 9.16185 8.11364 9.7168 8.11364 10.2955V16.1136" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>
                           <span>Dashboard</span>
                        </div>
                     </a>
                  </li>
                  <?php
                     $role_id=$this->session->userdata('role_id');
                     $MenuData=$this->db->query("SELECT t1.`menu_id`, t1.`menu_name`, t1.`menu_icon`, t1.`is_active`, t2.`role_access_id`, t2.`id`, t2.`role_id`, t2.`menu_id` as `m_id`, t2.`sub_menu_name`, t2.`sub_menu_url`, t2.`access`, t2.`read`, t2.`write` FROM `menu` as `t1` LEFT JOIN `role_access` as `t2` ON `t1`.`menu_id` = `t2`.`menu_id` WHERE t2.`role_id`='$role_id' AND (t2.`read`=1 OR t2.`write`=1) GROUP BY t1.`menu_id`")->result_array();

                     foreach($MenuData as $Menu){
                  ?>
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="menu-item-left">
                           <?php echo $Menu['menu_icon']; ?>
                           <span><?php echo $Menu['menu_name']; ?> </span>
                        </div>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <?php 
                           $type=$this->session->userdata('type');
                           $MId=$Menu['menu_id'];
                           $SubMenuData=$this->db->query("SELECT t1.`sub_menu_id`, t1.`menu_id`, t1.`sub_menu_name`, t1.`sub_menu_url`, t1.`is_active`, t2.`id`, t2.`role_id`, t2.`menu_id` as `m_id`, t2.`sub_menu_name` as sub_menuname, t2.`sub_menu_url` as `sub_menuurl`,  t2.`sub_menu_icon`, t2.`access`, t2.`read`, t2.`write` FROM `sub_menu` as `t1` LEFT JOIN `role_access` as `t2` ON `t1`.`menu_id` = `t2`.`menu_id` WHERE t2.`role_id`='$role_id' AND (t2.`read`=1 OR t2.`write`=1) AND t2.`menu_id`=$MId GROUP BY t2.sub_menu_name")->result_array();
                           foreach($SubMenuData as $SubMenu){
                        ?>
                        <li>
                           <a href="<?php echo base_url(); ?><?php echo $SubMenu['sub_menuurl']; ?>"<?php if($active_menu=='<?php echo $this->uri->segment(2); ?>'){echo 'class="active_menu"';}?> >
                              <div class="menu-item-left">
                                 <?php echo $SubMenu['sub_menu_icon']; ?>
                                 <span><?php echo $SubMenu['sub_menuname']; ?></span>
                              </div>
                           </a>
                        </li>
                        <?php } ?>
                     </ul>
                  </li>
                  <?php } ?>
                  <?php
                        $MenuEmptyData=$this->db->query("SELECT t1.`sub_menu_id`, t1.`menu_id`, t1.`sub_menu_name`, t1.`sub_menu_url`,  t1.`sub_menu_icon`, t1.`is_active`, t2.`id`, t2.`role_id`, t2.`menu_id` as `m_id`, t2.`sub_menu_name` as sub_menuname, t2.`sub_menu_url` as `sub_menuurl`, t2.`access`, t2.`read`, t2.`write` FROM `sub_menu` as `t1` LEFT JOIN `role_access` as `t2` ON `t1`.`sub_menu_name` = `t2`.`sub_menu_name` WHERE t2.`role_id`='$role_id' AND (t2.`read`=1 OR t2.`write`=1) AND t2.`menu_id` IS NULL")->result_array();
                        foreach($MenuEmptyData as $EmptyMenu){
                  ?>
                  <li>
                     <a href="<?php echo base_url(); ?><?php echo $EmptyMenu['sub_menu_url']; ?>" <?php if($active_menu=='<?php echo $this->uri->segment(2); ?>'){echo 'class="active_menu direct_menu"';}?> >
                        <div class="menu-item-left">
                            <?php echo $EmptyMenu['sub_menu_icon']; ?>
                           <span><?php echo $EmptyMenu['sub_menu_name']; ?></span>
                        </div>
                     </a>
                  </li>
                  
                        
               <?php }  } ?>
                
            </div>
            <!-- Sidebar -->
         </div>
      </div>
      <!-- Left Sidebar End -->