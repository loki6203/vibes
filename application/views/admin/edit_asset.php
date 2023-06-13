<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css">
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
<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor.js"></script>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">Edit Employee Asset</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Employee Asset</li>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
               <div class="dropdown">
                  <a class="btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/asset/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/update_asset" id="update_asset" name="update_asset" enctype="multipart/form-data" class="custom-validation" onsubmit="return checkFormValidate();">
                    <input type="hidden" name="asset_id" id="asset_id" value="<?php echo $asset['asset_id']; ?>">
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Select Employee</label>
                        <div class="col-sm-10">
                           <select class="form-control select2" name="emp_id" id="emp_id" required>
                              <?php if(count($employees)>0){foreach($employees as $emp){ ?>
                              <option value="<?php echo $emp['emp_id'];?>" <?php echo ($emp['emp_id']==$asset['emp_id'])?'selected':'';?>><?php echo $emp['fname'];?><?php echo $emp['lname'];?> (<?php echo $emp['emp_code'];?>)</option>
                              <?php } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input emialid" class="col-sm-2 col-form-label">Laptop Serial No </label>
                        <div class="col-sm-10">
                           <input type="text" name="laptop_serial_no" id="laptop_serial_no" class="form-control" placeholder="Select Laptop Serial No" value="<?php echo $asset['laptop_serial_no']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Laptop Model No </label>
                        <div class="col-sm-10">
                           <input type="text" name="laptop_model" id="laptop_model" class="form-control" placeholder="Enter Laptop Model No" value="<?php echo $asset['laptop_model']; ?>" required/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">Charger Provided </label>
                        <div class="col-sm-10">
                          <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="ChargerProvided" name="charger_provided" class="custom-control-input" value="Yes" <?php echo ($asset['charger_provided']== 'Yes') ?  "checked" : "" ;  ?>>
                              <label class="custom-control-label" for="ChargerProvided">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="ChargerProvided2" name="charger_provided" class="custom-control-input" value="No" <?php echo ($asset['charger_provided']== 'No') ?  "checked" : "" ;  ?>>
                                <label class="custom-control-label" for="ChargerProvided2">No</label>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Charger Provided No </label>
                        <div class="col-sm-10">
                           <input type="text" name="charger_provided_no" id="charger_provided_no" class="form-control keupinput" placeholder="Enter Charger Provided No" value="<?php echo $asset['charger_provided_no']; ?>"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">Mouse Provided </label>
                        <div class="col-sm-10">
                          <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="MouseProvided" name="mouse_provided" class="custom-control-input" value="Yes" <?php echo ($asset['mouse_provided']== 'Yes') ?  "checked" : "" ;  ?>>
                              <label class="custom-control-label" for="MouseProvided">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="MouseProvided2" name="mouse_provided" class="custom-control-input" value="No" <?php echo ($asset['mouse_provided']== 'No') ?  "checked" : "" ;  ?>>
                                <label class="custom-control-label" for="MouseProvided2">No</label>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Mouse Provided No </label>
                        <div class="col-sm-10">
                           <input type="text" name="mouse_provided_no" id="mouse_provided_no" class="form-control keupinput" placeholder="Enter Mouse Provided No" value="<?php echo $asset['mouse_provided_no']; ?>"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">UPS Provided </label>
                        <div class="col-sm-10">
                          <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="UPSProvided" name="ups_provided" class="custom-control-input" value="Yes" <?php echo ($asset['ups_provided']== 'Yes') ?  "checked" : "" ;  ?>>
                              <label class="custom-control-label" for="UPSProvided">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="UPSProvided2" name="ups_provided" class="custom-control-input" value="No" <?php echo ($asset['ups_provided']== 'No') ?  "checked" : "" ;  ?>>
                                <label class="custom-control-label" for="UPSProvided2">No</label>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> UPS Provided No </label>
                        <div class="col-sm-10">
                           <input type="text" name="ups_provided_no" id="ups_provided_no" class="form-control keupinput" placeholder="Enter UPS Provided No" value="<?php echo $asset['ups_provided_no']; ?>"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label">Carry Case Provided </label>
                        <div class="col-sm-10">
                          <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="CarrycaseProvided" name="carrycase_provided" class="custom-control-input" value="Yes" <?php echo ($asset['carrycase_provided']== 'Yes') ?  "checked" : "" ;  ?>>
                              <label class="custom-control-label" for="CarrycaseProvided">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="CarrycaseProvided2" name="carrycase_provided" class="custom-control-input" value="No" <?php echo ($asset['carrycase_provided']== 'No') ?  "checked" : "" ;  ?>>
                                <label class="custom-control-label" for="CarrycaseProvided2">No</label>
                            </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Carry Case Provided No </label>
                        <div class="col-sm-10">
                           <input type="text" name="carrycase_provided_no" id="carrycase_provided_no" class="form-control keupinput" placeholder="Enter Carry Case Provided No" value="<?php echo $asset['carrycase_provided_no']; ?>"/>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-2 col-form-label"> Asset Assign Date </label>
                        <div class="col-sm-10">
                            <div class="custom_date_field">
                                <input type="text" name="asset_assigned_date" id="asset_assigned_date" class="form-control keupinput" placeholder="Select Asset Assign Date" value="<?php echo DD_MM_YY($asset['asset_assigned_date']); ?>" autocomplete="off" required/>
                                <img src="<?php echo base_url(); ?>/assets/admin/images/calendar.svg"/>
                            </div>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/asset/">Cancel</a>
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
        var GetVal = $("input[name='charger_provided']:checked").val();
        if(GetVal=='No'){
            $("#charger_provided_no").attr("disabled", "disabled"); 
            $("#charger_provided_no").css('background-color', '#ececf1');

        }else{
            $("#charger_provided_no").removeAttr("disabled");
            $("#charger_provided_no").css('background-color', ''); 
        }
        var GetVal2 = $("input[name='mouse_provided']:checked").val();
        if(GetVal2=='No'){
            $("#mouse_provided_no").attr("disabled", "disabled"); 
            $("#mouse_provided_no").css('background-color', '#ececf1');

        }else{
            $("#mouse_provided_no").removeAttr("disabled");
            $("#mouse_provided_no").css('background-color', ''); 
        }
        var GetVal3 = $("input[name='ups_provided']:checked").val();
        if(GetVal3=='No'){
            $("#ups_provided_no").attr("disabled", "disabled"); 
            $("#ups_provided_no").css('background-color', '#ececf1');

        }else{
            $("#ups_provided_no").removeAttr("disabled");
            $("#ups_provided_no").css('background-color', ''); 
        }
        var GetVal4 = $("input[name='carrycase_provided']:checked").val();
        if(GetVal4=='No'){
            $("#carrycase_provided_no").attr("disabled", "disabled"); 
            $("#carrycase_provided_no").css('background-color', '#ececf1');

        }else{
            $("#carrycase_provided_no").removeAttr("disabled");
            $("#carrycase_provided_no").css('background-color', ''); 
        }
  });


    $(function(){
        $("#asset_assigned_date").datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'dd-mm-yy',
          yearRange: '-60:+10'
        });
     });
  
    $('input[name="charger_provided"]:radio').change(function () {
        var GetVal = $("input[name='charger_provided']:checked").val();
        if(GetVal=='No'){
            $("#charger_provided_no").val("");
            $("#charger_provided_no").attr("disabled", "disabled"); 
            $("#charger_provided_no").css('background-color', '#ececf1');

        }else{
            $("#charger_provided_no").removeAttr("disabled");
            $("#charger_provided_no").css('background-color', ''); 
        }
    });
    $('input[name="mouse_provided"]:radio').change(function () {
        var GetVal = $("input[name='mouse_provided']:checked").val();
        if(GetVal=='No'){
            $("#mouse_provided_no").val("");
            $("#mouse_provided_no").attr("disabled", "disabled"); 
            $("#mouse_provided_no").css('background-color', '#ececf1');

        }else{
            $("#mouse_provided_no").removeAttr("disabled");
            $("#mouse_provided_no").css('background-color', ''); 
        }
    });
    $('input[name="ups_provided"]:radio').change(function () {
        var GetVal = $("input[name='ups_provided']:checked").val();
        if(GetVal=='No'){
            $("#ups_provided_no").val("");
            $("#ups_provided_no").attr("disabled", "disabled"); 
            $("#ups_provided_no").css('background-color', '#ececf1');

        }else{
            $("#ups_provided_no").removeAttr("disabled");
            $("#ups_provided_no").css('background-color', ''); 
        }
    });
    $('input[name="carrycase_provided"]:radio').change(function () {
        var GetVal = $("input[name='carrycase_provided']:checked").val();
        if(GetVal=='No'){
            $("#carrycase_provided_no").val("");
            $("#carrycase_provided_no").attr("disabled", "disabled"); 
            $("#carrycase_provided_no").css('background-color', '#ececf1');

        }else{
            $("#carrycase_provided_no").removeAttr("disabled");
            $("#carrycase_provided_no").css('background-color', ''); 
        }
    });

  function checkFormValidate()
  {

      var GetVal = $("input[name='charger_provided']:checked").val();
      var GetVal2 = $("input[name='mouse_provided']:checked").val();
      var GetVal3 = $("input[name='ups_provided']:checked").val();
      var GetVal4 = $("input[name='carrycase_provided']:checked").val();
      if(GetVal=='Yes'){
          var charger_provided_no=$('#charger_provided_no').val();
          if(charger_provided_no==''){
              alert("Please enter charger provided number");
              return false;
          }
      }
      else if(GetVal2=='Yes'){
          var mouse_provided_no=$('#mouse_provided_no').val();
          if(mouse_provided_no==''){
              alert("Please enter mouse provided number");
              return false;
          }
      }
      else if(GetVal3=='Yes'){
          var ups_provided_no=$('#ups_provided_no').val();
          if(ups_provided_no==''){
              alert("Please enter UPS provided number");
              return false;
          }
      }
      else if(GetVal4=='Yes'){
          var carrycase_provided_no=$('#carrycase_provided_no').val();
          if(carrycase_provided_no==''){
              alert("Please enter carry case provided number");
              return false;
          }
      }
  }
</script>