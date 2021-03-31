# Utilimum Connect Documentation

  Composer install

    composer require 3techconsultants/utilimum
    
Webservice Json
    https://documenter.getpostman.com/view/14373051/TW6xmSv4

Github Project
    https://github.com/3techconsultants/utilimum

**Ok Result Example:**
```json
{
    "APICode": 1,
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
    "APICode": 22,
    "Status": "error",
    "APICodeTextSP": "Destino no pertenece a cliente con servicio.",
    "APICodeTextEN": "Destination not assigned to a subscriber.",
    "RechargeId": 1119030,
    "CustomId": null
}
```

```php
/*
 *  Utilimum connect
 */
 use Utilimum\DefaultException\DefaultException;

 try {

    $um            = new Utilimum\Connect\Connect();
   /*
    * Defined Vars
    */
    $um->user       = '{user}';

    $um->pass       = '{pass}';

    $um->apikey     = '{apikey}';

    $um->debug      = true;
    
   /* Default Provider
    * Utilimum
    */
   $um->provider      = 1;
/*
 *  Utilimum connect
 * @phonenumber int 5350000010
 * @rateid int [ get it with method GetRates() ]
 * @customid int [optional id from your platform]
 */
   $result  = $um->SendRecharge($phonenumber,$rateid,$customid);

/*
 * Utilimum connect
 * @nautaaccount int test@nauta.com.cu
 * @rateid int [ get it with method GetRates() ]
 * @customid int [optional id from your platform]
 */
   $result  = $um->SendRechargeNauta($nautaaccount,$rateid,$customid);

   $result  = $um->GetBalance();

   $result  = $um->GetRechargeIdStatus();

   $result  = $um->GetCustomIdStatus();
   
   $result  = $um->GetRates();

   var_dump($result);

 } catch (DefaultException $e) {
 	var_dump($e->getError());
 }

```
