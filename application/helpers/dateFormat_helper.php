<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	function dateFormat_helper($date, $format = 'd-m-Y')
	{
        return date($format, strtotime($date));
    }
	
