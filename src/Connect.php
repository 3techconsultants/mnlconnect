<?php

namespace Mnl\Connect;

class Ws{

  public $host;

  public $user;

  public $pass;

  public $conn;

  public $time;

  public $resellerid;

  public $apikey;

  public $timeout = 60;

  public function __construct($user,$pass,$apikey,$resellerid,$debug)
  {

    $this->user       = $user;

    $this->pass       = $pass;

    $this->time       = time();

    $this->resellerid = $resellerid;

    $this->apikey     = $apikey;

    #set Beta or production endpoint

    ($debug)? $this->host='https://beta.qu3bola.com' :  $this->host='https://api.qu3bola.com';
  }
  public function SendRecharge($phonenumber,$rateId,$customId = false)
  {

    $data =['phonenumber'=>$phonenumber,'ratesid'=>$rateId];

    if($customId){
        $data ['customid'] = $customId;
    }

    return $this->Connect('/topuprecharge',$data);

  }
  public function SendrechargeNauta($nautaaccount,$rateId,$customId = false)
  {
    $data =['nautaaccount'=>$nautaaccount,'ratesid'=>$rateId];

    if($customId){
        $data ['customid'] = $customId;
    }

    return $this->Connect('/nautarecharge',$data);
  }
  private function Connect($uri,$data,$post=true)
  {

    $ch      = curl_init();

    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_URL,$this->host.$uri);

    if($post){

      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "rechargeData=$payload");
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->GenerateHeader());
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS,$this->time *1000);

    $remote_server_output = curl_exec ($ch);

    if($remote_server_output === false){
      return (object)['error' => 'connection error'];
    }


    $information          = curl_getinfo($ch);

    curl_close ($ch);

    return json_decode($remote_server_output);
  }
  public function GetBalance()
  {
    return $this->Connect("/reseller/$this->resellerid",[],false);
  }
  public function GetRates()
  {
    return $this->Connect('/ratesreseller',[],false);
  }
  private function GenerateHeader()
  {
        $tohash =  $this->user.$this->time;

        $hash   = hash_hmac('sha256', $tohash, md5($this->pass));

        $header = ["Http-X-Hash:$hash","Http-X-Request-Time:".($this->time),"Http-X-User:$this->user","Http-X-ApiKey:$this->apikey"];

        return $header;
  }
}
