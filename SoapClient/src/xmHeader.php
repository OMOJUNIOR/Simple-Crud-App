<?php
/**
 * This trait contains the xml header mostly required for
 * Web service Wss UsernameToken authentication, if the above used
 * below is not the same as your web service require in the request header,
 * fork the library and add modify it.
 */

namespace Omojunior\PhpWssSoapclient;

trait xmHeader
{
    protected function wssHeader($username, $password)
    {
        $xml = '
        <wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
            <wsse:UsernameToken>
              <wsse:Username>'.$username.'</wsse:Username>
              <wsse:Password>'.$password.'</wsse:Password>
            </wsse:UsernameToken>
        </wsse:Security>
         ';

        return  $header = new \SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd',
            'Security',
            new \SoapVar($xml, XSD_ANYXML),
            true
        );
    }
}
