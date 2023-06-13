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
               <h4 class="font-size-18">Add Leave</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>employee/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Leave</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>employee/leaves/" >
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
                  <form method="post" action="<?php echo base_url(); ?>employee/save_leaves" id="save_leaves" name="save_leaves" enctype="multipart/form-data" class="custom-validation">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">Leave Type </label>
                        <div class="col-sm-10">
                           <select class="form-control" name="leave_type" id="leave_type" onChange="DisplayDiv();" required>
                              <option value="">-- Select Leave Type --</option>
                              <option value="Annual Leave">Annual Leave</option>
                              <option value="Sick Leave">Sick Leave</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> From Date</label>
                        <div class="col-sm-10">
                            <div class="custom_date_field">
                                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Select From Date" autocomplete="off" required/>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> To Date </label>
                        <div class="col-sm-10">
                            <div class="custom_date_field">
                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Select To Date" autocomplete="off" required />
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Reason Leaves </label>
                        <div class="col-sm-10">
                           <textarea class="form-control" name="reason" id="reason" placeholder="Enter Reason" rows="5" cols="5" required></textarea>
                        </div>
                     </div>
                     <div class="form-group row ImgDiv">
                        <label for="example-time-input" class="col-sm-2 col-form-label">  Doctor Certificate </label>
                        <div class="col-sm-10">
                           <input type="file" class="form-control" name="simage" id="simage" accept="image/*, application/pdf" onchange="validateFileType();">
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>employee/leaves/">Cancel</a>
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
    $(document).ready(function(){
       $('.ImgDiv').hide();
    });

    $( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#from_date" )
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
          $("#to_date").val('');
        }),
      to = $( "#to_date" ).datepicker({
         defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10',
          onSelect: function() {
            var leave_type=$('#leave_type').val();
              if(leave_type=='Sick Leave')
              {
                 DisplayDiv(); 
              }
      
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
  
 
function DisplayDiv(){
    var leave_type=$('#leave_type').val();
    if(leave_type=='Sick Leave')
    {
        var from_date=$('#from_date').val();
        var to_date=$('#to_date').val();
        $.ajax({
              url: '<?php echo site_url('employee/get_leaves_count'); ?>',
              type: 'POST',
              data: {
                  from_date: from_date,to_date: to_date
              },
              success: function(data) {
                 if(data<=2){
                     $('.ImgDiv').hide();
                 }else{
                     $('.ImgDiv').show();
                 }
              }
        });
    }else{
        $('.ImgDiv').hide();
    }
}
function validateFileType(){
     var fileName = document.getElementById("simage").value;
     var idxDot = fileName.lastIndexOf(".") + 1;
     var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
     if (extFile=="jpg" || extFile=="jpeg" || extFile=="png" || extFile=="pdf"){
     }else{
         alert("Only jpg/jpeg/png, and pdf files are allowed!");
          var fileName = document.getElementById("simage").value='';
     }   
 }
</script>