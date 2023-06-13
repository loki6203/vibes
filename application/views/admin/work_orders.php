<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Work Orders</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>employee/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Work Orders</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
         <div class="col-sm-6">
            <div class="float-right">
              <div class="dropdown app-new-employee-button">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_work_order" ><i class="mdi mdi-plus mr-2"></i>Add Work Order</a>
                  <a class="btn btn-excel dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/export_work_orders/" ><i class="fa fa-download" aria-hidden="true"></i>&nbsp; Excel</a>
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
                  <table id="datatable" class="table nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Client Name</th>
                           <th>Project Name</th>
                           <th>PO</th>
                           <th>No.of Resources</th>
                           <?php if($GetRolesAccess['write']==1){?>
                           <th>Action</th>
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
          "url":  "<?php echo base_url();?>admin/get_work_order_list",
        } 
    });
});

function change_work_order_status(work_orders_id,sta)
{
    Swal.fire({
         text: "Are you sure want to generate password ?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes'
       }).then((result) => {
             if (result.isConfirmed)
             {
                  window.location="<?php echo base_url();?>admin/change_work_order_status/"+work_orders_id+'/'+sta;
           }
    });
}
</script>