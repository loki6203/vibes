<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper("url");
	}
	public function welcome()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='welcome';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/welcome');
		$this->load->view('admin/footer');
	}
	public function admin_logs($changed_emp_id='',$id='',$type='',$sta='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$emp_id=$changed_emp_id;
		if($admin_id!=''){
			$GetEmpDetails=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code` FROM `employees` WHERE `emp_id`=$admin_id")->row_array();
			$empName= $GetEmpDetails['fname'].' '.$GetEmpDetails['lname'].'_'.$GetEmpDetails['emp_code'];
		}else{
			$admin_id='NULL';
			$empName= 'Admin';
		}
		$ip = $this->input->ip_address();
		$date =date("Y-m-d H:i:s");
		$ArrData=array('admin_id'=>$admin_id,'admin_name'=>$empName,'changed_emp_id'=>$emp_id,'changed_id'=>$id,'ip_address'=>$ip,'type'=>$type,'status'=>$sta,'created_at'=>$date);
		$this->db->insert('admin_logs',$ArrData);
	}
	public function dashboard(){
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$data['all_employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id`, `phone_no`, `date_of_joining`, `local_contact_name`, `local_contact_relationship`, `local_contact_ph`, `overseas_contact_name`, `overseas_contact_relationship`, `overseas_contact_ph`, `bank_name`, `account_number`, `account_type`, `branch_name`, `reporting_manager_id`, `client_manager`, `client_id`, `identification_type_id`, `identification_number`, `identification_image_name`, `identification_image_path`, `is_active`, `comments`, `termination_date`, `is_active_date`, `is_inactive_date`, `role_id`, `created_at`, `updated_at` FROM `employees`")->num_rows();
		$data['total_clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->num_rows();
		$data['today_leave_empys']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `leave_status`=1 AND CURDATE() BETWEEN `from_date` and `to_date`")->num_rows();
		$data['today_working_empys']=($data['all_employees'])-($data['today_leave_empys']);
		$data['total_tasks']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management`")->num_rows();
		$todatDate=date('Y-m-d');
		$data['holidays']=$this->db->query("SELECT * FROM `public_holidays` WHERE `date`>='$todatDate'")->row_array();
		$data['notifications']=$this->db->query("SELECT `notification_id`, `title`, `message`, `applicable_to_all`, `is_active`, `created_at`, `is_cron_notification_run` FROM `notifications` ORDER BY `notification_id` DESC LIMIT 0,3")->result_array();
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
      		$GetMnthsData=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=$months AND `year`=$Year")->row_array();

      		$StoreAmts[$GetMnthsData['month']]=number_format(round((float)$GetMnthsData['amt'],2),2);
      		// echo $this->db->last_query();
      }
      // echo "<pre>";print_r($StoreAmts);exit;
      $data['amt']=$StoreAmts;
      $Date=date('Y-m-d');
      	$CurrentMnth=date('m');
      	$CurrentYear=date('Y');
      	$GetPreviousMnth=date('m');
      	if($GetPreviousMnth==01 || $GetPreviousMnth==1){
      		$PreviousMnth=date('m');
      	}else{
      		$PreviousMnth=date('m')-1;
      	}
      	$data['current_mnth_amt']=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=$CurrentMnth AND `year`=$CurrentYear")->row_array();
      	$CurrentMnthDays=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
      	$CurrentYearMnth=date('Y-m');
      	$data['current_mnth_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as `days_count`, `leave_type`, `leave_status` FROM `employee_leaves_list` WHERE DATE_FORMAT(`to_date`, '%Y-%m')<=$CurrentYearMnth")->row_array();
      	// echo $this->db->last_query();exit;
      	$data['last_mnth_amt']=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=$PreviousMnth AND `year`=$CurrentYear")->row_array();
      	$LastYearMnth=date('Y-'.$PreviousMnth);
      	$data['current_mnth_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as `days_count`, `leave_type`, `leave_status` FROM `employee_leaves_list` WHERE DATE_FORMAT(`to_date`, '%Y-%m')<=$LastYearMnth")->row_array();
      	$data['year_amt']=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, SUM(`gross_salary`) as `amt`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `year`=$CurrentYear")->row_array();
      	$data['current_mnth_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as `days_count`, `leave_type`, `leave_status` FROM `employee_leaves_list` WHERE DATE_FORMAT(`to_date`, '%Y')<=$CurrentYear")->row_array();
		$data['active_menu']='dashboard';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
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
	public function employee()
	{
		checklogin_admin('Employee Management');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Employee Management');
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee');
		$this->load->view('admin/footer');
	}
	public function get_employee_list()
	{
	    checklogin_admin();
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
					$NewArr[]=$res['emp_code'];
					$NewArr[]=$res['email_id'];
					$NewArr[]=DD_M_YY($res['date_of_joining']);
					$NewArr[]=DD_M_YY($res['dob']);
					$NewArr[]=$res['gender'];
					$NewArr[]=$designation_name['designation_name'];
					$NewArr[]=$res['phone_no_code'].' '.$res['phone_no'];
					$NewArr[]=@$identification_type_name['identification_name'];
					$NewArr[]=@$res['identification_number'];
					$NewArr[]=@$res['comments'];
					$NewArr[]='<a href="'.base_url().'assets/emp_identification_image/'.$res['identification_image_path'].'" target="_blank"> View Document </a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',1);"> Inactive </button>';
						$inactive_date='<span><b>Inactive Date </b>: '.DD_M_YY($res["termination_date"]).' </span>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',0);"> Active </button>';
						$inactive_date='';
					}
					$NewArr[]='<a href="'.base_url().'admin/edit_employee/'.$res['emp_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>'.' | '.$status.' | <button class="btn btn-info waves-effect waves-light" onclick="generate_password('.$res['emp_id'].');"> Generate Password </button><br>'.$inactive_date;
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function inactive_employee()
	{
		checklogin_admin('Employee Management');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Employee Management');
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/inactive_employee');
		$this->load->view('admin/footer');
	}
	public function get_inactive_employee_list()
	{
	    checklogin_admin();
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_inactive_employee_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_inactive_employee_Details(2,$start,$length,$search['value'],$column,$dir);
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
					$NewArr[]=$res['emp_code'];
					$NewArr[]=$res['email_id'];
					$NewArr[]=DD_M_YY($res['date_of_joining']);
					$NewArr[]=DD_M_YY($res['dob']);
					$NewArr[]=$res['gender'];
					$NewArr[]=$designation_name['designation_name'];
					$NewArr[]=$res['phone_no_code'].' '.$res['phone_no'];
					$NewArr[]=@$identification_type_name['identification_name'];
					$NewArr[]=@$res['identification_number'];
					$NewArr[]=@$res['comments'];
					$NewArr[]='<a href="'.base_url().'assets/emp_identification_image/'.$res['identification_image_path'].'" target="_blank"> View Document </a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',1);"> Inactive </button>';
						$inactive_date='<span><b>Inactive Date </b>: '.DD_M_YY($res["termination_date"]).' </span>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_employee_status('.$res['emp_id'].',0);"> Active </button>';
						$inactive_date='';
					}
					$NewArr[]='<a href="'.base_url().'admin/edit_employee/'.$res['emp_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>'.' | '.$status.' | <button class="btn btn-info waves-effect waves-light" onclick="generate_password('.$res['emp_id'].');"> Generate Password </button><br>'.$inactive_date;
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_employee()
	{
		checklogin_admin('Employee Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name`,`is_active` FROM `designation` WHERE `is_active`=1")->result_array();
		$data['managers']=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `is_active`=1")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name` FROM `clients`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `is_active`=1")->result_array();
		$data['generate_emp_code']=$this->db->query("SELECT MAX(`emp_code`) AS LargestEmpCode FROM employees")->row_array();
		$GetCode = trim(str_replace('VTSA','',$data['generate_emp_code']['LargestEmpCode']));
		$GererateEmpCodePlus = (@$GetCode)+(1);
		$data['GererateEmpCode'] = 'VTSA0'.$GererateEmpCodePlus;
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles` WHERE `is_active`=1")->result_array();
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee');
		$this->load->view('admin/footer');
	}
	public function generate_employee_password_email($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$this->admin_logs($emp_id,'NULL','Generated Password');
		$genertae_pwd= $this->db->query("SELECT `id`, `emp_id`, `username`, `email`, `pwd`, `is_cron_generate_pwd`, `is_cron_forgot_pwd`, `is_active`, `role_id`, `is_chk_login`, `created_at`, `updated_at` FROM `admin_login` WHERE `emp_id`=$emp_id")->row_array();
		if(!empty($genertae_pwd))
		{
			$emp_id = $genertae_pwd['emp_id'];
			$to_email = $genertae_pwd['email'];
			$data['username'] = $genertae_pwd['username'];
			$pwd = $this->generate_password();
			$data['pwd']=$pwd;
			$mesg = $this->load->view('admin/is_cron_generate_pwd',$data,true);
			$config=email_helper();
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->from('no-reply@vibhotech.com', 'Vibho Employee Solutions');
			$this->email->to($to_email); 
			$this->email->subject('Account Details');
			$this->email->message($mesg); 
			$this->email->set_mailtype("html");
			if($this->email->send())
			{
			    $this->email->clear();
				$Arrpwd=array('pwd'=>md5($pwd));
				$this->db->where('emp_id',$emp_id);
				$this->db->update('admin_login',$Arrpwd);
				$this->session->set_flashdata('success','Password Generated Successfully...');
			}else{
				$Arrpwd=array('pwd'=>md5($pwd));
				$this->db->where('emp_id',$emp_id);
				$this->db->update('admin_login',$Arrpwd);
				$this->session->set_flashdata('failed','Password Generated Successfully...');
			}
		}else{
			$this->session->set_flashdata('failed','Opps! something went to wrong...');
		}
		redirect('admin/employee');
	}
	public function is_cron_generate_pwd()
	{
		$get_generate_pwd_emp= $this->db->query("SELECT `id`, `emp_id`, `username`, `email`, `pwd`, `is_cron_generate_pwd`, `is_cron_forgot_pwd`, `is_active`, `role_id`,`is_chk_login`, `created_at`, `updated_at` FROM `admin_login` WHERE `is_cron_generate_pwd`=2 OR `is_cron_generate_pwd`=0")->result_array();
		if(!empty($get_generate_pwd_emp))
		{
			foreach ($get_generate_pwd_emp as $genertae_pwd)
			{
				$emp_id = $genertae_pwd['emp_id'];
				$get_manager_emailids=$this->db->query("SELECT `emp_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$reporting_manager_id= $get_manager_emailids['reporting_manager_id'];
				$hr_manager_id= $get_manager_emailids['hr_manager_id'];
				$lead_manager_id= $get_manager_emailids['lead_manager_id'];
				$get_reporting_manager_email_id=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `email_id`=$reporting_manager_id")->row_array();
				$get_hr_manager_email_id=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `email_id`=$hr_manager_id")->row_array();
				$get_lead_manager_email_id=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `email_id`=$lead_manager_id")->row_array();
				$to_email = $genertae_pwd['email'];
				$data['username'] = $genertae_pwd['username'];
				$pwd = $this->generate_password();
				$data['pwd']=$pwd;
				$mesg = $this->load->view('admin/is_cron_generate_pwd',$data,true);
				$config=email_helper();
				$this->load->library('email');
				$this->email->initialize($config);
				$this->email->from('no-reply@vibhotech.com', 'Vibho Employee Solutions');
				$this->email->to($to_email); 
				$this->email->subject('Account Details');
				$this->email->message($mesg); 
				$this->email->set_mailtype("html");
				if($this->email->send())
				{
				    $this->email->clear();
					$Arrpwd=array('pwd'=>md5($pwd),'is_chk_login'=>0,'is_cron_generate_pwd'=>1);
					$this->db->where('emp_id',$emp_id);
					$this->db->update('admin_login',$Arrpwd);
					echo "Cron Run Successfully...";
				}else{
					$Arrpwd=array('pwd'=>md5($pwd),'is_chk_login'=>0,'is_cron_generate_pwd'=>0);
					$this->db->where('emp_id',$emp_id);
					$this->db->update('admin_login',$Arrpwd);
					echo "This Cron Run Failed...";
				}
			}
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_forgot_pwd()
	{
		$get_forgot_pwd_emp= $this->db->query("SELECT `id`, `emp_id`, `username`, `email`, `pwd`, `is_cron_generate_pwd`, `is_cron_forgot_pwd`, `is_active`, `role_id`, `is_chk_login`, `created_at`, `updated_at` FROM `admin_login` WHERE `is_cron_forgot_pwd`=2 OR `is_cron_forgot_pwd`=0")->result_array();
		if(!empty($get_forgot_pwd_emp))
		{
			foreach ($get_forgot_pwd_emp as $forgot_pwd)
			{
				$emp_id = $forgot_pwd['emp_id'];
				$to_email = $forgot_pwd['email'];
				$data['to_email'] = $forgot_pwd['email'];
				$pwd = $this->generate_password();
				$data['pwd']=$pwd;
				$mesg = $this->load->view('admin/is_cron_forgot_pwd',$data,true);
				$config=email_helper();
				$this->load->library('email');
				$this->email->initialize($config);
				$this->email->from('no-reply@vibhotech.com', 'Vibho Employee Solutions');
				$this->email->to($to_email); 
				$this->email->subject('Reset Password');
				$this->email->message($mesg); 
				$this->email->set_mailtype("html");
				if($this->email->send())
				{
					$Arrpwd=array('pwd'=>md5($pwd),'is_cron_forgot_pwd'=>1);
					$this->db->where('emp_id',$emp_id);
					$this->db->update('admin_login',$Arrpwd);
					echo "Cron Run Successfully...";
				}else{
					$Arrpwd=array('pwd'=>md5($pwd),'is_cron_forgot_pwd'=>0);
					$this->db->where('emp_id',$emp_id);
					$this->db->update('admin_login',$Arrpwd);
					echo "This Cron Run Failed...";
				}
			}
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_inprogress_leaves()
	{
		$get_inprogress_leave= $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `is_cron_inprogress_email_sent`, `is_cron_approved_email_sent`, `is_cron_rejected_email_sent`, `is_cron_cancelled_user_email_sent`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `is_cron_inprogress_email_sent`=2 OR `is_cron_inprogress_email_sent`=0")->result_array();
		if(!empty($get_inprogress_leave))
		{
			foreach ($get_inprogress_leave as $inprogress_leave)
			{
				$employee_leaves_lid = $inprogress_leave['employee_leaves_lid'];
				$emp_id = $inprogress_leave['emp_id'];
				$Get_managers_ids=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$hr_manager_id=$Get_managers_ids['hr_manager_id'];
				$lead_manager_id=$Get_managers_ids['lead_manager_id'];
				
				$data['GetEmpDetails']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$to_email=$data['GetEmpDetails']['email_id'];
				$data['leave_type'] = $inprogress_leave['leave_type'];
				$data['from_date'] = $inprogress_leave['from_date'];
				$data['to_date'] = $inprogress_leave['to_date'];
				if($inprogress_leave['leave_type']=='Annual Leave'){
					$LType='Annual Leaves';
				}else{
					$LType='Sick Leaves';
				}
				$this->sent_email_to_employee('Inprogress',$to_email,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_hr('Inprogress',$hr_manager_id,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_lead_manager('Inprogress',$lead_manager_id,$LType,$employee_leaves_lid,$data);
			}
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_approved_leaves()
	{
		$get_approved_leave= $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `is_cron_inprogress_email_sent`, `is_cron_approved_email_sent`, `is_cron_rejected_email_sent`, `is_cron_cancelled_user_email_sent`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `is_cron_approved_email_sent`=2 OR `is_cron_approved_email_sent`=0")->result_array();
		if(!empty($get_approved_leave))
		{
			foreach ($get_approved_leave as $approved_leave)
			{
				$employee_leaves_lid = $approved_leave['employee_leaves_lid'];
				$emp_id = $approved_leave['emp_id'];
				$data['GetEmpDetails']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$to_email=$data['GetEmpDetails']['email_id'];
				$Get_managers_ids=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$hr_manager_id=$Get_managers_ids['hr_manager_id'];
				$lead_manager_id=$Get_managers_ids['lead_manager_id'];
				$data['leave_type'] = $approved_leave['leave_type'];
				$data['from_date'] = $approved_leave['from_date'];
				$data['to_date'] = $approved_leave['to_date'];
				if($approved_leave['leave_type']=='Annual Leave'){
					$LType='Annual Leaves';
				}else{
					$LType='Sick Leaves';
				}
				$this->sent_email_to_employee('Approved',$to_email,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_hr('Approved',$hr_manager_id,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_lead_manager('Approved',$lead_manager_id,$LType,$employee_leaves_lid,$data);
			}
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_rejected_leaves()
	{
		$get_rejecte_emp_leave= $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `is_cron_inprogress_email_sent`, `is_cron_approved_email_sent`, `is_cron_rejected_email_sent`, `is_cron_cancelled_user_email_sent`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `is_cron_rejected_email_sent`=2 OR `is_cron_rejected_email_sent`=0")->result_array();
		if(!empty($get_rejecte_emp_leave))
		{
			foreach ($get_rejecte_emp_leave as $rejcte_emp_leave)
			{
				$employee_leaves_lid = $rejcte_emp_leave['employee_leaves_lid'];
				$emp_id = $rejcte_emp_leave['emp_id'];
				$data['GetEmpDetails']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$to_email=$data['GetEmpDetails']['email_id'];
				$Get_managers_ids=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$hr_manager_id=$Get_managers_ids['hr_manager_id'];
				$lead_manager_id=$Get_managers_ids['lead_manager_id'];
				$data['leave_type'] = $rejcte_emp_leave['leave_type'];
				$data['from_date'] = $rejcte_emp_leave['from_date'];
				$data['to_date'] = $rejcte_emp_leave['to_date'];
				if($rejcte_emp_leave['leave_type']=='Annual Leave'){
					$LType='Annual Leaves';
				}else{
					$LType='Sick Leaves';
				}
				$this->sent_email_to_employee('Rejected',$to_email,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_hr('Rejected',$hr_manager_id,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_lead_manager('Rejected',$lead_manager_id,$LType,$employee_leaves_lid,$data);
			}		
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_cancelled_leaves()
	{
		$get_cancelled_emp_leave= $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `is_cron_inprogress_email_sent`, `is_cron_approved_email_sent`, `is_cron_rejected_email_sent`, `is_cron_cancelled_user_email_sent`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `is_cron_cancelled_user_email_sent`=2 OR `is_cron_cancelled_user_email_sent`=0")->result_array();
		if(!empty($get_cancelled_emp_leave))
		{
			foreach ($get_cancelled_emp_leave as $cancelled_emp_leave)
			{
				$employee_leaves_lid = $cancelled_emp_leave['employee_leaves_lid'];
				$emp_id = $cancelled_emp_leave['emp_id'];
				$data['GetEmpDetails']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$to_email=$data['GetEmpDetails']['email_id'];
				$Get_managers_ids=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
				$hr_manager_id=$Get_managers_ids['hr_manager_id'];
				$lead_manager_id=$Get_managers_ids['lead_manager_id'];
				$data['leave_type'] = $cancelled_emp_leave['leave_type'];
				$data['from_date'] = $cancelled_emp_leave['from_date'];
				$data['to_date'] = $cancelled_emp_leave['to_date'];
				if($cancelled_emp_leave['leave_type']=='Annual Leave'){
					$LType='Annual Leaves';
				}else{
					$LType='Sick Leaves';
				}
				$this->sent_email_to_employee('Cancelled By Employee',$to_email,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_hr('Cancelled By Employee',$hr_manager_id,$LType,$employee_leaves_lid,$data);
				$this->sent_email_to_lead_manager('Cancelled By Employee',$lead_manager_id,$LType,$employee_leaves_lid,$data);
			}
		}else{
			echo "no data found...";
		}
	}
	public function sent_email_to_employee($Type='',$to_email='',$LType='',$employee_leaves_lid='',$data='')
	{
		if($Type!='' && $to_email!='' && $LType!='' && $employee_leaves_lid!='' && !empty($data))
		{
			$data['CRON_TYPE']='Employee';
			if($Type=='Inprogress'){
				$Employee_html = $this->load->view('admin/is_cron_inprogress_leaves',$data,true);
				$updateColumn='is_cron_inprogress_email_sent';
			}else if($Type=='Approved'){
				$Employee_html = $this->load->view('admin/is_cron_approved_leaves',$data,true);
				$updateColumn='is_cron_approved_email_sent';
			}else if($Type=='Rejected'){
				$Employee_html = $this->load->view('admin/is_cron_rejected_leaves',$data,true);
				$updateColumn='is_cron_rejected_email_sent';
			}else if($Type=='Cancelled By Employee'){
				$Employee_html = $this->load->view('admin/is_cron_cancelled_leaves',$data,true);
				$updateColumn='is_cron_cancelled_user_email_sent';
			}else{
				$Employee_html='';
				$updateColumn='';
			}
			$config=email_helper();
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->from('no-reply@vibhotech.com', 'Vibho Employee Solutions');
			$this->email->to($to_email); 
			$this->email->subject($Type.' '.$LType);
			$this->email->message($Employee_html);
			$this->email->set_mailtype("html");
			if($this->email->send())
			{
				$Arrpwd=array($updateColumn=>1);
				$this->db->where('employee_leaves_lid',$employee_leaves_lid);
				$this->db->update('employee_leaves_list',$Arrpwd);
				echo "Cron Run Successfully...";
			}else{
				$Arrpwd=array($updateColumn=>0);
				$this->db->where('employee_leaves_lid',$employee_leaves_lid);
				$this->db->update('employee_leaves_list',$Arrpwd);
				echo "Cron Run Failed...";
			}
		}
	}
	public function sent_email_to_hr($Type='',$hr_manager_id='',$LType='',$employee_leaves_lid='',$data='')
	{
		if($Type!='' && $hr_manager_id!='' && $LType!='' && $employee_leaves_lid!='' && !empty($data))
		{
			$Get_hr_manager_email_id=$this->db->query("SELECT `emp_id`, `email_id`, `hr_manager_id` FROM `employees` WHERE `emp_id`=$hr_manager_id")->row_array();
			$data['CRON_TYPE']='HR';
			if($Type=='Inprogress'){
				$HR_html = $this->load->view('admin/is_cron_inprogress_leaves',$data,true);
			}else if($Type=='Approved'){
				$HR_html = $this->load->view('admin/is_cron_approved_leaves',$data,true);
			}else if($Type=='Rejected'){
				$HR_html = $this->load->view('admin/is_cron_rejected_leaves',$data,true);
			}else if($Type=='Cancelled By Employee'){
				$HR_html = $this->load->view('admin/is_cron_cancelled_leaves',$data,true);
			}else{
				$HR_html='';
			}
			$config=email_helper();
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->from('no-reply@vibhotech.com', 'Vibho Employee Solutions');
			$this->email->to($Get_hr_manager_email_id['email_id']); 
			$this->email->subject($Type.' '.$LType);
			$this->email->message($HR_html);
			$this->email->set_mailtype("html");
			$this->email->send();
		}
	}
	public function sent_email_to_lead_manager($Type='',$lead_manager_id='',$LType='',$employee_leaves_lid='',$data='')
	{
		if($Type!='' && $lead_manager_id!='' && $LType!='' && $employee_leaves_lid!='' && !empty($data))
		{
        	$Get_lead_manager_email_id=$this->db->query("SELECT `emp_id`, `email_id`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$lead_manager_id")->row_array();
        	$data['CRON_TYPE']='LEAD MANAGER';
        	if($Type=='Inprogress'){
				$Lead_html = $this->load->view('admin/is_cron_inprogress_leaves',$data,true);
			}else if($Type=='Approved'){
				$Lead_html = $this->load->view('admin/is_cron_approved_leaves',$data,true);
			}else if($Type=='Rejected'){
				$Lead_html = $this->load->view('admin/is_cron_rejected_leaves',$data,true);
			}else if($Type=='Cancelled By Employee'){
				$Lead_html = $this->load->view('admin/is_cron_cancelled_leaves',$data,true);
			}else{
				$Lead_html='';
			}
			$this->email->from('no-reply@vibhotech.com', 'Vibho Employee Solutions');
			$this->email->to($Get_lead_manager_email_id['email_id']); 
			$this->email->subject($Type.' '.$LType);
			$this->email->message($Lead_html);
			$this->email->set_mailtype("html");
			$this->email->send();
        }
	}
	public function is_cron_employee_termination()
	{
	    $date = date("Y-m-d");
		$get_termination_employee= $this->db->query("SELECT `emp_id`, `fname`, `lname`, `termination_date`, `is_active_date`, `is_inactive_date` FROM `employees` WHERE `termination_date`='$date'")->result_array();
		if(!empty($get_termination_employee))
		{
			foreach ($get_termination_employee as $get_termination_emp)
			{
			    $emp_id=$get_termination_emp['emp_id'];
                $Arrpwd=array('is_active'=>0,'is_inactive_date'=>date("Y-m-d H:i:s"));
                $this->db->where('emp_id',$emp_id);
                $this->db->update('employees',$Arrpwd);
                echo "Cron Run Successfully...";
			}
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_deleted_leaves()
	{
	    $today_date = date("Y-m-d");
        $date = date( "Y-m-d", strtotime( $today_date . "-1 day"));
		$get_leaves_delete= $this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `created_at`, `updated_at`, `is_delete` FROM `leaves` WHERE `period_to`='$date'")->result_array();
		if(!empty($get_leaves_delete))
		{
			foreach ($get_leaves_delete as $get_leaves_del)
			{
			    $emp_id=$get_leaves_del['emp_id'];
			    $get_leaves_list_delete= $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `is_cron_inprogress_email_sent`, `is_cron_approved_email_sent`, `is_cron_rejected_email_sent`, `is_cron_cancelled_user_email_sent`, `reason`, `leave_rejected_reason`, `approved_date`, `rejected_by_admin_date`, `cancelled_by_user_date`, `created_at`, `updated_at`, `is_delete` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `to_date`>='$date'")->result_array();
                $Arrpwd=array('is_delete'=>0,'is_delete_date'=>date("Y-m-d H:i:s"));
                $this->db->where('emp_id',$emp_id);
                $this->db->update('leaves',$Arrpwd);
                foreach($get_leaves_list_delete as $leaves_list)
                {
                   $this->db->where('emp_id',$emp_id);
                   $this->db->update('employee_leaves_list',$Arrpwd); 
                }
			}
		echo "Cron Run Successfully...";
		}else{
			echo "no data found...";
		}
	}
	public function is_cron_deleted_leaves_list()
	{
	    $date = date("Y-m-d");
		$get_leaves_delete= $this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `is_cron_inprogress_email_sent`, `is_cron_approved_email_sent`, `is_cron_rejected_email_sent`, `is_cron_cancelled_user_email_sent`, `reason`, `leave_rejected_reason`, `approved_date`, `rejected_by_admin_date`, `cancelled_by_user_date`, `created_at`, `updated_at`, `is_delete` FROM `employee_leaves_list` WHERE `to_date`>'$date'")->result_array();
		if(!empty($get_leaves_delete))
		{
			foreach ($get_leaves_delete as $get_leaves_del)
			{
			    $emp_id=$get_leaves_del['emp_id'];
                $Arrpwd=array('is_delete'=>0,'is_delete_date'=>date("Y-m-d H:i:s"));
                $this->db->where('emp_id',$emp_id);
                $this->db->update('leaves',$Arrpwd);
                echo "Cron Run Successfully...";
			}
		}else{
			echo "no data found...";
		}
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
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		if($post['email_id']!=''){
			$Chk=$this->db->select('email_id')->get_where('employees',array('email_id'=>$post['email_id']))->num_rows();
			if($Chk!=0){
				$this->session->set_flashdata('failed','This Emial Id Already Existed...');
				redirect('admin/employee');
			}
		}
		if($post['personal_email_id']!=''){
			$PersonalChk=$this->db->select('personal_email_id')->get_where('employees',array('personal_email_id'=>$post['personal_email_id']))->num_rows();
			if($PersonalChk!=0){
				$this->session->set_flashdata('failed','This Emial Id Already Existed...');
				redirect('admin/employee');
			}
		}
		unset($post['e_code']);
		unset($post['cpassword']);
		$DateOfJoining=YY_MM_DD($post['date_of_joining']);
		$DateOfBirth=YY_MM_DD($post['dob']);
		$post['date_of_joining']=$DateOfJoining;
		$post['dob']=$DateOfBirth;
		if($post['role_id']==''){
			$post['role_id']='Employee';
		}else{
			$post['role_id']=$post['role_id'];
		}
		$emp_pwd = $this->generate_password();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'fname', 'label'   => 'First Name','rules'   => 'required'),
			array( 'field'   => 'lname', 'label'   => 'Last Name','rules'   => 'required'),
			array( 'field'   => 'email_id', 'label'   => 'Email Id','rules'   => 'required'),
			array( 'field'   => 'date_of_joining', 'label'   => 'Date Of Joining','rules'   => 'required'),
			array( 'field'   => 'dob', 'label'   => 'Date of Birth','rules'   => 'required'),
			array( 'field'   => 'designation_id', 'label'   => 'Designation','rules'   => 'required'),
			array( 'field'   => 'employment_type', 'label'   => 'Employment Type','rules'   => 'required'),
			array( 'field'   => 'local_contact_name', 'label'   => 'Local Contact Name','rules'   => 'required'),
			array( 'field'   => 'local_contact_relationship', 'label'   => 'Local Contact Relationship','rules'   => 'required'),
			array( 'field'   => 'local_contact_ph', 'label'   => 'Local Contact Mobile No','rules'   => 'required'),
			//array( 'field'   => 'overseas_contact_ph', 'label'   => 'Overseas Contact Mpbile No','rules'   => 'required'),
			//array( 'field'   => 'overseas_contact_name', 'label'   => 'Overseas Contact Name','rules'   => 'required'),
			//array( 'field'   => 'overseas_contact_relationship', 'label'   => 'Overseas Contact Relationship','rules'   => 'required'),
			array( 'field'   => 'bank_name', 'label'   => 'Bank Name','rules'   => 'required'),
			array( 'field'   => 'account_number', 'label'   => 'Account Number','rules'   => 'required'),
			array( 'field'   => 'account_type', 'label'   => 'Account Type','rules'   => 'required'),
			array( 'field'   => 'branch_name', 'label'   => 'Branch Name','rules'   => 'required'),
			array( 'field'   => 'reporting_manager_id', 'label'   => 'Reporting Manager','rules'   => 'required'),
			array( 'field'   => 'client_manager', 'label'   => 'client Manager','rules'   => 'required'),
			array( 'field'   => 'client_id', 'label'   => 'client','rules'   => 'required'),
			array( 'field'   => 'leaves_included_in_contract', 'label'   => 'Leaves included in contract','rules'   => 'required'),
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
		            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
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
				$res = $this->db->insert('employees',$post);
				$insert_id = $this->db->insert_id();
				$this->admin_logs($insert_id,$insert_id,'Add Employee');
				$data['generate_emp_code']=$this->db->query("SELECT MAX(`emp_code`) AS LargestEmpCode FROM employees")->row_array();
		        $GetCode = trim(str_replace('VTSA','',$data['generate_emp_code']['LargestEmpCode']));
		        $Create_EmpCode = ($GetCode)+(1);
				$emp_code_arr=array('emp_code'=>'VTSA0'.$Create_EmpCode);
				$this->db->where('emp_id',$insert_id);
				$this->db->update('employees',$emp_code_arr);
				$ArrLoginInsert=array('emp_id'=>$insert_id,'username'=>'VTSA0'.$Create_EmpCode,'email'=>$email,'is_active'=>1,'role_id'=>$post['role_id'],'is_chk_login'=>0,'created_at'=>$created_date);
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
				$responseArr['message']="This email id already existed...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another email id";
		}
		echo json_encode($responseArr);
	}
	public function check_personal_employee_email()
	{
		$responseArr['status']="success";
		$responseArr['message']="";
		$personal_email_id=trim($this->input->post('personal_email_id'));
		if($personal_email_id!='')
		{
			$res=$this->db->select('personal_email_id')->get_where('employees',array('personal_email_id'=>$personal_email_id))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This email id already existed...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another email id";
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
				$responseArr['message']="This email id already existed...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another email id";
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
			$res=$this->db->select('emp_id','email_id')->get_where('employees',array('email_id'=>$email_id,'emp_id!='=>$emp_id))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This email id already existed...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another email id";
		}
		echo json_encode($responseArr);
	}
	public function check_update_emp_personal_email()
	{
		$responseArr['status']="success";
		$responseArr['message']="";
		$emp_id=trim($this->input->post('emp_id'));
		$personal_email_id=trim($this->input->post('personal_email_id'));
		if($personal_email_id!='')
		{
			$res=$this->db->select('emp_id','personal_email_id')->get_where('employees',array('personal_email_id'=>$personal_email_id,'emp_id!='=>$emp_id))->row_array();
			if(!empty($res)){
				$responseArr['status']="fail";
				$responseArr['message']="This email id already existed...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another email id";
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
				$responseArr['message']="This employee code already existed...";
			}
		}else{
			$responseArr['status']="fail";
			$responseArr['message']="Please enter another employee code";
		}
		echo json_encode($responseArr);
	}
	public function edit_employee($emp_id='')
	{
		checklogin_admin('Employee Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name` FROM `designation`")->result_array();
		$data['managers']=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `is_active`=1")->result_array();
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name` FROM `clients`")->result_array();
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['employee']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`employment_type`, t1.`personal_email_id`, t1.`email_id`, t1.`phone_no_code`, t1.`phone_no`, t1.`date_of_joining`, t1.`permanent_address`, t1.`present_address`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph_code`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph_code`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`ifsc_code`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`,t1.`hr_manager_id`,t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`is_active`, t1.`role_id`, t1.`leaves_included_in_contract`, t1.`created_at`, t1.`updated_at`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` LEFT JOIN `clients` as `t3` ON `t1`.`client_id` = `t3`.`client_id` WHERE t1.`emp_id`=$emp_id")->row_array();
		$data['Compensation']=$this->db->query("SELECT `compensation_details_id`, `employee_id`, `earnings_and_deductions_id`, `BASCI`, `HRA`, `CONVEYANCE`, `MEDICAL_ALLOWANCE`, `OTHER_BENEFITS`, `VARIABLES`, `GROSS_TOTAL`, `PT`, `PF`, `TDS`, `OTHERS`, `DEDUCTIONS`, `NET_PAY`, `Hourly_Rate`, `created_at`, `updated_at` FROM `employees_compensation_details` WHERE `employee_id`=$emp_id")->row_array();
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='employee';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_employee');
		$this->load->view('admin/footer');
	}
	public function update_employee()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$emp_id = $this->input->post('emp_id');
		$identification_image_name=$this->input->post('identification_image_name');
		$identification_image_path=$this->input->post('identification_image_path');
		$post = $this->input->post();
		if($post['email_id']!=''){
			$Chk=$this->db->select('email_id')->get_where('employees',array('email_id'=>$post['email_id'],'emp_id!='=>$emp_id))->num_rows();
			if($Chk!=0){
				$this->session->set_flashdata('failed','This Emial Id Already Existed...');
				redirect('admin/employee');
			}
		}
		if($post['personal_email_id']!=''){
			$PersonalChk=$this->db->select('personal_email_id')->get_where('employees',array('personal_email_id'=>$post['personal_email_id'],'emp_id!='=>$emp_id))->num_rows();
			if($PersonalChk!=0){
				$this->session->set_flashdata('failed','This Emial Id Already Existed...');
				redirect('admin/employee');
			}
		}
		// echo "<pre>";print_r($post);exit;
		$DateOfJoining=YY_MM_DD($post['date_of_joining']);
		$DateOfBirth=YY_MM_DD($post['dob']);
		$post['date_of_joining']=$DateOfJoining;
		$post['dob']=$DateOfBirth;
		if($post['role_id']==''){
			$post['role_id']='Employee';
		}else{
			$post['role_id']=$post['role_id'];
		}
		$this->admin_logs($emp_id,$post['emp_id'],'Update Employee');
		unset($post['e_code']);
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'fname', 'label'   => 'First Name','rules'   => 'required'),
			array( 'field'   => 'lname', 'label'   => 'Last Name','rules'   => 'required'),
			array( 'field'   => 'email_id', 'label'   => 'Email Id','rules'   => 'required'),
			array( 'field'   => 'date_of_joining', 'label'   => 'Date Of Joining','rules'   => 'required'),
			array( 'field'   => 'dob', 'label'   => 'Date of Birth','rules'   => 'required'),
			array( 'field'   => 'designation_id', 'label'   => 'Designation','rules'   => 'required'),
			array( 'field'   => 'employment_type', 'label'   => 'Employment Type','rules'   => 'required'),
			array( 'field'   => 'local_contact_name', 'label'   => 'Local Contact Name','rules'   => 'required'),
			array( 'field'   => 'local_contact_relationship', 'label'   => 'Local Contact Relationship','rules'   => 'required'),
			array( 'field'   => 'local_contact_ph', 'label'   => 'Local Contact Mobile No','rules'   => 'required'),
			//array( 'field'   => 'overseas_contact_ph', 'label'   => 'Overseas Contact Mpbile No','rules'   => 'required'),
			//array( 'field'   => 'overseas_contact_name', 'label'   => 'Overseas Contact Name','rules'   => 'required'),
			//array( 'field'   => 'overseas_contact_relationship', 'label'   => 'Overseas Contact Relationship','rules'   => 'required'),
			array( 'field'   => 'bank_name', 'label'   => 'Bank Name','rules'   => 'required'),
			array( 'field'   => 'account_number', 'label'   => 'Account Number','rules'   => 'required'),
			array( 'field'   => 'account_type', 'label'   => 'Account Type','rules'   => 'required'),
			array( 'field'   => 'branch_name', 'label'   => 'Branch Name','rules'   => 'required'),
			array( 'field'   => 'reporting_manager_id', 'label'   => 'Reporting Manager','rules'   => 'required'),
			array( 'field'   => 'client_manager', 'label'   => 'client Manager','rules'   => 'required'),
			array( 'field'   => 'client_id', 'label'   => 'client','rules'   => 'required'),
			array( 'field'   => 'leaves_included_in_contract', 'label'   => 'Leaves included in contract','rules'   => 'required'),
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
		            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
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
		                unlink("assets/emp_identification_image/".$post['identification_image_path']);
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
				$this->db->update('employees',$post);
				$UpdateArr=array('email'=>$post['email_id'],'role_id'=>$post['role_id']);
				$this->db->where('emp_id',$post['emp_id']);
				$res=$this->db->update('admin_login',$UpdateArr);
				$GetLeavesArr=array('hr_manager_id'=>$post['hr_manager_id'],'lead_manager_id'=>$post['lead_manager_id']);
				$this->db->where('emp_id',$emp_id);
				$this->db->update('leaves',$GetLeavesArr);
				if($res==1){
					$this->session->set_flashdata('success','Employee Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Employee Updated Failed...');
				}
		}
		redirect('admin/employee/');
	}
	public function change_employee_status($emp_id='',$sta='')
	{
	    checklogin_admin('Employee Management','Write');
	    $this->admin_logs($emp_id,'NULL','Change Status Employee',$sta);
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
	    checklogin_admin('Employee Management','Write');
		$emp_id=$this->input->post('comment_emp_id');
		$sta=$this->input->post('comment_sta');
		$comments=$this->input->post('comments');
		$this->admin_logs($emp_id,'NULL','Change Status Employee',$sta);
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
	public function export_employees()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$dt=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `employment_type`, `email_id`, `personal_email_id`, `phone_no_code`, `phone_no`, `permanent_address`, `present_address`, `date_of_joining`, `local_contact_name`, `local_contact_relationship`, `local_contact_ph_code`, `local_contact_ph`, `overseas_contact_name`, `overseas_contact_relationship`, `overseas_contact_ph_code`, `overseas_contact_ph`, `bank_name`, `account_number`, `account_type`, `branch_name`, `reporting_manager_id`, `hr_manager_id`, `lead_manager_id`, `client_manager`, `client_id`, `identification_type_id`, `identification_number`, `identification_image_name`, `identification_image_path`, `is_active`, `comments`, `termination_date`, `is_active_date`, `is_inactive_date`, `role_id`, `leaves_included_in_contract`, `created_at`, `updated_at` FROM `employees`")->result_array();
		$date =date('d-M-Y');
		$name = 'Employees_'.$date;
        $name=$name.'.xls';
        header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: Attachment; filename=$name");
		$aa ="S.No\tEmployee Name\tEmail Id\tPersonal Email Id\tGender\tDate Of Birth\tEmployee Code\tDesignation\tEmployement Type\tPhone No\tDate of Joining\tPermanent Address\tPresent Address\tLocal Contact Name\tLocal Contact Relationship\tLocal Contact Phone No\tOverseas Contact Name\tOverseas Contact Relationship\tOverseas Contact Phone\tBank Name\tAccount Number\tAccount Type\tBranch Name\tReporting Manager\tHR Manager\tLead Manager\tClient Manager\tClient\tIdentification Type\tIdentification Number\tActive\tComments\tTermination Date\tRole\tLeaves Inclided in Contact\tCreated Date\n";
		$counter=1;
		foreach($dt as $k=>$val){
		    if($val['designation_id']!=''){
		    	$designation_id=$val['designation_id'];
				$designation_name=$this->db->query("SELECT `designation_id`, `designation_name` FROM `designation` WHERE `designation_id`=$designation_id")->row_array();
				$designation=@$designation_name['designation_name'];
			}else{
				$designation='';
			}
			if($val['reporting_manager_id']!=''){
				$reporting_manager_id=$val['reporting_manager_id'];
				$reporting_manager_name=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email` FROM `email_ids` WHERE `email_id`=$reporting_manager_id")->row_array();
				$reporting_manager=@$reporting_manager_name['name'];
			}else{
				$reporting_manager='';
			}
			if($val['hr_manager_id']!=''){
				$hr_manager_id=$val['hr_manager_id'];
				$hr_manager_name=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email` FROM `email_ids` WHERE `email_id`=$hr_manager_id")->row_array();
				$hr_manager=@$hr_manager_name['name'];
			}else{
				$hr_manager='';
			}
			if($val['lead_manager_id']!=''){
				$lead_manager_id=$val['lead_manager_id'];
				$lead_manager_name=$this->db->query("SELECT `email_id`, `name`, `designation`, `emp_id`, `email` FROM `email_ids` WHERE `email_id`=$lead_manager_id")->row_array();
				$lead_manager=@$lead_manager_name['name'];
			}else{
				$lead_manager='';
			}
			if($val['client_id']!=''){
				$client_id=$val['client_id'];
				$client_name=$this->db->query("SELECT `client_id`, `client_name` FROM `clients` WHERE `client_id`=$client_id")->row_array();
				$client=@$client_name['client_name'];
			}else{
				$client='';
			}
			if($val['identification_type_id']!=''){
				$identification_type_id=$val['identification_type_id'];
				$identification_type_name=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `identification_id`=$identification_type_id")->row_array();
				$identification_type=@$identification_type_name['$identification_name'];
			}else{
				$identification_type='';
			}
			if($val['role_id']=='Employee'){
				$role='Employee';
			}else if($val['role_id']=='Admin'){
				$role='Admin';
			}else{
				$role='';
			}
			if($val['is_active']==1){
				$Status='Active';
			}else{
				$Status='Inactive';
			}
			 $aa.=$counter."\t".$val['fname'].$val['lname']."\t".$val['email_id']."\t".$val['personal_email_id']."\t".$val['gender']."\t".$val['dob']."\t".$val['emp_code']."\t".$designation."\t".$val['employment_type']."\t".$val['phone_no_code'].' '.$val['phone_no']."\t".$val['date_of_joining']."\t".$val['permanent_address']."\t".$val['present_address']."\t".$val['local_contact_name']."\t".$val['local_contact_relationship']."\t".$val['local_contact_ph_code'].' '.$val['local_contact_ph']."\t".$val['overseas_contact_name']."\t".$val['overseas_contact_relationship']."\t".$val['overseas_contact_ph_code'].' '.$val['overseas_contact_ph']."\t".$val['bank_name']."\t".$val['account_number']."\t".$val['account_type']."\t".$val['branch_name']."\t".$reporting_manager."\t".$hr_manager."\t".$lead_manager."\t".$val['client_manager']."\t".$client."\t".$identification_type."\t".$val['identification_number']."\t".$Status."\t".$val['comments']."\t".$val['termination_date']."\t".$role."\t".$val['leaves_included_in_contract']."\t".$val['created_at']."\n";
             $counter++;
        }
        echo $aa;
	}
	public function first_change_password()
	{
		checklogin_admin();
		$emp_id=$this->session->userdata('emp_id');
		$this->load->view('admin/first_change_password');
	}
	public function first_update_password()
	{
		checklogin_admin();
		$this->admin_logs('NULL','NULL','Updated Password');
		$admin_id=$this->session->userdata('emp_id');
		$old_password=md5($this->input->post('old_password'));
		$new_password=md5($this->input->post('new_password'));
		$confirm_password=md5($this->input->post('confirm_password'));
		$update_date =date("Y-m-d H:i:s");
		if($new_password==$confirm_password){
			$res=$this->db->get_where('admin_login',array('emp_id'=>$admin_id,'pwd'=>$old_password))->result_array();
			if(count($res)>0){
				$data=array('pwd'=>$new_password,'updated_at'=>$updated_at,'is_chk_login'=>1);
				$this->db->where('emp_id',$admin_id);
				$this->db->update('admin_login',$data);
				$emp_id=$this->session->userdata('emp_id');
        		$username=$this->session->userdata('username');
        		$ip = $this->input->ip_address();
        		$date =date("Y-m-d H:i:s");
        		$ArrData=array('username'=>$username,'emp_id'=>$emp_id,'ip_address'=>$ip,'created_at'=>$date);
        		$this->db->insert('change_password_history',$ArrData);
				$this->session->set_flashdata('success','Password updated successfully...</strong></div>');
				redirect('admin/dashboard');
			}else{
				$this->session->set_flashdata('failed','Old Password incorrect Please try again...');
			}
		}else{
			$this->session->set_flashdata('failed','New Password and Confirm Password do not match');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function change_password()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='dashboard';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/change_password');
		$this->load->view('admin/footer');
	}
	public function check_admin_password()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$output = 'false';
		$old_password = md5($this->input->get("old_password"));
        $res=$this->db->get_where('admin_login',array('admin_id'=>$admin_id,'password'=>$old_password))->result_array();
		if(count($res)>0){
			$output = 'true';
		}
			echo $output;
	}
	public function employee_update_password()
	{
		checklogin_admin();
		$this->admin_logs('NULL','NULL','Updated Password');
		$admin_id=$this->session->userdata('emp_id');
		$old_password=md5($this->input->post('old_password'));
		$new_password=md5($this->input->post('new_password'));
		$confirm_password=md5($this->input->post('confirm_password'));
		$update_date =date("Y-m-d H:i:s");
		if($new_password==$confirm_password){
			$res=$this->db->get_where('admin_login',array('emp_id'=>$admin_id,'pwd'=>$old_password))->result_array();
			if(count($res)>0){
				$data=array('pwd'=>$new_password,'updated_at'=>$updated_at,'is_chk_login'=>1);
				$this->db->where('emp_id',$admin_id);
				$this->db->update('admin_login',$data);
				$emp_id=$this->session->userdata('emp_id');
        		$username=$this->session->userdata('username');
        		$ip = $this->input->ip_address();
        		$date =date("Y-m-d H:i:s");
        		$ArrData=array('username'=>$username,'emp_id'=>$emp_id,'ip_address'=>$ip,'created_at'=>$date);
        		$this->db->insert('change_password_history',$ArrData);
				$this->session->set_flashdata('success','Password updated successfully...</strong></div>');
				redirect('admin/dashboard');
			}else{
				$this->session->set_flashdata('failed','Old Password incorrect Please try again...');
			}
		}else{
			$this->session->set_flashdata('failed','New Password and Confirm Password do not match');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function update_password()
	{
		checklogin_admin();
		$this->admin_logs('NULL','NULL','Updated Password');
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
				$emp_id=$this->session->userdata('emp_id');
        		$username=$this->session->userdata('username');
        		$ip = $this->input->ip_address();
        		$date =date("Y-m-d H:i:s");
        		$ArrData=array('username'=>$username,'emp_id'=>$emp_id,'ip_address'=>$ip,'created_at'=>$date);
        		$this->db->insert('change_password_history',$ArrData);
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
		return $str;
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
		checklogin_admin('Employee Annual Performance');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Employee Annual Performance');
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
					$NewArr[]=DD_M_YY($res['appraisal_date']);
					$NewArr[]=$res['existing_salary'];
					$NewArr[]=$res['new_salary'];
					$NewArr[]=$res['percentage_hike'];
					$NewArr[]=$res['hr_feedback_comments'];
					$NewArr[]='<a href="'.base_url().'admin/view_employee_performance_list/'.$res['emp_id'].'"> View </a>';
					$NewArr[]='<a href="'.base_url().'admin/edit_employee_performance/'.$res['emp_performance_id'].'/'.$res['emp_id'].'/F" class="btn btn-info waves-effect waves-light" style="padding:7px;"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_performance_list($emp_id='')
	{
		checklogin_admin('Employee Annual Performance');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Employee Annual Performance');
		$data['employee_performance_list']=$this->db->query("SELECT `emp_performance_id`, `emp_id`, `appraisal_date`, `appraisal_rating`, `existing_role`, `new_role`, `existing_salary`, `new_salary`, `percentage_hike`, `hr_feedback_comments`, `employee_feedback_comments`, `relationship_manager_comments`, `is_active`, `created_at`, `updated_at` FROM `employee_annual_performance` WHERE `emp_id`=$emp_id ORDER BY `appraisal_date` ASC")->result_array();
		$data['active_menu']='employee_performance';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_performance_list');
		$this->load->view('admin/footer');
	}
	public function add_employee_performance()
	{
		checklogin_admin('Employee Annual Performance','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['employee']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='employee_performance';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee_performance');
		$this->load->view('admin/footer');
	}
	public function save_employee_performance()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
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
		        $post['appraisal_date']=date("Y-m-d", strtotime($post['appraisal_date']));
				$res = $this->db->insert('employee_annual_performance',$post);
				$insert_id = $this->db->insert_id();
				$this->admin_logs($post['emp_id'],$insert_id,'Add Employee Performance');
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
		checklogin_admin('Employee Annual Performance','Write');
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
		$emp_performance_id = trim($this->input->post('emp_performance_id'));
		$post = $this->input->post();
		$post = $this->input->post();
		$this->admin_logs($post['emp_id'],$post['emp_performance_id'],'Update Employee Performance');
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
		checklogin_admin('Client Management');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Client Management');
		$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->result_array();
		$data['active_menu']='clients';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/clients');
		$this->load->view('admin/footer');
	}
	public function change_client_status($client_id='',$sta='')
	{
	    checklogin_admin('Client Management','Write');
	    $this->admin_logs('NULL',$client_id,'Change Client Management Status',$sta);
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
		checklogin_admin('Client Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='clients';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_client');
		$this->load->view('admin/footer');
	}
	public function save_client()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
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
				$data = array('client_name'=>$client_name,'is_active'=>1);
				$res=$this->db->insert('clients',$data);
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Add Client Management');
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
		checklogin_admin('Client Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['client']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients` WHERE `client_id`=$client_id")->row_array();
		$data['active_menu']='clients';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_client');
		$this->load->view('admin/footer');
	}
	public function update_client()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$client_id=$this->input->post('client_id');
		$this->admin_logs('NULL',$client_id,'Updated Client Management');
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
		checklogin_admin('Task Management');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Task Management');
		$data['item_management']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management`")->result_array();
		$data['active_menu']='item_management';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/item_management');
		$this->load->view('admin/footer');
	}
	public function change_item_management_status($item_id='',$sta='')
	{
	    $this->admin_logs('NULL',$item_id,'Change Status Item Management',$sta);
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
		checklogin_admin('Task Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='item_management';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_item_management');
		$this->load->view('admin/footer');
	}
	public function save_item_management()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
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
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Save Item Management');
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
		checklogin_admin('Task Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['item']=$this->db->query("SELECT `item_management_id`, `item_name`, `is_active`, `created_at`, `updated_at` FROM `item_management` WHERE `item_management_id`=$item_id")->row_array();
		$data['active_menu']='item_management';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_item_management');
		$this->load->view('admin/footer');
	}
	public function update_item_management()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$item_management_id=$this->input->post('item_management_id');
		$this->admin_logs('NULL',$item_management_id,'Updated Item Management');
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
		checklogin_admin('Other Documents');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Other Documents');
		$data['documents']=$this->db->query("SELECT t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `other_documents` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id`")->result_array();
		$data['confirmation_letter']=$this->db->query("SELECT `confirmation_of_employment_id`, `emp_id`, `emp_data`, `is_generated`, `created_at`, `updated_at` FROM `confirmation_of_employment`")->result_array();
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
					$NewArr[]='<a href="'.base_url().'admin/edit_other_document/'.$res['document_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_other_document()
	{
		checklogin_admin('Other Documents','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='other_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_other_documents');
		$this->load->view('admin/footer');
	}
	public function save_other_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		$Save=$post['save'];
		unset($post['save']);
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
		            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
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
				$insert_id = $this->db->insert_id();
				$this->admin_logs($post['emp_id'],$insert_id,'Save Other Documents');
				if($res==1){
					$this->session->set_flashdata('success','Employee Document Upload Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Document Upload Failed...');
				}
		}
		if($Save=='SaveNew'){
		    redirect('admin/add_other_document/');
		}else{
		   redirect('admin/other_documents/'); 
		}
	}
	public function edit_other_document($document_id='')
	{
		checklogin_admin('Other Documents','Write');
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
		$document_id = $this->input->post('document_id');
		$document_name=$this->input->post('document_name');
		$document_path=$this->input->post('document_path');
		$post = $this->input->post();
		$this->admin_logs($post['emp_id'],$post['document_id'],'Updated Other Documents');
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

		                $document_name=$file;
		                $document_path=$imagename;
		                unlink("assets/other_documents/".$post['document_path']);
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
		checklogin_admin('Other Documents','Write');
	    $this->admin_logs('NULL',$doc_id,'Change Status Other Documents',$sta);
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
	public function payroll($month='')
	{
		checklogin_admin('Payroll');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Payroll');
		$data['active_menu']='payroll';
		$data['month']=$month;
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payroll');
		$this->load->view('admin/footer');
	}
    public function get_payroll_list()
	{
		$created_date =date("Y-m-d H:i:s");
		$month=@$this->input->get('month');
		$myDateArray = explode("-", @$month);
		$GMnth=@$myDateArray[0];
		$GYear=@$myDateArray[1];
		if($month!=''){
			$SelectMnthYear=$GYear.'-'.$GMnth.'-01';
			$ChkCurrentEmp=$this->db->get_where('payroll', array('month ='=>@$GMnth,'year ='=>$GYear))->num_rows();
			if($GMnth=='01'){
				$ChkPreviousEmp=$this->db->get_where('payroll', array('month ='=>@$GMnth,'year ='=>$GYear))->num_rows();
			}else{
				$ChkPreviousEmp=$this->db->get_where('payroll', array('month ='=>@$GMnth-1,'year ='=>$GYear))->num_rows();
			}
			if($ChkCurrentEmp==0 && $ChkPreviousEmp!=0){
				$GetEmplyees=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`date_of_joining`, t1.`is_active` FROM `employees` as `t1` WHERE  DATE_FORMAT(t1.`date_of_joining`, '%Y-%m')<='$SelectMnthYear' AND t1.`is_active`=1 ORDER BY t1.`emp_id` ASC")->result_array();
				// echo $this->db->last_query();
				// echo "<pre>";print_r($GetEmplyees);exit;
				foreach($GetEmplyees as $AllEmp)
				{
					$E_id=$AllEmp['emp_id'];
					$PreviousEmp=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, `gross_salary`, `comments`, `submit_finance` FROM `payroll` WHERE `emp_id`=$E_id AND `month`=$GMnth-1 AND `year`=$GYear ORDER BY `emp_id` ASC")->row_array();
					// echo $this->db->last_query();exit;
					$data=array('emp_id'=>@$PreviousEmp['emp_id'],'month'=>@$GMnth,'year'=>@$GYear,'monthly_salary'=>@$PreviousEmp['monthly_salary'],'allowance'=>@$PreviousEmp['allowance'],'rent'=>@$PreviousEmp['rent'],'claim_amt'=>@$PreviousEmp['claim_amt'],'gross_salary'=>@$PreviousEmp['gross_salary'],'comments'=>@$PreviousEmp['comments'],'submit_finance'=>0,'is_active'=>1,'created_at'=>$created_date);
					$this->db->insert('payroll',$data);
				
				}
				// echo "<pre>";print_r($GetPreviousAllEmplyees);
			}else if($ChkCurrentEmp==0){
				$GetAllEmplyees=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `date_of_joining`, `is_active` FROM `employees` WHERE  DATE_FORMAT(`date_of_joining`, '%Y-%m')<='$SelectMnthYear' AND `is_active`=1 ORDER BY `emp_id` ASC")->result_array();
				// echo $this->db->last_query();exit;
				foreach($GetAllEmplyees as $key => $AllEmps)
				{
					$Arrdata=array('emp_id'=>$AllEmps['emp_id'],'month'=>$GMnth,'year'=>$GYear,'monthly_salary'=>0,'allowance'=>0,'rent'=>0,'claim_amt'=>0,'gross_salary'=>0,'comments'=>'','submit_finance'=>0,'is_active'=>1,'created_at'=>$created_date);
					$this->db->insert('payroll',$Arrdata);
				}
				
			}else if($ChkCurrentEmp!=0 && $ChkPreviousEmp!=0)
			{
				$GetEmplyees=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`date_of_joining`, t1.`is_active` FROM `employees` as `t1` WHERE DATE_FORMAT(t1.`date_of_joining`, '%Y-%m')<='$SelectMnthYear' AND t1.`is_active`=1 ORDER BY t1.`emp_id` ASC")->result_array();
				// echo $this->db->last_query();exit;
				// echo "<pre>";print_r($GetEmplyees);exit;
				foreach($GetEmplyees as $AllEmp)
				{
					$E_id=$AllEmp['emp_id'];
					if($GMnth=='01')
					{
						$ExistedGmnth=$GMnth;
					}else{
						$ExistedGmnth=$GMnth;
					}
					$ChkPreviousEmpExisted=$this->db->get_where('payroll', array('month ='=>$ExistedGmnth,'year ='=>$GYear,'emp_id='=>$E_id))->num_rows();
					// echo $this->db->last_query();exit;
					$ExistedPreviousEmp=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, `gross_salary`, `comments`, `submit_finance` FROM `payroll` WHERE `emp_id`=$E_id AND `month`=$ExistedGmnth AND `year`=$GYear ORDER BY `emp_id` ASC")->row_array();
					// echo $this->db->last_query();
					if($ChkPreviousEmpExisted==0){
						$ChkPreviousEmpExisted=$this->db->get_where('payroll', array('month ='=>$ExistedGmnth,'year ='=>$GYear,'emp_id='=>$E_id))->num_rows();
					// echo $this->db->last_query();exit;
						if(@$ExistedPreviousEmp['monthly_salary']==''){
							$monthly_salary=0;
						}else{
							$monthly_salary=$ExistedPreviousEmp['monthly_salary'];
						}
						if(@$ExistedPreviousEmp['allowance']==''){
							$allowance=0;
						}else{
							$allowance=$ExistedPreviousEmp['allowance'];
						}
						if(@$ExistedPreviousEmp['rent']==''){
							$rent=0;
						}else{
							$rent=$ExistedPreviousEmp['rent'];
						}
						if(@$ExistedPreviousEmp['claim_amt']==''){
							$claim_amt=0;
						}else{
							$claim_amt=$ExistedPreviousEmp['claim_amt'];
						}
						if(@$ExistedPreviousEmp['gross_salary']==''){
							$gross_salary=0;
						}else{
							$gross_salary=$ExistedPreviousEmp['gross_salary'];
						}
						$data=array('emp_id'=>@$E_id,'month'=>$GMnth,'year'=>$GYear,'monthly_salary'=>@$monthly_salary,'allowance'=>@$allowance,'rent'=>@$rent,'claim_amt'=>@$claim_amt,'gross_salary'=>@$gross_salary,'comments'=>@$ExistedPreviousEmp['comments'],'submit_finance'=>0,'is_active'=>1,'created_at'=>$created_date);
						$this->db->insert('payroll',$data);
						// echo $this->db->last_query();
					}
				
				}
				// echo "<pre>";print_r($GetPreviousAllEmplyees);
			}	
		}
		// echo "<pre>";print_r($GetAllEmplyees);
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_payroll_Details(1,$start,$length,$search['value'],$column,$dir,$GMnth,$GYear);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_payroll_Details(2,$start,$length,$search['value'],$column,$dir,$GMnth,$GYear);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]='<input type="hidden" name="emp_id[]" id="emp_id_'.$k.'" placeholder="Employee ID" class="form-control" value="'.@$res['e_id'].'">'.$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]='<input type="text" name="monthly_salary[]" id="monthly_salary_'.$k.'" placeholder="Monthly Salary" class="form-control" value="'.@$res['monthly_salary'].'" onkeyup="return Grass_cal('.$k.');">';
					$NewArr[]='<input type="text" name="allowance[]" id="allowance_'.$k.'" placeholder="Allowance" class="form-control" value="'.@$res['allowance'].'" onkeyup="return Grass_cal('.$k.');">';
					$NewArr[]='<input type="text" name="gross_salary[]" id="gross_salary_'.$k.'" placeholder="Gross Salary" class="form-control" value="'.@$res['gross_salary'].'" onkeyup="return Grass_cal('.$k.');" readonly>';
					$NewArr[]='<input type="text" name="claim_amt[]" id="claim_amt_'.$k.'" placeholder="Claim Amount" class="form-control" value="'.@$res['claim_amt'].'" onkeyup="return Total_cal('.$k.');">';
					$total_cost=@$res['gross_salary']+@$res['claim_amt'];
					$NewArr[]='<input type="text" name="total_cost[]" id="total_cost_'.$k.'" placeholder="Total Cost" class="form-control" value="'.@$total_cost.'" onkeyup="return Total_cal('.$k.');" readonly>';
					$NewArr[]='<input type="text" name="comments[]" id="comments_'.$k.'" placeholder="Comments" class="form-control" value="'.@$res['comments'].'">';
					if($res['payroll_id']==''){
						$payroll_id=0;
					}else{
						$payroll_id=$res['payroll_id'];
					}
					$NewArr[]='<input type="button" name="Submit" id="Submit" class="btn btn-primary waves-effect waves-light mr-1 align-center" value="Save" onclick="AjxaSavePayroll('.$k.','.$payroll_id.','.$GMnth.','.$GYear.');">';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function Save_Finance($month,$year)
	{
		checklogin_admin('Payroll');
		$admin_id=$this->session->userdata('emp_id');
		$this->admin_logs('NULL','NULL','Payroll Submitted To Finance');
		$ArrData=array('submit_finance'=>1);
		$this->db->where('month',$month);
		$this->db->where('year',$year);
	    $res = $this->db->update('payroll',$ArrData);
	    if($res==1){
			$this->session->set_flashdata('success','Payroll Submitted To Finance Successfully...');
		}else{
			$this->session->set_flashdata('failed','This Payroll Submitted To Finance Failed...');
		}
		redirect('admin/payroll/'.$month.'-'.$year);
	}
	public function AjxaSave_Payroll()
	{
		$emp_id = $this->input->post('emp_id');
		$payroll_id = $this->input->post('payroll_id');
		$this->admin_logs($emp_id,$payroll_id,'Payroll Saved');
		$month = $this->input->post('month');
		$myDateArray = explode("-", @$month);
		$Month=@$myDateArray[0];
		$Year=@$myDateArray[1];
		$monthly_salary = $this->input->post('monthly_salary');
		$allowance = $this->input->post('allowance');
		$rent = $this->input->post('rent');
		$claim_amt = $this->input->post('claim_amt');
		$gross_salary = $this->input->post('gross_salary');
		$comments = $this->input->post('comments');
		$updated_at =date("Y-m-d H:i:s");
		$Chk = $this->db->get_where('payroll', array('emp_id'=>$emp_id,'month'=>$Month,'year'=>$Year))->num_rows();
		if($Chk==0){
			$ArrData=array('emp_id'=>$emp_id,'month'=>$Month,'year'=>$Year,'monthly_salary'=>$monthly_salary,'allowance'=>$allowance,'rent'=>$rent,'claim_amt'=>$claim_amt,'gross_salary'=>$gross_salary,'comments'=>$comments,'created_at'=>$updated_at);
	        $res = $this->db->insert('payroll',$ArrData);
	        echo 1;
		}else{
			$ArrData=array('emp_id'=>$emp_id,'month'=>$Month,'year'=>$Year,'monthly_salary'=>$monthly_salary,'allowance'=>$allowance,'rent'=>$rent,'claim_amt'=>$claim_amt,'gross_salary'=>$gross_salary,'comments'=>$comments,'updated_at'=>$updated_at);
			$this->db->where('payroll_id',$payroll_id);
	        $res = $this->db->update('payroll',$ArrData);
	        echo 0;
		}
	}
	public function finance_report($month='')
	{
		checklogin_admin('Finance Reports');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='payroll';
		$data['month']=$month;
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/finance_report');
		$this->load->view('admin/footer');
	}
	public function get_finance_report_list()
	{
		$month=@$this->input->get('month');
		$myDateArray = explode("-", @$month);
		$Mnth=@$myDateArray[0];
		$Year=@$myDateArray[1];
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_finance_payroll_Details(1,$start,$length,$search['value'],$column,$dir,$Mnth,$Year);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_finance_payroll_Details(2,$start,$length,$search['value'],$column,$dir,$Mnth,$Year);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]='<span id="emp_id_'.$k.'">'.$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')</span>';
					if($res['monthly_salary']==''){
						$NewArr[]='<span id="monthly_salary_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="monthly_salary_'.$k.'">'.$res['monthly_salary'].'</span>';
					}
					if($res['allowance']==''){
						$NewArr[]='<span id="allowance_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="allowance_'.$k.'">'.$res['allowance'].'</span>';	
					}
					if($res['rent']==''){
						$NewArr[]='<span id="rent_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="rent_'.$k.'">'.$res['rent'].'</span>';	
					}
					if($res['claim_amt']==''){
						$NewArr[]='<span id="claim_amt_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="claim_amt_'.$k.'">'.$res['claim_amt'].'</span>';	
					}
					if($res['gross_salary']==''){
						$NewArr[]='<span id="gross_salary_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="gross_salary_'.$k.'">'.$res['gross_salary'].'</span>';	
					}
					$NewArr[]='<span id="comments_'.$k.'">'.$res['comments'].'</span>';	
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function export_finance_payroll_reports($month='',$year='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		if($month!='' && $year!=''){
			$dt=$this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`, t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t2.`month`=$month AND t2.`year`=$year AND t2.`submit_finance`=1 ORDER BY t1.`emp_id` ASC")->result_array();
		}else{
			$dt=$this->db->query("SELECT `payroll_id`, `emp_id`, `month`, `year`, `monthly_salary`, `allowance`, `rent`, `claim_amt`, `gross_salary`, `comments`, `submit_finance`, `is_active`, `created_at`, `updated_at` FROM `payroll` WHERE `month`=22 AND `submit_finance`=1 ORDER BY t1.`emp_id` ASC")->result_array();
		}
		$date =date('d-M-Y');
		$name = 'Payroll_Finance_Reports'.$date;
        $name=$name.'.xls';
        header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: Attachment; filename=$name");
		$aa ="S.No\tEmployee Name\tMonth\tYear\tMonthly Salary\tAllowance\tRent\tClaim Amount\tGross Salary\tComments\n";
		$counter=1;
		foreach($dt as $k=>$val){
			if($val['monthly_salary']==''){
				$monthly_salary=0;
			}else{
				$monthly_salary=$val['monthly_salary'];
			}
			if($val['allowance']==''){
				$allowance=0;
			}else{
				$allowance=$val['allowance'];
			}
			if($val['rent']==''){
				$rent=0;
			}else{
				$rent=$val['rent'];
			}
			if($val['claim_amt']==''){
				$claim_amt=0;
			}else{
				$claim_amt=$val['claim_amt'];
			}
			if($val['gross_salary']==''){
				$gross_salary=0;
			}else{
				$gross_salary=$val['gross_salary'];
			}
			 $aa.=$counter."\t".$val['fname'].$val['lname'].' '.'('.$val['emp_code'].')'."\t".$month."\t".$year."\t".$monthly_salary."\t".$allowance."\t".$rent."\t".$claim_amt."\t".$gross_salary."\t".$val['comments']."\n";
             $counter++;
        }
        echo $aa;
	}
	public function reports($month='',$emp_id='')
	{
		checklogin_admin('Reports');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='payroll';
		$data['month']=$month;
		$data['emp_id']=$emp_id;
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/reports');
		$this->load->view('admin/footer');
	}
	public function get_report_list()
	{
		$month=@$this->input->get('month');
		$emp_id=@$this->input->get('emp_id');
		$myDateArray = explode("-", @$month);
		$Mnth=@$myDateArray[0];
		$Year=@$myDateArray[1];
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_report_Details(1,$start,$length,$search['value'],$column,$dir,$Mnth,$Year,$emp_id);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_report_Details(2,$start,$length,$search['value'],$column,$dir,$Mnth,$Year,$emp_id);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]='<span id="emp_id_'.$k.'">'.$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')</span>';
					if($res['monthly_salary']==''){
						$NewArr[]='<span id="monthly_salary_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="monthly_salary_'.$k.'">'.$res['monthly_salary'].'</span>';
					}
					if($res['allowance']==''){
						$NewArr[]='<span id="allowance_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="allowance_'.$k.'">'.$res['allowance'].'</span>';	
					}
					if($res['rent']==''){
						$NewArr[]='<span id="rent_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="rent_'.$k.'">'.$res['rent'].'</span>';	
					}
					if($res['claim_amt']==''){
						$NewArr[]='<span id="claim_amt_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="claim_amt_'.$k.'">'.$res['claim_amt'].'</span>';	
					}
					if($res['gross_salary']==''){
						$NewArr[]='<span id="gross_salary_'.$k.'">0</span>';
					}else{
						$NewArr[]='<span id="gross_salary_'.$k.'">'.$res['gross_salary'].'</span>';	
					}
					$NewArr[]='<span id="comments_'.$k.'">'.@$res['comments'].'</span>';
					$m=$res['month'];
					$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
					$monthName =$months[(int)$m];
					$NewArr[]='<span id="mnt_year_'.$k.'">'.$monthName.'-'.@$res['year'].'</span>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function export_reports($month='',$year='',$emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		if($month!='' && $year!='' && $emp_id!=''){
			$dt=$this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t2.`month`=$month AND t2.`year`=$year AND t2.`emp_id`=$emp_id AND t2.`submit_finance`=1")->result_array();
		}else if($month!='' && $year!=''){
			$dt=$this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t2.`month`=$month AND t2.`year`=$year AND t2.`submit_finance`=1")->result_array();
		}else if($emp_id!=''){
			$dt=$this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t2.`emp_id`=$emp_id AND t2.`submit_finance`=1")->result_array();
		}else{
			$dt=$this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t2.`submit_finance`=1")->result_array();
		}
		$date =date('d-M-Y');
		$name = 'Payroll_Reports'.$date;
        $name=$name.'.xls';
        header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: Attachment; filename=$name");
		$aa ="S.No\tEmployee Name\tMonthly Salary\tAllowance\tRent\tClaim Amount\tGross Salary\tComments\tMonth\n";
		$counter=1;
		foreach($dt as $k=>$val){
			$Mnth=$val['month'].'-'.$val['year'];
			if($val['monthly_salary']==''){
				$monthly_salary=0;
			}else{
				$monthly_salary=$val['monthly_salary'];
			}
			if($val['allowance']==''){
				$allowance=0;
			}else{
				$allowance=$val['allowance'];
			}
			if($val['rent']==''){
				$rent=0;
			}else{
				$rent=$val['rent'];
			}
			if($val['claim_amt']==''){
				$claim_amt=0;
			}else{
				$claim_amt=$val['claim_amt'];
			}
			if($val['gross_salary']==''){
				$gross_salary=0;
			}else{
				$gross_salary=$val['gross_salary'];
			}
			 $aa.=$counter."\t".$val['fname'].$val['lname'].' '.'('.$val['emp_code'].')'."\t".$monthly_salary."\t".$allowance."\t".$rent."\t".$claim_amt."\t".$gross_salary."\t".$val['comments']."\t".$Mnth."\n";
             $counter++;
        }
        echo $aa;
	}
	public function public_holidays()
	{
		checklogin_admin('Public Holidays');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Public Holidays');
		$data['holiday']=$this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays`")->result_array();
		$data['active_menu']='public_holidays';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/public_holidays');
		$this->load->view('admin/footer');
	}
	public function change_holiday_status($holiday_id='',$sta='')
	{
		checklogin_admin('Public Holidays','Write');
	    $this->admin_logs('NULL',$holiday_id,'Change Public Holiday Status',$sta);
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
		checklogin_admin('Public Holidays','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='public_holidays';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_holiday');
		$this->load->view('admin/footer');
	}
	public function save_holiday()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
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
				$data = array('name'=>$name,'date'=>YY_MM_DD($date),'is_active'=>1);
				$res=$this->db->insert('public_holidays',$data);
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Add Public Holiday');
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
		checklogin_admin('Public Holidays','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['holidays']=$this->db->query("SELECT `public_holiday_id`, `name`, `date`, `is_active`, `created_at`, `updated_at` FROM `public_holidays` WHERE `public_holiday_id`=$holiday_id")->row_array();
		$data['active_menu']='public_holidays';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_holiday');
		$this->load->view('admin/footer');
	}
	public function update_holiday()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$public_holiday_id=$this->input->post('public_holiday_id');
		$this->admin_logs('NULL',$public_holiday_id,'Updated Public Holiday');
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
				$res = $this->db->update('public_holidays',array('name'=>$name,'date'=>date("Y-m-d", strtotime($date))),array('public_holiday_id'=>$public_holiday_id));
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
	public function read_write($sub_menu_name='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$role_id=$this->session->userdata('role_id');
		if($role_id=='Admin'){
			return array('read'=>1,'write'=>1);
		}else{
			return $this->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `sub_menu_url`, `sub_menu_icon`, `access`, `read`, `write`, `is_active` FROM `role_access` WHERE `role_id`=$role_id AND `sub_menu_name`='$sub_menu_name'")->row_array();
		}
		echo "<pre>";print_r($GetRolesData);exit;
	}
	public function asset()
	{
		checklogin_admin('Asset');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Asset');
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
					$NewArr[]='<a href="'.base_url().'admin/edit_asset/'.$res['asset_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_emp_asset_details($asset_id='',$emp_id='')
	{
		checklogin_admin('Asset');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Asset');
		$data['asset_details']=$this->db->query("SELECT `asset_id`, `emp_id`, `laptop_serial_no`, `laptop_model`, `battery_provided`, `battery_provided_no`, `charger_provided`, `charger_provided_no`, `mouse_provided`, `mouse_serial_number`, `mouse_provided_no`, `power_supply_provided`, `power_supply_provided_name`, `power_supply_model_no`, `ups_provided`, `ups_provided_no`, `carrycase_provided`, `carrycase_provided_no`, `total_asset_amt`, `asset_assigned_date`, `is_active`, `created_at`, `updated_at` FROM `asset` WHERE `asset_id`=$asset_id AND `emp_id`=$emp_id")->row_array();
		$data['active_menu']='asset';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_emp_asset_details');
		$this->load->view('admin/footer');
	}
	public function add_asset()
	{
		checklogin_admin('Asset','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='asset';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_asset');
		$this->load->view('admin/footer');
	}
	public function save_asset()
	{
		checklogin_admin('Asset');
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		$charger_provided=@$post['charger_provided'];
		$mouse_provided=@$post['mouse_provided'];
		$ups_provided=@$post['ups_provided'];
		$carrycase_provided=@$post['carrycase_provided'];
		$charger_provided_no=@$post['charger_provided_no'];
		$mouse_provided_no=@$post['mouse_provided_no'];
		$ups_provided_no=@$post['ups_provided_no'];
		$carrycase_provided_no=@$post['carrycase_provided_no'];
		$asset_assigned_date=@$post['asset_assigned_date'];
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
		        $post['asset_assigned_date']=YY_MM_DD($asset_assigned_date);
				$res = $this->db->insert('asset',$post);
				$insert_id = $this->db->insert_id();
				$this->admin_logs($post['emp_id'],$insert_id,'Add Asset');
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
		checklogin_admin('Asset','Write');
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
		$asset_id = $this->input->post('asset_id');
		$post = $this->input->post();
		$this->admin_logs($post['emp_id'],$asset_id,'Update Asset');
		$charger_provided=@$post['charger_provided'];
		$mouse_provided=@$post['mouse_provided'];
		$ups_provided=@$post['ups_provided'];
		$carrycase_provided=@$post['carrycase_provided'];
		$asset_assigned_date=@$post['asset_assigned_date'];
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
		        $post['asset_assigned_date']=YY_MM_DD($asset_assigned_date);
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
		checklogin_admin('Asset','Write');
	    $this->admin_logs('NULL',$asset_id,'Change Asset Status',$sta);
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
		checklogin_admin('Leaves');
		$admin_id=$this->session->userdata('emp_id');
		$data['role_id']=$this->session->userdata('role_id');
		$data['GetRolesAccess']=$this->read_write('Leaves');
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/leaves');
		$this->load->view('admin/footer');
	}
	public function get_leaves_list()
	{
	    $role_id=$this->input->get('role_id');
	    $admin_id=$this->session->userdata('emp_id');
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
				    $emp_id=$res['emp_id'];
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=DD_M_YY($res['period_from']);
					$NewArr[]=DD_M_YY($res['period_to']);
					$NewArr[]=$res['annual_leaves_count'];
					$data['leaves']=$this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `created_at`, `updated_at`, `is_delete` FROM `leaves` WHERE `emp_id`=$emp_id AND is_delete!=0")->row_array();
					$data['get_annual_taking_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as totl, `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at`,`is_delete` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Annual Leave' AND `leave_status`=1 AND is_delete!=0")->row_array();
            		$data['get_sick_taking_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as totl, `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `is_delete`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Sick Leave' AND `leave_status`=1 AND is_delete!=0")->row_array();
            		if(!empty($data['get_annual_taking_leaves']['totl'])){
            			$remaning_annual_leaves = (@$data['leaves']['annual_leaves_count'])-(@$data['get_annual_taking_leaves']['totl']);
            		}else{
            			$remaning_annual_leaves = @$data['leaves']['annual_leaves_count'];
            		}
            		$NewArr[]=$remaning_annual_leaves;
					$NewArr[]=$res['sick_leaves_count'];
					if(!empty($data['get_sick_taking_leaves']['totl'])){
            			$remaning_sick_leaves = (@$data['leaves']['sick_leaves_count'])-(@$data['get_sick_taking_leaves']['totl']);
            		}else{
            			$remaning_sick_leaves = @$data['leaves']['sick_leaves_count'];
            		}
					$NewArr[]=$remaning_sick_leaves;
					$NewArr[]='<a href="'.base_url().'admin/view_employee_leaves_list/'.$res['emp_id'].'/'.$res['period_from'].'/'.$res['period_to'].'"> View</a>';
					$NewArr[]='<a href="'.base_url().'admin/edit_leaves/'.$res['leave_id'].'" class="btn btn-info waves-effect waves-light" style="padding:6px;"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_leaves_list($emp_id='',$period_from='',$period_to='')
	{
		checklogin_admin('Leaves');
		$admin_id=$this->session->userdata('emp_id');
		if($admin_id!=''){
		    $GetLeavesList=$this->db->query("SELECT * FROM `leaves` WHERE (`hr_manager_id`=$admin_id OR `lead_manager_id`=$admin_id)")->result_array();
		    $CHkarr=array();
    		foreach ($GetLeavesList as $key => $value) {
    			$e_id=$value['emp_id'];
    			if($emp_id==$e_id){
    				$CHkarr[]=1;
    			}
    		}
    		if(!empty($CHkarr))
    		{
    			$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
    			$data['leaves_list']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `reason`, `approved_date`, `rejected_by_admin_date`, `cancelled_by_user_date`, `leave_rejected_reason`, `document_file_name`, `document_file_path`, `created_at`, `updated_at`,`is_delete` FROM `employee_leaves_list` WHERE `from_date`>='$period_from' AND `to_date`<='$period_to' AND `emp_id`=$emp_id AND is_delete!=0")->result_array();
    			$data['active_menu']='leaves';
    			$this->load->view('admin/menu',$data);
    			$this->load->view('admin/view_employee_leaves_list');
    			$this->load->view('admin/footer');
    		}else{
    			$this->session->sess_destroy();
            	redirect('master');
    		}
		}else{
		    $data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
    		$data['leaves_list']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `reason`, `approved_date`, `rejected_by_admin_date`, `cancelled_by_user_date`, `leave_rejected_reason`, `document_file_name`, `document_file_path`, `created_at`, `updated_at`,`is_delete` FROM `employee_leaves_list` WHERE `from_date`>='$period_from' AND `to_date`<='$period_to' AND `emp_id`=$emp_id AND is_delete!=0")->result_array();
    		$data['active_menu']='leaves';
    		$this->load->view('admin/menu',$data);
    		$this->load->view('admin/view_employee_leaves_list');
    		$this->load->view('admin/footer');
		}
	}
	public function change_emp_approved_leave_status($emp_id,$employee_leaves_lid,$sta)
	{
		checklogin_admin('Leaves','Write');
	    $this->admin_logs($emp_id,$employee_leaves_lid,'Change Leave Status Approved',$sta);
		$getGivienLeaves = $this->db->query("SELECT * FROM `leaves` WHERE `emp_id`=$emp_id")->row_array();
		$GivenAnnualLeaves = $getGivienLeaves['annual_leaves_count'];
		$GivenSickLeaves = $getGivienLeaves['sick_leaves_count'];
		$AppliedLeaves = $this->db->query("SELECT * FROM `employee_leaves_list` WHERE `employee_leaves_lid`=$employee_leaves_lid AND `emp_id`=$emp_id")->row_array();
		$AppliedLeavesType = $AppliedLeaves['leave_type'];
		$AppliedLeaves = $AppliedLeaves['leave_days'];
		if($AppliedLeavesType=='Annual Leave'){
// 			$DecreaseLeaves = $GivenAnnualLeaves - $AppliedLeaves;
// 			$AnnualArr = array('annual_leaves_count'=>$DecreaseLeaves);
// 			$this->db->where('emp_id',$emp_id);
// 		    $this->db->update('leaves',$AnnualArr);
		}else{
// 			$DecreaseLeaves = $GivenSickLeaves - $AppliedLeaves;
// 			$AnnualArr = array('sick_leaves_count'=>$DecreaseLeaves);
// 			$this->db->where('emp_id',$emp_id);
// 		    $this->db->update('leaves',$AnnualArr);
		}
// 		echo $this->db->last_query();exit;
		$data = array('leave_status'=>$sta,'is_cron_approved_email_sent'=>2,'approved_date'=>date("Y-m-d H:i:s"));
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
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function change_emp_reject_leave_status()
	{
		checklogin_admin('Leaves','Write');
		$emp_id=$this->input->post('comment_emp_id');
		$employee_leaves_lid=$this->input->post('employee_leaves_lid');
		$sta=$this->input->post('c_sta');
		$comments=$this->input->post('comments');
		$this->admin_logs($emp_id,$employee_leaves_lid,'Change Leave Status Rejected',$sta);
		$data = array('leave_status'=>$sta,'leave_rejected_reason'=>$comments,'is_cron_rejected_email_sent'=>2,'rejected_by_admin_date'=>date("Y-m-d H:i:s"));
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
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function add_leaves()
	{
		checklogin_admin('Leaves','Write');
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$emp_id=$this->input->post('emp_id');
		$GetHrLeadMangers=$this->db->query("SELECT * FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['hr_manager_id']=$GetHrLeadMangers['hr_manager_id'];
		$post['lead_manager_id']=$GetHrLeadMangers['lead_manager_id'];
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
        	$emp_id=$post['emp_id'];
        	$FromDate=date("Y-m-d", strtotime($post['period_from']));
        	$ToDate=date("Y-m-d", strtotime($post['period_to']));
        	$check=$this->db->query("SELECT * FROM `leaves` WHERE `period_from` <='$FromDate' AND `period_to` >='$ToDate' AND `emp_id` = $emp_id")->num_rows();
        	$check_two=$this->db->query("SELECT * FROM `leaves` WHERE `period_to` >='$FromDate' AND `period_from` <='$ToDate' AND `emp_id` = $emp_id")->num_rows();
			if($check==0 && $check_two==0){
			    $post['period_from']=date("Y-m-d", strtotime($post['period_from']));
			    $post['period_to']=date("Y-m-d", strtotime($post['period_to']));
	        	$post['is_active']=1;
	        	$post['created_at']=$created_date;
				$res=$this->db->insert('leaves',$post);
				$insert_id = $this->db->insert_id();
				$this->admin_logs($post['emp_id'],$insert_id,'Save Leaves');
				if($res==1){
					$this->session->set_flashdata('success','Leaves saved successfully...');
				}else{
					$this->session->set_flashdata('failed','This Leaves saved failed!...');
				}
			}else{
				$this->session->set_flashdata('failed','This year leaves already existed to this employee...');
			}
		   redirect('admin/leaves/');
		} 
	}
	public function edit_leaves($leave_id='')
	{
		checklogin_admin('Leaves','Write');
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
		$leave_id=$this->input->post('leave_id');
		$post=$this->input->post();
		$this->admin_logs($post['emp_id'],$leave_id,'Updated Leaves');
		unset($post['emp_name']);
		$emp_id=$this->input->post('emp_id');
		$GetHrLeadMangers=$this->db->query("SELECT * FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['hr_manager_id']=$GetHrLeadMangers['hr_manager_id'];
		$post['lead_manager_id']=$GetHrLeadMangers['lead_manager_id'];
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
        	$leave_id = $post['leave_id'];
        	$emp_id=$post['emp_id'];
        	$YEAR=date("d-m-Y", strtotime($post['period_from']));
        	$check=$this->db->query("SELECT * FROM `leaves` WHERE YEAR(`period_from`) =$YEAR AND `emp_id` = $emp_id AND `leave_id`!=$leave_id")->num_rows();
			if($check==0){
        	$post['updated_at']=$updated_date;
        	$post['period_from']=date("Y-m-d", strtotime($post['period_from']));
			$post['period_to']=date("Y-m-d", strtotime($post['period_to']));
        	$this->db->where('leave_id',$leave_id);
			$res=$this->db->update('leaves',$post);
				if($res==1){
					$this->session->set_flashdata('success','Leaves updated successfully...');
				}else{
					$this->session->set_flashdata('failed','This Leaves updated failed!...');
				}
			}
			else{
				$this->session->set_flashdata('failed','This Year Leaves already existed to this employee...');
			}
		   redirect('admin/leaves/');
      }
	}
	public function leaves_history()
	{
		checklogin_admin('Leaves');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/leaves_history');
		$this->load->view('admin/footer');
	}
	public function get_leaves_history_list()
	{
	    $admin_id=$this->session->userdata('emp_id');
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_leaves_history_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_leaves_history_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
				    $emp_id=$res['emp_id'];
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=DD_M_YY($res['period_from']);
					$NewArr[]=DD_M_YY($res['period_to']);
					$NewArr[]=$res['annual_leaves_count'];
					$data['leaves']=$this->db->query("SELECT `leave_id`, `emp_id`, `period_from`, `period_to`, `annual_leaves_count`, `sick_leaves_count`, `is_active`, `created_at`, `updated_at`, `is_delete` FROM `leaves` WHERE `emp_id`=$emp_id AND is_delete!=0")->row_array();
					$data['get_annual_taking_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as totl, `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `created_at`, `updated_at`,`is_delete` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Annual Leave' AND `leave_status`=1 AND is_delete!=0")->row_array();
            		$data['get_sick_taking_leaves']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, SUM(`leave_days`) as totl, `leave_type`, `leave_status`, `reason`, `leave_rejected_reason`, `is_delete`, `created_at`, `updated_at` FROM `employee_leaves_list` WHERE `emp_id`=$emp_id AND `leave_type`='Sick Leave' AND `leave_status`=1 AND is_delete!=0")->row_array();
            		if(!empty($data['get_annual_taking_leaves']['totl'])){
            			$remaning_annual_leaves = (@$data['leaves']['annual_leaves_count'])-(@$data['get_annual_taking_leaves']['totl']);
            		}else{
            			$remaning_annual_leaves = @$data['leaves']['annual_leaves_count'];
            		}
            		$NewArr[]=$remaning_annual_leaves;
					$NewArr[]=$res['sick_leaves_count'];
					if(!empty($data['get_sick_taking_leaves']['totl'])){
            			$remaning_sick_leaves = (@$data['leaves']['sick_leaves_count'])-(@$data['get_sick_taking_leaves']['totl']);
            		}else{
            			$remaning_sick_leaves = @$data['leaves']['sick_leaves_count'];
            		}
					$NewArr[]=$remaning_sick_leaves;
					$NewArr[]='<a href="'.base_url().'admin/view_employee_leaves_history_list/'.$res['emp_id'].'/'.$res['period_from'].'/'.$res['period_to'].'"> View</a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_leaves_history_list($emp_id='',$period_from='',$period_to='')
	{
		checklogin_admin('Leaves');
		$admin_id=$this->session->userdata('emp_id');
		$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$data['leaves_list']=$this->db->query("SELECT `employee_leaves_lid`, `emp_id`, `from_date`, `to_date`, `leave_days`, `leave_type`, `leave_status`, `reason`, `approved_date`, `rejected_by_admin_date`, `cancelled_by_user_date`, `leave_rejected_reason`, `created_at`, `updated_at`,`is_delete` FROM `employee_leaves_list` WHERE `from_date`>='$period_from' AND `to_date`<='$period_to' AND `emp_id`=$emp_id AND is_delete!=0")->result_array();
		$data['active_menu']='leaves';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_leaves_history_list');
		$this->load->view('admin/footer');
	}
	public function employee_documents()
	{
		checklogin_admin('Employee Checks');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Employee Checks');
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
					$NewArr[]=DD_M_YY($res['created_at']);
					$NewArr[]='<a href="'.base_url().'admin/view_employee_all_documents/'.$res['emp_id'].'"> View All</a>';
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light" onclick="change_employee_document_status('.$res['employee_document_id'].',1);"> Inactive </button>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light" onclick="change_employee_document_status('.$res['employee_document_id'].',0);"> Active </button>';
					}
					$NewArr[]=$status;
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function view_employee_all_documents($emp_id='')
	{
		checklogin_admin('Employee Checks');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Employee Checks');
		$data['documents']=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `emp_id`=$emp_id")->result_array();
		$data['emp']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$data['active_menu']='employee_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_all_documents');
		$this->load->view('admin/footer');
	}
	public function delete_emp_document($employee_document_id='',$sta='')
	{
		checklogin_admin('Employee Checks','Write');
	    $this->admin_logs('NULL',$employee_document_id,'Deleted Employee Document');
		$get_file_path = $get_file_path=$this->db->query("SELECT `employee_document_id`, `emp_id`, `doc_img_name`, `doc_img_path`, `doc_type`, `is_active`, `created_at`, `updated_at` FROM `employee_documents` WHERE `employee_document_id`=$employee_document_id")->row_array();
		if($get_file_path['doc_img_path']!='') {
			unlink("assets/employee_documents/".$get_file_path['doc_img_path']);
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
		checklogin_admin('Employee Checks','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='employee_documents';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_employee_document');
		$this->load->view('admin/footer');
	}
	public function save_employee_documents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$emp_id = $this->input->post('emp_id');
		$post = $this->input->post();
		$Save = $post['save'];
		unset($post['save']);
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
			            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
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
			                	$insert_id = $this->db->insert_id();
			                	$this->admin_logs($post['emp_id'],$insert_id,'Save Employee Checks');
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
			            $config2['allowed_types'] = 'jpeg|jpg|png|pdf';
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
			                	$insert_id = $this->db->insert_id();
			                	$this->admin_logs($post['emp_id'],$insert_id,'Save Employee Checks');
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
			            $config3['allowed_types'] = 'jpeg|jpg|png|pdf';
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
			                	$insert_id = $this->db->insert_id();
			                	$this->admin_logs($post['emp_id'],$insert_id,'Save Employee Checks');
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
			            $config4['allowed_types'] = 'jpeg|jpg|png|pdf';
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
			                	$insert_id = $this->db->insert_id();
			                	$this->admin_logs($post['emp_id'],$insert_id,'Save Employee Checks');
			                }	
			            }
        		} 
        	 } 
		       $this->session->set_flashdata('success','Employee Documents Saved Successfully...');
		       if($Save=='SaveNew'){
        		    redirect('admin/add_employee_document/');
        	   }else{
        		   redirect('admin/employee_documents/'); 
        	   }
	 	}
		
	}
	public function file_download($file_id)
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
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
		checklogin_admin('Employee Checks','Write');
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
		$document_id = $this->input->post('document_id');
		$document_name=$this->input->post('document_name');
		$document_path=$this->input->post('document_path');
		$post = $this->input->post();
		$this->admin_logs($post['emp_id'],$post['employee_document_id'],'Updated Employee Checks');
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
		            $config['allowed_types'] = 'jpeg|jpg|png';
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
	public function update_emp_individual_doc()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$employee_document_id = $this->input->post('employee_document_id');
		$doc_type=$this->input->post('doc_type');
		$img_name=$this->input->post('img_name');
		$img_path=$this->input->post('img_path');
		$post = $this->input->post();
		$this->admin_logs('NULL',$post['employee_document_id'],'Updated Employee Checks');
		$update_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'employee_document_id', 'label'   => 'Document ID','rules'   => 'required'),
			array( 'field'   => 'doc_type', 'label'   => 'Document Type','rules'   => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect($_SERVER['HTTP_REFERER']);
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
		            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('simage'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg.png formates only</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		            }
		            else
		            {
					     if($img_path!=''){ 
 							unlink('assets/employee_documents/'.$img_path); 
 						  } 
 						  else {
					      }
		                $img_name=$file;
		                $img_path=$imagename;
		            }
		        }
		        else
		        {

		        	$img_name=$img_name;
		            $img_path=$img_path;
		        }
		        $post['doc_img_name']=$img_name;
		        $post['doc_img_path']=$img_path;
		        $post['updated_at']=$update_date;
		        unset($post['img_name']);
		        unset($post['img_path']);
		        $this->db->where('employee_document_id',$employee_document_id);
				$res = $this->db->update('employee_documents',$post);
				if($res==1){
					$this->session->set_flashdata('success','Other Document Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','Other Document Updated Failed...');
				}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function change_employee_document_status($employee_document_id='',$sta='')
	{
		checklogin_admin('Employee Checks','Write');
	    $this->admin_logs('NULL',$employee_document_id,'Change Status Employee Document',$sta);
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
	public function payslips($month='')
	{
		checklogin_admin('Payslips');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Payslips');
		$data['mnth_year']=$month;
		$data['payslips']=array(); 
		$created_date =date("Y-m-d H:i:s");
		if($month!=''){
			$myDateArray = explode("-", @$month);
			$GMnth=@$myDateArray[0];
			$GYear=@$myDateArray[1];
			$data['month']=$GMnth;
			$data['year']=$GYear;
			$GetCurrentMnthData=$this->db->query("SELECT `payslip_id`, `emp_id`, `month`, `year`, `payslip_file_name`, `payslip_file_path`, `is_active`, `created_at`, `updated_at` FROM `payslips` WHERE `month`=$GMnth AND `year`=$GYear")->num_rows();
			if($GetCurrentMnthData==0){
				$GetPreviousMnthData=$this->db->query("SELECT `payslip_id`, `emp_id`, `month`, `year`, `payslip_file_name`, `payslip_file_path`, `is_active`, `created_at`, `updated_at` FROM `payslips` WHERE `month`=$GMnth-1 AND `year`=$GYear")->num_rows();
				if($GetPreviousMnthData==0){
					$GetAllEmplyees=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `is_active` FROM `employees` WHERE `is_active`=1 ORDER BY `emp_id` ASC")->result_array();
					foreach ($GetAllEmplyees as $Emp)
					{
						$data=array('emp_id'=>$Emp['emp_id'],'month'=>$GMnth,'year'=>$GYear,'payslip_file_name'=>'','payslip_file_path'=>'','is_active'=>1,'created_at'=>$created_date);
						$this->db->insert('payslips',$data);
					}
				}else{
					$GetAllEmplyees=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `is_active` FROM `employees` WHERE `is_active`=1 ORDER BY `emp_id` ASC")->result_array();
					foreach ($GetAllEmplyees as $Emp)
					{
						$EID=$Emp['emp_id'];
						$data=array('emp_id'=>$Emp['emp_id'],'month'=>$GMnth,'year'=>$GYear,'payslip_file_name'=>'','payslip_file_path'=>'','is_active'=>1,'created_at'=>$created_date);
						$this->db->insert('payslips',$data);
					}
					
				}
			}
			$data['payslips']=$this->db->query("SELECT `t1`.`emp_id` as `e_id`, `t1`.`fname`, `t1`.`lname`, `t1`.`emp_code`, `t1`.`is_active`, `t2`.`payslip_id`, `t2`.`month`, `t2`.`year`, `t2`.`emp_id`, `t2`.`payslip_file_name`, `t2`.`payslip_file_path` FROM `employees` as `t1` LEFT JOIN `payslips` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `month`=$GMnth AND `year`=$GYear ORDER BY `t1`.`emp_id`")->result_array();
		 }
		 
		$data['active_menu']='payslips';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payslips');
		$this->load->view('admin/footer');
	}
	public function delete_payslip()
	{
		checklogin_admin('Payslips');
		$admin_id=$this->session->userdata('emp_id');
		$payslip_id = $this->input->post('payslip_id');
		$emp_id = $this->input->post('emp_id');
		$data['GetRolesAccess']=$this->read_write('Payslips');
		$this->admin_logs($emp_id,$payslip_id,'Payslip Deleted');
		$GetPayslip=$this->db->query("SELECT `payslip_id`, `emp_id`, `month`, `year`, `payslip_file_name`, `payslip_file_path`, `is_active`, `created_at`, `updated_at` FROM `payslips` WHERE `payslip_id`=$payslip_id")->row_array();
		$file = $GetPayslip['payslip_file_path'];
		$URL =base_url();
		$file_path = './assets/payslips/'.$file;
		unlink($file_path);
		$ArrData=array('payslip_file_name'=>'','payslip_file_path'=>'');
		$this->db->where('payslip_id',$payslip_id);
		$res=$this->db->update('payslips',$ArrData);
		if($res==1){
				echo 1;
		}else{
			echo 0;
		}
	}
	public function save_payslip()
	{
		
		$emp_id = $this->input->post('emp_id');
		$payslip_id = $this->input->post('payslip_id');
		$this->admin_logs($emp_id,$payslip_id,'Payslip Saved');
		$Month = $this->input->post('month');
		$Year = $this->input->post('year');
		$simage=str_replace(" ","_",$_FILES['simage']['name']);
		$image_path=time().$simage;
		$this->load->library('upload');
        $config['upload_path'] = 'assets/payslips';
        $config['file_name'] = $image_path;
        $config['allowed_types'] = 'pdf';
        $config['overwrite']=true;
        $this->upload->initialize($config);
       	if(!$this->upload->do_upload('simage'))
        {
           $output =array('status'=>-1);
           echo json_encode($output);
        }else{
        	$simage=$simage;
	        $image_path=$image_path;
			$Chk = $this->db->get_where('payslips', array('emp_id'=>$emp_id,'month'=>$Month,'year'=>$Year))->num_rows();
			if($Chk==0){
				$ArrData=array('emp_id'=>$emp_id,'month'=>$Month,'year'=>$Year,'payslip_file_name'=>$simage,'payslip_file_path'=>$image_path,'is_active'=>1,'created_at'=>date("Y-m-d H:i:s"));
		        $this->db->insert('payslips',$ArrData);
		        $insert_id = $this->db->insert_id();
		        $output =array('status'=>1,'simage'=>$simage,'simage_path'=>$image_path,'payslip_id'=>$insert_id);
		        echo json_encode($output);
			}else{
				$ArrData=array('emp_id'=>$emp_id,'month'=>$Month,'year'=>$Year,'payslip_file_name'=>$simage,'payslip_file_path'=>$image_path,'updated_at'=>date("Y-m-d H:i:s"));
				$this->db->where('payslip_id',$payslip_id);
		        $res = $this->db->update('payslips',$ArrData);
		        $output =array('status'=>0,'simage'=>$simage,'simage_path'=>$image_path,'payslip_id'=>$payslip_id);
		        echo json_encode($output);
        	}	
        
		}
	}
	public function get_payslip_list()
	{
		$month=@$this->input->get('month');
		$myDateArray = explode("-", @$month);
		$GMnth=@$myDateArray[0];
		if($myDateArray[0]!=''){
			$GetMnthData=$this->db->query("SELECT `payslip_id`, `emp_id`, `month`, `year`, `payslip_file_name`, `payslip_file_path`, `is_active`, `created_at`, `updated_at` FROM `payslips` WHERE `month`=$GMnth")->num_rows();
		}else{
			$GetMnthData='';
		}
		
		if($GetMnthData==0 && $myDateArray[0]!=''){
			$Mnth=@$myDateArray[0];
		}else if($myDateArray[0]!=''){
			$Mnth=@$myDateArray[0];
		}else{
			$Mnth=@$myDateArray[0];
		}
		$Year=@$myDateArray[1];
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_payslip_Details(1,$start,$length,$search['value'],$column,$dir,$Mnth);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_payslip_Details(2,$start,$length,$search['value'],$column,$dir,$Mnth);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]='<input type="hidden" name="emp_id[]" id="emp_id_'.$k.'" placeholder="Employee ID" class="form-control" value="'.@$res['e_id'].'">'.$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$m=@$Mnth;
					$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
					$NewArr[]=@$months[(int)$m];
					$NewArr[]=@$Year;
					$NewArr[]='<input type="file" name="simage" id="simage_'.$k.'" class="form-control filestyle" accept="application/pdf" onchange="loadFile(event,'.$k.')" />
                           <span>&nbsp;</span>';
					if($res['payslip_id']==''){
						$payslip_id=0;
					}else{
						$payslip_id=$res['payslip_id'];
					}
					$NewArr[]='<input type="button" name="Submit" id="Submit" class="btn btn-primary waves-effect waves-light mr-1 align-center" value="Save" onclick="AjxaSave_Payslip('.$k.','.$payslip_id.','.$Mnth.','.$Year.');">';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function timesheet()
	{
		checklogin_admin('Timesheet');
		$admin_id=$this->session->userdata('emp_id');
		if($admin_id==''){
			$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no`, `hr_manager_id`, `lead_manager_id`, `client_id` FROM `employees`")->result_array();
			$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients`")->result_array();
		}else{
			$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no`, `hr_manager_id`, `lead_manager_id`, `client_id` FROM `employees` WHERE `emp_id`=$admin_id")->result_array();
			$client_id=@$data['employees'][0]['client_id'];
			if($client_id!=''){
				$data['clients']=$this->db->query("SELECT `client_id`, `client_name`, `is_active`, `created_at`, `updated_at` FROM `clients` WHERE `client_id`=$client_id")->result_array();
			}
		}
		$data['active_menu']='timesheet';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/timesheet');
		$this->load->view('admin/footer');
	}
	public function timesheet_freezed()
	{
		checklogin_admin('Timesheet Freezed');
		$admin_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees` WHERE `is_active`=1")->result_array();
		$data['active_menu']='timesheet';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/timesheet_freezed');
		$this->load->view('admin/footer');
	}
	public function get_timesheet_freezed()
	{
		checklogin_admin('Timesheet Freezed');
		$admin_id=$this->session->userdata('emp_id');
		$StartDate=YY_MM_DD($this->input->post('StartDate'));
		$EndDate=YY_MM_DD($this->input->post('EndDate'));
		if($StartDate<=$EndDate){
			$employees=$this->db->query("SELECT t1.`timesheet_management_id`, t1.`emp_id`, t1.`worked_date`, t1.`worked_hours`, t2.`emp_id` as `e_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `timesheet_management` as `t1` LEFT JOIN `employees` as `t2` ON t1.`emp_id`=t2.`emp_id` WHERE t1.`worked_date`>='$StartDate' AND t1.`worked_date`<='$EndDate' GROUP BY t1.`emp_id`")->result_array();
			echo json_encode($employees); 
		}else{
			$employees=array();
			echo json_encode($employees); 
		}
	}
	public function save_timesheet_freezed()
	{
		checklogin_admin('Timesheet Freezed');
		$admin_id=$this->session->userdata('emp_id');
		$StartDate=YY_MM_DD($this->input->post('start_date'));
		$EndDate=YY_MM_DD($this->input->post('end_date'));
		$emp_id=$this->input->post('emp_id');
		// echo "<pre>";print_r($emp_id);exit;
		if($StartDate<=$EndDate)
		{
			if($emp_id=='All')
			{
				$employees=$this->db->query("SELECT t1.`timesheet_management_id`, t1.`emp_id`, t1.`worked_date`, t1.`worked_hours`, t2.`emp_id` as `e_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `timesheet_management` as `t1` LEFT JOIN `employees` as `t2` ON t1.`emp_id`=t2.`emp_id` WHERE t1.`worked_date`>='$StartDate' AND t1.`worked_date`<='$EndDate' GROUP BY t1.`emp_id`")->result_array();
				if(!empty($employees))
				{
					foreach($employees as $emplys)
					{
					    $freeze_timesheet=$StartDate.'_'.$EndDate;
						$ArrData=array('is_editble'=>'No','freeze_timesheet'=>$freeze_timesheet);
						$this->db->where('emp_id',$emplys['emp_id']);
						$this->db->where('worked_date>=',$StartDate);
						$this->db->where('worked_date<=',$EndDate);
						$res=$this->db->update('timesheet_management_details',$ArrData);
					}
				}
			}else{
				if(!empty($emp_id))
				{
					foreach($emp_id as $emps)
					{
						$freeze_timesheet=$StartDate.'_'.$EndDate;
						$ArrData=array('is_editble'=>'No','freeze_timesheet'=>$freeze_timesheet);
						$this->db->where('emp_id',$emps);
						$this->db->where('worked_date>=',$StartDate);
						$this->db->where('worked_date<=',$EndDate);
						$res=$this->db->update('timesheet_management_details',$ArrData);
					}
				}
			}
			if ($res==1)
			{
				$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Timeshesheet Frozen Successfully...</strong></div>');
			}
			else
			{
				$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Timeshesheet Frozen Failed!</strong></div>');
			}
		}else{
			$this->session->set_flashdata('failed','<div class="alert alert-success msgfade"><strong>Start Date Must Be Lesssthan or Equal to End Date...</strong></div>');
		}
		redirect('admin/timesheet_freezed'); 
	}
	public function get_client_employee_list()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$client_id=$this->input->post('client_id');
		if($client_id!='' && $admin_id!=''){
			$get_client_employee_list=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `hr_manager_id`, `lead_manager_id`, `client_id`, `is_active` FROM `employees` WHERE `client_id`=$client_id AND (`hr_manager_id`=$admin_id OR `lead_manager_id`=$admin_id)")->result_array();
			echo json_encode($get_client_employee_list); 
		}else if($client_id!='' && $admin_id==''){
			$get_client_employee_list=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `hr_manager_id`, `lead_manager_id`, `client_id`, `is_active` FROM `employees` WHERE `client_id`=$client_id")->result_array();
			echo json_encode($get_client_employee_list); 
		}
	}
	public function get_timesheet_list()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$client_id=$this->input->post('client_id');
		$emp_id=$this->input->post('emp_id');
		if($admin_id==''){
			$get_client_employee_list=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `hr_manager_id`, `lead_manager_id`, `client_id`, `is_active` FROM `employees` WHERE `client_id`=$client_id")->result_array();
		}else{
		    if($admin_id!='')
		    {
		    	$GetHrLeadMangers=$this->db->query("SELECT * FROM `employees` WHERE `emp_id`=$admin_id")->row_array();
		    	$hr_manager_id=@$GetHrLeadMangers['hr_manager_id'];
				$lead_manager_id=@$GetHrLeadMangers['lead_manager_id'];
		    }else{
		    	$hr_manager_id='';
		    	$lead_manager_id='';
		    }
			$get_client_employee_list=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `hr_manager_id`, `lead_manager_id`, `client_id`, `is_active` FROM `employees` WHERE `client_id`=$client_id AND (`hr_manager_id`=$hr_manager_id OR `lead_manager_id`=$lead_manager_id)")->result_array();
		}
		$start_date=date("Y-m-d", strtotime($this->input->post('start_date')));
		$end_date=date("Y-m-d", strtotime($this->input->post('end_date')));
		$data['start_date']=$start_date;
		$data['end_date']=$end_date;
		if($emp_id=='All' && $admin_id!=''){
			$data['emp_list']=$this->db->query("SELECT * FROM `timesheet_management` WHERE `client_id`=$client_id AND (`hr_manager_id`=$admin_id OR `lead_manager_id`=$admin_id) AND `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' GROUP BY `emp_id`")->result_array();
			$response = $this->load->view('admin/get_all_employee_timesheet_list',$data, TRUE);
			echo $response;
		}else if($emp_id=='All' && $admin_id==''){
			$data['emp_list']=$this->db->query("SELECT * FROM `timesheet_management` WHERE `client_id`=$client_id AND `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' GROUP BY `emp_id`")->result_array();
			$response = $this->load->view('admin/get_all_employee_timesheet_list',$data, TRUE);
			echo $response;
		}else{
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
			$data['chk_report_exist']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, `worked_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `client_id`=$client_id AND `emp_id`=$emp_id AND `worked_date` >= '$start_date' AND `worked_date` <= '$end_date'")->result_array();
			$data['get_employee_client_desig_name']=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`client_manager`, t1.`client_id`, t1.`designation_id`, t2.`client_id`, t2.`client_name`, t3.`designation_id`, t3.`designation_name` FROM `employees` as `t1` LEFT JOIN clients as t2 ON t1.`client_id` = t2.`client_id` LEFT JOIN designation as t3 ON t1.`designation_id`=t3.`designation_id` WHERE t1.`emp_id`=$emp_id")->row_array();
			$data['Normal_Hours_Worked']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Normal Hours Worked'")->row_array();
			$data['Sick_Leave']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Sick Leave'")->row_array();
			$data['Public_Holiday']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Public Holiday'")->row_array();
			$data['Overtime']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Overtime'")->row_array();
			$data['Annual_Leave']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Annual Leave'")->row_array();
			$data['Other']=$this->db->query("SELECT `timesheet_management_id`, `emp_id`, `client_id`, `item`, `type_of_work_performed`, `worked_date`, SUM(`worked_hours`) as `totl_hours`, `comments`, `enter_date`, `enter_time`, `is_active` FROM `timesheet_management` WHERE `worked_date` >= '$start_date' AND `worked_date` <= '$end_date' AND `emp_id`=$emp_id AND `item`='Other'")->row_array();
			echo $this->load->view('admin/get_timesheet_list',$data, TRUE);
		}else{
			redirect('master');
		}
			
		}
	}
	public function dateRange($from, $to)
	{
		checklogin_admin();
		return array_map(function($arg) {
			return date('Y-m-d', $arg);
		}, range(strtotime($from), strtotime($to), 86400));
	}
	public function download_pdf($emp_id='',$start_date='',$end_date='')
	{
		checklogin_admin();
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
			echo $this->load->view('admin/download_pdf',$data, TRUE);
		}else{
			redirect('master');
		}
	}
	public function download_detailed_timesheet($emp_id='',$start_date='',$end_date='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
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
			echo $this->load->view('admin/download_detailed_timesheet',$data, TRUE);
		}else{
			redirect('master');
		}
	}
	public function view_employee_timesheet_list($client_id,$emp_id,$start_date,$end_date)
	{
		checklogin_admin('Timesheet');
		if($client_id!='' && $emp_id!='' && $start_date!='' && $end_date!=''){
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
	public function designations()
	{
		checklogin_admin('Designations');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Designations');
		$data['designations']=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation`")->result_array();
		$data['active_menu']='designations';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/designations');
		$this->load->view('admin/footer');
	}
	public function change_designation_status($designation_id='',$sta='')
	{
		checklogin_admin('Designations','Write');
	    $this->admin_logs('NULL',$designation_id,'Change Designation Status',$sta);
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
		checklogin_admin('Designations','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='designations';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_designation');
		$this->load->view('admin/footer');
	}
	public function save_designation()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$designation_name=trim($this->input->post('designation_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'designation_name', 'label' => 'Client Name','rules'   => 'required'),
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
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Add Designation');
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
		checklogin_admin('Designations','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['designation']=$this->db->query("SELECT `designation_id`, `designation_name`, `is_active`, `created_at`, `updated_at` FROM `designation` WHERE `designation_id`=$designation_id")->row_array();
		$data['active_menu']='designations';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_designation');
		$this->load->view('admin/footer');
	}
	public function update_designation()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$designation_id=$this->input->post('designation_id');
		$this->admin_logs('NULL',$designation_id,'Updated Designation');
		$designation_name=trim($this->input->post('designation_name'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'designation_name', 'label' => 'Designation Name','rules'   => 'required'),
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
		checklogin_admin('Identification Type');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Identification Type');
		$data['identifications']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type`")->result_array();
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/identifications');
		$this->load->view('admin/footer');
	}
	public function change_identification_status($identification_id='',$sta='')
	{
		checklogin_admin('Identification Type','Write');
	    $this->admin_logs('NULL',$identification_id,'Change Status Identification Type',$sta);
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
		checklogin_admin('Identification Type','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_identification');
		$this->load->view('admin/footer');
	}
	public function save_identification()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$identification_name=trim($this->input->post('identification_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'=> 'identification_name', 'label'=> 'Identification Name','rules'=> 'required'),
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
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Add Identification Type');
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
		checklogin_admin('Identification Type','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['identification']=$this->db->query("SELECT `identification_id`, `identification_name`, `is_active`, `created_at`, `updated_at` FROM `identification_type` WHERE `identification_id`=$identification_id")->row_array();
		$data['active_menu']='identifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_identification');
		$this->load->view('admin/footer');
	}
	public function update_identification()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$identification_id=$this->input->post('identification_id');
		$this->admin_logs('NULL',$identification_id,'Updated Identification Type');
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
		checklogin_admin('Management');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Management');
		$data['email']=$this->db->query("SELECT t1.`email_id`, t1.`name`, t1.`designation`, t1.`email`, t1.`is_active`, t1.`created_at` FROM `email_ids` as t1")->result_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/email_ids');
		$this->load->view('admin/footer');
	}
	public function add_email_id()
	{
		checklogin_admin('Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_email_id');
		$this->load->view('admin/footer');
	}
	public function save_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		$post['is_active']=1;
		$emp_id=trim($this->input->post('emp_id'));
		$GetDet=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['name']=$GetDet['fname'].' '.$GetDet['lname'];
		$post['email']=$GetDet['email_id'];
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'emp_id', 'label'   => 'Employee','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/email_id');
        }else{
        	$check=$this->db->get_where('email_ids',array('emp_id'=>$emp_id))->num_rows();
			if($check==0){
				$res=$this->db->insert('email_ids',$post);
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Save Management');
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
		checklogin_admin('Management','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['email']=$this->db->query("SELECT `email_id`, `emp_id`, `designation`, `email`, `is_active`, `created_at`, `updated_at` FROM `email_ids` WHERE `email_id`=$email_id")->row_array();
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_email_id');
		$this->load->view('admin/footer');
	}
	public function update_email_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$email_id=$this->input->post('email_id');
		$post = $this->input->post();
		$this->admin_logs('NULL',$email_id,'Updated Management');
		$emp_id=trim($this->input->post('emp_id'));
		$GetDet=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
		$post['name']=$GetDet['fname'].' '.$GetDet['lname'];
		$post['email']=$GetDet['email_id'];
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'emp_id', 'label'  => 'Employee','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/email_id');
        }else{
        	$check=$this->db->get_where('email_ids',array('emp_id'=>$emp_id,'emp_id!='=>$emp_id))->num_rows();
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
		$admin_id=$this->session->userdata('emp_id');
		$data['email']=$this->db->query("SELECT t1.`email_id`, t1.`emp_id`, t1.`email`, t1.`is_active`, t1.`created_at`,t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `email_ids` as t1 LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`is_active`=1  AND t1.`emp_id`!='' GROUP BY t1.`emp_id`")->result_array();
		$data['active_menu']='employee_email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee_email_ids');
		$this->load->view('admin/footer');
	}
	public function view_employee_email_ids($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$data['email_ids']=$this->db->query("SELECT t1.`email_id`, t1.`emp_id`, t1.`email`, t1.`is_active`, t1.`created_at`,t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `email_ids` as t1 LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id")->result_array();
		$data['active_menu']='email_id';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_employee_email_ids');
		$this->load->view('admin/footer');
	}
	public function delete_email_id($email_id='')
	{
		checklogin_admin();
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
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
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
		$admin_id=$this->session->userdata('emp_id');
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
	public function recruitment()
	{
		checklogin_admin('Recruitment');
		$admin_id=$this->session->userdata('emp_id');
		$data['status_val']='';
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$data['active_menu']='recruitment';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/recruitment');
		$this->load->view('admin/footer');
	}
	public function recruitment_status_list($status_val='')
	{
		checklogin_admin('Recruitment');
		$admin_id=$this->session->userdata('emp_id');
		$data['status_val']=$status_val;
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `designation_id`, `email_id`, `phone_no` FROM `employees`")->result_array();
		$data['active_menu']='recruitment';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/recruitment');
		$this->load->view('admin/footer');
	}
	public function download_excel_recruitment($status_val='')
	{
		checklogin_admin('Recruitment');
		$admin_id=$this->session->userdata('emp_id');
		if($status_val!=''){
			$dt=$this->db->query("SELECT `recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `status`, `status_date`, `created_at`, `updated_at` FROM `recruitment` WHERE `status`='$status_val'")->result_array();
		}else{
			$dt=$this->db->query("SELECT `recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `status`, `status_date`, `created_at`, `updated_at` FROM `recruitment`")->result_array();
		}
		$date =date('d-M-Y');
		$name = 'Recruitment_Reports'.$date;
        $name=$name.'.xls';
        header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: Attachment; filename=$name");
		$aa ="S.No\tName\tCurrent Role\tReporting Vendor\tEnd Client\tApplied Role\tClient Feedback\tClient Feedback Rejected\tCurrent Rate Card\tProposed Rate Card\tNotice Period\tDate of Submission\tStatus\tComments\n";
		$counter=1;
		foreach($dt as $k=>$val){
			 $aa.=$counter."\t".$val['name']."\t".$val['job_role']."\t".$val['reporting_vendor']."\t".$val['end_client']."\t".$val['applied_role_position']."\t".$val['client_feedback']."\t".$val['client_feedback_rejected']."\t".$val['Candidate_current_rate_card']."\t".$val['proposed_rate_card_to_client']."\t".$val['notice_period']."\t".$val['created_at']."\t".$val['status']."\t".$val['comments']."\n";
             $counter++;
        }
        echo $aa;
	}
	public function get_recruitment_list($statusval='')
	{
		$statusval=$this->input->get('statusval');
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_recruitment_Details(1,$start,$length,$search['value'],$column,$dir,$statusval);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_recruitment_Details(2,$start,$length,$search['value'],$column,$dir,$statusval);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['name'];
					$NewArr[]=$res['job_role'];
					$NewArr[]=$res['reporting_vendor'];
					$NewArr[]=$res['end_client'];
					$NewArr[]=$res['applied_role_position'];
					$NewArr[]=$res['client_feedback'];
					$NewArr[]=$res['Candidate_current_rate_card'];
					$NewArr[]=$res['proposed_rate_card_to_client'];
					$NewArr[]=$res['notice_period'];
					$NewArr[]=$res['comments'];
					$NewArr[]=DD_M_YY($res['created_at']);
					$sel='<select name="status" onChange="GetVal(this,'.$res['recruitment_id'].');">';
					 $sel.='<option value="">--Select--</option>';
				        $op=($res['status']=='Select')?'selected':'';
				        $op=($res['status']=='Submitted')?'selected':'';
				    $sel.='<option value="Submitted" '.$op.'>Submitted</option>';
				        $op=($res['status']=='Shorlisted')?'selected':'';
				    $sel.='<option value="Shorlisted" '.$op.'>Shorlisted</option>';
				        $op=($res['status']=='RejectedbyClient')?'selected':'';
				    $sel.='<option value="RejectedbyClient" '.$op.'>Rejected by Client</option>';
				    $op=($res['status']=='Selected')?'selected':'';
				    $sel.='<option value="Selected" '.$op.'>Selected</option>';
				    $sel.='</select>';

				    if($res['status'] == '') {
				        $final= '';
				    }else if($res['status'] == 'Submitted') {
				        $final= $res['status_date'];
				    }else if($res['status'] == 'Shorlisted'){
				        $final= $res['status_date'];
				    }else if($res['status'] == 'RejectedbyClient'){
				        $final= $res['status_date'];
				    }else if($res['status'] == 'Selected'){
				        $final= $res['status_date'];
				    }else{
				        $final= '';
				    }
					$NewArr[] = $sel.'<br>'.$final;
					$NewArr[]='<a href="'.base_url().'admin/edit_recruitment/'.$res['recruitment_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-edit" style="color: #fff !important;"></i> Edit </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function change_recruitment_status($status='',$id='')
	{
	    checklogin_admin('Recruitment','Write');
	    $this->admin_logs($emp_id,'NULL','Change Status Recruitment',$status);
		$data = array('status'=>$status,'status_date'=>date("Y-m-d H:i:s"));
		$this->db->where('recruitment_id',$id);
		$res=$this->db->update('recruitment',$data);
		if($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Recruitment status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Recruitment status update failed!...</strong></div>');
		}
		redirect('admin/recruitment');
	}
	public function add_recruitment()
	{
		checklogin_admin('Recruitment','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='recruitment';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_recruitment');
		$this->load->view('admin/footer');
	}
	public function save_recruitment()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'name', 'label'   => 'Name','rules'   => 'required'),
			array( 'field'   => 'job_role', 'label'   => 'Job Role','rules'   => 'required'),
			array( 'field'   => 'reporting_vendor', 'label'   => 'Reporting Vendor','rules'   => 'required'),
			array( 'field'   => 'end_client', 'label'   => 'End Client','rules'   => 'required'),
			array( 'field'   => 'applied_role_position', 'label'   => 'Applied Role Position','rules'   => 'required'),
			array( 'field'   => 'proposed_rate_card_to_client', 'label'   => 'Proposed Rate Card to Client','rules'   => 'required'),
			array( 'field'   => 'notice_period', 'label'   => 'Notice Period','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/recruitment');
        }
        else
        {
		        $post['created_at']=YY_MM_DD($this->input->post('created_at'));
		        $post['is_active']=1;
		        $post['emp_id']=$admin_id;
				$res = $this->db->insert('recruitment',$post);
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Save Recruitment');
				if($res==1){
					$this->session->set_flashdata('success','Recruitment Created Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Recruitment Created Failed...');
				}
		}
		redirect('admin/recruitment');
	}
	public function edit_recruitment($recruitment_id='')
	{
		checklogin_admin('Recruitment','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['recruitment']=$this->db->query("SELECT `recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `created_at`, `updated_at` FROM `recruitment` WHERE `recruitment_id`=$recruitment_id")->row_array();
		$data['active_menu']='recruitment';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_recruitment');
		$this->load->view('admin/footer');
	}
	public function update_recruitment()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		$this->admin_logs('NULL',$post['recruitment_id'],'Updated Recruitment');
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'name', 'label'   => 'Name','rules'   => 'required'),
			array( 'field'   => 'job_role', 'label'   => 'Job Role','rules'   => 'required'),
			array( 'field'   => 'reporting_vendor', 'label'   => 'Reporting Vendor','rules'   => 'required'),
			array( 'field'   => 'end_client', 'label'   => 'End Client','rules'   => 'required'),
			array( 'field'   => 'applied_role_position', 'label'   => 'Applied Role Position','rules'   => 'required'),
			array( 'field'   => 'proposed_rate_card_to_client', 'label'   => 'Proposed Rate Card to Client','rules'   => 'required'),
			array( 'field'   => 'notice_period', 'label'   => 'Notice Period','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/recruitment');
        }
        else
        {
        		$post['created_at']=YY_MM_DD($this->input->post('created_at'));
		        $post['updated_at']=$updated_date;
		        $post['emp_id']=$admin_id;
		        $this->db->where('recruitment_id',$post['recruitment_id']);
				$res = $this->db->update('recruitment',$post);
				if($res==1){
					$this->session->set_flashdata('success','Recruitment Updated Successfully..');
				}else{
					$this->session->set_flashdata('failed','This Recruitment Updated Failed...');
				}
		}
		redirect('admin/recruitment');
	}
	public function certificate_of_service_letter()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code` FROM `employees`")->result_array();
		$data['active_menu']='certificate_of_service_letter';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/certificate_of_service_letter');
		$this->load->view('admin/footer');
	}
	public function generate_cosl($emp_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$data['res'] = $this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`designation_id`, t1.`date_of_joining`, t1.`termination_date`, t1.`comments`, t2.`designation_id` as desg_id, t2.`designation_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` WHERE t1.`emp_id`=$emp_id")->row_array();
    	if(!empty($data['res']))
    	{
        	$html=$this->load->view('admin/generate_cosl',$data,TRUE);
        	$EmpData=json_encode($data['res']);
    		$date =date("Y-m-d H:i:s");
    		$ArrData=array('emp_id'=>$emp_id,'emp_details'=>$EmpData,'created_at'=>$date);
        	$res = $this->db->insert('certificate_of_service',$ArrData);
    		if($res==1){
    		    $this->load->library('M_pdf');
    			$mpdf = new \Mpdf\Mpdf();
    			$mpdf->WriteHTML($html);
    			$mpdf->Output();
    		}else{
    			$this->session->set_flashdata('failed','This Certificate Of Service Letter Failed...');
    			redirect('admin/certificate_of_service_letter');
    		}
    	}else{
    	    echo "no data found";
    	}
	}
	public function roles()
	{
		checklogin_admin('Roles');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='roles';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/roles');
		$this->load->view('admin/footer');
	}
	public function add_role()
	{
		checklogin_admin('Roles','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['active_menu']='roles';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_role');
		$this->load->view('admin/footer');
	}
	public function save_role()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$role_name=trim($this->input->post('role_name'));
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'=> 'role_name', 'label'=> 'Role Name','rules'=> 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/roles');
        }else{
        	$check=$this->db->get_where('roles',array('role_name'=>$role_name))->num_rows();
			if($check==0){
				$data = array('role_name'=>$role_name,'is_active'=>1);
				$res=$this->db->insert('roles',$data);
				$insert_id = $this->db->insert_id();
				$this->admin_logs('NULL',$insert_id,'Add Roles');
				if($res==1){
					$this->session->set_flashdata('success','Role saved successfully...');
				}else{
					$this->session->set_flashdata('failed','This Role saved failed!...');
				}
			}else{
				$this->session->set_flashdata('failed','This Role already existed!...');
			}
        }
		redirect('admin/roles/');
	}
	public function edit_role($roles_id='')
	{
		checklogin_admin('Roles','Write');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles` WHERE `roles_id`=$roles_id")->row_array();
		$data['active_menu']='roles';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/edit_role');
		$this->load->view('admin/footer');
	}
	public function update_role()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$roles_id=$this->input->post('roles_id');
		$this->admin_logs('NULL',$client_id,'Updated Role');
		$role_name=trim($this->input->post('role_name'));
		$updated_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'   => 'role_name', 'label'   => 'Role Name','rules'   => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect('admin/roles');
        }else{
        	$check=$this->db->get_where('roles',array('role_name'=>$role_name,'roles_id!='=>$roles_id))->num_rows();
			if($check==0){
				$res = $this->db->update('roles',array('role_name'=>$role_name),array('roles_id'=>$roles_id));
				if($res==1){
					$this->session->set_flashdata('success','Role Updated successfully...');
				}else{
					$this->session->set_flashdata('failed','Role updated added !...');
				}
			}else{
				$this->session->set_flashdata('failed','This Role already existed!...');
			}
        }
		redirect('admin/roles/');
	}
	public function change_role_status($roles_id='',$sta='')
	{
	    checklogin_admin('Roles','Write');
	    $this->admin_logs('NULL',$client_id,'Change Role Status',$sta);
		$data = array('is_active'=>$sta);
		$this->db->where('roles_id',$roles_id);
		$res=$this->db->update('roles',$data);
		if ($res==1)
		{
			$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Role status updated successfully...</strong></div>');
		}
		else
		{
			$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Role status update failed!...</strong></div>');
		}
		redirect('admin/roles');
	}
	public function role_access()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='role_access';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/role_access');
		$this->load->view('admin/footer');
	}
	public function get_roles_table()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$role_id=$this->input->post('role_id');
		$data['role_id']=$role_id;
		$des_roles_table=$this->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `access`, `read`, `write`, `sub_menu_icon`,`is_active`, `created_at`, `updated_at` FROM `role_access` WHERE `role_id`=$role_id AND `is_active`=1 ORDER BY `sub_menu_name` ASC")->result_array();
		if(!empty($des_roles_table)){
			$data['des_roles_table']=$des_roles_table;
		}else{
			$DesRolesTable=$this->db->query("SELECT `sub_menu_id`, `menu_id`, `sub_menu_name`, `sub_menu_url`, `sub_menu_icon`, `is_active`, `created_at`, `updated_at` FROM `sub_menu` WHERE `is_active`=1 AND `sub_menu_name`!='Roles' AND `sub_menu_name`!='Roles Access'")->result_array();
			foreach ($DesRolesTable as $value) {
				$Arr=array(
						'role_id'=>$role_id,
						'menu_id'=>$value['menu_id'],
						'sub_menu_name'=>$value['sub_menu_name'],
						'sub_menu_url'=>$value['sub_menu_url'],
						'sub_menu_icon'=>$value['sub_menu_icon'],
						'access'=>0,
						'read'=>0,
						'write'=>0,
						'created_at'=>date("Y-m-d H:i:s")
					);
				$this->db->insert('role_access',$Arr);
			}
			$data['des_roles_table']=$this->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `access`, `read`, `write`, `is_active`, `created_at`, `updated_at` FROM `role_access` WHERE `role_id`=$role_id AND `is_active`=1 ORDER BY `sub_menu_name` ASC")->result_array();
		}
		$data['active_menu']='role_access';
		echo $this->load->view('admin/get_roles_table',$data,TRUE);
	}
	public function update_roles_table()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$role_access_id=$this->input->post('role_access_id');
		$type=$this->input->post('type');
		$role_id=$this->input->post('role_id');
		$switch_val=$this->input->post('switch_val');
		if($switch_val=='yes'){
			$val=1;
		}else{
			$val=0;
		}
		$this->db->where('role_access_id',$role_access_id);
		if($type=="Access" && $switch_val=='no'){
			$Arr=array('access'=>$val,'read'=>0,'write'=>0);
		}else if($type=="Access"){
			$Arr=array('access'=>$val);
		}else if($type=="Read"){
			$Arr=array('read'=>$val);
		}else{
			$Arr=array('Write'=>$val);
		}
		$this->db->update('role_access',$Arr);
	}
	public function get_emp_details()
	{
		$emp_id=$this->input->post('emp_id');
		if($emp_id!=''){
			$GetDet=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `emp_code`, `email_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
			echo $GetDet['email_id'];
		}else{
			echo 0;
		}
	}
	public function employee_roles()
	{
		checklogin_admin('Employee Roles');
		$admin_id=$this->session->userdata('emp_id');
		$data['role_id']=$this->session->userdata('role_id');
		$data['GetRolesAccess']=$this->read_write('Employee Roles');
		$data['active_menu']='reports';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/employee_roles');
		$this->load->view('admin/footer');
	}
	public function get_employee_roles_list()
	{
	    $role_id=$this->input->get('role_id');
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->search_employee_roles_list_Details(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->search_employee_roles_list_Details(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
				    $emp_id=$res['emp_id'];
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					if($res['role_name']!=''){
					    $NewArr[]='<span style="color:#0000FF">'.$res['role_name'].'</span>';
					}else{
					   $NewArr[]='Employee'; 
					}
					if($res['is_active'] == 0) {
						$status= '<button class="btn btn-danger waves-effect waves-light"> Inactive </button>';
					}else{
						$status= '<button class="btn btn_success waves-effect waves-light"> Active </button>';
					}
					$NewArr[]=$status;
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function export_employee_roles()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$dt=$this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`email_id`, t1.`role_id` as `r_id`, t1.`is_active`, t2.`roles_id`, t2.`role_name` FROM `employees` as `t1` LEFT JOIN `roles` as `t2` ON `t1`.`role_id` = `t2`.`roles_id` ORDER BY t1.`emp_id` ASC")->result_array();
		$date =date('d-M-Y');
		$name = 'Employee_roles_'.$date;
        $name=$name.'.xls';
        header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: Attachment; filename=$name");
		$aa ="S.No\tEmployee Name\tRole\tStatus\n";
		$counter=1;
		foreach($dt as $k=>$val){
		    if($val['role_name']!=''){
				$RoleName=$val['role_name'];
			}else{
				$RoleName='Employee';
			}
			if($val['is_active']==1){
				$Status='Active';
			}else{
				$Status='Inactive';
			}
			 $aa.=$counter."\t".$val['fname'].$val['lname'].' '.'('.$val['emp_code'].')'."\t".$RoleName."\t".$Status."\n";
             $counter++;
        }
        echo $aa;
	}
	public function job_position()
	{
		checklogin_admin('Job Positions');
		$admin_id=$this->session->userdata('emp_id');
		$search = $this->input->get('search');
		$type = $this->input->get('type');
		$active_inactive = $this->input->get('active_inactive');
		$cmpny = $this->input->get('cmpny');
		$data['companies'] = $this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
		$WHEre='';
		if($search!='' && $search!='NA' && $active_inactive!='' && $cmpny!=''){
			$WHEre="t1.`company_name` LIKE '%$search%' AND t1.`is_active`=$active_inactive AND t1.`company_id`=$cmpny";
		}else if($search=='' && $search!='NA' && $active_inactive=='' && $cmpny!=''){
			$WHEre="t1.`company_id`=$cmpny";
		}else if($search=='' && $search!='NA' && $active_inactive!='' && $cmpny==''){
			$WHEre="t1.`is_active`=$active_inactive";
		}else if($search=='' && $search!='NA' && $active_inactive!='' && $cmpny!=''){
			$WHEre="t1.`is_active`=$active_inactive AND t1.`company_id`=$cmpny";
		}else if($search!='' && $search!='NA' && $active_inactive=='' && $cmpny==''){
			$WHEre="t1.`company_name` LIKE '%$search%'";
		}else if($search!='' && $search!='NA' && $active_inactive!=''){
			$WHEre="t1.`company_name` LIKE '%$search%' AND t1.`is_active`=$active_inactive";
		}else if($search!='' && $search!='NA' && $cmpny!=''){
			$WHEre="t1.`company_name` LIKE '%$search%' AND t1.`company_id`=$cmpny";
		}else if($search!='' && $search=='NA' && $active_inactive!='' && $cmpny!=''){
			$WHEre="t1.`is_active`=$active_inactive AND t1.`company_id`=$cmpny GROUP BY t1.`company_id`";
		}else if($search!='' && $search=='NA' && $active_inactive!=''){
			$WHEre="t1.`company_name` LIKE '%$search%' AND t1.`is_active`=$active_inactive";
		}else if($search!='' && $search=='NA' && $cmpny!=''){
			$WHEre="t1.`company_name` LIKE '%$search%' AND t1.`company_id`=$cmpny";
		}else if($search!='' && $search!='NA'){
			$WHEre="t1.`company_name` LIKE '%$search%'";
		}else if($active_inactive!='' && $cmpny!=''){
			$WHEre="t1.`is_active`=$active_inactive AND t1.`company_id`=$cmpny";
		}else if($active_inactive!='' && $type=='Active_Inactive'){
			$WHEre="t1.`is_active`=$active_inactive";
		}else if($cmpny!='' && $type=='Comapnies'){
			$WHEre="t1.`company_id`=$cmpny";
		}
		
		if($search!='' || $type!='' || $active_inactive!='' || $cmpny!=''){
			if($search=='NA' && $active_inactive!='' && $cmpny!=''){
				$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE $WHEre AND t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
				$this->load->view('admin/ajax_job_position',$data);
			}else if($search=='NA' && $active_inactive=='' && $cmpny==''){
				$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
				$this->load->view('admin/ajax_job_position',$data);
			}else if($search=='' && $active_inactive=='' && $cmpny==''){
				$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
				$this->load->view('admin/ajax_job_position',$data);
			}else{
				$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE $WHEre AND t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
				$this->load->view('admin/ajax_job_position',$data);
			}
			
		}else if($search=='' && $search!='NA' && $type=='' && $active_inactive=='' && $cmpny==''){
			$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
			$data['active_menu']='job_position';
			$data['ppage']=$this->load->view('admin/ajax_job_position',$data,TRUE);
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/job_position');
			$this->load->view('admin/footer');
		}else if($search=='NA' && $active_inactive=='' && $cmpny==''){
			$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
			$data['ppage']=$this->load->view('admin/ajax_job_position',$data,TRUE);
		}else{
			$data['job_position']=$this->db->query("SELECT t1.`company_id`, t1.`company_name`, t1.`is_active`, t2.`job_id`, t2.`company_id` as job_c_id, t2.`job_title`, t2.`is_active` as `job_is_active` FROM `companies` as `t1` LEFT JOIN `jobs` as `t2` ON `t1`.`company_id` = `t2`.`company_id` WHERE t2.`job_title` IS NOT NULL GROUP BY t2.`job_title`")->result_array();
			$data['active_menu']='job_position';
			$data['ppage']=$this->load->view('admin/ajax_job_position',$data,TRUE);
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/job_position');
			$this->load->view('admin/footer');
		}
	}
	public function change_job_status()
	{
	    checklogin_admin('Job Positions');
	    $admin_id=$this->session->userdata('emp_id');
		$company_id = $this->input->post('data_value');
		$sta = $this->input->post('checked_not');
		$this->admin_logs($admin_id,'NULL','Change Company Status',$sta);
		$data = array('is_active'=>$sta);
		$this->db->where('company_id',$company_id);
		$res=$this->db->update('companies',$data);
		if($res==1)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	public function change_company_status()
	{
	    checklogin_admin('Job Positions');
	    $admin_id=$this->session->userdata('emp_id');
		$job_id = $this->input->post('job_id');
		$sta = $this->input->post('status');
		$this->admin_logs($admin_id,'NULL','Change Job Status',$sta);
		$data = array('is_active'=>$sta);
		$this->db->where('job_id',$job_id);
		$res=$this->db->update('jobs',$data);
		if($res==1)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	public function create_job($job_id='')
	{
		checklogin_admin('Create Job');
		$admin_id=$this->session->userdata('emp_id');
		$data['companys']=$this->db->query("SELECT `company_id`, `company_name`, `is_active`, `created_at`, `updated_at` FROM `companies`")->result_array();
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		if($job_id!=''){
			$data['jobs']=$this->db->query("SELECT * FROM `jobs` WHERE `job_id`=$job_id")->row_array();
		}
		$data['active_menu']='create_job';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/create_job');
		$this->load->view('admin/footer');
	}
	public function check_company_existed()
	{
		$company_name=$this->input->post('company_name');
		$check=$this->db->get_where('companies',array('company_name'=>$company_name))->num_rows();
		if($check==0){
			$data=array('company_name'=>$company_name,'is_active'=>1,'created_at'=>date("Y-m-d H:i:s"));
			$res=$this->db->insert('companies',$data);
			$dataArr['getallcompanys']=$this->db->query("SELECT `company_id`, `company_name`, `is_active`, `created_at`, `updated_at` FROM `companies`")->result_array();
			$dataArr['getallcompanys']['res']=1;
			echo json_encode($dataArr);
		}else{
			echo 0;
		}
	}
	public function save_job()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$job_id=$post['job_id'];
		$id=@$post['model_edit_id'];
		if($id!=''){
			$this->update_job($post);
		}else if($job_id!=''){
			$this->update_job($post);
		}else{
			$created_date =date("Y-m-d H:i:s");
			$config = array( 
				array( 'field'=> 'job_title', 'label'=> 'job title','rules'=> 'required'),
				array( 'field'=> 'company_id', 'label'=> 'company','rules'=> 'required'),
				array( 'field'=> 'location', 'label'=> 'location','rules'=> 'required'),
				array( 'field'=> 'job_description', 'label'=> 'job description','rules'=> 'required'),
				array( 'field'=> 'employment_type', 'label'=> 'employment type','rules'=> 'required'),
				array( 'field'=> 'seniority_level', 'label'=> 'seniority level','rules'=> 'required'),
				array( 'field'=> 'work_experience_from', 'label'=> 'work experience from','rules'=> 'required'),
				array( 'field'=> 'work_experience_to', 'label'=> 'work experience to','rules'=> 'required'),
				array( 'field'=> 'skills', 'label'=> 'skills','rules'=> 'required'),
				array( 'field'=> 'education', 'label'=> 'education','rules'=> 'required'),
				);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
	        {
	            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
			    echo 0;
	        }else{
					$data = array('job_title'=>$post['job_title'],'company_id'=>$post['company_id'],'department'=>$post['department'],'location'=>$post['location'],'remote_in_career_page'=>$post['remote_in_career_page'],'job_description'=>$post['job_description'],'employment_type'=>$post['employment_type'],'seniority_level'=>$post['seniority_level'],'industry_type'=>$post['industry_type'],'salary_range'=>$post['salary_range'],'minimum'=>$post['minimum'],'maximum'=>$post['maximum'],'work_experience_from'=>$post['work_experience_from'],'work_experience_to'=>$post['work_experience_to'],'number_of_openings'=>$post['number_of_openings'],'skills'=>$post['skills'],'education'=>$post['education'],'is_active'=>1,'created_at'=>$created_date);
					$res=$this->db->insert('jobs',$data);
					$insert_id = $this->db->insert_id();
					$post['last_insert_id']=$insert_id;
					$this->admin_logs('NULL',$insert_id,'Create Job');
					if($res==1){
						echo json_encode($post);
					}else{
						echo 0;
					}
				}
		}
	}
	public function update_job($post='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		if($post['job_id']!=''){
			$id=$post['job_id'];
		}else{
			$id=$post['model_edit_id'];
		}
		$created_date =date("Y-m-d H:i:s");
		$data = array('job_title'=>$post['job_title'],'company_id'=>$post['company_id'],'department'=>$post['department'],'location'=>$post['location'],'remote_in_career_page'=>$post['remote_in_career_page'],'job_description'=>$post['job_description'],'employment_type'=>$post['employment_type'],'seniority_level'=>$post['seniority_level'],'industry_type'=>$post['industry_type'],'salary_range'=>$post['salary_range'],'minimum'=>$post['minimum'],'maximum'=>$post['maximum'],'work_experience_from'=>$post['work_experience_from'],'work_experience_to'=>$post['work_experience_to'],'number_of_openings'=>$post['number_of_openings'],'skills'=>$post['skills'],'education'=>$post['education'],'is_active'=>1,'created_at'=>$created_date);
		$this->db->where('job_id',$id);
		$res=$this->db->update('jobs',$data);
		$post['last_insert_id']=$id;
		$this->admin_logs('NULL',$id,'Update Job');
		if($res==1){
			echo json_encode($post);
		}else{
			echo 0;
		}
			
	}
	public function candidate_status($company_id='',$job_id='')
	{
		$this->load->library('encryption');
		checklogin_admin('Job Positions');
		$admin_id=$this->session->userdata('emp_id');
		$type=$this->input->post('type');
		$search=$this->input->get('search');
		$active_inactive=$this->input->get('active_inactive');
		$cmpny=$this->input->get('cmpny');
		$s_company_id=$this->input->get('company_id');
		$s_job_id=$this->input->get('job_id');
		if($job_id!=''){
			$data['GetJobTitle']=$this->db->query("SELECT `job_id`, `company_id`, `job_title` FROM `jobs` WHERE `job_id`=$job_id")->row_array();
		}
		$data['company_id']=$company_id;
		$data['job_id']=$job_id;
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='candidate_status';

		if($search!='' && $active_inactive=='NA')
		{
			$WHere='';
			if($search!='' && $search!='NA'){
				$WHere="AND (CONCAT( fname,  ' ', lname ) LIKE '%$search%')";
			}
				$data['Arr_source']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='source/applied' $WHere")->result_array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='contacted' $WHere")->result_array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='interview' $WHere")->result_array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='hired' $WHere")->result_array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='rejected' $WHere")->result_array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
				echo(json_encode($data));
			
		}else if($active_inactive!='' && ($search=='NA' || $search=='')){

			if($active_inactive=='source/applied')
			{
				$data['Arr_source']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='source/applied'")->result_array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);	
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='contacted'){
				$data['Arr_contacted']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='contacted'")->result_array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='interview'){
				$data['Arr_interview']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='interview'")->result_array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='hired'){
				$data['Arr_hired']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='hired'")->result_array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='rejected'){
				$data['Arr_rejected']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id AND `status`='rejected'")->result_array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
			}
				echo(json_encode($data));
		}else if($search!='' && $active_inactive!=''){
			$WHere="AND (CONCAT( fname,  ' ', lname ) LIKE '%$search%') AND `status`='$active_inactive'";
			if($active_inactive=='source/applied')
			{
				$data['Arr_source']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id $WHere")->result_array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);	
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='contacted'){
				$data['Arr_contacted']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id $WHere")->result_array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='interview'){
				$data['Arr_interview']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id $WHere")->result_array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='hired'){
				$data['Arr_hired']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id $WHere")->result_array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_rejected']=array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			}else if($active_inactive=='rejected'){
				$data['Arr_rejected']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$s_company_id AND `job_id`=$s_job_id $WHere")->result_array();
				$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
				$data['Arr_source']=array();
				$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
				$data['Arr_contacted']=array();
				$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
				$data['Arr_interview']=array();
				$data['interview']=$this->load->view('admin/interview',$data,TRUE);
				$data['Arr_hired']=array();
				$data['hired']=$this->load->view('admin/hired',$data,TRUE);
			}
				echo(json_encode($data));
		}else{
			$data['Arr_source']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='source/applied'")->result_array();
			$data['source_applied']=$this->load->view('admin/source_applied',$data,TRUE);
			$data['Arr_contacted']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='contacted'")->result_array();
			$data['contacted']=$this->load->view('admin/contacted',$data,TRUE);
			$data['Arr_interview']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='interview'")->result_array();
			$data['interview']=$this->load->view('admin/interview',$data,TRUE);
			$data['Arr_hired']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='hired'")->result_array();
			$data['hired']=$this->load->view('admin/hired',$data,TRUE);
			$data['Arr_rejected']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='rejected'")->result_array();
			$data['rejected']=$this->load->view('admin/rejected',$data,TRUE);
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/candidate_status');
			$this->load->view('admin/footer');
		}
	}
	public function ajax_candidate_status()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$val=$this->input->post('val');
		$candidate_applied_id=$this->input->post('candidate_applied_id');
		$company_id=$this->input->post('company_id');
		$job_id=$this->input->post('job_id');
		$data['company_id']=$company_id;
		$data['job_id']=$job_id;
		if($val=='source_applied'){
			$value='source/applied';
		}else{
			$value=$val;
		}
		$Arr=array('status'=>$value,'updated_at'=>date("Y-m-d H:i:s"));
		$this->db->where('candidate_applied_id',$candidate_applied_id);
		$this->db->update('candidate_applied_jobs',$Arr);
		if($val=='source_applied'){
			$data['Arr_source']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='source/applied'")->result_array();
		}else if($val=='contacted'){
			$data['Arr_contacted']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='$val'")->result_array();
		}else if($val=='interview'){
			$data['Arr_interview']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='$val'")->result_array();
		}else if($val=='hired'){
			$data['Arr_hired']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='$val'")->result_array();
		}else if($val=='rejected'){
			$data['Arr_rejected']=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `user_photo_name`, `user_photo_path`, `work_experience`, `rating`, `status`, `created_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id AND `status`='$val'")->result_array();
		}
		if($val=='source_applied'){
			echo $this->load->view('admin/source_applied',$data,TRUE);
		}else if($val=='contacted'){
			echo $this->load->view('admin/contacted',$data,TRUE);
		}else if($val=='interview'){
			echo $this->load->view('admin/interview',$data,TRUE);
		}else if($val=='hired'){
			echo $this->load->view('admin/hired',$data,TRUE);
		}else if($val=='rejected'){
			echo $this->load->view('admin/rejected',$data,TRUE);
		}
	}
	public function export_candidate_application($type='',$company_id='',$job_id='')
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		if($type=="job_position"){
			$dt=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `alternative_phone_no`, `married_status`, `gender`, `dob`, `address`, `postcode`, `city`, `state`, `country`, `user_photo_name`, `user_photo_path`, `user_passport_name`, `user_passport_path`, `id_passport_no`, `user_resume_name`, `user_resume_path`, `ctc_from`, `ctc_to`, `excepted_ctc_from`, `excepted_ctc_to`, `work_experience`, `work_link_portfolio`, `notice_period`, `skills`, `rating`, `comments`, `status`, `is_active`, `created_at`, `updated_at` FROM `candidate_applied_jobs`")->result_array();
		}else{
			$dt=$this->db->query("SELECT `candidate_applied_id`, `company_id`, `job_id`, `fname`, `lname`, `email_id`, `phone_no`, `alternative_phone_no`, `married_status`, `gender`, `dob`, `address`, `postcode`, `city`, `state`, `country`, `user_photo_name`, `user_photo_path`, `user_passport_name`, `user_passport_path`, `id_passport_no`, `user_resume_name`, `user_resume_path`, `ctc_from`, `ctc_to`, `excepted_ctc_from`, `excepted_ctc_to`, `work_experience`, `work_link_portfolio`, `notice_period`, `skills`, `rating`, `comments`, `status`, `is_active`, `created_at`, `updated_at` FROM `candidate_applied_jobs` WHERE `company_id`=$company_id AND `job_id`=$job_id")->result_array();
		}
		$date =date('d-M-Y');
		if(!empty($dt)){
			$j2_id=$dt[0]['job_id'];
				if($j2_id!=''){
					$j_name=$this->db->query("SELECT `job_id`, `company_id`, `job_title` FROM `jobs` WHERE `job_id`=$j2_id")->row_array();
					$name = $j_name['job_title'].'_Candidate Profiles_'.$date;
				}
		}else{
			$name = 'Candidate Profiles_'.$date;
		}
		$name=$name.'.xls';
        header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: Attachment; filename=$name");
		$aa ="S.No\tCompany Name\tJob Title\tCandidate Name\tEmail Id\tPhone No\tGender\tDate Of Birth\tAddress\tPostcode\tCountry\tState/Province\tCity\tCurrent CTC\tExpected CTC\tSkills\tWork link/Portfolio\tNotice Period\tPassport No\tComments\n";
		$counter=1;
		foreach($dt as $k=>$val){
			$c_id=$val['company_id'];
			if($val['company_id']!=''){
				$company_name=$this->db->query("SELECT `company_id`, `company_name` FROM `companies` WHERE `company_id`=$c_id")->row_array();
			}else{
				$company_name='';
			}
			$j_id=$val['job_id'];
			if($val['job_id']!=''){
				$job_title=$this->db->query("SELECT `job_id`, `company_id`, `job_title` FROM `jobs` WHERE `job_id`=$j_id")->row_array();
			}else{
				$job_title='';
			}
			$aa.=$counter."\t".@$company_name['company_name']."\t".@$job_title['job_title']."\t".$val['fname'].' '.$val['lname']."\t".$val['email_id']."\t".$val['phone_no']."\t".$val['gender']."\t".$val['dob']."\t".$val['address']."\t".$val['postcode']."\t".$val['country']."\t".$val['state']."\t".$val['city']."\t".$val['ctc_from'].'-'.$val['ctc_to']."\t".$val['excepted_ctc_from'].'-'.$val['excepted_ctc_to']."\t".$val['skills']."\t".$val['work_link_portfolio']."\t".$val['notice_period']."\t".$val['id_passport_no']."\t".$val['comments']."\n";
             $counter++;
        }
        echo $aa;
	}
	public function candidate_application($company_id='',$job_id='')
	{
		// echo $j_id;
		// @checklogin_admin('Candidate Application');
		// $this->load->library('encryption');
		// $company_id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $c_id));
  //       $job_id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $j_id));
		$admin_id=$this->session->userdata('emp_id');
		$data['company_id']=$company_id;
		$data['job_id']=$job_id;
		$data['company']=$this->db->query("SELECT `company_id`, `company_name`, `is_active`, `created_at`, `updated_at` FROM `companies` WHERE `company_id`=$company_id")->row_array();
		$data['job']=$this->db->query("SELECT * FROM `jobs` WHERE `job_id`=$job_id")->row_array();
		$data['types']=$this->db->query("SELECT * FROM `types`")->result_array();
		$data['courses']=$this->db->query("SELECT * FROM `courses`")->result_array();
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['sn']=1;
		$data['work_exp_more']=$this->load->view('admin/add_workexp_more_fields',$data,TRUE);
		$data['edu_more']=$this->load->view('admin/add_edu_more_fields',$data,TRUE);
		// echo "<pre>";print_r($data['edu_more']);exit;
		$data['active_menu']='candidate_application';
		if($this->session->userdata('role_id')=='Admin'){
			$this->load->view('admin/menu',$data);
			$this->load->view('admin/candidate_application');
			$this->load->view('admin/footer');
		}else{
			$this->load->view('admin/candidate_application_link',$data);
		}
		
	}
	public function add_work_exp_fields()
	{
		$admin_id=$this->session->userdata('emp_id');
		$data['sn']=$this->input->post('sn')+1;
		echo $this->load->view('admin/add_workexp_more_fields',$data,TRUE);
	}
	public function add_edu_fields()
	{
		$admin_id=$this->session->userdata('emp_id');
		$data['sn']=$this->input->post('sn')+1;
		$data['types']=$this->db->query("SELECT * FROM `types`")->result_array();
		$data['courses']=$this->db->query("SELECT * FROM `courses`")->result_array();
		echo $this->load->view('admin/add_edu_more_fields',$data,TRUE);
	}
	public function check_type_course_existed()
	{
		$name=$this->input->post('name');
		$sn=$this->input->post('sn');
		$type=$this->input->post('type');
		if($type=='t'){
			$check=$this->db->get_where('types',array('name'=>$name))->num_rows();
			if($check==0){
				$data=array('name'=>$name,'is_active'=>1,'created_at'=>date("Y-m-d H:i:s"));
				$res=$this->db->insert('types',$data);
				$dataArr['getalltypes']=$this->db->query("SELECT * FROM `types`")->result_array();
				$dataArr['getalltypes']['sn']=$sn;
				$dataArr['getalltypes']['tc']=$type;
				$dataArr['getalltypes']['res']=1;
				echo json_encode($dataArr);
			}else{
				$dataArr['getalltypes']['sn']=$sn;
				$dataArr['getalltypes']['tc']=$type;
				$dataArr['getalltypes']['res']=0;
				echo json_encode($dataArr);
			}
		}else{
			$check=$this->db->get_where('courses',array('name'=>$name))->num_rows();
			if($check==0){
				$data=array('name'=>$name,'is_active'=>1,'created_at'=>date("Y-m-d H:i:s"));
				$res=$this->db->insert('courses',$data);
				$dataArr['getalltypes']=$this->db->query("SELECT * FROM `courses`")->result_array();
				$dataArr['getalltypes']['sn']=$sn;
				$dataArr['getalltypes']['tc']=$type;
				$dataArr['getalltypes']['res']=1;
				echo json_encode($dataArr);
			}else{
				$dataArr['getalltypes']['sn']=$sn;
				$dataArr['getalltypes']['tc']=$type;
				$dataArr['getalltypes']['res']=0;
				echo json_encode($dataArr);
			}
		}
		
	}
	public function save_candidate_application()
	{
		$admin_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$post['dob']=YY_MM_DD($post['dob']);
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'=> 'fname', 'label'=> 'First Name','rules'=> 'required'),
			array( 'field'=> 'lname', 'label'=> 'Last Name','rules'=> 'required'),
			array( 'field'=> 'email', 'label'=> 'Emial Id','rules'=> 'required'),
			array( 'field'=> 'phone_no', 'label'=> 'Contact Number','rules'=> 'required'),
			array( 'field'=> 'married_status', 'label'=> 'Married Status','rules'=> 'required'),
			array( 'field'=> 'gender', 'label'=> 'Gender','rules'=> 'required'),
			array( 'field'=> 'dob', 'label'=> 'Date Of Birth','rules'=> 'required'),
			array( 'field'=> 'address', 'label'=> 'Address','rules'=> 'required'),
			array( 'field'=> 'postcode', 'label'=> 'Postcode','rules'=> 'required'),
			array( 'field'=> 'skills', 'label'=> 'skills','rules'=> 'required'),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
	        {
	            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
	            redirect($_SERVER["HTTP_REFERER"]);
	        }else{
	        	$file='';
		        $imagepath='';
		        if($_FILES['photo']['name']!='')
		        {
		            $file=str_replace(" ","_",$_FILES['photo']['name']);
		            $imagepath=time().$file;
		            $this->load->library('upload');
		            $config['upload_path'] = 'assets/candidate_images';
		            $config['file_name'] = $imagepath;
		            $config['allowed_types'] = 'jpeg|jpg|png';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('photo'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload jpg,jpeg,png formates only</strong></div>');
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
		            $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload candidate image</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		        }

		        $pfile='';
		        $pimagepath='';
		        if($_FILES['passport']['name']!='')
		        {
		            $pfile=str_replace(" ","_",$_FILES['passport']['name']);
		            $pimagepath=time().$pfile;
		            $this->load->library('upload');
		            $config['upload_path'] = 'assets/candidate_passports';
		            $config['file_name'] = $pimagepath;
		            $config['allowed_types'] = 'jpeg|jpg|png';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('passport'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload pg,jpeg,png formates only</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		            }
		            else
		            {
		            	$pimagename=$pfile;
		                $pimagepath=$pimagepath;
		            }
		        }
		        else
		        {
		            $pimagename='NULL';
		            $pimagepath='NULL';
		        }

		        $rfile='';
		        $rimagepath='';
		        if($_FILES['resume']['name']!='')
		        {
		            $rfile=str_replace(" ","_",$_FILES['resume']['name']);
		            $rimagepath=time().$rfile;
		            $this->load->library('upload');
		            $config['upload_path'] = 'assets/candidate_resumes';
		            $config['file_name'] = $rimagepath;
		            $config['allowed_types'] = 'pdf|doc|docx';
		            $config['overwrite']=true;
		            $this->upload->initialize($config);
		            if(!$this->upload->do_upload('resume'))
		            {
		                $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload pdf,doc,docx formates only</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		            }
		            else
		            {
		            	$rimagename=$rfile;
		                $rimagepath=$rimagepath;
		            }
		        }
		        else
		        {
		            $this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Please upload candidate resume</strong></div>');
		                redirect($_SERVER['HTTP_REFERER']);
		        }
				$data = array('company_id'=>$post['company_id'],'job_id'=>$post['job_id'],'fname'=>$post['fname'],'lname'=>$post['lname'],'email_id'=>$post['email'],'phone_no'=>$post['phone_no'],'alternative_phone_no'=>$post['phone_no_2'],'married_status'=>$post['married_status'],'gender'=>$post['gender'],'dob'=>$post['dob'],'address'=>$post['address'],'postcode'=>$post['postcode'],'city'=>$post['city'],'state'=>$post['state'],'country'=>$post['country'],'user_photo_name'=>$file,'user_photo_path'=>$imagepath,'user_passport_name'=>$pfile,'user_passport_path'=>$pimagepath,'id_passport_no'=>$post['id_passport_no'],'user_resume_name'=>$rfile,'user_resume_path'=>$rimagepath,'ctc_from'=>$post['ctc_from'],'ctc_to'=>$post['ctc_to'],'excepted_ctc_from'=>$post['excepted_ctc_from'],'excepted_ctc_to'=>$post['excepted_ctc_to'],'work_experience'=>$post['work_exp'],'work_link_portfolio'=>$post['work_link_portfolio'],'notice_period'=>$post['notice_period'],'skills'=>$post['skills'],'status'=>'source/applied','is_active'=>1,'created_at'=>$created_date);
				$res=$this->db->insert('candidate_applied_jobs',$data);
				$insert_id = $this->db->insert_id();
				$post['last_insert_id']=$insert_id;
				foreach($post['company_name'] as $key => $cmp){
					$year=($post['work_duration_end'][$key])-($post['work_duration_start'][$key]);
					$Arr_work = array('candidate_applied_id'=>$insert_id,'company_name'=>$cmp,'designation'=>$post['designation'][$key],'work_duration_start'=>$post['work_duration_start'][$key],'work_duration_end'=>$post['work_duration_end'][$key],'years'=>$year,'remote_in_career_page'=>@$post['remote_in_carrer'],'is_active'=>1,'created_at'=>$created_date);
					$this->db->insert('candidate_work_expericence',$Arr_work);
				}
				foreach($post['type'] as $key => $edu){
					$Arr_edu = array('candidate_applied_id'=>$insert_id,'type_id'=>$edu,'course_id'=>$post['course'][$key],'specialisation'=>$post['specialisation'][$key],'institution_name'=>$post['institution_name'][$key],'edu_duration_start'=>$post['edu_duration_start'][$key],'edu_duration_end'=>$post['edu_duration_end'][$key],'is_active'=>1,'created_at'=>$created_date);
					$this->db->insert('candidate_education_details',$Arr_edu);
				}
				if($res==1 && $post['ctype']=='')
				{
					$this->admin_logs('NULL',$insert_id,'Save Candidate Application');
					if($res==1)
					{
						$this->session->set_flashdata('success','<div class="alert alert-danger msgfade"><strong>Candidate saved successfully</strong></div>');
					}else{
						$this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Candidate saved failed!</strong></div>');
					}
					redirect('admin/candidate_status/'.$post["company_id"].'/'.$post['job_id']);
				}else{
					if($res==1)
					{
						$this->session->set_flashdata('success','<div class="alert alert-danger msgfade"><strong>Application saved successfully</strong></div>');
					}else{
						$this->session->set_flashdata('failed','<div class="alert alert-danger msgfade"><strong>Application saved failed!</strong></div>');
					}
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
	}
	public function candidate_profile($candidate_applied_id='')
	{
		checklogin_admin('Job Positions');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['user_details']=$this->db->query("SELECT * FROM `candidate_applied_jobs` WHERE `candidate_applied_id`=$candidate_applied_id")->row_array();
		$data['work_exp']=$this->db->query("SELECT * FROM `candidate_work_expericence` WHERE `candidate_applied_id`=$candidate_applied_id")->result_array();
		$data['edu']=$this->db->query("SELECT * FROM `candidate_education_details` WHERE `candidate_applied_id`=$candidate_applied_id")->result_array();
		$data['types']=$this->db->query("SELECT * FROM `types`")->result_array();
		$data['course']=$this->db->query("SELECT * FROM `courses`")->result_array();
		$data['attachmeents']=$this->db->query("SELECT * FROM `candidate_attachmeents` WHERE `candidate_applied_id`=$candidate_applied_id")->result_array();
		$data['sn']=1;
		$data['work_exp_more']=$this->load->view('admin/add_workexp_more_fields',$data,TRUE);
		$data['edu_more']=$this->load->view('admin/add_edu_more_fields',$data,TRUE);
		$data['candidate_applied_id']=$candidate_applied_id;
		$data['active_menu']='candidate_profile';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/candidate-profile');
		$this->load->view('admin/footer');
	}
	public function change_candidate_status()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$val=$this->input->post('val');
		$candidate_applied_id=$this->input->post('candidate_applied_id');
		$type=$this->input->post('type');
		if($type==1){
			$value='source/applied';
		}else if($type==2){
			$value='contacted';
		}else if($type==3){
			$value='interview';
		}else {
			$value=$type;
		}
		$Arr=array('status'=>$value,'updated_at'=>date("Y-m-d H:i:s"));
		$this->db->where('candidate_applied_id',$candidate_applied_id);
		$res=$this->db->update('candidate_applied_jobs',$Arr);
		echo $res;
	}
	public function save_rating()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$val=$this->input->post('val');
		$candidate_applied_id=$this->input->post('candidate_applied_id');
		$Arr=array('rating'=>$val);
		$this->db->where('candidate_applied_id',$candidate_applied_id);
		$res=$this->db->update('candidate_applied_jobs',$Arr);
		$this->admin_logs('NULL',$candidate_applied_id,'Save Candidate Rating');
		echo $res;
	}
	public function save_comments()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$comments=$this->input->post('comments');
		$candidate_applied_id=$this->input->post('candidate_applied_id');
		$Arr=array('comments'=>$comments);
		$this->db->where('candidate_applied_id',$candidate_applied_id);
		$res=$this->db->update('candidate_applied_jobs',$Arr);
		$this->admin_logs('NULL',$candidate_applied_id,'Save Comments');
		echo $res;
	}
	public function save_passport_id()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$id_passport_no=$this->input->post('id_passport_no');
		$candidate_applied_id=$this->input->post('candidate_applied_id');
		$Arr=array('id_passport_no'=>$id_passport_no);
		$this->db->where('candidate_applied_id',$candidate_applied_id);
		$res=$this->db->update('candidate_applied_jobs',$Arr);
		$this->admin_logs('NULL',$candidate_applied_id,'Save Comments');
		echo $res;
	}
	public function update_candidate_profile()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$post['dob']=YY_MM_DD($post['dob']);
		if($post['work_exp']=='on'){
			$work_exp='checked';
		}else{
			$work_exp='unchecked';
		}
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'=> 'candidate_applied_id', 'label'=> 'candidate id','rules'=> 'required'),
			array( 'field'=> 'fname', 'label'=> 'First Name','rules'=> 'required'),
			array( 'field'=> 'lname', 'label'=> 'Last Name','rules'=> 'required'),
			array( 'field'=> 'email', 'label'=> 'Emial Id','rules'=> 'required'),
			array( 'field'=> 'phone_no', 'label'=> 'Contact Number','rules'=> 'required'),
			array( 'field'=> 'married_status', 'label'=> 'Married Status','rules'=> 'required'),
			array( 'field'=> 'gender', 'label'=> 'Gender','rules'=> 'required'),
			array( 'field'=> 'dob', 'label'=> 'Date Of Birth','rules'=> 'required'),
			array( 'field'=> 'address', 'label'=> 'Address','rules'=> 'required'),
			array( 'field'=> 'postcode', 'label'=> 'Postcode','rules'=> 'required'),
			array( 'field'=> 'notice_period', 'label'=> 'Notice Period','rules'=> 'required'),
			array( 'field'=> 'skills', 'label'=> 'skills','rules'=> 'required'),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
	        {
	            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
	            redirect($_SERVER["HTTP_REFERER"]);
	        }else{
				$data = array('fname'=>$post['fname'],'lname'=>$post['lname'],'email_id'=>$post['email'],'phone_no'=>$post['phone_no'],'alternative_phone_no'=>@$post['phone_no_2'],'married_status'=>$post['married_status'],'gender'=>$post['gender'],'dob'=>$post['dob'],'address'=>$post['address'],'postcode'=>$post['postcode'],'city'=>$post['city'],'state'=>$post['state'],'country'=>$post['country'],'ctc_from'=>$post['ctc_from'],'ctc_to'=>$post['ctc_to'],'excepted_ctc_from'=>$post['excepted_ctc_from'],'excepted_ctc_to'=>$post['excepted_ctc_to'],'work_experience'=>$work_exp,'skills'=>$post['skills'],'work_link_portfolio'=>$post['work_link_portfolio'],'notice_period'=>$post['notice_period'],'updated_at'=>$created_date);
				$this->db->where('candidate_applied_id',$post['candidate_applied_id']);
				$res=$this->db->update('candidate_applied_jobs',$data);
				foreach($post['job_work_expericence_id'] as $key => $work){
					$year=($post['work_duration_end'][$key])-($post['work_duration_start'][$key]);
					$Arr_work = array('company_name'=>$post['company_name'][$key],'designation'=>$post['designation'][$key],'work_duration_start'=>$post['work_duration_start'][$key],'work_duration_end'=>$post['work_duration_end'][$key],'years'=>$year,'remote_in_career_page'=>@$post['remote_in_carrer'],'updated_at'=>$created_date);
					$this->db->where('job_work_expericence_id',$work);
					$this->db->update('candidate_work_expericence',$Arr_work);
				}
				foreach($post['candidate_education_id'] as $key => $edu){
					$Arr_edu = array('type_id'=>$post['type'][$key],'course_id'=>$post['course'][$key],'specialisation'=>$post['specialisation'][$key],'institution_name'=>$post['institution_name'][$key],'edu_duration_start'=>$post['edu_duration_start'][$key],'edu_duration_end'=>$post['edu_duration_end'][$key],'updated_at'=>$created_date);
					$this->db->where('candidate_education_id',$edu);
					$this->db->update('candidate_education_details',$Arr_edu);
				}
				$this->admin_logs('NULL',$insert_id,'Update Candidate Profile');
				if($res==1){
					$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Candidate profile updated successfully...</strong></div>');
				}else{
					$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Candidate profile update failed!...</strong></div>');
				}
				redirect('admin/candidate_profile/'.$post["candidate_applied_id"]);
			}
	}
	public function candidate_attachmeents()
	{
		checklogin_admin();
		$admin_id=$this->session->userdata('emp_id');
		$post = $this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field' => 'candidate_applied_id', 'label' => 'candidate','rules' => 'required'),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
		    redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
				$images = array();
				if(isset($_FILES['file']['name'][0]) && !empty($_FILES['file']['name'][0])){
		        foreach ($_FILES['file']['name'] as $key => $image)
		        {
			            $_FILES['images']['name']= $_FILES['file']['name'][$key];
			            $_FILES['images']['type']= $_FILES['file']['type'][$key];
			            $_FILES['images']['tmp_name']= $_FILES['file']['tmp_name'][$key];
			            $_FILES['images']['error']= $_FILES['file']['error'][$key];
			            $_FILES['images']['size']= $_FILES['file']['size'][$key];
			            $fileName = $image;
			            $filePath = time().str_replace(" ","_",$image);
			            $images[] = str_replace(" ","_",$fileName);
			            $images[] = $filePath;
			            $config['upload_path'] = 'assets/candidate_attachmeents';
			            $config['file_name'] = $filePath;
			            $config['allowed_types'] = 'jpeg|jpg|png|pdf';
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
			            		$ArrImgInsert =array('candidate_applied_id'=>$post['candidate_applied_id'],'candidate_attachmeent_name'=>$fileName,'candidate_attachmeent_path'=>$filePath,'is_active'=>1,'created_at'=>$created_date);
			                	$this->db->insert('candidate_attachmeents',$ArrImgInsert);
			                	$insert_id = $this->db->insert_id();
			                	$this->admin_logs('NULL',$insert_id,'Save Candidate Attachmeents');
			                	$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Attachmeents saved successfully</strong></div>');
			                	redirect($_SERVER['HTTP_REFERER']);
			            	}
			                
			            }
        		}
        	  }
    	}
    }
    public function pay_schedule()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='pay_schedule';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/pay_schedule');
		$this->load->view('admin/footer');
	}
	public function payruns()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='payruns';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payruns');
		$this->load->view('admin/footer');
	}
	public function payroll_employee_list()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='payroll_employee_list';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payroll_employee_list');
		$this->load->view('admin/footer');
	}
	public function payroll_summary()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='payroll_summary';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/payroll_summary');
		$this->load->view('admin/footer');
	}
	public function earnings_deductions()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='earnings_deductions';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/earnings_deductions');
		$this->load->view('admin/footer');
	}
	public function earnings_deductions_template()
	{
		checklogin_admin('Roles Access');
		$admin_id=$this->session->userdata('emp_id');
		$data['roles']=$this->db->query("SELECT `roles_id`, `role_name`, `is_active`, `created_at`, `updated_at` FROM `roles`")->result_array();
		$data['active_menu']='earnings_deductions_template';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/earnings_deductions_template');
		$this->load->view('admin/footer');
	}
	public function notifications()
	{
		checklogin_admin('Notifications');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Notifications');
		$data['active_menu']='notifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/notifications');
		$this->load->view('admin/footer');
	}
	public function get_notifications_list()
	{
	    checklogin_admin('Notifications');
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->get_notifications_list(1,$start,$length,$search['value'],$column,$dir);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->get_notifications_list(2,$start,$length,$search['value'],$column,$dir);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					$NewArr[]=$res['title'];
					$NewArr[]=DD_M_YY($res['created_at']);
					$NewArr[]=@$res['message'];
					$NewArr[]='<a href="'.base_url().'admin/view_notifications_list/'.$res['notification_id'].'" class="btn btn-info waves-effect waves-light"><i class="fa fa-eye" style="color: #fff !important;"></i> View </a>';
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
	public function add_notifications()
	{
		checklogin_admin('Notifications');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Add Notifications');
		$data['employees']=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `is_active` FROM `employees` WHERE `is_active`=1")->result_array();
		$data['active_menu']='notifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/add_notifications');
		$this->load->view('admin/footer');
	}
	public function save_notifications()
	{
		checklogin_admin('Notifications');
		$admin_id=$this->session->userdata('emp_id');
		$post=$this->input->post();
		$created_date =date("Y-m-d H:i:s");
		$config = array( 
			array( 'field'=> 'title', 'label'=> 'Title','rules'=> 'required'),
			array( 'field'=> 'applicable_to_all', 'label'=> 'Employees','rules'=> 'required'),
			array( 'field'=> 'message', 'label'=> 'Message','rules'=> 'required'),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
	        {
	            $this->session->set_flashdata('msg','<div class="alert alert-danger msgfade"><strong>'.validation_errors().'</strong></div>');
	            redirect('admin/notifications');
	        }else{
				$data = array('title'=>$post['title'],'message'=>$post['message'],'applicable_to_all'=>$post['applicable_to_all'],'is_active'=>1,'created_at'=>$created_date);
				$this->db->insert('notifications',$data);
				$insert_id = $this->db->insert_id();
				if($post['applicable_to_all']=='Yes')
				{
					$getEmps=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `is_active` FROM `employees` WHERE `is_active`=1")->result_array();
					foreach ($getEmps as $emp) {
						$Arr_emp = array('notification_id'=>$insert_id,'employee_id'=>$emp['emp_id'],'read_yes_no'=>'No','created_at'=>$created_date);
						$res=$this->db->insert('notification_employees',$Arr_emp);
					}
				}else{
					$getEmps=$post['employees'];
					foreach ($getEmps as $emp) {
						$Arr_emp = array('notification_id'=>$insert_id,'employee_id'=>$emp,'read_yes_no'=>'No','created_at'=>$created_date);
						$res=$this->db->insert('notification_employees',$Arr_emp);
					}
				}
				$this->admin_logs('NULL',$insert_id,'Save Notifications');
				if($res==1){
					$this->session->set_flashdata('success','<div class="alert alert-success msgfade"><strong>Notifications Saved Successfully...</strong></div>');
				}else{
					$this->session->set_flashdata('failed','<div class="alert alert-warning msgfade"><strong>Notifications Saved failed!...</strong></div>');
				}
				redirect('admin/notifications/');
			}
	}
	public function view_notifications_list($notification_id='')
	{
		checklogin_admin('Notifications');
		$admin_id=$this->session->userdata('emp_id');
		$data['GetRolesAccess']=$this->read_write('Notifications');
		$data['notification_id']=$notification_id;
		$data['active_menu']='notifications';
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/view_notifications_list');
		$this->load->view('admin/footer');
	}
	public function get_view_notifications_list()
	{
	    checklogin_admin('Notifications');
	    $notification_id=$this->input->get('notification_id');
		$start=$this->input->get('start')?intval( $this->input->get('start') ) :0;
		$length=$this->input->get('length')?intval( $this->input->get('length') ) :0;
		$search=$this->input->get('search')?$this->input->get('search'):array('value'=>'');
		$order=$this->input->get('order')?$this->input->get('order') :array(array('column'=>'','dir'=>'DESC'));
		$column=$order[0]['column'];
		$dir=$order[0]['dir'];
		$records=array();
		$returndata=array();
		$totalcount=$this->loginmodel->get_view_notifications_list(1,$start,$length,$search['value'],$column,$dir,$notification_id);
		$returndata['recordsTotal']=0;
		$returndata['recordsFiltered']=0;
		$returndata['recordsTotal']+=$totalcount;
		if($search['value']!=''){
			$returndata['recordsFiltered']+=$totalcount;
		}else{
			$returndata['recordsFiltered']=$returndata['recordsTotal'];
		}
		$stu['output'] = $this->loginmodel->get_view_notifications_list(2,$start,$length,$search['value'],$column,$dir,$notification_id);
		$stu['returndata']=$returndata;
		if(is_array($stu['output']) && count($stu['output'])>0){
				foreach($stu['output'] as $k=>$res){
					$NewArr=array();
					$NewArr[]=$k+1;
					if($notification_id!=''){
						$title=$this->db->query("SELECT * FROM `notifications` WHERE `notification_id`=$notification_id")->row_array();
					}else{
						$title['title']='';
					}
					$NewArr[]=@$title['title'];
					$NewArr[]=$res['fname'].' '.$res['lname'].' ('.$res['emp_code'].')';
					$NewArr[]=@$res['read_yes_no'];
					$returndata['data'][]=$NewArr;
				}
		}else{
			$returndata['data']=array();
		}
		echo json_encode($returndata);exit;
	}
}