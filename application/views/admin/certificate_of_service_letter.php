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
               <h4 class="font-size-18">Certificate Of Service Letter Generation</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Certificate Of Service Letter Generation</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row align-items-center">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                     <div class="form-group row align-items-center">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee</label>
                        <div class="col-8 col-md-4">
                           <select class="form-control select2" name="emp_id" id="emp_id" required>
                              <option value="">-- Select Employee --</option>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>"><?php echo $emp['fname'];?> <?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                        <div class="col-4">
                           <button class="btn btn-primary waves-effect waves-light mr-1" onClick="Generate_cosl();">Generate Certificate</button>
                        </div>
                     </div>
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
   function Generate_cosl()
   {
      var emp_id=$('#emp_id').val();
      if(emp_id==''){
         alert('Please select employee');
      }else{
         window.location='<?php echo base_url();?>admin/generate_cosl/'+emp_id;
      }
   }
</script>
