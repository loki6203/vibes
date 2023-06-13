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
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
                  <h4 class="font-size-18">Freeze Timesheet</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Freeze Timesheet</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <form method="post" action="<?php echo base_url(); ?>admin/save_timesheet_freezed" id="save_timesheet_freezed" name="save_timesheet_freezed" enctype="multipart/form-data" class="custom-validation">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Start Date<span class="required-star">*</span></label>
                           <div class="col-sm-4">
                              <div class="custom_date_field">
                                <input type="text" name="start_date" id="start_date" placeholder="Select Start Date" class="form-control" autocomplete="off" required>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                              </div>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> End Date<span class="required-star">*</span></label>
                           <div class="col-sm-4">
                              <div class="custom_date_field">
                                <input type="text" name="end_date" id="end_date" placeholder="Select End Date" class="form-control" autocomplete="off" required>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                              </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee<span class="required-star">*</span></label>
                          <div class="col-sm-4">
                             <select class="form-control select2 select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." name="emp_id[]" id="emp_id" required>
                               <option value="">--Select Employee--</option>
                             </select>
                          </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                          <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/timesheet_freezed/">Cancel</a>
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
<script> 
$( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#start_date" )
        .datepicker({
           defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10',
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ));
          $("#end_date").val('');
        }),
      to = $("#end_date").datepicker({
         defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10',
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate(this));
        getEmployees();
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

function getEmployees()
{
    var StartDate=$('#start_date').val();
    var EndDate=$('#end_date').val();
    if(StartDate!='' && EndDate!='')
    {
        $('#emp_id').find('option').not(':first').remove();
        $.ajax({
            url:'<?=base_url()?>admin/get_timesheet_freezed',
            method: 'POST',
            data: {StartDate: StartDate,EndDate: EndDate},
            dataType: 'json',
            success: function(response){
              $('#emp_id').find('option').not(':first').remove();
              // $('#emp_id').append('<option value="All">All</option>');
              $.each(response,function(index,data){
                  var e_code = '('+data['emp_code']+')';
                 $('#emp_id').append('<option value="'+data['emp_id']+'">'+data['fname'] +' '+data['lname'] +' '+e_code +'</option>');
              });
            }
         });
    }else{
      
    }
}
</script>

