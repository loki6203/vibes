<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> View Employee All Documents</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">  View Employee All Documents</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_employee_document" ><i class="mdi mdi-plus mr-2"></i>
                  Add Employee Checks
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
                           <th>Document Type</th>
                           <th>Date</th>
                           <th>Document</th>
                           <?php if($GetRolesAccess['write']==1){?>
                            <th class="all">Action</th>
                           <?php } ?>
                           <!-- <th class="all">Edit</th> -->
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(count($documents)>0){ $a=1; foreach($documents as $res){ ?>
                        <tr class="row_<?php echo $a; ?>">
                           <td><?php echo $a; ?></td>
                           <td><?php echo $emp['fname']; ?><?php echo $emp['lname']; ?> (<?php echo $emp['emp_code']; ?>)</td>
                           <td><?php echo $res['doc_type']; ?></td>
                           <td><?php echo DD_M_YY($res['created_at']); ?></td>
                           <?php 
                              $file_ext = pathinfo($res['doc_img_path'],PATHINFO_EXTENSION); 
                           ?>
                           <td>
                            <?php if($file_ext!='pdf'){ ?>
                            <img src="<?php echo base_url(); ?>assets/employee_documents/<?php echo $res['doc_img_path']; ?>" width="100px" height="100px">
                          <?php } else { ?>
                              <img src="<?php echo base_url(); ?>assets/pdf_imgpng.jpg" width="100px" height="100px">
                          <?php } ?>
                          </td>
                          <?php if($GetRolesAccess['write']==1){?>
                           <td><a href="<?php echo base_url(); ?>assets/employee_documents/<?php echo $res['doc_img_path']; ?>" target="_blank"><button class="btn btn-info waves-effect waves-light"> View </button></a> | <a href="<?php echo base_url(); ?>admin/file_download/<?php echo $res['employee_document_id']; ?>"><button class="btn btn-info waves-effect waves-light"> Download </button></a> | <button type="button" class="btn btn_success waves-effect waves-light" onclick="edit_emp_document('<?php echo $res['employee_document_id']; ?>','<?php echo $res['doc_img_name']; ?>','<?php echo $res['doc_img_path']; ?>','<?php echo $res['doc_type']; ?>');"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit</button> | <button type="button" class="btn btn-danger waves-effect waves-light" onclick="delete_emp_document('<?php echo $res['employee_document_id'];  ?>','0');">Delete</button></td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Document <span style="color: red;">*</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" name="EditDoc" id="EditDoc" action="<?php echo base_url(); ?>admin/update_emp_individual_doc" enctype="multipart/form-data"> 
          <input type="hidden" name="employee_document_id" id="employee_document_id">
           <input type="text" name="img_name" id="img_name">
          <input type="text" name="img_path" id="img_path">
          <div class="modal-body">
                <div class="form-group row">
                    <label for="example-time-input" class="col-sm-2 col-form-label">Document Type</label>
                    <div class="col-sm-6">
                       <input type="text" name="doc_type" id="doc_type" class="form-control" readonly />
                    </div>
                </div>
               <div class="form-group row">
                    <label for="example-time-input" class="col-sm-2 col-form-label">Upload Document </label>
                    <div class="col-sm-6">
                       <input type="file" name="simage" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf" onchange="loadFile(event)"/>
                       <span>&nbsp;</span>
                           <div>
                                <img width="100px" height="100px" id="output">
                           </div>
                    </div>
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

 function delete_emp_document(employee_document_id,sta)
 {
      Swal.fire({
           text: "Are you sure want to delete this document ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                   window.location="<?php echo base_url();?>admin/delete_emp_document/"+employee_document_id+'/'+sta+'/';
                }
      });
  } 


 function edit_emp_document(employee_document_id,img_name,img_path,doc_type)
 {
      Swal.fire({
           text: "Are you sure want to edit this document ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                    $('#exampleModalCenter').modal('show');
                    $('#employee_document_id').val(employee_document_id);
                    $('#img_name').val(img_name);
                    $('#img_path').val(img_path);
                    $('#doc_type').val(doc_type);
                     // $('#options').removeAttr('selected');
                    // alert($('options').attr('selected', true));
                    // $('#doc_type').attr("value", select).text(doc_type);
                    var src_path = '<?php echo base_url(); ?>assets/employee_documents/'+img_path;
                    var src_path_pdf = '<?php echo base_url(); ?>assets/pdf_imgpng.jpg';
                    var extension = $('#img_path').val().split('.').pop().toLowerCase();
                    if(extension=='pdf'){
                      $('#output').attr('src',src_path_pdf);
                    }else{
                       $('#output').attr('src',src_path);
                    }
                    
             }
      });
  } 

var loadFile = function(event)
{
      var extension = $('#simage').val().split('.').pop().toLowerCase();
      if(extension=='pdf')
      {
         src_path = '<?php echo base_url(); ?>assets/pdf_imgpng.jpg';
         $('#output').attr("src", src_path);
      }else{
         $('#output').removeAttr("src");
         var fileExtension = ['jpeg', 'jpg', 'png'];
         var output = document.getElementById('output');
         output.src = URL.createObjectURL(event.target.files[0]);
         output.onload = function()
         {
            URL.revokeObjectURL(output.src) 
         }
      }
      
}

$("#EditDoc").validate({
   rules:{doc_type:{required:true}},
   messages: {doc_type:{required:'Please select document type'}},
  ignore: []
});
</script>