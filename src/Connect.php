<?php

namespace Utilimum\Connect;

use Utilimum\DefaultException\DefaultException;

class Connect{

  public $host;

  public $user;

  public $pass;

  public $conn;

  public $time;

  public $apikey;

  public $debug;

  public $provider  = 2;

  public $timeout   = 60;

  private function validate()
  {

    if(!$this->user){
      throw new DefaultException(1,"user is mandatory",'usuario es obligatorio');
    }
    if(!$this->pass){
      throw new DefaultException(2,"pass is mandatory",'pass es obligatoria');
    }
    if(!$this->apikey){
      throw new DefaultException(4,"apikey is mandatory",'apikey es obligatorio');
    }

    if(!$this->debug){
      throw new DefaultException(4,"debug is mandatory",'debug es obligatorio');
    }
    if(!is_bool($this->debug)){
        throw new DefaultException(4,"debug is boolean",'debug es boleano');
    }
  }
  private function Connect($uri,$data,$post=true)
  {

    $ch      = curl_init();

      curl_setopt($ch, CURLOPT_URL,$this->host.$uri);

    if($post){

      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->GenerateHeader());
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS,$this->time *1000);

    $remote_server_output = curl_exec ($ch);

    if($remote_server_output === false){
        throw new DefaultException(1,'Connection Error','Connection Error');
    }

    $information          = curl_getinfo($ch);

    curl_close ($ch);

    $data = json_decode($remote_server_output);

    if(isset($data->Status)){

      if($data->Status=='error'){
          throw new DefaultException($data->APICode,$data->APICodeTextEN,$data->APICodeTextSP);
      }

    }

    return $data;
  }
  private function GenerateHeader()
  {
        $tohash =  $this->user.$this->time;

        $hash   = hash_hmac('sha256', $tohash, md5($this->pass));

        $header = ["Http-X-Hash:$hash","Http-X-Request-Time:".($this->time),"Http-X-User:$this->user","Http-X-ApiKey:$this->apikey"];

        return $header;
  }
  public function __construct()

  {
    $this->time       = time();

    switch($this->provider){
      case 1:
          ($this->debug)? $this->host='https://beta.qu3bola.com' : $this->host ='https://v2.qu3bola.com';
      break;
      case 2:
          ($this->debug)? $this->host='https://reseller-api-beta.utilimum.com' : $this->host ='https://reseller-api.utilimum.com' ;
      break;
    }

  }
  public function SendRecharge($phonenumber,$rateid,$customid = false)
  {

    $this->validate();

    $data =['phonenumber'=>$phonenumber,'ratesid'=>$rateid];

    if($customid){
        $data ['customid'] = $customid;
    }

    return $this->Connect('/topuprecharge',$data);
  }
  public function SendRechargeNauta($nautaaccount,$rateid,$customid = false)
  {
    $data =['nautaaccount'=>$nautaaccount,'ratesid'=>$rateid];

    if($customid){
        $data ['customid'] = $customid;
    }

    return $this->Connect('/nautarecharge',$data);
  }
  public function GetBalance()
  {
    return $this->Connect("/reseller/get?data=balance",[],false);
  }
  public function GetRates()
  {
    return $this->Connect('/ratesreseller',[],false);
  }
  public function GetRechargeIdStatus($rechargeid)
  {
    $data = ['rechargeid'=>$rechargeid,'method'=>'getrechargestatus'];
    return $this->Connect('/reports',$data);

  }
  public function GetCustomIdStatus($customid)
  {
    $data = ['customid'=>$customid,'method'=>'getrechargestatus'];

    return $this->Connect('/reports',$data);
  }
}
