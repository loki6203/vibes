<style>
   .fill-sheet-table .table th,  .fill-sheet-table .table td{
      padding: 6px;
      border: 1px solid black;
      text-align: center;
      font-weight: 600;
      color: black;
   }
   .strng_text {
    font-weight: 700 !important;
    color: black;
}

</style>
<?php if(!empty($chk_report_exist)) { ?>
<div class="container">
    <div class="row align-items-center" style="margin-top: 20px;">
        <div class="col-4"><img src="<?php echo base_url(); ?>assets/admin/images/VIBES_Final.png" width="230px" height="70px"></div>
        <div class="col-4">
            <span class="strng_text">Employee Name : <?php echo @ucfirst($get_employee_client_desig_name['fname']);?> <?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>)<br></span>
            <span class="strng_text"> Designation  : <?php echo @ucfirst($get_employee_client_desig_name['designation_name']);?></span><br>
            
        </div>
        <div class="col-4">
            <span class="strng_text">Client : <?php echo ucfirst($get_employee_client_desig_name['client_name']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="<?php echo base_url(); ?>admin/download_pdf/<?php echo $emp_id; ?>/<?php echo $start_date; ?>/<?php echo $end_date; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Timesheet"><i class='fas fa-file-pdf fa-3x' style="color:#FF0000"></i></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="<?php echo base_url(); ?>admin/download_detailed_timesheet/<?php echo $emp_id; ?>/<?php echo $start_date; ?>/<?php echo $end_date; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Detailed Timesheet"><i class='fas fa-file-pdf fa-5x' style="font-size:58px;color:#FF0000"></i></a></span><br>
            <span class="strng_text">Period : 
            <span class="strng_text"><?php echo DD_M_YY(@$start_date);?></span>
            <span class="strng_text">To  <?php echo DD_M_YY(@$end_date);?></span>
            <span></span>
        </div>
  </div>
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
         <td><?php echo ucfirst($get_employee_client_desig_name['client_name']); ?></td>
         <td style="width:14%"><?php echo $it;?></td>
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
            </td>
         <?php
         }
         ?>
         <td>
            <span><?php echo array_sum($tothours);?></span>
         </td> 
         <?php
         if($i==0){
         ?>
            <td style="vertical-align: baseline;" rowspan="6">
               <span><?php echo array_sum($weeklytot);?></span>
            </td>
         <?php
         }
         ?>
            <td>
               <span> <?php echo @$existdata['comments'];?></span>
            </td>
      </tr>
      <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
      <?php
      }
      ?>
</tbody>
</table>

<?php
}
?>

<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  >
   <tr style="background-color: #b7aae7;">
      <th style="text-align: center;">Item</th>
      <th style="text-align: center;">Sum of Hrs</th>
      <th style="text-align: center;">Total Working Hrs</th>
      <th style="text-align: center;">Total Billing Hrs</th>
      <th style="text-align: center;">Billing Hrs Summary</th>
   </tr>
   <tr>
      <td>Normal Working Hrs</td>
      <td style="text-align: center;font-weight: bold">
            <?php
                if($Normal_Hours_Worked['totl_hours']==''){
                    echo 0;
                }else{
                    echo $Normal_Hours_Worked['totl_hours']; 
                }
            ?>
        </td>
      <td rowspan="6" style="text-align: center;">
         <?php 
            if($Normal_Hours_Worked['totl_hours']=='' && $Sick_Leave['totl_hours']=='' && $Public_Holiday['totl_hours']=='' && $Overtime['totl_hours']=='' && $Annual_Leave['totl_hours']=='' && $Other['totl_hours']){
                    echo 0;
            }else{
                echo $Normal_Hours_Worked['totl_hours']+$Sick_Leave['totl_hours']+$Public_Holiday['totl_hours']+$Overtime['totl_hours']+$Annual_Leave['totl_hours']+$Other['totl_hours'];
            }
         ?>
      </td>
      <td  rowspan="6" style="font-weight: bold"></td>
      <td  rowspan="6" style="font-weight: bold"></td>
   </tr>
   <tr>
      <td>Sick Leave</td>
      <td style="text-align: center;font-weight: bold">
          <?php 
            if($Sick_Leave['totl_hours']==''){
                echo 0;
            }else{
               echo $Sick_Leave['totl_hours']; 
            }
           ?>
    </td>
   </tr>
   <tr>
      <td>Public Holiday </td>
      <td style="text-align: center;font-weight: bold">
          <?php 
            if($Public_Holiday['totl_hours']==''){
                echo 0;
            }else{
                 echo $Public_Holiday['totl_hours'];
            }
          ?>
      </td>
   </tr>
   <tr>
      <td>Overtime</td>
      <td style="text-align: center;font-weight: bold">
          <?php 
            if($Overtime['totl_hours']==''){
                echo 0;
            }else{
                echo $Overtime['totl_hours'];
            }
           ?>
      </td>
   </tr>
   <tr>
      <td>Annual Leaves</td>
      <td style="text-align: center;font-weight: bold">
          <?php 
            if($Annual_Leave['totl_hours']==''){
                echo 0;
            }else{
                echo $Annual_Leave['totl_hours'];
            }
           ?>
        </td>
   </tr>
   <tr>
      <td>Others</td>
      <td style="text-align: center;font-weight: bold">
          <?php 
            if($Other['totl_hours']==''){
                 echo 0;
            }else{
                echo $Other['totl_hours']; 
            }
          ?>
     </td>
</table>
<table id="datatable" class="table dt-responsive nowrap signature" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
   <tr>
      <td style="text-align:justify;">
         <span class="d-flex align-items-center" style="font-weight: 500;">
           <p style="margin-right: 60px;margin-bottom: 0"
           >Employee</p>
           <p
           style="
              margin-bottom: 20px;
              line-height: 22px;
              text-align: center;
              margin-top: 20px;
           ">
            ................................................... <br>
             <i>signature</i>
           </p>
         </span>
      </td>
      <td style="vertical-align: middle;"><b>Employee Name : <?php echo @ucfirst($get_employee_client_desig_name['fname']);?><?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>)</b></td>
   </tr>
   <td style="text-align:justify;">
         <span class="d-flex align-items-center" style="font-weight: 500;">
           <p style="margin-right: 90px;margin-bottom: 0"
           >Client</p>
           <p
           style="
              margin-bottom: 20px;
              line-height: 22px;
              text-align: center;
              margin-top: 20px;
           ">
            ................................................... <br>
             <i>signature</i>
           </p>
         </span>
      </td>
   <td style="vertical-align: middle;"><b>Client Manager: <?php echo @ucfirst($get_employee_client_desig_name['client_manager']);?></b></td>
   </tr>
</table>
</div>
</form>
<?php } else { ?>
   <div class="no-data-image">
      <img class="no-data" src="<?php echo base_url(); ?>assets/no-data/no-data-found.svg" alt="">
   </div>
<?php } ?>
</div>
