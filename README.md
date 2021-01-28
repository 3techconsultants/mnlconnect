# MNL Connect Documentation

  Composer install

    composer require 3techconsultants/mnlconnect
    
Webservice Json
    https://documenter.getpostman.com/view/14373051/TW6xmSv4

Github Project
    https://github.com/3techconsultants/mnlconnect

**Ok Result Example:**
```json
{
    "APICode": "1",
    "Status": "ok",
    "APICodeTextSP": "Destino ha sido recargado.",
    "APICodeTextEN": "Destination has been recharged.",
    "RechargeId": 1119122,
    "ConfirmationId": 130406260,
    "CustomId": null
}
```


**Error Result Example:**
```json
{
    "APICode": "22",
    "Status": "error",
    "APICodeTextSP": "Destino no pertenece a cliente con servicio.",
    "APICodeTextEN": "Destination not assigned to a subscriber.",
    "RechargeId": 1119030,
    "CustomId": null
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

   var_dump($resulte);

 } catch (DefaultException $e) {
 	var_dump($e->getError());
 }

```
