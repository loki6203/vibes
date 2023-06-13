<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Claims</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>employee/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Claims</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <table id="datatable" class="table nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Employee</th>
                           <th>Claim Type </th>
                           <th>Date</th>
                           <th>Amount</th>
                           <th>Comments</th>
                           <th class="all">Status</th>
                           <th class="all">View</th>
                           <th>Accepted/Rejected Comments</th>
                           <?php if($GetRolesAccess['write']==1){?>
                                <th class="all">Action</th>
                           <?php } ?>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form method="post" action="<?php echo base_url(); ?>admin/approved_rejected_claims" name="save_approved_rejected_claims">
      <div class="modal-header">
        <h5 class="modal-title labl-txt-head" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="claims_model_id" id="claims_model_id">
          <input type="hidden" name="approved_rejected_sta" id="approved_rejected_sta">
        <div class="form-group">
            <label for="message-text" class="col-form-label labl-txt"></label>
            <textarea class="form-control" name="accepted_rejected_comments" id="accepted_rejected_comments"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--End Model-->

<script> 
$(document).ready(function() {
   $('#datatable').DataTable({
        "order": [[ 1, "desc" ]],
        "processing": true,
        "serverSide": true,
        "scrollX": true,
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
        "url":  "<?php echo base_url();?>admin/get_claims_list",
        } 
    });
});

function approved(claim_id)
{
  Swal.fire({
       text: "Are you sure want to Approved this claim?",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes'
     }).then((result) => {
           if (result.isConfirmed)
           {
               $('#claims_model_id').val(claim_id);
               $('#approved_rejected_sta').val(1);
               $('.labl-txt-head').text('Approved Comments');
               $('.labl-txt').text('Approved Comments :');
               $('#exampleModalCenter').modal('show');
         }
  });
}

function rejected(claim_id)
{
  Swal.fire({
       text: "Are you sure want to Rejected this claim?",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes'
     }).then((result) => {
           if (result.isConfirmed)
           {
               $('#claims_model_id').val(claim_id);
               $('#approved_rejected_sta').val(0);
               $('.labl-txt-head').text('Rejected Comments');
               $('.labl-txt').text('Rejected Comments :');
               $('#exampleModalCenter').modal('show');
                // window.location="<?php echo base_url();?>admin/approved_rejected_claims/"+claim_id+'/'+0;
         }
  });
}
</script>