<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	function checklogin_admin($sub_menu_name='',$read_or_write='')
	{
		$CI= & get_instance();		
		$CI->load->library('session');
		$CI->load->helper('url');
		$admin_id=$CI->session->userdata('id');	
		$emp_id =$CI->session->userdata('emp_id');
		$role_id=$CI->session->userdata('role_id');
		if(($sub_menu_name=='Roles' || $sub_menu_name=='Roles Access') && $role_id!='Admin'){
			session_destroy();
			redirect('master/');
		}else if($sub_menu_name!='' && $role_id!=''){
			$GetRolesAccess=$CI->db->query("SELECT `role_access_id`, `id`, `role_id`, `menu_id`, `sub_menu_name`, `sub_menu_url`, `sub_menu_icon`, `access`, `read`, `write`, `is_active` FROM `role_access` WHERE `role_id`='$role_id' AND `sub_menu_name`='$sub_menu_name'")->row_array();
			if($admin_id=='' || !isset($admin_id) || ($role_id!='Admin' && $read_or_write=='' && ($GetRolesAccess['read']==0 && $GetRolesAccess['write']==0)))
			{
				session_destroy();
				redirect('master/');
			}else if($admin_id=='' || !isset($admin_id) || ($role_id!='Admin' && $read_or_write=='Write' && ($GetRolesAccess['write']==0)))
			{
				session_destroy();
				redirect('master/');
			}
		}else{
			if($admin_id=='' || !isset($admin_id))
			{
				session_destroy();
				redirect('master/');
			}
		}
		
		
	}
	
