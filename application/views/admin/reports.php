<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Reports</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Reports</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                 <?php 
                        $myDateArray = explode("-", @$month);
                        $Mnth=@$myDateArray[0];
                        $Year=@$myDateArray[1];
                  ?>
                  <a class="btn app-new-employee-button btn-excel dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/export_reports/<?php echo $Mnth; ?>/<?php echo $Year; ?>/<?php echo $emp_id; ?>" ><i class="fa fa-download" aria-hidden="true"></i>&nbsp; 
                  Excel
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <div class="form-group row">
            <label for="example-time-input" class="col-sm-2 col-form-label"> Select Month</label>
            <div class="col-sm-3">
               <input type="text" name="month" id="month" class="form-control" placeholder="Select Month" value="<?php echo @$month; ?>" required />
            </div>
            <label for="example-time-input" class="col-sm-2 col-form-label"> Select Month</label>
            <div class="col-sm-3">
              <select class="form-control select2" name="emp_id" id="emp_id" >
                 <option value="">--Select Employee--</option>
                 <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                    <option value="<?php echo $emp['emp_id'];?>" <?php echo ($emp_id==$emp['emp_id'])?'selected':'';?>><?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                 <?php } } ?>
              </select>
            </div>
            <button class="btn app-new-employee-button-2 btn-primary waves-effect waves-light mr-1" onclick="getMonthEmployee();">Submit</button>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                        <tr>
                           <th>S.No</th>
                           <th class="all">Employee <br>Name </th>
                           <th>Monthly Salary</th>
                           <th>Allowance</th>
                           <th>Rent</th>
                           <th>Claim Amount</th>
                           <th>Gross Salary</th>
                           <th>Comments</th>
                           <th>Month</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script> 
  $('#month').Zebra_DatePicker({
        format: 'm-Y'
   });
$(document).ready(function() {
  var month = '<?php echo $month; ?>';
  var emp_id = '<?php echo $emp_id; ?>'
   $('#datatable').DataTable({
        "order": [[ 1, "desc" ]],
        "processing": true,
        "serverSide": true,
        "oLanguage": {
            "sLengthMenu": "Number of rows _MENU_ ",
        },
        "language": {
            "info": " _START_ - _END_ of _TOTAL_ ",
            'paginate': {
                'previous': '<b><</b>',
                'next': '<b>></b>'
            },
        },
        "ajax": {
        "url":  "<?php echo base_url();?>admin/get_report_list",
        "type": "GET",
        "data": {"month": month,'emp_id':emp_id},
        } 
    });
});

function getMonthEmployee()
{
    var month =$('#month').val();
    var emp_id =$('#emp_id').val();
    if(emp_id!=''){
      if(month=='')
      {
        alert("Please Select Month");
        return false;
      }
    }
    window.location.href = '<?php echo base_url();?>admin/reports/'+month+'/'+emp_id;
}




</script>