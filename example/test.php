 <?php

 include __DIR__."/../vendor/autoload.php";
/*
 *  Mnl connect
 */
 use Utilimum\DefaultException\DefaultException;

 try {

   $um             = new Utilimum\Connect\Connect();
   /*
    * Defined Vars
    */
   $um->user       = '{user}';

   $um->pass       = '{pass}';

   $um->apikey     = '{apikey}';
   
   /*
    * Default Provider
    * Utilimum
    */
   $um->provider      = 1;

   $um->debug         = true;

   $result  = $um->SendRecharge($phonenumber,$rateid,$customid);

   $result  = $um->SendRechargeNauta($nautaaccount,$rateid,$customid);

   $result  = $um->GetBalance();

   $result  = $um->GetRechargeIdStatus();

   $result  = $um->GetCustomIdStatus();

   var_dump($result);

 } catch (DefaultException $e) {

   var_dump($e->getError());
 }
