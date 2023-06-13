<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/REST_Controller.php';
if(isset($_SERVER['HTTP_ORIGIN'])){
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');
}
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
		exit(0);
}
class Restapi extends REST_Controller{
	public function __construct(){
		parent :: __construct();
		$this->load->model('app_login');  
		$this->load->model('common_model');
        $this->objOfJwt = new ImplementJwt();
        header('Content-Type: application/json');
	}
	public function LoginToken_get($get_user_details='')
    {
		$tokenData['user_id'] = $get_user_details['user_id'];
		$tokenData['name'] = $get_user_details['name'];
		$tokenData['phone_no'] = $get_user_details['phone_no'];;
		$tokenData['timeStamp'] = $get_user_details['created_date'];
		$jwtToken = $this->objOfJwt->GenerateToken($tokenData);
		echo json_encode(array('Token'=>$jwtToken));
    }
    public function GetTokenData_get()
    {
    	$received_Token = $this->input->request_headers('Authorization');
        try
            {
            	$jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
            	echo json_encode($jwtData);
            }
            catch (Exception $e)
            {
            	http_response_code('401');
            	echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
            }
    }
    public function gettoken($received_Token)
    {
    	$status=0;
    	$msg='';
    	$data=array();
     	$Tok = @$received_Token['Authorization'];
		if($Tok!=''){
			$Tok = trim(str_replace('Bearer','',$Tok));
			$jwtData = $this->objOfJwt->DecodeToken($Tok);
			if(!empty($jwtData)){
				$data = $jwtData;
				$status=1;
			}else{
				$status=0;
				$msg='Invalid key';
			}
		}else{
			$status=0;
			$msg='Not Authorizated';
		}
		return array('status'=>$status,'msg'=>$msg,'data'=>$data);
    }
    public function update_profile_put()
    {
		$response['message']='';
		$respstatus=400;
    	$data = json_decode(file_get_contents("php://input"),true);
    	$data=(isset($data))? $data : $_POST;	
    	$received_Token = @$this->input->request_headers();
    	$userdata =$this->gettoken($received_Token);
    	// echo "<pre>";print_r($userdata);exit;
    	if($userdata['status']==0){
			$response['message']=$userdata['msg'];
    	}else{
    		$admin_id = $userdata['data']['admin_id'];
	    	$delivery_boy_id = $userdata['data']['delivery_boy_id'];
	    	$name = @$data['name'];
	    	$email = @$data['email_id'];
	    	$address = @$data['address'];
	    	if($name!='' && $email!='' && $address!=''){
	    		$file='';
				$imagename='';
				if($_FILES['simage']['name'] !='')
				{
					$image_name=$_FILES['simage']['name'];
	                $file=str_replace(" ","_",$_FILES['simage']['name']);
					$image_path=time().$file;
					$this->load->library('upload');
					$config['upload_path'] = 'assets/delivery_boy_images';
					$config['file_name'] = $image_path;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite']=true;
					$this->upload->initialize($config);
					 if(!$this->upload->do_upload('simage'))
						{
							 $response['message']='Please allowed jpg,jpeg,png formats only.';
						}
						else
						{
							
								$image_name=$image_name;
								$image_path=$image_path;
						}
				}else{
					$image_name=$oldpic_name;
					$image_path=$oldpic_path;
				}
	    		$wh = array('name'=>$name,'email_id'=>$email,'address'=>$address,'updated_date'=>date('Y-m-d H:i:sa'));
				$this->db->where('delivery_boy_id',$delivery_boy_id);
				$this->db->update('delivery_boy',$wh);
				$admin_wh = array('name'=>$name,'email_id'=>$email,'updated_date'=>date('Y-m-d H:i:sa'));
				$this->db->where('admin_id',$admin_id);
				$res = $this->db->update('admin_login',$admin_wh);
				if($res==1){
					$response['message']='Profile details updated successfully.';
				}else{
					$response['message']='Profile details updated failed.';
				}
			 	$respstatus=200;
			 }else{
			 	$response['message']='All fields are required.';
			 }
		}
		$this->set_response($response,$respstatus);
    }
	public function login_post()
    {
    	$response['message']='';
		$respstatus=400;
    	$data = json_decode(file_get_contents("php://input"),true);
    	$data=(isset($data))? $data : $_POST;	
    	$mobile_number = @$data['phone_no'];
		if($mobile_number=='') 
		 {
			 $response['message']='Mobile number required';
		}else{
		 	 $wh = array('phone_no'=>$mobile_number,'status'=>1);
			 $Check_Mobile = $this->db->select('admin_id')->get_where('admin_login',$wh)->num_rows();
			 $inactive_wh = array('phone_no'=>$mobile_number,'status'=>0);
			 $Inactive_Check_Mobile = $this->db->select('admin_id')->get_where('admin_login',$inactive_wh)->num_rows();
			 if($Check_Mobile>0){
				$otp = 1111;
				$Up = array('otp'=>$otp,'admin_status'=>'ExistedUser');
				$this->common_model->commonUpdate('admin_login',$Up,$wh);
				$MsgARR = array(
					'OTP' =>  $otp
				);
				$response['message']='Verification code sent to your mobile no';
				$respstatus=200;
			}else if($Inactive_Check_Mobile>0){
				$response['message']='Your account was inactive status! Please contact admin';
			}else{
				$wh = array('phone_no'=>$mobile_number,'status'=>1,'admin_status'=>'NewUser','created_date'=>date('Y-m-d H:i:sa'));
				$response['message']='Verification code sent to your mobile no';
			}
		}
		$this->set_response($response,$respstatus);
    }
    public function opt_verification_post()
    {
    	$response['message']='';
		$respstatus=400;
    	$data = json_decode(file_get_contents("php://input"),true);
    	$data=(isset($data))? $data : $_POST;	
    	$phone_no = @$data['phone_no'];
		$digit_1 = @$data['digit_1'];
		$digit_2 = @$data['digit_2'];
		$digit_3 = @$data['digit_3'];
		$digit_4 = @$data['digit_4'];
		$OTP =$digit_1.$digit_2.$digit_3.$digit_4;
		if($OTP=='') 
		{
			 $response['message']='Verification code required';
		}else{
		 	 $wh = array('phone_no'=>$phone_no,'otp'=>$OTP,'status'=>1);
			 $Check_Mobile = $this->db->select('admin_id')->get_where('admin_login',$wh)->num_rows();
			 $get_user_details = $this->db->query("SELECT `admin_id`, `delivery_boy_id`, `username`, `email`, `password`, `phone_no`, `type`, `otp`, `admin_status`, `status`, `created_date`, `updated_date` FROM `admin_login` WHERE `phone_no`=$phone_no")->row_array();
			if($Check_Mobile>0){
				$tokenData['admin_id'] = $get_user_details['admin_id'];
				$tokenData['username'] = $get_user_details['username'];
				$tokenData['email'] = $get_user_details['email'];
				$tokenData['phone_no'] = $get_user_details['phone_no'];
				$tokenData['type'] = $get_user_details['type'];
				$tokenData['delivery_boy_id'] = $get_user_details['delivery_boy_id'];
				$tokenData['timeStamp'] = $get_user_details['created_date'];
				$jwtToken = $this->objOfJwt->GenerateToken($tokenData);
				echo json_encode(array('Token'=>$jwtToken));
				$response['message']='OTP Verified.';
				$respstatus=200;
			}else{
				$response['message']='Invalid Verification code.Please try again';
			}
		}
		$this->set_response($response,$respstatus);
    }
    public function resend_otp_post()
    {
    	$response['message']='';
		$respstatus=400;
    	$data = json_decode(file_get_contents("php://input"),true);
    	$data=(isset($data))? $data : $_POST;	
    	$mobile_number = @$data['phone_no'];
		$OTP = 1111;
		if($mobile_number=='') 
		{
			 $response['message']='Mobile number required';
		}else{
		 	 $wh = array('phone_no'=>$mobile_number,'otp'=>$OTP,'status'=>1);
			 $Check_Mobile = $this->db->select('admin_id')->get_where('admin_login',$wh)->num_rows();
			if($Check_Mobile>0){
				$response['message']='OTP sent to your mobile number';
				$respstatus=200;
			}else{
				$response['message']='Invalid mobile number.Please try again';
			}
		}
		$this->set_response($response,$respstatus);
    }
    public function orders_get($Type='')
    {
    	$response['message']='';
		$respstatus=400;
    	$data = json_decode(file_get_contents("php://input"),true);
    	$data=(isset($data))? $data : $_POST;	
		$received_Token = @$this->input->request_headers();
    	$userdata =$this->gettoken($received_Token);
    	// echo "<pre>";print_r($userdata);exit;
    	if($Type=='Assigned'){
    		$WHere ='t1.`status`="Assigned"';
    	}
    	if($Type=='Accept'){
    		$WHere ='t1.`status`="Accept"';
    	}
    	if($Type=='Reject'){
    		$WHere ='t1.`status`="Reject"';
    	}
    	if($Type=='Delivered'){
    		$WHere ='t1.`status`="Delivered"';
    	}
    	if($userdata['status']==0){
			$response['message']=$userdata['msg'];
    	}else{
    		$delivery_boy_id =$userdata['delivery_boy_id'];
			if($delivery_boy_id==''){
				$response['message']='Delivery Boy id required';
				$respstatus=200;
			}else{
				 $response['orders']=$this->db->query("SELECT t1.`delivery_boy_orders_id`, t1.`delivery_boy_id`, t1.`order_id`, t1.`order_prod_id`, t1.`status`, t1.`comments`, t1.`created_date`,t2.`order_id`, t2.`payment_id`, t2.`user_id`, t2.`reference_id`, t2.`order_amount`, t2.`user_address_id`, t2.`payment_mode`, t2.`payment_status`, t2.`order_status`, t2.`user_apartment_det_id`, t2.`order_date`, t2.`order_succ_date`,t3.`order_prod_id`, t3.`order_id`, t3.`user_id`, t3.`qty`, t3.`tot_amount`, t3.`offer_amount`, t3.`prod_id`, t3.`prod_mes_id`, t3.`mesurment`, t3.`prod_title`, t3.`prod_mesurements`, t3.`prod_category`, t3.`prod_sub_category`, t3.`prod_available_locations`, t3.`prod_brand`, t3.`delivery_boy_id`, t3.`delivery_boy_status`, t3.`delivery_boy_assign_date`, t3.`delivery_comment` FROM `delivery_boy_orders` t1 LEFT JOIN orders t2 ON `t1`.order_id=t2.`order_id` LEFT JOIN order_products t3 ON `t1`.order_prod_id=t3.`order_prod_id` WHERE t1.`delivery_boy_id`=$delivery_boy_id AND $WHere")->result_array();
				 // echo $this->db->last_query();exit;
				$response['count']=count($response['orders']);
				$response['message']='Order details successfully';
				$respstatus=200;
			}
		}
    	$this->set_response($response,$respstatus);
    }
    public function update_orders_status_put()
    {
    	$response['message']='';
		$respstatus=400;
    	$data = json_decode(file_get_contents("php://input"),true);
    	$data=(isset($data))? $data : $_POST;
    	$status = $data['status'];	
    	$order_prod_id = $data['order_prod_id'];
		$received_Token = @$this->input->request_headers();
    	$userdata =$this->gettoken($received_Token);
    	// echo "<pre>";print_r($userdata);exit;
    	if($userdata['status']==0){
			$response['message']=$userdata['msg'];
    	}else{
    		$delivery_boy_id =1;
			if($delivery_boy_id==''){
				$response['message']='Delivery Boy id required';
				$respstatus=200;
			}else{
				 $arr_data = array('status'=>$status,'update_date'=>date('Y-m-d H:i:sa'));
				 $this->db->where('order_prod_id',$order_prod_id);
				 $this->db->where('delivery_boy_id',$delivery_boy_id);
				 $this->db->update('delivery_boy_orders',$arr_data);
				  // echo $this->db->last_query();exit;
				 $delivery_arr_data = array('delivery_boy_status'=>$status,'updated_date'=>date('Y-m-d H:i:sa'));
				 $this->db->where('order_prod_id',$order_prod_id);
				 $this->db->where('delivery_boy_id',$delivery_boy_id);
				 $res = $this->db->update('order_products',$delivery_arr_data);
				 // echo $this->db->last_query();exit;
				$response['message']='Order status details successfully';
				$respstatus=200;
			}
		}
    	$this->set_response($response,$respstatus);
    }
	public function changepassword_post(){
		$response['message']='';
		$respstatus=400;
		$data 		= 	json_decode(file_get_contents("php://input"),true);
		$data		=	(isset($data))? $data : $_POST;
		$old        =   $data['old_password'];
		$new        =   $data['new_password'];
		$pass       =   $data['confirm_new_password'];
		$received_Token = @$this->input->request_headers();
    	$userdata =$this->gettoken($received_Token);
    	if($userdata['status']==0){
			$response['message']=$userdata['msg'];
    	}else{
    		$admin_id = $userdata['data']['admin_id'];
    		if($old=='' || $new=='' || $pass==''){
    			$response['message']='All fields are required';
    		}
			$Check = $this->db->select('admin_id')->get_where('admin_login',array('password'=>md5($old),'admin_id'=>$admin_id))->num_rows();
			if($Check>0){
	    		if($new==$pass){
	    			$data = array('password'=>md5($new));
	    			$this->db->where('admin_id',$admin_id);
	    			$this->db->update('admin_login',$data);
	    		    $respstatus=200;
	    			$response['message']='Password Updated Successfully';
	    		}else{
	    			$respstatus=200;
	    			$response['message']='Mismatched confirm password';
	    		}
			}else{
		    	$respstatus=200;
    			$response['message']='Invalid old password';
			}
    	}
		$this->set_response($response,$respstatus);	
	}
	public function forgotpassword_post(){
		$response['message']='';
		$respstatus=400;
		$data 		= 	json_decode(file_get_contents("php://input"),true);
		$data		=	(isset($data))? $data : $_POST;
		$phone_no   =   $data['phone_no'];
		if($phone_no==''){
				$respstatus=200;
    			$response['message']='Please enter Mobile No';
    	}else{
    		$Check = $this->db->select('admin_id')->get_where('admin_login',array('phone_no'=>$phone_no))->num_rows();
			if($Check==0){
				$respstatus=200;
				$response['message']='Invalid Mobile No';
			}else{
			    $pass = rand ( 10000 , 99999 );
			    $html_content = 'Your updated password : '.$pass;
			    $subject='Forgotpassword';
			    $this->common_model->send_email($html_content, $email, $subject);
				$respstatus=200;
				$response['message']='New password generated and send to you mail check once with spam';
			}
    	}
		$this->set_response($response,$respstatus);		
	}
	
	
}
