<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Recruitment</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Recruitment</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_recruitment" ><i class="mdi mdi-plus mr-2"></i>
                  Add Requisition
                  </a>
               </div>
            </div>
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/download_excel_recruitment/<?php echo $status_val; ?>" ><i class="fa fa-download" aria-hidden="true"></i>
                  Excel
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <div class="form-group row">
            <label for="example-time-input" class="col-sm-2 col-form-label"> Select Status</label>
            <div class="col-sm-3">
              <select class="form-control" name="status_val" id="status_val" >
                 <option value="">--Select Status--</option>
                     <option value="Submitted"<?php echo $status_val == "Submitted" ? " selected" : ""; ?>>Submitted</option>
                 <option value="Shorlisted"<?php echo $status_val == "Shorlisted" ? " selected" : ""; ?>>Shorlisted</option>
                 <option value="RejectedbyClient"<?php echo $status_val == "RejectedbyClient" ? " selected" : ""; ?>>Rejected by Client</option>
                 <option value="Selected"<?php echo $status_val == "Selected" ? " selected" : ""; ?>>Selected</option>
              </select>
            </div>
            <button class="btn btn-primary waves-effect waves-light mr-1" onclick="getStatusVal();">Submit</button>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th> Name </th>
                           <th class="all">Current Role</th>
                           <th>Reporting Vendor </th>
                           <th>End Client </th>
                           <th>Applied Role</th>
                           <th>Client Feedback</th>
                           <th>Current Rate Card</th>
                           <th>Proposed Rate Card</th>
                           <th class="all">Notice Period</th>
                           <th>Comments</th>
                           <th class="all">Date of Submission</th>
                           <th class="all">Status</th>
                           <th class="all">Action</th>
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
  var statusval='<?php echo $status_val; ?>'
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
        "url":  "<?php echo base_url();?>admin/get_recruitment_list",
        "type": "GET",
        "data": {"statusval": statusval},
        } 
    });
});

function GetVal(sel,id)
{
    var status =sel.value;
    var id =id;
      Swal.fire({
           text: "Are you sure want to change status ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                  
                  window.location="<?php echo base_url();?>admin/change_recruitment_status/"+status+'/'+id;
              }
      });
} 

function getStatusVal()
{
    var status_val =$('#status_val').val();
    window.location.href = '<?php echo base_url();?>admin/recruitment_status_list/'+status_val;
}
</script>