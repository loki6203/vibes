<?php if(count($emp_list)>0){ ?>
<table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
   <thead>
      <tr>
         <th>S.No</th>
         <th>Employee Name </th>
         <th class="all">Start Date</th>
         <th>End Date</th>
         <th class="all">Document</th>
      </tr>
   </thead>
   <tbody>
      <?php $a=1; foreach($emp_list as $res){ 
            $emp_id=$res['emp_id'];
            $get_emp_details=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
      ?>
      <tr class="row_<?php echo $a; ?>">
         <td><?php echo $a; ?></td>
         <td><?php echo $get_emp_details['fname'];?> <?php echo $get_emp_details['lname']; ?> (<?php echo $get_emp_details['emp_code']; ?>)</td>
         <td><?php echo DD_M_YY($start_date); ?></td>
         <td><?php echo DD_M_YY($end_date); ?></td>
         <td>
            <a class="btn btn-secondary" href="<?php echo base_url(); ?>admin/view_employee_timesheet_list/<?php echo $res['client_id']; ?>/<?php echo $res['emp_id']; ?>/<?php echo $start_date; ?>/<?php echo $end_date; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Timesheet"><i class='fas fa-file-pdf mr-md-1'></i> <span class="d-none d-md-inline-block">Timesheet</span></a>
            <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/download_detailed_timesheet/<?php echo $emp_id; ?>/<?php echo $start_date; ?>/<?php echo $end_date; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Detailed Timesheet"><i class='fas fa-file-pdf mr-md-1'></i> <span class="d-none d-md-inline-block">Detailed Timesheet</span></a>
         </td>
      </tr>
      <?php $a++; } ?>
   <?php } else { ?>
      <span style="color: red;text-align: center;margin-left: 400px;font-size: 18px;">no data found</span>
   <?php } ?>
   </tbody>
</table>

            
           
<script> 
$(document).ready(function() {
   $('#datatable').DataTable();
}); 
</script>