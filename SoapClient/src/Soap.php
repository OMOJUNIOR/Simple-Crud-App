<?php

namespace Omojunior\PhpWssSoapclient;

class Soap
{
    use xmHeader;

    public function call($wsdl, $username, $password, $function_name, $parameter = null)
    {
        $header = $this->wssHeader($username, $password);
        $client = new \SoapClient($wsdl, ['trace' => 1, 'soap_version' => SOAP_1_1]);
        $client->__setSoapHeaders($header);
        $response = $client->__soapCall($function_name, $parameter);

        return $response;
    }
}
