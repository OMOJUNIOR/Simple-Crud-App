<?php

require '../vendor/autoload.php';

$wsdl = 'http://localhost';

$username = '';
$password = '';
$function_name = '';
$parameters = [];

try {
    $new = new \Omojunior\PhpWssSoapclient\Soap();
    $result = $new->call($wsdl, $username, $password, $function_name, $parameters);
    print_r($result);
} catch (\Exception $e) {
    print_r($e);
}
