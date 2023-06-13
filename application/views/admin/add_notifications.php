<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css">
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
                  <h4 class="font-size-18">Add Notification</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                     <li class="breadcrumb-item active">Add Notification</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/notifications/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_notifications" id="save_notifications" name="save_notifications" enctype="multipart/form-data" onsubmit="return checkMyForm();">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Title <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employees <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <select class="form-control" name="applicable_to_all" id="applicable_to_all" onchange="getUser(this)">
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </div>
                     </div>
                     <div id="emp">
                        <div class="form-group select-conainer-100 row">
                           <label for="example-time-input" class="col-sm-2 col-form-label"> Employees <span class="required-star">*</span></label>
                           <div class="col-sm-4">
                              <select class="form-control select2 select2-multiple selectpicker" multiple="multiple" multiple data-placeholder="Choose ..." name="employees[]" id="employees">
                                 <option value="">--Select Employee--</option>
                                 <?php if(!empty($employees)){foreach ($employees as $emp) { ?>
                                    <option value="<?php echo $emp['emp_id']; ?>"><?php echo $emp['fname']; ?> <?php echo $emp['lname']; ?> (<?php echo $emp['emp_code']; ?>)</option>
                                 <?php } } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group ck-edtir-form">
                        <label>Message <span class="required-star">*</span></label>
                        <textarea rows="3" id="message" name="message"></textarea>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/notifications/">Cancel</a>
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
<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>
<script>
$(document).ready(function(){
   var applicable_to_all=$('#applicable_to_all').val();
   if(applicable_to_all=='No'){
      $('#emp').removeAttr("style");
      $('#emp').show();
      $("#employees").prop("required",true);
   }else{
      $('#emp').hide();
      $("#employees").removeAttr("required");
   }
});

function getUser(sel)
{
   if(sel.value=='No'){
      $('#emp').removeAttr("style");
      $('#emp').show();
      $("#employees").prop("required",true);
   }else{
      $('.selectpicker').selectpicker('refresh');
      $('#emp').hide();
      $("#employees").removeAttr("required");
   }
}

$(document).ready(function() {
   $("#save_notifications").validate({
      rules:{
       title:{required:true},
       applicable_to_all:{required:true},
       message:{required:true}
     },
     messages: {
            
     },
     ignore: []
   });

});
ClassicEditor
   .create( document.querySelector( '#message' ) )
   .catch( error => {
       console.error( error );
});

function checkMyForm()
{
   var title=$('#title').val();
   var applicable_to_all=$('#applicable_to_all').val();
   var msg=$('#message').val();
   if(title==''){
      alert('Please enter title');
      return false;
   }else if(applicable_to_all==''){
      alert('Please enter employee');
      return false;
   }
}
</script>
