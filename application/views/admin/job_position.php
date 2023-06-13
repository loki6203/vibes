<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="app-job-positions app-job-position-new">
                <div class="new-app-job-position">
                    <div class="new-app-job-position-content ">
                <h1>Job Positions</h1>
                <div class="app-job-positions-actions">
                    <div class="app-job-positions-action-search">
                        <input type="text" placeholder="Search..." name="search" id="search" autocomplete="off">
                        <img src="<?php echo base_url(); ?>assets/admin/images/search-icon.svg"/>
                        <i class="fa fa-times" onClick="Clear();"></i>
                    </div>
                </div>
                </div>
                    <div class="app-job-positions-actions-content">
                        <ul class="app-job-positions-actions-list new-app-positions-actions-list new-app-positions-actions-list-2">
                            <li>
                                <div class="form-group filter-select new-app-form-group-filter-select">
                                    <select name="act_inact" id="act_inact" data-minimum-results-for-search="Infinity" class="form-control select2" onChange="getval(this,'Active_Inactive');">
                                        <option selected value="">Filter</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="form-group sort-select new-app-form-group-filter-select">
                                    <select name="cmpny" id="cmpny" data-minimum-results-for-search="Infinity" class="form-control select2" onChange="getval(this,'Comapnies');">
                                        <option value="">Sort by company</option>
                                        <?php if(!empty($companies)){
                                              foreach ($companies as $cmp) {
                                        ?>
                                        <option value="<?php echo $cmp['company_id']; ?>"><?php echo $cmp['company_name']; ?> </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </li>
                            <li class="new-app-create-job-button">
                                <a href="<?php echo base_url(); ?>admin/create_job" class="btn-new  btn-primary-new">Create Job</a>
                            </li>
                            <li>
                                <a class="btn btn-excel dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/export_candidate_application/<?php echo 'job_position'; ?>"><i class="fa fa-download" aria-hidden="true"></i>&nbsp; Excel</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="job-position-card-section">
                <div class="row" id="ppage">
                    <?php echo $ppage; ?>
                </div>
            </div>
        </div>
    </div>

<script>
 $("#search").keyup(function(){
    var search = $('#search').val();
    if(search==''){
        var search='NA';
    }
    var active_inactive = $('#act_inact').val();
    var cmpny = $('#cmpny').val();
        $.ajax({
        url: '<?php echo site_url('admin/job_position'); ?>',
        type: 'GET',
        data: {search: search,active_inactive: active_inactive,cmpny : cmpny},
        success: function(data) {
            if(data==''){
                $('#ppage').html('<span style="color: red;text-align:center">no data found</span>');
            }else{
               $('#ppage').html(data); 
            }
            
        }
    });
  });

function getval(sel,type)
{
    if(sel=='NA'){
        var search = 'NA';
    }else{
        var search = $('#search').val();
    }
    var active_inactive = $('#act_inact').val();
    var cmpny = $('#cmpny').val();
        $.ajax({
            url: '<?php echo site_url('admin/job_position'); ?>',
            type: 'GET',
            data: {search: search,type: type,active_inactive: active_inactive,cmpny : cmpny},
            success: function(data) {
                if(data==''){
                    $('#ppage').html('<span style="color: red;text-align:center">no data found</span>');
                }else{
                   $('#ppage').html(data); 
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
