<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
          <div class="row mt-4" id="edu_div_<?php echo $sn;?>">
           <div class="col-12">
              <div class="form-group row align-items-end">
                 <div class="col-md-4">
                    <label>Type <span class="required-star">*</span></label>
                    <select class="form-control select2" name="type[]" id="type_<?php echo $sn;?>">
                      <option disabled selected value="">Select Type</option>
                            <?php if(!empty($types)){foreach ($types as $ty) {
                                ?>
                                 <option value="<?php echo @$ty['type_id']; ?>"><?php echo @$ty['name'];?></option>
                            <?php } } ?>
                        </select>
                 </div>
                 <a href="javascript:void(0);" class="btn-new btn-primary-new" onclick="create_type(<?php echo $sn;?>);"> Create Type</a>
                 <div class="col-md-4">
                    <label>Course <span class="required-star">*</span></label>
                    <select class="form-control select2" name="course[]" id="course_<?php echo $sn;?>">
                      <option disabled selected value="">Select Course</option>
                            <?php if(!empty($courses)){foreach ($courses as $cour) {
                                ?>
                                 <option value="<?php echo @$cour['course_id']; ?>"><?php echo @$cour['name'];?></option>
                            <?php } } ?>
                    </select>
                 </div>
                 <a href="javascript:void(0);" class="btn-new btn-primary-new" onclick="create_course(<?php echo $sn;?>);"> Create Course</a>
                 <div class="col-md-4">
                    <label>Specialisation <span class="required-star">*</span></label>
                    <input type="text" name="specialisation[]" class="form-control" id="specialisation_<?php echo $sn;?>" placeholder="Enter Specialisation">
                 </div>
              </div>
           </div>
           <div class="col-12">
              <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                       <label>Institution Name <span class="required-star">*</span></label>
                       <input type="text" name="institution_name[]" id="institution_name_<?php echo $sn;?>" class="form-control" placeholder="Enter  Institution Name">
                    </div>
                 </div>
                 <div class="col-md-6 form-group">
                    <label>Duration </label>
                    <div class="row">
                       <div class="col-6">
                          <input type="text" name="edu_duration_start[]" id="edu_duration_start_<?php echo $sn;?>" class="form-control" placeholder="Start">
                       </div>
                       <div class="col-6">
                          <input type="text" name="edu_duration_end[]" id="edu_duration_end_<?php echo $sn;?>" class="form-control" placeholder="End">
                       </div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="col-12 mt-3">
              <?php if($sn==1){ ?>
                <a href="javascript:void(0);" class="btn btn-primary" id="edu_more_<?php echo $sn;?>" onclick="edu_addmore(<?php echo $sn;?>)">Add Education/Certification Details</a>
                 <?php }else if($sn>1){ ?>
                  <a href="javascript:void(0);" class="btn btn-primary" id="edu_more_<?php echo $sn;?>" onclick="edu_addmore(<?php echo $sn;?>)">Add Education/Certification Details</a>
                  <a href="javascript:void(0);" class="btn btn-danger" id="edu_removemore_<?php echo $sn;?>" onclick="Deleterow(<?php echo $sn;?>)">Remove</a>
              <?php } ?>
           </div>
          </div>

     <!-- Company Modal -->
    <div class="modal fade" id="create-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="SNO" id="SNO">
               <label>Type Name <span class="required-star">*</span></label>
                <input class="form-control" placeholder="Enter Type Name" type="text" name="name" id="name" autocomplete="off">
                <span class="model_error"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="Get_type_and_course('t');">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Company Modal -->
    <div class="modal fade" id="create-course" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="CSNO" id="CSNO">
               <label>Course Name <span class="required-star">*</span></label>
                <input class="form-control" placeholder="Enter Course Name" type="text" name="Cname" id="Cname" autocomplete="off">
                <span class="model_error"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="Get_type_and_course('c');">Save</button>
          </div>
        </div>
      </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<script>
function edu_addmore(id)
{
  $.ajax({
        url: '<?php echo site_url('admin/add_edu_fields'); ?>',
        type: 'POST',
        data: {sn: id},
        dataType: 'html',
        success: function(data) {
        $("#edu_main_div").append(data);
        $("#edu_more_"+id).remove();
        }
    });
}
function Deleterow(sn)
{
  $("#edu_div_"+sn).remove();
  $("#edu_removemore_"+sn).remove(); 
  $(".edu_label_"+sn).remove();
}

function create_type(sn)
{
  $('#SNO').val(sn);
  $('#create-type').modal('show'); 
}
function create_course(sn)
{
  $('#CSNO').val(sn);
  $('#create-course').modal('show'); 
}
function Get_type_and_course(type)
{
    if(type=='t'){
      var sn=$('#SNO').val();
      var name=$('#name').val();
      var Text='type';
    }else{
      var sn=$('#CSNO').val();
      var name=$('#Cname').val();
      var Text='course';
    }
    if(name==''){
        alert('Please enter '+Text+' name');
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/check_type_course_existed'); ?>',
            type: 'POST',
            dataType: "json",
            data: {name: name,sn: sn,type: type},
            success: function(res) {
                if(res.getalltypes.res==1){
                    $('#create-type').modal('hide');
                    $('#create-course').modal('hide');
                    alert(Text+' name saved successfully');
                    $('#name').val('');
                    $('#Cname').val('');
                    $('#SNO').val('');
                    $('#CSNO').val('');
                      var myArray = res.getalltypes;
                      if(myArray.tc=='t'){
                          $("#type_"+sn).find('option').remove();
                          $("#type_"+sn).append('<option value="" selected>Select Type</option>');
                          $.each(myArray, function (index, value) {
                              if(value.type_id!=undefined){
                                $("#type_"+sn).append('<option value="'+ value.type_id+'">' + value.name+'</option>');
                              }
                          });
                      }else{
                        $("#course_"+sn).find('option').remove();
                        $("#course_"+sn).append('<option value="" selected>Select Course</option>');
                          $.each(myArray, function (index, value) {
                            if(value.course_id!=undefined){
                              $("#course_"+sn).append('<option value="'+ value.course_id+'">' + value.name+'</option>');
                            }
                          });
                      }
                }else{
                    alert('This '+Text+' name already existed!');
                }
            }
        });
    }
}
var sn='<?php echo $sn;?>';
$('#edu_duration_start_'+sn).Zebra_DatePicker({
        format: 'M-Y',
        pair: $('#edu_duration_end_'+sn)
});
$('#edu_duration_end_'+sn).Zebra_DatePicker({
        format: 'M-Y'
});
</script>