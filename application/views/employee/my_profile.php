<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Edit Employee</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Employee</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee/" >
                  <i class="mdi mdi-arrow-left-bold mr-2"></i>Back
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                  <form method="post" action="<?php echo base_url(); ?>employee/update_profile" id="form-horizontal" name="update_profile" enctype="multipart/form-data" class="form-horizontal form-wizard-wrapper form-wizard-wrapper-custom custom-validation">
                     <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $employee['emp_id']; ?>">
                     <input type="hidden" name="identification_image_name" id="identification_image_name" value="<?php echo $employee['identification_image_name']; ?>">
                     <input type="hidden" name="identification_image_path" id="identification_image_path" value="<?php echo $employee['identification_image_path']; ?>">
                     <h3>Personal Details</h3>
                     <fieldset>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">First Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input name="fname" id="fname" placeholder="Enter First Name" class="form-control" value="<?php echo $employee['fname']; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameBilling" class="col-lg-12 col-form-label">Last Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input name="lname" id="lname" placeholder="Enter Last Name" class="form-control" value="<?php echo $employee['lname']; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row align-items-center">
                                 <label for="txtCompanyBilling" class="col-lg-12 col-form-label">Gender <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="Male" value="Male" <?php echo ($employee['gender']== 'Male') ?  "checked" : "" ;  ?>>
                                       <label class="custom-control-label" for="customRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="Female" <?php echo ($employee['gender']== 'Female') ?  "checked" : "" ;  ?>>
                                       <label class="custom-control-label" for="customRadioInline2">Female</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtEmailAddressBilling" class="col-lg-12 col-form-label">Company Email Id <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="email" name="email_id" id="email_id" placeholder="Enter Company Email Id" class="form-control keupinput" value="<?php echo $employee['email_id']; ?>">
                                       <label id="emialid-error" class="error" for="emialid" style="visibility: visible; color: red;">&nbsp;</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtEmailAddressBilling" class="col-lg-12 col-form-label">Personal Email Id <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="email" name="personal_email_id" id="personal_email_id" placeholder="Enter Personal Email Id" class="form-control keupinput" value="<?php echo $employee['personal_email_id']; ?>">
                                       <label id="personal_email_id-error" class="error" for="personal_email_id">&nbsp;</label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Mobile Number <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="input-group mobile-extension-append">
                                       <select class="form-control" name="phone_no_code" id="phone_no_code">
                                        <option value="+27"<?php if($employee['phone_no_code'] == '+27') { ?> selected="selected"<?php } ?>>ZA (+27)</option>
                                        <option value="+91"<?php if($employee['phone_no_code'] == '+91') { ?> selected="selected"<?php } ?>>IND (+91)</option>
                                       </select>
                                       <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $employee['phone_no']; ?>"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Date of Birth <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom_date_field">
                                       <input type="text" name="dob" id="dob" class="form-control"  placeholder="Select Date of Birth" autocomplete="off" value="<?php echo DD_MM_YY($employee['dob']); ?>"/>
                                       <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtAddress1Billing" class="col-lg-12 col-form-label">Permanent Address <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <textarea id="permanent_address" name="permanent_address" rows="4" class="form-control" placeholder="Enter Permanent Address"><?php echo @$employee['permanent_address']; ?></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtAddress1Billing" class="col-lg-12 col-form-label">Present Address <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <textarea id="present_address" name="present_address" rows="4" class="form-control" placeholder="Enter Present Address"><?php echo @$employee['present_address']; ?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Local Contact Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="local_contact_name" id="local_contact_name" class="form-control" placeholder="Enter Local Contact Name" value="<?php echo $employee['local_contact_name']; ?>"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameBilling" class="col-lg-12 col-form-label">Local Contact Relationship <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="local_contact_relationship" id="local_contact_relationship" class="form-control" placeholder="Enter Local Contact Relationship" value="<?php echo $employee['local_contact_relationship']; ?>"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Local Contact Mobile Number <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="input-group mobile-extension-append">
                                       <select class="form-control" name="local_contact_ph_code" id="local_contact_ph_code" >
                                         <option value="+27"<?php if($employee['local_contact_ph_code'] == '+27') { ?> selected="selected"<?php } ?>>ZA (+27)</option>
                                        <option value="+91"<?php if($employee['local_contact_ph_code'] == '+91') { ?> selected="selected"<?php } ?>>IND (+91)</option>
                                       </select>
                                       <input type="text" name="local_contact_ph" id="local_contact_ph" class="form-control" placeholder="Enter Local Contact Mobile Number" value="<?php echo $employee['local_contact_ph']; ?>"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Overseas Contact Name </label>
                                 <div class="col-lg-12">
                                       <input type="text" name="overseas_contact_name" id="overseas_contact_name" class="form-control" placeholder="Enter Overseas Contact Name" value="<?php echo $employee['overseas_contact_name']; ?>"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameBilling" class="col-lg-12 col-form-label">Overseas Contact Relationship </label>
                                 <div class="col-lg-12">
                                       <input type="text" name="overseas_contact_relationship" id="overseas_contact_relationship" class="form-control" placeholder="Enter Overseas Contact Relationship" value="<?php echo $employee['overseas_contact_relationship']; ?>"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Overseas Contact Mobile Number </label>
                                 <div class="col-lg-12">
                                    <div class="input-group mobile-extension-append">
                                       <select class="form-control" name="overseas_contact_ph_code" id="overseas_contact_ph_code">
                                        <option value="+27"<?php if($employee['overseas_contact_ph_code'] == '+27') { ?> selected="selected"<?php } ?>>ZA (+27)</option>
                                        <option value="+91"<?php if($employee['overseas_contact_ph_code'] == '+91') { ?> selected="selected"<?php } ?>>IND (+91)</option>
                                       </select>
                                       <input type="text" name="overseas_contact_ph" id="overseas_contact_ph" class="form-control" placeholder="Enter Overseas Contact Mobile Number" value="<?php echo $employee['overseas_contact_ph']; ?>"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <h3>Company Document</h3>
                     <fieldset>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameShipping" class="col-lg-12 col-form-label">Employee Code <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input type="text" name="e_code" id="e_code" class="form-control" placeholder="Enter Employee Code" value="<?php echo $employee['emp_code']; ?>" style="background-color: #d8d7d7"; readonly />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Employee Designation <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="designation_id" id="designation_id" >
                                       <option value="">Select Designation</option>
                                       <?php if(count($designation)>0){foreach($designation as $deg){ ?>
                                          <option value="<?php echo $deg['designation_id'];?>" <?php echo ($deg['designation_id']==$employee['designation_id'])?'selected':'';?>><?php echo $deg['designation_name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Employment Type <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="employment_type" id="employment_type" >
                                       <option value="">Select Employment Type</option>
                                       <option value="Independent Contractor"<?php if($employee['employment_type'] == 'Independent Contractor') { ?> selected="selected"<?php } ?>>Independent Contractor</option>
                                       <option value="Fixed term Employee"<?php if($employee['employment_type'] == 'Fixed term Employee') { ?> selected="selected"<?php } ?>>Fixed term Employee</option>
                                       <option value="Permanent Employee"<?php if($employee['employment_type'] == 'Permanent Employee') { ?> selected="selected"<?php } ?>>Permanent Employee</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameShipping" class="col-lg-12 col-form-label">Date of Joining <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom_date_field">
                                         <input type="text" name="date_of_joining" id="date_of_joining" class="form-control" placeholder="Select Date of Joining" autocomplete="off" value="<?php echo DD_MM_YY($employee['date_of_joining']); ?>"/>
                                         <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Candidate Role <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="role_id" id="role_id">
                                       <option value="">Select Employee Role</option>
                                       <?php if(count($roles)>0){foreach($roles as $role){ ?>
                                       <option value="<?php echo $role['roles_id'];?>" <?php echo ($employee['role_id']==$role['roles_id'])?'selected':'';?>><?php echo $role['role_name'];?></option>
                                       <?php } } ?>
                                       <option value="Employee"<?php if($employee['role_id']=='Employee') { ?> selected="selected"<?php } ?>>Employee</option>
                                 </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Reporting Manager <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="reporting_manager_id" id="reporting_manager_id">
                                       <option value="">-- Select Reporting Manager --</option>
                                       <?php if(count($managers)>0){foreach($managers as $man){ ?>
                                       <option value="<?php echo $man['emp_id'];?>" <?php echo ($man['emp_id']==$employee['reporting_manager_id'])?'selected':'';?>><?php echo $man['name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">HR Manager <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="hr_manager_id" id="hr_manager_id" >
                                       <option value="">-- Select HR Manager --</option>
                                       <?php if(count($managers)>0){foreach($managers as $hr){ ?>
                                       <option value="<?php echo $hr['emp_id'];?>" <?php echo ($hr['emp_id']==$employee['hr_manager_id'])?'selected':'';?>><?php echo $hr['name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Lead Manager <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="lead_manager_id" id="lead_manager_id" >
                                       <option value="">-- Select Lead Manager --</option>
                                       <?php if(count($managers)>0){foreach($managers as $lead){ ?>
                                       <option value="<?php echo $lead['emp_id'];?>" <?php echo ($lead['emp_id']==$employee['lead_manager_id'])?'selected':'';?>><?php echo $lead['name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Client <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="client_id" id="client_id" >
                                       <option value="">-- Select Client --</option>
                                       <?php if(count($clients)>0){foreach($clients as $calt){ ?>
                                       <option value="<?php echo $calt['client_id'];?>" <?php echo ($calt['client_id']==$employee['client_id'])?'selected':'';?>><?php echo $calt['client_name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Client Manager <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input type="text" name="client_manager" id="client_manager" class="form-control"  placeholder="Enter Client Manager" value="<?php echo $employee['client_manager']; ?>"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCompanyBilling" class="col-lg-12 col-form-label">Leaves included in Contract <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="leaves_included_in_contract" name="leaves_included_in_contract" value="Yes" <?php if($employee['leaves_included_in_contract']=='Yes'){echo "checked"; } ?>/>
                                    <label class="custom-control-label" for="leaves_included_in_contract">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="leaves_included_in_contract2" name="leaves_included_in_contract" value="No" <?php if($employee['leaves_included_in_contract']=='No'){echo "checked"; } ?>/>
                                    <label class="custom-control-label" for="leaves_included_in_contract2">No</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <h3>Bank Details</h3>
                     <fieldset>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtNameCard" class="col-lg-12 col-form-label">Bank Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name" value="<?php echo $employee['bank_name']; ?>"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="ddlCreditCardType" class="col-lg-12 col-form-label">Account Type <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <select class="form-control" name="account_type" id="account_type" >
                                          <option value="">Select Account Type</option>
                                          <option value="Business Account"<?php if($employee['account_type'] == 'Business Account') { ?> selected="selected"<?php } ?>>Business Account</option>
                                          <option value="Saving Account"<?php if($employee['account_type'] == 'Saving Account') { ?> selected="selected"<?php } ?>>Saving Account</option>
                                       </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCreditCardNumber" class="col-lg-12 col-form-label">Account Number <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Enter Account Number" value="<?php echo $employee['account_number']; ?>"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCreditCardNumber" class="col-lg-12 col-form-label">IFSC Code <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" placeholder="Enter IFSC Code" value="<?php echo $employee['ifsc_code']; ?>"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCardVerificationNumber" class="col-lg-12 col-form-label">Branch Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="branch_name" id="branch_name" class="form-control" placeholder="Enter Branch Name" value="<?php echo $employee['branch_name']; ?>"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <h3>Identification Details</h3>
                     <fieldset>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCreditCardNumber" class="col-lg-12 col-form-label">Identification Type <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="identification_type_id" id="identification_type_id" >
                                       <option value="">Select Identification Type</option>
                                       <?php if(count($identification)>0){foreach($identification as $ide){ ?>
                                       <option value="<?php echo $ide['identification_id'];?>" <?php echo ($ide['identification_id']==$employee['identification_type_id'])?'selected':'';?>><?php echo $ide['identification_name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCardVerificationNumber" class="col-lg-12 col-form-label">Identification Number <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="identification_number" id="identification_number" class="form-control"  placeholder="Enter Identification Number" value="<?php echo @$employee['identification_number']; ?>"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCardVerificationNumber" class="col-lg-12 col-form-label">Identification Image <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="file" name="simage" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf" onchange="loadFile(event)" disabled />
                                       <span>&nbsp;</span>
                                       <div>
                                          <?php
                                          $GetType=substr($employee['identification_image_path'], strpos($employee['identification_image_path'], ".") + 1);  
                                          if($GetType=='pdf' || $GetType=='PDF'){ ?>
                                                <a href="<?php echo base_url(); ?>assets/emp_identification_image/<?php echo $employee['identification_image_path']; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/pdf_imgpng.jpg" width="100px" height="100px"></a>
                                          <?php } else { ?>
                                             <a href="<?php echo base_url(); ?>assets/emp_identification_image/<?php echo @$employee['identification_image_path']; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/emp_identification_image/<?php echo $employee['identification_image_path']; ?>" width="100px" height="100px"></a>
                                       <?php } ?>
                                       </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-select.min.js"></script> -->
<script>
$(document).ready(function() {
   $(function(){
    $("#date_of_joining").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy',
      yearRange: '-60:+10'
    });
   });
   $(function(){
       $("#dob").datepicker({
         changeMonth: true,
         changeYear: true,
         dateFormat: 'dd-mm-yy',
         yearRange: '-60:+10',
       });
   });
});  

$(document).ready(function() {
   $("input,textarea").prop("readonly", true);
   $("input,textarea").css("background-color", "#d8d7d7");
   $('input[name=gender]').attr("disabled",true);
   $('input[name=leaves_included_in_contract]').attr("disabled",true);
   $('select').prop('disabled', true);
   $("#form-horizontal").validate({
      rules:{
         email_id:
         {
            required : true,
            remote:
            {
               url: "<?php echo base_url(); ?>admin/check_update_emp_email",
               type: "post",
               data: {emp_id: function(){ return $("#emp_id").val(); }},
               dataFilter:function(data)
               {
                     var json = JSON.parse(data);
                     if(json.status === "success"){
                        return '"true"';
                     }
                     return "\"" + json.message + "\"";
               }
            }
         },
         personal_email_id:
         {
            required : true,
            remote:
            {
               url: "<?php echo base_url(); ?>admin/check_update_emp_personal_email",
               type: "post",
               data: {emp_id: function(){ return $("#emp_id").val(); }},
               dataFilter:function(data)
               {
                     var json = JSON.parse(data);
                     if(json.status === "success"){
                        return '"true"';
                     }
                     return "\"" + json.message + "\"";
               }
            }
         },
         emp_code:{
            required:true,
            remote:
            {
               url: "<?php echo base_url(); ?>admin/check_update_emp_code",
               type: "post",
               data: {emp_id: function(){ return $("#emp_id").val(); }},
               dataFilter:function(data) {
                     var json = JSON.parse(data);
                     if(json.status === "success")
                     {
                        return '"true"';
                     }
                     return "\"" + json.message + "\"";
                  }
            }
         },
       // fname:{required:true},
       // lname:{required:true},
       // gender:{required:true},
       // dob:{required:true},
       // permanent_address:{required:true},
       // present_address:{required:true},
       // designation_id:{required:true},
       // employment_type:{required:true},
       // phone_no:{required:true,number:true},
       // date_of_joining:{required:true},
       // local_contact_name:{required:true},
       // local_contact_relationship:{required:true},
       // local_contact_ph:{required:true,number:true},
       // bank_name:{required:true},
       // account_number:{required:true,number:true},
       // account_type:{required:true},
       // branch_name:{required:true},
       // reporting_manager_id:{required:true},
       // client_manager:{required:true},
       // client_id:{required:true},
       // leaves_included_in_contract:{required:true},
       // identification_type_id:{required:true},
       // identification_number:{required:true},
       // role_id:{required:true},
       // hr_manager_id:{required:true},
       // lead_manager_id:{required:true},
       // ifsc_code:{required:true}
     },
     messages: {
            // phone_no:{number:'Please enter only numbers.'},
            // local_contact_ph:{number:'Please enter only numbers.'},
            // account_number:{number:'Please enter only numbers.'},
     },
     ignore: []
   });

   var loadFile = function(event)
   {
      var extension = $('#simage').val().split('.').pop().toLowerCase();
      if(extension=='pdf')
      {
         src_path = '<?php echo base_url(); ?>assets/pdf_imgpng.jpg';
         $('#output').attr("src", src_path);
      }else{
         $('#output').removeAttr("src");
         var fileExtension = ['jpeg', 'jpg', 'png'];
         var output = document.getElementById('output');
         output.src = URL.createObjectURL(event.target.files[0]);
         output.onload = function()
         {
            URL.revokeObjectURL(output.src) 
         }
      }
   }
});

</script>
