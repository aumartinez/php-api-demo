<?php

require_once ("getjson.php");

class Api {
    
  public function __construct() {
    header ("Access-Control-Allow-Origin: *");
    header ("Content-Type: application/json; charset=UTF-8");
    header ("Access-Control-Allow-Methods: GET");
    header ("Access-Control-Max-Age: 3600");
    header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
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
        
      echo ($data->response);
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