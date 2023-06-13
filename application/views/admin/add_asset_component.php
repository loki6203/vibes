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
               <?php if(@$component['component_id']!=''){ ?>
               <h4 class="font-size-18">Edit Component</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Component</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$component['component_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Component</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Component</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right ">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/components" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_component" id="save_component" name="save_component" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="component_id" id="component_id" class="form-control" value="<?php echo @$component_id; ?>" />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Asset </label>
                        <div class="col-sm-4">
                           <select class="form-control select2" name="asset_id" id="asset_id">
                                <option value="">--Select Asset--</option>
                                <?php if(!empty($assets)){foreach ($assets as $asset) {
                                ?>
                                 <option value="<?php echo @$asset['asset_id']; ?>" <?php echo (@$asset['asset_id']==@$component['asset_id'])?'selected':'';?>><?php echo @$asset['name'];?></option>
                               <?php } } ?>
                            </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Name <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?php echo @$component['name']; ?>" required autocomplete="off" />
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Serial No<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="serial_no" id="serial_no" class="form-control" placeholder="Enter Serial No" value="<?php echo @$component['serial_no']; ?>" required autocomplete="off" />
                        </div>
                     </div>
                     <div class="form-group row">
                      <label for="example-time-input" class="col-sm-2 col-form-label"> Qty <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="qty" id="qty" class="form-control" placeholder="Enter Qty" value="<?php echo @$component['qty']; ?>" required autocomplete="off"/>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Supplier <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="app-new-supplier">
                           <select class="form-control" name="supplier_id" id="supplier_id" required>
                                <option value="">--Select Supplier--</option>
                                <?php if(!empty($suppliers)){foreach ($suppliers as $supplier) {
                                ?>
                                 <option value="<?php echo @$supplier['id']; ?>" <?php echo (@$supplier['id']==@$component['supplier_id'])?'selected':'';?>><?php echo @$supplier['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('supplier');"><i class="mdi mdi-plus"></i></a>
                     </div>
                        </div>
                     </div>
                     <div class="form-group row">
                       <label for="example-time-input" class="col-sm-2 col-form-label">Asset Type <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="app-new-supplier">
                            <select class="form-control" name="asset_type_id" id="asset_type_id" required>
                                <option value="">--Select Asset Type--</option>
                                <?php if(!empty($assettypes)){foreach ($assettypes as $assettype) {
                                ?>
                                 <option value="<?php echo @$assettype['id']; ?>" <?php echo (@$assettype['id']==@$component['asset_type_id'])?'selected':'';?>><?php echo @$assettype['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('assettype');"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Location<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                        <div class="app-new-supplier">
                           <select class="form-control" name="location_id" id="location_id" required>
                                <option value="">--Select Location--</option>
                                <?php if(!empty($locations)){foreach ($locations as $location) {
                                ?>
                                 <option value="<?php echo @$location['id']; ?>" <?php echo (@$location['id']==@$component['location_id'])?'selected':'';?>><?php echo @$location['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('location');"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                     </div>
                     <div class="form-group row">
                        
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Brand <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="app-new-supplier">
                            <select class="form-control" name="brand_id" id="brand_id" required>
                                <option value="">--Select Brand--</option>
                                <?php if(!empty($brands)){foreach ($brands as $brand) {
                                ?>
                                 <option value="<?php echo @$brand['id']; ?>" <?php echo (@$brand['id']==@$component['brand_id'])?'selected':'';?>><?php echo @$brand['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('brand');"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Cost <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="app-new-supplier">
                           <input type="text" name="cost" id="cost" class="form-control" placeholder="Enter Cost" value="<?php echo @$component['cost']; ?>" required autocomplete="off"/>
                           </div>
                              
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Purchase date <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <div class="custom_date_field">
                              <?php if(@$component['purchase_date']==''){ ?>
                                 <input type="text" name="purchase_date" id="purchase_date" class="form-control" placeholder="Select Purchase Date" autocomplete="off" required value="<?php echo @$component['start_dt']; ?>"/>
                              <?php } else { ?>
                                 <input type="text" name="purchase_date" id="purchase_date" class="form-control" placeholder="Select Purchase Date" autocomplete="off" required value="<?php echo @DD_MM_YY($component['purchase_date']); ?>"/>
                              <?php } ?>
                              <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                           </div>
                        </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Warranty <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                              <input type="text" name="warranty" id="warranty" class="form-control" placeholder="Enter Warranty" value="<?php echo @$component['warranty']; ?>" required autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">Status <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                        <div class="app-new-supplier">
                            <select class="form-control" name="status_id" id="status_id" required>
                                <option value="">--Select Status--</option>
                                <?php if(!empty($status)){foreach ($status as $statu) {
                                ?>
                                 <option value="<?php echo @$statu['id']; ?>" <?php echo (@$statu['id']==@$component['status_id'])?'selected':'';?>><?php echo @$statu['name'];?></option>
                               <?php } } ?>
                            </select>
                            <a class="btn new-supplier btn-primary dropdown-toggle waves-effect waves-light" href="javascript:void(0)" onclick="ModelPopup('status');"><i class="mdi mdi-plus"></i></a>
                        </div>
                     </div>
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Description</label>
                        <div class="col-sm-4">
                               <textarea name="description" id="description" placeholder="Enter Description" class="form-control" cols="95" rows="4"><?php echo @$component['description']; ?></textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Picture </label>
                        <div class="col-sm-4">
                             <input type="file" name="simage[]" id="simage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf" multiple onchange="checkFileUploadExt(this);" />
                              <?php if(!empty($documents)){$i=1;foreach ($documents as $docs) { ?>
                             <div class="Remove_<?php echo $i; ?>"><?php echo $i; ?>) <a href="<?php echo base_url(); ?>assets/asset_images/<?php echo $docs['img_path']; ?>" target="_blank"><?php echo $docs['img_name']; ?></a>&nbsp;&nbsp; <a href="javascript:void(0);" class="btn btn-danger" onclick="Remove(<?php echo $i; ?>,<?php echo $docs['component_document_id']; ?>);">Remove</a><br></div>
                           <?php $i++;} }?>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/components">Cancel</a>
                           <?php if(@$component['component_id']!=''){ ?>
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
$('#cost,#qty').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
});

$(function(){
    $("#purchase_date").datepicker();
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
        if((FileExt.toUpperCase()== "JPEG") || (FileExt.toUpperCase()== "JPG") || (FileExt.toUpperCase()== "PNG") || (FileExt.toUpperCase()== "PDF"))
        {
          
        }else{
          $('#simage').val('');
          alert('Please allowed jpeg, jpg, png, pdf formates only');
        }
    }
}
function ModelPopup(type)
{
    if(type=='supplier'){
      var typ='Supplier';
    }else if(type=='location'){
      var typ='Location';
    }else if(type=='brand'){
      var typ='Brand';
    }else if(type=='assettype'){
      var typ='Asset Type';
    }else if(type=='status'){
      var typ='Status';
    }else{
      var typ='';
    }
    $('.heading-span').text(typ);
    $('#val').attr("placeholder", "Enter "+typ);
    $('#val').attr("data-id",typ);
    $('#Popup-Modal').modal('show'); 
}
function Remove(id,component_document_id)
{
   if(component_id!=''){
      Swal.fire({
           text: "Are you sure want to delete this picture ?",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Confirm'
         }).then((result) => {
               if (result.isConfirmed)
               {
                    $.ajax({
                       url: '<?php echo site_url('admin/delete_asset_component_pictures'); ?>',
                       type: 'POST',
                       data: {component_document_id: component_document_id},
                       success: function(res) {
                          if(res==1){
                              $('.Remove_'+id).remove();
                          }else{
                              alert('Opps! Picture Removed Failed...');
                          }
                       }
                  });
             }
      });
      
   }
}
</script>
