<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css">
<style type="text/css">
   .ck-editor__editable_inline {
   min-height: 200px;
   }
</style>
<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Edit Recruitment</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>employee/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Recruitment</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>employee/recruitment/" >
                  <i class="mdi mdi-arrow-left-bold mr-2"></i>Back
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <form method="post" action="<?php echo base_url(); ?>employee/update_recruitment" id="update_recruitment" name="update_recruitment" enctype="multipart/form-data" class="custom-validation">
                      <input type="hidden" name="recruitment_id" id="recruitment_id" class="form-control" placeholder="Enter Name" value="<?php echo $recruitment['recruitment_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Name</label>
                        <div class="col-sm-10">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?php echo $recruitment['name']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Job Role</label>
                        <div class="col-sm-10">
                           <input type="text" name="job_role" id="job_role" class="form-control" placeholder="Enter Job Role" value="<?php echo $recruitment['job_role']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client</label>
                        <div class="col-sm-10">
                           <input type="text" name="client" id="client" class="form-control" placeholder="Enter Client" value="<?php echo $recruitment['client']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Reporting Vendor</label>
                        <div class="col-sm-10">
                           <input type="text" name="reporting_vendor" id="reporting_vendor" class="form-control" placeholder="Enter Reporting Vendor" value="<?php echo $recruitment['reporting_vendor']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> End Client</label>
                        <div class="col-sm-10">
                           <input type="text" name="end_client" id="end_client" class="form-control" placeholder="Enter End Client" value="<?php echo $recruitment['end_client']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Applied Role/position</label>
                        <div class="col-sm-10">
                           <input type="text" name="applied_role_position" id="applied_role_position" class="form-control" placeholder="Enter Applied Role/position" value="<?php echo $recruitment['applied_role_position']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client Feedback</label>
                        <div class="col-sm-10">
                           <input type="text" name="client_feedback" id="client_feedback" class="form-control" placeholder="Enter Client Feedback" value="<?php echo $recruitment['client_feedback']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Proposed Rate card to client</label>
                        <div class="col-sm-10">
                           <input type="text" name="proposed_rate_card_to_client" id="proposed_rate_card_to_client" class="form-control" placeholder="Enter Proposed Rate card to client" value="<?php echo $recruitment['proposed_rate_card_to_client']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Notice Period</label>
                        <div class="col-sm-10">
                           <input type="text" name="notice_period" id="notice_period" class="form-control" placeholder="Enter Notice Period" value="<?php echo $recruitment['notice_period']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Comments </label>
                        <div class="col-sm-10">
                           <input type="text" name="comments" id="comments" class="form-control" placeholder="Enter Comments" value="<?php echo $recruitment['comments']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>employee/recruitment/">Cancel</a>
                           <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Update</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->    
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-select.min.js"></script>
