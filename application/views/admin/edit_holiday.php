<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
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
               <h4 class="font-size-18">Edit Public Holiday</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Public Holiday</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button  btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/public_holidays/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/update_holiday" id="update_holiday" name="update_holiday" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="public_holiday_id" id="public_holiday_id" class="form-control" placeholder="Select Holiday Date" value="<?php echo $holidays['public_holiday_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Holiday Name</label>
                        <div class="col-sm-10">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Holiday Name" value="<?php echo $holidays['name']; ?>" required />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Holiday Date</label>
                        <div class="col-sm-10">
                            <div class="custom_date_field">
                                <input type="text" name="date" id="date" class="form-control" placeholder="Select Holiday Date" value="<?php echo DD_MM_YY($holidays['date']); ?>" required autocomplete="off"/>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/public_holidays/">Cancel</a>
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
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script>
    $(function(){
    $("#date").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd-mm-yy',
      yearRange: '-60:+10'
    });
  });
</script>
