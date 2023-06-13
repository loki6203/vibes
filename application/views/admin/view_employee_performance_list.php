<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Individual Employee Performance Details</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Individual Employee Performance Details</li>
               </ol>
            </div>
         </div>
         <?php if($GetRolesAccess['write']==1){?>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_employee_performance"><i class="mdi mdi-plus mr-2"></i>
                  Add Employee Performance
                  </a>
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_performance/" >
                  <i class="mdi mdi-arrow-left-bold mr-2"></i>Back
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
                           <th class="all">Employee Name </th>
                           <th class="all">Appraisal Date</th>
                           <th class="all">Appraisal Rating</th>
                           <th>Existing Salary</th>
                           <th>New Salary</th>
                           <th>Percentage Hike</th>
                           <th>Existing Role</th>
                           <th>New Role</th>
                           <th>Employee Feedback Comments</th>
                           <th>Relationship Manager Comments</th>
                           <th>HR Feedback</th>
                          <?php if($GetRolesAccess['write']==1){?>
                           <th class="all">Action</th>
                           <th class="all">Edit</th>
                         <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(count($employee_performance_list)>0){ $a=1; foreach($employee_performance_list as $res){ ?>
                        <tr class="row_<?php echo $a; ?>">
                           <td><?php echo $a; ?></td>
                           <td>
                             <?php 
                                $emp_id=$res['emp_id'];
                                if($emp_id!=''){
                                   $Get_Emp_name=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
                                   echo $Get_Emp_name['fname'].' '.$Get_Emp_name['lname'].' ('.$Get_Emp_name['emp_code'].')';}?>
                           </td>
                           <td><?php echo DD_M_YY($res['appraisal_date']);?></td>
                           <td><?php echo $res['appraisal_rating'];?></td>
                           <td><?php echo $res['existing_salary'];?></td>
                           <td><?php echo $res['new_salary'];?></td>
                           <td><?php echo $res['percentage_hike'];?></td>
                           <td><?php echo $res['existing_role'];?></td>
                           <td><?php echo $res['new_role'];?></td>
                           <td><?php echo $res['employee_feedback_comments'];?></td>
                           <td><?php echo $res['relationship_manager_comments'];?></td>
                           <td><?php echo $res['hr_feedback_comments'];?></td>
                           <?php if($GetRolesAccess['write']==1){?>
                             <?php if($res['is_active']=='1'){ ?>
                                <td><button type="button" class="btn btn_success waves-effect waves-light" onclick="change_client_status('<?php echo $res['emp_performance_id'];  ?>','0');">Active</button></td>
                             <?php } else{ ?>
                                <td><button type="button" class="btn btn_warning waves-effect waves-light" onclick="change_client_status('<?php echo $res['emp_performance_id'];  ?>','1');">Inactive</button></td>
                             <?php } ?>
                           <td><a href="<?php echo base_url(); ?>admin/edit_employee_performance/<?php echo $res['emp_performance_id']; ?>/<?php echo $res['emp_id']; ?>/S"><button class="btn btn-info waves-effect waves-light"> Edit </button></a></td>
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

 function change_client_status(client_id,sta)
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
                   window.location="<?php echo base_url();?>admin/change_client_status/"+client_id+'/'+sta+'/';
             }
      });
  } 
</script>