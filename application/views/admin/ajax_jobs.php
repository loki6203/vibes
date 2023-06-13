<ul class="delivery-manager-kanban-card-list">
   <li class="delivery-manager-kanban-card-item">
      <img class="kanban-card-item-profile" src="<?php echo base_url(); ?>/assets/admin/images/profile.png"/>
      <div class="delivery-manager-kanban-card-content">
         <div class="delivery-manager-kanban-card-content-title">
            <div class="kanban-card-content-title-info">
               <h4>Roopesh</h4>
               <p>Experience 2+ Years</p>
            </div>
            <div class="dropdown">
               <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
               <i class="fas fa-ellipsis-v"></i>
               </button>
               <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
               </div>
            </div>
         </div>
         <div class="delivery-manager-kanban-card-content-info">
            <div class="kanban-card-content-ratings">
               <p>+91 99887 73547</p>
               <ul class="rating-stars">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="far fa-star"></i></li>
                  <li><i class="far fa-star"></i></li>
               </ul>
            </div>
            <div class="kanban-card-content-date">
               <p>Praveen@gmail.com</p>
               <span><i class="far fa-clock"></i> <?php echo @$Date; ?>13 Oct 2022</span>
            </div>
            <select name="job-deatils" id="job-deatils" onChange="GetJobDetails(this);">
                <option value="source_applied">source/applied</option>
                <option value="contacted" selected="">contacted</option>
            </select>
         </div>
      </div>
   </li>
</ul>

<script>
function GetJobDetails(sel)
{
   var type = sel.value;
   $.ajax({
        url: '<?php echo site_url('admin/delivery_manager'); ?>',
        type: 'POST',
        data: {type: type},
        success: function(data) {
             $('#ppage').html(data);
        }
    });
}
</script>