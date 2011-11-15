<?php

Class Eway_model extends CI_Model {

    function process_payments() {
        $data = array(
            "ewayTotalAmount" => $this->input->post('amount'),
            "ewayCustomerFirstName" => $this->input->post('FirstName'),
            "ewayCustomerLastName" => $this->input->post('LastName'),
            "ewayCustomerEmail" => $this->input->post('EmailAddress'),
            "ewayCustomerAddress" => $this->input->post('Address'),
            "ewayCustomerPostcode" => $this->input->post('Postcode'),
            "ewayCustomerInvoiceDescription" => $this->input->post('Invoice Description'),
            "ewayCustomerInvoiceRef" => $this->input->post('ewayCustomerInvoiceRef'),
            "ewayCardHoldersName" => $this->input->post('cardholdername'),
            "ewayCardNumber" => $this->input->post('cardnumber'),
            "ewayCardExpiryMonth" => $this->input->post('cardexpirymonth'),
            "ewayCardExpiryYear" => $this->input->post('cardexpiryyear'),
            "ewayOption1" => $this->input->post('ewayCustomerInvoiceRef'),
            "ewayOption2" => $this->input->post(''),
            "ewayOption3" => $this->input->post(''),
            "ewayTrxnNumber" => $this->input->post(''));

        $xmlRequest = "<ewaygateway><ewayCustomerID>87654321</ewayCustomerID>\r\n";
        foreach ($data as $key => $value)
            $xmlRequest .= "<$key>$value</$key>\r\n";
        $xmlRequest .= "</ewaygateway>";


        $config = array(
            'server' => 'https://www.eway.com.au/gateway/xmltest/');


        $this->load->library('rest', $config);
        $result = $this->rest->post('testpage.asp', $xmlRequest);


        return ($result);
    }

    function query_customer() {

        //Query a CustomerID for details in EWay

        //Set the web service details

        $url = 'https://www.eway.com.au/gateway/ManagedPaymentService/test/managedCreditCardPayment.asmx';
        $uri = 'https://www.eway.com.au/gateway/managedpayment';

        //Define our action
        $action = 'QueryCustomer';

        //What customer ID are we looking for

        $xml = array(
            'managedCustomerID' => 9876543211000
        );

        //The The Soap client constructor to deal with namespace issues in eways api
        $client = new MSSoapClient($url . '?WSDL', array(
                    'TRACE' => FALSE,
                ));

        // Set our SOAP Headers for authentication
        $header_body = array(
            'eWAYCustomerID' => '87654321',
            'Username' => 'test@eway.com.au ',
            'Password' => 'test123',
        );
        // Load the soap headers for the call
        $header_var = new SoapVar($header_body, SOAP_ENC_OBJECT);
        $header = new SOAPHeader('https://www.eway.com.au/gateway/managedpayment', 'eWAYHeader', $header_var);
        $client->__setSoapHeaders($header);

        //Call The EWAY API
        try {
            $response = $client->$action($xml);
        } catch (SoapFault $e) {
       //Return the error message if something went wrong
            echo 'SOAP Fault: ' . $e->getMessage() . "<br>\n";
            echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
            echo "Response:\n" . $client->__getLastResponse() . "\n";
        }
        //Return the details of our customer
        return($response);
    }
    

    function create_customer($data) {

        $url = 'https://www.eway.com.au/gateway/ManagedPaymentService/test/managedCreditCardPayment.asmx';
        $uri = 'https://www.eway.com.au/gateway/managedpayment';
        $action = 'CreateCustomer';

        $options = array(
        );
//        print_r($data);

        $xml = array(
            //'managedCustomerID' => 9876543211000
            'CCNameOnCard' => 'John Smith',
            'CCExpiryMonth' => '12',
            'CCExpiryYear' => '12',
            'CCNumber' => '4444333322221111',
            'CustomerRef' => '',
            'Title' => $data['contact']->salutation,
            'FirstName' => $data['contact']->givenName,
            'LastName' => $data['contact']->familyName,
            'Company' => $data['contact']->organisationName,
            'JobDesc' => $data['contact']->organisationPosition,
            'Email' => $data['contact']->email,
            'Address' => $data['contact']->postalAddress->street,
            'Suburb' => $data['contact']->postalAddress->city,
            'State' => $data['contact']->postalAddress->state,
            'PostCode' => $data['contact']->postalAddress->postCode,
            'Country' => 'au',
            'Phone' => $data['contact']->mainPhone,
            'Mobile' => $data['contact']->mobilePhone,
            'Fax' => $data['contact']->fax,
            'URL' => $data['contact']->organisationWebsite,
            'Comments' => ''
        );

        $client = new MSSoapClient($url . '?WSDL', array(
                    'TRACE' => TRUE,
                    'location' => $url
                ));

        // Set our SOAP Headers for authentication
        $header_body = array(
            'eWAYCustomerID' => '87654321',
            'Username' => 'test@eway.com.au',
            'Password' => 'test123',
        );

        $header_var = new SoapVar($header_body, SOAP_ENC_OBJECT);
        $header = new SOAPHeader('https://www.eway.com.au/gateway/managedpayment', 'eWAYHeader', $header_var);
        $client->__setSoapHeaders($header);

        try {
            // $response = $client->__soapCall('QueryCustomer',$xml, null, $header);
            // $client->CreateCustomer($header_body);
            $response = $client->$action($xml);
        } catch (SoapFault $e) {
            echo 'SOAP Fault: ' . $e->getMessage() . "<br>\n";
            echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
            echo "Response:\n" . $client->__getLastResponse() . "\n";
        }
        echo "Response:\n" . $client->__getLastResponse() . "\n";
        echo "Response:\n" . $client->__getLastRequest() . "\n";
       print_r($response);
    }

}

class MSSoapClient extends SoapClient {

    function __doRequest($request, $location, $action, $version) {

        $namespace = "xmlns='https://www.eway.com.au/gateway/managedpayment'";

        $request = preg_replace('/<ns1:/', '<', $request);
        $request = preg_replace('/ns1:/', '', $request);
        $request = preg_replace('/-ENV/', '', $request);
        $request = str_replace(':ns1', '', $request);
        //  $request = str_replace('<eWAYHeader', '<eWAYHeader '.$namespace, $request);
        //  $request = str_replace('<QueryCustomer>', '<QueryCustomer '.$namespace.'>', $request);
        //  echo $request;
        return parent::__doRequest($request, $location, $action, $version);
    }

}

