<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function welcome()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='welcome';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/welcome');
		$this->load->view('admin/footer');
	}
	public function dashboard(){
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['all_employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id`, `phone_no`, `date_of_joining`, `local_contact_name`, `local_contact_relationship`, `local_contact_ph`, `overseas_contact_name`, `overseas_contact_relationship`, `overseas_contact_ph`, `bank_name`, `account_number`, `account_type`, `branch_name`, `reporting_manager_id`, `client_manager`, `client_id`, `identification_type_id`, `identification_number`, `identification_image_name`, `identification_image_path`, `is_active`, `comments`, `termination_date`, `is_active_date`, `is_inactive_date`, `type`, `created_at`, `updated_at` FROM `employees`")->num_rows();
		$data['total_clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->num_rows();
		$data['today_leave_empys']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `leave_status`=1 AND CURDATE() BETWEEN `from_date` and `to_date`")->num_rows();
		$data['today_working_empys']=($data['all_employees'])-($data['today_leave_empys']);
		$data['total_tasks']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management`")->num_rows();
		$data['active_menu']='dashboard';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	public function logout()
	{
        $this->session->sess_destroy();
        redirect('master');
    }
	public function employee()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee');
		$this->load->view('admin/footer');
	}
	public function get_employee_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_employee_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_employee_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$designation_id = $res['designation_id'];
					$designation_name=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation` WHERE `designation_id`=$designation_id")->row_array();
					$identification_type_id=$res['identification_type_id'];
					$identification_type_name=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `identification_id`=$identification_type_id")->row_array();
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'];
					$NewArr[]=$res['lname'];
					$NewArr[]=$res['email_id'];
					$NewArr[]=$res['date_of_joining'];
					$NewArr[]=$res['dob'];
					$NewArr[]=$res['gender'];
					$NewArr[]=$designation_name['designation_name'];
					$NewArr[]=$res['phone_no'];
					$NewArr[]=$identification_type_name['identification_name'];
					$NewArr[]=$res['identification_number'];
					$NewArr[]=$res['comments'];
					$NewArr[]='<a href="'.base_url().'assets/emp_identification_image/'.$res['identification_image_path'].'" target="_blank"> View Document </a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',1);"> Inactive </button>';
						$inactive_date='<span><b>Inactive Date </b>: '.$res["is_inactive_date"].' </span>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',0);"> Active </button>';
						$inactive_date='';
					}
					$NewArr[]='<a href="'.base_url().'admin/edit_employee/'.$res['emp_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>'.' | '.$status.' | <button class="btn btn-info waves-effect waves-light" onclick="generate_password('.$res['emp_id'].');"> Generate Password </button><br>'.$inactive_date;
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_employee()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name`,`is_active` FROM `designation` WHERE `is_active`=1")->result_array();
		$data['managers']=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `is_active`=1")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name` FROM `clients`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `is_active`=1")->result_array();
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee');
		$this->load->view('admin/footer');
	}
	public function generate_employee_password_email($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$pwd = $this->generate_password();
		$data['pwd']=$pwd;
		$data['get_emp_email'] = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$to_email = $data['get_emp_email']['email_id'];
		$mesg = $this->load->view('admin/employee_email_template',$data,true);
		// echo "<pre>";print_r($mesg);exit;
		$this->email->from('amarasuresh461@gmail.com', 'Vibho Employee Solutions');
		$this->email->to($to_email); 
		$this->email->subject('Password');
		$this->email->message($mesg);  
		if($this->email->send())
		{
			$Arrpwd=array('pwd'=>md5($pwd),'is_chk_login'=>0);
			$this->db->where('emp_id',$emp_id);
			$this->db->update('admin_login',$Arrpwd);
			$this->session->set_flashdata('success','Employee Created Successfully..');
		}else{
			$this->session->set_flashdata('failed','This Employee Created Failed...');
		}
		// echo $this->email->print_debugger();
	}
	public function generateRandom_Number()
    {
          $reference_no = generateRandomNumber();
          $chk=$this->db->query("SELECT `id`, `message`, `created_at`, `user_id`, `read_or_not`, `rand_num` FROM `master_notification` WHERE `rand_num`=$reference_no")->num_rows();
          if($chk==0){
              return $reference_no;
          }else{
            $this->generateRandom_Number();
          }
    }
	public function save_employee()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		unset($post['cpassword']);
		$emp_pwd = $this->generate_password();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'fname', 'label'   => 'First Name','rules'   => 'required'),
			array( 'field'   => 'lname', 'label'   => 'Last Name','rules'   => 'required'),
			array( 'field'   => 'email_id', 'label'   => 'Email Id','rules'   => 'required'),
			array( 'field'   => 'date_of_joining', 'label'   => 'Date Of Joining','rules'   => 'required'),
			array( 'field'   => 'dob', 'label'   => 'Date of Birth','rules'   => 'required'),
			array( 'field'   => 'designation_id', 'label'   => 'Designation','rules'   => 'required'),
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
			array( 'field'   => 'reporting_manager_id', 'label'   => 'Reporting Manager','rules'   => 'required'),
			array( 'field'   => 'client_manager', 'label'   => 'client Manager','rules'   => 'required'),
			array( 'field'   => 'client_id', 'label'   => 'client','rules'   => 'required'),
			array( 'field'   => 'identification_type_id', 'label'   => 'Identification Type','rules'   => 'required'),
			array( 'field'   => 'identification_number', 'label'   => 'Identification Number','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee');
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
		            $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload employee identification image</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		        }
		        // $post['password']=md5($emp_pwd);
		        $email = $post['email_id'];
		        $post['identification_image_name']=$file;
		        $post['identification_image_path']=$imagename;
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
		        $post['type']=2;
				$res = $this->db->insert('employees',$post);
				$insert_id = $this->db->insert_id();
				$Create_EmpCode='VTSA'.$insert_id;
				$emp_code_arr=array('emp_code'=>$Create_EmpCode);
				$this->db->where('emp_id',$insert_id);
				$this->db->update('employees',$emp_code_arr);
				$ArrLoginInsert=array('username'=>$Create_EmpCode,'email'=>$email,'is_active'=>1,'type'=>2,'is_chk_login'=>0,'created_at'=>$created_date);
				$res2=$this->db->insert('admin_login',$ArrLoginInsert);
				if($res2==1){
					$this->session->set_flashdata('success','Employee Created Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Employee Created Failed...');
				}
		}
		redirect('admin/employee/');
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
	public function edit_employee($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name` FROM `designation`")->result_array();
		$data['managers']=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `is_active`=1")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name` FROM `clients`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['employee']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`email_id`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`,t1.`hr_manager_id`,t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`is_active`, t1.`type`, t1.`created_at`, t1.`updated_at`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` LEFT JOIN `clients` as `t3` ON `t1`.`client_id` = `t3`.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_employee');
		$this->load->view('admin/footer');
	}
	public function update_employee()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$emp_id = $this->input->post('emp_id');
		$identification_image_name=$this->input->post('identification_image_name');
		$identification_image_path=$this->input->post('identification_image_path');
		$post = $this->input->post();
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'fname', 'label'   => 'First Name','rules'   => 'required'),
			array( 'field'   => 'lname', 'label'   => 'Last Name','rules'   => 'required'),
			array( 'field'   => 'email_id', 'label'   => 'Email Id','rules'   => 'required'),
			array( 'field'   => 'date_of_joining', 'label'   => 'Date Of Joining','rules'   => 'required'),
			array( 'field'   => 'dob', 'label'   => 'Date of Birth','rules'   => 'required'),
			array( 'field'   => 'designation_id', 'label'   => 'Designation','rules'   => 'required'),
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
			array( 'field'   => 'reporting_manager_id', 'label'   => 'Reporting Manager','rules'   => 'required'),
			array( 'field'   => 'client_manager', 'label'   => 'client Manager','rules'   => 'required'),
			array( 'field'   => 'client_id', 'label'   => 'client','rules'   => 'required'),
			array( 'field'   => 'identification_type_id', 'label'   => 'Identification Type','rules'   => 'required'),
			array( 'field'   => 'identification_number', 'label'   => 'Identification Number','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee');
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
					$this->session->set_flashdata('success','Employee Created Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Employee Created Failed...');
				}
		}
		redirect('admin/employee/');
	}
	public function change_employee_status($emp_id='',$sta='')
	{
		$data = array('is_active'=>$sta,'is_active_date'=>date("Y-m-d H:i:s"));
		$this->db->where('emp_id',$emp_id);
		$res=$this->db->update('employees',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Employee status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Employee status update failed!...</strong></div>');
		}
		redirect('admin/employee');
	}
	public function change_employee_status_comments()
	{
		$emp_id=$this->input->post('comment_emp_id');
		$sta=$this->input->post('comment_sta');
		$comments=$this->input->post('comments');
		$termination_date=$this->input->post('termination_date');
		if($emp_id!='' && $sta!='' && $comments && $termination_date){
			$data = array('comments'=>$comments,'termination_date'=>$termination_date,'is_active'=>$sta,'is_inactive_date'=>date("Y-m-d H:i:s"));
			$this->db->where('emp_id',$emp_id);
			$res=$this->db->update('employees',$data);
			if ($res==1)
			{
				$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Employee status updated successfully...</strong></div>');
			}
			else
			{
				$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Employee status update failed!...</strong></div>');
			}
		}else{
			echo "Employee Id and Employee Comments are required...";exit;
		}
		redirect('admin/employee');
	}
	public function change_password()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='dashboard';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/change_password');
		$this->load->view('admin/footer');
	}
	public function check_admin_password()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$output = 'false';
		$old_password = md5($this->input->get("old_password"));
        $res=$this->db->get_where('admin_login',array('admin_id'=>$admin_id,'password'=>$old_password))->result_array();
		if(count($res)>0){
			$output = 'true';
		}
			echo $output;
	}
	public function update_password()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$old_password=md5($this->input->post('old_password'));
		$new_password=md5($this->input->post('new_password'));
		$confirm_password=md5($this->input->post('confirm_password'));
		$update_date =date("Y-m-d H:i:s");
		if($new_password==$confirm_password){
			$res=$this->db->get_where('admin_login',array('id'=>$admin_id,'pwd'=>$old_password))->result_array();
			if(count($res)>0){
				$data=array('pwd'=>$new_password,'updated_at'=>$updated_at);
				$this->db->where('id',$admin_id);
				$this->db->update('admin_login',$data);
				$this->session->set_flashdata('success','Password updated successfully...</strong></div>');
			}else{
				$this->session->set_flashdata('failed','Old Password incorrect Please try again...');
			}
		}else{
			$this->session->set_flashdata('failed','New Password and Confirm Password do not match');
		}
		redirect('admin/change_password');
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
    public function employee_performance()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='employee_performance';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee_performance');
		$this->load->view('admin/footer');
	}
	public function get_employee_performance_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_employee_performance_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_employee_performance_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=$res['appraisal_date'];
					$NewArr[]=$res['existing_salary'];
					$NewArr[]=$res['new_salary'];
					$NewArr[]=$res['percentage_hike'];
					$NewArr[]=$res['hr_feedback_comments'];
					$NewArr[]='<a href="'.base_url().'admin/view_employee_performance_list/'.$res['emp_id'].'"> View </a>';
					$NewArr[]='<a href="'.base_url().'admin/edit_employee_performance/'.$res['emp_performance_id'].'/'.$res['emp_id'].'/F" class="btn btn-info waves-effect waves-light"> Edit </a>';
					
					
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_performance_list($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employee_performance_list']=$this->db->query("SELECT `emp_performance_id`, `emp_id`, `appraisal_date`, `appraisal_rating`, `existing_role`, `new_role`, `existing_salary`, `new_salary`, `percentage_hike`, `hr_feedback_comments`, `employee_feedback_comments`, `relationship_manager_comments`, `is_active`, `created_at`, `updated_at` FROM `employee_annual_performance` WHERE `emp_id`=$emp_id ORDER BY `appraisal_date` ASC")->result_array();
		$data['active_menu']='employee_performance';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_performance_list');
		$this->load->view('admin/footer');
	}
	public function add_employee_performance()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employee']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='employee_performance';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee_performance');
		$this->load->view('admin/footer');
	}
	public function save_employee_performance()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			array( 'field'   => 'appraisal_date', 'label'   => 'Appraisal Date','rules'   => 'required'),
			array( 'field'   => 'appraisal_rating', 'label'   => 'Appraisal Rating','rules'   => 'required'),
			array( 'field'   => 'existing_role', 'label'   => 'Existing Role','rules'   => 'required'),
			array( 'field'   => 'new_role', 'label'   => 'New Role','rules'   => 'required'),
			array( 'field'   => 'existing_salary', 'label'   => 'Existing Salary','rules'   => 'required'),
			array( 'field'   => 'new_salary', 'label'   => 'New Salary','rules'   => 'required'),
			array( 'field'   => 'percentage_hike', 'label'   => 'Percentage Hike','rules'   => 'required'),
			array( 'field'   => 'hr_feedback_comments', 'label'   => 'Hr Feedback Comments','rules'   => 'required'),
			array( 'field'   => 'employee_feedback_comments', 'label'   => 'Employee Feedback Comments','rules'   => 'required'),
			array( 'field'   => 'relationship_manager_comments', 'label'   => 'Relationship Manager Comments','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee_performance');
        }
        else
        {
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
				$res = $this->db->insert('employee_annual_performance',$post);
				if($res==1){
					$this->session->set_flashdata('success','Employee Annual Performance Created Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Employee Annual Performance Created Failed...');
				}
		}
		redirect('admin/employee_performance/');
	}
	public function edit_employee_performance($emp_performance_id='',$emp_id='',$order='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['emp_id']=$emp_id;
		$data['order']=$order;
		$data['employee_performance']=$this->db->query("SELECT `emp_performance_id`, `emp_id`, `appraisal_date`, `appraisal_rating`, `existing_role`, `new_role`, `existing_salary`, `new_salary`, `percentage_hike`, `hr_feedback_comments`, `employee_feedback_comments`, `relationship_manager_comments`, `is_active`, `created_at`, `updated_at` FROM `employee_annual_performance` WHERE `emp_performance_id`=$emp_performance_id")->row_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='employee_performance';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_employee_performance');
		$this->load->view('admin/footer');
	}
	public function update_employee_performance()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$emp_performance_id = trim($this->input->post('emp_performance_id'));
		$post = $this->input->post();
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			array( 'field'   => 'appraisal_date', 'label'   => 'Appraisal Date','rules'   => 'required'),
			array( 'field'   => 'appraisal_rating', 'label'   => 'Appraisal Rating','rules'   => 'required'),
			array( 'field'   => 'existing_role', 'label'   => 'Existing Role','rules'   => 'required'),
			array( 'field'   => 'new_role', 'label'   => 'New Role','rules'   => 'required'),
			array( 'field'   => 'existing_salary', 'label'   => 'Existing Salary','rules'   => 'required'),
			array( 'field'   => 'new_salary', 'label'   => 'New Salary','rules'   => 'required'),
			array( 'field'   => 'percentage_hike', 'label'   => 'Percentage Hike','rules'   => 'required'),
			array( 'field'   => 'hr_feedback_comments', 'label'   => 'Hr Feedback Comments','rules'   => 'required'),
			array( 'field'   => 'employee_feedback_comments', 'label'   => 'Employee Feedback Comments','rules'   => 'required'),
			array( 'field'   => 'relationship_manager_comments', 'label'   => 'Relationship Manager Comments','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee_performance');
        }
        else
        {
		        $post['updated_at']=$updated_date;
		        $this->db->where('emp_performance_id',$emp_performance_id);
				$res = $this->db->update('employee_annual_performance',$post);
				if($res==1){
					$this->session->set_flashdata('success','Employee Annual Performance Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Employee Annual Performance Updated Failed...');
				}
		}
		redirect('admin/employee_performance/');
	}
	public function clients()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->result_array();
		$data['active_menu']='clients';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/clients');
		$this->load->view('admin/footer');
	}
	public function change_client_status($client_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('client_id',$client_id);
		$res=$this->db->update('clients',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Client status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Client status update failed!...</strong></div>');
		}
		redirect('admin/clients');
	}
	public function add_client()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='clients';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_client');
		$this->load->view('admin/footer');
	}
	public function save_client()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$client_name=trim($this->input->post('client_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'client_name', 'label'   => 'Client Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/clients');
        }else{
        	$check=$this->db->get_where('clients',array('client_name'=>$client_name))->num_rows();
			if($check==0){
				$data = array('client_name'=>$client_name);
				$res=$this->db->insert('clients',$data);
				if($res==1){
					$this->session->set_flashdata('success','Client saved successfully..');
				}else{
					$this->session->set_flashdata('failed','This Client saved failed!..');
				}
			}else{
				$this->session->set_flashdata('failed','This Client already existed!..');
			}
        }
		redirect('admin/clients/');
	}
	public function edit_client($client_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['client']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients` WHERE `client_id`=$client_id")->row_array();
		$data['active_menu']='clients';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_client');
		$this->load->view('admin/footer');
	}
	public function update_client()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$client_id=$this->input->post('client_id');
		$client_name=trim($this->input->post('client_name'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'client_name', 'label'   => 'Client Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/clients');
        }else{
        	$check=$this->db->get_where('clients',array('client_name'=>$client_name,'client_id!='=>$client_id))->num_rows();
			if($check==0){
				$res = $this->db->update('clients',array('client_name'=>$client_name),array('client_id'=>$client_id));
				if($res==1){
					$this->session->set_flashdata('success','Client Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Client updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Client already existed!...');
			}
        }
		redirect('admin/clients/');
	}
	public function item_management()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['item_management']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management`")->result_array();
		$data['active_menu']='item_management';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/item_management');
		$this->load->view('admin/footer');
	}
	public function change_item_management_status($item_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('item_management_id',$item_id);
		$res=$this->db->update('item_management',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Item status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Item status update failed!...</strong></div>');
		}
		redirect('admin/item_management');
	}
	public function add_item_management()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='item_management';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_item_management');
		$this->load->view('admin/footer');
	}
	public function save_item_management()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$item_name=trim($this->input->post('item_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'item_name', 'label'   => 'Item Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/item_management');
        }else{
        	$check=$this->db->get_where('item_management',array('item_name'=>$item_name))->num_rows();
			if($check==0){
				$data = array('item_name'=>$item_name,'is_active'=>1,'created_at'=>$created_date);
				$res=$this->db->insert('item_management',$data);
				if($res==1){
					$this->session->set_flashdata('success','Item saved successfully..');
				}else{
					$this->session->set_flashdata('failed','This Item saved failed!..');
				}
			}else{
				$this->session->set_flashdata('failed','This Item already existed!..');
			}
        }
		redirect('admin/item_management/');
	}
	public function edit_item_management($item_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['item']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management` WHERE `item_management_id`=$item_id")->row_array();
		$data['active_menu']='item_management';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_item_management');
		$this->load->view('admin/footer');
	}
	public function update_item_management()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$item_management_id=$this->input->post('item_management_id');
		$item_name=trim($this->input->post('item_name'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'item_name', 'label'   => 'Item Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/item_management');
        }else{
        	$check=$this->db->get_where('item_management',array('item_name'=>$item_name,'item_management_id!='=>$item_management_id))->num_rows();
			if($check==0){
				$res = $this->db->update('item_management',array('item_name'=>$item_name),array('item_management_id'=>$item_management_id));
				if($res==1){
					$this->session->set_flashdata('success','Item Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Item updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Item already existed!...');
			}
        }
		redirect('admin/item_management/');
	}
	public function other_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='other_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/other_documents');
		$this->load->view('admin/footer');
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
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=$res['doc_title'];
					$NewArr[]='<a href="'.base_url().'assets/other_documents/'.$res['document_path'].'" target="_blank"> View </a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_other_document_status('.$res['document_id'].',1);"> Inactive </button>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_other_document_status('.$res['document_id'].',0);"> Active </button>';
					}
					$NewArr[]=$status;
					$NewArr[]='<a href="'.base_url().'admin/edit_other_document/'.$res['document_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_other_document()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='other_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_other_documents');
		$this->load->view('admin/footer');
	}
	public function save_other_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'doc_title', 'label'   => 'Document Title','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/other_documents');
        }
        else
        {
				$file='';
		        $imagename='';
		        if($_FILES['simage']['name'] !='')
		        {
		            $file=str_replace(" ","_",$_FILES['simage']['name']);
		            $imagepath=time().$file;
		            $this->load->library('upload');
		            $config['upload_path'] = 'assets/other_documents';
		            $config['file_name'] = $imagepath;
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

		                $imagename=$file;
		                $imagepath=$imagepath;
		            }
		        }
		        else
		        {
		            $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload employee document image</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		        }
		        $post['document_name']=$file;
		        $post['document_path']=$imagepath;
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
				$res = $this->db->insert('other_documents',$post);
				if($res==1){
					$this->session->set_flashdata('success','Employee Document Upload Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Document Upload Failed...');
				}
		}
		redirect('admin/other_documents/');
	}
	public function edit_other_document($document_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['documents']=$this->db->query("SELECT t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `other_documents` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`document_id`=$document_id")->row_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='other_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_other_documents');
		$this->load->view('admin/footer');
	}
	public function update_other_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$document_id = $this->input->post('document_id');
		$document_name=$this->input->post('document_name');
		$document_path=$this->input->post('document_path');
		$post = $this->input->post();
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'doc_title', 'label'   => 'Document Title','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/other_documents');
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
		            $config['upload_path'] = 'assets/other_documents';
		            $config['file_name'] = $imagename;
		            $config['allowed_types'] = 'jpge|jpg|png';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('simage'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png formates only</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		            }
		            else
		            {

		                $document_name=$file;
		                $document_path=$imagename;
		            }
		        }
		        else
		        {
		        	$file=$document_name;
		            $imagename=$document_path;
		        }
		        $post['document_name']=$file;
		        $post['document_path']=$imagename;
		        $post['updated_at']=$update_date;
		        $this->db->where('document_id',$document_id);
				$res = $this->db->update('other_documents',$post);
				if($res==1){
					$this->session->set_flashdata('success','Other Document Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','Other Document Updated Failed...');
				}
		}
		redirect('admin/other_documents/');
	}
	public function change_other_document_status($doc_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('document_id',$doc_id);
		$res=$this->db->update('other_documents',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Document status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Document status update failed!...</strong></div>');
		}
		redirect('admin/other_documents');
	}
	public function payroll()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='payroll';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payroll');
		$this->load->view('admin/footer');
	}
	public function get_payroll_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_payroll_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_payroll_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=$res['current_salary'];
					$NewArr[]=$res['allowence'];
					$NewArr[]=$res['claim_amt'];
					$NewArr[]=$res['rent'];
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_payroll_status('.$res['payroll_id'].',1);"> Inactive </button>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_payroll_status('.$res['payroll_id'].',0);"> Active </button>';
					}
					$NewArr[]=$status;
					$NewArr[]='<a href="'.base_url().'admin/edit_payroll/'.$res['payroll_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_payroll()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='payroll';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_payroll');
		$this->load->view('admin/footer');
	}
	public function save_payroll()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'current_salary', 'label'   => 'Current Salary','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			array( 'field'   => 'allowence', 'label'   => 'Allowence','rules'   => 'required'),
			array( 'field'   => 'claim_amt', 'label'   => 'Claim Amount','rules'   => 'required'),
			array( 'field'   => 'rent', 'label'   => 'Rent','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/payroll');
        }
        else
        {
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
				$res = $this->db->insert('payroll',$post);
				if($res==1){
					$this->session->set_flashdata('success','Payroll Upload Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Payroll Upload Failed...');
				}
		}
		redirect('admin/payroll/');
	}
	public function edit_payroll($payroll_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['payroll']=$this->db->query("SELECT t1.`payroll_id`, t1.`emp_id`, t1.`current_salary`, t1.`allowence`, t1.`claim_amt`, t1.`rent`, t1.`vibho_hr`, t1.`vibho_manager`, t1.`client_manager`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `payroll` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`payroll_id`=$payroll_id")->row_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='payroll';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_payroll');
		$this->load->view('admin/footer');
	}
	public function update_payroll()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$payroll_id = $this->input->post('payroll_id');
		$post = $this->input->post();
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'current_salary', 'label'   => 'Current Salary','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			array( 'field'   => 'allowence', 'label'   => 'Allowence','rules'   => 'required'),
			array( 'field'   => 'claim_amt', 'label'   => 'Claim Amount','rules'   => 'required'),
			array( 'field'   => 'rent', 'label'   => 'Rent','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/payroll');
        }
        else
        {
		        $post['updated_at']=$update_date;
		        $this->db->where('payroll_id',$payroll_id);
				$res = $this->db->update('payroll',$post);
				if($res==1){
					$this->session->set_flashdata('success','Payroll Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','Payroll Updated Failed...');
				}
		}
		redirect('admin/payroll/');
	}
	public function change_payroll_status($payroll_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('payroll_id',$payroll_id);
		$res=$this->db->update('payroll',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Payroll status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Payroll status update failed!...</strong></div>');
		}
		redirect('admin/payroll');
	}
	public function public_holidays()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['holiday']=$this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays`")->result_array();
		$data['active_menu']='public_holidays';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/public_holidays');
		$this->load->view('admin/footer');
	}
	public function change_holiday_status($holiday_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('public_holiday_id',$holiday_id);
		$res=$this->db->update('public_holidays',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Holiday status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Holiday status update failed!...</strong></div>');
		}
		redirect('admin/public_holidays');
	}
	public function add_holiday()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='public_holidays';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_holiday');
		$this->load->view('admin/footer');
	}
	public function save_holiday()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$name=trim($this->input->post('name'));
		$date=trim($this->input->post('date'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'name', 'label'   => 'Holiday Name','rules'   => 'required'),
			array( 'field'   => 'date', 'label'   => 'Holiday Date','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/public_holidays');
        }else{
        	$check=$this->db->get_where('public_holidays',array('date'=>$date))->num_rows();
			if($check==0){
				$data = array('name'=>$name,'date'=>$date,'is_active'=>1);
				$res=$this->db->insert('public_holidays',$data);
				if($res==1){
					$this->session->set_flashdata('success','Holiday saved successfully...');
				}else{
					$this->session->set_flashdata('failed','This Holiday saved failed!...');
				}
			}else{
				$this->session->set_flashdata('failed','This Holiday Date already existed!...');
			}
        }
		redirect('admin/public_holidays/');
	}
	public function edit_holiday($holiday_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['holidays']=$this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `public_holiday_id`=$holiday_id")->row_array();
		$data['active_menu']='public_holidays';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_holiday');
		$this->load->view('admin/footer');
	}
	public function update_holiday()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$public_holiday_id=$this->input->post('public_holiday_id');
		$name=trim($this->input->post('name'));
		$date=trim($this->input->post('date'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'name', 'label'   => 'Holiday Name','rules'   => 'required'),
			array( 'field'   => 'date', 'label'   => 'Holiday Date','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/public_holidays');
        }else{
        	$check=$this->db->get_where('public_holidays',array('date'=>$date,'public_holiday_id!='=>$public_holiday_id))->num_rows();
			if($check==0){
				$res = $this->db->update('public_holidays',array('name'=>$name,'date'=>$date),array('public_holiday_id'=>$public_holiday_id));
				if($res==1){
					$this->session->set_flashdata('success','Holiday Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Holiday updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Holiday Date already existed!...');
			}
        }
		redirect('admin/public_holidays/');
	}
	public function asset()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='asset';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/asset');
		$this->load->view('admin/footer');
	}
	public function get_asset_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_asset_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_asset_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]='<a href="'.base_url().'admin/view_emp_asset_details/'.$res['asset_id'].'/'.$res['emp_id'].'" target="_blank"> View </a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_asset_status('.$res['asset_id'].',1);"> Inactive </button>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_asset_status('.$res['asset_id'].',0);"> Active </button>';
					}
					$NewArr[]=$status;
					$NewArr[]='<a href="'.base_url().'admin/edit_asset/'.$res['asset_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_emp_asset_details($asset_id='',$emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['asset_details']=$this->db->query("SELECT `asset_id`, `emp_id`, `laptop_serial_no`, `laptop_model`, `battery_provided`, `battery_provided_no`, `charger_provided`, `charger_provided_no`, `mouse_provided`, `mouse_serial_number`, `mouse_provided_no`, `power_supply_provided`, `power_supply_provided_name`, `power_supply_model_no`, `ups_provided`, `ups_provided_no`, `carrycase_provided`, `carrycase_provided_no`, `total_asset_amt`, `asset_assigned_date`, `is_active`, `created_at`, `updated_at` FROM `asset` WHERE `asset_id`=$asset_id AND `emp_id`=$emp_id")->row_array();
		$data['active_menu']='asset';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_emp_asset_details');
		$this->load->view('admin/footer');
	}
	public function add_asset()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='asset';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_asset');
		$this->load->view('admin/footer');
	}
	public function save_asset()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		$charger_provided=@$post['charger_provided'];
		$mouse_provided=@$post['mouse_provided'];
		$ups_provided=@$post['ups_provided'];
		$carrycase_provided=@$post['carrycase_provided'];
		$charger_provided_no=@$post['charger_provided_no'];
		$mouse_provided_no=@$post['mouse_provided_no'];
		$ups_provided_no=@$post['ups_provided_no'];
		$carrycase_provided_no=@$post['carrycase_provided_no'];
		if($charger_provided=='No'&& $mouse_provided=='No' && $ups_provided=='No' && $carrycase_provided=='No'){
			if($charger_provided_no!='' || $mouse_provided_no!='' || $ups_provided_no!='' || $carrycase_provided_no!=''){
				$this->session->set_flashdata('failed','Opps! Something went to wrong...');
				redirect('admin/asset');
			}
		}
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'laptop_serial_no', 'label'   => 'Laptop Serial No','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			array( 'field'   => 'laptop_model', 'label'   => 'Laptop Model','rules'   => 'required'),
			array( 'field'   => 'asset_assigned_date', 'label'   => 'Assign Date','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/asset');
        }
        else
        {
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
				$res = $this->db->insert('asset',$post);
				if($res==1){
					$this->session->set_flashdata('success','Asset Saved Successfully...');
				}else{
					$this->session->set_flashdata('failed','Asset Saved Upload Failed...');
				}
		}
		redirect('admin/asset/');
	}
	public function edit_asset($asset_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['asset']=$this->db->query("SELECT `asset_id`, `emp_id`, `laptop_serial_no`, `laptop_model`, `battery_provided`, `battery_provided_no`, `charger_provided`, `charger_provided_no`, `mouse_provided`, `mouse_serial_number`, `mouse_provided_no`, `power_supply_provided`, `power_supply_provided_name`, `power_supply_model_no`, `ups_provided`, `ups_provided_no`, `carrycase_provided`, `carrycase_provided_no`, `total_asset_amt`, `asset_assigned_date`, `is_active` FROM `asset` WHERE `asset_id`=$asset_id")->row_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='asset';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_asset');
		$this->load->view('admin/footer');
	}
	public function update_asset()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$asset_id = $this->input->post('asset_id');
		$post = $this->input->post();
		// echo "<pre>";print_r($post);exit;
		$charger_provided=@$post['charger_provided'];
		$mouse_provided=@$post['mouse_provided'];
		$ups_provided=@$post['ups_provided'];
		$carrycase_provided=@$post['carrycase_provided'];
		if(@$charger_provided=='No'){
			$post['charger_provided_no']='';
		}
		if(@$mouse_provided=='No'){
			$post['mouse_provided_no']='';
		}
		if(@$ups_provided=='No'){
			$post['ups_provided_no']='';
		}
		if(@$carrycase_provided=='No'){
			$post['carrycase_provided_no']='';
		}
		
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'laptop_serial_no', 'label'   => 'Laptop Serial No','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
			array( 'field'   => 'laptop_model', 'label'   => 'Laptop Model','rules'   => 'required'),
			array( 'field'   => 'asset_assigned_date', 'label'   => 'Assign Date','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/asset');
        }
        else
        {
		        $post['updated_at']=$update_date;
		        $this->db->where('asset_id',$asset_id);
				$res = $this->db->update('asset',$post);
				if($res==1){
					$this->session->set_flashdata('success','Asset Deatils Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','Asset Deatils  Updated Failed...');
				}
		}
		redirect('admin/asset/');
	}
	public function change_asset_status($asset_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('asset_id',$asset_id);
		$res=$this->db->update('asset',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Asset status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Asset status update failed!...</strong></div>');
		}
		redirect('admin/asset');
	}
	public function leaves()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/leaves');
		$this->load->view('admin/footer');
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
		$totalcount=$this->loginmodel->search_leaves_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_leaves_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=$res['period_from'];
					$NewArr[]=$res['period_to'];
					$NewArr[]=$res['annual_leaves_count'];
					$NewArr[]=$res['sick_leaves_count'];
					// if($res['is_active'] == 0) {
					// 	$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',1);"> Inactive </button><br><span><b>Inactive Date </b>: '.$res["leave_id"].' </span>';
					// }else{
					// 	$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_employee_status('.$res['leave_id'].',0);"> Active </button>';
					// }
					// $NewArr[]=$status;
					$NewArr[]='<a href="'.base_url().'admin/view_employee_leaves_list/'.$res['emp_id'].'"> View</a>';
					$NewArr[]='<a href="'.base_url().'admin/edit_leaves/'.$res['leave_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_leaves_list($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$data['leaves_list']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id")->result_array();
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_leaves_list');
		$this->load->view('admin/footer');
	}
	public function change_emp_approved_leave_status($emp_id,$employee_leaves_lid,$sta)
	{
		$getGivienLeaves = $this->db->query("SELECT * FROM `leaves` WHERE `emp_id`=$emp_id")->row_array();
		$GivenAnnualLeaves = $getGivienLeaves['annual_leaves_count'];
		$GivenSickLeaves = $getGivienLeaves['sick_leaves_count'];
		$AppliedLeaves = $this->db->query("SELECT * FROM `employee_leaves_list` WHERE `employee_leaves_lid`=$employee_leaves_lid AND `emp_id`=$emp_id")->row_array();
		$AppliedLeavesType = $AppliedLeaves['leave_type'];
		$AppliedLeaves = $AppliedLeaves['leave_days'];
		if($AppliedLeavesType=='Annual Leave'){
			$DecreaseLeaves = $GivenAnnualLeaves - $AppliedLeaves;
			$AnnualArr = array('annual_leaves_count'=>$DecreaseLeaves);
			$this->db->where('emp_id',$emp_id);
			$this->db->where('leave_id',$employee_leaves_lid);
		    $this->db->update('leaves',$AnnualArr);
		}else{
			$DecreaseLeaves = $GivenSickLeaves - $AppliedLeaves;
			$AnnualArr = array('sick_leaves_count'=>$DecreaseLeaves);
			$this->db->where('emp_id',$emp_id);
			$this->db->where('leave_id',$employee_leaves_lid);
		    $this->db->update('leaves',$AnnualArr);
		}
		echo $this->db->last_query();
		$data = array('leave_status'=>$sta);
		$this->db->where('employee_leaves_lid',$employee_leaves_lid);
		$res=$this->db->update('employee_leaves_list',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Leave status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Leave status update failed!...</strong></div>');
		}
		redirect('admin/view_employee_leaves_list/'.$emp_id);
	}
	public function change_emp_reject_leave_status()
	{
		$emp_id=$this->input->post('comment_emp_id');
		$employee_leaves_lid=$this->input->post('employee_leaves_lid');
		$sta=$this->input->post('c_sta');
		$comments=$this->input->post('comments');
		$data = array('leave_status'=>$sta,'leave_rejected_reason'=>$comments);
		$this->db->where('employee_leaves_lid',$employee_leaves_lid);
		$res=$this->db->update('employee_leaves_list',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Leave rejected successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Leave rejected failed!...</strong></div>');
		}
		redirect('admin/view_employee_leaves_list/'.$emp_id);
	}
	public function add_leaves()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_leaves');
		$this->load->view('admin/footer');
	}
	public function save_leaves()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post=$this->input->post();
		$created_date =date("Y-m-d H:i:s");
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
		    redirect('admin/leaves');
        }else{
        	// $check=$this->db->get_where('clients',array('client_name'=>$client_name))->num_rows();
			// if($check==0){
				// $data = array('client_name'=>$client_name);
        	$post['is_active']=1;
        	$post['created_at']=$created_date;
				$res=$this->db->insert('leaves',$post);
				if($res==1){
					$this->session->set_flashdata('success','Levaes saved successfully...');
				}else{
					$this->session->set_flashdata('failed','This Levaes saved failed!...');
				}
			}
			// else{
			// 	$this->session->set_flashdata('failed','This Client already existed!...');
			// }
       
		redirect('admin/leaves/');
	}
	public function edit_leaves($leave_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['leaves']=$this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `created_at`, `updated_at` FROM `leaves` WHERE `leave_id`=$leave_id")->row_array();
		$emp_id=$data['leaves']['emp_id'];
		$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_leaves');
		$this->load->view('admin/footer');
	}
	public function update_leaves()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
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
		    redirect('admin/leaves');
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
       
		redirect('admin/leaves/');
	}
	public function employee_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='employee_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee_documents');
		$this->load->view('admin/footer');
	}
	public function get_employee_document_list()
	{
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_employee_docuemnt_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_employee_docuemnt_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=$res['created_at'];
					$NewArr[]='<a href="'.base_url().'admin/view_employee_all_documents/'.$res['emp_id'].'"> View All</a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_employee_document_status('.$res['employee_document_id'].',1);"> Inactive </button>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_employee_document_status('.$res['employee_document_id'].',0);"> Active </button>';
					}
					$NewArr[]=$status;
					// $NewArr[]='<a href="'.base_url().'admin/edit_employee_document/'.$res['employee_document_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_all_documents($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['documents']=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `emp_id`=$emp_id")->result_array();
		$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$data['active_menu']='employee_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_all_documents');
		$this->load->view('admin/footer');
	}
	public function delete_emp_document($employee_document_id='',$sta='')
	{
		$get_file_path = $get_file_path=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `employee_document_id`=$employee_document_id")->row_array();
		$file_path = base_url()."assets/employee_documents/".$get_file_path['doc_img_path'];
		if($file_path!='') {
			unlink($file_path);
		}  
		$this->db->where('employee_document_id',$employee_document_id);
		$res=$this->db->delete('employee_documents');
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Employee Document Deleted Successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Employee Document Deleted Failed!...</strong></div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function add_employee_document()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='employee_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee_document');
		$this->load->view('admin/footer');
	}
	public function save_employee_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$emp_id = $this->input->post('emp_id');
		$post = $this->input->post();
		// echo "<pre>";print_r($_FILES);
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'emp_id', 'label' => 'Employee','rules' => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee_documents');
        }
        else
        {
				$images = array();
				if(isset($_FILES['itcimage']['name'][0]) && !empty($_FILES['itcimage']['name'][0])){
		        foreach ($_FILES['itcimage']['name'] as $key => $image)
		        {
			            $_FILES['images']['name']= $_FILES['itcimage']['name'][$key];
			            $_FILES['images']['type']= $_FILES['itcimage']['type'][$key];
			            $_FILES['images']['tmp_name']= $_FILES['itcimage']['tmp_name'][$key];
			            $_FILES['images']['error']= $_FILES['itcimage']['error'][$key];
			            $_FILES['images']['size']= $_FILES['itcimage']['size'][$key];
			            $fileName = $image;
			            $filePath = time().str_replace(" ","_",$image);
			            $images[] = str_replace(" ","_",$fileName);
			            $images[] = $filePath;
			            $config['upload_path'] = 'assets/employee_documents';
			            $config['file_name'] = $filePath;
			            $config['allowed_types'] = 'jpge|jpg|png|pdf';
			            $config['overwrite']=true;
			            $this->load->library('upload');
			            $this->upload->initialize($config);
			            if(!$this->upload->do_upload('images'))
			            {
			                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg,png,pdf formates only</strong></div>');
			                redirect($_SERVER['HTTP_REFERER']);
			            }else
			            {
			            	if($fileName!=''){
			            		$ArrImgInsert =array('emp_id'=>$emp_id,'doc_img_name'=>$fileName,'doc_img_path'=>$filePath,'is_active'=>1,'doc_type'=>'itc','created_at'=>$created_date);
			                	$this->db->insert('employee_documents',$ArrImgInsert);
			            	}
			                
			            }
        		}
        	  }
        		
        		$images2 = array();
        		if(isset($_FILES['criminalimage']['name'][0]) && !empty($_FILES['criminalimage']['name'][0])){
		        foreach ($_FILES['criminalimage']['name'] as $key2 => $image2)
		        {
			            $_FILES['images2']['name']= $_FILES['criminalimage']['name'][$key2];
			            $_FILES['images2']['type']= $_FILES['criminalimage']['type'][$key2];
			            $_FILES['images2']['tmp_name']= $_FILES['criminalimage']['tmp_name'][$key2];
			            $_FILES['images2']['error']= $_FILES['criminalimage']['error'][$key2];
			            $_FILES['images2']['size']= $_FILES['criminalimage']['size'][$key2];
			            $fileName2 = $image2;
			            $filePath2 = time().str_replace(" ","_",$image2);
			            $images2[] = str_replace(" ","_",$fileName2);
			            $images2[] = $filePath2;
			            $config2['upload_path'] = 'assets/employee_documents';
			            $config2['file_name'] = $filePath2;
			            $config2['allowed_types'] = 'jpge|jpg|png|pdf';
			            $config2['overwrite']=true;
			            $this->load->library('upload');
			            $this->upload->initialize($config2);
			            if(!$this->upload->do_upload('images2'))
			            {
			                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg,png,pdf formates only</strong></div>');
			                redirect($_SERVER['HTTP_REFERER']);
			            }else
			            {
			            	if($fileName2!='')
			            	{
			                	$ArrImgInsert2 =array('emp_id'=>$emp_id,'doc_img_name'=>$fileName2,'doc_img_path'=>$filePath2,'is_active'=>1,'doc_type'=>'criminal','created_at'=>$created_date);
			                	$this->db->insert('employee_documents',$ArrImgInsert2);
			                }
			            }
        		} 
        	  }
        		
        		$images3 = array();
        		if(isset($_FILES['educationalimage']['name'][0]) && !empty($_FILES['educationalimage']['name'][0])){
		        foreach ($_FILES['educationalimage']['name'] as $key3 => $image3)
		        {
			            $_FILES['images3']['name']= $_FILES['educationalimage']['name'][$key3];
			            $_FILES['images3']['type']= $_FILES['educationalimage']['type'][$key3];
			            $_FILES['images3']['tmp_name']= $_FILES['educationalimage']['tmp_name'][$key3];
			            $_FILES['images3']['error']= $_FILES['educationalimage']['error'][$key3];
			            $_FILES['images3']['size']= $_FILES['educationalimage']['size'][$key3];
			            $fileName3 = $image3;
			            $filePath3 = time().str_replace(" ","_",$image3);
			            $images3[] = str_replace(" ","_",$fileName3);
			            $images3[] = $filePath3;
			            $config3['upload_path'] = 'assets/employee_documents';
			            $config3['file_name'] = $filePath3;
			            $config3['allowed_types'] = 'jpge|jpg|png|pdf';
			            $config3['overwrite']=true;
			            $this->load->library('upload');
			            $this->upload->initialize($config3);
			            if(!$this->upload->do_upload('images3'))
			            {
			                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg,png,pdf formates only</strong></div>');
			                redirect($_SERVER['HTTP_REFERER']);
			            }else
			            {
			            	if($fileName3!='')
			            	{
			                	$ArrImgInsert3 =array('emp_id'=>$emp_id,'doc_img_name'=>$fileName3,'doc_img_path'=>$filePath3,'is_active'=>1,'doc_type'=>'educational','created_at'=>$created_date);
			                	$this->db->insert('employee_documents',$ArrImgInsert3);
			                }
			            }
        		}
        	  } 
        
        		$images4 = array();
        		if(isset($_FILES['referenceimage']['name'][0]) && !empty($_FILES['referenceimage']['name'][0])){
		        foreach ($_FILES['referenceimage']['name'] as $key4 => $image4)
		        {
			            $_FILES['images4']['name']= $_FILES['referenceimage']['name'][$key4];
			            $_FILES['images4']['type']= $_FILES['referenceimage']['type'][$key4];
			            $_FILES['images4']['tmp_name']= $_FILES['referenceimage']['tmp_name'][$key4];
			            $_FILES['images4']['error']= $_FILES['referenceimage']['error'][$key4];
			            $_FILES['images4']['size']= $_FILES['referenceimage']['size'][$key4];
			            $fileName4 = $image4;
			            $filePath4 = time().str_replace(" ","_",$image4);
			            $images4[] = str_replace(" ","_",$fileName4);
			            $images4[] = $filePath4;
			            $config4['upload_path'] = 'assets/employee_documents';
			            $config4['file_name'] = $filePath4;
			            $config4['allowed_types'] = 'jpge|jpg|png|pdf';
			            $config4['overwrite']=true;
			            $this->load->library('upload');
			            $this->upload->initialize($config4);
			            if(!$this->upload->do_upload('images4'))
			            {
			                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg,png,pdf formates only</strong></div>');
			                redirect($_SERVER['HTTP_REFERER']);
			            }else
			            {
			            	if($fileName4!='')
			            	{
			                	$ArrImgInsert4 =array('emp_id'=>$emp_id,'doc_img_name'=>$fileName4,'doc_img_path'=>$filePath4,'is_active'=>1,'doc_type'=>'reference','created_at'=>$created_date);
			                	$this->db->insert('employee_documents',$ArrImgInsert4);
			                }	
			            }
        		} 
        	 } 
		       $this->session->set_flashdata('success','Employee Documents Saved Successfully...');
		       redirect('admin/employee_documents/');   
	 	}
		
	}
	public function file_download($file_id)
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
        $this->load->helper('download'); 
        $get_file_path=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `employee_document_id`=$file_id")->row_array();
        $empid = $get_file_path['emp_id'];
        $get_emp_id =$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$empid")->row_array(); 
        $file_path = "assets/employee_documents/".$get_file_path['doc_img_path'];
		$pth    =   file_get_contents(base_url().$file_path);
		$nme    =   $get_emp_id['fname'].$get_emp_id['lname'].'_emp_code_'.$get_emp_id['emp_code'].$get_file_path['doc_img_name'];
		force_download($nme, $pth);
	}
	public function edit_employee_document($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$Getemp_id=$this->db->query("SELECT `employee_document_id`, `emp_id`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `employee_document_id`=$employee_document_id")->row_array();
		$data['emp_id']=$Getemp_id['emp_id'];
		$data['documents']=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `employee_document_id`=$employee_document_id")->result_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['itc_details']=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `employee_document_id`=$employee_document_id AND `doc_type`='itc'")->result_array();
		$data['active_menu']='employee_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_employee_documents');
		$this->load->view('admin/footer');
	}
	public function update_employee_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$document_id = $this->input->post('document_id');
		$document_name=$this->input->post('document_name');
		$document_path=$this->input->post('document_path');
		$post = $this->input->post();
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'doc_title', 'label'   => 'Document Title','rules'   => 'required'),
			array( 'field'   => 'emp_id', 'label'   => 'Employee','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/other_documents');
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
		            $config['upload_path'] = 'assets/employee_documents';
		            $config['file_name'] = $imagename;
		            $config['allowed_types'] = 'jpge|jpg|png';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('simage'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png formates only</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		            }
		            else
		            {

		                $document_name=$file;
		                $document_path=$imagename;
		            }
		        }
		        else
		        {
		        	$file=$document_name;
		            $imagename=$document_path;
		        }
		        $post['document_name']=$file;
		        $post['document_path']=$imagename;
		        $post['updated_at']=$update_date;
		        $this->db->where('document_id',$document_id);
				$res = $this->db->update('other_documents',$post);
				if($res==1){
					$this->session->set_flashdata('success','Other Document Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','Other Document Updated Failed...');
				}
		}
		redirect('admin/employee_documents/');
	}
	public function change_employee_document_status($employee_document_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('employee_document_id',$employee_document_id);
		$res=$this->db->update('employee_documents',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Employee Document status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Employee Document status update failed!...</strong></div>');
		}
		redirect('admin/employee_documents');
	}
	public function payslips()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payslips');
		$this->load->view('admin/footer');
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
		$totalcount=$this->loginmodel->search_payslip_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_payslip_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';;
					$NewArr[]=$res['month'];
					$NewArr[]=$res['year'];
					$NewArr[]='<a href="'.base_url().'assets/payslips/'.$res['payslip_file_path'].'" target="_blank"> View </a>';
					$NewArr[]='<a href="'.base_url().'admin/edit_payslip/'.$res['payslip_id'].'" class="btn btn-info waves-effect waves-light"> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_payslip()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='payslips';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_payslip');
		$this->load->view('admin/footer');
	}
	public function save_payslip()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		unset($post['cpassword']);
		$emp_pwd = $this->generate_password();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'emp_id', 'label' => 'Employee','rules' => 'required'),
			array( 'field'   => 'month', 'label' => 'Month','rules' => 'required'),
			array( 'field'   => 'year', 'label'   => 'Year','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/payslips');
        }
        else
        {
				$file='';
		        $imagename='';
		        if($_FILES['simage']['name'] !='')
		        {
		            $image_name=str_replace(" ","_",$_FILES['simage']['name']);
		            $image_path=time().$image_name;
		            $this->load->library('upload');
		            $config['upload_path'] = 'assets/payslips';
		            $config['file_name'] = $image_path;
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

		                $image_name=$image_name;
		            }
		        }
		        else
		        {
		            $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload Payslip</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		        }
		        $post['payslip_file_name']=$image_name;
		        $post['payslip_file_path']=$image_path;
		        $post['created_at']=$created_date;
		        $post['is_active']=1;
				$res = $this->db->insert('payslips',$post);
				if($res==1){
					$this->session->set_flashdata('success','Payslip Created Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Payslip Created Failed...');
				}
		}
		redirect('admin/payslips/');
	}
	public function edit_payslip($payslip_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['payslip']=$this->db->query("SELECT `payslip_id`, `emp_id`, `month`, `year`, `payslip_file_name`, `payslip_file_path`, `is_active`, `created_at`, `updated_at` FROM `payslips` WHERE `payslip_id`=$payslip_id")->row_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$data['active_menu']='payslips';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_payslip');
		$this->load->view('admin/footer');
	}
	public function update_payslip()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$payslip_id = $this->input->post('payslip_id');
		$year=$this->input->post('year');
		$month=$this->input->post('month');
		$payslip_image_name=$this->input->post('payslip_file_name');
		$payslip_image_path=$this->input->post('payslip_file_path');
		$post = $this->input->post();
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'emp_id', 'label' => 'Employee','rules' => 'required'),
			array( 'field'   => 'month', 'label' => 'Month','rules' => 'required'),
			array( 'field'   => 'year', 'label'   => 'Year','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/payslips');
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
		            $config['upload_path'] = 'assets/payslips';
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
		            	$file=$file;
		                $imagename=$imagename;
		            }
		        }
		        else
		        {
		        	$file=$payslip_image_name;
		            $imagename=$payslip_image_path;
		        }
		        $post['payslip_file_name']=$file;
		        $post['payslip_file_path']=$imagename;
		        $post['updated_at']=$update_date;
		        $this->db->where('payslip_id',$payslip_id);
				$res = $this->db->update('payslips',$post);
				if($res==1){
					$this->session->set_flashdata('success','Payslip Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Payslip Updated Failed...');
				}
		}
		redirect('admin/payslips/');
	}
	public function timesheet()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->result_array();
		$data['active_menu']='timesheet';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/timesheet');
		$this->load->view('admin/footer');
	}
	public function get_timesheet_list()
	{
		$response = $this->load->view('admin/get_timesheet_list','', TRUE);
		echo "<pre>";print_r($response);exit;
		echo $response;
	}
	public function designations()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['designations']=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation`")->result_array();
		$data['active_menu']='designations';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/designations');
		$this->load->view('admin/footer');
	}
	public function change_designation_status($designation_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('designation_id',$designation_id);
		$res=$this->db->update('designation',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Designation status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Designation status update failed!...</strong></div>');
		}
		redirect('admin/designations');
	}
	public function add_designation()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='designations';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_designation');
		$this->load->view('admin/footer');
	}
	public function save_designation()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$designation_name=trim($this->input->post('designation_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'designation_name', 'label'   => 'Client Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/designations');
        }else{
        	$check=$this->db->get_where('designation',array('designation_name'=>$designation_name))->num_rows();
			if($check==0){
				$data = array('designation_name'=>$designation_name,'is_active'=>1,'created_at'=>$created_at);
				$res=$this->db->insert('designation',$data);
				if($res==1){
					$this->session->set_flashdata('success','Designation saved successfully...');
				}else{
					$this->session->set_flashdata('failed','This Designation saved failed!...');
				}
			}else{
				$this->session->set_flashdata('failed','This Designation already existed!...');
			}
        }
		redirect('admin/designations/');
	}
	public function edit_designation($designation_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation` WHERE `designation_id`=$designation_id")->row_array();
		$data['active_menu']='designations';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_designation');
		$this->load->view('admin/footer');
	}
	public function update_designation()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$designation_id=$this->input->post('designation_id');
		$designation_name=trim($this->input->post('designation_name'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'designation_name', 'label'   => 'Designation Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/designations');
        }else{
        	$check=$this->db->get_where('designation',array('designation_name'=>$designation_name,'designation_id!='=>$designation_id))->num_rows();
			if($check==0){
				$res = $this->db->update('designation',array('designation_name'=>$designation_name,'updated_at'=>$updated_date),array('designation_id'=>$designation_id));
				if($res==1){
					$this->session->set_flashdata('success','Designation Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Designation updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Designation already existed!...');
			}
        }
		redirect('admin/designations/');
	}
	public function identifications()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['identifications']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/identifications');
		$this->load->view('admin/footer');
	}
	public function change_identification_status($identification_id='',$sta='')
	{
		$data = array('is_active'=>$sta);
		$this->db->where('identification_id',$identification_id);
		$res=$this->db->update('identification_type',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Identification status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Identification status update failed!...</strong></div>');
		}
		redirect('admin/identifications');
	}
	public function add_identification()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_identification');
		$this->load->view('admin/footer');
	}
	public function save_identification()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$identification_name=trim($this->input->post('identification_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'identification_name', 'label'   => 'Identification Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/identifications');
        }else{
        	$check=$this->db->get_where('identification_type',array('identification_name'=>$identification_name))->num_rows();
			if($check==0){
				$data = array('identification_name'=>$identification_name,'is_active'=>1,'created_at'=>$created_date);
				$res=$this->db->insert('identification_type',$data);
				if($res==1){
					$this->session->set_flashdata('success','Identification saved successfully...');
				}else{
					$this->session->set_flashdata('failed','This Identification saved failed!...');
				}
			}else{
				$this->session->set_flashdata('failed','This Identification already existed!...');
			}
        }
		redirect('admin/identifications/');
	}
	public function edit_identification($identification_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `identification_id`=$identification_id")->row_array();
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_identification');
		$this->load->view('admin/footer');
	}
	public function update_identification()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$identification_id=$this->input->post('identification_id');
		$identification_name=trim($this->input->post('identification_name'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'identification_name', 'label'   => 'Identification Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/identifications');
        }else{
        	$check=$this->db->get_where('identification_type',array('identification_name'=>$identification_name,'identification_id!='=>$identification_id))->num_rows();
			if($check==0){
				$res = $this->db->update('identification_type',array('identification_name'=>$identification_name,'updated_at'=>$updated_date),array('identification_id'=>$identification_id));
				if($res==1){
					$this->session->set_flashdata('success','Identification Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Identification updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Identification already existed!...');
			}
        }
		redirect('admin/identifications/');
	}
	public function email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['email']=$this->db->query("SELECT t1.`email_id`, t1.`name`, t1.`designation`, t1.`email`, t1.`is_active`, t1.`created_at` FROM `email_ids` as t1")->result_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/email_ids');
		$this->load->view('admin/footer');
	}
	public function add_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_email_id');
		$this->load->view('admin/footer');
	}
	public function save_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$post = $this->input->post();
		$post['is_active']=1;
		$email=trim($this->input->post('email'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'email', 'label'   => 'Email Id','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/email_id');
        }else{
        	$check=$this->db->get_where('email_ids',array('email'=>$email))->num_rows();
			if($check==0){
				// $data = array('email'=>$email,'is_active'=>1,'created_at'=>$created_date);
				$res=$this->db->insert('email_ids',$post);
				if($res==1){
					$this->session->set_flashdata('success','Management Saved Successfully...');
				}else{
					$this->session->set_flashdata('failed','This Management Saved Failed!...');
				}
			}else{
				$this->session->set_flashdata('failed','This Management Already Existed!...');
			}
        }
		redirect('admin/email_id/');
	}
	public function edit_email_id($email_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['email']=$this->db->query("SELECT `email_id`, `name`, `designation`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `email_id`=$email_id")->row_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_email_id');
		$this->load->view('admin/footer');
	}
	public function update_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$email_id=$this->input->post('email_id');
		$post = $this->input->post();
		$email=trim($this->input->post('email'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'email', 'label'  => 'Email Id','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/email_id');
        }else{
        	$check=$this->db->get_where('email_ids',array('email'=>$email,'email_id!='=>$email_id))->num_rows();
			if($check==0){
				$this->db->where('email_id',$email_id);
				$res = $this->db->update('email_ids',$post);
				if($res==1){
					$this->session->set_flashdata('success','Management Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Management updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Management already existed!...');
			}
        }
		redirect('admin/email_id/');
	}
	public function employee_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['email']=$this->db->query("SELECT t1.`email_id`, t1.`emp_id`, t1.`email`, t1.`is_active`, t1.`created_at`,t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `email_ids` as t1 LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`is_active`=1  AND t1.`emp_id`!='' GROUP BY t1.`emp_id`")->result_array();
		$data['active_menu']='employee_email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee_email_ids');
		$this->load->view('admin/footer');
	}
	public function view_employee_email_ids($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['email_ids']=$this->db->query("SELECT t1.`email_id`, t1.`emp_id`, t1.`email`, t1.`is_active`, t1.`created_at`,t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `email_ids` as t1 LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id")->result_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_email_ids');
		$this->load->view('admin/footer');
	}
	public function delete_email_id($email_id='')
	{
		$this->db->where('email_id',$email_id);
		$res=$this->db->delete('email_ids');
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Email Id Deleted Successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Email Id Deleted failed!...</strong></div>');
		}
		redirect('admin/employee_email_id');
	}
	public function add_employee_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['employee']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees`")->result_array();
		$data['email']=$this->db->query("SELECT * FROM `email_ids`")->result_array();
		$data['active_menu']='employee_email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee_email_id');
		$this->load->view('admin/footer');
	}
	public function save_employee_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$emp_id=trim($this->input->post('emp_id'));
		$email_id=$this->input->post('email_id');
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'emp_id', 'label'   => 'Employee Name','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee_email_id');
        }else{
        	$this->db->where('emp_id',$emp_id);
        	$this->db->delete('email_ids');
        	foreach ($email_id as $res)
			{
				$data=array('emp_id'=>$emp_id,'email'=>$res,'is_active'=>1,'created_at'=>$created_date);
				$this->db->insert('email_ids',$data);
			}
        }
		redirect('admin/employee_email_id/');
	}
	public function edit_employee_email_id($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$data['all_emails']=$this->db->query("SELECT `email_id`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids`")->result_array();
		$data['email']=$this->db->query("SELECT `email_id`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids`")->row_array();
		$ems_id=$this->db->query("SELECT `email_id`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `emp_id`=$emp_id")->result_array();
		$rand_arr=array();
		foreach ($ems_id as $rand) {
			array_push($rand_arr,$rand['email']);
		}
		$data['rand_arr']=$rand_arr;
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='employee_email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_employee_email_id');
		$this->load->view('admin/footer');
	}
	public function update_employee_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('id');
		$emp_id=$this->input->post('emp_id');
		$email_id=$this->input->post('email_id');
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'emp_id', 'label'  => 'Employee Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/employee_email_id');
        }else{
        	$this->db->where('emp_id',$emp_id);
        	$this->db->delete('email_ids');
        	foreach ($email_id as $res)
			{
				$data=array('emp_id'=>$emp_id,'email'=>$res,'is_active'=>1,'created_at'=>$created_date);
				$this->db->insert('email_ids',$data);
			}
        }
		redirect('admin/employee_email_id/');
	}
}