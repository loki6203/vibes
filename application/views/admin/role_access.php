<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
   <div class="row align-items-center">
      <div class="col-md-6">
         <div class="page-title-box">
            <h4 class="font-size-18">Access Roles</h4>
            <ol class="breadcrumb mb-0">
               <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
               <li class="breadcrumb-item active"> Access Roles</li>
            </ol>
         </div>
      </div>
   </div>
   <div class="app-access-roles">
      <div class="app-access-roles-select">
       <div class="row">
         <div class="col-md-6 col-lg-3">
            <form>
               <div class="form-group">
                  <label class="control-label">You are viewing:</label>
                  <select class="form-control select2" name="roles_id" id="roles_id" onChange="Getroles();">
                    <option value="">-- Select Role --</option>
                    <?php if(count($roles)>0){foreach($roles as $rles){ ?>
                    <option value="<?php echo $rles['roles_id'];?>"><?php echo $rles['role_name'];?></option>
                    <?php } } ?>
                 </select>  
               </div>
            </form>
         </div>
       </div>
      </div>
      <div class="mobile-overflow-wrapper">
         <div class="app-access-roles-table roles_table">
    
         </div>
      </div>
   </div>
</div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-select.min.js"></script>
<script>
function Getroles()
{
    var role_id=$('#roles_id').val();
    if(role_id!=''){
        $.ajax({
          url: '<?php echo site_url('admin/get_roles_table'); ?>',
          type: 'POST',
          data: {role_id: role_id},
          success: function(data) {
              $('.roles_table').html(data);
          }
      });
    }else{
      $('.roles_table').html('<span style="color: red;margin-left: 390px;">no data found</span>');
    }
}
</script>
