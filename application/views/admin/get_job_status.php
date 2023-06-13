<div class="move-cls">
<?php if($statusVal!='source/applied'){ ?>
<a class="dropdown-item" href="javascript:void(0);" onclick="Move('source/applied',<?php echo $candidate_applied_id; ?>);">source/applied</a>
<?php } ?>
<?php if($statusVal!='contacted'){ ?>
<a class="dropdown-item" href="javascript:void(0);" onclick="Move('contacted',<?php echo $candidate_applied_id; ?>);">contacted</a>
<?php } ?>
<?php if($statusVal!='internal_interview'){ ?>
<a class="dropdown-item" href="javascript:void(0);" onclick="Move('internal_interview',<?php echo $candidate_applied_id; ?>);">internal interview</a>
<?php } ?>
<?php if($statusVal!='presented'){ ?>
<a class="dropdown-item" href="javascript:void(0);" onclick="Move('presented',<?php echo $candidate_applied_id; ?>);">presented</a>
<?php } ?>
<?php if($statusVal!='shortlisted'){ ?>
<a class="dropdown-item" href="javascript:void(0);" onclick="Move('shortlisted',<?php echo $candidate_applied_id; ?>);">shortlisted</a>
<?php } ?>
<?php if($statusVal!='client_interview'){ ?>
<a class="dropdown-item" href="javascript:void(0);" onclick="Move('client_interview',<?php echo $candidate_applied_id; ?>);">client interview</a>
<?php } ?>
</div>

<script>
function Move(type,candidate_applied_id)
{
    $.ajax({
	    url: '<?php echo site_url('admin/change_candidate_status'); ?>',
	    type: 'POST',
	    data: {type: type,candidate_applied_id: candidate_applied_id},
	    success: function(res)
	    {
	    	$('.move-cls').remove();
            $('.status-candidate').html(res);
            if(type=='source/applied'){
				var value='source/applied';
			}else if(type=='contacted'){
				var value='contacted';
			}else if(type=='internal_interview'){
				var value='internal interview';
			}else if(type=='client_interview'){
				var value='client interview';
			}else {
				var value=type;
			}
			$('.cadidate-status-applied').text(value);
	        Swal.fire(
	          'Success!',
	          'candidate moved successfully.',
	          'success'
	        )
	    }
	});
}
</script>