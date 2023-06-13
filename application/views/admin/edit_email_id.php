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
               <h4 class="font-size-18">Edit Management</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Management</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/email_id/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/update_email_id" id="update_email_id" name="update_email_id" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="email_id" id="email_id" value="<?php echo $email['email_id']; ?>">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee</label>
                        <div class="col-sm-10">
                           <select class="form-control select2" name="emp_id" id="emp_id" required Onchange="getEmpDet();">
                              <option value="">-- Select Employee --</option>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>" <?php echo ($emp['emp_id']==$email['emp_id'])?'selected':'';?>><?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> VIBHO Management Description</label>
                        <div class="col-sm-10">
                           <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter VIBHO Management Description" required value="<?php echo $email['designation']; ?>" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Email Id</label>
                        <div class="col-sm-10">
                           <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email Id" value="<?php echo $email['email']; ?>" required readonly style="background-color: rgb(236, 236, 241);"/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/email_id/">Cancel</a>
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
   function getEmpDet(){
      var emp_id=$('#emp_id').val();
       $.ajax({
        url: '<?php echo site_url('admin/get_emp_details'); ?>',
        type: 'POST',
        data: {emp_id: emp_id},
            success: function(data) {
               if(data==0){
                  $('#email').val('');
               }else{
                  $('#email').val(data);
               }
        }
    });
   }
</script>
