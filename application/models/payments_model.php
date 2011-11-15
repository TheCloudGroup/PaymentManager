<?php

Class Payments_model extends CI_Model {

    public $wsaccesskey = "0F46-80F4-D8A2-4991-94A3-5378-8C35-29D5";
    public $fileid = "11461";
    public $wsurl = 'https://secure.saasu.com/webservices/rest/r1/';

    function get_payments() {


        //Call Saasu's Invoice list method and

        $contactuid = "&contactuid=" . $this->session->userdata['contactuid'];
        $this->load->library('rest', array(
            'server' => $this->wsurl));

        $type = '&TransactionType=s';
        $incpayments = '&incpayments=true';

        $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
        $payments = $this->rest->get('invoiceList' . $wsaccess . $type . $contactuid);

        //Get an array of invoice uids for a contact
        foreach ($payments['invoiceList']->invoiceListItem as $invoice) {
            $invoiceuid[] = ($invoice->invoiceUid);
        }

        // Get an array of individual invoices for a contact
        foreach ($invoiceuid as $payment) {
            $invoicepaymentuid = ($this->rest->get('invoice' . $wsaccess . "&uid=$payment" . "&incpayments=true"));
            $invoicepaymentlist[] = $invoicepaymentuid['invoice']->payments;
        };


        // Get an array of payment UIDs for each invoice

        foreach ($invoicepaymentlist as $test) {

            //Check to see which invoice have payments and
            // only get the invoice UIDs with payments
            if (is_object($test->payment)) {
                foreach ($test->payment as $testpayment) {
                    $invoiceuidlist[] = $testpayment->invoicePaymentUid;
                }
            }
        }


        // Call Saasu invoice payment method for each invoice and
        // Return the details of each invoice payment

        foreach ($invoiceuidlist as $invoiceuidlistitems) {
            $result[] = $this->rest->get('invoicepayment' . $wsaccess . "&uid=" .
                            $invoiceuidlistitems);
        }

        //Output the results

        return ($result);
    }

    function get_payment($id){
        
        $this->load->library('rest', array(
            'server' => $this->wsurl));

        $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;

        $result = $this->rest->get('invoicepayment' . $wsaccess . "&uid=" .
                            $id);

        return($result);
    }


    function pay_invoice($id) {
        return ($id);
    }

//    function process_payment() {
//        $data = array(
//            "ewayTotalAmount" => $this->input->post('amount'),
//            "ewayCustomerFirstName" => $this->input->post('FirstName'),
//            "ewayCustomerLastName" => $this->input->post('LastName'),
//            "ewayCustomerEmail" => $this->input->post('EmailAddress'),
//            "ewayCustomerAddress" => $this->input->post('Address'),
//            "ewayCustomerPostcode" => $this->input->post('Postcode'),
//            "ewayCustomerInvoiceDescription" => $this->input->post('Invoice Description'),
//            "ewayCustomerInvoiceRef" => $this->input->post('ewayCustomerInvoiceRef'),
//            "ewayCardHoldersName" => $this->input->post('cardholdername'),
//            "ewayCardNumber" => $this->input->post('cardnumber'),
//            "ewayCardExpiryMonth" => $this->input->post('cardexpirymonth'),
//            "ewayCardExpiryYear" => $this->input->post('cardexpiryyear'),
//            "ewayOption1" => $this->input->post('ewayCustomerInvoiceRef'),
//            "ewayOption2" => $this->input->post(''),
//            "ewayOption3" => $this->input->post(''),
//            "ewayTrxnNumber" => $this->input->post(''));
//
//        $xmlRequest = "<ewaygateway><ewayCustomerID>87654321</ewayCustomerID>\r\n";
//		foreach($data as $key=>$value)
//			$xmlRequest .= "<$key>$value</$key>\r\n";
//        $xmlRequest .= "</ewaygateway>";
//        $this->load->library('rest',
//                array(
//                    'server' => 'https://www.eway.com.au/gateway/xmltest/',
//
//        ));
//        $result = $this->rest->post('testpage.asp',$xmlRequest);
//
//        return($result);


    function insert_payment($data) {
        //var_dump($data);
        $config = array(
            'server' => 'https://secure.saasu.com/webservices/rest/r1/');

        $this->rest->initialize($config);


        $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;

        $data = array(
            'insertInvoicePayment' => array(
                'invoicePayment>' => array(
                    "transactionType" => 'SP',
                    "date" => date('Y-m-d'),
                    "contactUid" => $this->session->userdata['contactuid'],
                    "reference" => $data['result']['ewayTrxnNumber'],
                    "summary" => '',
                    "paymentAccountUid" => '245281',
                    "invoicePaymentItems" => array(
                        'invoicePaymentItem' => array(
                            "invoiceUid" => $data['result']['ewayTrxnOption1'],
                            "amount" => ($data['result']['ewayReturnAmount'] / 100 . ".00"),
                        ),
                ))));

        $this->load->library('xml');
        $xmlresult = $this->xml->toXml($data, "tasks");
        $xmlclean = $this->xml->formatXmlString($xmlresult);
        $response = $this->rest->post('tasks' . $wsaccess, $xmlclean);
//        var_dump("<pre>".$response."</pre>".'woof');
//        echo $xmlclean;
        //print_r($response);
        //echo $this->rest->debug();
//            print_r ($response);
//            echo 'woof';
        $result = new SimpleXMLElement($response);
        return($result);
    }

}

//End payments_model.php