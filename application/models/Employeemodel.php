<?php
ob_start();
class Employeemodel extends CI_Model{
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
            $res = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id` FROM `employees` WHERE `emp_code`='$empcode'");
        } else {
            $res = $this->db->query("SELECT `emp_id`, `fname`, `lname`, `gender`, `dob`, `emp_code`, `designation_id`, `email_id` FROM `employees` WHERE `emp_code`='$empcode' and `emp_id`!=$trid");
        }
        $result = $res->num_rows();
        return $result;
    }
    
	public function search_other_docuemnt_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->from("other_documents as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$emp_id=$this->session->userdata('emp_id');
		$this->db->where("t1.`emp_id`",$emp_id);
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
				$resp = $this->db->query("SELECT t1.`document_id`, t1.`doc_title`, t1.`emp_id`, t1.`document_name`, t1.`document_path`, t1.`is_active`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `other_documents` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id AND `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t1`.doc_title like '%$search%' OR `t1`.document_name like '%$search%' GROUP BY t1.`document_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_employee_confirmation_letter_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`confirmation_of_employment_id`, t1.`emp_id`, t1.`emp_data`, t1.`is_generated`, t1.`created_at`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->from("confirmation_of_employment as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$emp_id=$this->session->userdata('emp_id');
		$this->db->where("t1.`emp_id`",$emp_id);
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t1.doc_title like '%$search%' OR t1.document_name like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.confirmation_of_employment_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.confirmation_of_employment_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.confirmation_of_employment_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`confirmation_of_employment_id`, t1.`emp_id`, t1.`emp_data`, t1.`is_generated`, t1.`created_at`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `confirmation_of_employment` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id AND `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t1`.doc_title like '%$search%' OR `t1`.document_name like '%$search%' GROUP BY t1.`confirmation_of_employment_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_leaves_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`employee_leaves_lid`, t1.`emp_id`, t1.`from_date`, t1.`to_date`, t1.`leave_days`, t1.`leave_type`, t1.`leave_status`, t1.`reason`, t1.`document_file_name`, t1.`document_file_path`, t1.`created_at`, t1.is_delete, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id`");
		$emp_id=$this->session->userdata('emp_id');
		$this->db->where("t1.emp_id",$emp_id);
		$this->db->from("employee_leaves_list as t1");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$this->db->where('t1.is_delete!=',0);
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t2.email_id like '%$search%' OR t1.from_date like '%$search%' OR t1.to_date like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.employee_leaves_lid", $order);
			break;
			case 1:
				$this->db->order_by("t1.employee_leaves_lid",'ASC');
			break;
			default:
				$this->db->order_by("t1.employee_leaves_lid", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`employee_leaves_lid`, t1.`emp_id`, t1.`from_date`, t1.`to_date`, t1.`leave_days`, t1.`leave_type`, t1.`leave_status`, t1.`reason`, t1.`document_file_name`, t1.`document_file_path`, t1.`created_at`, t1.is_delete, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`, t2.`email_id` FROM `employee_leaves_list` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id AND `t2`.fname like '%$search%' OR `t2`.lname like '%$search%' OR `t2`.emp_code like '%$search%' OR `t2`.email_id like '%$search%' OR `t1`.from_date like '%$search%' OR `t1`.to_date like '%$search%' t1.is_delete!=0 AND GROUP BY t1.`employee_leaves_lid` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_payslip_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`payslip_id`, t1.`month`, t1.`year`, t1.`emp_id`, t1.`payslip_file_name`, t1.`payslip_file_path`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code`");
		$this->db->join('employees as t2', 't1.emp_id = t2.emp_id', 'left');
		$emp_id=$this->session->userdata('emp_id');
		$this->db->where("t1.emp_id",$emp_id);
		$this->db->from("payslips as t1");
		if($search!=''){
			$this->db->where("t2.fname like '%$search%' OR t2.lname like '%$search%' OR t2.emp_code like '%$search%' OR t1.month like '%$search%' OR t1.year like '%$search%'");
		}
		switch($column){
			case 0:
				$this->db->order_by("t1.payslip_id", $order);
			break;
			case 1:
				$this->db->order_by("t1.payslip_id",'ASC');
			break;
			default:
				$this->db->order_by("t1.payslip_id", $order);
		}
		if($type==2){
			if($length!=0){ $this->db->limit($length,$start);}
			$resp = $this->db->get()->result_array();
			if($search!=''){
				$resp = $this->db->query("SELECT t1.`payslip_id`, t1.`month`, t1.`year`, t1.`emp_id`, t1.`payslip_file_name`, t1.`payslip_file_path`, t1.`is_active`, t1.`created_at`, t1.`updated_at`, t2.`emp_id`, t2.`fname`, t2.`lname`, t2.`emp_code` FROM `payslips` as `t1` LEFT JOIN `employees` as `t2` ON `t1`.`emp_id` = `t2`.`emp_id` WHERE t1.`emp_id`=$emp_id AND t2.`fname` like '%$search%' OR t2.`lname` like '%$search%' OR t2.`emp_code` like '%$search%' OR t1.`month` like '%$search%' OR t1.`year` like '%$search%' GROUP BY t1.`payslip_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_recruitment_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("`recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `created_at`, `updated_at`");
		$emp_id=$this->session->userdata('emp_id');
		$this->db->from("recruitment");
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
				$resp = $this->db->query("SELECT `recruitment_id`, `emp_id`, `name`, `job_role`, `client`, `reporting_vendor`, `end_client`, `applied_role_position`, `client_feedback`, `client_feedback_rejected`, `Candidate_current_rate_card`, `proposed_rate_card_to_client`, `notice_period`, `comments`, `is_active`, `created_at`, `updated_at` FROM `recruitment` WHERE name like '%$search%' OR job_role like '%$search%' OR client like '%$search%' OR reporting_vendor like '%$search%' OR end_client like '%$search%' OR applied_role_position like '%$search%' GROUP BY `recruitment_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function get_notifications_list($type,$start,$length,$search,$column,$order){
		$this->db->select("t2.`notification_employee_id`, t2.`notification_id`, t2.`employee_id`, t2.`read_yes_no`, t3.`notification_id`, t3.`title`, t3.`message`, t3.`applicable_to_all`, t3.`created_at`, t3.`is_cron_notification_run`");
		$this->db->from("notification_employees as t2");
		$this->db->join('notifications as t3', 't2.notification_id = t3.notification_id', 'left');
		$EID=$this->session->userdata('emp_id');
		$this->db->where("t2.employee_id",$EID);
		if($search!=''){
			$this->db->where("t3.title like '%$search%'");
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
				$EID=$this->session->userdata('emp_id');
				$resp = $this->db->query("SELECT t2.`notification_employee_id`, t2.`notification_id`, t2.`employee_id`, t2.`read_yes_no`, t3.`notification_id`, t3.`title`, t3.`message`, t3.`applicable_to_all`, t3.`created_at`, t3.`is_cron_notification_run` FROM `notification_employees` as `t2` LEFT JOIN `notifications` as `t3` ON `t2`.`notification_id` = `t3`.`notification_id` WHERE t2.`employee_id`=$EID AND (`t3`.title like '%$search%') GROUP BY t2.`notification_employee_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
	public function search_claim_Details($type,$start,$length,$search,$column,$order){
		$this->db->select("t1.`claim_id`, t1.`emp_id`, t1.`amount`, t1.`date`, t1.`claim_type_id`, t1.`comments`, t1.`is_approved`, t1.`created_at`, t1.`accepted_rejected_dt`, t1.`accepted_rejected_comments`, t2.`claim_document_id`, t2.`claim_id`, t2.`file_name`, t2.`file_name_path`,t3.`claim_type_id`, t3.`name`");
		$this->db->join('claim_documents as t2', 't1.claim_id = t2.claim_id', 'left');
		$this->db->join('claim_type as t3', 't1.claim_type_id = t3.claim_type_id', 'left');
		$emp_id=$this->session->userdata('emp_id');
		$this->db->where("t1.emp_id",$emp_id);
		$this->db->from("claims as t1");
		$this->db->group_by("t1.claim_id");
		if($search!=''){
			$this->db->where("t1.amount like '%$search%' OR t1.date like '%$search%' OR t3.name like '%$search%' OR t1.is_approved like '%$search%'");
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
				$resp = $this->db->query("SELECT t1.`claim_id`, t1.`emp_id`, t1.`amount`, t1.`date`, t1.`claim_type_id`, t1.`comments`, t1.`is_approved`, t1.`created_at`, t2.`claim_document_id`, t2.`claim_id` as `clm_id`, t2.`file_name`, t2.`file_name_path`, t3.`claim_type_id`, t3.`name` FROM `claims` as `t1` LEFT JOIN `claim_documents` as `t2` ON `t1`.`claim_id` = `t2`.`claim_id` LEFT JOIN `claim_type` as `t3` ON `t1`.`claim_type_id` = `t3`.`claim_type_id` WHERE t1.`emp_id`=$emp_id AND t1.`amount` like '%$search%' OR t1.`date` like '%$search%' OR t3.`name` like '%$search%' OR t1.`is_approved` like '%$search%' GROUP BY t1.`claim_id` ASC LIMIT 10")->result_array();
				return $resp;
			}
		}else{
			$resp=$this->db->get()->num_rows();
		}
		return $resp;
	}
}
