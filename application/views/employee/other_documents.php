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
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>employee/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Other Documents</li>
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
      <div class="row mt-2">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Document Title</th>
                           <th class="all">Download Document</th>
                        </tr>
                     </thead>
                     <tbody>
                         <?php if(count($confirmation_letter)>0){ $a=1; foreach($confirmation_letter as $letter){ ?>
                        <tr class="row_<?php echo @$a; ?>">
                           <td><?php echo @$a; ?></td>
                           <td><?php echo "Employee confirmation letter_".DD_M_YY($letter['created_at']); ?></td>
                           <td><a href="<?php echo base_url(); ?>employee/Download_ConfirmationofEmployment/<?php echo $letter['confirmation_of_employment_id']; ?>" target="_blank">Download</a></td>
                        </tr>
                        <?php $a++; } } ?>
                      <?php if(count($documents)>0){$a=1; foreach($documents as $doc){ ?>
                        <tr class="row_<?php echo $a; ?>">
                           <td><?php echo $a; ?></td>
                           <td><?php echo $doc['doc_title']; ?></td>
                           <td><a href="<?php echo base_url(); ?>employee/document_file_download/<?php echo $doc['document_id']; ?>" target="_blank">Download</a></td>
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
                  window.location="<?php echo base_url();?>employee/change_other_document_status/"+doc_id+'/'+sta+'/';
             }
      });
  } 
</script>