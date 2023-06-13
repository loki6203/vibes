<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Assets</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Assets</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_asset" ><i class="mdi mdi-plus mr-2"></i>
                  Add Asset
                  </a>
               </div>
            </div>
         </div>
       <?php } ?>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Name</th>
                           <th>Asset Tag</th>
                           <th>Type</th>
                           <th>Brand</th>
                           <th>Location</th>
                           <?php if($GetRolesAccess['write']==1){?>
                             <th class="all">Assign To</th>
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
<div class="modal fade" id="Asset-assign-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Assign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="append-asset-data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="myForm();">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<script> 
$(document).ready(function() {
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
        "url":  "<?php echo base_url();?>admin/get_assets_list",
        } 
    });
});

function change_asset_status(asset_id,sta)
{
    Swal.fire({
         text: "Are you sure want to change the status ?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes'
       }).then((result) => {
             if (result.isConfirmed)
             {
                window.location="<?php echo base_url();?>admin/change_asset_status/"+asset_id+'/'+sta+'/';
           }
    });
}
function assign_asset(asset_id,type)
{
    if(type!=''){
      $('.modal-title').text(type);
    }
    if(type!='' && asset_id!=''){
      $.ajax({
          url: '<?php echo site_url('admin/ajax_assign_asset'); ?>',
          type: 'POST',
          data: {asset_id: asset_id,type: type},
          success: function(res)
          {
              if(res==0){
                alert("Opps! something went to wrong...");
              }else{
                $('.append-asset-data').html(res);
              }
          },error: function(res){
              alert("Opps! something went to wrong...");
          }
      });
      $('#Asset-assign-model').modal('show');
    }else{
      alert("Opps! something went to wrong...");
    }
} 
function Deassign(asset_id)
{
  assign_asset(asset_id,'Deassign');
}
</script>