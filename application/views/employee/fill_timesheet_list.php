<style>
   .fill-sheet-table .table th,  .fill-sheet-table .table td{
      padding: 6px;
      border: 1px solid black;
      text-align: center;
      font-weight: 600;
      color: #595454;
   }
   .input_size {
    overflow: visible;
    width: 45px;
}
table thead tr{
   font-weight: bold;
}
</style>
<form method="post" name="myForm" id="myForm" action="<?php echo base_url(); ?>employee/save_timesheet">
<input type="hidden" name="from" value="<?php echo @$start_date;?>"/>
<input type="hidden" name="to" value="<?php echo @$end_date;?>"/>
<?php
foreach($dates as $k=>$slot){
$cnt = count($slot);
$slot_dates = $slot[0].'_'.end($slot);
?>
<input type="hidden" class="input_size" name="slots[]" size="8" value="<?php echo $slot_dates;?>">
<div class="fill-sheet-table">
<table id="datatable" class="table table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" oncontextmenu="return false;">
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
<tr style="background-color: #bfb1f2;">
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
   <th style="width: 109px !important;background-color: #bfb1f2;"><?php echo DAYNAME($weekname); ?></th>
   <?php
      }
   ?>
   <th rowspan="2" style="background-color: #bfb1f2;">Hours</th>
</tr>
<tr>
   <?php
      foreach($slot as $k=>$weekname){
   ?>
   <th style="width: 109px !important;background-color: #bfb1f2;"><?php echo DD_MM($weekname); ?></th>
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
            if($Get_Sick_Leaves!=0){
               if(in_array($sltdates, $Get_Sick_Leaves) && $tothours=='Sick Leave')
               {
                  $toth=8; 
               }
            }
            if(in_array($sltdates, $arr) && $tothours=='Public Holiday'){
              $toth=8; 
            }
            if($Get_Annual_Leaves!=0)
            {
               if(in_array($sltdates, $Get_Annual_Leaves) && $tothours=='Annual Leave'){
                 $toth=8; 
               }
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
         <td style="width: 16%;"><?php echo $it;?></td>
         <input type="hidden" name="name_<?php echo $slot_dates;?>[]" size="8" value="<?php echo $it;?>" class="input_size">
         <td><input type="text" name="type_of_work_performed_<?php echo $slot_dates;?>[]" placeholder="<?php echo $it;?>" style="padding: 0 0px 4px 0;" value="<?php echo @$existdata['type_of_work_performed'];?>" class="input_type_of_size type_of_work_performed_<?php echo str_replace(' ', '_', @$it);?>_<?php echo $slot_dates;?>" onkeyup="keyupCls(this,'type','<?php echo $it;?>','<?php echo $slot_dates;?>');"></td>
         <?php
         $tothours=array();
         foreach($slot as $j=>$dt){
            $worked_hours = @$this->db->query("SELECT `worked_hours` FROM `timesheet_management` WHERE `item`='$it' AND worked_date='$dt' AND emp_id=$emp_id ORDER BY timesheet_management_id  DESC")->row()->worked_hours;
            if($Get_Sick_Leaves!=0)
            {
               if(in_array($dt, $Get_Sick_Leaves) && $it=='Sick Leave'){
                 $worked_hours=8; 
               }
            }
            if(in_array($dt, $arr) && $it=='Public Holiday'){
              $worked_hours=8; 
            }
            if($Get_Annual_Leaves!=0)
            {
               if(in_array($dt, $Get_Annual_Leaves) && $it=='Annual Leave'){
                 $worked_hours=8; 
               }
            }
            if($worked_hours!=''){
               $tothours[]=$worked_hours;
            }
         ?>
            <?php 
               $Read='';
               if($it=='Sick Leave' || $it=='Annual Leave' || $it=='Public Holiday'){
                  $Read='disabled style="background-color:#d8d7d7;"';
               } 
            ?>
            <td><input value="<?php echo @$worked_hours;?>" class="<?php echo $i;?><?php echo $slot_dates;?> numeric input_size add-Hrs_<?php echo str_replace(' ', '_', @$it);?>_<?php echo $dt;?>" type="text" rel="<?php echo $i;?><?php echo $slot_dates;?>" slot='<?php echo $slot_dates;?>' name="weeks_<?php echo $it;?><?php echo $slot_dates;?>[][<?php echo $dt;?>]" onkeyup="Get_Hours(this);" onclick="ModelPopup('<?php echo $dt;?>','<?php echo str_replace(' ', '_', @$it);?>','remarks_<?php echo str_replace(' ', '_', @$it);?>_<?php echo $slot_dates;?>','<?php echo $slot_dates;?>');" size="8" <?php echo @$Read; ?>></td>
         <?php
         }
         ?>
         <td><input value="<?php echo array_sum($tothours);?>" type="text" rel="tot_<?php echo $slot_dates;?>" disabled id="<?php echo $i;?><?php echo $slot_dates;?>" name="hours_<?php echo $slot_dates;?>[]" size="8" onkeyup="Get_Tot('<?php echo $slot_dates;?>');" class="input_size type_of_worked_hrs_<?php echo str_replace(' ', '_', @$it);?>_<?php echo $slot_dates;?>" style="background-color: #d8d7d7;"></td> 
         <?php
         if($i==0){
         ?>
            <td style="vertical-align: baseline;" rowspan="6">
            <input type="text" value="<?php echo array_sum($weeklytot);?>" id="tot_<?php echo $slot_dates;?>" name="total_<?php echo $slot_dates;?>[]" class="input_size Weekly_Total_Hrs_<?php echo $slot_dates;?>" disabled style="width: 54px;background-color: #d8d7d7;"></td>
         <?php
         }
         ?>
            <td class="" style="min-width: 200px;">
               <textarea class="w-100" cols="" rows="2" name="remarks_<?php echo $slot_dates;?>[]" placeholder="Remarks" class="input_size remarks_<?php echo str_replace(' ', '_', @$it);?>_<?php echo $slot_dates;?>" onkeyup="keyupCls(this,'remarks','<?php echo $it;?>','<?php echo $slot_dates;?>');">
                  <?php echo @$existdata['comments'];?>
               </textarea>
            </td>
      </tr>
      <?php
      }
      ?>
</tbody>
</table>
<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>
<?php
}
?>
<div class="text-center">
<button type="submit" class="btn btn-primary waves-effect waves-light mr-10">Submit</button>
</div>
</form>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Fill Detailed Timesheet for <span class="Dt"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- end page title -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                     <div class="add_more">
                        
                     </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row --> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary Model-Btn" onclick="SaveMyForm(<?php echo $sn; ?>)">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End Model Popup -->

<script>
$('.numeric').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});
function Get_Hours(val){
// name   = $(val).attr('name');
// id     = $(val).attr('rel');
// slot   = $(val).attr('slot');
// var sum = 0;
// $('.'+id).each(function(){
//    if(this.value && parseFloat(this.value)>0){
//       sum += parseFloat(this.value);
//    }
// });
// if(parseFloat(sum)){
//    document.getElementById(id).value = parseFloat(sum);
// }
// Get_Tot(slot);
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
console.log(tot);
document.getElementById('tot_'+dt).value = parseFloat(tot);
}

function ModelPopup(dt,item,remarks,weekstart_enddate)
{
   const objDate = new Date(dt);
   const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    if (objDate !== 'Invalid Date' && !isNaN(objDate)) {
        var FullDate=objDate.getDate() + '-' + months[objDate.getMonth()] + '-' + objDate.getFullYear();
    }
   $('.Dt').text(FullDate);
   var dt=dt;
   var type_of_work_performed_dt=$('.type_of_work_performed_'+item+'_'+weekstart_enddate).val();
   var item=item;
   var remarks =$('.remarks_'+item+'_'+weekstart_enddate).val();
   var StartDate =$('#start_date').val();
   var EndDate =$('#end_date').val();
   $.ajax({
       url: '<?php echo base_url('employee/ajax_add_more'); ?>',
       type: 'POST',
       data: {dt: dt,type_of_work_performed_dt: type_of_work_performed_dt,item: item,remarks: remarks,weekstart_enddate: weekstart_enddate,StartDate: StartDate,EndDate: EndDate},
       success: function(res){
        $('.add_more').html(res);
        $('#exampleModalCenter').modal('show');
       }
    });
   
}
function AddMore(id)
{
   if(id!='')
   {
      $.ajax({
           url: '<?php echo base_url('employee/ajax_add_more'); ?>',
           type: 'POST',
           data: {id: id},
           success: function(res){
            $('.add_more').append(res);
            $("#more_"+id).remove();
           }
      });
   }else{
      alert('Opps! something went to wrong...');
   }
}
function Deleterow(sn)
{
    var countArr=$('input[name="project_name[]"]').length;
    if(countArr==1){
      alert('You can"t remove. Atleast one field required');
    }else{
     $(".add_more_sno_"+sn).remove();
     $("#removemore_"+sn).remove(); 
   }
}
function SaveMyForm(id)
{
   var ID=$('#ID').val();
   var date=$('#Dt').val();
   var type_of_work_performed=$('#type_of_work_performed_dt').val();
   var item=$('#item-name').val();
   var remarks=$('#remaks').val();
   var weekstart_enddate=$('#weekstart_enddate').val();
   var project_name=$("input[name^='project_name']").map(function (idx, ele) {
      return $(ele).val();}).get();
   var Hrs=$("input[name^='Hrs']").map(function (idx2, ele2) {
      return $(ele2).val();}).get();
   var comments=$("textarea[name^='Cmnts']").map(function (idx3, ele3) {
      return $(ele3).val();}).get();

    var validate = true;
    $("input[name^='project_name']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
    $("input[name^='Hrs']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
      if(validate){
        
      } else {
        alert("Please fill the all required fields!");
        return false;
      }
   $.ajax({
        url: '<?php echo base_url('employee/ajax_save_add_more'); ?>',
        type: 'POST',
        dataType :'json',
        data: {ID: ID,date: date,item:item,type_of_work_performed:type_of_work_performed,remarks: remarks,weekstart_enddate: weekstart_enddate,project_name: project_name,Hrs: Hrs,comments: comments},
        success: function(res){
            if(res.status==0)
            {
               alert('Opps! something went to wrong...');
            }else if(res.status=='error')
            {
               alert('Please fill the all required fields!');
            }else{
               $('.add-Hrs_'+item+'_'+date).val('');
               $('.add-Hrs_'+item+'_'+date).val(res.Hrs);
               $('.type_of_worked_hrs_'+item+'_'+weekstart_enddate).val(res.Total_Hrs);
               $('.Weekly_Total_Hrs_'+weekstart_enddate).val(res.Weekly_Total_Hrs);
               $('#exampleModalCenter').modal('hide');
            }
        }
   });
}
function keyupCls(val,type,item,slot_dates)
{
    var val=val.value;
    var type=type;
    var item = item; 
    var dt=slot_dates;
    if(val!='' && type!='' && item!='' && dt!='')
    {
      $.ajax({
          url: '<?php echo site_url('employee/ajax_save_item_and_remarks'); ?>',
          type: 'POST',
          data: {val: val,type: type,item: item,dt: dt},
          success: function(res) {
              console.log(res);
          }
      });
    }else{

    }
}
</script>