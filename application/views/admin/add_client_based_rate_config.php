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
               <?php if(@$client_based_rate_config['client_based_rate_config_id']!=''){ ?>
               <h4 class="font-size-18">Edit Client Based Rate Config</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Client Based Rate Config</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$client_based_rate_config['client_based_rate_config_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Client Based Rate Config</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Client Based Rate Config</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/client_based_rate_config/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_client_based_rate_config" id="save_client_based_rate_config" name="save_client_based_rate_config" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="client_based_rate_config_id" id="client_based_rate_config_id" class="form-control" value="<?php echo @$client_based_rate_config['client_based_rate_config_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Name <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Name" value="<?php echo @$client_based_rate_config['name']; ?>" required autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client Rate Card<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="client_rate_card" id="client_rate_card" class="form-control" placeholder="Enter Client Rate Card" value="<?php echo @$client_based_rate_config['client_rate_card']; ?>" required autocomplete="off" onkeyup="Cal();"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Min Candidate Rate<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="min_candidate_rate" id="min_candidate_rate" class="form-control" placeholder="Enter Min Candidate Rate" value="<?php echo @$client_based_rate_config['min_candidate_rate']; ?>" required style="background-color: #d8d7d7"; readonly />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Max Candidate Rate <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="max_candidate_rate" id="max_candidate_rate" class="form-control" placeholder="Enter Max Candidate Rate" value="<?php echo @$client_based_rate_config['max_candidate_rate']; ?>" required style="background-color: #d8d7d7"; readonly/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/client_based_rate_config/">Cancel</a>
                           <?php if(@$client_based_rate_config['client_based_rate_config_id']!=''){ ?>
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
$('#client_rate_card,#min_candidate_rate,#max_candidate_rate').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});

function Cal()
{
    var MinClientRate ='<?php echo @$rate_calculator_config["min_client_rate"]; ?>';
    var MaxClientRate ='<?php echo @$rate_calculator_config["max_client_rate"]; ?>';
    if($('#client_rate_card').val()!='' && MinClientRate!='' && MaxClientRate!='')
    {
      var GetClientRateCard=$('#client_rate_card').val();
      var MinCandidateRate=(GetClientRateCard)/(MaxClientRate);
      var FloatMin=parseFloat(MinCandidateRate).toFixed(2);
      $('#min_candidate_rate').val(FloatMin);
      var MaxCandidateRate=(GetClientRateCard)/(MinClientRate);
      var FloatMin=parseFloat(MaxCandidateRate).toFixed(2);
      $('#max_candidate_rate').val(FloatMin);
    }else if($('#client_rate_card').val()==''){
        $('#min_candidate_rate').val('');
        $('#max_candidate_rate').val('');
    }else if(MaxClientRate=='' || MaxClientRate==''){
      alert('Opps! rate calculator config is empty...');
      $('#client_rate_card').val('');
      $('#min_candidate_rate').val('');
      $('#max_candidate_rate').val('');
    }else{
      alert('Opps! something went to wrong...');
      $('#client_rate_card').val('');
      $('#min_candidate_rate').val('');
      $('#max_candidate_rate').val('');
    }
}
</script>
