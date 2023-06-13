<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo @ucfirst($get_employee_client_desig_name['fname']);?><?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>) Detailed Timesheet</title>
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
                                    <table class="w-100 table-weekly">
                                      <?php 
                                          if(!empty($GetDeatailedTimesheet))
                                          {
                                          foreach($GetDeatailedTimesheet as $Timesheet)
                                          { 
                                            $Date=$Timesheet['worked_date'];
                                            $EID=$Timesheet['emp_id'];
                                            $GetDetailedDateTimesheet=$this->db->query("SELECT `timesheet_management_details_id`, `timesheet_management_id`, `emp_id`, `item`, `worked_date`, `project_name`, `Hrs`, `comments`, `is_active`, `created_at`, `updated_at`, `is_editble`, `uniqno` FROM `timesheet_management_details` WHERE `worked_date`='$Date' AND `emp_id`=$EID")->result_array();
                                      ?>
                                        <thead>
                                            <tr class="th-bg-pink">
                                               <th rowspan="3">Client</th>
                                               <th rowspan="3">Date</th>
                                               <th rowspan="3">Project Name</th>
                                               <th rowspan="3">Hrs</th>
                                               <th rowspan="3">Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                              if(!empty($GetDetailedDateTimesheet))
                                              {
                                                foreach($GetDetailedDateTimesheet as $DetailedTimesheet){
                                          ?>
                                          <tr>
                                             <td align="center"><?php echo ucfirst($get_employee_client_desig_name['client_name']); ?></td>
                                             <td align="center" style="width:14%"><?php echo DD_M_YY($DetailedTimesheet['worked_date']); ?></td>
                                             <td align="center"><?php echo $DetailedTimesheet['project_name']; ?></td>
                                             <td align="center"><?php echo  $DetailedTimesheet['Hrs']; ?></td>
                                             <td align="center"><?php echo $DetailedTimesheet['comments']; ?></td>
                                          </tr>
                                          <?php } }else{ ?>
                                            <tr>
                                               <td style="text-align: center;" colspan="5">
                                                 no data found
                                               </td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                        <?php } } ?>


                                        

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
                                                      <td class="font-bold">: <?php echo @ucfirst($get_employee_client_desig_name['fname']);?> <?php echo @ucfirst($get_employee_client_desig_name['lname']);?> (<?php echo @$get_employee_client_desig_name['emp_code'];?>)</td>
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
                                          <td class="w-15">HR Manager</td>
                                          <td class="w-50">
                                              <div class="signature-placeholder">
                                                 <i>Signature :</i>  
                                              </div>
                                          </td>
                                          <td class="w-35">
                                              <table class="table-signature-info">
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