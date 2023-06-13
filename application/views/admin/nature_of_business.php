<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Nature of Business</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Nature of Business</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
             <div class="col-sm-6">
                <div class="float-right">
                   <div class="dropdown">
                   <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_nature_of_business"><i class="mdi mdi-plus mr-2"></i>Add Nature of Business</a>
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
                           <th>Nature of Business </th>
                           <?php if($GetRolesAccess['write']==1){?>
                            <th class="all">Action</th>
                            <th class="all">Edit</th>
                         <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(count($nature_of_business)>0){ $a=1; foreach($nature_of_business as $res){ ?>
                        <tr class="row_<?php echo $a; ?>">
                           <td><?php echo $a; ?></td>
                           <td><?php echo $res['name']; ?></td>
                           <?php if($GetRolesAccess['write']==1){?>
                             <?php if($res['is_active']=='1'){ ?>
                                <td><button type="button" class="btn btn_success waves-effect waves-light" onclick="change_nature_of_business_status('<?php echo $res['nature_of_business_id'];  ?>','0');">Active</button></td>
                             <?php } else{ ?>
                                <td><button type="button" class="btn btn_warning waves-effect waves-light" onclick="change_nature_of_business_status('<?php echo $res['nature_of_business_id'];  ?>','1');">Inactive</button></td>
                             <?php } ?>
                           <td><a href="<?php echo base_url(); ?>admin/add_nature_of_business/<?php echo $res['nature_of_business_id']; ?>"><button class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </button></a></td>
                           <?php } ?>
                        </tr>
                        <?php $a++; } } ?>
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
        "oLanguage": {
            "sLengthMenu": "Number of rows _MENU_ ",
        },
        "language": {
            "info": " _START_ - _END_ of _TOTAL_ ",
            'paginate': {
                'previous': '<b><</b>',
                'next': '<b>></b>'
            },
        }
    });
});
function change_nature_of_business_status(nature_of_business_id,sta)
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
                 window.location="<?php echo base_url();?>admin/change_nature_of_business_status/"+nature_of_business_id+'/'+sta+'/';
           }
    });
} 
</script>