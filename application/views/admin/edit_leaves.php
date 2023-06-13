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
               <h4 class="font-size-18">Edit Leave</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Leave</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/leaves/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/update_leaves" id="update_leaves" name="update_leaves" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="leave_id" id="leave_id" value="<?php echo $leaves['leave_id'];?>">
                      <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $leaves['emp_id'];?>">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Name</label>
                        <div class="col-sm-10">
                           <input type="text" name="emp_name" id="emp_name" class="form-control" placeholder="Enter Employee Name" value="<?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)" required readonly style="background-color: #ececf1;"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Period From Date</label>
                        <div class="col-sm-10">
                          <div class="custom_date_field">
                            <input type="text" name="period_from" id="period_from" class="form-control" placeholder="Select Period From Date" value="<?php echo DD_MM_YY($leaves['period_from']);?>" required autocomplete="off"/>
                            <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                          </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Period To Date </label>
                        <div class="col-sm-10">
                            <div class="custom_date_field">
                                <input type="text" name="period_to" id="period_to" class="form-control" placeholder="Select Period To Date" value="<?php echo DD_MM_YY($leaves['period_to']);?>" required autocomplete="off"/>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Annual Leaves </label>
                        <div class="col-sm-10">
                           <input type="text" name="annual_leaves_count" id="annual_leaves_count" class="form-control" placeholder="Enter Annual Leaves" value="<?php echo $leaves['annual_leaves_count'];?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Sick Leaves </label>
                        <div class="col-sm-10">
                           <input type="text" name="sick_leaves_count" id="sick_leaves_count" class="form-control" placeholder="Enter Sick Leaves" value="<?php echo $leaves['sick_leaves_count'];?>" required/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/leaves/">Cancel</a>
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
  $( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#period_from" )
        .datepicker({
           defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10',
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
          $( "#period_to" ).val('');
        }),
      to = $( "#period_to" ).datepicker({
         defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10',
          onSelect : function (val) {
                ChkDates(val);
          },
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  });

  
  function ChkDates(val)
  {
      var periodFrom =new Date($('#period_from').val());
      var periodTo = new Date($('#period_to').val());
      if (periodTo <= periodFrom)
      {
        alert('Period to date should be greater than Period from date.');
        $('#period_to').val('');
      }
  }
    $('#annual_leaves_count').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
   $('#sick_leaves_count').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
</script>