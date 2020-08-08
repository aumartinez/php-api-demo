<?php

require_once ("getjson.php");

class Api {
  
  private $user;
  private $pass;
    
  public function __construct() {
    header ("Access-Control-Allow-Origin: *");
    header ("Content-Type: application/json; charset=UTF-8");
    header ("Access-Control-Allow-Methods: GET");
    header ("Access-Control-Max-Age: 3600");
    header ("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    $valid = array(
     "guest" => "mypass",
    );
    
    $valid_users = array_keys($valid);
    
    if (!isset($_SERVER["PHP_AUTH_PW"]) || !isset($_SERVER["PHP_AUTH_PW"])) {
      http_response_code(400);
      header ("WWW-Authenticate: Basic realm=\"My Realm\"");
      header ("HTTP/1.0 401 Unauthorized");
      
      $mess = array(
        "message" => "Not authorized call",
      );
      
      echo json_encode($mess);      
      exit();
    }
    
    $user = $_SERVER["PHP_AUTH_USER"];
    $pass = $_SERVER["PHP_AUTH_PW"];
    
    $validated = (in_array($user, $valid_users)) && ($pass == $valid[$user]);

    if (!$validated) {
      http_response_code(400);
      header ("WWW-Authenticate: Basic realm=\"My Realm\"");
      header ("HTTP/1.0 401 Unauthorized");
      
      $mess = array(
        "message" => "Not authorized call",
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
        
      echo ($data->response);
    }    
  }
  
  public function sanitize_str($str) {
    $str = strip_tags($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    
    return $str;
  }
  
  public function auth($token) {
    
  }
}

$api = new Api();

?>