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
               <?php if(@$employee_compensation['employee_compensation_id']!=''){ ?>
               <h4 class="font-size-18">Edit Employee Compensation</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Employee Compensation</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$employee_compensation['employee_compensation_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Employee Compensation</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Employee Compensation</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_compensation/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_employee_compensation" id="save_employee_compensation" name="save_employee_compensation" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="employee_compensation_id" id="employee_compensation_id" class="form-control" value="<?php echo @$employee_compensation['employee_compensation_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <select class="form-control select2" name="emp_id" id="emp_id" required onchange="GetEmploymentType(this);">
                              <option value="">-- Select Employee --</option>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                                  <option value="<?php echo $emp['emp_id'];?>" <?php echo ($emp['emp_id']==@$employee_compensation['emp_id'])?'selected':'';?>><?php echo $emp['fname'];?> <?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Per Hour Rate <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="per_hour_rate" id="per_hour_rate" class="form-control" placeholder="Enter Per Hour Rate" value="<?php echo @$employee_compensation['per_hour_rate']; ?>" required autocomplete="off" onkeyup="HrsRate();"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Monthly Salary <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="monthly_salary" id="monthly_salary" class="form-control" placeholder="Enter Monthly Salary" value="<?php echo @$employee_compensation['monthly_salary']; ?>" required autocomplete="off" onkeyup="MonthlySalary();"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> CTC <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="ctc" id="ctc" class="form-control" placeholder="Enter CTC" value="<?php echo @$employee_compensation['ctc']; ?>" style="background-color: #d8d7d7"; readonly/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Contract Start Date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="custom_date_field">
                              <input type="text" name="contact_start_dt" id="contact_start_dt" class="form-control" placeholder="Select Contract Start Date" value="<?php echo @$employee_compensation['contact_start_dt']; ?>" required autocomplete="off"/>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Contract End Date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="custom_date_field">
                              <input type="text" name="contact_end_dt" id="contact_end_dt" class="form-control" placeholder="Select Contract End Date" value="<?php echo @$employee_compensation['contact_end_dt']; ?>" required autocomplete="off"/>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row EmpType" style="display:none;">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Employment Type <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <select class="form-control" name="employment_type" id="employment_type">
                              <option value="">-- Select Employment Type --</option>
                              <?php if(count($employment_type)>0){foreach($employment_type as $emptype){ ?>
                                  <option value="<?php echo $emptype;?>" <?php echo ($emptype==@$employee_compensation['employment_type'])?'selected':'';?>><?php echo $emptype;?></option>
                              <?php } } ?>
                           </select>
                        </div>
                    </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_compensation/">Cancel</a>
                           <?php if(@$employee_compensation['employee_compensation_id']!=''){ ?>
                           <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Update</button>
                           <?php } else { ?>
                           <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Save</button>
                           <?php } ?>
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
$(document).ready(function(){
    var EID='<?php echo @$employee_compensation['emp_id']; ?>';
    if(EID!='')
    {
        $('.EmpType').removeAttr('style');
    }
});
$('#per_hour_rate,#monthly_salary,#ctc').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});
$(function()
{
    var dateFormat = "dd-mm-yy",
    from = $("#contact_start_dt")
    .datepicker({
      dateFormat: 'dd-mm-yy',
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
      $("#contact_end_dt").val('');
    }),
    to = $("#contact_end_dt").datepicker({
        dateFormat: 'dd-mm-yy',
    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });
 
    function getDate(element)
    {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }
  });

function HrsRate()
{
    var per_hour_rate=$('#per_hour_rate').val();
    if(per_hour_rate!='')
    {
      $('#monthly_salary').val('');
      $('#ctc').val('');
      var MnthSalry=(per_hour_rate)*(168);
      var FloatMnth=parseFloat(MnthSalry).toFixed(2);
      $('#monthly_salary').val(FloatMnth);
      var TotlCTC=(MnthSalry)*(12);
      var FloatCTC=parseFloat(TotlCTC).toFixed(2);
      $('#ctc').val(FloatCTC)
    }else{
      $('#monthly_salary').val('');
      $('#ctc').val('');
    }
}
function MonthlySalary()
{
    var monthly_salary=$('#monthly_salary').val();
    if(monthly_salary!='')
    {
      $('#per_hour_rate').val('');
      $('#ctc').val('');
      var PerHrRate=(monthly_salary)/(168);
      var FloatPerHrRate=parseFloat(PerHrRate).toFixed(2);
      $('#per_hour_rate').val(FloatPerHrRate);
      var TotlCTC=(monthly_salary)*(12);
      var FloatCTC=parseFloat(TotlCTC).toFixed(2);
      $('#ctc').val(FloatCTC)
    }else{
      $('#per_hour_rate').val('');
      $('#ctc').val('');
    }
}
function CTC()
{
    var ctc=$('#ctc').val();
    if(ctc!='')
    {
      $('#per_hour_rate').val('');
      $('#monthly_salary').val('');
      var PerHrRate=(ctc)/(365)/(8);
      var FloatPerHrRate=parseFloat(PerHrRate).toFixed(2);
      $('#per_hour_rate').val(FloatPerHrRate);
      var MnthSalry=(ctc)/(12);
      var FloatMnth=parseFloat(MnthSalry).toFixed(2);
      $('#monthly_salary').val(FloatMnth);
    }else{
      $('#per_hour_rate').val('');
      $('#monthly_salary').val('');
    }
}
function GetEmploymentType(emp_id)
{
   var emp_id=$('#emp_id').val();
   if(emp_id!=''){
       $('.EmpType').removeAttr('style');
       $('#employment_type').attr("required", "true");
        $.ajax({
           url:"<?php echo base_url();?>admin/get_employment_type",
           method:"POST",
           dataType: 'json',
           data:{emp_id:emp_id},
           success:function(data) {
              var parse_data = data.Val;
              var Sel = data.SelectedVal;
              $('#employment_type').find('option').remove();
              $.each(parse_data,function(index,value){
                  if(value==Sel){
                      var SelectedVal='Selected';
                  }else{
                     var SelectedVal=''; 
                  }
                 $("#employment_type").append("<option value='"+value+"' "+SelectedVal+">" + value + "</option>");   
              });
           }
        })
   }else{
       $('.EmpType').attr("style", "display:none");
       $('#employment_type').attr("required", "false"); 
   }
}
</script>
