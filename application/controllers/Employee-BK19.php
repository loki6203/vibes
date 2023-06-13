<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function welcome()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['active_menu']='welcome';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/welcome');
		$this->load->view('employee/footer');
	}
	public function test()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$this->load->view('employee/test');
	}
	public function first_change_password()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$this->load->view('employee/first_change_password');
	}
	public function update_password()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$old_password=md5($this->input->post('old_password'));
		$new_password=md5($this->input->post('new_password'));
		$confirm_password=md5($this->input->post('confirm_password'));
		$update_date =date("Y-m-d H:i:s");
		if($new_password==$confirm_password){
			$res=$this->db->get_where('admin_login',array('emp_id'=>$emp_id,'pwd'=>$old_password))->result_array();
			if(count($res)>0){
				$data=array('pwd'=>$new_password,'updated_at'=>$update_date,'is_chk_login'=>1);
				$this->db->where('emp_id',$emp_id);
				$this->db->update('admin_login',$data);
				$username=$this->session->userdata('username');
        		$ip = $this->input->ip_address();
        		$date =date("Y-m-d H:i:s");
        		$ArrData=array('username'=>$username,'emp_id'=>$emp_id,'ip_address'=>$ip,'created_at'=>$date);
        		$this->db->insert('change_password_history',$ArrData);
				$this->session->set_flashdata('success','Password updated successfully...</strong></div>');
				redirect('employee/dashboard');
			}else{
				$this->session->set_flashdata('failed','Old Password incorrect Please try again...');
			}
		}else{
			$this->session->set_flashdata('failed','New Password and Confirm Password do not match');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function dashboard(){
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['public_holidays']=$this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `is_active`=1")->num_rows();
		$data['leaves']=$this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `is_delete`, `created_at`, `updated_at` FROM `leaves` WHERE `emp_id`=$emp_id AND is_delete!=0")->row_array();
		$data['get_annual_taking_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as totl, `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `is_delete`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Annual Leave' AND `leave_status`=1 AND is_delete!=0")->row_array();
		$data['get_sick_taking_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as totl, `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `is_delete`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Sick Leave' AND `leave_status`=1 AND is_delete!=0")->row_array();
		if(!empty($data['get_annual_taking_leaves']['totl'])){
			$data['remaning_annual_leaves'] = (@$data['leaves']['annual_leaves_count'])-(@$data['get_annual_taking_leaves']['totl']);
		}else{
			$data['remaning_annual_leaves'] = @$data['leaves']['annual_leaves_count'];
		}
		if(!empty($data['get_sick_taking_leaves']['totl'])){
			$data['remaning_sick_leaves'] = (@$data['leaves']['sick_leaves_count'])-(@$data['get_sick_taking_leaves']['totl']);
		}else{
			$data['remaning_sick_leaves'] = @$data['leaves']['sick_leaves_count'];
		}
// 		if(!empty($data['leaves'])){
// 			$data['annual_leaves']=$data['leaves']['annual_leaves_count']+$data['TakingAnnualLeaves'];
// 			$data['remaning_annual_leaves']=$data['leaves']['annual_leaves_count'];
// 		}else{
// 			$data['annual_leaves']=0;
// 			$data['remaning_annual_leaves']=0;
// 		}
// 		if(!empty($data['leaves'])){
// 			$data['sick_leaves']=$data['leaves']['sick_leaves_count']+$data['TakingSickLeaves'];
// 			$data['remaning_sick_leaves']=$data['leaves']['sick_leaves_count'];
// 		}else{
// 			$data['sick_leaves']=0;
// 			$data['remaning_sick_leaves']=0;
// 		}
		$todatDate=date('Y-m-d');
		$data['holidays']=$this->db->query("SELECT * FROM `public_holidays` WHERE `date`>='$todatDate'")->row_array();
		$data['notifications']=$this->db->query("SELECT t2.`notification_employee_id`, t2.`notification_id`, t2.`employee_id`, t2.`read_yes_no`, t3.`notification_id`, t3.`title`, t3.`message`, t3.`applicable_to_all`, t3.`created_at`, t3.`is_cron_notification_run` FROM `notification_employees` as `t2` LEFT JOIN `notifications` as `t3` ON `t2`.`notification_id` = `t3`.`notification_id` WHERE t2.`employee_id`=$emp_id ORDER BY t3.`notification_id` DESC LIMIT 0,3")->result_array();
		$m=date('m');
        $months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
      	$Getmnths=array(); 
	      for($i=1 ; $i <= $m; $i++){
	         if($i<=$m){
	            $Getmnths[]=$i;
	         }
	      }
      	$StoreAmts=array();
      	foreach($Getmnths as $months) {
      		$Year=date('Y');
      		$GetMnthsData=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=$months AND `year`=$Year AND `emp_id`=$emp_id")->row_array();
      		$StoreAmts[$GetMnthsData['month']]=$GetMnthsData['amt'];
      		// echo $this->db->last_query();
      	}
      // echo "<pre>";print_r($StoreAmts);exit;
      	$data['amt']=implode(',', $StoreAmts);
    //   	echo "<pre>";print_r($data['amt']);exit;
      	$Date=date('Y-m-d');
      	$CurrentMnth=date('m');
      	$CurrentYear=date('Y');
      	$GetPreviousMnth=date('m');
      	if($GetPreviousMnth==01 || $GetPreviousMnth==1){
      		$PreviousMnth=date('m');
      	}else{
      		$PreviousMnth=date('m')-1;
      	}
      	$data['current_mnth_amt']=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=$CurrentMnth AND `year`=$CurrentYear AND `emp_id`=$emp_id")->row_array();
      	$data['last_mnth_amt']=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=$PreviousMnth AND `year`=$CurrentYear AND `emp_id`=$emp_id")->row_array();
      	$data['year_amt']=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `year`=$CurrentYear AND `emp_id`=$emp_id")->row_array();
      	// echo $this->db->last_query();
      	// echo "<pre>";print_r($data['last_mnth_amt']);exit;
		$data['active_menu']='dashboard';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/dashboard');
		$this->load->view('employee/footer');
	}
	public function logout()
	{
	    $emp_id=$this->session->userdata('emp_id');
		$username=$this->session->userdata('username');
		$ip = $this->input->ip_address();
		$date =date("Y-m-d H:i:s");
		$ArrData=array('username'=>$username,'emp_id'=>$emp_id,'ip_address'=>$ip,'logout_dt'=>$date,'created_at'=>$date,'successful'=>1);
		$this->db->insert('login_history',$ArrData);
        $this->session->sess_destroy();
        redirect('master');
    }
	public function check_employee_email()
	{
		$responseArr['status']="success";
		$responseArr['message']="";
		$email_id=trim($this->input->post('email_id'));
		if($email_id!='')
		{
			$res=$this->db->select('email_id')->get_where('employees',array('email_id'=>$email_id))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This employee email already exist...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another email";
		}
		echo json_encode($responseArr);
	}
	public function check_emp_code()
	{
		$responseArr['status']="success";
		$responseArr['message']="";
		$emp_code=trim($this->input->post('emp_code'));
		if($emp_code!='')
		{
			$res=$this->db->select('emp_code')->get_where('employees',array('emp_code'=>$emp_code))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This employee code already exist...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another employee code";
		}
		echo json_encode($responseArr);
	}
	public function check_update_emp_email()
	{
		$responseArr['status']="success";
		$responseArr['message']="";
		$emp_id=trim($this->input->post('emp_id'));
		$email_id=trim($this->input->post('email_id'));
		if($email_id!='')
		{
			$res=$this->db->select('emp_id','emp_code')->get_where('employees',array('email_id'=>$email_id,'emp_id!='=>$emp_id))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This employee email already exist...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another employee email";
		}
		echo json_encode($responseArr);
	}
	public function check_update_emp_code()
	{
		$responseArr['status']="success";
		$responseArr['message']="";
		$emp_id=trim($this->input->post('emp_id'));
		$emp_code=trim($this->input->post('emp_code'));
		if($emp_code!='')
		{
			$res=$this->db->select('emp_id','emp_code')->get_where('employees',array('emp_code'=>$emp_code,'emp_id!='=>$emp_id))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This employee code already exist...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another employee code";
		}
		echo json_encode($responseArr);
	}
	public function my_profile()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name` FROM `designation`")->result_array();
		$data['managers']=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `is_active`=1")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name` FROM `clients`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['employee']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`employment_type`, t1.`personal_email_id`, t1.`email_id`, t1.`phone_no_code`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph_code`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph_code`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`ifsc_code`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`,t1.`hr_manager_id`,t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`is_active`, t1.`role_id`, t1.`leaves_included_in_contract`, t1.`created_at`, t1.`updated_at`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` LEFT JOIN `clients` as `t3` ON `t1`.`client_id` = `t3`.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$data['Compensation']=$this->db->query("SELECT `compensation_details_id`, `employee_id`, `earnings_and_deductions_id`, `BASCI`, `HRA`, `CONVEYANCE`, `MEDICAL_ALLOWANCE`, `OTHER_BENEFITS`, `VARIABLES`, `GROSS_TOTAL`, `PT`, `PF`, `TDS`, `OTHERS`, `DEDUCTIONS`, `NET_PAY`, `Hourly_Rate`, `created_at`, `updated_at` FROM `employees_compensation_details` WHERE `employee_id`=$emp_id")->row_array();
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles` WHERE `is_active`=1")->result_array();
		$data['active_menu']='employee';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/my_profile');
		$this->load->view('employee/footer');
	}
	public function update_profile()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$emp_id = $this->input->post('emp_id');
		$identification_image_name=$this->input->post('identification_image_name');
		$identification_image_path=$this->input->post('identification_image_path');
		$post = $this->input->post();
		$DateOfBirth=YY_MM_DD($post['dob']);
		$post['dob']=$DateOfBirth;
		unset($post['emp_code']);
		unset($post['date_of_joining']);
		unset($post['email_id']);
		unset($post['personal_email_id']);
		unset($post['designation_id']);
		unset($post['employment_type']);
		unset($post['reporting_manager_id']);
		unset($post['hr_manager_id']);
		unset($post['lead_manager_id']);
		unset($post['client_manager']);
		unset($post['client_id']);
		unset($post['bank_name']);
		unset($post['account_number']);
		unset($post['branch_name']);
		unset($post['account_type']);
		unset($post['leaves_included_in_contract']);
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'fname', 'label'   => 'First Name','rules'   => 'required'),
			array( 'field'   => 'lname', 'label'   => 'Last Name','rules'   => 'required'),
			array( 'field'   => 'email_id', 'label'   => 'Email Id','rules'   => 'required'),
			array( 'field'   => 'dob', 'label'   => 'Date of Birth','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/my_profile');
        }
        else
        {
				// $file='';
		  //      $imagename='';
		  //      if($_FILES['simage']['name'] !='')
		  //      {
		  //          $file=str_replace(" ","_",$_FILES['simage']['name']);
		  //          $imagename=time().$file;
		  //          $this->load->library('upload');
		  //          $config['upload_path'] = 'assets/emp_identification_image';
		  //          $config['file_name'] = $imagename;
		  //          $config['allowed_types'] = 'jpeg|jpg|png|pdf';
		  //          $config['overwrite']=true;
		  //          $this->upload->initialize($config);
		  //          if(!$this->upload->do_upload('simage'))
		  //          {
		  //              $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png formates only</strong></div>');
		  //              redirect($_SERVER['HTTP_REFERER']);
		  //          }
		  //          else
		  //          {

		  //              $imagename=$imagename;
		  //              unlink("assets/emp_identification_image/".$post['identification_image_path']);
		  //          }
		  //      }
		  //      else
		  //      {
		  //      	$file=$identification_image_name;
		  //          $imagename=$identification_image_path;
		  //      }
		  //      $post['identification_image_name']=$file;
		  //      $post['identification_image_path']=$imagename;
		  //      $post['updated_at']=$update_date;
		  //      $this->db->where('emp_id',$emp_id);
				// $res = $this->db->update('employees',$post);
				// if($res==1){
					$this->session->set_flashdata('success','Profile Updated Successfully..');
				// }else{
				// 	$this->session->set_flashdata('failed','This Profile Updated Failed...');
				// }
		}
		redirect('employee/my_profile/');
	}
	public function change_password()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['active_menu']='dashboard';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/change_password');
		$this->load->view('employee/footer');
	}
	public function check_admin_password()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$output = 'false';
		$old_password = md5($this->input->get("old_password"));
        $res=$this->db->get_where('admin_login',array('admin_id'=>$admin_id,'password'=>$old_password))->result_array();
		if(count($res)>0){
			$output = 'true';
		}
			echo $output;
	}

	public function download($filename) 
	{
	    $this->load->helper('download');
	    $data = file_get_contents(base_url('assets/members/'.$filename));
	    force_download($filename, $data);
	}
	public function generate_password()
	{
		$user_id =$this->input->post('user_id');
		$length = 10;
		$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
		$str = '';
		$max = strlen($chars) - 1;
		for ($i=0; $i < $length; $i++)
		$str .= $chars[random_int(0, $max)];
		echo $str;
	}
    public function check_email()
    {
        $responseArr['status']="success";
        $responseArr['message']="";
        $delivery_boy_id=trim($this->input->post('delivery_boy_id'));
        $email_id=trim($this->input->post('email_id'));
        if($email_id!='')
        {
            $res=$this->db->select('email_id')->get_where('delivery_boy',array('email_id'=>$email_id,'delivery_boy_id!='=>$delivery_boy_id))->row_array();
            if(!empty($res))
            {
                $responseArr['status']="fail";
                $responseArr['message']="This email id already exist";
            }
        }else{
            $responseArr['status']="fail";
            $responseArr['message']="Please enter another email id";
        }
        echo json_encode($responseArr);
    }
	public function other_documents()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['documents']=$this->db->query("SELECT t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `other_documents` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id")->result_array();
		$data['confirmation_letter']=$this->db->query("SELECT `confirmation_of_employment_id`, `emp_id`, `emp_data`, `is_generated`, `created_at`, `updated_at` FROM `confirmation_of_employment` WHERE `emp_id`=$emp_id")->result_array();
		$data['active_menu']='other_documents';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/other_documents');
		$this->load->view('employee/footer');
	}
	public function get_other_document_list()
	{
	    $this->employee_confirmation_letter();
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->employeemodel->search_other_docuemnt_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->employeemodel->search_other_docuemnt_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['doc_title'];
					$NewArr[]='<a href="'.base_url().'employee/document_file_download/'.$res['document_id'].'" target="_blank"> Download </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function employee_confirmation_letter()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->employeemodel->search_employee_confirmation_letter_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->employeemodel->search_employee_confirmation_letter_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]='Employee Confirmation Letter';
					$NewArr[]='<a href="'.base_url().'employee/Download_ConfirmationofEmployment/'.$res['confirmation_of_employment_id'].'" target="_blank"> Download </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	
	public function public_holidays()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['holiday']=$this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays`")->result_array();
		$data['active_menu']='public_holidays';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/public_holidays');
		$this->load->view('employee/footer');
	}
	public function leaves()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['active_menu']='leaves';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/leaves');
		$this->load->view('employee/footer');
	}
	public function get_leaves_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->employeemodel->search_leaves_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->employeemodel->search_leaves_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
				    $emp_id = $res['emp_id'];
                    $employee_leaves_lid = $res['employee_leaves_lid'];
                    $ApproveName = $this->db->query("SELECT `log_id`, `admin_id`, `admin_name`, `changed_emp_id`, `changed_id`, `ip_address`, `status`, `created_at`, `updated_at` FROM `admin_logs` WHERE `changed_emp_id`=$emp_id AND `changed_id`=$employee_leaves_lid AND `status`=1")->row_array();
					$RejectNameAdmin = $this->db->query("SELECT `log_id`, `admin_id`, `admin_name`, `changed_emp_id`, `changed_id`, `ip_address`, `status`, `created_at`, `updated_at` FROM `admin_logs` WHERE `changed_emp_id`=$emp_id AND `changed_id`=$employee_leaves_lid AND `status`=2")->row_array();
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=DD_M_YY($res['from_date']);
					$NewArr[]=DD_M_YY($res['to_date']);
					$NewArr[]=$res['leave_days'];
					$NewArr[]=$res['leave_type'];
					$NewArr[]=$res['reason'];
					$View = '<a href="'.base_url().'assets/leave_doctor_certificate/'.$res['document_file_name'].'" target="_blank"> View </a>';
					if($res['leave_status']=='0'){
                        $status ='<span style="color: #38a4f8">Pending</span>';
                    }else if($res['leave_status']=='1'){ 
                    	if($ApproveName['admin_name']=='Admin'){
                    		$ApproveAdmin="(Admin)";
	                  	}else{
	                    	$ApproveAdmin= strstr($ApproveName['admin_name'],"_", true); 
	                  	}
                        $status ='<span style="color: #3cde3c;">Approved ('.$ApproveAdmin.')<br>' .$View.'</span>';
                    }else if($res['leave_status']=='2'){ 
                    	if($RejectNameAdmin['admin_name']=='Admin'){
                    		$RejectAdmin="(Admin)";
	                  	}else{
	                    	$RejectAdmin = strstr($RejectNameAdmin['admin_name'],"_", true); 
	                  	}
                        $status ='<span style="color: #ff0000;">Rejected by ('.$RejectAdmin.')<br>' .$View.'</span>';
                    }else if($res['leave_status']=='3'){ 
                        $status ='<span style="color: #ff0000;">Cancelled by You<br>' .$View.'</span>';
                    }else { } 
                    $action='';
                    if($res['leave_status']=='0'){ 
                        $action='<button type="button" class="btn btn-danger waves-effect waves-light" onclick="cancelled_emp_leaves('.$res['employee_leaves_lid'].',3);">Cancel</button>';
                    }else{
                    	echo " ";
                    }
                    if($status!='' && $action==''){
                    	$NewArr[]=$status;
                    }else{
                    	$NewArr[]=$status.'  /  '.$action.' '.$View;
                    }
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function cancelled_emp_leaves($employee_leaves_lid='',$sta='')
	{
		$emp_id=$this->session->userdata('emp_id');
		$data = array('leave_status'=>$sta,'is_cron_cancelled_user_email_sent'=>2,'cancelled_by_user_date'=>date("Y-m-d H:i:s"));
		$this->db->where('employee_leaves_lid',$employee_leaves_lid);
		$res=$this->db->update('employee_leaves_list',$data);
		if($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Leave Cancelled Successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Leave Cancelled Failed!...</strong></div>');
		}
		redirect('employee/leaves');
	}
	public function add_leaves()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['active_menu']='leaves';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/add_leaves');
		$this->load->view('employee/footer');
	}
	public function get_dates_between_cont($from_date,$to_date)
	{
		$from_dt = date("Y-m-d", $from_date);
		$to_dt = date("Y-m-d", $to_date);
		$dates = array($from_dt);
    	while(end($dates) < $to_dt)
    	{
        	$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
    	}
    	return $dates;
	}
	public function get_dates_between_cont_two($f_date,$t_date)
	{
		$from_dt = $f_date;
		$to_dt = $t_date;
		$dates = array($from_dt);
    	while(end($dates) < $to_dt)
    	{
        	$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
    	}
    	return $dates;
	}
	public function get_leaves_count()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$from_date = strtotime($post['from_date']);
		$to_date = strtotime($post['to_date']);
		$datediff =  $to_date-$from_date;
		$leave_days = round($datediff / (60 * 60 * 24))+1;
		$startDate = new DateTime($post['from_date']);
		$endDate = new DateTime($post['to_date']);
		$startDate_2 = new DateTime($post['from_date']);
		$endDate_2 = new DateTime($post['to_date']);
		$sundays = array();
		while ($startDate <= $endDate) {
		    if ($startDate->format('w') == 6) {
		        $sundays[] = $startDate->format('Y-m-d');
		    }
		    $startDate->modify('+1 day');
		}
		$saturdays = array();
		while ($startDate_2 <= $endDate_2) {
		    if ($startDate_2->format('w') == 0) {
		        $saturdays[] = $startDate_2->format('Y-m-d');
		    }
		    $startDate_2->modify('+1 day');
		}
		$count_sat = count($saturdays);
		$count_sun = count($sundays);
		$totla_weekends = $count_sat+$count_sun;
		$DateBtwArr = $this->get_dates_between_cont($from_date,$to_date);
		$get_Annual_Applied_Leaves=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`,`is_delete` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_status`=2 AND `leave_status`=3 AND `is_delete`!=0")->result_array();
		foreach($get_Annual_Applied_Leaves as $value)
		{
			$f_date=$value['from_date'];
			$t_date=$value['to_date'];
			$Chk_DateBtwArr = $this->get_dates_between_cont_two($f_date,$t_date);
			$Chk_DatesBetween_Existed = array_merge($DateBtwArr,$Chk_DateBtwArr);
			if(count(array_unique($Chk_DatesBetween_Existed))<count($Chk_DatesBetween_Existed))
			{
			    $this->session->set_flashdata('failed','This Dates Between Leaves Already Applied...');
			    redirect('employee/leaves/');
			}
			else
			{
			   
			}
		}
		$GetPublicHolidays = $this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `is_active`=1")->result_array();
		$public_holidays_count=array();
		foreach($GetPublicHolidays as $value)
		{
				if(in_array($value['date'],$DateBtwArr))
				{
					$public_holidays_count[]= $value['date'];
				}
		}
		$FInalSunSat_Merge=array_merge($saturdays,$sundays);
		$FINALArrMerge=array_merge($FInalSunSat_Merge,$public_holidays_count);
		$FInalPublicHolidayCount=array_unique($FINALArrMerge);
		echo $final_leave_days = $leave_days-(count($FInalPublicHolidayCount));
		
	}
	public function save_leaves()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$GetManagerIDs=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['reporting_manager_id']=$GetManagerIDs['reporting_manager_id'];
		$post['hr_manager_id']=$GetManagerIDs['hr_manager_id'];
		$post['lead_manager_id']=$GetManagerIDs['lead_manager_id'];
		$post=$this->input->post();
		$leave_type = $post['leave_type'];
		$from_date = strtotime($post['from_date']);
		$to_date = strtotime($post['to_date']);
		$datediff =  $to_date-$from_date;
		$leave_days = round($datediff / (60 * 60 * 24))+1;
		$startDate = new DateTime($post['from_date']);
		$endDate = new DateTime($post['to_date']);
		$startDate_2 = new DateTime($post['from_date']);
		$endDate_2 = new DateTime($post['to_date']);
		$sundays = array();
		while ($startDate <= $endDate) {
		    if ($startDate->format('w') == 6) {
		        $sundays[] = $startDate->format('Y-m-d');
		    }
		    $startDate->modify('+1 day');
		}
		$saturdays = array();
		while ($startDate_2 <= $endDate_2) {
		    if ($startDate_2->format('w') == 0) {
		        $saturdays[] = $startDate_2->format('Y-m-d');
		    }
		    $startDate_2->modify('+1 day');
		}
		$count_sat = count($saturdays);
		$count_sun = count($sundays);
		$totla_weekends = $count_sat+$count_sun;
		$DateBtwArr = $this->get_dates_between_cont($from_date,$to_date);
		$get_Annual_Applied_Leaves=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`,`is_delete` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_status`=2 AND `leave_status`=3 AND `is_delete`!=0")->result_array();
		foreach($get_Annual_Applied_Leaves as $value)
		{
			$f_date=$value['from_date'];
			$t_date=$value['to_date'];
			$Chk_DateBtwArr = $this->get_dates_between_cont_two($f_date,$t_date);
			$Chk_DatesBetween_Existed = array_merge($DateBtwArr,$Chk_DateBtwArr);
			if(count(array_unique($Chk_DatesBetween_Existed))<count($Chk_DatesBetween_Existed))
			{
			    $this->session->set_flashdata('failed','This Dates Between Leaves Already Applied...');
			    redirect('employee/leaves/');
			}
			else
			{
			   
			}
		}
		$GetPublicHolidays = $this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `is_active`=1")->result_array();
		$public_holidays_count=array();
		foreach($GetPublicHolidays as $value)
		{
				if(in_array($value['date'],$DateBtwArr))
				{
					$public_holidays_count[]= $value['date'];
				}
		}
		$FInalSunSat_Merge=array_merge($saturdays,$sundays);
		$FINALArrMerge=array_merge($FInalSunSat_Merge,$public_holidays_count);
		$FInalPublicHolidayCount=array_unique($FINALArrMerge);
		$final_leave_days = $leave_days-(count($FInalPublicHolidayCount));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'leave_type', 'label' => 'Leave Type','rules' => 'required'),
			array( 'field' => 'from_date', 'label' => 'From Date','rules' => 'required'),
			array( 'field' => 'to_date', 'label' => 'To Date','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/leaves');
        }else{
	        	$period_from = date('Y-m-d', $from_date);
	        	$period_to = date('Y-m-d', $to_date);
	        	$Existed_Count_Leaves = $this->db->query("SELECT * FROM leaves WHERE (`period_to` >= '$period_to' AND `period_from` <= '$period_from') AND `emp_id`=$emp_id AND is_delete!=0")->num_rows();
	        	if($Existed_Count_Leaves!=0){
	        	$get_count_chk = $this->db->query("SELECT * FROM `leaves` WHERE `emp_id`=$emp_id")->row_array();
	        	$annual_count_chk=$get_count_chk['annual_leaves_count'];
	        	$sick_count_chk=$get_count_chk['sick_leaves_count'];
	        	$Get_Already_Applied_Annual_Leaves_From =$this->db->query("SELECT * FROM employee_leaves_list WHERE from_date >= '$period_from' AND to_date <= '$period_to' AND (`leave_status`=0 OR `leave_status`=1) AND `emp_id`=$emp_id AND is_delete!=0")->num_rows();
	        	$Get_Already_Applied_Annual_Leaves_To =$this->db->query("SELECT * FROM employee_leaves_list WHERE to_date >= '$period_from' AND from_date <= '$period_to' AND (`leave_status`=0 OR `leave_status`=1) AND `emp_id`=$emp_id AND is_delete!=0")->num_rows();
	        	if($Get_Already_Applied_Annual_Leaves_From==0 && $Get_Already_Applied_Annual_Leaves_To==0)
	        	{
    	        	if($leave_type=='Annual Leave'){
        	        		$get_applied_annual_leave_count = $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`), `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Annual Leave' AND `leave_status`!=2 AND `leave_status`!=3 AND is_delete!=0")->row_array();
        	        		
        		        	if(($final_leave_days)+($get_applied_annual_leave_count['SUM(`leave_days`)'])<=$annual_count_chk)
        		        	{
        		        	        $file='';
    						        $imagename='';
    						        if($_FILES['simage']['name'] !='')
    						        {
    						            $file_path=str_replace(" ","_",$_FILES['simage']['name']);
    						            $file_name=time().$file_path;
    						            $this->load->library('upload');
    						            $config['upload_path'] = 'assets/leave_doctor_certificate';
    						            $config['file_name'] = $file_name;
    						            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
    						            $config['overwrite']=true;
    						            $this->upload->initialize($config);
    						            if(!$this->upload->do_upload('simage'))
    						            {
    						                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png,pdf formates only</strong></div>');
    						                redirect($_SERVER['HTTP_REFERER']);
    						            }
    						            else
    						            {
    
    						                $file_name=$file_name;
    						                $file_path=$file_path;
    						            }
    						        }
    						        else
    						        {
    						            	$file_name='';
    						                $file_path='';
    						        }
    						        $post['document_file_name']=$file_name;
    						        $post['document_file_path']=$file_path;
        		        			$post['emp_id']=$emp_id;
        				        	$post['leave_days']=$final_leave_days;
        				        	$post['from_date']=YY_MM_DD($post['from_date']);
        				        	$post['to_date']=YY_MM_DD($post['to_date']);
        				        	$post['leave_days']=$final_leave_days;
        				        	$post['created_at']=$created_date;
        				        	$post['leave_status']=0;
        				        	$post['is_cron_inprogress_email_sent']=2;
        							$res=$this->db->insert('employee_leaves_list',$post);
        							$this->session->set_flashdata('success','Leaves Applied Successfully...');
        				// 			$this->inprogress_leave($emp_id);
        		        	}else{
        						$this->session->set_flashdata('failed','You Dont Have Annual Leaves!...');
        					}
    	        	}else {
        	        		$get_applied_sick_leave_count = $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`), `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Sick Leave' AND `leave_status`!=2 AND `leave_status`!=3 AND is_delete!=0")->row_array();
        	        		if(($final_leave_days)+($get_applied_sick_leave_count['SUM(`leave_days`)'])<=$sick_count_chk)
        	        		{
        	        		        $file='';
    						        $imagename='';
    						        if($_FILES['simage']['name'] !='')
    						        {
    						            $file_path=str_replace(" ","_",$_FILES['simage']['name']);
    						            $file_name=time().$file_path;
    						            $this->load->library('upload');
    						            $config['upload_path'] = 'assets/leave_doctor_certificate';
    						            $config['file_name'] = $file_name;
    						            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
    						            $config['overwrite']=true;
    						            $this->upload->initialize($config);
    						            if(!$this->upload->do_upload('simage'))
    						            {
    						                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png,pdf formates only</strong></div>');
    						                redirect($_SERVER['HTTP_REFERER']);
    						            }
    						            else
    						            {
    
    						                $file_name=$file_name;
    						                $file_path=$file_path;
    						            }
    						        }
    						        else
    						        {
    						            	$file_name='';
    						                $file_path='';
    						        }
    						        $post['document_file_name']=$file_name;
    						        $post['document_file_path']=$file_path;
        	        				$post['emp_id']=$emp_id;
        				        	$post['leave_days']=$final_leave_days;
        				        	$post['from_date']=YY_MM_DD($post['from_date']);
        				        	$post['to_date']=YY_MM_DD($post['to_date']);
        				        	$post['created_at']=$created_date;
        				        	$post['leave_status']=0;
        				        	$post['is_cron_inprogress_email_sent']=2;
        							$res=$this->db->insert('employee_leaves_list',$post);
        							if($final_leave_days>2){
        								$this->session->set_flashdata('success','Leaves applied successfully and Doctor certificate is required!...');
        								// $this->inprogress_leave($emp_id);
        							}else{
        								$this->session->set_flashdata('success','Leaves Applied successfully!...');
        								// $this->inprogress_leave($emp_id);
        							}
        	        		}else{
        						$this->session->set_flashdata('failed','You Dont Have Sick Leaves!...');
        					}
    	        	    }
	            }else{
	                $this->session->set_flashdata('failed','This Dates Between Leaves Already Applied...');
	            }
        	}else{
        		$this->session->set_flashdata('failed','You Dont Have Leaves Between Dates!...');
        	}
        	
         }
		redirect('employee/leaves/');
	}
	public function save_leaves_bk()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$leave_type = $post['leave_type'];
		$from_date = strtotime($post['from_date']);
		$to_date = strtotime($post['to_date']);
		$datediff =  $to_date-$from_date;
		$leave_days = round($datediff / (60 * 60 * 24))+1;
		$startDate = new DateTime($post['from_date']);
		$endDate = new DateTime($post['to_date']);
		$startDate_2 = new DateTime($post['from_date']);
		$endDate_2 = new DateTime($post['to_date']);
		$sundays = array();
		while ($startDate <= $endDate) {
		    if ($startDate->format('w') == 6) {
		        $sundays[] = $startDate->format('Y-m-d');
		    }
		    $startDate->modify('+1 day');
		}
		$saturdays = array();
		while ($startDate_2 <= $endDate_2) {
		    if ($startDate_2->format('w') == 0) {
		        $saturdays[] = $startDate_2->format('Y-m-d');
		    }
		    $startDate_2->modify('+1 day');
		}
		$count_sat = count($saturdays);
		$count_sun = count($sundays);
		$totla_weekends = $count_sat+$count_sun;
		$DateBtwArr = $this->get_dates_between_cont($from_date,$to_date);
		$get_Annual_Applied_Leaves=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_status`=2 AND `leave_status`=3")->result_array();
		foreach($get_Annual_Applied_Leaves as $value)
		{
			$f_date=$value['from_date'];
			$t_date=$value['to_date'];
			$Chk_DateBtwArr = $this->get_dates_between_cont_two($f_date,$t_date);
			$Chk_DatesBetween_Existed = array_merge($DateBtwArr,$Chk_DateBtwArr);
			if(count(array_unique($Chk_DatesBetween_Existed))<count($Chk_DatesBetween_Existed))
			{
			    $this->session->set_flashdata('failed','This Dates Between Leaves Already Applied...');
			    redirect('employee/leaves/');
			}
			else
			{
			   
			}
		}
		$GetPublicHolidays = $this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `is_active`=1")->result_array();
		$public_holidays_count=array();
		foreach($GetPublicHolidays as $value)
		{
			if(in_array($value['date'],$DateBtwArr))
			{
				$public_holidays_count[]= $value['date'];
			}
		}
		$FInalSunSat_Merge=array_merge($saturdays,$sundays);
		$FINALArrMerge=array_merge($FInalSunSat_Merge,$public_holidays_count);
		$FInalPublicHolidayCount=array_unique($FINALArrMerge);
		$final_leave_days = $leave_days-(count($FInalPublicHolidayCount));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'leave_type', 'label' => 'Leave Type','rules' => 'required'),
			array( 'field' => 'from_date', 'label' => 'From Date','rules' => 'required'),
			array( 'field' => 'to_date', 'label' => 'To Date','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/leaves');
        }else{
	        	$period_from = date('Y-m-d', $from_date);
	        	$period_to = date('Y-m-d', $to_date);
	        	$Existed_Count_Leaves = $this->db->query("SELECT * FROM leaves WHERE (`period_to` >= '$period_to' AND `period_from` <= '$period_from') AND `emp_id`=$emp_id")->num_rows();
	        	if($Existed_Count_Leaves!=0){
	        		$get_count_chk = $this->db->query("SELECT * FROM `leaves` WHERE `emp_id`=$emp_id")->row_array();
	        	$annual_count_chk=$get_count_chk['annual_leaves_count'];
	        	$sick_count_chk=$get_count_chk['sick_leaves_count'];
	        	if($leave_type=='Annual Leave'){
	        	    $Get_Already_Applied_Annual_Leaves =$this->db->query("SELECT * FROM employee_leaves_list WHERE (to_date BETWEEN '$period_from' AND '$period_to') AND `leave_type`='Annual Leave' AND (`leave_status`=0 OR `leave_status`=1) AND `emp_id`=$emp_id")->num_rows();
	        		if($Get_Already_Applied_Annual_Leaves==0)
	        		{
    	        		$get_applied_annual_leave_count = $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`), `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Annual Leave' AND `leave_status`!=2 AND `leave_status`!=3")->row_array();
    		        	if(($final_leave_days)+($get_applied_annual_leave_count['SUM(`leave_days`)'])<=$annual_count_chk)
    		        	{
    		        			$post['emp_id']=$emp_id;
    				        	$post['leave_days']=$final_leave_days;
    				        	$post['from_date']=YY_MM_DD($post['from_date']);
    				        	$post['to_date']=YY_MM_DD($post['to_date']);
    				        	$post['leave_days']=$final_leave_days;
    				        	$post['created_at']=$created_date;
    				        	$post['leave_status']=0;
    				        	$post['is_cron_inprogress_email_sent']=2;
    							$res=$this->db->insert('employee_leaves_list',$post);
    							$this->session->set_flashdata('success','Leaves Applied Successfully...');
    		        	}else{
    						$this->session->set_flashdata('failed','You Dont Have Annual Leaves!...');
    					}
					}else{
	        			$this->session->set_flashdata('failed','This Dates Between Annual Leaves Already Applied...');
	        		}
	        	}else {
	        	    $Get_Already_Sick_Applied_Leaves =$this->db->query("SELECT * FROM employee_leaves_list WHERE (to_date BETWEEN '$period_from' AND '$period_to') AND `leave_type`='Sick Leave' AND (`leave_status`=0 OR `leave_status`=1) AND `emp_id`=$emp_id")->num_rows();
	        		if($Get_Already_Sick_Applied_Leaves==0)
	        		{
    	        		$get_applied_sick_leave_count = $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`), `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Sick Leave' AND `leave_status`!=2 AND `leave_status`!=3")->row_array();
    	        		if(($final_leave_days)+($get_applied_sick_leave_count['SUM(`leave_days`)'])<=$sick_count_chk)
    	        		{
    	        				$post['emp_id']=$emp_id;
    				        	$post['leave_days']=$final_leave_days;
    				        	$post['from_date']=YY_MM_DD($post['from_date']);
    				        	$post['to_date']=YY_MM_DD($post['to_date']);
    				        	$post['created_at']=$created_date;
    				        	$post['leave_status']=0;
    				        	$post['is_cron_inprogress_email_sent']=2;
    							$res=$this->db->insert('employee_leaves_list',$post);
    							if($final_leave_days>2){
    								$this->session->set_flashdata('success','Leaves Applied successfully<br>Doctor certificate is required!...');
    							}else{
    								$this->session->set_flashdata('success','Leaves Applied successfully!...');
    							}
    	        		}else{
    						$this->session->set_flashdata('failed','You Dont Have Sick Leaves!...');
    					}
	        		}else{
	        			$this->session->set_flashdata('failed','This Dates Between Sick Leaves Already Applied...');
	        		}
	        	}
        	}else{
        		$this->session->set_flashdata('failed','You Dont Have Leaves Between Dates!...');
        	}
        	
         }
		redirect('employee/leaves/');
	}
	public function edit_leaves($leave_id='')
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['leaves']=$this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `created_at`, `updated_at` FROM `leaves` WHERE `leave_id`=$leave_id")->row_array();
		$emp_id=$data['leaves']['emp_id'];
		$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$data['active_menu']='leaves';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/edit_leaves');
		$this->load->view('employee/footer');
	}
	public function update_leaves()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$leave_id=$this->input->post('leave_id');
		$post=$this->input->post();
		unset($post['emp_id']);
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'emp_id', 'label' => 'Employee Name','rules' => 'required'),
			array( 'field' => 'period_from', 'label' => 'Period From','rules' => 'required'),
			array( 'field' => 'period_to', 'label' => 'Period To','rules' => 'required'),
			array( 'field' => 'annual_leaves_count', 'label' => 'Annual Leaves Count','rules' => 'required'),
			array( 'field' => 'sick_leaves_count', 'label' => 'Sick Leaves Count','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/leaves');
        }else{
        	// $check=$this->db->get_where('clients',array('client_name'=>$client_name))->num_rows();
			// if($check==0){
				// $data = array('client_name'=>$client_name);
        	$post['updated_at']=$updated_date;
        	$this->db->where('leave_id',$leave_id);
			$res=$this->db->update('leaves',$post);
				if($res==1){
					$this->session->set_flashdata('success','Leaves updated successfully...');
				}else{
					$this->session->set_flashdata('failed','This Leaves updated failed!...');
				}
			}
			// else{
			// 	$this->session->set_flashdata('failed','This Client already existed!...');
			// }
       
		redirect('employee/leaves/');
	}
	public function file_download($emp_id,$payslip_id)
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
        $this->load->helper('download'); 
        $get_file_path=$this->db->query("SELECT `payslip_id`, `emp_id`, `month`, `year`, `payslip_file_name`, `payslip_file_path`, `is_active`, `created_at`, `updated_at` FROM `payslips` WHERE `payslip_id`=$payslip_id AND `emp_id`=$emp_id")->row_array();
        $file_path = "assets/payslips/".$get_file_path['payslip_file_path'];
		$pth    =   file_get_contents(base_url().$file_path);
		$nme    =   'payslip_'.$get_file_path['month'].'_'.$get_file_path['year'].'_'.$get_file_path['payslip_file_name'];
		force_download($nme, $pth);
	}
	public function document_file_download($document_id)
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
        $this->load->helper('download'); 
        $get_file_path=$this->db->query("SELECT `document_id`, `doc_title`, `emp_id`, `document_name`, `document_path`, `is_active`, `created_at`, `updated_at` FROM `other_documents` WHERE `document_id`=$document_id")->row_array();
        $file_path = "assets/other_documents/".$get_file_path['document_path'];
		$pth    =   file_get_contents(base_url().$file_path);
		$nme    =   $get_file_path['document_name'];
		force_download($nme, $pth);
	}
	public function payslips()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['active_menu']='employee';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/payslips');
		$this->load->view('employee/footer');
	}
	public function get_payslip_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->employeemodel->search_payslip_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->employeemodel->search_payslip_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$m=$res['month'];
					$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
					$NewArr[]=$months[(int)$m];
					$NewArr[]=$res['year'];
					$NewArr[]='<a href="'.base_url().'employee/file_download/'.$res['emp_id'].'/'.$res['payslip_id'].'" target="_blank"> Download </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function timesheet($from='',$to='')
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->result_array();
		$data['active_menu']='timesheet';
		$data['emp_id'] = $emp_id;
		$data['from'] = $from;
		$data['to']   = $to;
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/timesheet');
		$this->load->view('employee/footer');
	}
	public function fill_timesheet_list()
	{
		$emp_id=$this->session->userdata('emp_id');
		$data['emp_id'] = $emp_id;
		$data['sn']=1;
		$data['start_date'] = YY_MM_DD($this->input->post('start_date'));
		$data['end_date'] = YY_MM_DD($this->input->post('end_date'));
		$data['dates'] = array_chunk($this->dateRange($data['start_date'],$data['end_date']),7);
		$public_hlidays=$this->db->query("SELECT `date` FROM `public_holidays`")->result_array();
		$holidays = array();
		foreach($public_hlidays as $holiday) {
		 $holidays[] = $holiday['date'];
		}
		$data['arr']=$holidays;
		$post=$this->input->post();
		$from_date = YY_MM_DD($this->input->post('start_date'));
		$to_date = YY_MM_DD($this->input->post('end_date'));
		$get_Sick_Applied_Leaves=$this->db->query("SELECT t1.`employee_leaves_lid`, t1.`emp_id` as `e_id`, t1.`from_date`, t1.`to_date`, t1.`leave_days`, t1.`leave_type`, t1.`leave_status`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`leaves_included_in_contract` FROM `employee_leaves_list` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`from_date`>='$from_date' AND t1.`to_date`<='$to_date' AND t1.`emp_id`=$emp_id AND t1.`leave_type`='Sick Leave' AND t1.`leave_status`=1 AND t2.`leaves_included_in_contract`='Yes'")->result_array();
		if(!empty($get_Sick_Applied_Leaves))
		{
			foreach ($get_Sick_Applied_Leaves as $value)
			{
				$Chk_DateBtwArr = $this->get_dates_between_cont_two($value['from_date'],$value['to_date']);
				foreach ($Chk_DateBtwArr as $res)
				{
					$DayName= date("D", strtotime($res));
					if($DayName!='Sat' && $DayName!='Sun')
					{
						$FinalDays[]= date("Y-m-d", strtotime($res));
					}
				}
				$data['Get_Sick_Leaves'] = $FinalDays;
			}
		}else{
			$data['Get_Sick_Leaves']=0;
		}
		$get_Annual_Applied_Leaves=$this->db->query("SELECT t1.`employee_leaves_lid`, t1.`emp_id` as `e_id`, t1.`from_date`, t1.`to_date`, t1.`leave_days`, t1.`leave_type`, t1.`leave_status`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`leaves_included_in_contract` FROM `employee_leaves_list` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`from_date`>='$from_date' AND t1.`to_date`<='$to_date' AND t1.`emp_id`=$emp_id AND t1.`leave_type`='Annual Leave' AND t1.`leave_status`=1 AND t2.`leaves_included_in_contract`='Yes'")->result_array();
		if(!empty($get_Annual_Applied_Leaves))
		{
			foreach ($get_Annual_Applied_Leaves as $Annual)
			{
				$Annual_Chk_DateBtwArr = $this->get_dates_between_cont_two($Annual['from_date'],$Annual['to_date']);
				foreach ($Annual_Chk_DateBtwArr as $Annual_res)
				{
					$AnnualDayName= date("D", strtotime($Annual_res));
					if($AnnualDayName!='Sat' && $AnnualDayName!='Sun')
					{
						$AnnualFinalDays[]= date("Y-m-d", strtotime($Annual_res));
					}
				}
				$data['Get_Annual_Leaves'] = $AnnualFinalDays;
			}
		}else{
			$data['Get_Annual_Leaves']=0;
		}
		echo $this->load->view('employee/fill_timesheet_list',$data, TRUE);
	}
	public function dateRange($from, $to)
	{
		return array_map(function($arg) {
			return date('Y-m-d', $arg);
		}, range(strtotime($from), strtotime($to), 86400));
	}
	public function ajax_add_more()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$id=$this->input->post('id');
		$dt=$this->input->post('dt');
		$item=str_replace('_', ' ', $this->input->post('item'));
		$weekstart_enddate=explode("_", $this->input->post('weekstart_enddate'));
		$StartDate=YY_MM_DD($this->input->post('StartDate'));
		$EndDate=YY_MM_DD($this->input->post('EndDate'));
		$data['dt']=$this->input->post('dt');
		$data['type_of_work_performed_dt']=$this->input->post('type_of_work_performed_dt');
		$data['item']=$this->input->post('item');
		// $data['get_slots']=$this->input->post('get_slots');
		$data['get_remarks']=$this->input->post('remarks');
		$data['weekstart_enddate']=$this->input->post('weekstart_enddate');
		$data['Model_type_of_worked_hrs']=$this->input->post('Model_type_of_worked_hrs');
		$data['sn']=$id+1;
		$data['GetTimesheetDetails']=$this->db->query("SELECT t2.`timesheet_management_details_id`, t2.`timesheet_management_id`, t2.`emp_id` as `e_id`, t2.`item` as `itm`, t2.`worked_date` as `workdt`, t2.`project_name`, t2.`Hrs`, t2.`comments`, t2.`is_editble` FROM `timesheet_management_details` as `t2` WHERE t2.`worked_date`='$dt' AND t2.`item`='$item' AND t2.`emp_id`=$emp_id")->result_array();
	    $Getieditble=$this->db->query("SELECT `timesheet_management_details_id`, `timesheet_management_id`, `emp_id`, `item`, `worked_date`, `project_name`, `Hrs`, `comments`, `is_active`, `created_at`, `updated_at`, `is_editble`, `uniqno` FROM `timesheet_management_details` WHERE `worked_date`='$dt' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
	    $GetStartEndDate=$this->db->query("SELECT `timesheet_management_details_id`, `timesheet_management_id`, `emp_id`, `item`, `worked_date`, `project_name`, `Hrs`, `comments`, `is_active`, `created_at`, `updated_at`, `is_editble`, `freeze_timesheet` FROM `timesheet_management_details` WHERE `worked_date`<='$dt' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
	    if(@$Getieditble['is_editble']=='')
		{
			if(!empty($GetStartEndDate))
			{
			    $DatesBetween=explode('_', $GetStartEndDate['freeze_timesheet']);
			    $StartDate=@$DatesBetween[0];
		        $EndDate=@$DatesBetween[1];
		        if($EndDate>=$dt){
		            $Finaliseditble=$this->db->query("SELECT `timesheet_management_details_id`, `timesheet_management_id`, `emp_id`, `item`, `worked_date`, `project_name`, `Hrs`, `comments`, `is_active`, `created_at`, `updated_at`, `is_editble`, `uniqno` FROM `timesheet_management_details` WHERE `worked_date`>='$StartDate' AND `worked_date`<='$EndDate' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
		            //  echo $this->db->last_query();exit;
		            $data['is_editble']=@$Finaliseditble['is_editble'];
		        }else{
		            $data['is_editble']='';
		        }
		        
			}else{
			    $data['is_editble']='';
			}
			
		}else{
			$data['is_editble']=@$Getieditble['is_editble'];
		}
// 		echo $data['is_editble'];exit;
// 		echo $this->db->last_query();exit;
		echo $this->load->view('employee/ajax_add_more',$data,TRUE);
	}
	public function ajax_save_add_more()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$GetManagerIDs=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['reporting_manager_id']=$GetManagerIDs['reporting_manager_id'];
		$hr_manager_id=$GetManagerIDs['hr_manager_id'];
		$lead_manager_id=$GetManagerIDs['lead_manager_id'];
		$get_client_id=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`client_id`, t2.`client_id`, t2.`client_name` FROM `employees` as `t1` LEFT JOIN clients as t2 ON t1.`client_id` = t2.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$client_id = $get_client_id['client_id'];
		$ID=$this->input->post('ID');
		$date=YY_MM_DD($this->input->post('date'));
		$item=str_replace('_', ' ', $this->input->post('item'));
		$type_of_work_performed=$this->input->post('type_of_work_performed');
		$remarks=$this->input->post('remarks');
		$weekstart_enddate=$this->input->post('weekstart_enddate');
		$GetDates = explode('_', $weekstart_enddate);
		$FromDate=$GetDates[0];
		$ToDate=$GetDates[1];
		$project_name=$this->input->post('project_name[]');
		$Hrs=$this->input->post('Hrs[]');
		$comments=$this->input->post('comments[]');
		if(empty($project_name) || empty($Hrs))
		{
			echo json_encode(array('status'=>'error'));
		}else{
			$Chk=$this->db->get_where('timesheet_management', array('emp_id='=>$emp_id,'worked_date='=>$date,'item='=>$item))->num_rows();
			$EditChk=$this->db->get_where('timesheet_management_details', array('emp_id='=>$emp_id,'worked_date='=>$date,'item='=>$item))->row_array();
			if($Chk==0)
			{
				$Arr=array('emp_id'=>$emp_id,'client_id'=>$client_id,'item'=>$item,'type_of_work_performed'=>$type_of_work_performed,'worked_date'=>$date,'worked_hours'=>0,'comments'=>'','enter_date'=>date("Y-m-d H:i:s"),'enter_time'=>date("Y-m-d H:i:s"),'hr_manager_id'=>$hr_manager_id,'lead_manager_id'=>@$lead_manager_id,'is_active'=>1,'comments'=>$remarks);
					$res=$this->db->insert('timesheet_management',$Arr);
				$insert_id = $this->db->insert_id();
				foreach($project_name as $key => $projectname)
				{
					$ArrInsert=array('timesheet_management_id'=>$insert_id,'emp_id'=>$emp_id,'item'=>$item,'worked_date'=>$date,'project_name'=>$projectname,'Hrs'=>$Hrs[$key],'comments'=>$comments[$key],'is_active'=>1,'created_at'=>date("Y-m-d H:i:s"),'is_editble'=>'Yes');
					$res=$this->db->insert('timesheet_management_details',$ArrInsert);
				}
				$HrsCount=$this->db->query("SELECT `timesheet_management_details_id`, `timesheet_management_id`, `emp_id`, `worked_date`, `project_name`, SUM(`Hrs`) as `Hrs`, `comments` FROM `timesheet_management_details` WHERE `worked_date`='$date' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
				$UpdateHrsArr=array('worked_hours'=>$HrsCount['Hrs']);
				$this->db->where('timesheet_management_id',$insert_id);
				$this->db->update('timesheet_management',$UpdateHrsArr);
			}else{
				if($ID!=''){
					if($EditChk['is_editble']=='Yes')
					{
						$this->db->where('timesheet_management_id',$ID);
						$this->db->delete('timesheet_management_details');
						foreach($project_name as $key => $projectname)
						{
							$ArrInsert=array('timesheet_management_id'=>$ID,'emp_id'=>$emp_id,'item'=>$item,'worked_date'=>$date,'project_name'=>$projectname,'Hrs'=>$Hrs[$key],'comments'=>$comments[$key],'is_active'=>1,'created_at'=>date("Y-m-d H:i:s"),'is_editble'=>'Yes');
							$res=$this->db->insert('timesheet_management_details',$ArrInsert);
						}
						$HrsCount=$this->db->query("SELECT `timesheet_management_details_id`, `timesheet_management_id`, `emp_id`, `worked_date`, `project_name`, SUM(`Hrs`) as `Hrs`, `comments` FROM `timesheet_management_details` WHERE `worked_date`='$date' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
						$UpdateHrsArr=array('worked_hours'=>$HrsCount['Hrs']);
						$this->db->where('timesheet_management_id',$ID);
						$res=$this->db->update('timesheet_management',$UpdateHrsArr);
					}
					$res=1;
				}else{
					echo json_encode(array('status'=>'error'));
				}
			}
			$Hrs=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `Hrs`, `comments`, `enter_date`, `enter_time`, `hr_manager_id`, `lead_manager_id`, `is_active` FROM `timesheet_management` WHERE `worked_date`='$date' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
			$Total_Hrs=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `Hrs`, `comments`, `enter_date`, `enter_time`, `hr_manager_id`, `lead_manager_id`, `is_active` FROM `timesheet_management` WHERE `worked_date`>='$FromDate' AND `worked_date`<='$ToDate' AND `emp_id`=$emp_id AND `item`='$item'")->row_array();
			$Weekly_Total_Hrs=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `Hrs`, `comments`, `enter_date`, `enter_time`, `hr_manager_id`, `lead_manager_id`, `is_active` FROM `timesheet_management` WHERE `worked_date`>='$FromDate' AND `worked_date`<='$ToDate' AND `emp_id`=$emp_id")->row_array();
			if($res==1)
			{
				echo json_encode(array('status'=>1,'Hrs'=>$Hrs['Hrs'],'Total_Hrs'=>$Total_Hrs['Hrs'],'Weekly_Total_Hrs'=>$Weekly_Total_Hrs['Hrs']));
			}else{
				echo json_encode(array('status'=>0,'Hrs'=>$HrsCount['Hrs'],'Total_Hrs'=>$Total_Hrs['Hrs'],'Weekly_Total_Hrs'=>$Weekly_Total_Hrs['Hrs']));
			}
		}
	}
	public function save_timesheet()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$GetManagerIDs=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['reporting_manager_id']=$GetManagerIDs['reporting_manager_id'];
		$hr_manager_id=$GetManagerIDs['hr_manager_id'];
		$lead_manager_id=$GetManagerIDs['lead_manager_id'];
		$get_client_id=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`client_id`, t2.`client_id`, t2.`client_name` FROM `employees` as `t1` LEFT JOIN clients as t2 ON t1.`client_id` = t2.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$client_id = $get_client_id['client_id'];
		$post = $this->input->post();
		// $Insert = array();
		// // echo'<pre>';print_r($post);
		// foreach($post['slots'] as $k=>$slot){
		// 	$names 					= $post['name_'.$slot];
		// 	$type_of_work_performed = $post['type_of_work_performed_'.$slot];
		// 	$remarks		    	= $post['remarks_'.$slot];
		// 	foreach($names as $kk=>$itemname){
		// 		$item			=	$itemname;
		// 		$repitem = str_replace(' ', '_', $item);
		// 		//echo '<br>'.$repitem;
		// 		$weeks 			= $post['weeks_'.$repitem.$slot];
		// 		//echo'<pre>';$repitem.'--'.print_r($weeks);
		// 		foreach($weeks as $wk){
		// 			$worked_date	=	@array_key_first($wk);
		// 			$this->db->query("DELETE FROM `timesheet_management` WHERE `emp_id`=$emp_id AND `item`='$item' AND `worked_date`='$worked_date'");
		// 			$Insert = array(
		// 				'emp_id'=>$emp_id,
		// 				'client_id'=>$client_id,
		// 				'item'=>$item,
		// 				'type_of_work_performed'=>@$type_of_work_performed[$kk],
		// 				'worked_date'=>$worked_date,
		// 				'comments'=>@$remarks[$kk],
		// 				'is_active'=>1,
		// 				'enter_date'=>date('Y-m-m H:i:s'),
		// 				'enter_time'=>date('Y-m-m H:i:s'),
		// 				'worked_hours'=>@$wk[array_key_first($wk)],
		// 				'hr_manager_id'=>@$hr_manager_id,
		// 				'lead_manager_id'=>@$lead_manager_id
		// 			);
		// 			$this->db->insert('timesheet_management',$Insert);
		// 			// echo $this->db->last_query();exit;
		// 			$GetLeavesArr=array('hr_manager_id'=>$hr_manager_id,'lead_manager_id'=>$lead_manager_id);
		// 			$this->db->where('emp_id',$emp_id);
		// 			$this->db->update('leaves',$GetLeavesArr);
		// 		}
		// 	}
		// }
		// if(count($Insert)>0){
		// 	$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Timesheet Saved Successfully...</strong></div>');
		// }else{
		// 	$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Timesheet Saved Failed!...</strong></div>');
		// }
		$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Timesheet Saved Successfully...</strong></div>');
		redirect('employee/timesheet/'.@$post['from'].'/'.@$post['to']);
	}
	public function timesheet_report()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->result_array();
		$data['active_menu']='timesheet_report';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/timesheet_report');
		$this->load->view('employee/footer');
	}
	public function get_timesheet_report_list()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$data['emp_id'] = $emp_id;
		$start_date = YY_MM_DD($this->input->post('start_date'));
		$end_date = YY_MM_DD($this->input->post('end_date'));
		$data['start_date'] = YY_MM_DD($this->input->post('start_date'));
		$data['end_date'] = YY_MM_DD($this->input->post('end_date'));
		$data['dates'] = array_chunk($this->dateRange($data['start_date'],$data['end_date']),7);
		$data['chk_report_exist']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, `worked_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id")->result_array();
		$data['get_employee_client_name']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`client_id`, t2.`client_id`, t2.`client_name` FROM `employees` as `t1` LEFT JOIN clients as t2 ON t1.`client_id` = t2.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$public_hlidays=$this->db->query("SELECT `date` FROM `public_holidays`")->result_array();
		$holidays = array();
		foreach($public_hlidays as $holiday) {
		 $holidays[] = $holiday['date'];
		}
		$data['arr']=$holidays;
		echo $this->load->view('employee/get_timesheet_report_list',$data, TRUE);
	}
	public function download_pdf($start_date='',$end_date='')
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($emp_id!='' && $start_date!='' && $end_date!=''){
			$data['emp_id'] = $emp_id;
			$data['start_date'] = YY_MM_DD($start_date);
			$data['end_date'] = YY_MM_DD($end_date);
			$data['dates'] = array_chunk($this->dateRange($data['start_date'],$data['end_date']),7);
			$public_hlidays=$this->db->query("SELECT `date` FROM `public_holidays`")->result_array();
			$holidays = array();
			foreach($public_hlidays as $holiday) {
			 $holidays[] = $holiday['date'];
			}
			$data['arr']=$holidays;
			$data['get_employee_client_desig_name']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`client_manager`, t1.`client_id`, t1.`designation_id`, t1.`hr_manager_id`, t2.`client_id`, t2.`client_name`, t3.`designation_id`, t3.`designation_name` FROM `employees` as `t1` LEFT JOIN clients as t2 ON t1.`client_id` = t2.`client_id` LEFT JOIN designation as t3 ON t1.`designation_id`=t3.`designation_id` WHERE t1.`emp_id`=$emp_id")->row_array();
			$data['Normal_Hours_Worked']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Normal Hours Worked'")->row_array();
			$data['Sick_Leave']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Sick Leave'")->row_array();
			$data['Public_Holiday']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Public Holiday'")->row_array();
			$data['Overtime']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Overtime'")->row_array();
			$data['Annual_Leave']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Annual Leave'")->row_array();
			$data['Other']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Other'")->row_array();
			echo $this->load->view('employee/download_pdf',$data, TRUE);
		}else{
			redirect('master');
		}
	}
	public function download_detailed_timesheet($start_date='',$end_date='')
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($emp_id!='' && $start_date!='' && $end_date!=''){
			$data['emp_id'] = $emp_id;
			$data['start_date'] = YY_MM_DD($start_date);
			$data['end_date'] = YY_MM_DD($end_date);
			$data['dates'] = array_chunk($this->dateRange($data['start_date'],$data['end_date']),7);
			$public_hlidays=$this->db->query("SELECT `date` FROM `public_holidays`")->result_array();
			$holidays = array();
			foreach($public_hlidays as $holiday) {
			 $holidays[] = $holiday['date'];
			}
			$data['arr']=$holidays;
			$data['get_employee_client_desig_name']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`client_manager`, t1.`client_id`, t1.`designation_id`, t1.`hr_manager_id`, t2.`client_id`, t2.`client_name`, t3.`designation_id`, t3.`designation_name` FROM `employees` as `t1` LEFT JOIN clients as t2 ON t1.`client_id` = t2.`client_id` LEFT JOIN designation as t3 ON t1.`designation_id`=t3.`designation_id` WHERE t1.`emp_id`=$emp_id")->row_array();
			$data['Normal_Hours_Worked']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Normal Hours Worked'")->row_array();
			$data['Sick_Leave']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Sick Leave'")->row_array();
			$data['Public_Holiday']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Public Holiday'")->row_array();
			$data['Overtime']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Overtime'")->row_array();
			$data['Annual_Leave']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Annual Leave'")->row_array();
			$data['Other']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Other'")->row_array();
			$data['GetDeatailedTimesheet']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, `worked_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date`>='$start_date' AND `worked_date`<='$end_date' AND `emp_id`=$emp_id GROUP BY `worked_date`")->result_array();
			echo $this->load->view('employee/download_detailed_timesheet',$data, TRUE);
		}else{
			redirect('master');
		}
	}
	public function recruitment()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($this->session->userdata('type')==2){
		    session_destroy();
			redirect(base_url());
		}
		$data['active_menu']='recruitment';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/recruitment');
		$this->load->view('employee/footer');
	}
	public function get_recruitment_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->employeemodel->search_recruitment_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->employeemodel->search_recruitment_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['name'];
					$NewArr[]=$res['job_role'];
					$NewArr[]=$res['client'];
					$NewArr[]=$res['reporting_vendor'];
					$NewArr[]=$res['end_client'];
					$NewArr[]=$res['applied_role_position'];
					$NewArr[]=$res['client_feedback'];
					$NewArr[]=$res['proposed_rate_card_to_client'];
					$NewArr[]=$res['notice_period'];
					$NewArr[]=$res['comments'];
					$NewArr[]=DD_M_YY($res['created_at']);
					$NewArr[]='<a href="'.base_url().'employee/edit_recruitment/'.$res['recruitment_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_recruitment()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($this->session->userdata('type')==2){
		    session_destroy();
			redirect(base_url());
		}
		$data['active_menu']='recruitment';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/add_recruitment');
		$this->load->view('employee/footer');
	}
	public function save_recruitment()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($this->session->userdata('type')==2){
		    session_destroy();
			redirect(base_url());
		}
		$post = $this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'name', 'label'   => 'Name','rules'   => 'required'),
			array( 'field'   => 'job_role', 'label'   => 'Job Role','rules'   => 'required'),
			array( 'field'   => 'client', 'label'   => 'Client','rules'   => 'required'),
			array( 'field'   => 'reporting_vendor', 'label'   => 'Reporting Vendor','rules'   => 'required'),
			array( 'field'   => 'end_client', 'label'   => 'End Client','rules'   => 'required'),
			array( 'field'   => 'applied_role_position', 'label'   => 'Applied Role Position','rules'   => 'required'),
			array( 'field'   => 'client_feedback', 'label'   => 'Client Feedback','rules'   => 'required'),
			array( 'field'   => 'proposed_rate_card_to_client', 'label'   => 'Proposed Rate Card to Client','rules'   => 'required'),
			array( 'field'   => 'notice_period', 'label'   => 'Notice Period','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/recruitment');
        }
        else
        {
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
		        $post['emp_id']=$emp_id;
				$res = $this->db->insert('recruitment',$post);
				if($res==1){
					$this->session->set_flashdata('success','Recruitment Created Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Recruitment Created Failed...');
				}
		}
		redirect('employee/recruitment');
	}
	public function edit_recruitment($recruitment_id='')
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($this->session->userdata('type')==2){
		    session_destroy();
			redirect(base_url());
		}
		$data['recruitment']=$this->db->query("SELECT `recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `created_at`, `updated_at` FROM `recruitment` WHERE `recruitment_id`=$recruitment_id")->row_array();
		$data['active_menu']='recruitment';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/edit_recruitment');
		$this->load->view('employee/footer');
	}
	public function update_recruitment()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		if($this->session->userdata('type')==2){
		    session_destroy();
			redirect(base_url());
		}
		$post = $this->input->post();
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'name', 'label'   => 'Name','rules'   => 'required'),
			array( 'field'   => 'job_role', 'label'   => 'Job Role','rules'   => 'required'),
			array( 'field'   => 'client', 'label'   => 'Client','rules'   => 'required'),
			array( 'field'   => 'reporting_vendor', 'label'   => 'Reporting Vendor','rules'   => 'required'),
			array( 'field'   => 'end_client', 'label'   => 'End Client','rules'   => 'required'),
			array( 'field'   => 'applied_role_position', 'label'   => 'Applied Role Position','rules'   => 'required'),
			array( 'field'   => 'client_feedback', 'label'   => 'Client Feedback','rules'   => 'required'),
			array( 'field'   => 'proposed_rate_card_to_client', 'label'   => 'Proposed Rate Card to Client','rules'   => 'required'),
			array( 'field'   => 'notice_period', 'label'   => 'Notice Period','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/recruitment');
        }
        else
        {
		        $post['updated_at']=$updated_date;
		        $post['emp_id']=$emp_id;
		        $this->db->where('recruitment_id',$post['recruitment_id']);
				$res = $this->db->update('recruitment',$post);
				if($res==1){
					$this->session->set_flashdata('success','Recruitment Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Recruitment Updated Failed...');
				}
		}
		redirect('employee/recruitment');
	}
	public function ConfirmationofEmployment()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$mnth =date("m");
		$mnthName =date("M");
		$ChkMonthData = $this->db->query("SELECT `confirmation_of_employment_id`, `emp_id`, `emp_data`, `is_generated`, `created_at`, `updated_at` FROM `confirmation_of_employment` WHERE `emp_id`=$emp_id AND MONTH(`created_at`)='$mnth'")->num_rows();
		if($ChkMonthData==0)
		{
    		$GetEmpData = $this->db->query("SELECT `emp_id`, `fname`, `lname`,`emp_code`, `designation_id`, `date_of_joining`, `designation_id`, `identification_type_id`, `identification_number`FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
    		$designation_id=$GetEmpData['designation_id'];
    		$designation_name=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation` WHERE `designation_id`=$designation_id")->row_array();
    		$identification_id=$GetEmpData['identification_type_id'];
    		$identification_name=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `identification_id`=$identification_id")->row_array();
    		$GetEmpData['identification_name']=$identification_name['identification_name'];
    		$GetEmpData['designation_name']=$designation_name['designation_name'];
    		$data['res']=$GetEmpData;
    		$html=$this->load->view('employee/confirmation_of_employment',$data,TRUE);
    		$EmpData=json_encode($GetEmpData);
    		$date =date("Y-m-d H:i:s");
    		$ArrData=array('emp_id'=>$emp_id,'emp_data'=>$EmpData,'is_generated'=>1,'created_at'=>$date);
    		$res = $this->db->insert('confirmation_of_employment',$ArrData);
    		if($res==1){
    		    $this->load->library('M_pdf');
    			$mpdf = new \Mpdf\Mpdf();
    			$mpdf->WriteHTML($html);
    			$mpdf->Output();
    			//$this->session->set_flashdata('success','Confirmation of employment generated successfully...');
    		}else{
    			$this->session->set_flashdata('failed','This confirmation of employment generated Failed...');
    		}
		}else{
			$this->session->set_flashdata('failed','This ECL is already generated for the '.$mnthName.' month. You may download the latest copy from other documents');
			redirect($_SERVER["HTTP_REFERER"]);
		}
	}
	public function Download_ConfirmationofEmployment($confirmation_of_employment_id='')
	{
		$emp_id=$this->session->userdata('emp_id');
		$GetEmpId = $this->db->query("SELECT `confirmation_of_employment_id`, `emp_id`, `emp_data`, `is_generated`, `created_at`, `updated_at` FROM `confirmation_of_employment` WHERE `confirmation_of_employment_id`=$confirmation_of_employment_id")->row_array();
		if($emp_id==''){
		 	$emp_id=$GetEmpId['emp_id'];   
		}
		$GetEmpData = $this->db->query("SELECT t1.`confirmation_of_employment_id`, t1.`emp_id` as e_id, t1.`emp_data`, t1.`is_generated`, t1.`created_at`, t2.`emp_id`, t2.`fname`, t2.`lname`,t2.`emp_code`, t2.`designation_id`, t2.`date_of_joining`, t2.`designation_id`, t2.`identification_type_id`, t2.`identification_number` FROM `confirmation_of_employment` as t1 LEFT JOIN employees as t2 ON t1.`emp_id` = t2.`emp_id` WHERE t1.`confirmation_of_employment_id`=$confirmation_of_employment_id")->row_array();
		$designation_id=$GetEmpData['designation_id'];
		$designation_name=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation` WHERE `designation_id`=$designation_id")->row_array();
		$identification_id=$GetEmpData['identification_type_id'];
		$identification_name=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `identification_id`=$identification_id")->row_array();
		$GetEmpData['identification_name']=$identification_name['identification_name'];
		$GetEmpData['designation_name']=$designation_name['designation_name'];
		$data['res']=$GetEmpData;
		$html=$this->load->view('employee/download_confirmation_of_employment',$data,TRUE);
		$this->load->library('M_pdf');
		$dt=date("d-M-Y", strtotime($GetEmpData['created_at']));
		$pdfFilePath='Employee Confirmation Letter_'.$dt.'.pdf';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
	public function notifications()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$ArrData=array('read_yes_no'=>'Yes','read_at'=>date("Y-m-d H:i:s"));
		$this->db->where('employee_id',$emp_id);
		$this->db->update('notification_employees',$ArrData);
		$data['active_menu']='notifications';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/notifications');
		$this->load->view('employee/footer');
	}
	public function get_notifications_list()
	{
	    checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->employeemodel->get_notifications_list(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->employeemodel->get_notifications_list(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$notification_id=$res['notification_id'];
					if($notification_id!=''){
						$title=$this->db->query("SELECT * FROM `notifications` WHERE `notification_id`=$notification_id")->row_array();
					}else{
						$title['title']='';
					}
					$NewArr[]=$res['title'];
					$NewArr[]=DD_M_YY($res['created_at']);
					$NewArr[]=@$res['message'];
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
}