<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
function email_helper()
{
    $config['protocol'] = "smtp";
    $config['smtp_host'] = "smtp-relay.sendinblue.com";
    $config['smtp_port'] = "587";
    $config['smtp_user'] = "chaitanya@vibhotech.com"; 
    $config['smtp_pass'] = "6bUx8HkZdv19OBVA";
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
    return $config;
}
	
