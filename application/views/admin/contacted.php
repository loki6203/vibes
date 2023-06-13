<div class="Main-Div-contacted">
   <input type="hidden" name="ccount" class="ccount" value="<?php echo count($Arr_contacted); ?>">
<?php if(!empty($Arr_contacted)){ $a=1;foreach ($Arr_contacted as $contacted) { ?>
<div class="Div-contacted new-app-div-interview-box mb-3">
<a href="<?php echo base_url(); ?>admin/candidate_profile/<?php echo $contacted['candidate_applied_id']; ?>">
<li class="delivery-manager-kanban-card-item" id="contacted_<?php echo $contacted['candidate_applied_id']; ?>">
   <img class="kanban-card-item-profile" src="<?php echo base_url(); ?>/assets/candidate_images/<?php echo $contacted['user_photo_path']; ?>"/>
   <div class="delivery-manager-kanban-card-content">
      <div class="delivery-manager-kanban-card-content-title">
         <div class="kanban-card-content-title-info">
          <input type="hidden" name="candidate_applied_id_name" class="candidate_applied_id_name_<?php echo $contacted['candidate_applied_id']; ?>" value="<?php echo $contacted['fname']; ?> <?php echo $contacted['lname']; ?>">
            <h4><?php echo $contacted['fname']; ?> <?php echo $contacted['lname']; ?></h4>
            <p>Experience 
              +<?php 
                  $candidate_applied_id=$contacted['candidate_applied_id'];
                  $exp=$this->db->query("SELECT `job_work_expericence_id`, `candidate_applied_id`, `company_name`, `designation`, `work_duration_start`, `work_duration_end`, SUM(`years`) as `years`, SUM(`months`) as `months` FROM `candidate_work_expericence` WHERE `candidate_applied_id`=$candidate_applied_id")->result_array();
                  $Years=$exp[0]['years'];
                  $Months=$exp[0]['months'];
                  $YearsMnth=floor($Months/12);
                  $MonthMnths=$Months%12;
                  $TotlYear=$Years+$YearsMnth;
                  echo $TotlYear; ?> years <?php echo $MonthMnths; ?> months
            </p>
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
         <div class="kanban-card-content-ratings new-app-date">
            <p>+27 <?php echo $contacted['phone_no']; ?></p>
            <ul class="rating-stars">
               <?php if(@$contacted['rating']==''){ ?>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
              <?php }else if(@$contacted['rating']==1){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$contacted['rating']==2){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$contacted['rating']==3){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$contacted['rating']==4){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="far fa-star"></i></li>
             <?php }else if(@$contacted['rating']==5){ ?>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
               <li><i class="fas fa-star"></i></li>
             <?php } ?>
            </ul>
         </div>
         <div class="kanban-card-content-date new-app-date-2">
            <p><?php echo $contacted['email_id']; ?></p>
            <span><i class="far fa-clock"></i>
              <?php 
                $candidate_applied_id=$contacted['candidate_applied_id'];
                $company_id=$contacted['company_id'];
                $job_id=$contacted['job_id'];
                $StatusDtlogs=$this->db->query("SELECT `candidate_job_status_logs_id`, `emp_id`, `candidate_applied_id`, `company_id`, `job_id`, `status`, `date`, `comments` FROM `candidate_job_status_logs` WHERE `candidate_applied_id`=$candidate_applied_id AND `company_id`=$company_id AND `job_id`=$job_id AND `status`='contacted' ORDER BY `candidate_job_status_logs_id` DESC")->row_array();
                echo DD_M_YY_h_i_s($StatusDtlogs['date']); 
              ?>
            </span>
         </div>
      </a>
         <select class="form-control" name="select_contacted" id="select_contacted" onchange="Source_2(2,this,<?php echo $a; ?>,<?php echo $contacted['candidate_applied_id']; ?>);">
           <option value="source_applied">source/applied</option>
           <option value="contacted" selected>contacted</option>
           <option value="internal interview">internal interview</option>
           <option value="presented">presented</option>
           <option value="shortlisted">shortlisted</option>
           <option value="client interview">client interview</option>
           <option value="hired">hired</option>
           <option value="rejected">rejected</option>
        </select>
        <span class="new-app-comment-symbol" onclick="Comments_2(<?php echo $contacted['candidate_applied_id']; ?>,<?php echo $company_id; ?>,<?php echo $job_id; ?>,'contacted');"><i class="fa fa-comments" aria-hidden="true"></i></span> 
      </div>
   </div>
</li>
</div>
<?php } $a++;} else{?>
  <span style="color: red;">no data found</span>
  <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="CommentsModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="model_candidate_applied_id" class="model_candidate_applied_id">
          <input type="hidden" name="model_company_id" class="model_company_id">
          <input type="hidden" name="model_job_id" class="model_job_id">
          <input type="hidden" name="model_type" class="model_type">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comments:</label>
            <textarea class="form-control" name="cmnts" id="cmnts" placeholder="Enter Comments" rows="4" cols="4"></textarea>
            &nbsp;
            <div class="div-previos-comments"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="SaveComments_2();">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End Model -->

<script>
   function Source_2(type,sel,a,candidate_applied_id)
   {
      var val=sel.value;
      var company_id='<?php echo $company_id; ?>';
      var job_id='<?php echo $job_id; ?>';
      var count=$('.kanban-card-connected-count-contacted').text();
      if(count==0){
          $('.kanban-card-connected-count-contacted').text(1);
      }else{
        $('.kanban-card-connected-count-contacted').text((count)-(1));
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
                  $('#internal_interview_'+candidate_applied_id).remove();
               }else if(type==4){
                  $('#hired_'+candidate_applied_id).remove();
               }else if(type==5){
                  $('#rejected_'+candidate_applied_id).remove();
               }else if(type==6){
                  $('#presented_'+candidate_applied_id).remove();
               }else if(type==7){
                   $('#shortlisted_'+candidate_applied_id).remove();
               }else if(type==8){
                   $('#client_interview_'+candidate_applied_id).remove();
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
               }else if(val=='internal interview'){
                  var count=$('.kanban-card-interview-count').text();
                  if(count==0){
                      $('.kanban-card-interview-count').text(1);
                  }else{
                    $('.kanban-card-interview-count').text((count)-(1));
                  }
                  $('.Main-Div-interview').html(res);
               }else if(val=='presented'){
                  var count=$('.kanban-card-presented-count').text();
                  if(count==0){
                      $('.kanban-card-presented-count').text(1);
                  }else{
                    $('.kanban-card-presented-count').text((count)-(1));
                  }
                  $('.Main-Div-presented').html(res);
             }else if(val=='shortlisted'){
                  var count=$('.kanban-card-shortlisted-count').text();
                  if(count==0){
                      $('.kanban-card-shortlisted-count').text(1);
                  }else{
                    $('.kanban-card-shortlisted-count').text((count)-(1));
                  }
                  $('.Main-Div-shortlisted').html(res);
             }else if(val=='client interview'){
                  var count=$('.kanban-card-client_interview-count').text();
                  if(count==0){
                      $('.kanban-card-client_interview-count').text(1);
                  }else{
                    $('.kanban-card-client_interview-count').text((count)-(1));
                  }
                  $('.Main-Div-client_interview').html(res);
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
function Comments_2(candidate_applied_id,company_id,job_id,type)
{
  $('.model_candidate_applied_id').val(candidate_applied_id);
  $('.model_company_id').val(company_id);
  $('.model_job_id').val(job_id);
  $('.model_type').val(type);
  var name=$('.candidate_applied_id_name_'+candidate_applied_id).val(); 
  $('.modal-title').text(name);
  $.ajax({
        url: '<?php echo site_url('admin/ajax_candidate_comments'); ?>',
        type: 'POST',
        data: {candidate_applied_id: candidate_applied_id,val: 'contacted',cmnts:''},
        success: function(res) {
            $('.div-previos-comments').html(res);
        }
    });
  $('#CommentsModalCenter').modal('show');
}
function SaveComments_2()
{
  var candidate_applied_id=$('.model_candidate_applied_id').val();
  var company_id=$('.model_company_id').val();
  var job_id=$('.model_job_id').val();
  var val=$('.model_type').val();
  var cmnts=$('#cmnts').val();
  if(cmnts==''){
    alert("Please enter comments");
    return false;
  }else{
      $.ajax({
          url: '<?php echo site_url('admin/ajax_candidate_comments'); ?>',
          type: 'POST',
          data: {candidate_applied_id: candidate_applied_id,company_id: company_id,job_id: job_id,val: val,cmnts: cmnts},
          success: function(res) {
              $('#cmnts').val('');
              $('.div-previos-comments').html(res);
          }
      });
  }
}
</script>