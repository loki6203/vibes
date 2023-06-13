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
               <h4 class="font-size-18"> Fill Timesheet</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Fill Timesheet</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      
      <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <div class="row mt-2" style="background-color: #fff;">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                 <form method="post" name="myForm" id="myForm" action="<?php echo base_url(); ?>">
                    <div class="row container">
                          <div class="col-lg-5">
                              <div class="row align-items-center app-new-employee-button">
                                <div class="col-lg-3">
                                  <label for="example-time-input" class="form-label  mb-0">Start Date</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="custom_date_field">
                                        <input type="text" name="start_date" id="start_date" placeholder="Select Start Date" class="form-control" autocomplete="off" value="<?php echo @$from;?>">
                                        <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                                    </div>
                                </div>
                              </div> 
                          </div>
                          <div class="col-lg-5">
                              <div class="row align-items-center app-new-employee-button ">
                                <div class="col-lg-3">
                                  <label for="example-time-input" class="form-label  mb-0">End Date</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="custom_date_field">
                                        <input type="text" name="end_date" id="end_date" placeholder="Select End Date" class="form-control" autocomplete="off" value="<?php echo @$to;?>">
                                        <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                                   </div>
                                </div>
                              </div> 
                          </div>
                          <div class="col-lg-2"> <input type="button" name="Submit" id="Submit" value="Submit" Onclick="FormSubmit();" class="btn btn-primary waves-effect waves-light mr-1"></div>
                    </div>
                 </form>
                   <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                   <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  <div class="append_timesheet"></div>
               </div>
            </div>
         </div>
         <!-- end col -->
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
          to.datepicker( "option", "minDate", getDate( this ) );
          $("#end_date").val('');
        }),
      to = $( "#end_date" ).datepicker({
         defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10',
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
  
var dtstatus = '<?php echo @($from!='' && $to!='')?'1':'0'?>';
if(parseInt(dtstatus)==1){FormSubmit_Save();}

function FormSubmit(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val(); 
    if(start_date==''){
      alert("Please Select Start Date");
      return false;
    }else if(end_date==''){
      alert("Please Select End Date");
      return false;
    }
    $.ajax({
        url: '<?php echo site_url('employee/fill_timesheet_list'); ?>',
        type: 'POST',
        data: {start_date: start_date,end_date: end_date},
        success: function(data) {
            $('.append_timesheet').html(data);
        }
    });
}

function FormSubmit_Save()
{
    var start_date = '<?php echo $from; ?>';
    var end_date = '<?php echo $to; ?>';
    if(start_date==''){
      alert("Please Select Start Date");
      return false;
    }else if(end_date==''){
      alert("Please Select End Date");
      return false;
    }
    $.ajax({
        url: '<?php echo site_url('employee/fill_timesheet_list'); ?>',
        type: 'POST',
        data: {start_date: start_date,end_date: end_date},
        success: function(data) {
            $('.append_timesheet').html(data);
        }
    });
}

function change_employee_status(emp_id,sta)
{
    Swal.fire({
       text: "Are you sure want to change the status?",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes'
     }).then((result) => {
           if (result.isConfirmed)
           {
              if(sta==0){
                $('#exampleModalCenter').modal('show');
                $('#comment_emp_id').val(emp_id);
                $('#comment_sta').val(sta);
              }else{
                  window.location="<?php echo base_url();?>admin/change_employee_status/"+emp_id+'/'+sta+'/';
              }
         }
    });
} 

function generate_password(emp_id)
{
  Swal.fire({
       text: "Are you sure want to generate password ?",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes'
     }).then((result) => {
           if (result.isConfirmed)
           {
                window.location="<?php echo base_url();?>admin/generate_employee_password_email/"+emp_id+'/';
         }
  });
}
</script>