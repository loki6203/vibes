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
               <h4 class="font-size-18">Edit Payroll</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Payroll</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/payroll/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/update_payroll" id="update_payroll" name="update_payroll" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="payroll_id" id="payroll_id" value="<?php echo $payroll['payroll_id']; ?>">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee</label>
                        <div class="col-sm-10">
                           <select class="form-control select2" name="emp_id" id="emp_id" required>
                              <option value="">-- Select Employee --</option>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>" <?php echo ($emp['emp_id']==$payroll['emp_id'])?'selected':'';?>><?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input emialid" class="col-sm-2 col-form-label">Current Salary</label>
                        <div class="col-sm-10">
                           <input type="text" name="current_salary" id="current_salary" class="form-control"  placeholder="Select Current Salary" value="<?php echo $payroll['current_salary']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Allowance</label>
                        <div class="col-sm-10">
                           <input type="text" name="allowence" id="allowence" class="form-control"  placeholder="Enter Allowance" value="<?php echo $payroll['allowence']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Claim Amount</label>
                        <div class="col-sm-10">
                           <input type="text" name="claim_amt" id="claim_amt" class="form-control"  placeholder="Enter Claim Amount" value="<?php echo $payroll['claim_amt']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Rent</label>
                        <div class="col-sm-10">
                           <input type="text" name="rent" id="rent" class="form-control keupinput" placeholder="Enter Rent" value="<?php echo $payroll['rent']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Vibho HR</label>
                        <div class="col-sm-10">
                           <input type="text" name="vibho_hr" id="vibho_hr" class="form-control" placeholder="Enter Vibho HR" value="<?php echo $payroll['vibho_hr']; ?>"  required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Vibho Manager</label>
                        <div class="col-sm-10">
                           <input type="text" name="vibho_manager" id="vibho_manager" class="form-control" placeholder="Enter Vibho Manager" value="<?php echo $payroll['vibho_manager']; ?>"  required/>
                        </div>
                     </div>
                      <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client Manager</label>
                        <div class="col-sm-10">
                           <input type="text" name="client_manager" id="client_manager" class="form-control" placeholder="Enter Client Manager" value="<?php echo $payroll['client_manager']; ?>"  required/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/payroll/">Cancel</a>
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

<script>
   $(document).ready(function() {
    $("#current_salary").keydown(function(event)
    {
        if ( event.keyCode == 46 || event.keyCode == 8 ) { }
        else
        {
            if (event.keyCode < 48 || event.keyCode > 57 )
            {
                event.preventDefault(); 
            }   
         }
    });

    $("#allowence").keydown(function(event)
    {
        if ( event.keyCode == 46 || event.keyCode == 8 ) { }
        else
        {
            if (event.keyCode < 48 || event.keyCode > 57 )
            {
                event.preventDefault(); 
            }   
         }
    });

    $("#claim_amt").keydown(function(event)
    {
        if ( event.keyCode == 46 || event.keyCode == 8 ) { }
        else
        {
            if (event.keyCode < 48 || event.keyCode > 57 )
            {
                event.preventDefault(); 
            }   
         }
    });

    $("#rent").keydown(function(event)
    {
        if ( event.keyCode == 46 || event.keyCode == 8 ) { }
        else
        {
            if (event.keyCode < 48 || event.keyCode > 57 )
            {
                event.preventDefault(); 
            }   
         }
    });
});
</script>