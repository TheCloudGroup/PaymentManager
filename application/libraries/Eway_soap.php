<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MSSoap extends SoapClient {

    function __doRequest($request, $location, $action, $version) {
        $namespace = "https://www.eway.com.au/gateway/managedpayment";

        $request = preg_replace('/<ns1:(\w+)/', '<$1 xmlns="'.$namespace.'"', $request, 1);
        $request = preg_replace('/<ns1:(\w+)/', '<$1', $request);
        $request = str_replace(array('/ns1:', 'xmlns:ns1="'.$namespace.'"'), array('/', ''), $request);

        // parent call
        return parent::__doRequest($request, $location, $action, $version);
    }
}