<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    $this->load->library('email');
	    $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp-relay.sendinblue.com";
        $config['smtp_port'] = "587";
        $config['smtp_user'] = "chaitanya@vibhotech.com"; 
        $config['smtp_pass'] = "6bUx8HkZdv19OBVA";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from('contact@vibhotech.com');
        $this->email->to('chaitanya@vibhotech.com');
        $this->email->subject('This Is Email');
        $this->email->message('Hi Chaitanya');
        $this->email->send();
		$this->load->view('welcome_message');		
	}
}
