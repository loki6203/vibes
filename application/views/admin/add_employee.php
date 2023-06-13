<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Add Employee</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Employee</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_employee" id="form-horizontal" name="save_employee" enctype="multipart/form-data" class="form-horizontal form-wizard-wrapper form-wizard-wrapper-custom custom-validation">
                     <h3>Personal Details</h3>
                     <fieldset>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">First Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input name="fname" id="fname" placeholder="Enter First Name" class="form-control" >
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameBilling" class="col-lg-12 col-form-label">Last Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input name="lname" id="lname" placeholder="Enter Last Name" class="form-control" >
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
                                       <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="Male">
                                       <label class="custom-control-label" for="customRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                       <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="Female">
                                       <label class="custom-control-label" for="customRadioInline2">Female</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtEmailAddressBilling" class="col-lg-12 col-form-label">Company Email Id <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="email" name="email_id" id="email_id" placeholder="Enter Company Email Id" class="form-control keupinput" >
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
                                       <input type="email" name="personal_email_id" id="personal_email_id" placeholder="Enter Personal Email Id" class="form-control keupinput">
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
                                          <option value="+27">ZA (+27)</option>
                                          <option value="+91">IND (+91)</option>
                                       </select>
                                       <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Enter Mobile Number" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Date of Birth <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom_date_field">
                                       <input type="text" name="dob" id="dob" class="form-control"  placeholder="Select Date of Birth" autocomplete="off" />
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
                                       <textarea id="permanent_address" name="permanent_address" rows="4" class="form-control" placeholder="Enter Permanent Address" ></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtAddress1Billing" class="col-lg-12 col-form-label">Present Address <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <textarea id="present_address" name="present_address" rows="4" class="form-control" placeholder="Enter Present Address" ></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Local Contact Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="local_contact_name" id="local_contact_name" class="form-control" placeholder="Enter Local Contact Name" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameBilling" class="col-lg-12 col-form-label">Local Contact Relationship <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="local_contact_relationship" id="local_contact_relationship" class="form-control" placeholder="Enter Local Contact Relationship" />
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
                                          <option value="+27">ZA (+27)</option>
                                          <option value="+91">IND (+91)</option>
                                       </select>
                                       <input type="text" name="local_contact_ph" id="local_contact_ph" class="form-control" placeholder="Enter Local Contact Mobile Number" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Overseas Contact Name </label>
                                 <div class="col-lg-12">
                                       <input type="text" name="overseas_contact_name" id="overseas_contact_name" class="form-control" placeholder="Enter Overseas Contact Name" />
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameBilling" class="col-lg-12 col-form-label">Overseas Contact Relationship </label>
                                 <div class="col-lg-12">
                                       <input type="text" name="overseas_contact_relationship" id="overseas_contact_relationship" class="form-control" placeholder="Enter Overseas Contact Relationship"/>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameBilling" class="col-lg-12 col-form-label">Overseas Contact Mobile Number </label>
                                 <div class="col-lg-12">
                                    <div class="input-group mobile-extension-append">
                                       <select class="form-control" name="overseas_contact_ph_code" id="overseas_contact_ph_code">
                                          <option value="+27">ZA (+27)</option>
                                          <option value="+91">IND (+91)</option>
                                       </select>
                                       <input type="text" name="overseas_contact_ph" id="overseas_contact_ph" class="form-control" placeholder="Enter Overseas Contact Mobile Number"/>
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
                                    <input type="text" name="e_code" id="e_code" class="form-control" placeholder="Enter Employee Code" value="<?php echo $GererateEmpCode; ?>" style="background-color: #d8d7d7"; readonly />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Employee Designation <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="designation_id" id="designation_id" >
                                       <option value="">Select Designation</option>
                                       <?php if(count($designation)>0){ foreach($designation as $des){ ?>
                                       <option value="<?php echo $des['designation_id'];?>"><?php echo $des['designation_name'];?></option>
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
                                       <option value="Independent Contractor">Independent Contractor</option>
                                       <option value="Fixed term Employee">Fixed term Employee</option>
                                       <option value="Permanent Employee">Permanent Employee</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtFirstNameShipping" class="col-lg-12 col-form-label">Date of Joining <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom_date_field">
                                         <input type="text" name="date_of_joining" id="date_of_joining" class="form-control" placeholder="Select Date of Joining" autocomplete="off" />
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
                                       <?php foreach ($roles as $role) { ?>
                                       <option value="<?php echo $role['roles_id']; ?>"><?php echo $role['role_name']; ?></option>
                                       <?php } ?>
                                       <option value="Employee">Employee</option>
                                 </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Reporting Manager <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="reporting_manager_id" id="reporting_manager_id">
                                       <option value="">Select Reporting Manager</option>
                                       <?php if(count($managers)>0){ foreach($managers as $rep){ ?>
                                       <option value="<?php echo $rep['emp_id'];?>"><?php echo $rep['name'];?></option>
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
                                       <option value="">Select HR Manager</option>
                                       <?php if(count($managers)>0){ foreach($managers as $lead){ ?>
                                       <option value="<?php echo $lead['emp_id'];?>"><?php echo $lead['name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Lead Manager </label>
                                 <div class="col-lg-12">
                                    <select class="form-control" name="lead_manager_id" id="lead_manager_id" >
                                       <option value="">Select Lead Manager</option>
                                       <?php if(count($managers)>0){ foreach($managers as $lead){ ?>
                                       <option value="<?php echo $lead['emp_id'];?>"><?php echo $lead['name'];?></option>
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
                                       <option value="">Select Client</option>
                                       <?php if(count($clients)>0){ foreach($clients as $clnt){ ?>
                                       <option value="<?php echo $clnt['client_id'];?>"><?php echo $clnt['client_name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtLastNameShipping" class="col-lg-12 col-form-label">Client Manager <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <input type="text" name="client_manager" id="client_manager" class="form-control"  placeholder="Enter Client Manager" />
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
                                       <input type="radio" class="custom-control-input" id="leaves_included_in_contract" name="leaves_included_in_contract" value="Yes" checked />
                                       <label class="custom-control-label" for="leaves_included_in_contract">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                       <input type="radio" class="custom-control-input" id="leaves_included_in_contract2" name="leaves_included_in_contract" value="No" />
                                       <label class="custom-control-label" for="leaves_included_in_contract2">No</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCompanyBilling" class="col-lg-12 col-form-label">Client Billable <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                       <input type="radio" class="custom-control-input" id="client_billable" name="client_billable" value="Yes" checked />
                                       <label class="custom-control-label" for="client_billable">Yes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                       <input type="radio" class="custom-control-input" id="client_billable2" name="client_billable" value="No" />
                                       <label class="custom-control-label" for="client_billable2">No</label>
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
                                       <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="ddlCreditCardType" class="col-lg-12 col-form-label">Account Type <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <select class="form-control" name="account_type" id="account_type" >
                                          <option value="">Select Account Type</option>
                                          <option value="Business Account">Business Account</option>
                                          <option value="Saving Account">Saving Account</option>
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
                                    <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Enter Account Number" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCreditCardNumber" class="col-lg-12 col-form-label">Branch Code </label>
                                 <div class="col-lg-12">
                                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" placeholder="Enter Branch Code" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCardVerificationNumber" class="col-lg-12 col-form-label">Branch Name <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="branch_name" id="branch_name" class="form-control" placeholder="Enter Branch Name" />
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
                                       <option value="">Select Identification</option>
                                       <?php if(count($identification)>0){ foreach($identification as $ident){ ?>
                                       <option value="<?php echo $ident['identification_id'];?>"><?php echo $ident['identification_name'];?></option>
                                       <?php } } ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCardVerificationNumber" class="col-lg-12 col-form-label">Identification Number <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="text" name="identification_number" id="identification_number" class="form-control"  placeholder="Enter Identification Number" />
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label for="txtCardVerificationNumber" class="col-lg-12 col-form-label">Identification Image <span class="required-star">*</span></label>
                                 <div class="col-lg-12">
                                       <input type="file" name="simage" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf" onchange="loadFile(event)" />
                                       <span>&nbsp;</span>
                                       <div class="pdf_view">
                                          <img id="output" width="100px" height="100px" />
                                       </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <!--<h3>Compensation Details</h3>-->
                     <!--<fieldset>-->
                     <!--   <h5 class="text-center" style="color: #1372a2">Earnings</h5>-->
                     <!--   <div class="container Earnings" style="border: 1px solid #000000;">-->
                     <!--      <div class="row">-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="txtNameCard" class="col-lg-12 col-form-label">BASCI <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="BASCI" id="BASCI" class="form-control cls-readonly" placeholder="BASCI" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="HRA" class="col-lg-12 col-form-label">HRA <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="HRA" id="HRA" class="form-control cls-readonly" placeholder="HRA" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--      </div>-->
                     <!--      <div class="row">-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="CONVEYANCE" class="col-lg-12 col-form-label">CONVEYANCE <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="CONVEYANCE" id="CONVEYANCE" class="form-control cls-readonly" placeholder="CONVEYANCE" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="MEDICAL_ALLOWANCE" class="col-lg-12 col-form-label">MEDICAL ALLOWANCE <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="MEDICAL_ALLOWANCE" id="MEDICAL_ALLOWANCE" class="form-control cls-readonly" placeholder="MEDICAL ALLOWANCE" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="OTHER_BENEFITS" class="col-lg-12 col-form-label">OTHER BENEFITS<span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="OTHER_BENEFITS" id="OTHER_BENEFITS" class="form-control cls-readonly" placeholder="OTHER BENEFITS" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="VARIABLES" class="col-lg-12 col-form-label">VARIABLES<span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="VARIABLES" id="VARIABLES" class="form-control cls-readonly" placeholder="VARIABLES" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--      </div>-->
                     <!--   </div>-->
                     <!--   <div>-->
                     <!--      <h5 class="text-center" style="color: #1372a2;margin-top:20px;">Deductions </h5>-->
                     <!--      <div class="container DEDUCTIONS" style="border: 1px solid #000000;">-->
                     <!--         <div class="row">-->
                     <!--            <div class="col-md-6">-->
                     <!--               <div class="form-group row">-->
                     <!--                  <label for="PT" class="col-lg-12 col-form-label">PT <span class="required-star">*</span></label>-->
                     <!--                  <div class="col-lg-12">-->
                     <!--                     <input type="text" name="PT" id="PT" class="form-control cls-readonly" placeholder="PT" />-->
                     <!--                  </div>-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--            <div class="col-md-6">-->
                     <!--               <div class="form-group row">-->
                     <!--                  <label for="PF" class="col-lg-12 col-form-label">PF <span class="required-star">*</span></label>-->
                     <!--                  <div class="col-lg-12">-->
                     <!--                     <input type="text" name="PF" id="PF" class="form-control cls-readonly" placeholder="PF" />-->
                     <!--                  </div>-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <iv class="row">-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="TDS" class="col-lg-12 col-form-label">TDS <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="TDS" id="TDS" class="form-control cls-readonly" placeholder="TDS" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="OTHERS" class="col-lg-12 col-form-label">OTHERS <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="OTHERS" id="OTHERS" class="form-control cls-readonly" placeholder="OTHERS" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--      </div>-->
                     <!--      <div class="row" style="margin-top:20px;">-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="GROSS_TOTAL" class="col-lg-12 col-form-label">GROSS TOTAL<span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="GROSS_TOTAL" id="GROSS TOTAL" class="form-control cls-readonly" placeholder="GROSS TOTAL" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="DEDUCTIONS" class="col-lg-12 col-form-label">DEDUCTIONS <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="DEDUCTIONS" id="DEDUCTIONS" class="form-control cls-readonly" placeholder="DEDUCTIONS" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="NET_PAY" class="col-lg-12 col-form-label">NET PAY <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="NET_PAY" id="NET_PAY" class="form-control cls-readonly" placeholder="NET PAY" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--         <div class="col-md-6">-->
                     <!--            <div class="form-group row">-->
                     <!--               <label for="Hourly_Rate" class="col-lg-12 col-form-label">Hourly Rate <span class="required-star">*</span></label>-->
                     <!--               <div class="col-lg-12">-->
                     <!--                  <input type="text" name="Hourly_Rate" id="Hourly_Rate" class="form-control cls-readonly" placeholder="Hourly Rate" />-->
                     <!--               </div>-->
                     <!--            </div>-->
                     <!--         </div>-->
                     <!--      </div>-->
                     <!--   </div>-->
                     <!--</fieldset>-->
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
  $(".cls-readonly").prop("readonly", true);
  $(".cls-readonly").css("background-color", "#d8d7d7");
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
   $("#form-horizontal").validate({
      rules:{
          email_id:
          {
               required : true,
               remote:
               {
                  url: "<?php echo base_url(); ?>admin/check_employee_email",
                  type: "post",
                  data: {email: function(){ return $("#email_id").val(); }},
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
                  url: "<?php echo base_url(); ?>admin/check_personal_employee_email",
                  type: "post",
                  data: {personal_email_id: function(){ return $("#personal_email_id").val(); }},
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
            url: "<?php echo base_url(); ?>admin/check_emp_code",
            type: "post",
            data: {email: function(){ return $("#emp_code").val(); }},
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
       fname:{required:true},
       lname:{required:true},
       gender:{required:true},
       dob:{required:true},
       permanent_address:{required:true},
       present_address:{required:true},
       designation_id:{required:true},
       employment_type:{required:true},
       phone_no:{required:true,number:true},
       date_of_joining:{required:true},
       local_contact_name:{required:true},
       local_contact_relationship:{required:true},
       local_contact_ph:{required:true,number:true},
       bank_name:{required:true},
       account_number:{required:true,number:true},
       account_type:{required:true},
       branch_name:{required:true},
       reporting_manager_id:{required:true},
       client_manager:{required:true},
       client_id:{required:true},
       leaves_included_in_contract:{required:true},
       identification_type_id:{required:true},
       identification_number:{required:true},
       simage:{required:true},
       role_id:{required:true},
       hr_manager_id:{required:true},
    //   lead_manager_id:{required:true},
    //   ifsc_code:{required:true}
     },
     messages: {
            phone_no:{number:'Please enter only numbers.'},
            local_contact_ph:{number:'Please enter only numbers.'},
            account_number:{number:'Please enter only numbers.'},
     },
     ignore: []
   });
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
</script>
