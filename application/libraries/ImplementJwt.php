<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    require APPPATH . '/libraries/JWT.php';
    class ImplementJwt
    {
        //////////The function generate token/////////////
        PRIVATE $key = "subcribe_my_channel"; 
        public function GenerateToken($data)
        {         
            $jwt = JWT::encode($data, $this->key);
            return $jwt;
        }
       
       //////This function decode the token////////////////////
        public function DecodeToken($token)
        {         
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            $decodedData = (array) $decoded;
            return $decodedData;
        }
    }

?> 