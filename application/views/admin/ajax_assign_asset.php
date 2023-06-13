<script src="<?php echo base_url(); ?>assets/admin/js/pages/form-advanced.init.js"></script>
<div class="form-group">
   <label for="recipient-name" class="col-form-label">Asset Tag:</label>
   <input type="text" class="form-control" value="<?php echo @$asset['asset_tag'];?>" style="background-color: #d8d7d7" readonly>
</div>
<div class="form-group">
   <label for="brand-text" class="col-form-label">Brand:</label>
   <input type="text" class="form-control" value="<?php echo @$brand['name'];?>" style="background-color: #d8d7d7" readonly>
</div>
<?php if($type==1){ ?>
<div class="form-group">
   <label for="emp_id-name" class="col-form-label">Select Employee:</label><br>
   <select class="form-control" name="emp_id" id="emp_id">
      <option value="">--Select Employee--</option>
      <?php if(!empty($employees)){foreach ($employees as $employee) {
         ?>
      <option value="<?php echo @$employee['emp_id']; ?>" <?php echo (@$employee['emp_id']==@$asset['emp_id'])?'selected':'';?>><?php echo @$employee['fname'];?> <?php echo @$employee['lname'];?> (<?php echo @$employee['emp_code'];?>)</option>
      <?php } } ?>
   </select>
</div>
<div class="form-group">
   <label for="assign_dt-text" class="col-form-label">Assign Date:</label>
   <div class="custom_date_field">
      <input type="text" name="assign_dt" id="assign_dt" class="form-control"  placeholder="Assign Date" autocomplete="off" />
      <img src="<?php echo base_url(); ?>assets/admin/images/calendar.svg"/>
   </div>
</div>
<div class="form-group">
   <label for="cmnts-text" class="col-form-label">Comments:</label>
   <textarea class="form-control" name="cmnts" id="cmnts" placeholder="Comments"></textarea>
</div>
<?php } else { ?>
<div class="form-group">
   <label for="status-name" class="col-form-label">Status:</label>
   <select class="form-control" name="stus" id="stus" onchange="Status();">
      <option value="">--Select Status--</option>
      <option value="Deassigned">Deassigned</option>
      <option value="Deassigned&Available">Deassigned & Available</option>
      <option value="Deassigned&Maintance">Deassigned & Maintance</option>
      <option value="Not Working">Not Working</option>
   </select>
</div>
<div class="form-group maintaince-cmnts-div">
   <label for="cmnts-text" class="col-form-label">Remarks:</label>
   <textarea class="form-control" name="maintaincecmnts" id="maintaincecmnts" placeholder="Remarks"></textarea>
</div>
<div class="form-group">
   <label for="assign_dt-text" class="col-form-label">Deassign Date:</label>
   <div class="custom_date_field">
      <input type="text" name="assign_dt" id="assign_dt" class="form-control"  placeholder="Deassign Date" autocomplete="off" />
      <img src="<?php echo base_url(); ?>assets/admin/images/calendar.svg"/>
   </div>
</div>
<div class="form-group">
   <label for="cmnts-text" class="col-form-label">Comments:</label>
   <textarea class="form-control" name="cmnts" id="cmnts" placeholder="Comments"></textarea>
</div>
<?php } ?>

<script>
$(document).ready(function(){
	$('.maintaince-cmnts-div').hide();
});
$(function(){
	$("#assign_dt").datepicker({dateFormat: 'dd-mm-yy',});
});
function myForm()
{
	var type='<?php echo @$type; ?>';
	var asset_id='<?php echo @$asset_id; ?>';
	var asset_tag='<?php echo @$asset_tag; ?>';
	var brand_id='<?php echo @$brand_id; ?>';
	var emp_id=$('#emp_id').val();
	var stus=$('#stus').val();
	var assign_dt=$('#assign_dt').val();
	var cmnts=$('#cmnts').val();
	var maintaincecmnts=$('#maintaincecmnts').val();
	alert(maintaincecmnts);
	if(emp_id=='' && assign_dt==''){
		alert("Employee and Assign Date fields are required.");
	}else if(emp_id==''){
		alert('Please select Employee');
	}else if(assign_dt==''){
		if(type==1){
			alert('Please select assign date.');
		}else{
		   alert('Please select deassign date.');
		}
	}else if(type=='Deassign'){
		if(stus==''){
			alert('Please select status.');
			return false;
		}
	}
	if(asset_id!='' && asset_tag!='' && brand_id!='' && emp_id!='' && assign_dt!=''){
		$.ajax({
	        url: '<?php echo site_url('admin/ajax_save_asset_assign'); ?>',
	        type: 'POST',
	        data: {asset_id: asset_id,type: type,emp_id: emp_id,assign_dt: assign_dt,cmnts: cmnts,stus: stus,maintaincecmnts: maintaincecmnts},
	        success: function(res) {
	            if(res==0){
	            	alert('Opps something went to wrong...');
	            }else if(res==2){
	            	Swal.fire(
                      'Success!',
                      'Asset Deassigned successfully...',
                      'success'
                    )
	            	location.reload();
	            }else{
	            	Swal.fire(
                      'Success!',
                      'Asset assigned successfully...',
                      'success'
                    )
	            	setTimeout(function(){
   						window.location.reload(1);
					}, 1000);
	            }
	        }
    	});
	}else{
		
	}
}
function Status()
{
 	var sta=$('#stus').val(); 
 	$('#maintaincecmnts').val('');
 	if(sta=='Deassigned&Maintance')
 	{
 		$('.maintaince-cmnts-div').show();
 	}else{
 		$('.maintaince-cmnts-div').hide();
 	}
}
</script>