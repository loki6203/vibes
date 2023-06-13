<?php
$emp_id=$this->session->userdata('emp_id');
if($this->session->userdata('emp_id')!='')
{
   $username = $this->session->userdata('emp_id');

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Vibho Technologies</title>
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
<link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
<link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
<link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div id="main-wrapper">
<div class="nav-header">
<div class="brand-logo">
<a href="home.php">
<b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
<span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
<span class="brand-title">
<img src="images/logo.png" alt="">
</span>
</a>
</div>
</div>
<div class="header">    
<div class="header-content clearfix">
<div class="nav-control">
<div class="hamburger">
<span class="toggle-icon"><i class="icon-menu"></i></span>
</div>
</div>
<div class="header-left">
<div class="input-group icons">
<div class="input-group-prepend">
<span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><h2>Timesheet Management</h2>
</div>
</div>
</div>
<div class="header-right">
<div class="input-group icons">
<ul class="right hide-on-med-and-down">                   
<li class="sub-menu">
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="content-body">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<div class="row" style="padding-bottom: 2%;">
<div class="col-md-12">
    <script type="text/javascript">
function validateForm(form)
{

if(form.start.value=="") { alert("Please Select Start Date  "); form.start.focus(); return false; }
if(form.end.value=="") { alert("Please Select End Date "); form.end.focus(); return false; }
}
</script>
<form method="POST" onsubmit="return validateForm(myForm);"  name="myForm">
<table  class="tableweek" style="border:none;width:100%;">
<tr>

<td><lable style="
    margin-left: 20px;
">
 Start Date : </lable></td>
<td><input type="text" class="datepicker" placeholder="Start Date"  name="start"></td>
<Td><lable > End Date :</lable></Td>
<td><input  type="text" class="datepicker" placeholder="End Date"  name="end" ></td>
<td><input type="submit"  name="submit" value="View"></lable></td>


</tr>

</table>
</div>
</div>
<br>
<br>
<br>
<div id="tblCustomers" >
  
 <?php
 
if(isset($_POST['submit']))
{
  
     $start = $_POST['start'];
$end = $_POST['end'];
     
   // echo "<pre>";print_r($conn);exit;  

$rig =$this->db->query("SELECT * FROM `employees` WHERE `emp_id`=$emp_id")->row_array();

$des =  $rig['designation_id'];

$designation  = $this->db->query("SELECT * FROM `designation` WHERE `designation_id`=$des")->row_array();

  


?>

<div id="tblCustomers">
<span class="brand-title">
<img src="images/logo.png" alt="" style="float: left;margin-top: -17px;">
</span>

<p style="
margin-right: -67px;
margin-top: -4px;
">
   
<!--<b style="margin-right: 37px;">Employee Name&nbsp:&nbsp&nbsp <?php echo $rig['fname'] ?> <?php echo $rig['lname'] ?></b>-->
<!--<b style="margin-right: 37px;">Employee Designation&nbsp:&nbsp&nbsp <?php echo $designation['name'] ?></b> -->
<b style="margin-right: 37px;" >Start Date&nbsp:&nbsp&nbsp<?php 

$date=date_create($start);

$startval = date_format($date,"m/d/Y");
$startva = date_format($date,"Y-m-d");


echo date_format($date,"F") .'&nbsp'. date_format($date,"jS"). '&nbsp'. date_format($date,"Y");


?></b>

<b style="margin-right: 37px;">End Date&nbsp:&nbsp&nbsp<?php 
$dates=date_create($end);
$endd = date_format($dates,"Y-m-d");
$endval = date_format($dates,"m/d/Y");
echo date_format($dates,"F") .'&nbsp'. date_format($dates,"jS"). '&nbsp'. date_format($dates,"Y");
?></b>
<a target="_blank" href="reportgenerate.php?idd=<?php echo base64_encode($username)?>&start=<?php echo  $_POST['start'] ?>&end=<?php echo $_POST['end'] ?>"><i class="fa fa-file-pdf-o"   style="font-size:48px;color:red"> </i></a>
</p>


<?php  
function createRange2($startDate, $endDate) {
    $tmpDate = new DateTime($startDate);
    $tmpEndDate = new DateTime($endDate);

    $outArray = array();
    do {
        $outArray[] = $tmpDate->format('Y-m-d');
    } while ($tmpDate->modify('+1 day') <= $tmpEndDate);

    return $outArray;
}


$first_week_date = date('m/d/Y', strtotime('next Sunday -1 week', strtotime($startval)));
$timestamp = strtotime($endval);

$st=date_create($startval);
$startval_format = date_format($st,"m/d/Y");
$first_sat = date('D', strtotime($startval_format)); 
$first_sun = date('D', strtotime($startval_format));

$sat = date('D', $timestamp); 

$timestamp1 = strtotime($startva);

$sat1 = date('D', $timestamp1); 

$end_week_date =  date('m/d/Y', strtotime("next Saturday", strtotime($endval)));
if($first_sun=='Sun'){
    $dates = createRange2($startva,$endd);
  }else{

        if($sat =='Sat' && $sat1 == 'Sun' )
        {

        $dates = createRange2($startva,$endd);

        }
        else if($sat =='Sat' && $sat1 != 'Sun' )
        {
        $dates = createRange2($first_week_date,$end_week_date);
        }
        else if($sat !='Sat' && $sat1 != 'Sun' )
        {
            $dates = createRange2($first_week_date,$end_week_date);

        }
        else if($sat !='Sat' && $sat1 == 'Sun')
        {
            $dates = createRange2($first_week_date,$endd);
        }
  }

$val = array_chunk($dates,7);


$countval = count($dates);







$i = 1;
$count = $i - 1;









$i = 1;
$count = $i - 1;





foreach($val as $vall)
{
    
   
if($countval <=7)
{
    
    $spam = $countval;
    
    
   
    
    if($countval == 4)
    {
         $startval = $vall[0];
    $endval = $vall[3];
    }
    else if($countval == 5)
    {
         $startval = $vall[0];
    $endval = $vall[4];
    }
    else if($countval == 6)
    {
         $startval = $vall[0];
    $endval = $vall[5];
    }
     else if($countval == 2)
    {
         $startval = $vall[0];
    $endval = $vall[1];
    }
      else if($countval == 3)
    {
         $startval = $vall[0];
    $endval = $vall[2];
    }
    else
    {
        $startval = $vall[0];
        $endval = $vall[6];
    }
     
    
    
    
    
}
else
{
    




    
    if($countval == 4)
    {
         $startval = $vall[0];
    $endval = $vall[3];
    }
    else if($countval == 5)
    {
         $startval = $vall[0];
    $endval = $vall[4];
    }
    else if($countval == 6)
    {
         $startval = $vall[0];
    $endval = $vall[5];
    }
     else if($countval == 2)
    {
         $startval = $vall[0];
    $endval = $vall[1];
    }
      else if($countval == 3)
    {
         $startval = $vall[0];
    $endval = $vall[2];
    }
    else
    {
        $startval = $vall[0];
        $endval = $vall[6];
    }
    
   
    
    
   if($endval == '')
{
        
      
$start_date = strtotime("$startval"); 
$end_date = strtotime("$endd"); 
  


    $val =  ($end_date - $start_date)/60/60/24;   
    
    $countt = $val+1; 
        
        
        
    if($countt == 4)
    {
         $startval = $vall[0];
    $endval = $vall[3];
    }
    else if($countt == 5)
    {
         $startval = $vall[0];
    $endval = $vall[4];
    }
    else if($countt == 6)
    {
         $startval = $vall[0];
    $endval = $vall[5];
    }
     else if($countt == 2)
    {
         $startval = $vall[0];
    $endval = $vall[1];
    }
      else if($countt == 3)
    {
         $startval = $vall[0];
    $endval = $vall[2];
    }
        
        
        
        
        
        
       $spam = $countt;
    }
    else
    {
        
         $startval = $vall[0];
         $endval = $vall[6];
        $spam = '7';
    }
    
}
    
    
   


 ?>






<table class="table table-striped table-advance table-hover" cellspacing="0" cellpadding="0"  >
<thead>
    
    <?php 
    
    
     $westart = $startval;
    $weend = $endval;


$weekstarte = date("d-M -y", strtotime($westart));
$weeksend = date("d-M -y", strtotime($weend));




    
    ?>
    
    <tr>
            <th style="border: none !important;"> </th>
            <th style="border: none !important;"> </th>
            <th style="border: none !important;"> </th>
                        <th style="border: none !important;"> </th>

         <th >Week Start </th>
          <th colspan="2"><?php echo $weekstarte ?> </th>
           <th colspan="2">Week End </th>
            <th colspan="2"><?php echo $weeksend ?> </th>
            <th style="border: none !important;"> </th>
    </tr>
<tr>
    
   

<th rowspan="3" style="
vertical-align: text-bottom;width: 109px !important;
">Client</th>
<th rowspan="3" style="
vertical-align: text-bottom;width: 109px !important;
">Item</th>
<th rowspan="3" style="
vertical-align: text-bottom;width: 109px !important;
">Activity</th>
<th rowspan="4" style="
vertical-align: text-bottom;width: 109px !important;
">Comments</th>
<th colspan="<?php echo $spam ?>">Hours</th>
<th>Total</th>
<th rowspan="3">Total Hours</th>

</tr>


<tr>
    
<?php    
foreach($vall as $vv)
{
   
$timestamp = strtotime($vv);

$day = date('D', $timestamp); 
?>
   
   <?php  if($day == 'Sun' || $day == 'Sat' ) { ?>
   
<th style="width: 109px !important;"><?php echo $day ?></th>
<?php } else { ?>

<th style="width: 109px !important;"><?php echo $day ?></th>

<?php } ?>

<?php } ?>





<th rowspan="2">Hours</th>



</tr>

<tr>
<?php    
foreach($vall as $vv)
{
   
$timestamp1 = strtotime($vv);

$day1 = date('d', $timestamp1); 

$dayy = date('D', $timestamp1); 


$month = date('M', $timestamp1); 
?>
   
 <?php  if($dayy == 'Sun' || $dayy == 'Sat' ) { ?>
   
<th style="width: 109px !important;"><?php echo $day1 .'-' .$month ?></th>
<?php } else { ?>

<th><?php echo $day1 .'-' .$month ?></th>

<?php } ?>

<?php } ?>


</tr>
</thead>





 

<tbody>
    <?php

$selc = $this->db->query("SELECT distinct item FROM `timesheet_management` where `emp_id` = $emp_id and (`worked_date`>='$startval' && `worked_date`<='$endval') ORDER BY `worked_date`")->result_array();


$count_selc = $this->db->query("SELECT distinct item FROM `timesheet_management` where `emp_id` = $emp_id ORDER BY `worked_date`")->num_rows();

$col_span = ($count_selc);
$i=1;
foreach ($selc as $selcect) {

  echo "string";exit;
    $client_id =  $selcect['client'];
    $iditem = $selcect['item'];
    
    
$timesheet = mysqli_fetch_array(mysqli_query($conn,"select * from timesheet_management where `user_id` = '$username' and `client` = $client_id and `item`=$iditem and (`workeddate`>='$startval' && `workeddate`<='$endval')"));

$timesheetS = mysqli_fetch_array(mysqli_query($conn,"select * from timesheet_management where `user_id` = '$username' and `client` = $client_id and `item`=$iditem AND (`workeddate`>='$startval' && `workeddate`<='$endval')"));

$ss = mysqli_fetch_array(mysqli_query($conn,"select sum(workedhours) as wh from timesheet_management where `user_id` = '$username' and `client` = $client_id 
and `item`=$iditem and  (`workeddate`>='$startval' && `workeddate`<='$endval')"));

$vvs = mysqli_fetch_array(mysqli_query($conn,"select sum(workedhours) as wh from timesheet_management where `user_id` = '$username'  and (`workeddate`>='$startval' && `workeddate`<='$endval')"));




//$idclient = $timesheet['client'];

//$rig = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM client where id ='".$idclient."'"));
if(isset($timesheet['client']) && $timesheet['client'] !='' && $timesheet['client'] !=null ) { $idclient=$timesheet['client']; } else{ $idclient=''; };
    if($idclient != ''){
      $rig = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM client where id ='".$idclient."'"));
    }else{
      $rig = '';
    }

$del = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM item where id ='".$iditem."'"));

   
   
    ?>
<tr>

<td><?php if($rig != ''){ echo $rig['name']; }  ?></td>
<td><?php echo $del['name'] ?></td>
<td><?php if(isset($timesheetS['activity']) && $timesheetS['activity'] !=null ){ echo $timesheetS['activity']; }?></td>
<td><?php if(isset($timesheetS['Comments']) && $timesheetS['Comments'] !=null ){ echo $timesheetS['Comments']; }?></td>







<?php    


$count  = 1;
foreach($vall as $vv)
{
 
 
   
   $value = mysqli_query($conn,"SELECT * FROM timesheet_management where workeddate ='".$vv."' and `user_id` = '$username' and `client`=$client_id and `item`=$iditem");
   
   $row_cont = mysqli_num_rows($value);
   
   $fetch = mysqli_fetch_array($value);
   
   $timestamp2 = strtotime($vv);
   
   $dayyy = date('D', $timestamp2); 

 
 if($vv >= $startva)
 {
   if($row_cont !=0)
{   
    ?>
    
    
    


   
 <?php  if($dayyy == 'Sun' || $dayyy == 'Sat' ) { ?>
   
<td  style="width: 109px !important;"class ="firstdivtable">
   <?php echo $fetch['workedhours']?>
    </div>

</td>
<?php } else { ?>

<td class ="firstdivtable"><?php echo $fetch['workedhours']?></div>
</td>

<?php } ?>
    
    
  

<?php } else { ?>


<?php  if($dayyy == 'Sun' || $dayyy == 'Sat' ) { ?>
   
<td  style="width: 109px !important;" class ="firstdivtable"></div>
</div></td>

<?php } else { ?>

<td class ="firstdivtable"></div>
</td>

<?php } ?>

<?php } } else { ?>




 <?php  if($dayyy == 'Sun' || $dayyy == 'Sat' ) { ?>
   


<td style="width: 109px !important;" class ="firstdivtable">
</td>

<?php } else { ?>

<td class ="firstdivtable">
</td>


<?php } ?>


<?php } ?>
<?php } ?>

<?php
   if($ss['wh'] != '')
{   
    ?>


<td><?php echo $ss['wh']?></td>
<?php } else { ?>
<td></td>
<?php } ?>

   
<?php  
if($i == 1)
{
?>
<td  style="vertical-align: baseline;" rowspan="<?php echo $col_span ?>"><?php echo $vvs['wh']?></td>  
<?php } else { ?>

 
<?php } ?>  
      
</tr>



<?php $i++; } ?>
</tbody>

</table>

<?php  $i++;} ?>

 <?php

$rig =$this->db->query("SELECT * FROM employees where emp_id =$emp_id")->row_array();

$row = ($rig);


$timesheets = $this->db->query("SELECT * FROM employees where emp_id =$emp_id")->row_array();
$timesheetfetchs = ($timesheets);

?> 

<div>

<?php } else { ?>



<?php }
}
?>
</form>
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>
</body>
</html>
<style type="text/css">
.col-md-6{
float: left;
text-align: left !important;
}
.table-striped  td input{
    width: 70% !important;
}
/*.table-striped  td textarea{
    width: 100% !important;
}*/
.table-striped  td select 
{
  width:65px;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fff !important;
}
table.table-striped  td 
{
  border:1px solid black !important;
 
}
table.table-striped  th
{
  border:1px solid black !important;
  }
table th,table td{
border:none !important;
}
.btn-warning:not(:disabled):not(.disabled):active, .btn-warning:not(:disabled):not(.disabled).active, .show > .btn-warning.dropdown-toggle {
    color: #2a6198;
    background-color: #ee8227;
    border-color: #ed7b1b;
    text-align: center;
    margin-left: 9px;
}
.table-striped td input {
    width: 103% !important;
}
.form-control {
    width: 109% !important;
}
.container-fluid {
    width: 128%;
}
td:nth-child(2)
{
    text-align: left;
}
td:nth-child(1)
{
    text-align: left;
}
td:nth-child(3)
{
    text-align: left;
}
/*.firstdivtable*/
/*{*/
/*    vertical-align:top !important;*/
/*    text-align: left !important;*/
/*    padding: 0px !important;*/
/*}*/
.firstdiv
{
height: 20px;    
padding-top: 5px!important;
padding-bottom: 5px !important;
text-align: center;

border-bottom: 1px solid;
}
.seconddiv
{
 text-aliign: left !important;
    padding: 5% !important;
}
 .fa-file-pdf-o
 {
     cursor:pointer;
 }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                             image: data,

                              width: 500

                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
    </script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function () {
        var today = new Date();
        $('.datepicker').datepicker({
            altFormat: "dd-mm-yy"
           

      
    });
});
    </script>
    