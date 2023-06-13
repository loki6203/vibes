<style>
    .rate{
    float: right;
    height: 46px;
    padding: 0px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">


        <div class="app-recruitment-cadidate-modal mt-4">
            <div class="new-back-button">
            <a class="btn new-back btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/candidate_status/<?php echo $company_id; ?>/<?php echo $job_id; ?>"><i class="mdi mdi-arrow-left-bold mr-2"></i>Back</a>
            </div>
            <div class="app-recruitment-cadidate-profile new-app-recruitment-cadidate-profile bg-white d-flex">
            <div class="app-recruitment-cadidate-profile-image d-flex justify-content-center align-items-center">
                <img src="<?php echo base_url(); ?>/assets/candidate_images/<?php echo $user_details['user_photo_path']; ?>">
            </div>
            <div class="app-recruitment-cadidate-profile-detail">
                <div class="app-recruitment-cadidate-profile-title  d-flex flex-column">
                    <h1 class="font-size-18 mb-0"><?php echo $user_details['fname']; ?> <?php echo $user_details['lname']; ?><button data-toggle="tooltip" data-placement="bottom" title="Share" type="button" class="profile-share-btn plain-btn ml-1"></button>
                    </h1>
                    <div class="rate custom-app-rate">
                    <?php 
                        $rate=$user_details['rating'];
                        if($rate!='')
                        {
                            if($rate==1){ ?>
                                    <input type="radio" id="star5" name="rate" value="5" class="rating" onclick="Rating(5);"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" class="rating" onclick="Rating(4);"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" class="rating" onclick="Rating(3);"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" class="rating" onclick="Rating(2);"/>
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" class="rating" onclick="Rating(1);"/>
                                    <label for="star1" title="text" style="color: #ffc700">1 star</label>
                            <?php }else if($rate==2){ ?>
                                    <input type="radio" id="star5" name="rate" value="5" class="rating" onclick="Rating(5);"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" class="rating" onclick="Rating(4);"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" class="rating" onclick="Rating(3);"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" class="rating" onclick="Rating(2);"/>
                                    <label for="star2" title="text" style="color: #ffc700">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" class="rating" onclick="Rating(1);"/>
                                    <label for="star1" title="text" style="color: #ffc700">1 star</label>
                            <?php }else if($rate==3){ ?>
                                   <input type="radio" id="star5" name="rate" value="5" class="rating" onclick="Rating(5);"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" class="rating" onclick="Rating(4);"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" class="rating" onclick="Rating(3);"/>
                                    <label for="star3" title="text" style="color: #ffc700">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" class="rating" onclick="Rating(2);"/>
                                    <label for="star2" title="text" style="color: #ffc700">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" class="rating" onclick="Rating(1);"/>
                                    <label for="star1" title="text" style="color: #ffc700">1 star</label>
                                <?php }else if($rate==4){ ?>
                                    <input type="radio" id="star5" name="rate" value="5" class="rating" onclick="Rating(5);"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" class="rating" onclick="Rating(4);"/>
                                    <label for="star4" title="text" style="color: #ffc700">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" class="rating" onclick="Rating(3);"/>
                                    <label for="star3" title="text" style="color: #ffc700">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" class="rating" onclick="Rating(2);"/>
                                    <label for="star2" title="text" style="color: #ffc700">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" class="rating" onclick="Rating(1);"/>
                                    <label for="star1" title="text" style="color: #ffc700">1 star</label>
                                <?php }else if($rate==5){ ?>
                                    <input type="radio" id="star5" name="rate" value="5" class="rating" onclick="Rating(5);"/>
                                    <label for="star5" title="text" style="color: #ffc700">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" class="rating" onclick="Rating(4);"/>
                                    <label for="star4" title="text" style="color: #ffc700">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" class="rating" onclick="Rating(3);"/>
                                    <label for="star3" title="text" style="color: #ffc700">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" class="rating" onclick="Rating(2);"/>
                                    <label for="star2" title="text" style="color: #ffc700">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" class="rating" onclick="Rating(1);"/>
                                    <label for="star1" title="text" style="color: #ffc700">1 star</label>
                        <?php } }else { ?>
                            <div class="rate custom-app-rate">
                                    <input type="radio" id="star5" name="rate" value="5" class="rating" onclick="Rating(5);"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" class="rating" onclick="Rating(4);"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" class="rating" onclick="Rating(3);"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" class="rating" onclick="Rating(2);"/>
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" class="rating" onclick="Rating(1);"/>
                                    <label for="star1" title="text">1 star</label>
                            </div>
                        <?php } ?>
                    </div>
                    <ul class="d-flex flex-wrap p-0 m-0 list-style-none">
                        <li data-toggle="tooltip" data-placement="bottom" title="Email ID"><i class="fas fa-envelope"></i> <span><a href="#"><?php echo $user_details['email_id']; ?></a></span></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Role"><i class="fas fa-user-tag"></i> <span>UI Developer</span></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $user_details['city']; ?></span></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Phone No"><i class="fas fa-phone"></i> <span><a href="#">+27 <?php echo $user_details['phone_no']; ?></a></span></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Experience"><i class="fas fa-briefcase"></i> <span>
                            +<?php 
                            $exp=$this->db->query("SELECT `job_work_expericence_id`, `candidate_applied_id`, `company_name`, `designation`, `work_duration_start`, `work_duration_end`, SUM(`years`) as `years`, SUM(`months`) as `months` FROM `candidate_work_expericence` WHERE `candidate_applied_id`=$candidate_applied_id")->result_array();
                            $Years=$exp[0]['years'];
                            $Months=$exp[0]['months'];
                            $YearsMnth=floor($Months/12);
                            $MonthMnths=$Months%12;
                            $TotlYear=$Years+$YearsMnth;
                            echo $TotlYear; ?> years <?php echo $MonthMnths; ?> months</span></li>
                    </ul>
                    
                    <div class="cadidate-status-strip">
                        <?php if($statusVal=='source/applied'){ ?>
                            <span class="cadidate-status-applied">Applied</span>
                        <?php } else if($statusVal=='internal_interview'){ ?>
                            <span class="cadidate-status-applied">internal interview</span>
                        <?php } else if($statusVal=='client_interview'){ ?>
                            <span class="cadidate-status-applied">client interview</span>
                        <?php } else{ ?>
                            <span class="cadidate-status-applied"><?php echo $statusVal; ?></span>
                        <?php } ?>
                    </div>
                </div>
                <ul class="app-recruitment-cadidate-skills list-style-none p-0 d-flex flex-wrap">
                    <?php 
                        $mySkills=@$user_details['skills'];
                        $myArray = explode(',', @$mySkills);
                        $user_skills_two=array_slice(@$myArray, 0, 2);
                        $user_skills_three=array_slice(@$myArray, 2, 100);
                        foreach ($user_skills_two as $two_skills) {
                    ?>
                        <li><?php echo $two_skills; ?></li>
                    <?php } ?>
                    <?php if(!empty($user_skills_three) && $user_skills_three>2){ ?>
                    <li class="dropdown skill-overflow-btn">
                    <button class="" type="button" data-toggle="dropdown" aria-expanded="false">
                        +<?php echo count($user_skills_three); ?>
                    </button>
                    <div class="dropdown-menu">
                        <ul class="d-flex flex-wrap p-3 m-0 list-style-none">
                            <?php foreach ($user_skills_three as $key => $three_skills) { ?>
                            <li><?php echo $three_skills; ?></li>
                           <?php } ?> 
                        </ul>
                    </div>
                    </li>
                <?php } ?>
                </ul>
                <ul class="candidate-profile-actions new-app-candidate-profile-actions d-flex justify-content-end list-style-none mt-3 align-items-center">
                    <li class="mr-md-3">
                        <a class="candidate-action-btn candidate-schedule-btn"><i class="far fa-calendar-plus"></i> Schedule Interview</a>
                    </li>
                    <li class="mr-md-3">
                        <a class="candidate-action-btn candidate-hire-btn" onclick="Status('hired',<?php echo $candidate_applied_id; ?>);"><i class="fas fa-hands-helping"></i> Hire</a>
                    </li>
                    <li class="mr-md-3 ">
                        <a class="candidate-action-btn candidate-reject-btn" onclick="Status('rejected',<?php echo $candidate_applied_id; ?>);"><i class="fas fa-thumbs-down"></i> Reject</a>
                    </li>
                    <li class="dropdown">
                        <button class="candidate-action-btn candidate-move-btn" type="button" data-toggle="dropdown" aria-expanded="false">Move Candidate</button>
                        <div class="dropdown-menu status-candidate">
                            <div class="move-cls">
                                <?php echo $status; ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist" id="myTab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#application-form" role="tab">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">Application form</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#resume" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Resume</span> 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#passport" role="tab">
                        <span class="d-block d-sm-none"><i class="fa fa-id-card" aria-hidden="true"></i></i></span>
                        <span class="d-none d-sm-block">ID-Passport</span>   
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#attachments" role="tab">
                        <span class="d-block d-sm-none"><i class="fa fa-paperclip" aria-hidden="true"></i></span>
                        <span class="d-none d-sm-block">Attachmeents</span>   
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Comments" role="tab">
                        <span class="d-block d-sm-none"><i class="fa fa-comments" aria-hidden="true"></i></span>
                        <span class="d-none d-sm-block">Comments</span>   
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active py-4" id="application-form" role="tabpanel">
                    <form method="post" action="<?php echo base_url(); ?>admin/update_candidate_profile" id="update_candidate_profile" name="update_candidate_profile" enctype="multipart/form-data" class="custom-validation">
                        <input type="hidden" name="candidate_applied_id" id="candidate_applied_id" value="<?php echo @$candidate_applied_id; ?>">
                    <div class="app-application-form-fields-group">
                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="app-application-form-fields-group-title mb-0">Personal Information</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" value="<?php echo $user_details['fname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name" value="<?php echo $user_details['lname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email id" value="<?php echo $user_details['email_id']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Contact Number  <span class="required-star">*</span></label>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Enter Contact Number" value="<?php echo $user_details['phone_no']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label class="d-block mb-3">Marital Status <span class="required-star">*</span></label>
                                   <div class="custom-control custom-radio custom-control-inline">
                                      <input type="radio" id="customRadioInline1" name="married_status" class="custom-control-input" value="single" <?php if($user_details['married_status']=='single') echo "checked"; ?>>
                                      <label class="custom-control-label" for="customRadioInline1">Single</label>
                                   </div>
                                   <div class="custom-control custom-radio custom-control-inline">
                                      <input type="radio" id="customRadioInline2" name="married_status" class="custom-control-input" value="married" <?php if($user_details['married_status']=='married') echo "checked"; ?>>
                                      <label class="custom-control-label" for="customRadioInline2">Married</label>
                                   </div>
                                   <div class="custom-control custom-radio custom-control-inline">
                                      <input type="radio" id="customRadioInline3" name="married_status" class="custom-control-input" value="prefer_not_to_say" <?php if($user_details['married_status']=='prefer_not_to_say') echo "checked"; ?>>
                                      <label class="custom-control-label" for="customRadioInline3">Prefer not to say</label>
                                   </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth <span class="required-star">*</span></label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="dob" id="dob" autocomplete="off" value="<?php echo DD_MM_YY($user_details['dob']); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block mb-3">Gender <span class="required-star">*</span></label>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="GcustomRadioInline1" name="gender" class="custom-control-input" value="male" <?php if($user_details['gender']=='male') echo "checked"; ?>>
                                          <label class="custom-control-label" for="GcustomRadioInline1">Male</label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="GcustomRadioInline2" name="gender" class="custom-control-input" value="female" <?php if($user_details['gender']=='female') echo "checked"; ?>>
                                          <label class="custom-control-label" for="GcustomRadioInline2">Female</label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="GcustomRadioInline3" name="gender" class="custom-control-input" value="prefer_not_to_say" <?php if($user_details['gender']=='prefer_not_to_say') echo "checked"; ?>>
                                          <label class="custom-control-label" for="GcustomRadioInline3">Prefer not to say</label>
                                       </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Address <span class="required-star">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="<?php echo $user_details['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Postcode <span class="required-star">*</span></label>
                                            <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Enter Postcode" value="<?php echo $user_details['postcode']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row align-items-end">
                                            <div class="col-md-4 mb-2 mb-md-0">
                                                <label>City <span class="required-star">*</span></label>
                                                <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" value="<?php echo $user_details['city']; ?>">
                                             </div>
                                             <div class="col-md-4 mb-2 mb-md-0">
                                                <label>State/Province<span class="required-star">*</span></label>
                                                <input type="text" name="state" class="form-control" id="state" placeholder="Enter State/Province" value="<?php echo $user_details['state']; ?>">
                                             </div>
                                             <div class="col-md-4">
                                                <label>Country <span class="required-star">*</span></label>
                                                <input type="text" name="country" class="form-control" id="country" placeholder="Enter Country" value="<?php echo $user_details['country']; ?>">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <label>Current CTC <span class="required-star">*</span></label>
                                        <div class="row">
                                            <!-- <div class="col-6">
                                                <input type="text" name="ctc_from" class="form-control" id="ctc_from" placeholder="Enter From" value="<?php echo $user_details['ctc_from']; ?>">
                                            </div> -->
                                            <div class="col-12">
                                                <input type="text" name="ctc_to" class="form-control" id="ctc_to" placeholder="Enter Current CTC" value="<?php echo $user_details['ctc_to']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label>Expected CTC <span class="required-star">*</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="excepted_ctc_from" class="form-control" id="excepted_ctc_from" placeholder="Enter From" value="<?php echo $user_details['excepted_ctc_from']; ?>">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="excepted_ctc_to" class="form-control" id="excepted_ctc_to" placeholder="Enter To" value="<?php echo $user_details['excepted_ctc_to']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 mb-2 mb-md-0">
                                        <label>Work experience</label>
                                        <div class="d-flex">
                                            <input type="checkbox" id="switch4" switch="success" name="work_exp" <?php if($user_details['work_experience']=='checked') echo "checked"; ?>/>
                                            <label for="switch4" data-on-label="Yes" data-off-label="No"></label>
                                            <span class="ml-2">I’m a fresher</span>
                                        </div>
                                    </div>

                                    <?php if(!empty($work_exp)){foreach ($work_exp as $key=> $work) { ?>
                                        <input type="hidden" name="job_work_expericence_id[]" value="<?php echo $work['job_work_expericence_id']; ?>">
                                    <div class="col-12 input_fields_wrap" id="main_div">
                                        <div class="row" id="main-div">
                                               <div class="col-12">
                                                  <div class="row" id="work_exp_div_<?php echo $work['job_work_expericence_id'];?>">
                                                     <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label>Company Name <span class="required-star">*</span></label>
                                                           <input type="text" name="company_name[]" id="company_name_<?php echo $work['job_work_expericence_id'];?>" class="form-control" placeholder="Enter Company Name" value="<?php echo $work['company_name']; ?>">
                                                        </div>
                                                     </div>
                                                     <div class="col-md-4">
                                                        <div class="form-group">
                                                           <label>Designation <span class="required-star">*</span></label>
                                                           <input type="text" name="designation[]" id="designation_<?php echo $work['job_work_expericence_id'];?>" class="form-control" placeholder="Enter Designation" value="<?php echo $work['designation']; ?>">
                                                        </div>
                                                     </div>
                                                     <div class="col-md-4 form-group">
                                                        <label>Duration </label>
                                                        <div class="row">
                                                           <div class="col-6">
                                                              <input type="text" class="form-control work_duration_start" name="work_duration_start[]" id="work_duration_start_<?php echo $work['job_work_expericence_id'];?>" placeholder="Duration" value="<?php echo $work['work_duration_start']; ?>">
                                                           </div>
                                                           <div class="col-6">
                                                              <input type="text" name="work_duration_end[]" id="work_duration_end_<?php echo $work['job_work_expericence_id'];?>" class="form-control work_duration_end" placeholder="End" value="<?php echo $work['work_duration_end']; ?>">
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
                                                <?php if($key==0){ ?>
                                                  <a href="javascript:void(0);" class="btn btn-primary" id="more_<?php echo $sn;?>" onclick="addmore(<?php echo $sn;?>)">Add Work Experience</a>
                                                   <?php }else if($key>=1){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-primary" id="more_<?php echo $sn;?>" onclick="addmore(<?php echo $sn;?>)">Add Work Experience</a>
                                                    <a href="javascript:void(0);" class="btn btn-primary" id="removemore_<?php echo $sn;?>" onclick="Deleterow(<?php echo $sn;?>)">Delete</a>
                                                  <?php } ?>
                                               </div>
                                         </div>
                                    </div>
                                <?php } } ?>

                                </div>
                            </div>
                            
                             <?php if(!empty($edu)){foreach ($edu as $key=> $ed) { ?>
                            <input type="hidden" name="candidate_education_id[]" value="<?php echo $ed['candidate_education_id']; ?>">
                                <div class="col-12 mt-4" id="edu_main_div">
                                 <div class="edu_label_<?php echo $ed['candidate_education_id'];?>">
                                <label>Education Details</label>
                                 </div>
                                      <div class="row" id="edu_div_<?php echo $ed['candidate_education_id'];?>">
                                       <div class="col-12">
                                        
                                          <div class="form-group row align-items-end">
                                             <div class="col-md-4 mb-2 mb-md-0">
                                                <label>Type <span class="required-star">*</span></label>
                                                <select class="form-control select2" name="type[]" id="type_<?php echo $sn;?>">
                                                  <option disabled selected value="">Select Type</option>
                                                        <?php if(!empty($types)){foreach ($types as $ty) {
                                                            ?>
                                                             <option value="<?php echo @$ty['type_id']; ?>" <?php echo (@$ty['type_id']==@$ed['type_id'])?'selected':'';?>><?php echo @$ty['name'];?></option>
                                                        <?php } } ?>
                                                    </select>
                                             </div>
                                             <div class="col-md-4 mb-3 mb-md-0">
                                                <select class="form-control select2" name="course[]" id="course_<?php echo $sn;?>">
                                                  <option disabled selected value="">Select Course</option>
                                                <?php if(!empty($course)){foreach ($course as $cou) {
                                                            ?>
                                                             <option value="<?php echo @$cou['course_id']; ?>" <?php echo (@$cou['course_id']==@$ed['course_id'])?'selected':'';?>><?php echo @$cou['name'];?></option>
                                                        <?php } } ?>
                                                    </select>
                                             </div>
                                             <div class="col-md-4">
                                                <label>Specialisation <span class="required-star">*</span></label>
                                                <input type="text" class="form-control" name="specialisation[]" id="specialisation_<?php echo $ed['candidate_education_id'];?>" value="<?php echo $ed['specialisation'];?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label>Institution Name <span class="required-star">*</span></label>
                                                   <input type="text" name="institution_name[]" id="institution_name_<?php echo $ed['candidate_education_id'];?>" class="form-control" placeholder="Enter Institution Name" value="<?php echo $ed['institution_name']; ?>">
                                                </div>
                                             </div>
                                             <div class="col-md-6 form-group">
                                                <label>Duration </label>
                                                <div class="row">
                                                   <div class="col-6">
                                                      <input type="text" name="edu_duration_start[]" id="edu_duration_start_<?php echo $ed['candidate_education_id'];?>" class="form-control edu_duration_start" placeholder="Start" value="<?php echo $ed['edu_duration_start']; ?>">
                                                   </div>
                                                   <div class="col-6">
                                                      <input type="text" name="edu_duration_end[]" id="edu_duration_end_<?php echo $ed['candidate_education_id'];?>" class="form-control edu_duration_end" placeholder="End" value="<?php echo $ed['edu_duration_end']; ?>">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 mt-3">
                                          <?php if($sn==1){ ?>
                                            <a href="javascript:void(0);" class="btn btn-primary" id="edu_more_<?php echo $ed['candidate_education_id'];?>" onclick="edu_addmore(<?php echo $sn;?>)">Add Education Details</a>
                                             <?php }else if($sn>1){ ?>
                                              <a href="javascript:void(0);" class="btn btn-primary" id="edu_more_<?php echo $ed['candidate_education_id'];?>" onclick="edu_addmore(<?php echo $sn;?>)">Add Education Details</a>
                                              <a href="javascript:void(0);" class="btn btn-primary" id="edu_removemore_<?php echo $ed['candidate_education_id'];?>" onclick="Deleterow(<?php echo $sn;?>)">Delete</a>
                                          <?php } ?>
                                       </div>
                                    </div>
                            </div>
                        <?php } } ?>

                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <label>Skills <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Skills" name="skills" id="skills" data-role="tagsinput" value="<?php echo $user_details['skills']; ?>">
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <label>Work link/Portfolio</label>
                                    <input type="text" class="form-control" placeholder="Enter Work link/Portfolio" name="work_link_portfolio" id="work_link_portfolio" value="<?php echo $user_details['work_link_portfolio']; ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Notice Period <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Work Notice Period" name="notice_period" id="notice_period" value="<?php echo $user_details['notice_period']; ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div></form>
                </div>
                <div class="tab-pane p-3" id="resume" role="tabpanel">
                    <label>View :</label>
                    <a href="<?php echo base_url(); ?>assets/candidate_resumes/<?php echo $user_details['user_resume_path']; ?>" target="_blank">
                        <?php echo $user_details['user_resume_name']; ?>
                    </a>
                </div>
                <div class="tab-pane p-3" id="passport" role="tabpanel">
                    <div class="form-group">
                        <label>Passport :</label>
                        <a href="<?php echo base_url(); ?>assets/candidate_passports/<?php echo $user_details['user_passport_path']; ?>" target="_blank">
                        <?php echo $user_details['user_passport_name']; ?>
                    </a>
                        <form action="#" method="post" name="save_passport_id" id="save_passport_id" class="custom-validation" onsubmit="return savePassportID()">
                            <input type="hidden" name="candidate_applied_id" id="candidate_applied_id" value="<?php echo @$candidate_applied_id; ?>">
                            <input type="text" name="id_passport_no" id="id_passport_no" placeholder="Enter ID-Passport No" class="form-control" required value="<?php echo @$user_details['id_passport_no']; ?>">
                            <br>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>
                </div>
                <div class="tab-pane p-3" id="attachments" role="tabpanel">
                    <div class="form-group">
                    <?php if(!empty($attachmeents)){$aa=1;foreach ($attachmeents as $atta) { ?>
                        <?php echo $aa; ?>)<a href="<?php echo base_url(); ?>assets/candidate_attachmeents/<?php echo $atta['candidate_attachmeent_path']; ?>" target="_blank"><?php echo $atta['candidate_attachmeent_name']; ?></a><br><br>
                    <?php $aa++;} } ?> <br>  
                        <form action="<?php echo base_url(); ?>admin/candidate_attachmeents" method="post" name="candidate_attachmeents" id="candidate_attachmeents" enctype="multipart/form-data" class="custom-validation">
                            <input type="hidden" name="candidate_applied_id" id="candidate_applied_id" value="<?php echo @$candidate_applied_id; ?>">
                            <label>Upload <span class="required-star">*</span></label>
                            <input type="file" name="file[]" accept="image/png, image/jpg, image/jpeg" required multiple="multiple" class="mb-2 mb-md-0">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </form>
                    </div>
                </div>
                <div class="tab-pane p-3" id="Comments" role="tabpanel">
                    <div class="form-group">
                        <input type="hidden" name="candidate_applied_id" id="candidate_applied_id" value="<?php echo @$candidate_applied_id; ?>">
                        <textarea rows="5" cols="55" name="comments" id="comments" placeholder="Enter Comments" class="form-control cmnts"></textarea>
                        <div class="d-flex justify-content-end mt-4">
                            <input type="button" class="btn btn-primary" value="Save" onclick="Comments();">
                        </div>
                    </div>
                    <div class="main-div-previos-comments">
                         <div class="indidual-div-previos-comments">
                        <?php if(!empty($comments)){$c=1;foreach ($comments as $cmnts) { ?>
                                <div class="previos-comments">
                                    <div class="app-reviews-card">
                                       <p class="app-reviews-card-count mb-0"><?php echo $c; ?>)</p>
                                       <div class="app-reviews-card-content">
                                            <ul>
                                                <li><p>Comments</p> <span>: <?php echo $cmnts['comments']; ?></span></li>
                                                <li>
                                                    <p>Status</p>
                                                    <span> :
                                                        <?php 
                                                            if($cmnts['status']=='source_applied'){
                                                                echo 'source/applied';
                                                            }else if($cmnts['status']=='internal_interview'){
                                                                echo 'internal interview';
                                                            }else if($cmnts['status']=='client_interview'){
                                                                echo 'client interview';
                                                            }else{
                                                                echo $cmnts['status'];
                                                            }
                                                        ?>
                                                    </span>
                                                </li>
                                                <li><p>Date</p> <span>: <?php echo DD_M_YY_h_i_s($cmnts['date']); ?></span></li>
                                            </ul>
                                       </div> 
                                    </div>
                                       
                                     
                                </div>
                        <?php $c++;} } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

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
$('.work_duration_start').Zebra_DatePicker({
           format: 'M-Y',
           pair: $('#work_duration_end')
   });
   $('.work_duration_end').Zebra_DatePicker({
           format: 'M-Y'
   });
$('.edu_duration_start').Zebra_DatePicker({
        format: 'M-Y',
        pair: $('#edu_duration_end')
});
$('.edu_duration_end').Zebra_DatePicker({
        format: 'M-Y'
});

$(document).ready(function(){
  var sn='<?php echo $sn;?>';
  $("#update_candidate_profile").validate({
  rules:{
    fname:{required:true},
    lname:{required:true},
    email:{required:true},
    phone_no:{required:true},
    phone_no_2:{required:true},
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
function Status(type,candidate_applied_id)
{
    $.ajax({
        url: '<?php echo site_url('admin/change_candidate_status'); ?>',
        type: 'POST',
        data: {type: type,candidate_applied_id: candidate_applied_id},
        success: function(res)
        {
            $('.move-cls').remove();
            $('.status-candidate').html(res);
            if(type=='source/applied'){
                var value='source/applied';
            }else if(type=='contacted'){
                var value='contacted';
            }else if(type=='internal_interview'){
                var value='internal interview';
            }else if(type=='client_interview'){
                var value='client interview';
            }else {
                var value=type;
            }
            $('.cadidate-status-applied').text(value);
            Swal.fire(
              'Success!',
              'candidate moved successfully.',
              'success'
            )
        }
    });
}

function addmore(id)
{
  $.ajax({
        url: '<?php echo site_url('admin/add_work_exp_fields'); ?>',
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

function edu_addmore(id)
{
  $.ajax({
        url: '<?php echo site_url('admin/add_edu_fields'); ?>',
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

function Rating(val)
{
    var candidate_applied_id ='<?php echo $candidate_applied_id; ?>';
    if(val=='' && candidate_applied_id==''){
        return false;
    }else{
        if(val==1){
            $('label[for=star2],label[for=star3],label[for=star4],label[for=star5]').removeAttr('style');
        }else if(val==2){
            $('label[for=star3],label[for=star4],label[for=star5]').removeAttr('style');
        }else if(val==3){
            $('label[for=star4],label[for=star5]').removeAttr('style');
        }else if(val==4){
            $('label[for=star5]').removeAttr('style');
        }

        $.ajax({
            url: '<?php echo site_url('admin/save_rating'); ?>',
            type: 'POST',
            data: {val: val,candidate_applied_id: candidate_applied_id},
            success: function(data) {
            }
        });
    }
}

function Comments()
{
    var comments=$('#comments').val();
    var candidate_applied_id ='<?php echo $candidate_applied_id; ?>';
    var company_id ='<?php echo $company_id; ?>';
    var job_id ='<?php echo $job_id; ?>';
    if(comments==''){
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/ajax_candidate_comments'); ?>',
            type: 'POST',
            data: {cmnts: comments,candidate_applied_id: candidate_applied_id,company_id: company_id,job_id: job_id,val: ''},
            success: function(res) {
                $('.cmnts').val('');
                $('.indidual-div-previos-comments').remove();
                $('.main-div-previos-comments').html(res);
                Swal.fire(
                  'Success!',
                  'Comments saved successfully...',
                  'success'
                )
            },error: function (data){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sorry something went wrong!'
                })
            }
        });
    }
    return false;
}
function savePassportID()
{
    var id_passport_no=$('#id_passport_no').val();
    var candidate_applied_id ='<?php echo $candidate_applied_id; ?>';
    if(id_passport_no==''){
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/save_passport_id'); ?>',
            type: 'POST',
            data: {id_passport_no: id_passport_no,candidate_applied_id: candidate_applied_id},
            success: function(res) {
                if(res==1){
                    Swal.fire(
                      'Success!',
                      'Passport Id saved successfully.',
                      'success'
                    )
                }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Sorry something went wrong!'
                    })
                }
            }
        });
    }
    return false;
}
$('#ctc_to,#excepted_ctc_from,#excepted_ctc_to').keypress(function(e) {
    if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
    })
    .on("cut copy paste",function(e){
    e.preventDefault();
  });
</script>
