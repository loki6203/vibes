<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Leaves History</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Leaves History</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/leaves_history/" >
                  <i class="mdi mdi-arrow-left-bold mr-2"></i>Back
                  </a>
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
                           <th>From Date</th>
                           <th>To Date</th>
                           <th>Leave Count</th>
                           <th>Leave Type</th>
                           <th class="all">Leave Status</th>
                           <th class="all">Action</th>
                           <th>Reason</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(count($leaves_list)>0){ $a=1; foreach($leaves_list as $res){ 
                            $emp_id = $res['emp_id'];
                            $employee_leaves_lid = $res['employee_leaves_lid'];
                        ?>
                        <tr class="row_<?php echo $a; ?>">
                           <td><?php echo $a; ?></td>
                           <td><?php echo $emp['fname']; ?><?php echo $emp['lname']; ?> (<?php echo $emp['emp_code']; ?>)</td>
                           <td><?php echo DD_M_YY($res['from_date']); ?></td>
                           <td><?php echo DD_M_YY($res['to_date']); ?></td>
                           <td><?php echo $res['leave_days']; ?></td> 
                           <td><?php echo $res['leave_type']; ?></td>
                             <?php if($res['leave_status']=='0'){ ?>
                                <td><span style="color: #38a4f8">Pending</span><br>Date: <?php echo date("d-M-Y H:i:sa", strtotime($res['created_at'])); ?></td>
                              <?php }else if($res['leave_status']=='1'){ 
                                $ApproveName = $this->db->query("SELECT `log_id`, `admin_id`, `admin_name`, `changed_emp_id`, `changed_id`, `ip_address`, `type`, `status`, `created_at`, `updated_at` FROM `admin_logs` WHERE `changed_emp_id`=$emp_id AND `changed_id`=$employee_leaves_lid AND `status`=1")->row_array();
                              ?>
                                <td><span style="color: #3cde3c;">Approved 
                                  (<?php 
                                      if($ApproveName['admin_name']=='Admin'){
                                        echo "Admin";
                                      }else{
                                        echo strstr($ApproveName['admin_name'],"_", true); 
                                      }
                                    ?>)
                                    </span><br>Date: <?php echo date("d-M-Y H:i:sa", strtotime($res['approved_date'])); ?></td>
                             <?php } else if($res['leave_status']=='2'){ 
                                $RejectNameAdmin = $this->db->query("SELECT `log_id`, `admin_id`, `admin_name`, `changed_emp_id`, `changed_id`, `ip_address`, `type`, `status`, `created_at`, `updated_at` FROM `admin_logs` WHERE `changed_emp_id`=$emp_id AND `changed_id`=$employee_leaves_lid AND `status`=2")->row_array();
                                // echo $this->db->last_query();
                              ?>
                                <td><span style="color: #ff0000;">Rejected by 
                                  (<?php 
                                    if($RejectNameAdmin['admin_name']=='Admin'){
                                      echo "Admin";
                                    }else{
                                      echo strstr($RejectNameAdmin['admin_name'],"_", true);
                                    }
                                  ?>)</span><br>Date: <?php echo date("d-M-Y H:i:sa", strtotime($res['rejected_by_admin_date'])); ?><br>Rejected Reason: <?php echo $res['leave_rejected_reason']; ?></td>
                              <?php } else if($res['leave_status']=='3'){ 
                                $RejectNameEmp = $this->db->query("SELECT `log_id`, `admin_id`, `admin_name`, `changed_emp_id`, `changed_id`, `ip_address`, `type`, `status`, `created_at`, `updated_at` FROM `admin_logs` WHERE `changed_emp_id`=$emp_id AND `changed_id`=$employee_leaves_lid AND `status`=3")->row_array();
                              ?>
                                <td><span style="color: #ff0000;">Cancelled by User </span><br>Date: <?php echo date("d-M-Y H:i:sa", strtotime($res['cancelled_by_user_date'])); ?></td>
                             <?php } else { } ?>
                             <?php if($res['leave_status']=='0'){ ?>
                                <td><button type="button" class="btn btn_success waves-effect waves-light" onclick="change_emp_leave_status('<?php echo $res['emp_id']; ?>','<?php echo $res['employee_leaves_lid']; ?>','1');">Approve</button> / <button type="button" class="btn btn-danger waves-effect waves-light" onclick="change_emp_reject_leave_status('<?php echo $res['emp_id']; ?>','<?php echo $res['employee_leaves_lid']; ?>','2');">Reject</button></td>
                              <?php } else if($res['leave_status']=='1'){ ?>
                                <td><span>- -</span></td>
                             <?php } else if($res['leave_status']=='2'){ ?>
                                <td><span>-  -</spna></td>
                              <?php } else if($res['leave_status']=='3'){ ?>
                                <td><span>- -</span></td>
                             <?php } ?>
                           <td><?php echo $res['reason']; ?></td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Reason <span style="color: red;">*</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" name="myComments" id="myComments" action="<?php echo base_url(); ?>admin/change_emp_reject_leave_status">
          <input type="hidden" name="comment_emp_id" id="comment_emp_id">
          <input type="hidden" name="employee_leaves_lid" id="employee_leaves_lid">
          <input type="hidden" name="c_sta" id="c_sta">
          <div class="modal-body">
                <div class="form-group row">
                    <label for="example-time-input" class="col-sm-2 col-form-label">Reason </label>
                    <div class="col-sm-6">
                       <textarea name="comments" id="comments" placeholder="Enter Comments" required></textarea>
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
$("#myComments").validate({
   rules:{comments:{required:true}},
   messages: {comments:{required:'Please enter comments'}},
  ignore: []
});

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

 function change_emp_reject_leave_status(emp_id,employee_leaves_lid,sta)
   {
      Swal.fire({
           text: "Are you sure want to reject ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                  if(sta=='2'){
                      $('#exampleModalCenter').modal('show');
                      $('#comment_emp_id').val(emp_id);
                      $('#employee_leaves_lid').val(employee_leaves_lid);
                      $('#c_sta').val(sta);
                  }else{
                      window.location="<?php echo base_url();?>admin/change_emp_reject_leave_status/"+emp_id+'/'+employee_leaves_lid+'/'+sta+'/';
                  }
             }
      });
  } 

  function change_emp_leave_status(emp_id,employee_leaves_lid,sta)
  {
      Swal.fire({
           text: "Are you sure want to leave approve ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                  
                  window.location="<?php echo base_url();?>admin/change_emp_approved_leave_status/"+emp_id+'/'+employee_leaves_lid+'/'+sta+'/';
                }
      });
  }
</script>