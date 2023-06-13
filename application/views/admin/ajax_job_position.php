<?php if(!empty($job_position)){ 
    $a=1;
    foreach ($job_position as $job) { 
    if($job['job_title']!=''){
?>
    <div class="col-md-6 col-lg-4 DIVCls">
        <div class="job-position-card job-position-card_<?php echo $a; ?>">
            <div class="job-position-card-title">
                <h4><?php echo $job['job_title']; ?></h4>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/create_job/<?php echo $job['job_id']; ?>">Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="PreviewJob(<?php echo $job['job_id']; ?>);">Preview Job</a>
                        <div class="Edit-Job_<?php echo $a; ?>">
                            <?php if($job['job_is_active']==1) { ?>
                            <a class="dropdown-item" href="javascript:void(0);" onClick="change_job_status(<?php echo $a; ?>,<?php echo $job['job_id']; ?>,0);" style="color: #4BB543;">Active</a>
                            <?php } else { ?>
                                <a class="dropdown-item" href="javascript:void(0);" onClick="change_job_status(<?php echo $a; ?>,<?php echo $job['job_id']; ?>,1);" style="color: #e6183a;">Inactive</a>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url(); ?>admin/candidate_status/<?php echo $job['company_id']; ?>/<?php echo $job['job_id']; ?>">
                <div class="job-position-card-body">
                    <div class="job-position-card-count">
                        <div class="job-position-card-count-bg">
                            <span>
                                <?php 
                                    $company_id=$job['company_id'];
                                    $job_id=$job['job_id'];
                                    $jobs_count_query=$this->db->query("SELECT * FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id")->num_rows();
                                    echo $jobs_count_query; 
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="job-position-card-applicants">
                        <ul>
                            <li>
                                <p><?php echo $jobs_count_query; ?> New Applications</p>
                            </li>
                            <!-- <li>
                                <p>1 To Recruit</p>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </a>
            <div class="job-position-card-footer">
                <ul>
                    <li>
                        <h6><?php echo $job['company_name']; ?></h6>
                    </li>
                    <li>
                        <div class="job-position-card-footer-toggle">
                            <input id="job_toggle_<?php echo $a; ?>" class="d-none job_toggle_cls" type="checkbox" <?php if($job['job_is_active']==1) {echo "checked";}else{ } ?> data-value="<?php echo $job['job_id']; ?>" value="<?php if($job['job_is_active']==1) {echo 'checked';}else{echo 'unchecked'; } ?>"/>
                            <label for="job_toggle_<?php echo $a; ?>"></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php $a++;} } }else{  ?><span style="color: red;">no data found</span><?php } ?>

<!-- Model -->
<div class="modal fade bs-example-modal-xl" id="preview-job-dialog"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Preview Job Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" name="model_edit_id" id="model_edit_id">
            <div class="modal-body">
                <div class="preview-job-dialog-content">
                    <div class="preview-job-dialog-heading">
                        <h1 class="model_job_title"></h1>
                        <ul class="d-flex align-items-center p-0 m-0 list-style-none">
                            <li class="model_location"></li>
                            <li class="mx-3">|</li>
                            <li class="model_department"></li>
                        </ul>
                    </div>
                    <div class="preview-job-dialog-body-wrapper d-flex">
                        <div class="preview-job-dialog-body-left p-3">
                            <div class="model_job_description"></div>
                        </div>
                        <div class="preview-job-dialog-body-right p-3">
                            <ul class="p-0 m-0 list-style-none d-flex flex-column">
                                <li class="mb-2">
                                    <h6 class="mb-2">Employment Type </h6>
                                    <p class="model_employment_type"></p>
                                </li>
                                <li class="mb-2">
                                    <h6 class="mb-2">Seniority Level  </h6>
                                    <p class="model_seniority_level"></p>
                                </li>
                                <li class="mb-2">
                                    <h6 class="mb-2">Industry Type  </h6>
                                    <p class="model_industry_type"></p>
                                </li>
                                <li class="mb-2">
                                    <h6 class="mb-2">Skills </h6>
                                    <ul class="preview-job-dialog-skills model_skills">
                                        <li></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
$(".job_toggle_cls").change(function(){
    if($(this).prop("checked") == true){
        var data_value=$(this).attr("data-value");
        var checked_not =1;
    }else{
        var data_value=$(this).attr("data-value");
        var checked_not =0;
    }
    $.ajax({
        url: '<?php echo site_url('admin/change_job_status'); ?>',
        type: 'POST',
        data: {data_value: data_value,checked_not: checked_not},
        success: function(data) {
        }
    });
});
function change_job_status(a,job_id,status)
{
    if(status==0){
        Stus='Inactive';
        Val=1;
        Color='#e6183a';
    }else{
        Stus='Active';
        Val=0;
        Color='#4BB543';
    }
   $.ajax({
        url: '<?php echo site_url('admin/change_company_status'); ?>',
        type: 'POST',
        data: {job_id: job_id,status: status},
        success: function(data) {
            if(data==1){
                $('.Edit-Job_'+a).html('<a class="dropdown-item" href="javascript:void(0);" onClick="change_job_status('+a+','+job_id+','+Val+');" style="color:'+Color+'">'+Stus+'</a>');
            }
        }
    }); 
}
function PreviewJob(job_id)
{
    if(job_id==''){
        alert('Opps! somenthing went to wrong...');
    }else{
        $.ajax({
        url: '<?php echo site_url('admin/preview_job_details'); ?>',
        type: 'POST',
        data: {job_id: job_id},
        dataType: 'json',
        success: function(res) {
            if(res.job_title==''){
                   alert('Opps! something went to wrong...');
            }else{
                  $('.model_job_title').text(res.job_title);
                  $('.model_location').text(res.location);
                  $('.model_department').text(res.department);
                  $('.model_job_description').html(res.job_description);
                  $('.model_employment_type').text(res.employment_type);
                  $('.model_seniority_level').text(res.seniority_level);
                  $('.model_industry_type').text(res.industry_type);
                  var str = res.skills;
                  var myArray = str.split(",");
                  $('.model_skills').html('');
                  $.each(myArray, function (index, value) {
                    $('.model_skills').append('<li>'+value+'</li>');
                  });
            }
        }
    });
    }
    $('#preview-job-dialog').modal('show');
}
</script>