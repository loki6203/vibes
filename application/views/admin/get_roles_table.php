   <ul class="app-access-roles-table-tablehead">
      <li class="head-main-cell permissions-cell">Permissions</li>
      <li class="access-cell">Read</li>
      <li class="access-cell">Write</li>
   </ul>
   <div>
      <?php 
         $MenuName = $this->db->query("SELECT `menu_id`, `menu_name`, `menu_icon`, `is_active`, `created_at`, `updated_at` FROM `menu` WHERE `menu_name`!='Role Management'")->result_array();
         foreach ($MenuName as $Mnu) {
      ?>
      <h6 class="permissions-heading"><?php echo $Mnu['menu_name']; ?></h6>
      <div>
         <?php 
            $MenuId=$Mnu['menu_id'];
            $SubMenuName = $this->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `sub_menu_url`, `sub_menu_icon`, `access`, `read`, `write`, `is_active`, `created_at`, `updated_at` FROM `role_access` WHERE `role_id`=$role_id AND `menu_id`=$MenuId AND `sub_menu_name`!='Roles' AND `sub_menu_name`!='Roles Access'")->result_array();
            // echo $this->db->last_query();exit;
            $a=1;
            foreach ($SubMenuName as $SubMnu) {
         ?>
         <ul class="app-access-roles-table-tablebody">
            <li class="permissions-cell"><?php echo $SubMnu['sub_menu_name']; ?></li>
            <li class="access-cell">
               <div class="access-toggle-btn">
                  <input class="access-toggle-input" type="checkbox" class="d-none" id="read_id_<?php echo @$SubMnu['role_access_id']; ?>" onClick="Access(<?php echo @$SubMnu['role_access_id']; ?>,'Read');" value="<?php if(@$SubMnu['read']==1){echo 1;}else{ echo 0; } ?>" <?php if(@$SubMnu['read']==1){echo "checked";} ?> />
                  <label class="access-toggle-label access-toggle-label-no">No</label>
                  <label class="access-toggle-label access-toggle-label-yes" for="read_id_<?php echo @$SubMnu['role_access_id']; ?>">Yes</label>
               </div>
            </li>
            <li class="access-cell">
               <div class="access-toggle-btn">
                  <input class="access-toggle-input" type="checkbox" class="d-none" id="write_id_<?php echo @$SubMnu['role_access_id']; ?>" value="<?php if(@$SubMnu['write']==1){echo 1;}else{ echo 0; } ?>" <?php if(@$SubMnu['write']==1){echo "checked";} ?> onClick="Access(<?php echo @$SubMnu['role_access_id']; ?>,'Write');" />
                  <label class="access-toggle-label access-toggle-label-no">No</label>
                  <label class="access-toggle-label access-toggle-label-yes" for="write_id_<?php echo @$SubMnu['role_access_id']; ?>">Yes</label>
               </div>
            </li>
         </ul>
         <?php $a++;} ?>
      </div>
   <?php } ?>
   </div>
   <div>
      
   <div>
      <?php 
         $EmptySubMenuName = $this->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `sub_menu_url`, `sub_menu_icon`, `access`, `read`, `write`, `is_active`, `created_at`, `updated_at` FROM `role_access` WHERE `role_id`=$role_id AND `menu_id` IS NULL")->result_array();
         foreach ($EmptySubMenuName as $EmptySubMnu) {
      ?>
      <ul class="app-access-roles-table-tablebody">
         <li class="permissions-cell permissions-heading" style="font-weight: 600;
    color: #0c48af;
    font-size: 16px;
    text-align: left;
    padding: 0;
    margin: 15px 0 10px 0;"><?php echo $EmptySubMnu['sub_menu_name']; ?></li>
         <li class="access-cell">
            <div class="access-toggle-btn">
               <input class="access-toggle-input" type="checkbox" class="d-none" id="read_id_<?php echo @$EmptySubMnu['role_access_id']; ?>" value="<?php if(@$EmptySubMnu['read']==1){echo 1;}else{ echo 0; } ?>" <?php if(@$EmptySubMnu['read']==1){echo "checked";} ?> onClick="Access(<?php echo @$EmptySubMnu['role_access_id']; ?>,'Read');"/>
               <label class="access-toggle-label access-toggle-label-no">No</label>
               <label class="access-toggle-label access-toggle-label-yes" for="read_id_<?php echo @$EmptySubMnu['role_access_id']; ?>">Yes</label>
            </div>
         </li>
         <li class="access-cell">
            <div class="access-toggle-btn">
               <input class="access-toggle-input" type="checkbox" class="d-none" id="write_id_<?php echo @$EmptySubMnu['role_access_id']; ?>" value="<?php if(@$EmptySubMnu['write']==1){echo 1;}else{ echo 0; } ?>" <?php if(@$EmptySubMnu['write']==1){echo "checked";} ?> onClick="Access(<?php echo @$EmptySubMnu['role_access_id']; ?>,'Write');"/>
               <label class="access-toggle-label access-toggle-label-no">No</label>
               <label class="access-toggle-label access-toggle-label-yes" for="write_id_<?php echo @$EmptySubMnu['role_access_id']; ?>">Yes</label>
            </div>
         </li>
      </ul>
      <?php } ?>
   </div>

<script>
function Access(role_access_id,type)
{
    var role_id='<?php echo $role_id; ?>';
    if(type=="Read"){
      switch_val = $('#read_id_'+role_access_id).is(':checked')?'yes':'no';
    }else{
      switch_val = $('#write_id_'+role_access_id).is(':checked')?'yes':'no';
    }
    $.ajax({
          url: '<?php echo site_url('admin/update_roles_table'); ?>',
          type: 'POST',
          data: {role_access_id: role_access_id,type: type,role_id:role_id,switch_val:switch_val},
          success: function(data) {
              
          }
      });
}
</script>