<?php

class getJSON {
  private $curl;
  public $response;
  public $error;
  
  public function __construct($query = null) {
    if ($query == null || trim($query) == "") {
      $query = "";
    }
    else {
      $query = "?" . $query;      
      return $this->api_call($query);
    }
    
    return $this->api_call($query);
  }
  
  protected function api_call($query = "") {
    $this->curl = curl_init();
    
    $url = "https://covid-193.p.rapidapi.com/statistics" . $query;
        
    curl_setopt_array($this->curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: covid-193.p.rapidapi.com",
        "x-rapidapi-key: API_KEY"
      ),
    ));
    
    $this->response = curl_exec($this->curl);
    $this->error = curl_error($this->curl);

    curl_close($this->curl);

    if ($this->error) {
      return "cURL Error #:" . $this->error;
    } else {
      return $this->response;
    }
  }
  
}

?>
