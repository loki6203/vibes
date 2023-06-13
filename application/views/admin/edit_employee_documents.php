<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css">
<style type="text/css">
   .ck-editor__editable_inline {
   min-height: 200px;
   }
</style>
<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Edit Employee Document</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Employee Document</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_documents/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_employee_documents" id="save_employee_documents" name="save_employee_documents" enctype="multipart/form-data" class="custom-validation" onsubmit="return myForm();">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Employee</label>
                        <div class="col-sm-10">
                           <select class="form-control select2" name="emp_id" id="emp_id" required>
                              <option value="">Select Employee</option>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>" <?php echo $emp_id==$emp['emp_id']?'selected':'';?>><?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                    
                     <div class="form-group row">
                          <label for="itc" class="col-sm-2 col-form-label"> Documents Type</label>
                          <div class="col-sm-2 custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input chk_val" id="itc" name="itc"/>
                              <label class="custom-control-label" for="itc">ITC</label>
                          </div>
                          <div class="col-sm-2 custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input chk_val" id="criminal" name="criminal"/>
                              <label class="custom-control-label" for="criminal">Criminal</label>
                          </div>
                         <div class="col-sm-2 custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input chk_val" id="educational" name="educational"/>
                              <label class="custom-control-label" for="educational">Educational</label>
                          </div>
                         <div class="col-sm-2 custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input chk_val" id="references" name="references"/>
                              <label class="custom-control-label" for="references">References</label>
                          </div>
                     </div>
                     <?php 
                           foreach ($itc_details as $key => $res_itc) {
                            if($res_itc['doc_type']=='itc'){ 
                      ?>
                     <div class="form-group row ITC-DIV">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> ITC Documents</label>
                        <div class="col-sm-3">
                           <input type="file" name="itcimage[]" id="itcimage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf"/>
                        </div>
                        <?php if($key==0){ ?>
                        <div class="col-sm-3">
                           <button type="button" class="btn btn-primary waves-effect waves-light mr-1 itc_add_more">Add More</button>
                        </div>
                      <?php } ?>
                     </div>
                   <?php } } ?>
                   <div class="apped_add_more"></div>&nbsp;&nbsp;
                   <?php
                      $k2=1;
                      foreach ($documents as $cri_itc) {
                        if($cri_itc['doc_type']=='criminal'){ 
                    ?>
                     <div class="form-group row Criminal-DIV">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Criminal  Documents </label>
                        <div class="col-sm-3">
                           <input type="file" name="criminalimage[]" id="criminalimage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf"/>
                        </div>
                        <?php if($k2==1){ ?>
                        <div class="col-sm-3">
                           <button type="button" class="btn btn-primary waves-effect waves-light mr-1 criminal_add_more">Add More</button>
                        </div>
                      <?php } ?>
                     </div>
                     <?php $k2++;} } ?>
                     <div class="apped_criminal_add_more"></div>&nbsp;&nbsp;
                     <?php 
                      $k3=1;
                        foreach ($documents as $edu_itc) {
                          if($edu_itc['doc_type']=='educational'){ 
                      ?>
                     <div class="form-group row EDU-DIV">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Educational Documents </label>
                        <div class="col-sm-3">
                           <input type="file" name="educationalimage[]" id="educationalimage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf"/>
                        </div>
                         <?php if($k3==1){ ?>
                        <div class="col-sm-3">
                           <button type="button" class="btn btn-primary waves-effect waves-light mr-1 educational_add_more">Add More</button>
                        </div>
                      <?php } ?>
                     </div>
                     <?php $k3++;} } ?>
                     <div class="apped_educational_add_more"></div>&nbsp;&nbsp;
                     <?php
                        $k4=1;
                        foreach ($documents as $ref_itc) {
                          if($ref_itc['doc_type']=='references'){ 
                    ?>
                     <div class="form-group row REF-DIV">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Reference Documents </label>
                        <div class="col-sm-3">
                           <input type="file" name="referenceimage[]" id="referenceimage" class="form-control filestyle" accept="image/png, image/jpg, image/jpeg, application/pdf"/>
                        </div>
                         <?php if($k4==1){ ?>
                        <div class="col-sm-3">
                           <button type="button" class="btn btn-primary waves-effect waves-light mr-1 ref_add_more">Add More</button>
                        </div>
                      <?php } ?>
                     </div>
                   <?php $k4++;} } ?>
                     <div class="apped_ref_add_more"></div>&nbsp;&nbsp;
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/employee_documents/">Cancel</a>
                           <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Update</button>
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
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-select.min.js"></script>
<script>
$(document).ready(function(){
   // $('.ITC-DIV').hide();
   // $('.itc-add-more-div').hide();
   // $('.Criminal-DIV').hide();
   // $('.criminal-add-more-div').hide();
   // $('.EDU-DIV').hide();
   // $('.edu-add-more-div').hide();
   // $('.REF-DIV').hide();
   // $('.ref-add-more-div').hide();
});

function myForm(){
    var itc_chk = $('#itc').prop('checked');
    var cri_chk = $('#criminal').prop('checked');
    var edu_chk = $('#educational').prop('checked');
    var ref_chk = $('#references').prop('checked');
    var itcVal = $('#itcimage').val().split('\\').pop();
    var itcVal2 = $('#criminalimage').val().split('\\').pop();
    var itcVal3 = $('#educationalimage').val().split('\\').pop();
    var itcVal4 = $('#referenceimage').val().split('\\').pop();
    alert(itc_chk);
    if(itc_chk==false && cri_chk==false && edu_chk==false && ref_chk==false){
         alert("Please choose atleast one document type");
         return false;
    }else if(itc_chk==true && itcVal==''){
         alert("Please choose itc document");
         return false;
    }else if(cri_chk==true && itcVal2==''){
         alert("Please choose criminal document");
         return false;
    }else if(edu_chk==true && itcVal3==''){
         alert("Please choose educational document");
         return false;
    }else if(ref_chk==true && itcVal4==''){
         alert("Please choose references document");
         return false;
    }else{

    }

}


$('#itc').click(function() {
    var isChk = $('#itc').prop('checked');
    if(isChk==true){
      $('.ITC-DIV').show();
    }else{
      $('.ITC-DIV').hide();
      $('.itc-add-more-div').hide();
    }
});
$('#criminal').click(function() {
    var isChk = $('#criminal').prop('checked');
    if(isChk==true){
      $('.Criminal-DIV').show();
    }else{
      $('.Criminal-DIV').hide();
      $('.criminal-add-more-div').hide();
    }
});

$('#educational').click(function() {
    var isChk = $('#educational').prop('checked');
    alert(isChk);
    if(isChk==true){
      $('.EDU-DIV').show();
    }else{
      $('.EDU-DIV').hide();
      $('.edu-add-more-div').hide();
    }
});

$('#references').click(function() {
    var isChk = $('#references').prop('checked');
    if(isChk==true){
      $('.REF-DIV').show();
    }else{
      $('.REF-DIV').hide();
      $('.ref-add-more-div').hide();
    }
});

var i=2;
 $(".itc_add_more").click(function(){ 
      var cout = 'certtprvw_'+i;
      var html = $(".apped_add_more").append('<div class="row itc-add-more-div"><label for="example-time-input" class="col-sm-2 col-form-label"> ITC Documents</label><div class="col-sm-4"><div class="bootstrap-filestyle input-group"><div name="filedrag" style="position: absolute; width: 100px; height: 35px; z-index: -1;"></div><input type="text" disabled="" name="itcimage[]" id="itcimage' + i + '" class="form-control" accept="image/png, image/jpg, image/jpeg, application/pdf" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="itcimage" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><button type="button" class="remove_add_more btn btn-danger waves-effect waves-light mr-1">Remove</button></div></div></div></div></div>&nbsp;&nbsp;');
      i++;
 });

 $("body").on("click",".remove_add_more",function(){ 
          $(this).parents(".itc-add-more-div").remove();
 });

 $(".criminal_add_more").click(function(){ 
      var html = $(".apped_criminal_add_more").append('<div class="row criminal-add-more-div"><label for="example-time-input" class="col-sm-2 col-form-label"> Criminal Documents</label><div class="col-sm-4"><div class="bootstrap-filestyle input-group"><div name="filedrag" style="position: absolute; width: 100px; height: 35px; z-index: -1;"></div><input type="text" disabled="" name="criminalimage[]" class="form-control" accept="image/png, image/jpg, image/jpeg, application/pdf" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;" data-parsley-id="21"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="criminalimage" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><button type="button" class="remove_criminal_add_more btn btn-danger waves-effect waves-light mr-1">Remove</button></div></div></div></div></div>&nbsp;&nbsp;');
 });

 $("body").on("click",".remove_criminal_add_more",function(){ 
          $(this).parents(".criminal-add-more-div").remove();
});

$(".educational_add_more").click(function(){ 
      var html = $(".apped_educational_add_more").append('<div class="row edu-add-more-div"><label for="example-time-input" class="col-sm-2 col-form-label"> Educational Documents</label><div class="col-sm-4"><div class="bootstrap-filestyle input-group"><div name="filedrag" style="position: absolute; width: 100px; height: 35px; z-index: -1;"></div><input type="text" disabled="" name="educationalimage[]" class="form-control" accept="image/png, image/jpg, image/jpeg, application/pdf" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;" data-parsley-id="21"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="criminalimage" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><button type="button" class="remove_edu_add_more btn btn-danger waves-effect waves-light mr-1">Remove</button></div></div></div></div></div>&nbsp;&nbsp;');
 });

 $("body").on("click",".remove_edu_add_more",function(){ 
          $(this).parents(".edu-add-more-div").remove();
});

$(".ref_add_more").click(function(){ 
      var html = $(".apped_ref_add_more").append('<div class="row ref-add-more-div"><label for="example-time-input" class="col-sm-2 col-form-label"> Reference Documents</label><div class="col-sm-4"><div class="bootstrap-filestyle input-group"><div name="filedrag" style="position: absolute; width: 100px; height: 35px; z-index: -1;"></div><input type="text" disabled="" name="referenceimage[]" class="form-control" accept="image/png, image/jpg, image/jpeg, application/pdf" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;" data-parsley-id="21"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="criminalimage" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><button type="button" class="remove_ref_add_more btn btn-danger waves-effect waves-light mr-1">Remove</button></div></div></div></div></div>&nbsp;&nbsp;');
 });

 $("body").on("click",".remove_ref_add_more",function(){ 
          $(this).parents(".ref-add-more-div").remove();
});
</script>