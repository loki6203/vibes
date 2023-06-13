<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo @ucfirst($get_employee_client_desig_name['fname']);?><?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>) Timesheet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body{
            margin:0;
            font-family: 'Roboto', sans-serif;
        }
        table,
        th,
        td{
            border-collapse: separate;
            border-spacing:2px;
        }
        .table-main-wrapper{
            width:800px;
            margin-left:auto;
            margin-right:auto;
            padding:10px;
            border-collapse: separate;
        }
        .tablelogo{
            height:34px;
        }
        .font-regular{
            font-size:9px;
            font-weight:400;
        }
        .font-medium{
            font-size:9px;
            font-weight:500;
        }
        .font-bold{
            font-size:10px !important;
            font-weight:500 !important;
            letter-spacing: 0.2px;
        }
        .w-100{
            width:100%;
        }
        .table-bordered{
            border:0.5px solid #212121;
        }
        .table-weekly{
            border-collapse: collapse;
            margin-bottom:10px;
        }
        .table-weekly th{
            border:0.5px solid #212121;
            font-size:10px;
            font-weight:500;
            letter-spacing: 0.2px;
        }
        .table-weekly td{
            border:0.5px solid #212121;
            font-size:9px;
            font-weight:400;
        }
        .no-border{
            border:0 !important;
            background-color: transparent !important;
        }
        .table-signature{
            width:100%;
            border-collapse: collapse;
            border:0.5px solid #212121;
        }
        .table-signature td{
            font-size:9px;
            font-weight:400;
            border-left:1px solid #000;
            padding:6px;
        }
        .w-50{
            width:50%;
        }
        .w-15{
            width:15%;
        }
        .w-35{
            width:35%;
        }
        .table-signature-info td{
            border:0 !important;
            padding:5px;
        }
        .th-bg-pink th{
            background-color: #b7aae7;
        }
        .th-bg-blue th{
            background-color: #b7d2ee;
        }
        @page{
              size: A4;
          }
       @media print {
          #header{display:none;}
          #adwrapper{display:none;}
          body {
              -webkit-print-color-adjust: exact;
       }
       @media print
        {
            @page {
               margin-bottom: 0;
            }
        }  
          
</style>
</head>
    <body>
        <table  class="table-main-wrapper">
            <tbody>
                <tr>
                    <td>
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td align="left">
                                        <img class="tablelogo" src="https://vibhotech.com/img/logo.png"/>
                                    </td>
                                    <td align="right">
                                        <table>
                                            <tr>
                                                <td class="font-regular">Employee Name</td>
                                                <td class="font-medium">: <?php echo @ucfirst($get_employee_client_desig_name['fname']);?> <?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>)</td>
                                            </tr>
                                            <tr>
                                                <td class="font-regular">Designation</td>
                                                <td class="font-medium">: <?php echo @ucfirst($get_employee_client_desig_name['designation_name']);?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        <table>
                                            <tr>
                                                <td class="font-regular">Client</td>
                                                <td class="font-medium">: <?php echo ucfirst($get_employee_client_desig_name['client_name']); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-regular">Period</td>
                                                <td class="font-medium">: <?php echo date("d-M-Y", strtotime(@$start_date));?> to <?php echo date("d-M-Y", strtotime(@$end_date));?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="w-100">
                            <tr>
                                <td>
                                    <input type="hidden" name="from" value="<?php echo @$start_date;?>"/>
                                    <input type="hidden" name="to" value="<?php echo @$end_date;?>"/>
                                    <?php
                                    foreach($dates as $k=>$slot){
                                    $cnt = count($slot);
                                    $slot_dates = $slot[0].'_'.end($slot);
                                    ?>
                                    <table class="w-100 table-weekly">
                                        <thead>
                                            <tr class="th-bg-blue">
                                               <th class="no-border" colspan="2"></th>
                                               <th>Weeks Start</th>
                                               <th colspan="2"><?php echo YY_MONTH_DD($slot['0']); ?></th>
                                               <?php
                                               if($cnt>1){
                                               ?>
                                               <th colspan="2">Week End </th>
                                               <th colspan="2"><?php echo YY_MONTH_DD(end($slot)); ?></th>
                                               <?php
                                               }
                                               ?>
                                            </tr>
                                            <tr class="th-bg-pink">
                                               <th rowspan="3">Client</th>
                                               <th rowspan="3">Items</th>
                                               <th rowspan="3">Type Of Work Performed</th>
                                               <th colspan="<?php echo $cnt;?>">Hours</th>
                                               <th>Total</th>
                                               <th rowspan="3">Weekly<br>Total</th>
                                               <th rowspan="3" colspan="<?php echo $cnt;?>">Remarks</th>
                                            </tr>
                                            <tr class="th-bg-pink">
                                               <?php
                                                  foreach($slot as $k=>$weekname){
                                               ?>
                                               <th><?php echo DAYNAME($weekname); ?></th>
                                               <?php
                                                  }
                                               ?>
                                               <th rowspan="2">Hours</th>
                                            </tr>
                                            <tr class="th-bg-pink">
                                               <?php
                                                  foreach($slot as $k=>$weekname){
                                               ?>
                                               <th><?php echo DD_MM($weekname); ?></th>
                                               <?php
                                                  }
                                               ?>
                                            </tr>
                                    </thead>
                                    <input type="hidden" name="slots[]" size="8" value="<?php echo $slot_dates;?>">
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
                                                <td align="center">
                                                   <span><?php echo @$worked_hours;?></span>
                                                </td>
                                             <?php
                                             }
                                             ?>
                                             <td align="center">
                                                <span><?php echo array_sum($tothours);?></span>
                                             </td> 
                                             <?php
                                             if($i==0){
                                             ?>
                                                <td align="center" rowspan="6">
                                                   <span><?php echo array_sum($weeklytot);?></span>
                                                </td>
                                             <?php
                                             }
                                             ?>
                                                <td>
                                                   <span> <?php echo @$existdata['comments'];?></span>
                                                </td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                        </tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="w-100 table-weekly">
                            <thead>
                               <tr>
                                  <th style="text-align: center;">Item</th>
                                  <th style="text-align: center;">Sum of Hrs</th>
                                  <th style="text-align: center;">Total Working Hrs</th>
                                  <th style="text-align: center;">Total Billing Hrs</th>
                                  <th style="text-align: center;">Billing Hrs Summary</th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr>
                                  <td>Normal Working Hrs</td>
                                  <td align="center">
                                        <?php
                                            if($Normal_Hours_Worked['totl_hours']==''){
                                                echo 0;
                                            }else{
                                                echo $Normal_Hours_Worked['totl_hours']; 
                                            }
                                        ?>
                                    </td>
                                  <td align="center" rowspan="6">
                                     <?php 
                                       if($Normal_Hours_Worked['totl_hours']=='' && $Sick_Leave['totl_hours']=='' && $Public_Holiday['totl_hours']=='' && $Overtime['totl_hours']=='' && $Annual_Leave['totl_hours']=='' && $Other['totl_hours']){
                                                echo 0;
                                        }else{
                                            echo $Normal_Hours_Worked['totl_hours']+$Sick_Leave['totl_hours']+$Public_Holiday['totl_hours']+$Overtime['totl_hours']+$Annual_Leave['totl_hours']+$Other['totl_hours'];
                                        }
                                     ?>
                                  </td>
                                  <td  rowspan="6"></td>
                                  <td  rowspan="6"></td>
                               </tr>
                               <tr>
                                  <td>Sick Leave</td>
                                  <td align="center">
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
                                  <td align="center">
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
                                  <td align="center">
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
                                  <td align="center">
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
                                  <td align="center">
                                      <?php 
                                        if($Other['totl_hours']==''){
                                             echo 0;
                                        }else{
                                            echo $Other['totl_hours']; 
                                        }
                                      ?>
                                 </td>
                               </tr>
                           </tbody>
                       </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="w-100">
                            <tr>
                                <td>
                                    <table class="table-signature">
                                       <tr>
                                          <td class="w-15">Employee</td>
                                          <td class="w-50">
                                              <div class="signature-placeholder">
                                                 <i>Signature :</i> 
                                              </div>
                                          </td>
                                          <td class="w-35">
                                              <table class="table-signature-info">
                                                  <tr>
                                                      <td>Employee Name</td>
                                                      <td class="font-bold">: <?php echo @ucfirst($get_employee_client_desig_name['fname']);?><?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>)</td>
                                                  </tr>
                                              </table>
                                          </td>
                                       </tr>
                                   </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table-signature">
                                       <tr>
                                          <td class="w-15">Client</td>
                                          <td class="w-50">
                                              <div class="signature-placeholder">
                                                 <i>Signature :</i>  
                                              </div>
                                          </td>
                                          <td class="w-35">
                                              <table class="table-signature-info">
                                                  <tr>
                                                      <td>Client Manager</td>
                                                      <td class="font-bold">: <?php echo @ucfirst($get_employee_client_desig_name['client_manager']);?></td>
                                                  </tr>
                                              </table>
                                          </td>
                                       </tr>
                                   </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table-signature">
                                       <tr>
                                                      <?php
                                                            $HR_id = $get_employee_client_desig_name['hr_manager_id'];
                                                            $GetHRManager=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$HR_id")->row_array();
                                                        ?>
                                                      <td>HR Manager</td>
                                                      <td class="font-bold">: <?php echo @ucfirst($GetHRManager['fname']);?> <?php echo @ucfirst($GetHRManager['lname']);?></td>
                                                  </tr>
                                              </table>
                                          </td>
                                       </tr>
                                   </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
<script>
    window.print();
</script>
</body>
</html>