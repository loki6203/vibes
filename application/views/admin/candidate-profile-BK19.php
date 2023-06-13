<style>
    .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
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
            <div class="app-recruitment-cadidate-profile new-app-recruitment-cadidate-profile bg-white d-flex">
            <div class="app-recruitment-cadidate-profile-image d-flex justify-content-center align-items-center">
                <img src="<?php echo base_url(); ?>/assets/candidate_images/<?php echo $user_details['user_photo_path']; ?>">
            </div>
            <div class="app-recruitment-cadidate-profile-detail">
                <div class="app-recruitment-cadidate-profile-title  d-flex flex-column">
                    <h1 class="font-size-18"><?php echo $user_details['fname']; ?> <?php echo $user_details['lname']; ?><button  data-toggle="tooltip" data-placement="bottom" title="Share" type="button" class="profile-share-btn plain-btn ml-1"><img src="<?php echo base_url(); ?>assets/admin/images/share.svg"/></button>
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
                        <li data-toggle="tooltip" data-placement="bottom" title="Phone No"><i class="fas fa-phone"></i> <span><a href="#"><?php echo $user_details['phone_no']; ?></a></span></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Experience"><i class="fas fa-briefcase"></i> <span>
                            +<?php 
                            $year_exp=$this->db->query("SELECT `job_work_expericence_id`, `candidate_applied_id`, `company_name`, `designation`, `work_duration_start`, `work_duration_end`, SUM(`years`) FROM `candidate_work_expericence` WHERE `candidate_applied_id`=$candidate_applied_id")->result_array();
                            echo $year_exp[0]['SUM(`years`)']; ?> years</span></li>
                    </ul>
                    <div class="cadidate-status-strip">
                        <?php if($user_details['status']=='source/applied'){ ?>
                            <span class="cadidate-status-applied">Applied</span>
                        <?php } else{ ?>
                            <span class="cadidate-status-applied"><?php echo ucfirst($user_details['status']); ?></span>
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
                <ul class="candidate-profile-actions d-flex justify-content-end list-style-none mt-3 align-items-center">
                    <li class="mr-3">
                        <a class="candidate-action-btn candidate-schedule-btn"><i class="far fa-calendar-plus"></i> Schedule Interview</a>
                    </li>
                    <li class="mr-3">
                        <a class="candidate-action-btn candidate-hire-btn" onclick="Status('hired',<?php echo $user_details['candidate_applied_id']; ?>);"><i class="fas fa-hands-helping"></i> Hire</a>
                    </li>
                    <li class="mr-3">
                        <a class="candidate-action-btn candidate-reject-btn" onclick="Status('rejected',<?php echo $user_details['candidate_applied_id']; ?>);"><i class="fas fa-thumbs-down"></i> Reject</a>
                    </li>
                    <li class="dropdown">
                        <button class="candidate-action-btn candidate-move-btn" type="button" data-toggle="dropdown" aria-expanded="false">
                            Move Candidate
                        </button>
                        <div class="dropdown-menu status-candidate">
                            <div class="move-cls">
                            <?php if($user_details['status']=='source/applied'){ ?>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('contacted',<?php echo $user_details['candidate_applied_id']; ?>);">contacted</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('interview',<?php echo $user_details['candidate_applied_id']; ?>);">interview</a>
                            <?php } else if($user_details['status']=='contacted'){ ?>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('source/applied',<?php echo $user_details['candidate_applied_id']; ?>);">source/applied</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('interview',<?php echo $user_details['candidate_applied_id']; ?>);">interview</a>
                            <?php } else if($user_details['status']=='interview'){ ?>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('source/applied',<?php echo $user_details['candidate_applied_id']; ?>);">source/applied</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('contacted',<?php echo $user_details['candidate_applied_id']; ?>);">contacted</a>
                            <?php } else if($user_details['status']=='hired' || $user_details['status']=='rejected'){ ?>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('source/applied',<?php echo $user_details['candidate_applied_id']; ?>);">source/applied</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('contacted',<?php echo $user_details['candidate_applied_id']; ?>);">contacted</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="Move('interview',<?php echo $user_details['candidate_applied_id']; ?>);">interview</a>
                            <?php } ?>
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
                        <span class="d-block d-sm-none"><i class="fa fa-id-card" aria-hidden="true"></i></span>
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
                <div class="tab-pane active p-3" id="application-form" role="tabpanel">
                    <form method="post" action="<?php echo base_url(); ?>admin/update_candidate_profile" id="update_candidate_profile" name="update_candidate_profile" enctype="multipart/form-data" class="custom-validation">
                        <input type="hidden" name="candidate_applied_id" id="candidate_applied_id" value="<?php echo @$candidate_applied_id; ?>">
                    <div class="app-application-form-fields-group p-3">
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
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label>Address <span class="required-star">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="<?php echo $user_details['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Postcode <span class="required-star">*</span></label>
                                            <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Enter Postcode" value="<?php echo $user_details['postcode']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row align-items-end">
                                            <div class="col-md-4">
                                                <label>City <span class="required-star">*</span></label>
                                                <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" value="<?php echo $user_details['city']; ?>">
                                             </div>
                                             <div class="col-md-4">
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
                                    <div class="col-md-6">
                                        <label>Current CTC <span class="required-star">*</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="ctc_from" class="form-control" id="ctc_from" placeholder="Enter From" value="<?php echo $user_details['ctc_from']; ?>">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="ctc_to" class="form-control" id="ctc_to" placeholder="Enter To" value="<?php echo $user_details['ctc_to']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                    <div class="col-12">
                                        <label>Work experience</label>
                                        <div class="d-flex">
                                            <input type="checkbox" id="switch4" switch="success" name="work_exp" <?php if($user_details['work_experience']=='checked') echo "checked"; ?>/>
                                            <label for="switch4" data-on-label="Yes" data-off-label="No"></label>
                                            <span class="ml-2">I’m a fresher</span>
                                        </div>
                                    </div>

                                    <?php if(!empty($work_exp)){foreach ($work_exp as $key=> $work) { ?>
                                        <input type="hidden" name="job_work_expericence_id[]" value="<?php echo $work['job_work_expericence_id']; ?>">
                                    <div class="input_fields_wrap" id="main_div">
                                        <div id="main-div">
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
                                                        <label>Duration <span class="required-star">*</span></label>
                                                        <div class="row">
                                                           <div class="col-6">
                                                              <input type="text" class="form-control" name="work_duration_start[]" id="work_duration_start_<?php echo $work['job_work_expericence_id'];?>" placeholder="Duration" value="<?php echo $work['work_duration_start']; ?>">
                                                           </div>
                                                           <div class="col-6">
                                                              <input type="text" name="work_duration_end[]" id="work_duration_end_<?php echo $work['job_work_expericence_id'];?>" class="form-control" placeholder="End" value="<?php echo $work['work_duration_end']; ?>">
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
                            <div class="input_fields_wrap" id="edu_main_div">
                                <div class="col-12 mt-4">
                                 <div class="edu_label_<?php echo $ed['candidate_education_id'];?>">
                                    <label>Education Details</label>
                                 </div>
                                 <div class="col-12">
                                      <div class="row" id="edu_div_<?php echo $ed['candidate_education_id'];?>">
                                       <div class="col-12">
                                          <div class="form-group row align-items-end">
                                             <div class="col-md-4">
                                                <label>Type <span class="required-star">*</span></label>
                                                <select class="form-control select2" name="type[]" id="type_<?php echo $sn;?>">
                                                  <option disabled selected value="">Select Type</option>
                                                        <?php if(!empty($types)){foreach ($types as $ty) {
                                                            ?>
                                                             <option value="<?php echo @$ty['type_id']; ?>" <?php echo (@$ty['type_id']==@$ed['type_id'])?'selected':'';?>><?php echo @$ty['name'];?></option>
                                                        <?php } } ?>
                                                    </select>
                                             </div>
                                             <div class="col-md-4">
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
                                                <label>Duration <span class="required-star">*</span></label>
                                                <div class="row">
                                                   <div class="col-6">
                                                      <input type="text" name="edu_duration_start[]" id="edu_duration_start_<?php echo $ed['candidate_education_id'];?>" class="form-control" placeholder="Start" value="<?php echo $ed['edu_duration_start']; ?>">
                                                   </div>
                                                   <div class="col-6">
                                                      <input type="text" name="edu_duration_end[]" id="edu_duration_end_<?php echo $ed['candidate_education_id'];?>" class="form-control" placeholder="End" value="<?php echo $ed['edu_duration_end']; ?>">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div></div>
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
                            <input type="file" name="file[]" accept="image/png, image/jpg, image/jpeg" required multiple="multiple">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </form>
                    </div>
                </div>
                <div class="tab-pane p-3" id="Comments" role="tabpanel">
                    <div class="form-group">
                        <form action="#" method="post" name="save_comments" id="save_comments" class="custom-validation" onsubmit="return saveComments()">
                            <input type="hidden" name="candidate_applied_id" id="candidate_applied_id" value="<?php echo @$candidate_applied_id; ?>">
                            <textarea rows="5" cols="55" name="comments" id="comments" placeholder="Enter Comments" class="form-control" required><?php echo @$user_details['comments']; ?></textarea>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
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
$('#work_duration_start_'+sn).Zebra_DatePicker({
           format: 'Y',
           pair: $('#work_duration_end_'+sn)
   });
   $('#work_duration_end_'+sn).Zebra_DatePicker({
           format: 'Y'
   });
$('#edu_duration_start_'+sn).Zebra_DatePicker({
        format: 'Y',
        pair: $('#edu_duration_end_'+sn)
});
$('#edu_duration_end_'+sn).Zebra_DatePicker({
        format: 'Y'
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
function Status(type,candidate_applied_id)
{
    Swal.fire({
          title: 'Are you sure want to change status?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
    }).then((result) => {
    if (result.isConfirmed) {
            $.ajax({
                url: '<?php echo site_url('admin/change_candidate_status'); ?>',
                type: 'POST',
                data: {type: type,candidate_applied_id: candidate_applied_id},
                dataType: 'json',
                success: function(res) {
                    if(res==1){
                        Swal.fire(
                          'Success!',
                          'Status updated successfully.',
                          'success'
                        )
                        $('.cadidate-status-applied').text(type.toUpperCase());
                        $('.move-cls').remove();
                        if(type=='hired' || type=='rejected'){
                            $('.status-candidate').html('<a class="dropdown-item" href="javascript:void(0);" onclick="Move(1,'+candidate_applied_id+');">source/applied</a><a class="dropdown-item" href="javascript:void(0);" onclick="Move(2,'+candidate_applied_id+');">contacted</a><a class="dropdown-item" href="javascript:void(0);" onclick="Move(3,'+candidate_applied_id+');">interview</a>');
                            $('.cadidate-status-applied').text('Applied'.toUpperCase());
                        }
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!'
                        })
                    }
                }
            });
        }
    })
}

function Move(type,candidate_applied_id)
{
    Swal.fire({
          title: 'Are you sure want to move candidate?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
    }).then((result) => {
    if (result.isConfirmed) {
            $.ajax({
                url: '<?php echo site_url('admin/change_candidate_status'); ?>',
                type: 'POST',
                data: {type: type,candidate_applied_id: candidate_applied_id},
                dataType: 'json',
                success: function(res) {
                    if(res==1){
                        Swal.fire(
                          'Success!',
                          'Candidate moved successfully.',
                          'success'
                        )
                        $('.move-cls').remove();
                        if(type=='source/applied' || type==1){
                            $('.status-candidate').html('<a class="dropdown-item" href="javascript:void(0);" onclick="Move(2,'+candidate_applied_id+');">contacted</a><a class="dropdown-item" href="javascript:void(0);" onclick="Move(3,'+candidate_applied_id+');">interview</a>');
                            $('.cadidate-status-applied').text('Applied'.toUpperCase());
                        }else if(type=='contacted' || type==2){
                            $('.status-candidate').html('<a class="dropdown-item" href="javascript:void(0);" onclick="Move(1,'+candidate_applied_id+');">source/applied</a><a class="dropdown-item" href="javascript:void(0);" onclick="Move(3,'+candidate_applied_id+');">interview</a>');
                            $('.cadidate-status-applied').text('Contacted'.toUpperCase());
                        }else if(type=='interview' || type==3){
                            $('.status-candidate').html('<a class="dropdown-item" href="javascript:void(0);" onclick="Move(1,'+candidate_applied_id+');">source/applied</a><a class="dropdown-item" href="javascript:void(0);" onclick="Move(2,'+candidate_applied_id+');">contacted</a>');
                            $('.cadidate-status-applied').text('Interview'.toUpperCase());
                        }
                        
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!'
                        })
                    }
                }
            });
        }
    })
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

function saveComments()
{
    var comments=$('#comments').val();
    var candidate_applied_id ='<?php echo $candidate_applied_id; ?>';
    if(comments==''){
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/save_comments'); ?>',
            type: 'POST',
            data: {comments: comments,candidate_applied_id: candidate_applied_id},
            success: function(res) {
                if(res==1){
                    Swal.fire(
                      'Success!',
                      'Comments saved successfully.',
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

</script>
