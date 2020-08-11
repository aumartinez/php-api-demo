<?php

require_once ("getjson.php");

class Api {
  
  private $user;
  private $pass;
  private $token;
    
  public function __construct() {
    header ("Access-Control-Allow-Origin: *");
    header ("Content-Type: application/json; charset=UTF-8");
    header ("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header ("Access-Control-Max-Age: 3600");
    header ("Access-Control-Allow-Headers: If-Modified-Since, Cache-Control, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    $this->token = "Z3Vlc3Q6bXlwYXNz";
    
    $headers = apache_request_headers();
    $get_token = isset($headers["API-Key"]) ? $headers["API-Key"] : null;
                       
    if (!isset($get_token) || $this->token !== $get_token) {
      http_response_code(400);      
      header ("HTTP/1.0 401 Unauthorized");
      
      $mess = array(
        "message" => "Token not received",
      );
      
      echo json_encode($mess);      
      exit();
    }
            
    $country = isset($_GET["country"]) ? $_GET["country"] : null;    
    $country = $this->sanitize_str($country);
        
    $data = new getJSON($country);

    if ($data->error) {
      http_response_code(400);
      
      $mess = array(
        "message" => $data->error,
      );
       
      echo json_encode($mess);
    }
    else {
      http_response_code(201);
        
      echo json_encode($data->response);
    }    
  }
  
  public function sanitize_str($str) {
    $str = strip_tags($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    
    return $str;
  }  
}

$api = new Api();

?>