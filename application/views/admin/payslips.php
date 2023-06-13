<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>

<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18"> Employee Payslip List</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Employee Payslip List</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            
         </div>
      </div>
      <!-- end page title -->
      <?php if($this->session->flashdata('msg') !=''){ ?>
          <span class="align_text sucess_msg"><?php echo $this->session->flashdata('msg');?></span>
      <?php } ?>
      <label for="example-time-input" class="col-sm-2 col-form-label"> Select Month</label>
      <div class="form-group row">
          <div class="col-8 col-md-4">
            <input type="text" name="month" id="month" class="form-control" placeholder="Select Month" value="<?php echo @$mnth_year; ?>" required />
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
                           <th class="all">Employee Name </th>
                           <th>Month</th>
                           <th>Year</th>
                           <th>Upload Payslip</th>
                           <th class="all">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(count($payslips)>0){ $a=1; foreach($payslips as $res){ ?>
                        <tr class="row_<?php echo $a; ?>">
                        <form action="<?php echo base_url(); ?>admin/save_payslip" method="post" id="form_img_<?php echo $a; ?>" enctype="multipart/form-data" accept-charset="utf-8">
                            
                            <td><?php echo $a; ?></td>
                            <td><input type="hidden" name="payslip_id" id="payslip_id_<?php echo $a; ?>" value="<?php echo @$res['payslip_id']; ?>"><input type="hidden" name="emp_id" id="emp_id_<?php echo $a; ?>" value="<?php echo @$res['e_id']; ?>"><?php echo @$res['fname']; ?> <?php echo @$res['lname']; ?> (<?php echo @$res['emp_code']; ?>)</td>
                            <td><input type="hidden" name="month" id="month_<?php echo $a; ?>" value="<?php echo @$month; ?>"><?php $m=$month;
          $months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
          echo $months[(int)$m]; ?></td>
                            <td><input type="hidden" name="year" id="year_<?php echo $a; ?>" value="<?php echo @$year; ?>"><?php echo @$year; ?></td>
                            <td>
                                <input type="file" name="simage" id="simage_<?php echo $a; ?>" class="form-control filestyle" accept="application/pdf" onchange="loadFile(event,'<?php echo $a; ?>')" value="<?php echo @$res['payslip_file_name']; ?>">
                                <div class="upload-img_<?php echo $a; ?>">
                                    <a href="<?php echo base_url(); ?>assets/payslips/<?php echo @$res['payslip_file_path']; ?>" target="_blank" ><?php echo @$res['payslip_file_name']; ?> 
                                  </a>
                                   <?php if($res['payslip_file_path']!=''){ ?>
                                    <i class="fa fa-trash" aria-hidden="true" style="font-size:18px;color:red" oNclick="DeletePayslip('<?php echo $a; ?>');"></i>
                                  <?php } ?>
                                </div>
                            </td>
                            <td><input type="button" name="submit" id="submit" class="btn btn-primary waves-effect waves-light mr-1 align-center" value="Save" onclick="AjxaSave_Payslip('<?php echo $a; ?>');">

                            </td>
                        </form>  
                        </tr>
                        <?php $a++; } } ?>
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
  var month = '<?php echo @$month; ?>'
    $('#datatable').DataTable({
         "aLengthMenu": [100],
    });
});

function getMonth()
{
    var month =$('#month').val();
    window.location.href = '<?php echo base_url();?>admin/payslips/'+month;
}

function AjxaSave_Payslip(k)
{
    var payslip_id =$('#payslip_id_'+k).val();
    var emp_id =$('#emp_id_'+k).val();
    var simage =$('#simage_'+k).val().split('\\').pop();
    var formData = new FormData($("#form_img_"+k)[0]);
    if(simage==''){
      alert('Please select Payslip.');
      return false;
    }else{
          $.ajax({
              url: $("#form_img_"+k).attr('action'),
              dataType : 'json',
              type: 'POST',
              data: formData,
              contentType : false,
              processData : false,
              success: function(response) {
                var status = response.status; 
                var SIMG = response.simage; 
                var SlipPath = response.simage_path;
                var SlipID = response.payslip_id; 
                $('#payslip_id_'+k).val(SlipID);
                var URL = "<?php echo base_url(); ?>assets/payslips/"+SlipPath;
                $('.upload-img_'+k).html('<a href="'+URL+'" target="_blank">'+SIMG+'</a> <i class="fa fa-trash" aria-hidden="true" style="font-size:18px;color:red" oNclick="DeletePayslip('+k+');"></i>');
                if(status==-1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Invalid Format...',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('.upload-img_'+k).html('');
                }else if(status==0){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Payslip Updated SuccessFully...',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Payslip Saved SuccessFully...',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
                  
              }
        });
    }
}

var loadFile = function(event,k)
{
    var extension = $('#simage_'+k).val().split('.').pop().toLowerCase();
    if(extension=='pdf')
    {

    }else{
    alert('Only pdf formats are allowed.');
    $('#simage_'+k).val('');
    }
}
function DeletePayslip(k){
    var payslip_id =$('#payslip_id_'+k).val();
    var emp_id =$('#emp_id_'+k).val();
     $.ajax({
        url: '<?php echo site_url('admin/delete_payslip'); ?>',
        type: 'POST',
        data: {payslip_id: payslip_id,emp_id: emp_id},
        success: function(data) {
           if(data==1){
                $('.upload-img_'+k).html('');
                $('#simage_'+k).filestyle('clear');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Payslip Deleted SuccessFully...',
                    showConfirmButton: false,
                    timer: 1000
                });
           }else{
              Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Payslip Deleted Failed...',
                    showConfirmButton: false,
                    timer: 1000
                });
           }
        }
    });
}
</script>
