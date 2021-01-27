 <?php

 include __DIR__."/../vendor/autoload.php";
/*
 *  Mnl connect
 */
 use Mnl\DefaultException\DefaultException;

 try {

   $mnl             = new Mnl\Connect\Connect();
   /*
    * Defined Vars
    */
   $mnl->user       = '{user}';

   $mnl->pass       = '{pass}';

   $mnl->apikey     = '{apikey}';

   $mnl->debug      = true;

   $result  = $mnl->SendRecharge($phonenumber,$rateid,$customid);

   $result  = $mnl->SendRechargeNauta($nautaaccount,$rateid,$customid);

   $result  = $mnl->GetBalance();

   $result  = $mnl->GetRechargeIdStatus();

   $result  = $mnl->GetCustomIdStatus();

   var_dump($result);

 } catch (DefaultException $e) {

   var_dump($e->getError());
 }
