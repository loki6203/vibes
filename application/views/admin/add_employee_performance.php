<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css">
<style type="text/css">
   .ck-editor__editable_inline {
   min-height: 200px;
   }
    .custom_date_field{
      position: relative;
   }
   .custom_date_field img{
     position: absolute;
    top: 7px;
    right: 10px;
    width: 20px;
    height: 20px;
    object-fit: contain;
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
               <h4 class="font-size-18">Add Employee Performance</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Employee Performance</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_performance/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_employee_performance" id="save_employee_performance" name="save_employee_performance" enctype="multipart/form-data" class="custom-validation">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee</label>
                        <div class="col-sm-10">
                           <select class="form-control select2" name="emp_id" id="emp_id" required>
                              <option value="">-- Select Employee --</option>
                              <?php if(count($employee)>0){foreach($employee as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>"><?php echo $emp['fname'];?> <?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input emialid" class="col-sm-2 col-form-label">Appraisal Date</label>
                        <div class="col-sm-10">
                            <div class="custom_date_field">
                                <input type="text" name="appraisal_date" id="appraisal_date" class="form-control"  placeholder="Select Appraisal Date" autocomplete="off" required/>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Appraisal Rating</label>
                        <div class="col-sm-10">
                            <input type="text" name="appraisal_rating" id="appraisal_rating" class="form-control" placeholder="Enter Appraisal Rating 1 to 5" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Existing Role</label>
                        <div class="col-sm-10">
                           <input type="text" name="existing_role" id="existing_role" class="form-control"  placeholder="Enter Existing Role" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> New Role</label>
                        <div class="col-sm-10">
                           <input type="text" name="new_role" id="new_role" class="form-control keupinput" placeholder="Enter New Role" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Existing Salary</label>
                        <div class="col-sm-10">
                           <input type="text" name="existing_salary" id="existing_salary" class="form-control" placeholder="Enter Existing Salary" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> New Salary</label>
                        <div class="col-sm-10">
                           <input type="text" name="new_salary" id="new_salary" class="form-control" placeholder="Enter New Salary" required onkeyup="return perc();"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Percentage Hike</label>
                        <div class="col-sm-10">
                           <input type="text" name="percentage_hike" id="percentage_hike" class="form-control" style="background-color: #ececf1;" readonly/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> HR Feedback Comments</label>
                        <div class="col-sm-10">
                           <textarea name="hr_feedback_comments" id="hr_feedback_comments" class="form-control" rows="5" cols="5" required></textarea> 
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Feedback Comments</label>
                        <div class="col-sm-10">
                           <textarea name="employee_feedback_comments" id="employee_feedback_comments" class="form-control keupinput" rows="5" cols="5" required></textarea> 
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Relationship Manager Comments</label>
                        <div class="col-sm-10">
                           <textarea name="relationship_manager_comments" id="relationship_manager_comments" class="form-control" rows="5" cols="5" required> </textarea> 
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_performance/">Cancel</a>
                           <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Save</button>
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
  $(function(){
    $("#appraisal_date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy',
      yearRange: '-60:+10'
    });
  });
 
function perc()
{
  var x = $("#existing_salary").val();
  var y = $("#new_salary").val();
  if(x!='' && y!=''){
      var z = Math.round(((y-x)/x)*100);
      $("#percentage_hike").val(z);
  }else{
      $("#percentage_hike").val('');
  } 
}

$("#appraisal_rating").on("input", function(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    var TxtVal = $('#appraisal_rating').val();
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
       return false;
    }else if(TxtVal>=5.1 || TxtVal>=6){
      $('#appraisal_rating').val('');
      alert("Please enter below 1 to 5 numbers");
       return false;
     }else{
       return true;
    }
            
 });

$('#appraisal_rating').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
</script>