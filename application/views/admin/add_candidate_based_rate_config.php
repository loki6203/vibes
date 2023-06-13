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
               <?php if(@$contract_list['contract_list_id']!=''){ ?>
               <h4 class="font-size-18">Edit Candidate Based Rate Config</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Candidate Based Rate Config</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$contract_list['contract_list_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Candidate Based Rate Config</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Candidate Based Rate Config</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/candidate_based_rate_config/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_candidate_based_rate_config" id="save_candidate_based_rate_config" name="save_candidate_based_rate_config" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="candidate_based_rate_config_id" id="candidate_based_rate_config_id" class="form-control" value="<?php echo @$contract_list['candidate_based_rate_config_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Name <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Name" value="<?php echo @$contract_list['name']; ?>" required autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> ID No<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="id_no" id="id_no" class="form-control" placeholder="Enter ID No" value="<?php echo @$contract_list['id_no']; ?>" required autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Candidate Expected Rate Per Hrs <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="excepted_rate_in_hrs" id="excepted_rate_in_hrs" class="form-control" placeholder="Enter Rate Per Hrs" value="<?php echo @$contract_list['excepted_rate_in_hrs']; ?>" required autocomplete="off" onkeyup="Cal();"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Min Client Rate <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="min_client_rate" id="min_client_rate" class="form-control" placeholder="Enter Min Client Rate" value="<?php echo @$contract_list['min_client_rate']; ?>" required autocomplete="off" style="background-color: #d8d7d7"; readonly/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Max Client Rate <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="max_client_rate" id="max_client_rate" class="form-control" placeholder="Enter Max Client Rate" value="<?php echo @$contract_list['max_client_rate']; ?>" required autocomplete="off" style="background-color: #d8d7d7"; readonly/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/candidate_based_rate_config/">Cancel</a>
                           <?php if(@$contract_list['candidate_based_rate_config_id']!=''){ ?>
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
$('#excepted_rate_in_hrs,#min_client_rate,#max_client_rate').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});

function Cal()
{
    var MinClientRate ='<?php echo @$rate_calculator_config["min_client_rate"]; ?>';
    var MaxClientRate ='<?php echo @$rate_calculator_config["max_client_rate"]; ?>';
    if($('#excepted_rate_in_hrs').val()!='' && MinClientRate!='' && MaxClientRate!='')
    {
      var GetExceptedRateInHrs=$('#excepted_rate_in_hrs').val();
      var MinClientRate=(GetExceptedRateInHrs)/(MinClientRate);
      var FloatMin=parseFloat(MinClientRate).toFixed(2);
      $('#min_client_rate').val(FloatMin);
      var MaxClientRate=(GetExceptedRateInHrs)/(MaxClientRate);
      var FloatMax=parseFloat(MaxClientRate).toFixed(2);
      $('#max_client_rate').val(FloatMax);
    }else if($('#excepted_rate_in_hrs').val()==''){
      $('#min_client_rate').val('');
      $('#max_client_rate').val('');
    }else if(MinClientRate=='' || MaxClientRate==''){
      alert('Opps! rate calculator config is empty...');
      $('#excepted_rate_in_hrs').val('');
      $('#min_client_rate').val('');
      $('#max_client_rate').val('');
    }else{
      alert('Opps! something went to wrong...');
      $('#excepted_rate_in_hrs').val('');
      $('#min_client_rate').val('');
      $('#max_client_rate').val('');
    }
}

</script>
