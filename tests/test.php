 <?php

 # set user string ,pass,apikey,resellerid string ,debug true or false provide by Qu3bolaConnect ej
 use Mnl\Connect;


 $qu3bola  = new Ws('wportillo1990@gmail.com','dinger1234','123123','123123',true);

/*
 * Send recahrge  topup
 * $phonenumber
 * $rateId
 * $custom id or false
 */
//$topup_recharge  = $qu3bola->Sendrecharge(53000,16,9);

//$nauta_recharge  = $qu3bola->Sendrechargenauta('sar@nauta.com',16,9);

$balance         = $qu3bola->Getbalance();

print_r($balance);

//$rates           = $qu3bola->Getrates();

?>