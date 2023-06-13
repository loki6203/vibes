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
               <h4 class="font-size-18">Edit Employee Payslip</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Employee Payslip</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/payslips/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/update_payslip" id="update_payslip" name="update_payslip" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="payslip_id" id="payslip_id" value="<?php echo $payslip['payslip_id']; ?>">
                     <input type="hidden" name="payslip_file_name" id="payslip_file_name" value="<?php echo $payslip['payslip_file_name']; ?>">
                     <input type="hidden" name="payslip_file_path" id="payslip_file_path" value="<?php echo $payslip['payslip_file_path']; ?>">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee</label>
                        <div class="col-sm-10">
                           <select class="form-control select2" name="emp_id" id="emp_id" required>
                              <option value="">-- Select Employee --</option>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>" <?php echo ($payslip['emp_id']==$emp['emp_id'])?'selected':'';?>><?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input emialid" class="col-sm-2 col-form-label">Select Month</label>
                        <div class="col-sm-10">
                           <input type="text" name="month" id="month" class="form-control" placeholder="Select Select Month" value="<?php echo $payslip['month']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input emialid" class="col-sm-2 col-form-label">Select Year</label>
                        <div class="col-sm-10">
                           <input type="text" name="year" id="year" class="form-control" placeholder="Select Select Year" value="<?php echo $payslip['year']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Upload Payslip</label>
                        <div class="col-sm-4">
                           <input type="file" name="simage" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf" onchange="loadFile(event)" />
                           <span>&nbsp;</span>
                           <div class="pdf_view">
                              <?php 
                                 $file_ext = pathinfo($payslip['payslip_file_path'],PATHINFO_EXTENSION); 
                              if($file_ext!='pdf'){ ?>
                                 <img src="<?php echo base_url(); ?>assets/payslips/<?php echo $payslip['payslip_file_path']; ?>" width="100px" height="100px" id="output">
                              <?php } else { ?>
                                 <img src="<?php echo base_url(); ?>assets/pdf_imgpng.jpg" width="100px" height="100px" id="output">
                          <?php } ?>
                           </div>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/payslips/">Cancel</a>
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
   $('#month').Zebra_DatePicker({format: 'M',});
   $('#year').Zebra_DatePicker({format: 'Y',});

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