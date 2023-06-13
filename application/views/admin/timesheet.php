
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
               <h4 class="font-size-18"> Timesheet</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Timesheet</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      
      <div class="row" style="background-color: #fff;">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                <form method="post" class="form-group select-conainer-100" name="myForm" id="myForm" action="#">
                  <div class="row">
                    <div class="col-12 col-md-6 col-xl-3">
                          <label>Select Client</label>
                          <select class="form-control select2" name="client_id" id="client_id" onChange="getEmployees(this.value);">
                             <option value="">Select Client</option>
                             <?php if(!empty($clients)){foreach ($clients as $clnt) { ?>
                                <option value="<?php echo $clnt['client_id']; ?>"><?php echo $clnt['client_name']; ?></option>
                              <?php } } ?>
                          </select>                      
                      </div>
                      <div class="col-12 col-md-6 col-xl-3 mt-3 mt-md-0">
                          <label>Select Employee</label>
                          <select class="form-control select2" name="emp_id" id="emp_id" >
                             <option value="">Select Employee</option>
                          </select>                      
                      </div>
                      <div class="col-12 col-md-6 col-xl-3 mt-3 mt-xl-0">
                          <label>Start Date</label>
                          <div class="custom_date_field">
                            <input type="text" name="start_date" id="start_date" placeholder="Select Start Date" class="form-control" autocomplete="off">
                            <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-xl-3 mt-3 mt-xl-0">
                          <label>End Date</label>  
                           <div class="custom_date_field">
                            <input type="text" name="end_date" id="end_date" placeholder="Select End Date" class="form-control" autocomplete="off">
                            <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                      </div>
                      </div>
                      <div class="col-12 mt-3 d-flex justify-content-end">
                          <button type="button" class="btn btn-primary waves-effect waves-light mr-1"  Onclick="FormSubmit();">View</button>
                      </div>
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


function FormSubmit() {
    var client_id = $('#client_id').val();
    var emp_id = $('#emp_id').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val(); 
    if(client_id==''){
      alert("Please Select Client");
      return false;
    }else if(emp_id==''){
      alert("Please Select Employee");
      return false;
    }else if(start_date==''){
      alert("Please Select Start Date");
      return false;
    }else if(end_date==''){
      alert("Please Select End Date");
      return false;
    }
    $.ajax({
        url: '<?php echo site_url('admin/get_timesheet_list'); ?>',
        type: 'POST',
        data: {client_id: client_id,emp_id: emp_id,start_date: start_date,end_date: end_date},
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

  function getEmployees(client_id) 
  {
    $('#emp_id').find('option').not(':first').remove();
    $.ajax({
        url:'<?=base_url()?>admin/get_client_employee_list',
        method: 'POST',
        data: {client_id: client_id},
        dataType: 'json',
        success: function(response){
          $('#emp_id').find('option').not(':first').remove();
          $('#emp_id').append('<option value="All">All</option>');
          $.each(response,function(index,data){
              var e_code = '('+data['emp_code']+')';
             $('#emp_id').append('<option value="'+data['emp_id']+'">'+data['fname'] +' '+data['lname'] +' '+e_code +'</option>');
          });
        }
     });
  }
</script>