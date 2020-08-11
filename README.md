# php-api-demo
PHP API DEMO

## Usage
Download/clone repo and unpack in a local development environment that supports SSL, you may find more information about how to setup a local server with SSL enabled at, https://ourcodeworld.com/articles/read/198/enabling-ssl-https-protocol-with-xampp-in-a-local-php-project

Replace "API_KEY" in the getjson.php file with the rapid-api key from the rapid-api account.

## Testing

Uploaded php files to a cloud service at:
http://accedo-gps.000webhostapp.com/demo/php-api-demo/api.php

Testing with Postman got successfull responses and were able to retrieve correctly all the server payload.

Preview message from reqbin online testing (https://reqbin.com/)

![screenshot](https://github.com/aumartinez/php-api-demo/blob/master/curl.PNG)

The above token is not the API-Key from the rapid-api account, is just a validation to ensure the endpoint is accessed only by authorized users.

Trying to get data without the token will get the response:

```json
{
    "message": "Token not received"
}
```
