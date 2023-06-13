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
               <?php if(@$maintenance['maintenance_id']!=''){ ?>
               <h4 class="font-size-18">Edit Maintenance</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Maintenance</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$maintenance['maintenance_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Maintenance</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Maintenance</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right ">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/maintenances" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_maintenance" id="save_maintenance" name="save_maintenance" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="maintenance_id" id="maintenance_id" class="form-control" value="<?php echo @$maintenance_id; ?>" required />
                     <div class="form-group row">
                       <label for="example-time-input" class="col-sm-2 col-form-label">Asset <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                            <select class="form-control select2" name="asset_id" id="asset_id" required>
                                <option value="">--Select Asset--</option>
                                <?php if(!empty($assets)){foreach ($assets as $asset) {
                                ?>
                                 <option value="<?php echo @$asset['asset_id']; ?>" <?php echo (@$asset['asset_id']==@$maintenance['asset_id'])?'selected':'';?>><?php echo @$asset['name'];?></option>
                               <?php } } ?>
                            </select>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Supplier<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                        <div class="app-new-supplier">
                           <select class="form-control" name="supplier_id" id="supplier_id" required>
                                <option value="">--Select Supplier--</option>
                                <?php if(!empty($suppliers)){foreach ($suppliers as $supplier) {
                                ?>
                                 <option value="<?php echo @$supplier['id']; ?>" <?php echo (@$supplier['id']==@$maintenance['supplier_id'])?'selected':'';?>><?php echo @$supplier['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('supplier');"><i class="mdi mdi-plus"></i></a>
                        </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Type <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                        <div class="app-new-supplier">
                            <select class="form-control" name="type_id" id="type_id" required>
                                <option value="">--Select Type--</option>
                                <?php if(!empty($types)){foreach ($types as $type) {
                                ?>
                                 <option value="<?php echo @$type['id']; ?>" <?php echo (@$type['id']==@$maintenance['type_id'])?'selected':'';?>><?php echo @$type['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('type');"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Start Date <span class="required-star">*</span></label>
                        <div class="col-sm-4 app-new-employee-button">
                           <div class="custom_date_field">
                              <?php if(@$maintenance['start_dt']==''){ ?>
                                 <input type="text" name="start_dt" id="start_dt" class="form-control" placeholder="Select Start Date" autocomplete="off" required value="<?php echo @$maintenance['start_dt']; ?>"/>
                              <?php } else { ?>
                                 <input type="text" name="start_dt" id="start_dt" class="form-control" placeholder="Select Start Date" autocomplete="off" required value="<?php echo @DD_MM_YY($maintenance['start_dt']); ?>"/>
                              <?php } ?>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> End Date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="custom_date_field">
                              <?php if(@$maintenance['end_dt']==''){ ?>
                                 <input type="text" name="end_dt" id="end_dt" class="form-control" placeholder="Select End Date" autocomplete="off" required value="<?php echo @$maintenance['end_dt']; ?>"/>
                              <?php } else { ?>
                                 <input type="text" name="end_dt" id="end_dt" class="form-control" placeholder="Select End Date" autocomplete="off" required value="<?php echo @DD_MM_YY($maintenance['end_dt']); ?>"/>
                              <?php } ?>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Comments</label>
                        <div class="col-sm-4">
                               <textarea name="comments" id="comments" placeholder="Enter Comments" class="form-control" cols="95" rows="4"><?php echo @$maintenance['comments']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/maintenances">Cancel</a>
                           <?php if(@$maintenance['maintenance_id']!=''){ ?>
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

<!-- Modal -->
    <div class="modal fade" id="Popup-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add <span class="heading-span"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <label><span class="heading-span"></span><span class="required-star">*</span></label>
                <input type="text" class="form-control" name="val" id="val" required autocomplete="off">
                <span class="model_error"></span>
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="myFormsave();">Save</button>
             </div>
          </div>
       </div>
    </div>
    <!-- End Modal -->

<script>
$(function(){
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

function ModelPopup(type)
{
    if(type=='supplier'){
      var typ='Supplier';
    }else{
      var typ='Type';
    }
    $('.heading-span').text(typ);
    $('#val').attr("placeholder", "Enter "+typ);
    $('#val').attr("data-id",typ);
    $('#Popup-Modal').modal('show'); 
}
function myFormsave()
{
  var val=$('#val').val();
  var type=$('#val').attr("data-id").toLowerCase();
  if(val==''){
      alert(type+" can not be left blank");
  }else{
      $.ajax({
          url: '<?php echo site_url('admin/ajax_save_asset_fields'); ?>',
          type: 'POST',
          data: {val: val,type: type},
          dataType: 'json',
          success: function(res){
              if(res.output.res==1)
              {
                  $('#Popup-Modal').modal('hide');
                  alert(type+' saved successfully...');
                  $('#val').val('');
                  var myArray = res.output;
                  if(type=='supplier')
                  { 
                     var id='supplier_id'; 
                     $('#'+id).find('option').remove();
                     $("#supplier_id").append('<option value="">--Select Supplier--</option>');
                  }else if(type=='type'){ 
                     var id='type_id'; 
                     $('#'+id).find('option').remove();
                     $("#type_id").append('<option value="">--Select Type--</option>');
                  }
                  $.each(myArray, function (index, value) {
                    if(value.id!=undefined){
                      $("#"+id).append('<option value="'+ value.id+'">' + value.name+'</option>');
                    }
                  });
              }else{
                  alert('This '+val+ 'already existed!');
              }
          }
      });
  }
}
</script>
