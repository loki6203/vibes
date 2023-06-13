<?php $CountKeys = count($work_order_resources);
$key=1;
if(!empty($work_order_resources)){foreach ($work_order_resources as $order_resources) { ?>
<div class="form-group row Add-Remove-Cls-<?php echo $key; ?>">
    <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee<span class="required-star">*</span></label>
    <div class="col-sm-2">
         <input type="text" name="emp_id[]" id="emp_id_<?php echo $key; ?>" class="form-control" placeholder="Enter Backlog Amt" value="<?php echo @$order_resources['emp_id']; ?>" required autocomplete="off"/>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> Employee Per Hr <span class="required-star">*</span></label>
    <div class="col-sm-2">
         <input type="text" name="emp_per_hrs[]" id="emp_per_hrs_<?php echo $key; ?>" class="form-control" placeholder="Enter Employee Per Hr" value="<?php echo @$order_resources['emp_per_hrs']; ?>" required autocomplete="off"/>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> Start Date <span class="required-star">*</span></label>
    <div class="col-sm-2">
         <div class="custom_date_field">
          <input type="text" name="emp_start_dt[]" id="emp_start_dt_<?php echo $key; ?>" class="form-control" placeholder="Select End Date" autocomplete="off" required  value="<?php echo @$order_resources['emp_start_dt']; ?>"/>
          <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
        </div>
    </div>
    <label for="example-time-input" class="col-sm-2 col-form-label"> End Date <span class="required-star">*</span></label>
    <div class="col-sm-2">
        <div class="custom_date_field">
          <input type="text" name="emp_end_dt[]" id="emp_end_dt_<?php echo $key; ?>" class="form-control" placeholder="Select End Date" autocomplete="off" required value="<?php echo @$order_resources['emp_end_dt']; ?>" />
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
    <?php if($key<$CountKeys){ ?>
    	<button type="button" class="btn btn-danger" onclick="Remove(<?php echo $key; ?>);">Remove</button>
	<?php }else if($key==$CountKeys){ ?>
		<button type="button" class="btn btn-primary" onclick="EditAdd(<?php echo $CountKeys; ?>);">Add</button>
    	<button type="button" class="btn btn-danger" onclick="Remove(<?php echo $key; ?>);">Remove</button>
    <?php } ?>
</div>
 <?php $key++;} } ?>

<script>
$('.Model-Btn').text(<?php echo $btn; ?>);
$(function() {
	var sno='<?php echo $key; ?>';
	var dateFormat = "dd-mm-yy",
	  from = $( "#emp_start_dt_"+sno)
	    .datepicker({
	      changeMonth: true,
	      changeYear: true,
	      dateFormat: 'dd-mm-yy',
	    })
	    .on( "change", function() {
	      to.datepicker( "option", "minDate", getDate( this ) );
	      $("#emp_end_dt_"+sno).val('');
	    }),
	  to = $( "#emp_end_dt_"+sno).datepicker({
	  	  changeMonth: true,
	      changeYear: true,
	      dateFormat: 'dd-mm-yy',
	  });
	 
	function getDate( element ) {
	  var date;
	  try {
	    date = $.datepicker.parseDate( dateFormat, element.value );
	  } catch( error ) {
	    date = null;
	  }

	  return date;
	}
 });

function Remove(id)
{
    var countArr=$('input[name="emp_per_hrs[]"]').length;
    if(countArr==1){
      alert('You can"t remove. Atleast one field required');
    }else{
     $('.Add-Remove-Cls-'+id).remove();
   }
	
}
function EditAdd(id)
{
  var work_orders_id=$("input[name='model_work_orders_id']").val();
  if(work_orders_id==''){
      alert('Opps! something went to wrong...!');
      return false;
   }else{
    	$.ajax({
            url: '<?php echo site_url('admin/ajax_work_resources'); ?>',
            type: 'POST',
            data: {work_orders_id: work_orders_id,id: id},
            success: function(data) {
                $('.ajax-div-cls').append(data);
            }
       });
  }
}

</script>