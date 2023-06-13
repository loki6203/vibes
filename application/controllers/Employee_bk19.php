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
		$data['total_leaves']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->num_rows();
		$data['today_annual_leaves']=$this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `created_at`, `updated_at` FROM `leaves` WHERE `emp_id`=$emp_id")->row_array();
		$data['annual_leaves']=$data['today_annual_leaves']['annual_leaves_count'];
		$data['sick_leaves']=$data['today_annual_leaves']['sick_leaves_count'];
		$data['total_tasks']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management`")->num_rows();
		$data['active_menu']='dashboard';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/dashboard');
		$this->load->view('employee/footer');
	}
	public function logout()
	{
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
		$data['employee']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`email_id`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`is_active`, t1.`type`, t1.`created_at`, t1.`updated_at`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` LEFT JOIN `clients` as `t3` ON `t1`.`client_id` = `t3`.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$data['active_menu']='my_profile';
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
		unset($post['emp_code']);
		unset($post['designation_id']);
		unset($post['reporting_manager_id']);
		unset($post['hr_manager_id']);
		unset($post['lead_manager_id']);
		unset($post['client_manager']);
		unset($post['client_id']);
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'fname', 'label'   => 'First Name','rules'   => 'required'),
			array( 'field'   => 'lname', 'label'   => 'Last Name','rules'   => 'required'),
			array( 'field'   => 'email_id', 'label'   => 'Email Id','rules'   => 'required'),
			array( 'field'   => 'dob', 'label'   => 'Date of Birth','rules'   => 'required'),
			array( 'field'   => 'local_contact_name', 'label'   => 'Local Contact Name','rules'   => 'required'),
			array( 'field'   => 'local_contact_relationship', 'label'   => 'Local Contact Relationship','rules'   => 'required'),
			array( 'field'   => 'local_contact_ph', 'label'   => 'Local Contact Mobile No','rules'   => 'required'),
			array( 'field'   => 'overseas_contact_ph', 'label'   => 'Overseas Contact Mpbile No','rules'   => 'required'),
			array( 'field'   => 'overseas_contact_name', 'label'   => 'Overseas Contact Name','rules'   => 'required'),
			array( 'field'   => 'overseas_contact_relationship', 'label'   => 'Overseas Contact Relationship','rules'   => 'required'),
			array( 'field'   => 'bank_name', 'label'   => 'Bank Name','rules'   => 'required'),
			array( 'field'   => 'account_number', 'label'   => 'Account Number','rules'   => 'required'),
			array( 'field'   => 'account_type', 'label'   => 'Account Type','rules'   => 'required'),
			array( 'field'   => 'branch_name', 'label'   => 'Branch Name','rules'   => 'required'),
			array( 'field'   => 'identification_type_id', 'label'   => 'Identification Type','rules'   => 'required'),
			array( 'field'   => 'identification_number', 'label'   => 'Identification Number','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('employee/my_profile');
        }
        else
        {
				$file='';
		        $imagename='';
		        if($_FILES['simage']['name'] !='')
		        {
		            $file=str_replace(" ","_",$_FILES['simage']['name']);
		            $imagename=time().$file;
		            $this->load->library('upload');
		            $config['upload_path'] = 'assets/emp_identification_image';
		            $config['file_name'] = $imagename;
		            $config['allowed_types'] = 'jpge|jpg|png|pdf';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('simage'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png formates only</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		            }
		            else
		            {

		                $imagename=$imagename;
		            }
		        }
		        else
		        {
		        	$file=$identification_image_name;
		            $imagename=$identification_image_path;
		        }
		        $post['identification_image_name']=$file;
		        $post['identification_image_path']=$imagename;
		        $post['updated_at']=$update_date;
		        $this->db->where('emp_id',$emp_id);
				$res = $this->db->update('employees',$post);
				if($res==1){
					$this->session->set_flashdata('success','Profile Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Profile Updated Failed...');
				}
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
		$data['active_menu']='other_documents';
		$this->load->view('employee/menu',$data);
		$this->load->view('employee/other_documents');
		$this->load->view('employee/footer');
	}
	public function get_other_document_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_other_docuemnt_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_other_docuemnt_Details(2,$start,$length,$search['value'],$column,$dir);
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
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=$res['from_date'];
					$NewArr[]=$res['to_date'];
					$NewArr[]=$res['leave_days'];
					$NewArr[]=$res['leave_type'];
					$NewArr[]=$res['reason'];
					if($res['leave_status']=='0'){
                        $status ='<span style="color: #38a4f8">Pending</span>';
                    }else if($res['leave_status']=='1'){ 
                        $status ='<span style="color: #3cde3c;">Approved</span>';
                    } else if($res['leave_status']=='2'){ 
                        $status ='<span style="color: #ff0000;">Rejected by HR</span>';
                    } else if($res['leave_status']=='3'){ 
                        $status ='<span style="color: #ff0000;">Cancelled by You</span>';
                    } else { } 
                    $action='';
                    if($res['leave_status']=='0'){ 
                        $action='<button type="button" class="btn btn-danger waves-effect waves-light" onclick="cancelled_emp_leaves('.$res['employee_leaves_lid'].',3);">Cancel</button>';
                    }else{
                    	echo " ";
                    }
                    if($status!='' && $action==''){
                    	$NewArr[]=$status;
                    }else{
                    	$NewArr[]=$status.'  /  '.$action;
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
		$data = array('leave_status'=>$sta);
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
		// echo date('Y-m-d', strtotime(($to_dt).' +1 day'));

		$dates = array($from_dt);
    	while(end($dates) < $to_dt)
    	{
        	$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
    	}
    	return $dates;
	}
	public function save_leaves()
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
		$GetPublicHolidays = $this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `is_active`=1")->result_array();
		$public_holidays_count=array();
		foreach($GetPublicHolidays as $value)
		{
				if(in_array($value['date'],$DateBtwArr))
				{
					$public_holidays_count[]= $value['date'];
				}
		}
		$final_leave_days = $leave_days-$totla_weekends-(count($public_holidays_count));
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
        	
        	$get_count_chk = $this->db->query("SELECT * FROM `leaves` WHERE `emp_id`=$emp_id")->row_array();
        	$annual_count_chk=$get_count_chk['annual_leaves_count'];
        	$sick_count_chk=$get_count_chk['sick_leaves_count'];
        	if($leave_type=='Annual Leave'){
	        	if($final_leave_days<=$annual_count_chk){
	        		$post['emp_id']=$emp_id;
		        	$post['leave_days']=$final_leave_days;
		        	$post['created_at']=$created_date;
		        	$post['leave_status']=0;
					$res=$this->db->insert('employee_leaves_list',$post);
					$this->session->set_flashdata('success','Leaves Applied Successfully...');
				}else{
					$this->session->set_flashdata('failed','You Dont Have Annual Leaves!...');
				}		
        	}else {
        		if($final_leave_days<=$sick_count_chk)
        		{
	        		$post['emp_id']=$emp_id;
		        	$post['leave_days']=$final_leave_days;
		        	$post['created_at']=$created_date;
		        	$post['leave_status']=0;
					$res=$this->db->insert('employee_leaves_list',$post);
					$this->session->set_flashdata('success','Levaes Applied successfully!...');
				}else{
					 $this->session->set_flashdata('failed','You Dont Have Sick Leaves!...');
				}		
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
					$this->session->set_flashdata('success','Levaes updated successfully...');
				}else{
					$this->session->set_flashdata('failed','This Levaes updated failed!...');
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
        // $empid = $get_file_path['emp_id'];
        // $get_emp_id =$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$empid")->row_array(); 
        $file_path = "assets/payslips/".$get_file_path['payslip_file_path'];
		$pth    =   file_get_contents(base_url().$file_path);
		$nme    =   'payslip_'.$get_file_path['month'].'_'.$get_file_path['year'];
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
					$NewArr[]=$res['month'];
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
		$data['start_date'] = YY_MM_DD($this->input->post('start_date'));
		$data['end_date'] = YY_MM_DD($this->input->post('end_date'));
		$data['dates'] = array_chunk($this->dateRange($data['start_date'],$data['end_date']),7);
		echo $this->load->view('employee/fill_timesheet_list',$data, TRUE);
	}
	function dateRange($from, $to)
	{
		return array_map(function($arg) {
			return date('Y-m-d', $arg);
		}, range(strtotime($from), strtotime($to), 86400));
	}
	public function save_timesheet()
	{
		checklogin_employee_helper();
		$emp_id=$this->session->userdata('emp_id');
		$client_id = 0;
		$post = $this->input->post();
		$Insert = array();
		echo'<pre>';print_r($post);
		foreach($post['slots'] as $k=>$slot){
			$names 					= $post['name_'.$slot];
			$type_of_work_performed = $post['type_of_work_performed_'.$slot];
			$remarks		    	= $post['remarks_'.$slot];
			foreach($names as $kk=>$itemname){
				$item			=	$itemname;
				$repitem = str_replace(' ', '_', $item);
				//echo '<br>'.$repitem;
				$weeks 			= $post['weeks_'.$repitem.$slot];
				//echo'<pre>';$repitem.'--'.print_r($weeks);
				foreach($weeks as $wk){
					$worked_date	=	@array_key_first($wk);
					$this->db->query("DELETE FROM `timesheet_management` WHERE `emp_id`=$emp_id AND `item`='$item' AND `worked_date`='$worked_date'");
					$Insert = array(
						'emp_id'=>$emp_id,
						'client_id'=>$client_id,
						'item'=>$item,
						'type_of_work_performed'=>@$type_of_work_performed[$kk],
						'worked_date'=>$worked_date,
						'comments'=>@$remarks[$kk],
						'is_active'=>1,
						'enter_date'=>date('Y-m-m H:i:s'),
						'enter_time'=>date('Y-m-m H:i:s'),
						'worked_hours'=>@$wk[array_key_first($wk)]
					);
					$this->db->insert('timesheet_management',$Insert);
				}
			}
		}
		if(count($Insert)>0){
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Timesheet Saved Successfully...</strong></div>');
		}else{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Timesheet Saved Failed!...</strong></div>');
		}
		redirect('employee/timesheet/'.@$post['from'].'/'.@$post['to']);
	}
	
}