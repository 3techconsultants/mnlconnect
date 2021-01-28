# MNL Conect Doc

  Composer install

    composer require 3techconsultants/mnlconnect
    
  Webservice JSON
     https://documenter.getpostman.com/view/14373051/TW6xmSv4

Github Project
    https://github.com/3techconsultants/mnlconnect

Ok result Example
```json
{
    "APICode": "3",
    "Status": "pending",
    "APICodeTextSP": "La transaccion esta pendiente.",
    "APICodeTextEN": "Transaction is pending",
    "RechargeId": 511289,
    "CustomId": null,
    "ConfirmationId": null
}
```
Error result Example
```json
{
    "APICode": "3",
    "Status": "error",
    "APICodeTextSP": "La transaccion esta pendiente.",
    "APICodeTextEN": "Transaction is pending",
    "RechargeId": 511289,
    "CustomId": null,
    "ConfirmationId": null
}
```

```php
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
/*
 *  Mnl connect
 * @phonenumber int 5350000010
 * @rateid int [ get in method GetRates() ]
 * @customid int [no mandatory id from you platform]
 */
   $result  = $mnl->SendRecharge($phonenumber,$rateid,$customid);

/*
 * Mnl connect
 * @nautaaccount int test@natua.com.cu
 * @rateid int [ get in method GetRates() ]
 * @customid int [no mandatory id from you platform]
 */
   $result  = $mnl->SendRechargeNauta($nautaaccount,$rateid,$customid);

   $result  = $mnl->GetBalance();

   $result  = $mnl->GetRechargeIdStatus();

   $result  = $mnl->GetCustomIdStatus();
   
   $result  = $mnl->GetRates();

   var_dump($result);

 } catch (DefaultException $e) {
 	var_dump($e->getError());
 }

```
