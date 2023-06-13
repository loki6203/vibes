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
               <?php if(@$work_orders['work_orders_id']!=''){ ?>
               <h4 class="font-size-18">Edit Work Order</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Work Order</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$work_orders['work_orders_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Work Order</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Work Order</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/work_orders" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_work_order" id="save_work_order" name="save_work_order" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="work_orders_id" id="work_orders_id" class="form-control" value="<?php echo @$work_orders_id; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">Client Name<span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <input type="text" name="clinet_name" id="clinet_name" class="form-control keypress" placeholder="Enter Client Name" value="<?php echo @$work_orders['clinet_name']; ?>" required autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label">Project Name<span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <input type="text" name="project_name" id="project_name" class="form-control keypress" placeholder="Enter Project Name" value="<?php echo @$work_orders['project_name']; ?>" required autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client Details<span class="required-star">*</span></label>
                        <div class="col-sm-10 app-new-employee-button">
                          <textarea name="client_details" id="client_details" placeholder="Enter Client Details" class="form-control keypress" cols="95" rows="3" required><?php echo @$work_orders['client_details']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">PO Deal amount<span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <input type="text" name="PO_deal_amt" id="PO_deal_amt" class="form-control keypress" placeholder="Enter PO Deal amount" value="<?php echo @$work_orders['PO_deal_amt']; ?>" required autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> PO<span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <input type="text" name="PO" id="PO" class="form-control keypress" placeholder="Enter PO" value="<?php echo @$work_orders['PO']; ?>" required autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Start Date <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <div class="custom_date_field">
                              <?php if(@$work_orders['start_dt']==''){ ?>
                                 <input type="text" name="start_dt" id="start_dt" class="form-control keypress" placeholder="Select Start Date" autocomplete="off" required value="<?php echo @$work_orders['start_dt']; ?>"/>
                              <?php } else { ?>
                                 <input type="text" name="start_dt" id="start_dt" class="form-control keypress" placeholder="Select Start Date" autocomplete="off" required value="<?php echo @DD_MM_YY($work_orders['start_dt']); ?>"/>
                              <?php } ?>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> End Date <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <div class="custom_date_field">
                             <?php if(@$work_orders['end_dt']==''){ ?>
                                 <input type="text" name="end_dt" id="end_dt" class="form-control keypress" placeholder="Select Start Date" autocomplete="off" required value="<?php echo @$work_orders['end_dt']; ?>"/>
                              <?php } else { ?>
                                 <input type="text" name="end_dt" id="end_dt" class="form-control keypress" placeholder="Select Start Date" autocomplete="off" required value="<?php echo @DD_MM_YY($work_orders['end_dt']); ?>"/>
                              <?php } ?>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> PO Hrs <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                              <input type="text" name="PO_Hrs" id="PO_Hrs" class="form-control keypress" placeholder="Enter PO Hrs" value="<?php echo @$work_orders['PO_Hrs']; ?>" required autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Nature of Business <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <div class="app-new-supplier">
                              <select class="form-control select2" name="nature_of_business_id" id="nature_of_business_id" required>
                                <option disabled selected value="">Select Nature of Business</option>
                                <?php if(!empty($nature_of_business)){foreach ($nature_of_business as $nature) {
                                ?>
                                 <option value="<?php echo @$nature['nature_of_business_id']; ?>" <?php echo (@$nature['nature_of_business_id']==@$work_orders['nature_of_business_id'])?'selected':'';?>><?php echo @$nature['name'];?></option>
                               <?php } } ?>
                            </select>
                               <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="NatureofBusiness();"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> No.of Resources <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                              <input type="text" name="no_of_resources" id="no_of_resources" class="form-control keypress" placeholder="Enter No.of Resources" value="<?php echo @$work_orders['no_of_resources']; ?>" required autocomplete="off"readonly onclick="Cal();"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Eco System/Practice <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                        <div class="app-new-supplier">
                              <select class="form-control select2" name="eco_system_practice_id" id="eco_system_practice_id" required>
                                <option disabled selected value="">Select Eco System/Practice</option>
                                <?php if(!empty($eco_system_practice)){foreach ($eco_system_practice as $eco) {
                                ?>
                                 <option value="<?php echo @$eco['eco_system_practice_id']; ?>" <?php echo (@$eco['eco_system_practice_id']==@$work_orders['eco_system_practice_id'])?'selected':'';?>><?php echo @$eco['name'];?></option>
                               <?php } } ?>
                            </select>
                              <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="EcoSystem();"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Year <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                              <input type="text" name="year" id="year" class="form-control keypress" placeholder="Enter Year" value="<?php echo @$work_orders['year']; ?>" required autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Recognized Amt <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                              <input type="text" name="recognized_amt" id="recognized_amt" class="form-control keypress" placeholder="Enter Recognized Amt" value="<?php echo @$work_orders['recognized_amt']; ?>" required autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Backlog Amt<span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                              <input type="text" name="backlog_amt" id="backlog_amt" class="form-control keypress" placeholder="Enter Backlog Amt" value="<?php echo @$work_orders['backlog_amt']; ?>" required autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label">EMP Contribution<span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                              <input type="text" name="EMP_contribution" id="EMP_contribution" class="form-control keypress" placeholder="Enter EMP Contribution" value="<?php echo @$work_orders['EMP_contribution']; ?>" required autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Upload Documents <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                             <input type="file" name="simage[]" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" multiple onchange="checkFileUploadExt(this);" />
                             <?php if(!empty($work_orders_documents)){$i=1;foreach ($work_orders_documents as $docs) { ?>
                             <div class="Remove_<?php echo $i; ?>"><?php echo $i; ?>) <a href="<?php echo base_url(); ?>assets/work_orders/<?php echo $docs['file_path']; ?>" target="_blank"><?php echo $docs['file_name']; ?></a>&nbsp;&nbsp; <a href="javascript:void(0);" class="btn btn-danger" onclick="Remove(<?php echo $i; ?>,<?php echo $docs['work_orders_document_id']; ?>);">Remove</a><br></div>
                           <?php $i++;} }?>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/work_orders">Cancel</a>
                           <?php if(@$work_orders['work_orders_id']!=''){ ?>
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

<!-- Modal Popup -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resources</h5>
         <button type="button" class="close" aria-label="Close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
         </button>
     </div>
      <div class="modal-body">
        <div class="ajax-div-cls"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary Model-Btn" onclick="SaveMyForm();">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Popup -->

<!-- Nature Modal -->
    <div class="modal fade" id="NatureofBusiness-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Nature of Business </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
               <label>Nature of Business <span class="required-star">*</span></label>
                <input class="form-control" placeholder="Enter Nature of Business" type="text" name="business_name" id="business_name" required autocomplete="off">
                <span class="model_error"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="Get_nature_of_business();">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Nature Of Business -->

    <!-- Eco System Modal -->
    <div class="modal fade" id="EchoSystem-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Eco System/Practice </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
               <label>Eco System/Practice <span class="required-star">*</span></label>
                <input class="form-control" placeholder="Enter Eco System/Practice " type="text" name="eco_system_practice_name" id="eco_system_practice_name" required autocomplete="off">
                <span class="model_error"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="Get_EchoSystem();">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal Eco System -->

<script>
$('#PO_deal_amt,#PO_Hrs,#no_of_resources,#recognized_amt,#backlog_amt').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});

$( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#start_dt" )
        .datepicker({
         changeMonth: true,
         changeYear: true,
         dateFormat: 'dd-mm-yy',
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
          $("#end_dt").val('');
        }),
      to = $( "#end_dt" ).datepicker({
         changeMonth: true,
         changeYear: true,
         dateFormat: 'dd-mm-yy',
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  });

$('#year').Zebra_DatePicker({
    format: 'Y'
});


function Cal()
{
   var work_orders_id=$('#work_orders_id').val();
   var clinet_name=$('#clinet_name').val();
   var project_name=$('#project_name').val();
   if(clinet_name!='' || project_name!='')
   {
      $.ajax({
        url: '<?php echo site_url('admin/ajax_work_resources'); ?>',
        type: 'POST',
        data:{work_orders_id: work_orders_id,clinet_name: clinet_name,project_name: project_name},
        success: function(data) {
            if(data==0){
               alert('Opps! something went to wrong...');
            }else{
               $('.ajax-div-cls').html('');
               $('.ajax-div-cls').append(data);
               $('.bd-example-modal-lg').modal('show');
            }
        }
      });
   }else{
      alert('Please must be enter client name or project name required.');
   }
}
function SaveMyForm()
{
   var work_orders_id=$("input[name='model_work_orders_id']").val();
   if(work_orders_id==''){
      alert('Opps! something went to wrong...!');
      return false;
   }
   var emp_id=$("input[name^='emp_id']").map(function (idx, ele) {
      return $(ele).val();}).get();
   var emp_per_hrs=$("input[name^='emp_per_hrs']").map(function (idx2, ele2) {
      return $(ele2).val();}).get();
   var emp_start_dt=$("input[name^='emp_start_dt']").map(function (idx3, ele3) {return $(ele3).val();}).get();
   var emp_end_dt=$("input[name^='emp_end_dt']").map(function (idx4, ele4) {return $(ele4).val();}).get();
   var emp_title=$("input[name^='emp_title']").map(function (idx5, ele5) {return $(ele5).val();}).get();
   var kpis=$("input[name^='kpis']").map(function (idx6, ele6) {return $(ele6).val();}).get();

    var validate = true;
    $("input[name^='emp_id']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
    $("input[name^='emp_per_hrs']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
    $("input[name^='emp_start_dt']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
    $("input[name^='emp_end_dt']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
    $("input[name^='emp_title']").each(function(){
      if($(this).val() == ""){
        validate = false;
      }
    });
    $("input[name^='kpis']").each(function(){
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
        url: '<?php echo base_url('admin/ajax_save_work_resources'); ?>',
        type: 'POST',
        dataType :'json',
        data: {work_orders_id: work_orders_id,emp_id: emp_id,emp_per_hrs: emp_per_hrs,emp_start_dt: emp_start_dt,emp_end_dt: emp_end_dt,emp_title: emp_title,kpis: kpis},
        success: function(res){
            if(res.status==0)
            {
               alert('Opps! something went to wrong...');
            }else if(res.status=='error')
            {
               alert('Please fill the all required fields!');
            }else{
               $('#no_of_resources').val(res.no_of_resources);
               $('.bd-example-modal-lg').modal('hide');
            }
        }
   });
}
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


var type='<?php echo $Type; ?>';
if(type=='Add'){
   $('.keypress').on("input", function() {
      var work_orders_id = $('#work_orders_id').val();
      var Val = this.value;
      var InputName = $(this).attr("id");
       $.ajax({
           url: '<?php echo site_url('admin/ajax_save_work_order'); ?>',
           type: 'POST',
           data:{work_orders_id: work_orders_id,InputName: InputName,Val: Val},
           success: function(data) {
               if(data==0){
                  alert('Opps! something went to wrong...');
               }else{
                  $('#work_orders_id').val(data);
               }
           }
         });
   });
}
function NatureofBusiness()
{
  $('#NatureofBusiness-Modal').modal('show'); 
}
function Get_nature_of_business()
{
    var business_name=$('#business_name').val();
    if(business_name==''){
        alert('Please enter nature of business name');
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/check_nature_of_business_existed'); ?>',
            type: 'POST',
            dataType: "json",
            data: {business_name: business_name},
            success: function(res) {
                if(res.get_nature_of_business.res==1){
                    $('#NatureofBusiness-Modal').modal('hide');
                    alert('Nature of business name saved successfully');
                    $('#business_name').val('');
                      var myArray = res.get_nature_of_business;
                      $('#nature_of_business_id').find('option').remove();
                      $("#nature_of_business_id").append('<option value="" selected>Select Nature of Business</option>');
                      $.each(myArray, function (index, value) {
                        if(value.nature_of_business_id!=undefined){
                            $("#nature_of_business_id").append('<option value="'+ value.nature_of_business_id+'">' + value.name+'</option>');
                        }
                        
                      });
                }else{
                    alert('This nature of business name already existed!');
                }
            }
        });
    }
}
function EcoSystem()
{
  $('#EchoSystem-Modal').modal('show'); 
}
function Get_EchoSystem()
{
    var eco_system_practice_name=$('#eco_system_practice_name').val();
    if(eco_system_practice_name==''){
        alert('Please enter nature of eco system practice name');
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/check_eco_system_practice_existed'); ?>',
            type: 'POST',
            dataType: "json",
            data: {eco_system_practice_name: eco_system_practice_name},
            success: function(res) {
                if(res.get_eco_system_practice.res==1){
                    $('#EchoSystem-Modal').modal('hide');
                    alert('Eco System/Practice saved successfully');
                    $('#eco_system_practice_name').val('');
                      var myArray = res.get_eco_system_practice;
                      $('#eco_system_practice_id').find('option').remove();
                      $("#eco_system_practice_id").append('<option value="" selected>Select  Eco System/Practice</option>');
                      $.each(myArray, function (index, value) {
                        if(value.eco_system_practice_id!=undefined){
                            $("#eco_system_practice_id").append('<option value="'+ value.eco_system_practice_id+'">' + value.name+'</option>');
                        }
                        
                      });
                }else{
                    alert('This Eco System/Practice name already existed!');
                }
            }
        });
    }
}
function Remove(id,work_orders_document_id)
{
   if(id!='' && work_orders_document_id!=''){
      Swal.fire({
           text: "Are you sure want to delete this document ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Confirm'
         }).then((result) => {
               if (result.isConfirmed)
               {
                    $.ajax({
                       url: '<?php echo site_url('admin/delete_work_orders_documents'); ?>',
                       type: 'POST',
                       data: {work_orders_document_id: work_orders_document_id},
                       success: function(res) {
                          if(res==1){
                              $('.Remove_'+id).remove();
                          }else{
                              alert('Work Order Document Removed Failed...');
                          }
                       }
                  });
             }
      });
      
   }
}
</script>
