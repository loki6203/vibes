<div class="Main-Div-interview">
   <input type="hidden" name="icount" class="icount" value="<?php echo count($Arr_interview); ?>">
<?php if(!empty($Arr_interview)){ $a=1;foreach ($Arr_interview as $interview) { ?>
<div class="Div-interview">
<a href="<?php echo base_url(); ?>admin/candidate_profile/<?php echo $interview['candidate_applied_id']; ?>">
<li class="delivery-manager-kanban-card-item" id="interview_<?php echo $interview['candidate_applied_id']; ?>">
   <img class="kanban-card-item-profile" src="<?php echo base_url(); ?>/assets/candidate_images/<?php echo $interview['user_photo_path']; ?>"/>
   <div class="delivery-manager-kanban-card-content">
      <div class="delivery-manager-kanban-card-content-title">
         <div class="kanban-card-content-title-info">
            <h4><?php echo $interview['fname']; ?> <?php echo $interview['lname']; ?></h4>
            <p>Experience 
               <?php 
                $candidate_applied_id=$interview['candidate_applied_id'];
                $get_exp=$this->db->query("SELECT `job_work_expericence_id`, `candidate_applied_id`, `company_name`, `designation`, `work_duration_start`, `work_duration_end`, SUM(`years`), `remote_in_career_page` FROM `candidate_work_expericence` WHERE `candidate_applied_id`=$candidate_applied_id")->row_array();
              echo $get_exp['SUM(`years`)']; ?>+ Years</p>
         </div>
         <!-- <div class="dropdown">
            <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
               <a class="dropdown-item" href="#">Action</a>
               <a class="dropdown-item" href="#">Another action</a>
               <a class="dropdown-item" href="#">Something else here</a>
            </div>
         </div> -->
      </div>
      <div class="delivery-manager-kanban-card-content-info">
         <div class="kanban-card-content-ratings">
            <p>+27 <?php echo $interview['phone_no']; ?></p>
            <ul class="rating-stars">
               <?php if(@$interview['rating']==''){ ?>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
              <?php }else if(@$interview['rating']==1){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$interview['rating']==2){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$interview['rating']==3){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$interview['rating']==4){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$interview['rating']==5){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
             <?php } ?>
            </ul>
         </div>
         <div class="kanban-card-content-date">
            <p><?php echo $interview['email_id']; ?></p>
            <span><i class="far fa-clock"></i> <?php echo DD_M_YY(@$interview['created_at']); ?></span>
         </div>
      </a>
         <select class="form-control" name="select_contacted" id="select_contacted" onchange="Source_3(3,this,<?php echo $a; ?>,<?php echo $interview['candidate_applied_id']; ?>);">
           <option value="source_applied">source/applied</option>
           <option value="contacted">contacted</option>
           <option value="interview" selected>interview</option>
           <option value="hired">hired</option>
           <option value="rejected">rejected</option>
        </select>
      </div>
   </div>
</li>
</div>
<?php } $a++;} ?>
</div>

<script>
function Source_3(type,sel,a,candidate_applied_id)
{
   var val=sel.value;
   var company_id='<?php echo $company_id; ?>';
   var job_id='<?php echo $job_id; ?>';
   var count=$('.kanban-card-interview-count').text();
   if(count==0){
      $('.kanban-card-interview-count').text(1);
   }else{
      $('.kanban-card-interview-count').text((count)-(1));
   } 
   $.ajax({
         url: '<?php echo site_url('admin/ajax_candidate_status'); ?>',
         type: 'POST',
         data: {val: val,candidate_applied_id: candidate_applied_id,company_id: company_id,job_id: job_id},
         success: function(res) {
         if(type==1){
               $('#source_applied_'+candidate_applied_id).remove();
            }else if(type==2){
               $('#contacted_'+candidate_applied_id).remove();
            }else if(type==3){
               $('#interview_'+candidate_applied_id).remove();
            }else if(type==4){
               $('#hired_'+candidate_applied_id).remove();
            }else if(type==5){
               $('#rejected_'+candidate_applied_id).remove();
            }

            if(val=='source_applied'){
                var count=$('.kanban-card-source-count-applied').text();
                if(count==0){
                    $('.kanban-card-source-count-applied').text(1);
                }else{
                  $('.kanban-card-source-count-applied').text((count)-(1));
                }
                $('.Main-Div-source_applied').html(res);
             }else if(val=='contacted'){
                var count=$('.kanban-card-connected-count-contacted').text();
                if(count==0){
                    $('.kanban-card-connected-count-contacted').text(1);
                }else{
                  $('.kanban-card-connected-count-contacted').text((count)-(1));
                }
                $('.Main-Div-contacted').html(res);
             }else if(val=='interview'){
                var count=$('.kanban-card-interview-count').text();
                if(count==0){
                    $('.kanban-card-interview-count').text(1);
                }else{
                  $('.kanban-card-interview-count').text((count)-(1));
                }
                $('.Main-Div-interview').html(res);
             }else if(val=='hired'){
                var count=$('.kanban-card-hired-count').text();
                if(count==0){
                    $('.kanban-card-hired-count').text(1);
                }else{
                  $('.kanban-card-hired-count').text((count)-(1));
                }
                $('.Main-Div-hired').html(res);
             }else if(val=='rejected'){
                var count=$('.kanban-card-rejected-count').text();
                if(count==0){
                    $('.kanban-card-rejected-count').text(1);
                }else{
                  $('.kanban-card-rejected-count').text((count)-(1));
                }
                $('.Main-Div-rejected').html(res);
             }
         }
     });
}
</script>