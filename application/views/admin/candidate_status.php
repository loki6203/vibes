<style>
  .kanban-card-content-date p{ 
  width: 170px;
  display: inline-block;
  white-space: nowrap;
  overflow: hidden !important;
  text-overflow: ellipsis;
}
</style>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <div class="app-job-positions app-job-position-new">
         <div class="new-app-job-position">
         <div class="new-app-job-position-content">
         <h1><?php echo $GetJobTitle['job_title']; ?></h1>
         <div class="app-job-positions-actions">
            <div class="app-job-positions-action-search">
               <input type="text" name="search" id="search" placeholder="Search..." autocomplete="off">
               <img src="<?php echo base_url(); ?>assets/admin/images/search-icon.svg"/>
               <i class="fas fa-times" onClick="Clear();"></i>
            </div>
         </div>
         </div>
            <div class="app-job-positions-actions-content">
               <ul class="app-job-positions-actions-list new-app-positions-actions-list">
                  <li>
                     <div class="form-group filter-select new-form-group-filter-select-2">
                        <select data-minimum-results-for-search="Infinity" class="form-control select2" name="active_inactive" id="active_inactive" onChange="getval(this,'Active_Inactive');">
                           <option selected value="NA">Filter</option>
                           <option value="source/applied">source/applied</option>
                           <option value="contacted">contacted</option>
                           <option value="internal_interview">internal interview</option>
                           <option value="presented">presented</option>
                           <option value="shortlisted">shortlisted</option>
                           <option value="client_interview">client interview</option>
                           <option value="hired">hired</option>
                           <option value="rejected">rejected</option>
                        </select>
                     </div>
                  </li>
                 <!--  <li>
                     <div class="form-group sort-select">
                        <select data-minimum-results-for-search="Infinity" class="form-control select2">
                           <option disabled selected>Sort by company</option>
                           <option value="AK">option 1</option>
                           <option value="HI">option 2</option>
                        </select>
                     </div>
                  </li> -->
                  <!-- <li>
                     <a href="" class="btn-new btn-primary-new">Create</a>
                  </li> -->
                  <li class="new-app-candidate-status-button mt-3 mt-md-0">
                    <!-- <a href="<?php echo base_url(); ?>admin/candidate_application/<?php echo $this->encryption->encrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $company_id)); ?>/<?php echo $this->encryption->encrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $job_id)); ?>" class="btn-new btn-primary-new">Add Candidate</a> -->
                     <a href="<?php echo base_url(); ?>candidate-application/<?php echo $company_id; ?>/<?php echo $job_id; ?>" class="btn-new app-new-candidate-button btn-primary-new">Add Candidate</a>
                     <a class="btn btn-excel dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/export_candidate_application/<?php echo 'candidate_status'; ?>/<?php echo $company_id; ?>/<?php echo $job_id; ?>"><i class="fa fa-download" aria-hidden="true"></i>&nbsp; 
                  Excel
                  </a>
                  </li>
               </ul>
            </div>
      </div>
         </div>
      </div>
      <div class="delivery-manager-wrapper">
         <ul  class="delivery-manager-kanban-row">
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>source/applied</h4>
                     <ul>
                        <!-- li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-source-count-applied"><?php echo count($Arr_source); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_1">
                        <div class="source-applied">
                           <?php echo $source_applied; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>contacted</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-connected-count-contacted"><?php echo count($Arr_contacted); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_2">
                        <div class="contacted">
                           <?php echo $contacted; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>internal interview</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-interview-count"><?php echo count($Arr_interview); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_3">
                        <div class="internal_interview">
                           <?php echo $internal_interview; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>presented</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-presented-count"><?php echo count($Arr_presented); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_3">
                        <div class="presented">
                           <?php echo $presented; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>shortlisted</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-shortlisted-count"><?php echo count($Arr_shortlisted); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_3">
                        <div class="shortlisted">
                           <?php echo $shortlisted; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>client interview</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-client_interview-count"><?php echo count($Arr_client_interview); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_3">
                        <div class="client_interview">
                           <?php echo $client_interview; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>hired</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-hired-count"><?php echo count($Arr_hired); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_4">
                        <div class="hired">
                           <?php echo $hired; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
            <li class="delivery-manager-kanban-column">
               <div class="delivery-manager-kanban-card">
                  <div class="delivery-manager-kanban-card-header">
                     <h4>rejected</h4>
                     <ul>
                        <!-- <li class="kanban-card-action dropdown">
                           <button type="button"><i class="fa fa-plus"></i></button>
                        </li> -->
                        <li class="kanban-card-rejected-count"><?php echo count($Arr_rejected); ?></li>
                     </ul>
                  </div>
                  <div class="delivery-manager-kanban-card-body">
                     <ul class="delivery-manager-kanban-card-list droptrue" id="sortable_5">
                        <div class="rejected">
                           <?php echo $rejected; ?>
                        </div>
                     </ul>
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>
</div>

<script>
 $("#search").keyup(function(){
    var company_id='<?php echo $company_id; ?>';
    var job_id='<?php echo $job_id; ?>';
    var search = $('#search').val();
    if(search==''){
        var search='NA';
    }
    var active_inactive = $('#active_inactive').val();
    var cmpny = $('#cmpny').val();
        $.ajax({
        url: '<?php echo site_url('admin/candidate_status'); ?>',
        type: 'GET',
        dataType:'json',
        data: {company_id: company_id,job_id: job_id,search: search,active_inactive: active_inactive,cmpny : cmpny},
        success: function(data) {
          // alert(data.source_applied);
          //console.log(data.internal_interview);
            if(data.source_applied=='' || data.contacted=='' || data.internal_interview=='' || data.presented=='' || data.shortlisted=='' || data.client_interview=='' || data.hired=='' || data.rejected==''){
                $('.source-applied').html('<span style="color: red;text-align:center">no data found</span>');
            }else{
               $('.source-applied').html(data.source_applied); 
               $('.contacted').html(data.contacted); 
               $('.internal_interview').html(data.internal_interview);
               $('.presented').html(data.presented);
               $('.shortlisted').html(data.shortlisted); 
               $('.client_interview').html(data.client_interview);  
               $('.hired').html(data.hired); 
               $('.rejected').html(data.rejected); 
            }
            
        }
    });
  });

function getval(sel,type)
{
    var company_id='<?php echo $company_id; ?>';
    var job_id='<?php echo $job_id; ?>';
    if(sel=='NA'){
        var search = 'NA';
    }else{
        var search = $('#search').val();
    }
    var active_inactive = $('#active_inactive').val();
    var cmpny = $('#cmpny').val();
        $.ajax({
        url: '<?php echo site_url('admin/candidate_status'); ?>',
        type: 'GET',
        dataType:'json',
        data: {company_id: company_id,job_id: job_id,search: search,active_inactive: active_inactive,cmpny : cmpny},
        success: function(data) {
            if(data.source_applied=='' && data.contacted==''){
                $('.source-applied,.contacted').html('<span style="color: red;text-align:center">no data found</span>');
            }else{
               $('.source-applied').html(data.source_applied); 
               $('.contacted').html(data.contacted); 
               $('.internal_interview').html(data.internal_interview);
               $('.presented').html(data.presented);
               $('.shortlisted').html(data.shortlisted);
               $('.client_interview').html(data.client_interview); 
               $('.hired').html(data.hired); 
               $('.rejected').html(data.rejected); 
            }
            
        }
    });
}

function Clear()
{
    var search = $('#search').val('');
    getval('NA');
}
</script>

