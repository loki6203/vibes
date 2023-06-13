<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>::Vibho Employee Solutions::</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Vibho Employee Solutions" name="description" />
      <meta content="Vibho Employee Solutions" name="author" />

      <script>
         var base_url ='<?php echo base_url(); ?>';
      </script>
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/images/VIBES Final-sm.png">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <link href="<?php echo base_url(); ?>assets/admin/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <!-- Sweet Alert-->
      <link href="<?php echo base_url(); ?>assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <!-- Bootstrap Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="<?php echo base_url(); ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="<?php echo base_url(); ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/admin/css/zebra_datepicker.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">

      <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/sweetalert2@10.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/sweetalert.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/zebra_datepicker.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
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
   <body>
      <!-- <div class="page-content"> -->
      <div class="app-application-form py-4">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="app-application-form-field bg-white">
                  <div class="app-application-form-actions-heading p-4">
                     <h3 class="app-recruitment-create-heading mb-0">Candidate Application Form <i data-toggle="tooltip" data-placement="bottom" title="All candidates added to the job will receive this form to fill up in order to apply for the job." class="fas fa-info-circle"></i></h3>
                  </div>
                  <?php if(!empty($job) && !empty($company)){ ?>
                  <div class="app-application-form-fields-content">
                     <div class="app-application-form-fields-card p-4">
                        <h2><?php echo $job['job_title']; ?></h2>
                        <h6><?php echo $job['industry_type']; ?></h6>
                        <div class="d-flex align-itens-center justify-content-between">
                           <ul class="d-flex align-items-center p-0 m-0 list-style-none">
                              <li class="d-flex align-items-center mr-4"><i class="fas fa-sitemap mr-2"></i> <?php echo $job['department']; ?></li>
                              <li class="d-flex align-items-center mr-4" ><i class="fas fa-map-marker-alt mr-2"></i> <?php echo $job['location']; ?></li>
                              <li class="d-flex align-items-center"><i class="fas fa-graduation-cap mr-1"></i> Experience : <?php echo $job['work_experience_from']; ?> to <?php echo $job['work_experience_to']; ?></li>
                           </ul>
                        </div>
                     </div>
                     <div class="app-application-form-fields-group p-3">
                       <div class="d-flex">
                          <h4 class="app-application-form-fields-group-title mb-2">Job Details</h4>
                       </div>
                       <h6 class="mb-1">Must have key skills</h6>
                       <p class="text-muted mb-3"><?php echo $job['skills']; ?></p>
                       <h6 class="mb-1">Job Description</h6>
                       <span class="text-muted mb-3"><?php echo $job['job_description']; ?></span>
                       <h6 class="mb-1">Industry Type</h6>
                       <p class="text-muted mb-3"><?php echo $job['industry_type']; ?></p>
                       <h6 class="mb-1">Department</h6>
                       <p class="text-muted mb-3"><?php echo $job['department']; ?></p>
                       <h6 class="mb-1">Employment Type</h6>
                       <p class="text-muted mb-3"><?php echo $job['employment_type']; ?></p>
                       <h6 class="mb-1">Education</h6>
                       <p class="text-muted mb-3"><?php echo $job['education']; ?></p>
                   </div>
                     <div class="app-application-form-fields-group p-3">
                        <div class="d-flex">
                           <h4 class="app-application-form-fields-group-title">Personal Information</h4>
                        </div>
                        <form method="post" action="<?php echo base_url(); ?>admin/save_candidate_application" id="save_candidate_application" name="save_candidate_application" enctype="multipart/form-data" class="custom-validation">
                           <input type="hidden" name="ctype" id="ctype" value="Candidate">
                           <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id; ?>">
                           <input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id; ?>">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>First Name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" >
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Last Name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name" >
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email id" >
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>Contact Number  <span class="required-star">*</span></label>
                                 <div class="row">
                                    <div class="col-10">
                                       <div class="form-group">
                                          <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Enter Contact Number" >
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>Alternative Contact Number</label>
                                 <div class="row">
                                    <div class="col-10">
                                       <div class="form-group">
                                          <input type="text" class="form-control" name="phone_no_2" id="phone_no_2" placeholder="Enter Alternative Contact Number" >
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="d-block mb-3">Marital Status <span class="required-star">*</span></label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="customRadioInline1" name="married_status" class="custom-control-input" value="single">
                                       <label class="custom-control-label" for="customRadioInline1">Single</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="customRadioInline2" name="married_status" class="custom-control-input" value="married">
                                       <label class="custom-control-label" for="customRadioInline2">Married</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="customRadioInline3" name="married_status" class="custom-control-input" value="prefer_not_to_say" >
                                       <label class="custom-control-label" for="customRadioInline3">Prefer not to say</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="d-block mb-3">Gender <span class="required-star">*</span></label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="GcustomRadioInline1" name="gender" class="custom-control-input" value="male">
                                       <label class="custom-control-label" for="GcustomRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="GcustomRadioInline2" name="gender" class="custom-control-input" value="female">
                                       <label class="custom-control-label" for="GcustomRadioInline2">Female</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="GcustomRadioInline3" name="gender" class="custom-control-input" value="prefer_not_to_say" >
                                       <label class="custom-control-label" for="GcustomRadioInline3">Prefer not to say</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Date of Birth </label>
                                    <div>
                                       <div class="input-group">
                                          <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="dob" id="dob" autocomplete="off" >
                                          <div class="input-group-append">
                                             <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                          </div>
                                       </div>
                                       <!-- input-group -->
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="row">
                                    <div class="col-9">
                                       <div class="form-group">
                                          <label>Address <span class="required-star">*</span></label>
                                          <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" >
                                       </div>
                                    </div>
                                    <div class="col-3">
                                       <div class="form-group">
                                          <label>Postcode <span class="required-star">*</span></label>
                                          <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Enter Postcode" >
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="form-group row align-items-end">
                                          <div class="col-md-4">
                                             <label>City <span class="required-star">*</span></label>
                                             <input type="text" name="city" class="form-control" id="city" placeholder="Enter City">
                                          </div>
                                          <div class="col-md-4">
                                             <label>State/Province<span class="required-star">*</span></label>
                                             <input type="text" name="state" class="form-control" id="state" placeholder="Enter State/Province">
                                          </div>
                                          <div class="col-md-4">
                                             <label>Country <span class="required-star">*</span></label>
                                             <input type="text" name="country" class="form-control" id="country" placeholder="Enter Country">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12">
                               <div class="form-group">
                                  <label>Photo <span class="required-star">*</span></label>
                                  <form action="#" class="dropzone">
                                     <div class="fallback">
                                        <input type="file" name="photo" class="filestyle" id="photo" accept="image/png, image/jpg, image/jpeg">
                                     </div>
                                  </form>
                               </div>
                            </div>
<div class="col-md-6">
   <div class="form-group">
      <label>ID - Passport </label>
      <div class="fallback">
         <input type="file" class="filestyle" name="passport" id="passport" accept="image/png, image/jpg, image/jpeg">
      </div>
   </div>
</div>
<div class="col-md-6">
   <div class="form-group">
      <label>ID - Passport Number</label>
      <input type="text" class="form-control" name="id_passport_no" id="id_passport_no" placeholder="Enter Passport Number" >
   </div>
</div>
<div class="col-12">
   <div class="d-flex">
      <h4 class="app-application-form-fields-group-title">Personal Information</h4>
   </div>
</div>
<div class="col-12">
   <div class="form-group">
      <label>Resume <span class="required-star">*</span></label>
      <div class="fallback">
         <input type="file" class="filestyle" name="resume" id="resume" accept=".doc, .docx,.pdf">
      </div>
   </div>
</div>
<div class="col-12">
   <div class="row">
      <div class="col-md-6">
         <label>Current CTC <span class="required-star">*</span></label>
         <div class="row">
            <div class="col-6">
               <input type="text" class="form-control" name="ctc_from" id="ctc_from" placeholder="Enter From">
            </div>
            <div class="col-6">
               <input type="text" class="form-control" name="ctc_to" id="ctc_to" placeholder="Enter To">
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <label>Expected CTC <span class="required-star">*</span></label>
         <div class="row">
            <div class="col-6">
               <input type="text" class="form-control" name="excepted_ctc_from" id="excepted_ctc_from" placeholder="Enter From">
            </div>
            <div class="col-6">
               <input type="text" class="form-control" name="excepted_ctc_to" id="excepted_ctc_to" placeholder="Enter To">
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-12 mt-4">
   <div class="row">
      <div class="col-12">
         <label>Work experience</label>
         <div class="d-flex">
            <input type="checkbox" id="switch4" switch="success" checked name="work_exp"/>
            <label for="switch4" data-on-label="Yes" data-off-label="No"></label>
            <span class="ml-2">I’m a fresher</span>
         </div>
      </div>
      <div class="input_fields_wrap" id="main_div">
         <div id="main-div">
               <div class="col-12">
                  <div class="row" id="work_exp_div_<?php echo $sn;?>">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Company Name <span class="required-star">*</span></label>
                           <input type="text" name="company_name[]" id="company_name_<?php echo $sn;?>" class="form-control" placeholder="Enter Company Name">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Designation <span class="required-star">*</span></label>
                           <input type="text" name="designation[]" id="designation_<?php echo $sn;?>" class="form-control" placeholder="Enter Designation">
                        </div>
                     </div>
                     <div class="col-md-4 form-group">
                        <label>Duration <span class="required-star">*</span></label>
                        <div class="row">
                           <div class="col-6">
                              <input type="text" class="form-control" name="work_duration_start[]" id="work_duration_start_<?php echo $sn;?>" placeholder="Duration">
                           </div>
                           <div class="col-6">
                              <input type="text" name="work_duration_end[]" id="work_duration_end_<?php echo $sn;?>" class="form-control" placeholder="End">
                           </div>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="remote_in_carrer" id="remote_in_carrer">
                           <label class="custom-control-label" for="remote_in_carrer">List this job as Remote in Career Page.</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 mt-3">
                  <?php if($sn==1){ ?>
                  <a href="javascript:void(0);" class="btn btn-primary" id="more_<?php echo $sn;?>" onclick="addmore('<?php echo $sn;?>')">Add Work Experience</a>
                  <?php }else if($sn>1){ ?>
                  <a href="javascript:void(0);" class="btn btn-primary" id="more_<?php echo $sn;?>" onclick="addmore('<?php echo $sn;?>')">Add Work Experience</a>
                  <a href="javascript:void(0);" class="btn btn-primary" id="removemore_<?php echo $sn;?>" onclick="Deleterow('<?php echo $sn;?>')">Delete</a>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="input_fields_wrap" id="edu_main_div">
  <div class="col-12 mt-4">
           <div class="row" id="edu_div_<?php echo $sn;?>">
              <div class="col-12">
                 <div class="form-group row align-items-end">
                    <div class="col-md-4">
                       <label>Type <span class="required-star">*</span></label>
                       <input type="text" name="type[]" class="form-control" id="type_<?php echo $sn;?>" placeholder="Enter Type">
                    </div>
                    <div class="col-md-4">
                       <label>Course <span class="required-star">*</span></label>
                       <input type="text" name="course[]" class="form-control" id="course_<?php echo $sn;?>" placeholder="Enter Course">
                    </div>
                    <div class="col-md-4">
                       <label>Specialisation <span class="required-star">*</span></label>
                       <input type="text" name="specialisation[]" class="form-control" id="specialisation_<?php echo $sn;?>" placeholder="Enter Specialisation">
                    </div>
                 </div>
              </div>
              <div class="col-12">
                 <div class="row">
                    <div class="col-md-6">
                       <div class="form-group">
                          <label>Institution Name <span class="required-star">*</span></label>
                          <input type="text" name="institution_name[]" id="institution_name_<?php echo $sn;?>" class="form-control" placeholder="Enter  Institution Name">
                       </div>
                    </div>
                    <div class="col-md-6 form-group">
                       <label>Duration <span class="required-star">*</span></label>
                       <div class="row">
                          <div class="col-6">
                             <input type="text" name="edu_duration_start[]" id="edu_duration_start_<?php echo $sn;?>" class="form-control" placeholder="Start">
                          </div>
                          <div class="col-6">
                             <input type="text" name="edu_duration_end[]" id="edu_duration_end_<?php echo $sn;?>" class="form-control" placeholder="End">
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        <div class="col-12 mt-3">
           <?php if($sn==1){ ?>
               <a href="javascript:void(0);" class="btn btn-primary" id="edu_more_<?php echo $sn;?>" onclick="edu_addmore('<?php echo $sn;?>')">Add Education/Certification Details</a>
           <?php }else if($sn>1){ ?>
               <a href="javascript:void(0);" class="btn btn-primary" id="edu_more_<?php echo $sn;?>" onclick="edu_addmore('<?php echo $sn;?>')">Add Education/Certification Details</a>
               <a href="javascript:void(0);" class="btn btn-primary" id="edu_removemore_<?php echo $sn;?>" onclick="Deleterow('<?php echo $sn;?>')">Delete</a>
           <?php } ?>
        </div>
  </div>
</div>
<div class="col-12 mt-4">
  <div class="form-group">
     <label>Skills <span class="required-star">*</span></label>
     <input type="text" class="form-control" placeholder="Enter Skills" name="skills" id="skills" data-role="tagsinput">
  </div>
</div>
<div class="col-12 mt-4">
  <div class="form-group">
     <label>Work link/Portfolio </label>
     <input type="text" class="form-control" placeholder="Enter Work link/Portfolio" name="work_link_portfolio" id="work_link_portfolio" >
  </div>
</div>
<div class="col-12">
  <div class="form-group">
     <label>Notice Period <span class="required-star">*</span></label>
     <input type="text" class="form-control" placeholder="Enter Work Notice Period" name="notice_period" id="notice_period" >
  </div>
</div>
<div class="col-12">
  <div class="d-flex justify-content-end">
     <button class="btn btn-primary" type="submit">Submit</button>
  </div>
</div>
     </form>
     </div>
      <?php } else { ?>
      <span style="color: red;text-align: center;">no data found</span>
      <?php } ?>
   </div>
</div>
</div>
   </div>
</div>
      <script src="<?php echo base_url(); ?>assets/admin/libs/metismenu/metisMenu.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/node-waves/waves.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/parsleyjs/parsley.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/pages/form-validation.init.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/libs/select2/js/select2.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/pages/form-advanced.init.js"></script>
      <script src="<?php echo base_url(); ?>assets/admin/js/app.js"></script>
   </body>
</html>
<script>
   $(function(){
       $("#dob").datepicker({
         changeMonth: true,
         changeYear: true,
         dateFormat: 'dd-mm-yy',
         yearRange: '-60:+10'
       });
   });
   var sn='<?php echo $sn;?>';
   $('#work_duration_start_'+sn).Zebra_DatePicker({
           format: 'M-Y',
           pair: $('#work_duration_end_'+sn)
   });
   $('#work_duration_end_'+sn).Zebra_DatePicker({
           format: 'M-Y'
   });
   $('#edu_duration_start_'+sn).Zebra_DatePicker({
           format: 'M-Y',
           pair: $('#edu_duration_end_'+sn)
   });
   $('#edu_duration_end_'+sn).Zebra_DatePicker({
           format: 'M-Y'
   });

   $(document).ready(function(){
     var sn='<?php echo $sn;?>';
     $("#save_candidate_application").validate({
     rules:{
       fname:{required:true},
       lname:{required:true},
       email:{required:true},
       phone_no:{required:true},
       married_status:{required:true},
       gender:{required:true},
       dob:{required:true},
       city:{required:true},
       postcode:{required:true},
       city:{required:true},
       state:{required:true},
       country:{required:true},
       photo:{required:true},
       resume:{required:true},
       ctc_from:{required:true},
       ctc_to:{required:true},
       excepted_ctc_from:{required:true},
       excepted_ctc_to:{required:true},
       skills:{required:true},
       notice_period:{required:true},
     },
     messages:{},
     ignore: []
     });
       $("#company_name_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#designation_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#work_duration_start_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#work_duration_end_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#type_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#course_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#specialisation_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#institution_name_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#edu_duration_start_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       $("#edu_duration_end_"+sn).rules('add', {
           required: true,
           messages: {
               required: "This field is required."
           }
       });
       ignore: [];
   }); 
   function edu_addmore(id)
   {
     $.ajax({
           url: '<?php echo site_url("admin/add_edu_fields"); ?>',
           type: 'POST',
           data: {sn: id},
           dataType: 'html',
           success: function(data) {
           $("#edu_main_div").append(data);
           $("#edu_more_"+id).remove();
           }
       });
   }
   function Deleterow(sn)
   {
     $("#edu_div_"+sn).remove();
     $("#edu_removemore_"+sn).remove(); 
     $(".edu_label_"+sn).remove();
   }
   function addmore(id)
   {
     $.ajax({
           url: '<?php echo site_url("admin/add_work_exp_fields"); ?>',
           type: 'POST',
           data: {sn: id},
           dataType: 'html',
           success: function(data) {
           $("#main_div").append(data);
           $("#more_"+id).remove();
           }
       });
   }
   function Deleterow(sn)
   {
     $("#work_exp_div_" + sn).remove();
     $("#removemore_" + sn).remove(); 
   }
</script>