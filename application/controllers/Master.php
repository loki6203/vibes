<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index($id=''){
	    $data['approve_reject']=$id;
		$this->load->view('login_view',$data);
	}
	public function check_login()
	{ 
	    $approve_reject = $this->input->post('approve_reject');
		if($this->input->post('username') !=''){
	   		$res=$this->loginmodel->check_login(trim($this->input->post('username')),md5(trim($this->input->post('password'))));
	   		$role_id=@$res['role_id'];
	   		if($role_id!=''){
	   			$GetLeaveAccess=$this->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `sub_menu_url`, `sub_menu_icon`, `access`, `read`, `write` FROM `role_access` WHERE `write`=1 AND `role_id`='$role_id' AND `sub_menu_name`='Leaves'")->num_rows();
	   		}else{
	   			$GetLeaveAccess=0;
	   		}
	   		if(!empty($res) && $GetLeaveAccess!=0 && $approve_reject!=''){
                $this->login_attempt($uname,1);
				redirect('admin/view_employee_leaves_list/'.$approve_reject);
			}else if(!empty($res) && $GetLeaveAccess==0 && $approve_reject!=''){
                $this->login_attempt(@$uname,1);
                $Button='<a href="'.base_url().'"><button class="btn btn-ss w-md waves-effect waves-light" style="color: #fff !important;background-color: #228fc6 !important;border-color: #1372a2 !important;">Back to Home</button></a>';
				echo "You don't have permission to access leaves please contact to admin. ".$Button;
			}else if(!empty($res) && $res['is_chk_login']==1 && $res['role_id']=='Admin'){
			    $this->login_attempt($uname,1);
			    redirect('admin/dashboard');
			}else if(!empty($res) && $res['is_chk_login']==1 && $res['role_id']==''){
			    $this->login_attempt($uname,1);
			    redirect('employee/dashboard');
			}else if(!empty($res) && $res['is_chk_login']==0 && $res['role_id']==''){
			    $this->login_attempt($uname,1);
			    redirect('employee/first_change_password');
			}else if(!empty($res) && $res['is_chk_login']==1 && $res['role_id']=='Employee'){
			    $this->login_attempt($uname,1);
			    redirect('employee/dashboard');
			}else if(!empty($res) && $res['is_chk_login']==0 && $res['role_id']=='Employee'){
			    $this->login_attempt($uname,1);
			    redirect('employee/first_change_password');
			}else if(!empty($res) && $res['is_chk_login']==1 && $res['role_id']!='Admin'){
			    $this->login_attempt($uname,1);
			    redirect('master/dashboard');
			}else if(!empty($res) && $res['is_chk_login']==0 && $res['role_id']!='Admin'){
			    $this->login_attempt($uname,1);
			    redirect('master/dashboard');
			}else{
			    $this->login_attempt($uname,0);
				$this->session->set_flashdata('msg',"Your username or password is incorrect...");
				redirect('master');
			}
		}else{
		    $this->login_attempt($uname,0);
			$this->session->set_flashdata('msg',"Your username or password is incorrect");
			redirect('master');
		}
	}
	public function login_attempt($uname='',$stu='')
	{
		$emp_id=$this->session->userdata('emp_id');
		$ip = $this->input->ip_address();
		$date =date("Y-m-d H:i:s");
		$ArrData=array('username'=>$uname,'emp_id'=>$emp_id,'ip_address'=>$ip,'login_dt'=>$date,'created_at'=>$date,'successful'=>$stu);
		$this->db->insert('login_history',$ArrData);
	}
	public function dashboard(){
		if($this->session->userdata('emp_id')!=''){
			$this->load->view('dashboard');
		}else{
			redirect(base_url());
		}
	}
	public function reset_password(){
		$this->load->view('reset_password');
	}
	public function forgot_password()
	{
        $name=trim($this->input->post('name'));
		$length = 10;
		$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
		$password = '';
		$max = strlen($chars) - 1;
		for ($i=0; $i < $length; $i++)
		$password .= $chars[random_int(0, $max)];
		$chk=$this->db->query("SELECT * FROM `admin_login` as `t1` WHERE (`email` = '$name' OR `username` = '$name')")->num_rows();
		if(($chk)>0)
		{
    		$forgot_pwd=$this->db->query("SELECT * FROM `admin_login` as `t1` WHERE (`t1`.`email` = '$name' OR `t1`.`username` = '$name')")->row_array();
        		$emp_id = $forgot_pwd['emp_id'];
        		$GetEmpDetails=$this->db->query("SELECT `emp_id`, `fname`, `lname`, `email_id`, `emp_code`, `lead_manager_id` FROM `employees` WHERE `emp_id`=$emp_id")->row_array();
    			$to_email = $forgot_pwd['email'];
    			$data['to_email'] = $forgot_pwd['email'];
    			$pwd = $this->generate_password();
    			$data['username']=$GetEmpDetails['emp_code'];
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
    				$Arrpwd=array('pwd'=>md5($pwd));
    				$this->db->where('emp_id',$emp_id);
    				$this->db->update('admin_login',$Arrpwd);
    				$this->session->set_flashdata('smsg','Password sent to your email id successfully...');
                   	  redirect('master/reset_password_success');
    			}else{
    				$Arrpwd=array('pwd'=>md5($pwd));
    				$this->db->where('emp_id',$emp_id);
    				$this->db->update('admin_login',$Arrpwd);
    				$this->session->set_flashdata('msg','Opps! something went to wrong');
                    redirect('master/reset_password');
    			}
            }else{
                $this->session->set_flashdata('msg','Entered wrong email id...');
                redirect('master/reset_password');
            }		
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
    public function reset_password_success()
    {
		$this->load->view('reset_password_success');
	}
 }