
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row align-items-center">
         <div class="col-sm-6">
            <div class="page-title-box">
               <h4 class="font-size-18">  Employee Asset Details</h4>
               <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active"> Employee Asset Details</li>
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
      <?php if(count($asset_details)>0){ ?>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-body">
                              <table class="table table-striped">
                                <?php if($GetRolesAccess['write']==1){?>
                                   <thead>
                                    <a class=" float-right btn btn-primary dropdown-toggle waves-effect waves-light" href="<?php echo base_url(); ?>admin/edit_asset/<?php echo $asset_details['asset_id']; ?>"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit</a> 
                                   </thead>
                                <?php } ?>
                                 <tbody>
                                    <tr>
                                       <th>Employee Name</th>
                                       <td>
                                       <?php 
                                          $emp_id=$asset_details['emp_id'];
                                          if($emp_id!=''){
                                             $Get_Emp_name=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
                                             echo $Get_Emp_name['fname'].' '.$Get_Emp_name['lname'].' ('.$Get_Emp_name['emp_code'].')';
                                          }else{
                                             echo "- -";
                                          } ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <th>Laptop Serial No</th>
                                       <td><?php echo $asset_details['laptop_serial_no'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Laptop Model No</th>
                                       <td><?php echo $asset_details['laptop_model'];?></td>
                                    </tr>
                                    <!-- <tr>
                                       <th>Battery Provided </th>
                                       <td><?php echo $asset_details['battery_provided'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Battery Provided No </th>
                                       <td><?php echo $asset_details['battery_provided_no'];?></td>
                                    </tr> -->
                                    <tr>
                                       <th>Charger Provided </th>
                                       <td><?php echo $asset_details['charger_provided'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Charger Provided No </th>
                                       <td><?php echo $asset_details['charger_provided_no'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Mouse Provided </th>
                                       <td><?php echo $asset_details['mouse_provided'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Mouse Serial No </th>
                                       <td><?php echo $asset_details['mouse_serial_number'];?></td>
                                    </tr>
                                   <!--  <tr>
                                       <th>Power Supply Provided </th>
                                       <td><?php echo $asset_details['power_supply_provided'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Power Supply Provided Name </th>
                                       <td><?php echo $asset_details['power_supply_provided_name'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Power Supply Provided Model No </th>
                                       <td><?php echo $asset_details['power_supply_model_no'];?></td>
                                    </tr> -->
                                    <tr>
                                       <th>UPS Provided </th>
                                       <td><?php echo $asset_details['ups_provided'];?></td>
                                    </tr>
                                    <tr>
                                       <th>UPS Provided No</th>
                                       <td><?php echo $asset_details['ups_provided_no'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Carry Case Provided </th>
                                       <td><?php echo $asset_details['carrycase_provided'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Carry Case Provided No</th>
                                       <td><?php echo $asset_details['carrycase_provided_no'];?></td>
                                    </tr>
                                    <tr>
                                       <th>Asset Assign Date</th>
                                       <td><?php echo DD_M_YY($asset_details['asset_assigned_date']);?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end col -->
      </div>
      <!-- end row -->
    <?php } ?>
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->

<script>
function change_status(kyc_id,user_id,status)
{
  Swal.fire({
     text: "Are you sure want to change the status?",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes'
   }).then((result) => {
         if (result.isConfirmed) {
            if(status==2){
              $('#kyc_id').val(kyc_id);
              $('#user_id').val(user_id);
              $('#status_1').val(status);
              $('#myModalApproved').modal('show');
            }else{
              $('#kyc_id_2').val(kyc_id);
              $('#user_id_2').val(user_id);
              $('#status_2').val(status);
              $('#myModalReject').modal('show');
            }
            // window.location="<?php echo base_url();?>admin/change_kyc_list_status/"+kyc_id+'/'+user_id+'/'+status+'/';
       }
   });
} 
</script>