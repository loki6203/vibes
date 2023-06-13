<input type="hidden" name="model_work_orders_id" class="model-work_orders_id" value="<?php echo @$work_orders_id; ?>">
<?php 
$CountKeys = count($work_order_resources);
$key=1;
if(!empty($work_order_resources)){foreach ($work_order_resources as $order_resources) { ?>
<div class="form-group Add-Remove-Cls-<?php echo $key; ?>">
<div class="row">
<label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee<span class="required-star">*</span></label>
    <div class="col-sm-2">
        <?php
            $emp_id=$order_resources['emp_id'];
            $Emp=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
        ?>
         <input type="text" name="emp_id[]" id="emp_id_<?php echo $key; ?>" class="form-control" placeholder="Enter Backlog Amt" value="<?php echo @$Emp['fname']; ?> <?php echo @$Emp['lname']; ?>" required autocomplete="off"/>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Per Hr <span class="required-star">*</span></label>
    <div class="col-sm-2">
         <input type="text" name="emp_per_hrs[]" id="emp_per_hrs_<?php echo $key; ?>" class="form-control" placeholder="Enter Employee Per Hr" value="<?php echo @$order_resources['emp_per_hrs']; ?>" required autocomplete="off"/>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> Start Date <span class="required-star">*</span></label>
    <div class="col-sm-2">
         <div class="custom_date_field">
          <input type="text" name="emp_start_dt[]" id="emp_start_dt_<?php echo $key; ?>" class="form-control" placeholder="Select End Date" autocomplete="off" required value="<?php echo @DD_M_YY($order_resources['emp_start_dt']); ?>"/>
          <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
        </div>
    </div>
</div>
<div class="row mt-4">
<label for="example-time-input" class="col-sm-2 col-form-label"> End Date <span class="required-star">*</span></label>
    <div class="col-sm-2">
        <div class="custom_date_field">
          <input type="text" name="emp_end_dt[]" id="emp_end_dt_<?php echo $key; ?>" class="form-control" placeholder="Select End Date" autocomplete="off" required value="<?php echo @DD_M_YY($order_resources['emp_end_dt']); ?>" />
          <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
        </div>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Title <span class="required-star">*</span></label>
    <div class="col-sm-2">
         <input type="text" name="emp_title[]" id="emp_title_<?php echo $key; ?>" class="form-control" placeholder="Enter Employee Title" value="<?php echo @$order_resources['emp_title']; ?>" required autocomplete="off"/>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> KPIs <span class="required-star">*</span></label>
    <div class="col-sm-2">
         <input type="text" name="kpis[]" id="kpis_<?php echo $key; ?>" class="form-control" placeholder="Enter KPIs" value="<?php echo @$order_resources['kpis']; ?>" required autocomplete="off"/>
    </div>
</div>
    
   
   	<script>
          $('.Model-Btn').remove();
	</script> 
</div>
<?php $key++;} } ?>

<script>
$(document).ready(function () {
  $("input").prop("readonly", true);
  $("input").css("background-color", "#d8d7d7");
});
</script>
	
