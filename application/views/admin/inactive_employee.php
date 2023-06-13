<style>
  .Zebra_DatePicker_Icon{
    right: -186px !important;
  }
  .in_cls{
    padding-right: 20px !important;
  }

</style>
<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Inactive Employees</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Inactive Employees</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                  </a>
                  <?php if($GetRolesAccess['write']==1){?>
                    <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_employee" ><i class="mdi mdi-plus mr-2"></i>
                    Add Employee
                    </a>
                <?php } ?>
               </div>
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
                  <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>First Name </th>
                           <th>Last Name</th>
                           <th class="all">Employee Code</th>
                           <th>Email ID</th>
                           <th class="all">Date of Join</th>
                           <th>Date Of Birth</th>
                           <th>Gender</th>
                           <th>Designation</th>
                           <th>Mobile No</th>
                           <th>ID Type</th>
                           <th>ID No</th>
                           <th>Inactive Comments</th>
                           <th>View Document</th>
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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Comments <span style="color: red;">*</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" name="myComments" id="myComments" action="<?php echo base_url(); ?>admin/change_employee_status_comments">
          <input type="hidden" name="comment_emp_id" id="comment_emp_id">
          <input type="hidden" name="comment_sta" id="comment_sta">
          <div class="modal-body">
                <div class="form-group row">
                    <label for="example-time-input" class="col-sm-4 col-form-label">Comments </label>
                    <div class="col-sm-6">
                       <textarea name="comments" id="comments" placeholder="Enter Comments" required rows="4" cols="35"></textarea>
                    </div>
                </div>
               <div class="form-group row">
                    <label for="example-time-input" class="col-sm-4 col-form-label">Termination Date </label>
                    <div class="col-sm-6">
                       <input type="text" name="termination_date" id="termination_date" style="width: auto !important;" class="form-control in_cls" placeholder="Select Termination Date" />
                    </div>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
    </form>
    </div>
  </div>
</div>
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
        "url":  "<?php echo base_url();?>admin/get_inactive_employee_list",
        } 
    });

  $('#termination_date').Zebra_DatePicker({
   });

  $("#myComments").validate({
   rules:{comments:{required:true},termination_date:{required:true}},
   messages: {comments:{required:'Please enter comments'},termination_date:{required:'Please select date'}},
  ignore: []
});

});

 function change_employee_status(emp_id,sta)
   {
      Swal.fire({
           text: "Are you sure want to change the status?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                  if(sta==0){
                    $('#exampleModalCenter').modal('show');
                    $('#comment_emp_id').val(emp_id);
                    $('#comment_sta').val(sta);
                  }else{
                      window.location="<?php echo base_url();?>admin/change_employee_status/"+emp_id+'/'+sta+'/';
                  }
             }
      });
  } 

 function generate_password(emp_id)
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
                    window.location="<?php echo base_url();?>admin/generate_employee_password_email/"+emp_id+'/';
             }
      });
  }
</script>