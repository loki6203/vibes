<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <?php if(@$eco_system_practice['eco_system_practice_id']!=''){ ?>
               <h4 class="font-size-18">Edit Eco System/Practice</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Eco System/Practice</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$eco_system_practice['eco_system_practice_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Eco System/Practice</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Eco System/Practice</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/eco_system_practice/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_eco_system_practice" id="save_eco_system_practice" name="save_nature_of_business" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="eco_system_practice_id" id="eco_system_practice_id" class="form-control" value="<?php echo @$eco_system_practice['eco_system_practice_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-3 col-form-label"> Eco System/Practice<span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Eco System/Practice" value="<?php echo @$eco_system_practice['name']; ?>" required autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/eco_system_practice/">Cancel</a>
                           <?php if(@$eco_system_practice['eco_system_practice_id']!=''){ ?>
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
