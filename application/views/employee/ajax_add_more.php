<?php if(!empty($GetTimesheetDetails)){$SNo=1;foreach($GetTimesheetDetails as $key => $Val) { ?>
<script>
    <?php
        if($Val['is_editble']=='No'){ ?>
            $('.Model-Btn').css("display", "none");
        <?php } else { ?>
            $('.Model-Btn').css("display", "block");
    <?php } ?>
</script>
<div class="w-100 add_more_sno_<?php echo $SNo; ?>">
      <input type="hidden" name="Dt" id="Dt" value="<?php echo $dt; ?>">
      <input type="hidden" name="type_of_work_performed_dt" id="type_of_work_performed_dt" value="<?php echo $type_of_work_performed_dt; ?>">
      <input type="hidden" name="item-name" id="item-name" value="<?php echo $item; ?>">
      <input type="hidden" name="remaks" id="remaks" value="<?php echo $get_remarks; ?>">
      <input type="hidden" name="weekstart_enddate" id="weekstart_enddate" value="<?php echo $weekstart_enddate; ?>">
      <input type="hidden" name="ID" id="ID" value="<?php echo $Val['timesheet_management_id']; ?>">
      <div class="time-sheet-modal-card">
         <ul>
            <li>
               <div class="form-group">
                  <label for="example-time-input">Project Name <span class="required-star">*</span></label>
                  <input type="text" name="project_name[]" id="project_name_<?php echo $sn; ?>" class="form-control" placeholder="Project Name" value="<?php echo $Val['project_name']; ?>" <?php if($Val['is_editble']=='No'){echo "disabled style='background-color:#d8d7d7;'"; } ?>/>
               </div>
            </li>
            <li>
               <div class="form-group">
                  <label for="example-time-input">Hrs <span class="required-star">*</span></label>
                  <input type="text" name="Hrs[]" id="Hrs_<?php echo $sn; ?>" class="form-control numeric" placeholder="Hrs" value="<?php echo $Val['Hrs']; ?>" <?php if($Val['is_editble']=='No'){echo "disabled style='background-color:#d8d7d7;'"; } ?>/>
               </div>
            </li>
            <li class="time-sheet-modal-card-comments">
            <div class="form-group">
               <label for="example-time-input"> Comments</label>
               <textarea class="form-control" name="Cmnts[]" id="Cmnts_<?php echo $sn; ?>" placeholder="Comments" rows="1" cols="1" <?php if($Val['is_editble']=='No'){echo "disabled style='background-color:#d8d7d7;'"; } ?>><?php echo $Val['comments']; ?></textarea>
               </div>
            </li>
         </ul>
      </div>
</div>
<div class="d-flex justify-content-end mt-2 mb-3 flex-wrap">
<?php if($Val['is_editble']=='No') { ?>
<?php } else if(count($GetTimesheetDetails)>$SNo){ ?>
   <a class="btn btn-danger waves-effect waves-light" href="javascript:void(0);" id="removemore_<?php echo $SNo;?>" onclick="Deleterow(<?php echo $SNo; ?>);"><i class="mdi mdi-minus mr-1"></i> Remove</a>
<?php }else if(count($GetTimesheetDetails)<=$SNo){ ?>
   <a class="btn btn-primary waves-effect waves-light mr-2" href="javascript:void(0);" id="more_<?php echo $SNo;?>" onclick="AddMore(<?php echo $SNo; ?>);"><i class="mdi mdi-plus mr-1"></i> Add</a>
   <a class="btn btn-danger waves-effect waves-light" href="javascript:void(0);" id="removemore_<?php echo $SNo;?>" onclick="Deleterow(<?php echo $SNo; ?>);"><i class="mdi mdi-minus mr-1"></i> Remove</a>
<?php } ?>
<?php  $SNo++;} }else if(empty($GetTimesheetDetails) && $is_editble=='No') { ?>

      <span class="d-flex justify-content-center mt-2 mb-3" style="color:red;">no data found...</span>
    <script>
        $('.Model-Btn').css("display", "none");
    </script>

<?php }else { ?>
<script>
    $('.Model-Btn').css("display", "block");
</script>
<div class="w-100 add_more_sno_<?php echo $sn; ?>">
      <input type="hidden" name="Dt" id="Dt" value="<?php echo $dt; ?>">
      <input type="hidden" name="type_of_work_performed_dt" id="type_of_work_performed_dt" value="<?php echo $type_of_work_performed_dt; ?>">
      <input type="hidden" name="item-name" id="item-name" value="<?php echo $item; ?>">
      <input type="hidden" name="remaks" id="remaks" value="<?php echo $get_remarks; ?>">
      <input type="hidden" name="weekstart_enddate" id="weekstart_enddate" value="<?php echo $weekstart_enddate; ?>">
      <div class="time-sheet-modal-card">
         <ul>
            <li>
               <div class="form-group">
                  <label for="example-time-input">Project Name <span class="required-star">*</span></label>
                  <input type="text" name="project_name[]" id="project_name_<?php echo $sn; ?>" class="form-control" placeholder="Project Name"/>
               </div>
            </li>
            <li>
               <div class="form-group">
                  <label for="example-time-input">Hrs <span class="required-star">*</span></label>
                  <input type="text" name="Hrs[]" id="Hrs_<?php echo $sn; ?>" class="form-control numeric" placeholder="Hrs"/>
               </div>
            </li>
            <li class="time-sheet-modal-card-comments">
            <div class="form-group">
               <label for="example-time-input"> Comments</label>
               <textarea class="form-control" name="Cmnts[]" id="Cmnts_<?php echo $sn; ?>" placeholder="Comments" rows="1" cols="1"></textarea>
               </div>
            </li>
         </ul>
      </div>
</div>
<div class="d-flex justify-content-end mt-2 mb-3">
<?php if($sn==1){ ?>
   <a class="btn btn-primary waves-effect waves-light" id="more_<?php echo $sn;?>" href="javascript:void(0);" onclick="AddMore(<?php echo $sn; ?>);"><i class="mdi mdi-plus mr-1"></i>Add</a>
<?php }else if($sn>1){ ?>
   <a class="btn btn-primary waves-effect waves-light mr-2" href="javascript:void(0);" id="more_<?php echo $sn;?>" onclick="AddMore(<?php echo $sn; ?>);"><i class="mdi mdi-plus mr-1"></i> Add</a>
   <a class="btn btn-danger waves-effect waves-light" href="javascript:void(0);" id="removemore_<?php echo $sn;?>" onclick="Deleterow(<?php echo $sn; ?>);"><i class="mdi mdi-minus mr-1"></i> Remove</a>
<?php } } ?>