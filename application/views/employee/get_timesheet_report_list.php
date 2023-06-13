<style>
   .fill-sheet-table .table th,  .fill-sheet-table .table td{
      padding: 6px;
      border: 1px solid black;
      text-align: center;
      font-weight: 600;
      color: black;
   }
</style>
<?php if(!empty($chk_report_exist)){ ?>
<div class="row container align-items-center">
  <div class="col-4"><img src="<?php echo base_url(); ?>assets/admin/images/VIBES_Final.png" width="200px" height="60px"></div>
  <div class="col-3"><span style="font-weight: 600;color: black;"><b>Start Date : <?php echo date("Y-M-d", strtotime(@$start_date));?></b></span></div>
  <div class="col-3"><span style="font-weight: 600;color: black;"><b>End Date : <?php echo date("Y-M-d", strtotime(@$end_date));?></b></span></div>
  <div class="col-2"><a href="<?php echo base_url(); ?>employee/download_pdf/<?php echo $start_date;?>/<?php echo $end_date; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Timesheet"><i class='fas fa-file-pdf fa-3x' style="color:#FF0000"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>employee/download_detailed_timesheet/<?php echo $start_date;?>/<?php echo $end_date; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Detailed Timesheet"><i class='fas fa-file-pdf fa-5x' style="font-size:54px;color:#FF0000"></i></a><br/></div>
</div>
<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>

<form method="post" name="myForm" id="myForm" action="#">
<input type="hidden" name="from" value="<?php echo @$start_date;?>"/>
<input type="hidden" name="to" value="<?php echo @$end_date;?>"/>
<?php
foreach($dates as $k=>$slot){
$cnt = count($slot);
$slot_dates = $slot[0].'_'.end($slot);
?>
<input type="hidden" name="slots[]" size="8" value="<?php echo $slot_dates;?>">
<div class="fill-sheet-table">
<table id="datatable" class="table table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
<thead>
<tr>
   <th style="border: none !important;"> </th>
   <th style="border: none !important;"> </th>
   
   
   <th style="background-color: #b7d2ee;">Week Start </th>
   <th colspan="2" style="background-color: #b7d2ee;"><?php echo YY_MONTH_DD($slot['0']); ?></th>
   <?php
   if($cnt>1){
   ?>
   <th colspan="2" style="background-color: #b7d2ee;">Week End </th>
   <th colspan="2" style="background-color: #b7d2ee;"><?php echo YY_MONTH_DD(end($slot)); ?></th>
   <?php
   }
   ?>
   <th style="border: none !important;"> </th>
   <th style="border: none !important;"> </th>
   <th style="border: none !important;"> </th>
</tr>
<tr style="background-color: #b7aae7;">
   <th rowspan="3" style="vertical-align: text-bottom;;width: 109px !important;">Client</th>
   <th rowspan="3" style="vertical-align: text-bottom;;width: 109px !important;">Items</th>
   <th rowspan="3" style="vertical-align: text-bottom;;width: 109px !important;">Type Of Work Performed</th>
   <th style="text-align: center;" colspan="<?php echo $cnt;?>">Hours</th>
   <th>Total</th>
   <th rowspan="3">Weekly Total</th>
   <th rowspan="3" style="text-align: center;" colspan="<?php echo $cnt;?>">Remarks</th>
</tr>
<tr>
   <?php
      // $slot = array_reverse($slot);
      foreach($slot as $k=>$weekname){
   ?>
   <th style="width: 109px !important;background-color: #b7aae7;"><?php echo DAYNAME($weekname); ?></th>
   <?php
      }
   ?>
   <th rowspan="2" style="background-color: #b7aae7;">Hours</th>
</tr>
<tr>
   <?php
      foreach($slot as $k=>$weekname){
   ?>
   <th style="width: 109px !important;background-color: #b7aae7;"><?php echo DD_MM($weekname); ?></th>
   <?php
      }
   ?>
</tr>
</thead>
<tbody>
      <?php
      $items = array(
         'Normal Hours Worked',
         'Sick Leave',
         'Public Holiday',
         'Overtime',
         'Annual Leave',
         'Other'
      );
      $client_id = 0;
      $weeklytot=array();
      foreach($items as $tothours){
         foreach($slot as $sltdates){
            $toth       = @$this->db->query("SELECT `worked_hours` FROM `timesheet_management` WHERE `item`='$tothours' AND worked_date='$sltdates' AND emp_id=$emp_id ORDER BY timesheet_management_id DESC")->row()->worked_hours;
            if(in_array($sltdates, $arr) && $tothours=='Public Holiday'){
              $toth=8; 
            }
            if($toth!=''){
               $weeklytot[]=$toth;
            }
         }
      }
      foreach($items as $i=>$it){
         $worked_date = $slot[0];
         $existdata = $this->db->query("SELECT `type_of_work_performed`,`comments` FROM `timesheet_management` WHERE `item`='$it' AND worked_date='$worked_date' AND emp_id=$emp_id ORDER BY timesheet_management_id  DESC")->row_array();
      ?>
      <tr>
         <td><?php echo ucfirst($get_employee_client_name['client_name']); ?></td>
         <td style="width:17%"><?php echo $it;?></td>
         <input type="hidden" name="name_<?php echo $slot_dates;?>[]" size="8" value="<?php echo $it;?>">
         <td>
            <span class="type_of_work_performed_<?php echo $slot_dates;?>[]"><?php echo @$existdata['type_of_work_performed'];?></span>
         </td>
         <?php
         $tothours=array();
         foreach($slot as $j=>$dt){
            $worked_hours = @$this->db->query("SELECT `worked_hours` FROM `timesheet_management` WHERE `item`='$it' AND worked_date='$dt' AND emp_id=$emp_id ORDER BY timesheet_management_id  DESC")->row()->worked_hours;
            if(in_array($dt, $arr) && $it=='Public Holiday'){
              $worked_hours=8; 
            }
            if($worked_hours!=''){
               $tothours[]=$worked_hours;
            }
         ?>
            <td>
               <span><?php echo @$worked_hours;?></span>
               <!-- <input value="<?php echo @$worked_hours;?>" class="<?php echo $i;?><?php echo $slot_dates;?>" type="text" rel="<?php echo $i;?><?php echo $slot_dates;?>" slot='<?php echo $slot_dates;?>' name="weeks_<?php echo $it;?><?php echo $slot_dates;?>[][<?php echo $dt;?>]" onkeyup="Get_Hours(this);" size="8" class="numeric"> -->
            </td>
         <?php
         }
         ?>
         <td>
            <span><?php echo array_sum($tothours);?></span>
            <!-- <input value="<?php echo array_sum($tothours);?>" type="text" rel="tot_<?php echo $slot_dates;?>" readonly id="<?php echo $i;?><?php echo $slot_dates;?>" name="hours_<?php echo $slot_dates;?>[]" size="8" onkeyup="Get_Tot('<?php echo $slot_dates;?>');"> --></td> 
         <?php
         if($i==0){
         ?>
            <td style="vertical-align: middle;" rowspan="6">
            <span><?php echo array_sum($weeklytot);?></span>
            <!-- <input type="text" value="<?php echo array_sum($weeklytot);?>" id="tot_<?php echo $slot_dates;?>" name="total_<?php echo $slot_dates;?>[]" readonly style="width: 80px"> -->
         </td>
         <?php
         }
         ?>
            <td>
               <span> <?php echo @$existdata['comments'];?></span>
               <!-- <textarea cols="18" rows="2" name="remarks_<?php echo $slot_dates;?>[]" placeholder="Remarks">
                  <?php echo @$existdata['comments'];?>
               </textarea> -->
            </td>
      </tr>
      <?php
      }
      ?>
</tbody>
</table>
</div>
<?php
}
?>

</form>
<?php } else { ?>
   <span style="color: red;text-align: center;margin-left: 400px;font-size: 18px;">no data found</span>
<?php } ?>
<script>
$(document).on("input", ".numeric", function() {
this.value = this.value.replace(/[^\d.]/g, '');
});
function Get_Hours(val){
name   = $(val).attr('name');
id     = $(val).attr('rel');
slot   = $(val).attr('slot');
var sum = 0;
$('.'+id).each(function(){
   if(this.value && parseFloat(this.value)>0){
      sum += parseFloat(this.value);
   }
});
if(parseFloat(sum)){
   document.getElementById(id).value = parseFloat(sum);
}
Get_Tot(slot);
}
function Get_Tot(dt){
var arr = document.getElementsByName('hours_'+dt+'[]');
var tot=0;
for(var i=0;i<arr.length;i++){
if(parseFloat(arr[i].value))
   if(arr[i].value && parseFloat(arr[i].value)>0){
      tot += parseFloat(arr[i].value);
   }
}
document.getElementById('tot_'+dt).value = parseFloat(tot);
}
</script>