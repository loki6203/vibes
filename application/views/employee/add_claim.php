<style type="text/css">
   .ck-editor__editable_inline {
   min-height: 200px;
   }
   .custom_date_field{
      position: relative;
   }
   .custom_date_field img{
     position: absolute;
    top: 7px;
    right: 10px;
    width: 20px;
    height: 20px;
    object-fit: contain;
   }
</style>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <?php if(@$contractor_payrun_list['contractor_payrun_list_id']!=''){ ?>
                  <h4 class="font-size-18">Edit Claims</h4>
               <?php } else { ?>
                  <h4 class="font-size-18">Add Claims</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$contractor_payrun_list['contractor_payrun_list_id']!=''){ ?>
                     <li class="breadcrumb-item active">Edit Claims</li>
                  <?php } else { ?>
                      <li class="breadcrumb-item active">Add Claims</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>employee/claims/" >
                  <i class="mdi mdi-arrow-left-bold mr-2"></i>Back
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <form method="post" action="<?php echo base_url(); ?>employee/save_claim" id="save_claim" name="save_claim" enctype="multipart/form-data" class="custom-validation">
                      <input type="hidden" name="claim_id" id="claim_id" class="form-control" value="<?php echo @$contractor_payrun_list['claim_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Claim Type <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <select class="form-control select2" name="claim_type_id" id="claim_type_id" required>
                              <option value="">-- Select Claim Type --</option>
                              <?php if(count($claim_type)>0){foreach($claim_type as $type){ ?>
                              <option value="<?php echo @$type['claim_type_id'];?>" <?php echo (@$type['claim_type_id']==@$contractor_payrun_list['claim_type_id'])?'selected':'';?>><?php echo @$type['name'];?></option>
                              <?php } } ?>
                           </select>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                            <div class="custom_date_field">
                              <input type="text" name="date" id="date" class="form-control" placeholder="Select Date" value="<?php echo @$contractor_payrun_list['date']; ?>" required autocomplete="off"/>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Amount <span class="required-star">*</span></label>
                            <div class="col-sm-4">
                              <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" value="<?php echo @$contractor_payrun_list['next_pay_date']; ?>" required autocomplete="off"/>
                            </div>
                            <label for="example-time-input" class="col-sm-2 col-form-label"> Comments</label>
                            <div class="col-sm-4">
                              <textarea type="text" name="comments" id="comments" class="form-control" placeholder="Enter Comments" cols="5" rows="4"></textarea>
                            </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Upload Supporting Documents <span class="required-star">*</span></label>
                            <div class="col-sm-4">
                              <input type="file" name="simage[]" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" multiple onchange="checkFileUploadExt(this);" required />
                            </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>employee/claims/">Cancel</a>
                           <?php if(@$contractor_payrun_list['contractor_payrun_list_id']!=''){ ?>
                              <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Update</button>
                           <?php } else { ?>
                              <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Save</button>
                           <?php } ?>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->    
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script>
$('#amount').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});
$(function(){
  var date = new Date();
  var maxDate = new Date(date.getFullYear(), date.getMonth() + 1, 0);
  var minDate = "-1M " + "-" + (date.getDate() - 1) + "D";
  $("#date").datepicker({
    minDate: minDate,
    maxDate: maxDate,   
    dateFormat: 'dd-mm-yy',
  });
});

function checkFileUploadExt(fieldObj)
{
    var extension = document.getElementById("simage");
    var filelength = extension.files.length;
    for (var i = 0; i < extension.files.length; i++)
    {
        var file = extension.files[i];
        var FileName = file.name;
        var FileExt = FileName.substr(FileName.lastIndexOf('.') + 1);
        if((FileExt.toUpperCase()== "JPEG") || (FileExt.toUpperCase()== "JPG") || (FileExt.toUpperCase()== "PNG") || (FileExt.toUpperCase()== "PDF") || (FileExt.toUpperCase()== "CSV") || (FileExt.toUpperCase()== "XLSX") || (FileExt.toUpperCase()== "XLS"))
        {
          
        }else{
          $('#simage').val('');
          alert('Please allowed jpeg, jpg, png, pdf, csv, xlsx, xls formates only');
        }
    }
}
</script>
