<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
<div class="main-content">
    <div class="page-content">
        <div class="app-application-form">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="app-application-form-field bg-white">
                            <div class="app-application-form-actions-heading p-4">
                                <h3 class="app-recruitment-create-heading mb-0">Candidate Application Form <i data-toggle="tooltip" data-placement="bottom" title="All candidates added to the job will receive this form to fill up in order to apply for the job." class="fas fa-info-circle"></i></h3>
                            </div>
        <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
    <?php if(!empty($job) && !empty($company)){ ?>
        <div class="app-application-form-fields-content">
           <div class="app-application-form-fields-card p-4">
            <?php if($this->session->userdata('role_id')=='Admin'){ ?>
                <h2><?php echo $company['company_name']; ?></h2>
                <h6><?php echo $job['industry_type']; ?></h6>
            <?php } else { ?>
                <h2><?php echo $job['industry_type']; ?></h2>
            <?php } ?>
              <div class="d-flex align-itens-center justify-content-between">
                 <ul class="d-flex align-items-center p-0 m-0 list-style-none">
                    <li class="d-flex align-items-center mr-4"><i class="fas fa-sitemap mr-2"></i> <?php echo $job['department']; ?></li>
                    <li class="d-flex align-items-center mr-4" ><i class="fas fa-map-marker-alt mr-2"></i> <?php echo $job['location']; ?></li>
                    <li class="d-flex align-items-center"><i class="fas fa-graduation-cap mr-1"></i> Experience : <?php echo $job['work_experience_from']; ?> to <?php echo $job['work_experience_to']; ?></li>
                 </ul>
                 <ul class="d-flex p-0 m-0 list-style-none">
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#preview-job-dialog" class="btn mr-3">Preview Job Details</a></li>
                    <!-- <li><button class="btn btn-primary"> Submit Application </button></li> -->
                    <li><a href="<?php echo base_url(); ?>admin/candidate_status/<?php echo $company_id; ?>/<?php echo $job_id; ?>" class="btn btn-primary"> <i class="mdi mdi-arrow-left-bold mr-2"></i> Back </a></li>
                 </ul>
              </div>
           </div>
           <div class="app-application-form-fields-group p-3">
              <div class="d-flex">
                 <h4 class="app-application-form-fields-group-title">Personal Information</h4>
              </div>
              <form method="post" action="<?php echo base_url(); ?>admin/save_candidate_application" id="save_candidate_application" name="save_candidate_application" enctype="multipart/form-data" class="custom-validation">
                <input type="hidden" name="ctype" id="ctype" value="">
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
                    <label>Alternative Contact Number <span class="required-star">*</span></label>
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
                       <label>Date of Birth <span class="required-star">*</span></label>
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
                 <div class="col-md-6">
                    <div class="form-group">
                       <label>Photo <span class="required-star">*</span></label>
                       <form action="#" class="dropzone">
                          <div class="fallback">
                             <input type="file" name="photo" id="photo" class="filestyle" accept="image/png, image/jpg, image/jpeg">
                          </div>
                       </form>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                       <label>ID - Passport </label>
                          <div class="fallback">
                             <input type="file" name="passport" id="passport" class="filestyle" accept="image/png, image/jpg, image/jpeg">
                          </div>
                    </div>
                 </div>
                 <div class="col-3">
                      <div class="form-group">
                         <label>ID - Passport Number </label>
                         <input type="text" class="form-control" name="id_passport_no" id="id_passport_no" placeholder="Enter Passport Number" >
                      </div>
                  </div>
                 <div class="col-12">
                    <div class="d-flex">
                       <h4 class="app-application-form-fields-group-title">Personal Information</h4>
                    </div>
                 </div>
                 <div class="col-md-6">
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
                             <!-- <div class="col-6">
                                <input type="text" class="form-control" name="ctc_from" id="ctc_from" placeholder="Enter From">
                             </div> -->
                             <div class="col-6">
                                <input type="text" class="form-control" name="ctc_to" id="ctc_to" placeholder="Enter Current CTC">
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
                            <?php echo $work_exp_more; ?>
                       </div>


                    </div>
                 </div>
                 


                <div class="input_fields_wrap" id="edu_main_div">
                    <?php echo $edu_more; ?>
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
                       <button class="btn btn-primary" type="submit">Save</button>&nbsp;&nbsp;
                       <button class="btn btn-primary-new" type="submit">Save & Continue</button>
                    </div>
                 </div>
              </div></form>
           </div>
        </div>
    <?php } else { ?>
        <span style="color: red;text-align: center;">no data found</span>
    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Model-->
<div class="modal fade bs-example-modal-xl" id="preview-job-dialog"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Preview Job Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <input type="hidden" name="model_edit_id" id="model_edit_id">
         <div class="modal-body">
            <div class="preview-job-dialog-content">
               <div class="preview-job-dialog-heading">
                  <h4><?php echo ucfirst($job['job_title']); ?></h4>
                  <ul class="d-flex align-items-center p-0 m-0 list-style-none">
                     <li><?php echo ucfirst($job['location']); ?></li>
                     <li class="mx-3">|</li>
                     <li><?php echo ucfirst($job['department']); ?></li>
                  </ul>
               </div>
               <div class="preview-job-dialog-body-wrapper d-flex">
                  <div class="preview-job-dialog-body-left p-3">
                     <div><?php echo $job['job_description']; ?></div>
                  </div>
                  <div class="preview-job-dialog-body-right p-3">
                     <ul class="p-0 m-0 list-style-none d-flex flex-column">
                        <li class="mb-2">
                           <h6 class="mb-2">Employment Type </h6>
                           <p><?php echo $job['employment_type']; ?></p>
                        </li>
                        <li class="mb-2">
                           <h6 class="mb-2">Seniority Level  </h6>
                           <p><?php echo $job['seniority_level']; ?></p>
                        </li>
                        <li class="mb-2">
                           <h6 class="mb-2">Industry Type  </h6>
                           <p><?php echo $job['industry_type']; ?></p>
                        </li>
                        <li class="mb-2">
                           <h6 class="mb-2">Skills </h6>
                           <ul class="preview-job-dialog-skills model_skills">
                              <?php 
                              if($job['skills']!=''){
                                $ArrSkills=explode(",",@$job['skills']);
                                foreach($ArrSkills as $Skills){ ?>
                                    <li><?php echo $Skills; ?></li>
                              <?php } } ?>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
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
    phone_no_2:{required:true},
    married_status:{required:true},
    gender:{required:true},
    dob:{required:true},
    address:{required:true},
    city:{required:true},
    postcode:{required:true},
    city:{required:true},
    state:{required:true},
    country:{required:true},
    photo:{required:true},
    resume:{required:true},
    // ctc_from:{required:true},
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
    // $("#work_duration_start_"+sn).rules('add', {
    //     required: true,
    //     messages: {
    //         required: "This field is required."
    //     }
    // });
    // $("#work_duration_end_"+sn).rules('add', {
    //     required: true,
    //     messages: {
    //         required: "This field is required."
    //     }
    // });
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
    // $("#edu_duration_start_"+sn).rules('add', {
    //     required: true,
    //     messages: {
    //         required: "This field is required."
    //     }
    // });
    // $("#edu_duration_end_"+sn).rules('add', {
    //     required: true,
    //     messages: {
    //         required: "This field is required."
    //     }
    // });
    ignore: [];
}); 
$('#ctc_to,#excepted_ctc_from,#excepted_ctc_to').keypress(function(e) {
    if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
    })
    .on("cut copy paste",function(e){
    e.preventDefault();
  });
</script>

