<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="app-recruitment-create-header">
                <ul>
                    <li>
                        <a class="active" href="#">
                            <h3 class="card-title mb-1">About Job</h3>
                            <p class="card-title-desc mb-0">Tell applicants why it’s great to work at your company.</p>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <!-- <form method="post" name="myForm" id="myForm" class="custom-validation" onsubmit="return Save_Job();"> -->
            <div class="app-recruitment-create py-4">
                <h3 class="app-recruitment-create-heading">What's the job you're hiring for ? <i data-toggle="tooltip" data-placement="bottom" title="Enter basic details about the job that your applicants will see." class="fas fa-info-circle"></i></h3>
                <div class="">
                    <input type="hidden" name="job_id" id="job_id" value="<?php echo @$jobs['job_id']; ?>">
                    <div class="form-group">
                        <label>Job Title <span class="required-star">*</span></label>
                        <input class="form-control" type="text" name="job_title" id="job_title" value="<?php echo @$jobs['job_title']; ?>" required>
                    </div>
                    <div class="form-group row align-items-end">
                        <div class="col-md-4">
                            <label>Company <span class="required-star">*</span></label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                <option disabled selected value="">Select Company</option>
                                <?php if(!empty($companys)){foreach ($companys as $cmp) {
                                ?>
                                 <option value="<?php echo @$cmp['company_id']; ?>" <?php echo (@$cmp['company_id']==@$jobs['company_id'])?'selected':'';?>><?php echo @$cmp['company_name'];?></option>
                               <?php } } ?>
                            </select>
                        </div>
                        <a href="#" class="btn-new app-new-create-button-2 btn-primary-new" onclick="create_company();"> Create Company</a>
                    </div>
                    <div class="form-group row align-items-end">
                        <div class="col-md-4 app-new-creat-job-form-group">
                            <label>Department <span class="required-star">*</span></label>
                            <input type="text" name="department" class="form-control col-sm-12" data-role="tagsinput" id="department" placeholder="Department ..." value="<?php echo @$jobs['department']; ?>">
                        </div>
                        <div class="col-md-4 app-new-creat-job-form-group">
                            <label>Location <span class="required-star">*</span></label>
                            <input type="text" name="location" class="form-control col-sm-12" data-role="tagsinput" id="location" placeholder="Location ..." value="<?php echo @$jobs['location']; ?>">
                        </div>
                        <div class="col-md-4 app-new-creat-job-form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remote_in_career_page" id="remote_in_career_page" required>
                                <label class="custom-control-label" for="remote_in_career_page">List this job as Remote in Career Page.</label>
                            </div>
                        </div> 
                    </div>
                </div>
                <h3 class="mt-4 app-recruitment-create-heading">Fill in some details for the job  <i data-toggle="tooltip" data-placement="bottom" title="All these details will be visible to your candidates and can be changed later on." class="fas fa-info-circle"></i></h3>
                <div class="form-group">
                    <label>Job Description <span class="required-star">*</span></label>
                        <textarea id="job_description" name="job_description" required><?php echo @$jobs['job_description']; ?></textarea>
                </div>
           
                <div class="form-group row mt-4">
                    <div class="col-md-6 col-lg-4 app-new-creat-job-form-group">
                        <label>Employment Type <span class="required-star">*</span></label>
                        <select class="form-control select2" name="employment_type" id="employment_type" required>
                            <option disabled selected value="">Select</option>
                              <option value="Full-Time"<?php if(@$jobs['employment_type'] == 'Full-Time') { ?> selected="selected"<?php } ?>>Full-Time</option>
                              <option value="Part-Time"<?php if(@$jobs['employment_type'] == 'Part-Time') { ?> selected="selected"<?php } ?>>Part-Time</option>
                              <option value="Contract"<?php if(@$jobs['employment_type'] == 'Contract') { ?> selected="selected"<?php } ?>>Contract</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 app-new-creat-job-form-group">
                        <label>Seniority Level <span class="required-star">*</span></label>
                        <select class="form-control select2" name="seniority_level" id="seniority_level" required>
                            <option disabled selected value="">Select</option>
                            <option value="Beginner"<?php if(@$jobs['seniority_level'] == 'Beginner') { ?> selected="selected"<?php } ?>>Beginner</option>
                            <option value="Intermediate"<?php if(@$jobs['seniority_level'] == 'Intermediate') { ?> selected="selected"<?php } ?>>Intermediate</option>
                            <option value="Experienced"<?php if(@$jobs['seniority_level'] == 'Experienced') { ?> selected="selected"<?php } ?>>Experienced</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-4 col-lg-4 app-new-creat-job-form-group">
                        <label>Industry Type </label>
                        <input type="text" name="industry_type" class="form-control col-sm-12" data-role="tagsinput" id="industry_type" placeholder="Industry Type ..." value="<?php echo @$jobs['industry_type']; ?>">
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-lg-12 col-xl-8">
                        <label class="control-label">Salary Range(CTC)</label>
                        <div class="input-group row">
                            <div class="col-md-4 app-new-creat-job-form-group">
                                <select class="w-100 form-control select2" name="salary_range" id="salary_range" required>
                                    <option value="Annual">Annual</option>
                                    <option value="Monthly">Monthly</option>
                                </select>
                            </div>
                            <div class="col-md-4 app-new-creat-job-form-group">
                            <input class="form-control" placeholder="Minimum" type="number" name="minimum" id="minimum" required value="<?php echo @$jobs['minimum']; ?>">
                            </div>
                            <div class="col-md-4 app-new-creat-job-form-group">
                            <input class="form-control" placeholder="Maximum" type="number" name="maximum" id="maximum" required value="<?php echo @$jobs['maximum']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-4 mt-3 mt-xl-0">
                        <label>Work Experience(in Years) <span class="required-star">*</span></label>
                        <div class="input-group row">
                            <div class="col-md-6 app-new-creat-job-form-group">
                            <input class="form-control" placeholder="From" type="number" name="work_experience_from" id="work_experience_from" required value="<?php echo @$jobs['work_experience_from']; ?>">
                            </div>
                            <div class="col-md-6">
                            <input class="form-control" placeholder="To" type="number" name="work_experience_to" id="work_experience_to" required value="<?php echo @$jobs['work_experience_to']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col-md-4 app-new-creat-job-form-group">
                        <label class="w-100">Skills 
                        <span class="required-star">*</span>
                        <span class="required-star-2">(Click enter to add Skills)</span>
                        </label>
                        <input type="text" name="skills" class="form-control col-sm-12" data-role="tagsinput" id="skills" placeholder="Skills ..." value="<?php echo @$jobs['skills']; ?>">
                    </div>
                    <div class="col-md-4 app-new-creat-job-form-group">
                        <label>Education <span class="required-star">*</span></label>
                        <input type="text" name="education" class="form-control col-sm-12" data-role="tagsinput" id="education" placeholder="Education ..." value="<?php echo @$jobs['education']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Number of Openings</label>
                        <input class="form-control" type="text" name="number_of_openings" id="number_of_openings" required value="<?php echo @$jobs['number_of_openings']; ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-secondary mr-3" name="Cancel" onclick="Cancel();">Cancel</button>
                    <button class="btn btn-primary" name="Preview" onclick="Save_Job()">Preview & Proceed</button>
                </div>
            </div>
          <!-- </form> -->
        </div>
    </div>


    <div class="modal fade bs-example-modal-xl" id="preview-job-dialog"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Preview Job Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <input type="hidden" name="model_edit_id" id="model_edit_id">
                <div class="modal-body">
                    <div class="preview-job-dialog-content">
                        <div class="preview-job-dialog-heading">
                            <h1 class="model_job_title"></h1>
                            <ul class="d-flex align-items-center p-0 m-0 list-style-none">
                                <li class="model_location"></li>
                                <li class="mx-3">|</li>
                                <li class="model_department"></li>
                            </ul>
                        </div>
                        <div class="preview-job-dialog-body-wrapper d-flex">
                            <div class="preview-job-dialog-body-left p-3">
                                <div class="model_job_description"></div>
                            </div>
                            <div class="preview-job-dialog-body-right p-3">
                                <ul class="p-0 m-0 list-style-none d-flex flex-column">
                                    <li class="mb-2">
                                        <h6 class="mb-2">Employment Type </h6>
                                        <p class="model_employment_type"></p>
                                    </li>
                                    <li class="mb-2">
                                        <h6 class="mb-2">Seniority Level  </h6>
                                        <p class="model_seniority_level"></p>
                                    </li>
                                    <li class="mb-2">
                                        <h6 class="mb-2">Industry Type  </h6>
                                        <p class="model_industry_type"></p>
                                    </li>
                                    <li class="mb-2">
                                        <h6 class="mb-2">Skills </h6>
                                        <ul class="preview-job-dialog-skills model_skills">
                                            <li></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-primary" onclick="Proceed();">Proceed</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Company Modal -->
    <div class="modal fade" id="create-company" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
               <label>Company Name <span class="required-star">*</span></label>
                <input class="form-control" placeholder="Enter company name" type="text" name="company_name" id="company_name" required autocomplete="off">
                <span class="model_error"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="Get_company();">Save</button>
          </div>
        </div>
      </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<script>
function Save_Job()
{
    var job_id=$('#job_id').val();
    var model_edit_id=$('#model_edit_id').val();
    var job_title=$('#job_title').val();
    // alert(job_title);
    var company_id=$('#company_id').val();
    var department=$('#department').val();
    var location=$('#location').val();
    var remote_in_career_page=$('#remote_in_career_page').prop("checked") ? 1 : 0 ;
    var job_description=tinyMCE.activeEditor.getContent();
    $('.model_job_description').html(job_description);
    var employment_type=$('#employment_type').val();
    var seniority_level=$('#seniority_level').val();
    var industry_type=$('#industry_type').val();
    var salary_range=$('#salary_range').val();
    var minimum=$('#minimum').val();
    var maximum=$('#maximum').val();
    var work_experience_from=$('#work_experience_from').val();
    var work_experience_to=$('#work_experience_to').val();
    var skills=$('#skills').val();
    var education=$('#education').val();
    var number_of_openings=$('#number_of_openings').val();
    if(job_title=='' || company_id=='' || location=='' || job_description=='' || employment_type=='' || seniority_level=='' || work_experience_from=='' || work_experience_to=='' || skills=='' || education==''){
      alert('please fill all required fields');
      return false;
    }else{
        $('#preview-job-dialog').modal('show'); 
        $.ajax({
            url: '<?php echo site_url('admin/save_job'); ?>',
            type: 'POST',
            dataType: "json",
            data: {job_id: job_id,model_edit_id: model_edit_id,job_title: job_title,company_id: company_id,department: department,location: location,remote_in_career_page: remote_in_career_page,job_description: job_description,employment_type: employment_type,seniority_level: seniority_level,industry_type: industry_type,salary_range: salary_range,minimum: minimum,maximum: maximum,work_experience_from: work_experience_from,work_experience_to: work_experience_to,skills: skills,education: education,number_of_openings: number_of_openings},
            success: function(res)
            {
                if(res==0){
                   alert('Opps! something went to wrong...');
                }else{
                  $('#model_edit_id').val(res.last_insert_id);
                  $('.model_job_title').text(res.job_title);
                  $('.model_location').text(res.location);
                  $('.model_department').text(res.department);
                  // $('.model_job_description').html(job_description);
                  $('.model_employment_type').text(res.employment_type);
                  $('.model_seniority_level').text(res.seniority_level);
                  $('.model_industry_type').text(res.industry_type);
                  var str = res.skills;
                  var myArray = str.split(",");
                  $('.model_skills').html('');
                  $.each(myArray, function (index, value) {
                    $('.model_skills').append('<li>'+value+'</li>');
                  });
                }
            }
        });
        return false;
    }
}

function Cancel()
{
  location.reload();
}
function create_company()
{
  $('#create-company').modal('show'); 
}
function Get_company()
{
    var company_name=$('#company_name').val();
    if(company_name==''){
        alert('Please enter company name');
        return false;
    }else{
        $.ajax({
            url: '<?php echo site_url('admin/check_company_existed'); ?>',
            type: 'POST',
            dataType: "json",
            data: {company_name: company_name},
            success: function(res) {
                if(res.getallcompanys.res==1){
                    $('#create-company').modal('hide');
                    alert('Company name saved successfully');
                    $('#company_name').val('');
                      var myArray = res.getallcompanys;
                      $('#company_id').find('option').remove();
                      $("#company_id").append('<option value="" selected>Select Company</option>');
                      $.each(myArray, function (index, value) {
                        if(value.company_id!=undefined){
                            $("#company_id").append('<option value="'+ value.company_id+'">' + value.company_name+'</option>');
                        }
                        
                      });
                }else{
                    alert('This company name already existed!');
                }
            }
        });
    }
}

function Proceed()
{
    window.location.href = '<?php echo base_url(); ?>admin/job_position'
}
</script>
