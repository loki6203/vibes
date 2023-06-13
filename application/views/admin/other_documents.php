<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Other Documents</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Other Documents</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_other_document" ><i class="mdi mdi-plus mr-2"></i>
                  Add Other Document
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
                           <th>Employee Name </th>
                           <th>Document Title</th>
                           <th class="all">View Document</th>
                           <?php if($GetRolesAccess['write']==1){?>
                           <th class="all">Status</th>
                           <th class="all">Action</th>
                         <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                         <?php if(count($confirmation_letter)>0){ $a=1; foreach($confirmation_letter as $letter){ 
                            $emp_id=$letter['emp_id'];
                            $getEmpDet = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
                          ?>
                          <tr class="row_<?php echo $a; ?>">
                             <td><?php echo $a; ?></td>
                             <td><?php echo @$getEmpDet['fname'].' '.@$getEmpDet['lname'].' ('.@$getEmpDet['emp_code'].')'; ?></td>
                              <td><?php echo "ECL (".DD_M_YY($letter['created_at']); ?>)</td>
                             <td><a href="<?php echo base_url(); ?>employee/Download_ConfirmationofEmployment/<?php echo $letter['confirmation_of_employment_id']; ?>" target="_blank">View (ECL)</a></td>
                             <?php if($GetRolesAccess['write']==1){?>
                            <td>- -</td>
                            <td>- -</td>
                          <?php } ?>
                          </tr>
                          <?php $a++; } } ?>
                        <?php if(count($documents)>0){$a=1; foreach($documents as $doc){ ?>
                          <tr class="row_<?php echo $a; ?>">
                             <td><?php echo $a; ?></td>
                             <td><?php echo $doc['fname'].' '.$doc['lname'].' ('.$doc['emp_code'].')'; ?></td>
                             <td><?php echo $doc['doc_title']; ?></td>
                               <td><a href=<?php echo base_url(); ?>assets/other_documents/<?php echo $doc['document_path']; ?> target="_blank"> View </a></td>
                               <?php if($GetRolesAccess['write']==1){?>
                               <?php if($doc['is_active'] == 0) { ?>
                                  <td><button class="btn btn-danger waves-effect waves-light" onclick="change_other_document_status(<?php echo $doc['document_id']; ?>,1);"> Inactive </button></td>
                                <?php }else{ ?>
                                 <td><button class="btn btn_success waves-effect waves-light" onclick="change_other_document_status(<?php echo $doc['document_id']; ?>,0);"> Active </button></td>
                                <?php } ?>
                               <td><a href="<?php echo base_url(); ?>admin/edit_other_document/<?php echo $doc['document_id']; ?>" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a></td>
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

 function change_other_document_status(doc_id,sta)
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
                  window.location="<?php echo base_url();?>admin/change_other_document_status/"+doc_id+'/'+sta+'/';
             }
      });
  } 
</script>