<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Employee Payroll List</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Employee Payroll List</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                 <!--  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/add_payroll" ><i class="mdi mdi-plus mr-2"></i>
                  Add Employee Payroll
                  </a> -->
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <label for="example-time-input" class="col-sm-2 col-form-label"> Select Month</label>
      <div class="form-group row">
            <div class="col-8 col-md-4">
               <input type="text" name="month" id="month" class="form-control" placeholder="Select Month" value="<?php echo @$month; ?>" required />
            </div>
            <div class="col-4">
                <button class="btn btn-primary waves-effect waves-light mr-1" onclick="getMonth();">Submit</button>
            </div>
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
                           <th>Total Gross Salary</th>
                           <th>Claims</th>
                           <th>Total Cost</th>
                           <th>Comments</th>
                           <?php if($GetRolesAccess['write']==1){?>
                           <th class="all">Action</th>
                         <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
                  <?php if($GetRolesAccess['write']==1){?>
                  <div class="row" style="margin-left: 400px;">
                  <div class="col-xs-6">
                        <?php 
                            $myDateArray = explode("-", @$month);
                            $Mnth=@$myDateArray[0];
                            $Year=@$myDateArray[1];
                        if($Mnth!='' && $Year!=''){ ?>
                          <input type="button" name="Submit To Finance" id="Submit To Finance" class="btn btn-primary waves-effect waves-light mr-1 align-center" value="Submit To Finance" onclick="SubmitFinance('<?php echo $Mnth; ?>','<?php echo $Year; ?>');">
                        <?php } ?>
                  </div></div>
                <?php } ?>
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
  var month = '<?php echo $month; ?>'
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
        "url":  "<?php echo base_url();?>admin/get_payroll_list",
        "type": "GET",
        "data": {"month": month},
        } 
    });
});

 function change_payroll_status(payroll_id,sta)
   {
      Swal.fire({
           text: "Are you sure want to change the status ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes'
         }).then((result) => {
               if (result.isConfirmed)
               {
                  window.location="<?php echo base_url();?>admin/change_payroll_status/"+payroll_id+'/'+sta+'/';
             }
      });
  } 

function getMonth()
{
    var month =$('#month').val();
    window.location.href = '<?php echo base_url();?>admin/payroll/'+month;
}

function SubmitFinance(month,year)
{
    window.location.href = '<?php echo base_url();?>admin/Save_Finance/'+month+'/'+year;
}

function AjxaSavePayroll(k,payroll_id,Month,Year)
{
    var emp_id =$('#emp_id_'+k).val();
    var monthly_salary =$('#monthly_salary_'+k).val();
    var allowance =$('#allowance_'+k).val();
    var claim_amt =$('#claim_amt_'+k).val();
    var gross_salary =$('#gross_salary_'+k).val();
    var comments =$('#comments_'+k).val();
    var month =$('#month').val();
    $.ajax({
        url: '<?php echo site_url('admin/AjxaSave_Payroll'); ?>',
        type: 'POST',
        data: {emp_id: emp_id,payroll_id: payroll_id,month: month,monthly_salary: monthly_salary,allowance: allowance,claim_amt: claim_amt,gross_salary: gross_salary,comments: comments},
        dataType: 'json',
        success: function(data) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Payroll Saved SuccessFully...',
              showConfirmButton: false,
              timer: 1500
            });
          
        }
    });
}
function Grass_cal(k)
{
  var monthly_salary = $("#monthly_salary_"+k).val();
  var allowance = $("#allowance_"+k).val();
  if(monthly_salary!='' && allowance!=''){
      var Total = parseFloat(monthly_salary)+parseFloat(allowance);
      $("#gross_salary_"+k).val(Total);
  }else if(monthly_salary!=''){
      var Total = parseFloat(monthly_salary);
      $("#gross_salary_"+k).val(Total);
  }else if(allowance!=''){
      var Total = parseFloat(allowance);
      $("#gross_salary_"+k).val(Total);
  }else{
      $("#gross_salary_"+k).val('');
  }  
}
function Total_cal(k)
{
  var gross_salary = $("#gross_salary_"+k).val();
  var claim_amt = $("#claim_amt_"+k).val();
  if(gross_salary!='' && claim_amt!=''){
      var Total = parseFloat(gross_salary)+parseFloat(claim_amt);
      $("#total_cost_"+k).val(Total);
  }else if(gross_salary!=''){
      var Total = parseFloat(gross_salary);
      $("#total_cost_"+k).val(Total);
  }else if(claim_amt!=''){
      var Total = parseFloat(claim_amt);
      $("#total_cost_"+k).val(Total);
  }else{
      $("#total_cost_"+k).val('');
  }  
}
</script>