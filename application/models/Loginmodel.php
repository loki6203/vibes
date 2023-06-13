<?php
ob_start();
class Loginmodel extends CI_Model{
	public function check_login($uname, $password){
			$this->db->select('*');
			$this->db->from('admin_login');
			$this->db->where('username',$uname);
			$this->db->where('pwd',$password);
			$this->db->where('is_active','1');
			$q=$this->db->get();
			if($q->num_rows()==1){
						$this->session->set_userdata('id',$q->row()->id);
						$this->session->set_userdata('emp_id',$q->row()->emp_id);
						$this->session->set_userdata('username',$q->row()->username);
						$this->session->set_userdata('email',$q->row()->email);
						$this->session->set_userdata('role_id',$q->row()->role_id);
				return $q->row_array();
			}else{
				return 0;
			}

	} 
	public function search_employee_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`email_id`, t1.`phone_no_code`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`comments`, t1.`termination_date`, t1.`is_active`, t1.`role_id`, t1.`created_at`, t1.`updated_at`, t1.`is_inactive_date`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name`");
		$this->db->from("employees as t1");
		$this->db->join('designation as t2', 't1.designation_id = t2.designation_id', 'left');
		$this->db->join('clients as t3', 't1.client_id = t3.client_id', 'left');
		$this->db->where("t1.is_active",1);
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%' OR t1.email_id like '%$search%' OR t1.identification_number like '%$search%'");
		    $this->db->where("t1.is_active",1);
		    
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`email_id`, t1.`phone_no_code`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`comments`, t1.`termination_date`, t1.`is_active`, t1.`role_id`, t1.`created_at`, t1.`updated_at`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` LEFT JOIN `clients` as `t3` ON `t1`.`client_id` = `t3`.`client_id` WHERE t1.`is_active`=1 AND `t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%' OR `t1`.email_id like '%$search%' OR `t1`.identification_number like '%$search%' GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_inactive_employee_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`email_id`, t1.`phone_no_code`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`comments`, t1.`termination_date`, t1.`is_active`, t1.`role_id`, t1.`created_at`, t1.`updated_at`, t1.`is_inactive_date`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name`");
		$this->db->from("employees as t1");
		$this->db->join('designation as t2', 't1.designation_id = t2.designation_id', 'left');
		$this->db->join('clients as t3', 't1.client_id = t3.client_id', 'left');
		$this->db->where("t1.is_active",0);
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%' OR t1.email_id like '%$search%' OR t1.identification_number like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`gender`, t1.`dob`, t1.`emp_code`, t1.`designation_id`, t1.`email_id`, t1.`phone_no_code`, t1.`phone_no`, t1.`date_of_joining`, t1.`local_contact_name`, t1.`local_contact_relationship`, t1.`local_contact_ph`, t1.`overseas_contact_name`, t1.`overseas_contact_relationship`, t1.`overseas_contact_ph`, t1.`bank_name`, t1.`account_number`, t1.`account_type`,t1.`branch_name`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`client_manager`, t1.`client_id`,t1.`identification_type_id`, t1.`identification_number`, t1.`identification_image_name`,t1.`identification_image_path`, t1.`comments`, t1.`termination_date`, t1.`is_active`, t1.`role_id`, t1.`created_at`, t1.`updated_at`, t2.`designation_id` as desg_id,t2.`designation_name`, t3.`client_id`, t3.`client_name` FROM `employees` as `t1` LEFT JOIN `designation` as `t2` ON `t1`.`designation_id` = `t2`.`designation_id` LEFT JOIN `clients` as `t3` ON `t1`.`client_id` = `t3`.`client_id` WHERE t1.`is_active`=0 AND `t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%' OR `t1`.email_id like '%$search%' OR `t1`.identification_number like '%$search%' GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function check_employee_email($email_id, $trid)
    {
        if ($trid == 1) {
            $res = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id` FROM `employees` WHERE `email_id`='$email_id'");
        } else {
            $res = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id` FROM `employees` WHERE `email_id`='$email_id' and `emp_id`!=$trid");
        }
        $result = $res->num_rows();
        return $result;
    }
    public function check_employee_emp_code($empcode, $trid)
    {
        if ($trid == 1) {
            $res = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`
, `emp_code`, `designation_id`, `email_id` FROM `employees` WHERE `emp_code`='$empcode'");
        } else {
            $res = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id` FROM `employees` WHERE `emp_code`='$empcode' and `emp_id`!=$trid");
        }
        $result = $res->num_rows();
        return $result;
    }
    public function search_employee_performance_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`emp_performance_id`, t1.`emp_id`, t1.`appraisal_date`, t1.`appraisal_rating`, t1.`existing_role`, t1.`new_role`, t1.`existing_salary`, t1.`new_salary`, t1.`percentage_hike`, t1.`hr_feedback_comments`, t1.`employee_feedback_comments`, t1.`relationship_manager_comments`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`emp_id`, t2.`fname`, t2.`lname`,t2.`emp_code`");
		$this->db->from("employee_annual_performance as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->select_max('appraisal_date');
		$this->db->group_by("t1.emp_id","Desc");
		// $this->db->limit(1);
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t1.percentage_hike like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_performance_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_performance_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_performance_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`emp_performance_id`, t1.`emp_id`, t1.`appraisal_date`, t1.`appraisal_rating`, t1.`existing_role`, t1.`new_role`, t1.`existing_salary`, t1.`new_salary`, t1.`percentage_hike`, t1.`hr_feedback_comments`, t1.`employee_feedback_comments`, t1.`relationship_manager_comments`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`emp_id`, t2.`fname`, t2.`lname`,t2.`emp_code` FROM `employee_annual_performance` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t1`.percentage_hike like '%$search%' GROUP BY t1.`emp_performance_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_other_docuemnt_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->from("other_documents as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t1.doc_title like '%$search%' OR t1.document_name like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.document_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.document_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.document_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `other_documents` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t1`.doc_title like '%$search%' OR `t1`.document_name like '%$search%' GROUP BY t1.`document_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_payroll_Details($type,$start,$length,$search,$column,$order,$GMnth,$GYear){
		$this->db->select("t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`created_at`");
		$this->db->from("employees as t1");
		$this->db->join('payroll as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->order_by("t1.emp_id", "ASC");
		$this->db->where("t2.month",$GMnth);
		$this->db->where("t2.year",$GYear);
		if($GMnth==''){
			$this->db->where('t1.emp_id',0);
		}
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
			    if($GMnth!='' && $GYear!=''){
				    $resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%') AND t2.`month`=$GMnth AND t2.`year`=$GYear GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
			    }else{
			        $resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%') AND t2.`month`=13 AND t2.`year`=5555 GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
			    }
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_finance_payroll_Details($type,$start,$length,$search,$column,$order,$Mnth,$Year){
		$this->db->select("t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`created_at`,t2.`submit_finance`");
		$this->db->from("employees as t1");
		$this->db->join('payroll as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->order_by("t1.emp_id", "ASC");
		$this->db->where('t2.submit_finance',1);
		$this->db->group_by('t1.emp_id');
		if($Mnth==''){
			$this->db->where('t1.emp_id',0);
		}
		if($Mnth!=''){
			$this->db->where('t2.month',$Mnth);
// 			$this->db->or_where("t2.month IS NULL");
		}
		if($Year!=''){
			$this->db->where('t2.year',$Year);
// 			$this->db->or_where("t2.year IS NULL");
		}
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				if($Mnth!='' && $Year!=''){
				    $resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%' AND t2.`submit_finance`=1 AND t2.`month`=$Mnth AND t2.`year`=$Year GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
				}else{
				  $resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%') AND t2.`submit_finance`=1 AND t2.`month`=13 AND t2.`year`=5555 GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
				}
				return $resp; 
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_report_Details($type,$start,$length,$search,$column,$order,$Mnth,$Year,$emp_id){
		$this->db->select("t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`created_at`,t2.`submit_finance`");
		$this->db->from("employees as t1");
		$this->db->join('payroll as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->order_by("t2.emp_id", "ASC");
		$this->db->where('t2.emp_id!=','');
		$this->db->where('t2.submit_finance',1);
		if($Mnth!='' && $Year!='' && $emp_id!=''){
			$this->db->where('t2.month',$Mnth);
			$this->db->where('t2.year',$Year);
			$this->db->where('t2.emp_id',$emp_id);
		}else if($Mnth!=''){
			$this->db->where('t2.month',$Mnth);
		}else if($Year!=''){
			$this->db->where('t2.year',$Year);
		}else if($emp_id!=''){
			$this->db->where('t2.emp_id',$emp_id);
		}
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
			    if($Mnth!='' && $Year!=''){
			       $WHere_Mnth='AND t2.`month`=$Mnth AND t2.`year`=$Year'; 
			       $resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%') AND t2.`month`=$Mnth AND t2.`year`=$Year AND t2.`submit_finance`=1 ORDER BY t1.`emp_id` ASC LIMIT 10")->result_array();
			    }else{
			     	$resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t2.`payroll_id`, t2.`emp_id`, t2.`month`, t2.`year`, t2.`monthly_salary`, t2.`allowance`, t2.`rent`, t2.`claim_amt`, t2.`gross_salary`, t2.`comments`,t2.`submit_finance` FROM `employees` as `t1` LEFT JOIN `payroll` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%') AND t2.`submit_finance`=1 ORDER BY t1.`emp_id` ASC LIMIT 10")->result_array();
			    }
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_asset_Details_BK($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`asset_id`, t1.`emp_id`, t1.`laptop_serial_no`, t1.`laptop_model`, t1.`battery_provided`, t1.`mouse_provided_no`, t1.`charger_provided`, t1.`charger_provided_no`, t1.`mouse_provided`, t1.`mouse_serial_number`, t1.`power_supply_provided`, t1.`power_supply_provided_name`, t1.`power_supply_model_no`, t1.`ups_provided`, t1.`ups_provided_no`, t1.`carrycase_provided`, t1.`carrycase_provided_no`, t1.`total_asset_amt`, t1.`is_active`,t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->from("asset as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t2.email_id like '%$search%' OR t1.laptop_serial_no like '%$search%' OR t1.laptop_model like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.asset_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.asset_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.asset_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`asset_id`, t1.`emp_id`, t1.`laptop_serial_no`, t1.`laptop_model`, t1.`battery_provided`, t1.`mouse_provided_no`, t1.`charger_provided`, t1.`charger_provided_no`, t1.`mouse_provided`, t1.`mouse_serial_number`, t1.`power_supply_provided`, t1.`power_supply_provided_name`, t1.`power_supply_model_no`, t1.`ups_provided`, t1.`ups_provided_no`, t1.`carrycase_provided`, t1.`carrycase_provided_no`, t1.`total_asset_amt`, t1.`is_active`,t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `asset` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t2`.email_id like '%$search%' OR `t1`.laptop_serial_no like '%$search%' OR `t1`.laptop_model like '%$search%' GROUP BY t1.`asset_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_leaves_Details($type,$start,$length,$search,$column,$order){
		$admin_id=$this->session->userdata('emp_id');
		$this->db->select("t1.`leave_id`, t1.`emp_id`, t1.`period_from`, t1.`period_to`, t1.`annual_leaves_count`, t1.`sick_leaves_count`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`is_active`, t1.`is_delete`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id`");
		$this->db->from("leaves as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->where('t1.is_delete!=',0);
		if($admin_id!=''){
			$this->db->where('t1.hr_manager_id',$admin_id);
			$this->db->or_where('t1.lead_manager_id',$admin_id);
			$this->db->where('t1.emp_id!=',$admin_id);
		}
		if($search!=''){
			$this->db->where("(t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t2.email_id like '%$search%' OR t1.period_from like '%$search%' OR t1.period_to like '%$search%')");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.leave_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.leave_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.leave_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
			    if($admin_id!=''){
					$WHEre="(t1.hr_manager_id=$admin_id OR t1.lead_manager_id=$admin_id AND t1.`emp_id`!=$admin_id)";
					$resp = $this->db->query("SELECT t1.`leave_id`, t1.`emp_id`, t1.`period_from`, t1.`period_to`, t1.`annual_leaves_count`, t1.`sick_leaves_count`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`is_active`, t1.`is_delete`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id` FROM `leaves` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t2`.email_id like '%$search%' OR `t1`.period_from like '%$search%' OR `t1`.period_to like '%$search%') AND $WHEre AND t1.`is_delete`!=0 GROUP BY t1.`leave_id` ASC LIMIT 10")->result_array();
			    }else{
			       $resp = $this->db->query("SELECT t1.`leave_id`, t1.`emp_id`, t1.`period_from`, t1.`period_to`, t1.`annual_leaves_count`, t1.`sick_leaves_count`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`is_active`, t1.`is_delete`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id` FROM `leaves` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t2`.email_id like '%$search%' OR `t1`.period_from like '%$search%' OR `t1`.period_to like '%$search%') AND t1.`is_delete`!=0 GROUP BY t1.`leave_id` ASC LIMIT 10")->result_array();
			    }
			    return $resp; 	
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_leaves_history_Details($type,$start,$length,$search,$column,$order){
	    $admin_id=$this->session->userdata('emp_id');
		$this->db->select("t1.`leave_id`, t1.`emp_id`, t1.`period_from`, t1.`period_to`, t1.`annual_leaves_count`, t1.`sick_leaves_count`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`is_active`, t1.`is_delete`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id`");
		$this->db->from("leaves as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->where('t1.is_delete',0);
		if($admin_id!=''){
			$this->db->where("(t1.hr_manager_id=$admin_id OR t1.lead_manager_id=$admin_id) AND t1.`emp_id`!=$admin_id");
		}
		if($search!=''){
			$this->db->where("(t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t2.email_id like '%$search%' OR t1.period_from like '%$search%' OR t1.period_to like '%$search%')");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.leave_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.leave_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.leave_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
			    $WHEre='';
			    if($admin_id!=''){
					$WHEre="(t1.hr_manager_id=$admin_id OR t1.lead_manager_id=$admin_id) AND t1.`emp_id`!=$admin_id";
					$resp = $this->db->query("SELECT t1.`leave_id`, t1.`emp_id`, t1.`period_from`, t1.`period_to`, t1.`annual_leaves_count`, t1.`sick_leaves_count`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`is_active`, t1.is_delete, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id` FROM `leaves` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t2`.email_id like '%$search%' OR `t1`.period_from like '%$search%' OR `t1`.period_to like '%$search%') AND t1.`is_delete`=0 AND ($WHEre) GROUP BY t1.`leave_id` ASC LIMIT 10")->result_array();
				}else{
				   $resp = $this->db->query("SELECT t1.`leave_id`, t1.`emp_id`, t1.`period_from`, t1.`period_to`, t1.`annual_leaves_count`, t1.`sick_leaves_count`, t1.`reporting_manager_id`, t1.`hr_manager_id`, t1.`lead_manager_id`, t1.`is_active`, t1.is_delete, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id` FROM `leaves` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE (`t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t2`.email_id like '%$search%' OR `t1`.period_from like '%$search%' OR `t1`.period_to like '%$search%') AND t1.`is_delete`=0 GROUP BY t1.`leave_id` ASC LIMIT 10")->result_array();
				}
				return $resp; 
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_employee_docuemnt_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`employee_document_id`, t1.`emp_id`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->from("employee_documents as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->group_by("t1.emp_id");
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.employee_document_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.employee_document_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.employee_document_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`employee_document_id`, t1.`emp_id`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `employee_documents` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_payslip_Details($type,$start,$length,$search,$column,$order,$Mnth){
		$this->db->select("t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`is_active`, t2.`payslip_id`, t2.`month`, t2.`year`, t2.`emp_id`, t2.`payslip_file_name`, t2.`payslip_file_path`");
		$this->db->from("employees as t1");
		$this->db->join('payslips as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->where("t1.is_active",1);
		$this->db->where("t2.month",$Mnth);
		$this->db->or_where("t2.month IS NULL");
		$this->db->order_by("t1.emp_id", "ASC");
		if($Mnth==''){
			$this->db->where('t1.emp_id',0);
		}
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`emp_id` as e_id, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`is_active`, t2.`payslip_id`, t2.`month`, t2.`year`, t2.`emp_id`, t2.`payslip_file_name`, t2.`payslip_file_path` FROM `employees` as `t1` LEFT JOIN `payslips` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE `t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%' OR t2.`month`=$Mnth AND t2.`month` IS NULL AND t1.`is_active`=1 GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_recruitment_Details($type,$start,$length,$search,$column,$order,$statusval){
		$this->db->select("`recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`,`status`,`status_date`, `created_at`, `updated_at`");
		$emp_id=$this->session->userdata('emp_id');
		$this->db->from("recruitment");
		if($statusval!=''){
			$this->db->where("status",$statusval);
		}
		if($search!=''){
			$this->db->where("name like '%$search%' OR job_role like '%$search%' OR client like '%$search%' OR reporting_vendor like '%$search%' OR end_client like '%$search%' OR applied_role_position like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("recruitment_id", $order);
			break;
			case 1:
				$this->db->order_by("recruitment_id",'ASC');
			break;
			default:
				$this->db->order_by("recruitment_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
			  if($statusval!=''){
				$WHere =$this->db->where("status",$statusval);
			  }
				$resp = $this->db->query("SELECT `recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `status`, `status_date`, `created_at`, `updated_at` FROM `recruitment` WHERE '$WHere' AND name like '%$search%' OR job_role like '%$search%' OR client like '%$search%' OR reporting_vendor like '%$search%' OR end_client like '%$search%' OR applied_role_position like '%$search%' GROUP BY `recruitment_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_employee_roles_list_Details($type,$start,$length,$search,$column,$order){
		$admin_id=$this->session->userdata('emp_id');
		$this->db->select("t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`email_id`, t1.`role_id` as `r_id`, t1.`is_active`, t2.`roles_id`, t2.`role_name`");
		$this->db->from("employees as t1");
		$this->db->join('roles as t2', 't1.role_id = t2.roles_id', 'left');
		if($search!=''){
			$this->db->where("(t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%' OR t1.email_id like '%$search%' OR t2.role_name like '%$search%')");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.emp_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.emp_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.emp_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`email_id`, t1.`role_id` as `r_id`, t1.`is_active`, t2.`roles_id`, t2.`role_name` FROM `employees` as `t1` LEFT JOIN `roles` as `t2` ON `t1`.`role_id` = `t2`.`roles_id` WHERE `t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%' OR `t1`.email_id like '%$search%' OR `t2`.role_name like '%$search%' GROUP BY t1.`emp_id` ASC LIMIT 10")->result_array();
			    return $resp; 	
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function get_notifications_list($type,$start,$length,$search,$column,$order){
		$this->db->select("`notification_id`, `title`, `message`, `is_active`, `created_at`, `is_cron_notification_run`");
		$this->db->from("notifications");
		if($search!=''){
			$this->db->where("`title` like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("`notification_id`", $order);
			break;
			case 1:
				$this->db->order_by("`notification_id`",'ASC');
			break;
			default:
				$this->db->order_by("`notification_id`", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT `notification_id`, `title`, `message`, `is_active`, `created_at`, `is_cron_notification_run` FROM `notifications` WHERE `title` like '%$search%' GROUP BY `notification_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function get_view_notifications_list($type,$start,$length,$search,$column,$order,$notification_id){
		$this->db->select("t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`email_id`,  t2.`notification_employee_id`, t2.`notification_id`, t2.`employee_id`, t2.`read_yes_no`");
		$this->db->from("employees as t1");
		$this->db->join('notification_employees as t2', 't1.emp_id = t2.employee_id', 'right');
		$this->db->where("t2.notification_id",$notification_id);
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.emp_code like '%$search%' OR t1.email_id like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t2.notification_employee_id", $order);
			break;
			case 1:
				$this->db->order_by("t2.notification_employee_id",'ASC');
			break;
			default:
				$this->db->order_by("t2.notification_employee_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`emp_id`, t1.`fname`, t1.`lname`, t1.`emp_code`, t1.`email_id`,  t2.`notification_employee_id`, t2.`notification_id`, t2.`employee_id`, t2.`read_yes_no` FROM `employees` as `t1` RIGHT JOIN `notification_employees` as `t2` ON `t1`.`emp_id` = `t2`.`employee_id` WHERE t2.`notification_id`=$notification_id AND (`t1`.fname like '%$search%' OR `t1`.lname like '%$search%' OR `t1`.emp_code like '%$search%' OR `t1`.email_id like '%$search%') GROUP BY t2.`notification_employee_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_claim_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`claim_id`, t1.`emp_id`, t1.`amount`, t1.`date`, t1.`claim_type_id`, t1.`comments`, t1.`is_approved`, t1.`created_at`, t1.`accepted_rejected_dt`, t1.`accepted_rejected_comments`, t2.`claim_document_id`, t2.`claim_id`, t2.`file_name`, t2.`file_name_path`,t3.`claim_type_id`, t3.`name`, t4.`emp_id`, t4.`fname`, t4.`fname`, t4.`lname`, t4.`emp_code`");
		$this->db->join('claim_documents as t2', 't1.claim_id = t2.claim_id', 'left');
		$this->db->join('claim_type as t3', 't1.claim_type_id = t3.claim_type_id', 'left');
		$this->db->join('employees as t4', 't1.emp_id = t4.emp_id', 'left');
		$this->db->from("claims as t1");
		$this->db->group_by("t1.claim_id");
		if($search!=''){
			$this->db->where("t1.amount like '%$search%' OR t1.date like '%$search%' OR t3.name like '%$search%' OR t4.fname like '%$search%' OR t4.lname like '%$search%' OR t4.emp_code like '%$search%' OR t1.is_approved like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.claim_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.claim_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.claim_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`claim_id`, t1.`emp_id`, t1.`amount`, t1.`date`, t1.`claim_type_id`, t1.`comments`, t1.`is_approved`, t1.`created_at`, t2.`claim_document_id`, t2.`claim_id` as `clm_id`, t2.`file_name`, t2.`file_name_path`, t3.`claim_type_id`, t3.`name`,t4.`emp_id`, t4.`fname`, t4.`fname`, t4.`lname`, t4.`emp_code` FROM `claims` as `t1` LEFT JOIN `claim_documents` as `t2` ON `t1`.`claim_id` = `t2`.`claim_id` LEFT JOIN `claim_type` as `t3` ON `t1`.`claim_type_id` = `t3`.`claim_type_id` LEFT JOIN `employees` as `t4` ON `t1`.`emp_id` = `t4`.`emp_id` WHERE t1.`amount` like '%$search%' OR t1.`date` like '%$search%' OR t3.`name` like '%$search%' OR t4.`fname` like '%$search%' OR t4.`lname` like '%$search%' OR t4.`emp_code` like '%$search%' OR t1.`is_approved` like '%$search%' GROUP BY t1.`claim_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_employee_compensation_Details($type,$start,$length,$search,$column,$order,$status){
		$this->db->select("t1.`employee_compensation_id`, t1.`emp_id`, t1.`per_hour_rate`, t1.`monthly_salary`, t1.`ctc`, t1.`contact_start_dt`, t1.`contact_end_dt`, t1.`employment_type`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->from("employee_compensation as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		if($status=='Inactive')
		{
			$this->db->where('t1.is_active',0);
		}else{
			$this->db->where('t1.is_active',1);
		}
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t1.per_hour_rate like '%$search%' OR t1.monthly_salary like '%$search%' OR t1.ctc like '%$search%' OR t1.contact_start_dt like '%$search%' OR t1.contact_end_dt like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.employee_compensation_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.employee_compensation_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.employee_compensation_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				if($status=='Inactive')
				{
					$WHere='t1.`is_active`=0 AND';
				}else{
					$WHere='t1.`is_active`=1 AND';
				}
				$resp = $this->db->query("SELECT t1.`employee_compensation_id`, t1.`emp_id`, t1.`per_hour_rate`, t1.`monthly_salary`, t1.`ctc`, t1.`contact_start_dt`, t1.`contact_end_dt`, t1.`employment_type`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `employee_compensation` as `t1`  LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE $WHere t2.`fname` like '%$search%' OR t2.`lname` like '%$search%' OR t2.`emp_code` like '%$search%' OR t1.`per_hour_rate` like '%$search%' OR t1.`monthly_salary` like '%$search%' OR t1.`ctc` like '%$search%' OR t1.`contact_start_dt` like '%$search%' OR t1.`contact_end_dt` like '%$search%' GROUP BY t1.`employee_compensation_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_candidate_based_rate_config_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("`candidate_based_rate_config_id`, `name`, `id_no`, `excepted_rate_in_hrs`, `min_client_rate`, `max_client_rate`, `is_active`, `created_at`, `updated_at`");
		$this->db->from("candidate_based_rate_config");
		if($search!=''){
			$this->db->where("name like '%$search%' OR id_no like '%$search%' OR excepted_rate_in_hrs like '%$search%' OR min_client_rate like '%$search%' OR max_client_rate like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("candidate_based_rate_config_id", $order);
			break;
			case 1:
				$this->db->order_by("candidate_based_rate_config_id",'ASC');
			break;
			default:
				$this->db->order_by("candidate_based_rate_config_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT `candidate_based_rate_config_id`, `name`, `id_no`, `excepted_rate_in_hrs`, `min_client_rate`, `max_client_rate`, `is_active`, `created_at`, `updated_at` FROM `candidate_based_rate_config` WHERE `name` like '%$search%' OR `id_no` like '%$search%' OR `excepted_rate_in_hrs` like '%$search%' OR `min_client_rate` like '%$search%' OR `max_client_rate` like '%$search%' GROUP BY `candidate_based_rate_config_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_client_based_rate_config_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("`client_based_rate_config_id`, `name`, `client_rate_card`, `min_candidate_rate`, `max_candidate_rate`, `is_active`, `created_at`, `updated_at`");
		$this->db->from("client_based_rate_config");
		if($search!=''){
			$this->db->where("name like '%$search%' OR client_rate_card like '%$search%' OR min_candidate_rate like '%$search%' OR max_candidate_rate like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("client_based_rate_config_id", $order);
			break;
			case 1:
				$this->db->order_by("client_based_rate_config_id",'ASC');
			break;
			default:
				$this->db->order_by("client_based_rate_config_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT `client_based_rate_config_id`, `name`, `client_rate_card`, `min_candidate_rate`, `max_candidate_rate`, `is_active`, `created_at`, `updated_at` FROM `client_based_rate_config` WHERE `name` like '%$search%' OR `client_rate_card` like '%$search%' OR `min_candidate_rate` like '%$search%' OR `max_candidate_rate` like '%$search%' GROUP BY `client_based_rate_config_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_work_order_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("`work_orders_id`, `clinet_name`, `project_name`, `PO_deal_amt`, `PO`, `start_dt`, `end_dt`, `PO_Hrs`, `nature_of_business_id`, `no_of_resources`, `eco_system_practice_id`, `year`, `recognized_amt`, `backlog_amt`, `EMP_contribution`, `is_active`, `created_at`");
		$this->db->from("work_orders");
		if($search!=''){
			$this->db->where("clinet_name like '%$search%' OR project_name like '%$search%' OR year like '%$search%' OR PO like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("work_orders_id", $order);
			break;
			case 1:
				$this->db->order_by("work_orders_id",'ASC');
			break;
			default:
				$this->db->order_by("work_orders_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT `work_orders_id`, `clinet_name`, `project_name`, `PO_deal_amt`, `PO`, `start_dt`, `end_dt`, `PO_Hrs`, `nature_of_business_id`, `no_of_resources`, `eco_system_practice_id`, `year`, `recognized_amt`, `backlog_amt`, `EMP_contribution`, `is_active`, `created_at`, `updated_at` FROM `work_orders` WHERE `clinet_name` like '%$search%' OR `project_name` like '%$search%' OR `year` like '%$search%' OR `PO` like '%$search%' GROUP BY `work_orders_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_asset_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`asset_id`, t1.`name` as `t1name`, t1.`asset_tag`, t1.`supplier_id`, t1.`location_id`, t1.`brand_id`, t1.`serial_no`, t1.`asset_type_id`, t1.`cost`, t1.`purchase_date`, t1.`warranty`, t1.`status_id`, t1.`description`, t1.`emp_id`, t1.`assigned_dt`, t1.`asset_status`, t1.`comments`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`id` as `sid`, t2.`name` as `sname`, t2.`type` as `stype`, t3.`id` as `lid`, t3.`name` as `lname`, t3.`type` as `ltype`, t4.`id` as `bid`, t4.`name` as `bname`, t4.`type` as `btype`,t5.`id` as `aid`, t5.`name` as `aname`, t5.`type` as `atype`,t6.`id` as `stid`, t6.`name` as `stname`, t6.`type` as `sttype`");
		$this->db->from("assets as t1");
		$this->db->join('asset_items as t2', 't1.supplier_id = t2.id', 'left');
		$this->db->join('asset_items as t3', 't1.location_id = t3.id', 'left');
		$this->db->join('asset_items as t4', 't1.brand_id = t4.id', 'left');
		$this->db->join('asset_items as t5', 't1.asset_type_id = t5.id', 'left');
		$this->db->join('asset_items as t6', 't1.status_id = t6.id', 'left');
		if($search!=''){
			$this->db->where("t1.name like '%$search%' OR t1.asset_tag like '%$search%' OR t2.name like '%$search%' OR t3.name like '%$search%' OR t4.name like '%$search%' OR t5.name like '%$search%' OR t6.name like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.asset_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.asset_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.asset_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`asset_id`, t1.`name` as `t1name`, t1.`asset_tag`, t1.`supplier_id`, t1.`location_id`, t1.`brand_id`, t1.`serial_no`, t1.`asset_type_id`, t1.`cost`, t1.`purchase_date`, t1.`warranty`, t1.`status_id`, t1.`description`, t1.`emp_id`, t1.`assigned_dt`, t1.`asset_status`, t1.`comments`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`id` as `sid`, t2.`name` as `sname`, t2.`type` as `stype`, t3.`id` as `lid`, t3.`name` as `lname`, t3.`type` as `ltype`, t4.`id` as `bid`, t4.`name` as `bname`, t4.`type` as `btype`,t5.`id` as `aid`, t5.`name` as `aname`, t5.`type` as `atype`,t6.`id` as `stid`, t6.`name` as `stname`, t6.`type` as `sttype` FROM `assets` as `t1` LEFT JOIN `asset_items` as `t2` ON t1.`supplier_id`=t2.`id` LEFT JOIN `asset_items` as `t3` ON t1.`location_id`=t3.`id` LEFT JOIN `asset_items` as `t4` ON t1.`brand_id`=t4.`id` LEFT JOIN `asset_items` as `t5` ON t1.`asset_type_id`=t2.`id` LEFT JOIN `asset_items` as `t6` ON t1.`status_id`=t2.`id` WHERE t1.`name` like '%$search%' OR t1.`asset_tag` like '%$search%' OR t2.`name` like '%$search%' OR t3.`name` like '%$search%' OR t4.`name` like '%$search%' OR t5.`name` like '%$search%' OR t6.`name` like '%$search%' GROUP BY t1.`asset_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_components_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`component_id`, t1.`name` as `t1name`, t1.`serial_no`, t1.`qty`, t1.`supplier_id`, t1.`location_id`, t1.`brand_id`, t1.`asset_type_id`, t1.`cost`, t1.`purchase_date`, t1.`warranty`, t1.`status_id`, t1.`description`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`id` as `sid`, t2.`name` as `sname`, t2.`type` as `stype`, t3.`id` as `lid`, t3.`name` as `lname`, t3.`type` as `ltype`, t4.`id` as `bid`, t4.`name` as `bname`, t4.`type` as `btype`,t5.`id` as `aid`, t5.`name` as `aname`, t5.`type` as `atype`,t6.`id` as `stid`, t6.`name` as `stname`, t6.`type` as `sttype`");
		$this->db->from("asset_components as t1");
		$this->db->join('asset_items as t2', 't1.supplier_id = t2.id', 'left');
		$this->db->join('asset_items as t3', 't1.location_id = t3.id', 'left');
		$this->db->join('asset_items as t4', 't1.brand_id = t4.id', 'left');
		$this->db->join('asset_items as t5', 't1.asset_type_id = t5.id', 'left');
		$this->db->join('asset_items as t6', 't1.status_id = t6.id', 'left');
		if($search!=''){
			$this->db->where("t1.name like '%$search%' OR t1.serial_no like '%$search%' OR t2.name like '%$search%' OR t3.name like '%$search%' OR t4.name like '%$search%' OR t5.name like '%$search%' OR t6.name like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.component_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.component_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.component_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`component_id`, t1.`name` as `t1name`, t1.`serial_no`, t1.`qty`, t1.`supplier_id`, t1.`location_id`, t1.`brand_id`, t1.`asset_type_id`, t1.`cost`, t1.`purchase_date`, t1.`warranty`, t1.`status_id`, t1.`description`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`id` as `sid`, t2.`name` as `sname`, t2.`type` as `stype`, t3.`id` as `lid`, t3.`name` as `lname`, t3.`type` as `ltype`, t4.`id` as `bid`, t4.`name` as `bname`, t4.`type` as `btype`,t5.`id` as `aid`, t5.`name` as `aname`, t5.`type` as `atype`,t6.`id` as `stid`, t6.`name` as `stname`, t6.`type` as `sttype` FROM `asset_components` as `t1` LEFT JOIN `asset_items` as `t2` ON t1.`supplier_id`=t2.`id` LEFT JOIN `asset_items` as `t3` ON t1.`location_id`=t3.`id` LEFT JOIN `asset_items` as `t4` ON t1.`brand_id`=t4.`id` LEFT JOIN `asset_items` as `t5` ON t1.`asset_type_id`=t2.`id` LEFT JOIN `asset_items` as `t6` ON t1.`status_id`=t2.`id` WHERE t1.`name` like '%$search%' OR t1.`serial_no` like '%$search%' OR t2.`name` like '%$search%' OR t3.`name` like '%$search%' OR t4.`name` like '%$search%' OR t5.`name` like '%$search%' OR t6.`name` like '%$search%' GROUP BY t1.`component_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_maintenances_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`maintenance_id`, t1.`asset_id`, t1.`supplier_id`, t1.`type_id`, t1.`start_dt`, t1.`end_dt`, t2.`asset_id`, t2.`name`, t2.`asset_tag`, t2.`serial_no`,t3.`id` as `sid`, t3.`name` as `sname`, t3.`type` as `stype`,t4.`id` as `tid`, t4.`name` as `tname`, t4.`type` as `ttype`");
		$this->db->from("asset_maintenance as t1");
		$this->db->join('assets as t2', 't1.asset_id = t2.asset_id', 'left');
		$this->db->join('asset_items as t3', 't1.supplier_id = t3.id', 'left');
		$this->db->join('asset_items as t4', 't1.supplier_id = t4.id', 'left');
		if($search!=''){
			$this->db->where("t2.name like '%$search%' OR t2.serial_no like '%$search%' OR t3.name like '%$search%' OR t4.name like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.maintenance_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.maintenance_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.maintenance_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`maintenance_id`, t1.`asset_id`, t1.`supplier_id`, t1.`type_id`, t1.`start_dt`, t1.`end_dt`, t2.`asset_id`, t2.`name`, t2.`asset_tag`, t2.`serial_no`,t3.`id` as `sid`, t3.`name` as `sname`, t3.`type` as `stype`,t4.`id` as `tid`, t4.`name` as `tname`, t4.`type` as `ttype` FROM `asset_maintenance` as`t1` LEFT JOIN `assets` as `t2` ON t1.`asset_id`=t2.`asset_id` LEFT JOIN `asset_items` as `t3` ON t1.`supplier_id`=t3.`id` LEFT JOIN `asset_items` as `t4` ON t1.`type_id`=t4.`id` WHERE t2.`name` like '%$search%' OR t2.`serial_no` like '%$search%' OR t3.`name` like '%$search%' OR t4.`name` like '%$search%' GROUP BY t1.`maintenance_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_candidate_filters_Details($type,$start,$length,$search,$column,$order,$company_id,$job_id,$sta){
		$this->db->select("t1.`candidate_applied_id`, t1.`company_id`, t1.`job_id`, t1.`fname`, t1.`lname`, t1.`email_id`, t1.`phone_no`, t1.`status`, t1.`created_at`, t2.`company_id`, t2.`company_name`, t3.`job_id`, t3.`company_id`, t3.`job_title`");
		$this->db->from("candidate_applied_jobs as t1");
		$this->db->join('companies as t2', 't1.company_id = t2.company_id', 'left');
		$this->db->join('jobs as t3', 't1.job_id = t3.job_id', 'left');
		if($company_id!=''){
			$this->db->where("t1.company_id",$company_id);
		}else{
			$this->db->where("t1.company_id",'');
		}
		if($job_id!=''){
			$this->db->where("t1.job_id",$job_id);
		}
		if($sta!=''){
			if($sta=='source_applied'){
				$this->db->where("t1.status",'source/applied');
			}else if($sta=='internal interview'){
				$this->db->where("t1.status",'internal_interview');
			}else if($sta=='client interview'){
				$this->db->where("t1.status",'client_interview');
			}else{
				$this->db->where("t1.status",$sta);
			}
		}
		if($search!=''){
			$this->db->where("t1.fname like '%$search%' OR t1.lname like '%$search%' OR t1.email_id like '%$search%' OR t1.phone_no like '%$search%' OR t2.company_name like '%$search%' OR t3.job_title like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.candidate_applied_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.candidate_applied_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.candidate_applied_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$WHere='';
				if($company_id!=''){
					$WHere='t1.company_id=$company_id';
				}
				if($job_id!=''){
					$WHere='t1.job_id=$job_id';
				}
				if($sta!=''){
					if($sta=='source_applied'){
						$WHere="AND t1.status='source/applied'";
					}else if($sta=='internal interview'){
						$WHere="AND t1.status='internal_interview'";
					}else if($sta=='client interview'){
						$WHere="AND t1.status='client_interview'";
					}else{
						$WHere="AND t1.status='$sta'";
					}
				}
				$resp = $this->db->query("SELECT t1.`candidate_applied_id`, t1.`company_id`, t1.`job_id`, t1.`fname`, t1.`lname`, t1.`email_id`, t1.`phone_no`, t1.`status`, t1.`created_at`, t2.`company_id`, t2.`company_name`, t3.`job_id`, t3.`company_id`, t3.`job_title` FROM `candidate_applied_jobs` as`t1` LEFT JOIN `companies` as `t2` ON t1.`company_id`=t2.`company_id` LEFT JOIN `jobs` as `t3` ON t1.`job_id`=t3.`job_id` WHERE t1.`fname` like '%$search%' OR t1.`lname` like '%$search%' OR t1.`email_id` like '%$search%' OR t1.`phone_no` like '%$search%' OR t2.`company_name` like '%$search%' OR t3.`job_title` like '%$search%' $WHere GROUP BY t1.`candidate_applied_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
}
