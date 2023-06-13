<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Maintenance</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Maintenance</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-excel dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/export_candidate_filters/<?php echo $company_id; ?>/<?php echo $job_id; ?>/<?php echo $sta; ?>" ><i class="fa fa-download"></i>
                  Excel
                  </a>
               </div>
            </div>
         </div>
       <?php } ?>
      </div>
      <div class="w-100 mb-3">
          <form method="get" name="myForm" id="myForm" action="<?php echo base_url(); ?>admin/candidate_filters" onsubmit="return FormSubmit();">
              <div class="row mb-2 align-items-end justify-content-end">
                <div class="col-md-6 col-lg-4 col-xl-3">
                      <label>Select Company</label>
                      <select class="form-control select2" name="company_id" id="company_id" onChange="getJobs(this.value);">
                         <option value="">--Select Company--</option>
                         <?php if(!empty($companys)){foreach ($companys as $cmpny) { ?>
                            <option value="<?php echo $cmpny['company_id']; ?>" <?php echo ($cmpny['company_id']==$company_id)?'selected':'';?>><?php echo $cmpny['company_name']; ?></option>
                          <?php } } ?>
                      </select>                      
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3 mt-3 mt-md-0">
                      <label>Select Job</label>
                      <select class="form-control select2" name="job_id" id="job_id">
                         <option value="">--Select Job--</option>
                         <?php if(!empty($jobs)){foreach ($jobs as $job) { ?>
                            <option value="<?php echo $job['job_id']; ?>" <?php echo ($job['job_id']==$job_id)?'selected':'';?>><?php echo $job['job_title']; ?></option>
                          <?php } } ?>
                      </select>                      
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3 mt-3 mt-lg-0">
                      <label>Select Status</label>
                      <select class="form-control" name="sta" id="sta" >
                          <option value="">--Select Status--</option>
                          <option value="source_applied"<?php if($sta=='source_applied') { ?> selected="selected"<?php } ?>>source/applied</option>
                          <option value="contacted"<?php if($sta=='contacted') { ?> selected="selected"<?php } ?>>contacted</option>
                          <option value="internal_interview"<?php if($sta=='internal_interview') { ?> selected="selected"<?php } ?>>internal interview</option>
                          <option value="presented"<?php if($sta=='presented') { ?> selected="selected"<?php } ?>>presented</option>
                          <option value="shortlisted"<?php if($sta=='shortlisted') { ?> selected="selected"<?php } ?>>shortlisted</option>
                          <option value="client_interview"<?php if($sta=='client_interview') { ?> selected="selected"<?php } ?>>client interview</option>
                          <option value="hired"<?php if($sta=='hired') { ?> selected="selected"<?php } ?>>hired</option>
                          <option value="rejected"<?php if($sta=='rejected') { ?> selected="selected"<?php } ?>>rejected</option>
                      </select>                      
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3 mt-3 mt-xl-0 d-lg-flex d-xl-block justify-content-end">
                  <button type="submit" class="btn  btn-primary waves-effect waves-light mr-1">Submit</button>
                  <a href="<?php echo base_url(); ?>admin/candidate_filters" class="btn btn-primary waves-effect waves-light mr-1">Clear All</a>
                  </div>
                 
              </div>
          </form>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <div class="row mt-2">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Name</th>
                           <th>Email Id</th>
                           <th>Mobile No</th>
                           <th>Job Title</th>
                           <th>Status</th>
                           <!-- <?php if($GetRolesAccess['write']==1){?>
                             <th class="all">Status</th>
                             <th class="all">Action</th>
                           <?php } ?> -->
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script> 
$(document).ready(function() {
  var company_id='<?php echo $company_id; ?>';
  var job_id='<?php echo $job_id; ?>';
  var sta='<?php echo $sta; ?>';
   $('#datatable').DataTable({
        "order": [[ 1, "desc" ]],
        "processing": true,
        "serverSide": true,
        "oLanguage": {
            "sLengthMenu": "Number of rows _MENU_ ",
        },
        "language": {
            "info": " _START_ - _END_ of _TOTAL_ ",
            'paginate': {
                'previous': '<b><</b>',
                'next': '<b>></b>'
            },
        },
        "ajax": {
        "url":  "<?php echo base_url();?>admin/get_candidate_filters_list",
        "type": "GET",
        "data": {"company_id": company_id,"job_id": job_id,"sta": sta},
        } 
    });
});
function getJobs(company_id) 
{
    $('#job_id').find('option').not(':first').remove();
    $.ajax({
        url:'<?php echo base_url(); ?>admin/get_jobs_list',
        method: 'POST',
        data: {company_id: company_id},
        dataType: 'json',
        success: function(response){
          console.log(response);
          $('#job_id').find('option').not(':first').remove();
          $.each(response,function(index,data){
          $('#job_id').append('<option value="'+data['job_id']+'">'+data['job_title']+'</option>');
          });
        }
     });
}
function FormSubmit() {
    var company_id = $('#company_id').val();
    var job_id = $('#job_id').val();
    var sta = $('#sta').val();
    if(company_id=='' && job_id=='' && sta==''){
      alert("Please select atleast one option");
      return false;
    }
}
function Clear()
{
  var company_id='';
  var job_id='';
  var sta='';
  window.location="<?php echo base_url();?>admin/candidate_filters/"+company_id+'/'+job_id+'/'+sta+'/';
}
</script>