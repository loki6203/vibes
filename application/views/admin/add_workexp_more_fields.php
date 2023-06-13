<div id="main-div">
       <div class="col-12">
          <div class="row" id="work_exp_div_<?php echo $sn;?>">
             <div class="col-md-4">
                <div class="form-group">
                   <label>Company Name <span class="required-star">*</span></label>
                   <input type="text" name="company_name[]" id="company_name_<?php echo $sn;?>" class="form-control" placeholder="Enter Company Name">
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                   <label>Designation <span class="required-star">*</span></label>
                   <input type="text" name="designation[]" id="designation_<?php echo $sn;?>" class="form-control" placeholder="Enter Designation">
                </div>
             </div>
             <div class="col-md-4 form-group">
                <label>Duration </label>
                <div class="row">
                   <div class="col-6">
                      <input type="text" class="form-control" name="work_duration_start[]" id="work_duration_start_<?php echo $sn;?>" placeholder="Duration">
                   </div>
                   <div class="col-6">
                      <input type="text" name="work_duration_end[]" id="work_duration_end_<?php echo $sn;?>" class="form-control" placeholder="End">
                   </div>
                </div>
             </div>
             <div class="col-12">
                <div class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="remote_in_carrer" id="remote_in_carrer">
                   <label class="custom-control-label" for="remote_in_carrer">List this job as Remote in Career Page.</label>
                </div>
             </div>
          </div>
       </div>
       <div class="col-12 mt-3">
        <?php if($sn==1){ ?>
          <a href="javascript:void(0);" class="btn btn-primary" id="more_<?php echo $sn;?>" onclick="addmore(<?php echo $sn;?>)">Add Work Experience</a>
           <?php }else if($sn>1){ ?>
            <a href="javascript:void(0);" class="btn btn-primary" id="more_<?php echo $sn;?>" onclick="addmore(<?php echo $sn;?>)">Add Work Experience</a>
            <a href="javascript:void(0);" class="btn btn-danger" id="removemore_<?php echo $sn;?>" onclick="Deleterow(<?php echo $sn;?>)">Remove</a>
          <?php } ?>
       </div>
 </div>

<script>
function addmore(id)
{
  $.ajax({
        url: '<?php echo site_url('admin/add_work_exp_fields'); ?>',
        type: 'POST',
        data: {sn: id},
        dataType: 'html',
        success: function(data) {
        $("#main_div").append(data);
        $("#more_"+id).remove();
        }
    });
}
function Deleterow(sn)
{
  $("#work_exp_div_" + sn).remove();
  $("#removemore_" + sn).remove(); 
}
var sn='<?php echo $sn;?>';
$('#work_duration_start_'+sn).Zebra_DatePicker({
           format: 'M-Y',
           pair: $('#work_duration_end_'+sn)
   });
   $('#work_duration_end_'+sn).Zebra_DatePicker({
           format: 'M-Y'
   });
$('#edu_duration_start_'+sn).Zebra_DatePicker({
        format: 'M-Y',
        pair: $('#edu_duration_end_'+sn)
});
$('#edu_duration_end_'+sn).Zebra_DatePicker({
        format: 'M-Y'
});
      
</script>