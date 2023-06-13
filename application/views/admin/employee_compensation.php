<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Employee Compensation</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>employee/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Employee Compensation</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
              <div class="dropdown app-new-employee-button">
                   <?php if($GetRolesAccess['write']==1){?>
                        <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_employee_compensation" ><i class="mdi mdi-plus mr-2"></i>Add Employee Compensation</a>
                    <?php } ?>
                  <?php if($status=='Inactive'){ ?>
                    <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_compensation/" ><i class="mdi mdi-arrow-left-bold mr-2"></i>Back</a>
                  <?php } else { ?>
                    <a class="btn app-new-employee-button btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_compensation/Inactive" >Inactive</a>
                  <?php } ?>
                  <a class="btn btn-excel dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/export_employee_compensation" ><i class="fa fa-download" aria-hidden="true"></i>&nbsp; Excel</a>
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
                  <table id="datatable" class="table nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th>Employee Name</th>
                           <th>Per Hr Rate</th>
                           <th>Monthly Salary</th>
                           <th>CTC</th>
                           <th>Contract Start Date</th>
                           <th>Contract End Date</th>
                           <th>Employment Type</th>
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
          "url":  "<?php echo base_url();?>admin/get_employee_compensation_list",
          "data":{
            "status": "<?php echo @$status; ?>"
          },
        } 
    });
});

</script>