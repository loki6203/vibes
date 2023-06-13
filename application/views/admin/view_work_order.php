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
               <h4 class="font-size-18">View Work Order</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">View Work Order</li>
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
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client Name <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="clinet_name" id="clinet_name" class="form-control keypress" placeholder="Enter Client Name" value="<?php echo @$work_orders['clinet_name']; ?>" autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Project Name<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="project_name" id="project_name" class="form-control keypress" placeholder="Enter Project Name" value="<?php echo @$work_orders['project_name']; ?>" autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Client Details <span class="required-star">*</span></label>
                        <div class="col-sm-6">
                          <textarea name="client_details" id="client_details" placeholder="Enter Client Details" class="form-control keypress" cols="95" rows="4" required><?php echo @$work_orders['client_details']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> PO Deal amount <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="PO_deal_amt" id="PO_deal_amt" class="form-control keypress" placeholder="Enter PO Deal amount" value="<?php echo @$work_orders['PO_deal_amt']; ?>" autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> PO<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="PO" id="PO" class="form-control keypress" placeholder="Enter PO" value="<?php echo @$work_orders['PO']; ?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Start Date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="custom_date_field">
                              <input type="text" name="start_dt" id="start_dt" class="form-control keypress" placeholder="Select Start Date" autocomplete="off" value="<?php echo @DD_M_YY($work_orders['start_dt']); ?>"/>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> End Date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="custom_date_field">
                              <input type="text" name="end_dt" id="end_dt" class="form-control keypress" placeholder="Select End Date" autocomplete="off" value="<?php echo @DD_M_YY($work_orders['end_dt']); ?>"/>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> PO Hrs <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="PO_Hrs" id="PO_Hrs" class="form-control keypress" placeholder="Enter PO Hrs" value="<?php echo @$work_orders['PO_Hrs']; ?>" autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Nature of Business <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="nature_of_business" id="nature_of_business" class="form-control keypress" placeholder="Enter Nature of Business" value="<?php echo @$work_orders['nature_of_business']; ?>" autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> No.of Resources <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                          <a href="javascript:void(0);" class="btn btn-info waves-effect waves-light" onclick="Cal();"><i class="fa fa-eye" style="color: #fff !important;"></i> View </a>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Eco System/Practice <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="eco_system_practice" id="eco_system_practice" class="form-control keypress" placeholder="Enter Eco System/Practice" value="<?php echo @$work_orders['eco_system_practice']; ?>" autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Year <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="year" id="year" class="form-control keypress" placeholder="Enter Year" value="<?php echo @$work_orders['year']; ?>" autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Recognized Amt <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="recognized_amt" id="recognized_amt" class="form-control keypress" placeholder="Enter Recognized Amt" value="<?php echo @$work_orders['recognized_amt']; ?>" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Backlog Amt <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="backlog_amt" id="backlog_amt" class="form-control keypress" placeholder="Enter Backlog Amt" value="<?php echo @$work_orders['backlog_amt']; ?>" autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> EMP Contribution <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="EMP_contribution" id="EMP_contribution" class="form-control keypress" placeholder="Enter EMP Contribution" value="<?php echo @$work_orders['EMP_contribution']; ?>" autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-3 col-form-label"> Upload Documents <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                          <?php if(!empty($work_orders_documents)){$i=1;foreach ($work_orders_documents as $docs) { ?>
                             <?php echo $i; ?>)<a href="<?php echo base_url(); ?>assets/work_orders/<?php echo $docs['file_path']; ?>" target="_blank"><?php echo $docs['file_name']; ?></a><br>
                           <?php $i++;} }?>
                        </div>
                     </div>
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
<script>
$(document).ready(function () {
  $("input,textarea").prop("readonly", true);
  $("input,textarea").css("background-color", "#d8d7d7");
});
function Cal()
{
    var work_orders_id='<?php echo $work_orders_id; ?>';
      $.ajax({
        url: '<?php echo site_url('admin/ajax_work_resources'); ?>',
        type: 'POST',
        data:{work_orders_id: work_orders_id,type: 'View'},
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
}
</script>
