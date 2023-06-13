<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Leaves</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Leaves</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                   <a class="btn app-new-employee-button btn-danger dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/leaves_history" ><i class="fa fa-history" aria-hidden="true"></i> Leaves History</a>
                   <?php if($GetRolesAccess['write']==1){?>
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_leaves" ><i class="mdi mdi-plus mr-2"></i>
                  Add Leaves
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
                  <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Employee Name </th>
                           <th class="all">Period <br>From Date</th>
                           <th>Period To Date</th>
                           <th>Annual Leaves</th>
                           <th class="all">Remaining <br>Annual Leaves</th>
                           <th>Sick Leaves</th>
                           <th class="all">Remaining <br>Sick Leaves</th>
                           <th class="all">Employee <br>Leaves List</th>
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

<script> 
$(document).ready(function() {
  var role_id = '<?php echo @$role_id; ?>'
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
        "url":  "<?php echo base_url();?>admin/get_leaves_list",
        "type": "GET",
        "data": {"role_id": role_id},
        } 
    });

  $('#termination_date').Zebra_DatePicker({});
  $('#termination_date').Zebra_DatePicker({});
});

 function change_leaves_status(emp_id,sta)
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
                      window.location="<?php echo base_url();?>admin/change_leaves_status/"+emp_id+'/'+sta+'/';
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