<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <?php if(@$nature_of_business['nature_of_business_id']!=''){ ?>
               <h4 class="font-size-18">Edit Nature of Business</h4>
               <?php } else { ?>
               <h4 class="font-size-18">Add Nature of Business</h4>
               <?php } ?>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <?php if(@$nature_of_business['nature_of_business_id']!=''){ ?>
                  <li class="breadcrumb-item active">Edit Nature of Business</li>
                  <?php } else { ?>
                  <li class="breadcrumb-item active">Add Nature of Business</li>
                  <?php } ?>
               </ol>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="float-right">
               <div class="dropdown">
                  <a class="btn app-new-employee-button btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/nature_of_business/" >
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
                  <form method="post" action="<?php echo base_url(); ?>admin/save_nature_of_business" id="save_nature_of_business" name="save_nature_of_business" enctype="multipart/form-data" class="custom-validation">
                     <input type="hidden" name="nature_of_business_id" id="nature_of_business_id" class="form-control" value="<?php echo @$nature_of_business['nature_of_business_id']; ?>" required />
                     <div class="form-group row">
                        <label for="example-time-input" class="col-sm-3 col-form-label"> Nature of Business <span class="required-star">*</span></label>
                        <div class="col-sm-4">
                           <input type="text" name="name" id="name" class="form-control" placeholder="Enter Nature of Business" value="<?php echo @$nature_of_business['name']; ?>" required autocomplete="off"/>
                        </div>
                     </div>
                     <div class="form-group mb-0 float-right">
                        <div>
                           <a class="btn btn-danger waves-effect waves-light" href="<?php echo base_url(); ?>admin/nature_of_business/">Cancel</a>
                           <?php if(@$nature_of_business['nature_of_business_id']!=''){ ?>
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
