<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      
	#--------------------------------------------------------------------
	# function for Check Super Admin Login
	#---------------------------------------------------------------------
	function checklogin_employee_helper(){
		$CI= & get_instance();
		$CI->load->library('session');
		$CI->load->helper('url');
		$id =$CI->session->userdata('id');
		$emp_id =$CI->session->userdata('emp_id');
		$type =$CI->session->userdata('type');
		$is_chk_login =$CI->session->userdata('is_chk_login');
		$stype = $CI->uri->segment(1);
		if($id=='' ||  $emp_id==''){
			session_destroy();
			redirect(base_url());
		}
	}
	function DD_M_YY($date){
        return date('d-M-Y', strtotime($date));
    }
    function DD_M_YY_H_I_Sa($date){
        return date('d-M-Y H:i:sa', strtotime($date));
    }
    function DD_M_YY_h_i_s($date){
        return date('d-M-Y H:i:s', strtotime($date));
    }
	function DD_MM_YY($date){
        return date('d-m-Y', strtotime($date));
    }
	function YY_MM_DD($date){
        return date('Y-m-d', strtotime($date));
    }
	function DD_MM($date){
        return date('d-M', strtotime($date));
    }
	function YY_MONTH_DD($date){
        return date('d-M-y', strtotime($date));
    }
	function DAYNAME($date){
        return date('D', strtotime($date));
    }
	