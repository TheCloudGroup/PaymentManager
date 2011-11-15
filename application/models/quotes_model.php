<?php

Class Quotes_model extends CI_Model {

    public $wsaccesskey = "0F46-80F4-D8A2-4991-94A3-5378-8C35-29D5";
    public $fileid = "11461";
    public $wsurl = 'https://secure.saasu.com/webservices/rest/r1/';

    function get_quotes() {

	$contactuid = $this->session->userdata['contactuid'];
	$paidstatus = "all";
	$invoicestatus = "Q";

	$this->load->library('rest', array(
	    'server' => $this->wsurl
	));
	$transactiontype = '&transactiontype=s';
	$wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
	$data = $this->rest->get('invoicelist' . $wsaccess . $transactiontype .
			'&contactuid=' . $contactuid .
			'&InvoiceDateFrom=2000-01-01&InvoiceDateTo=2020-01-01' .
			'&paidStatus=' . $paidstatus . '&invoiceStatus=' . $invoicestatus);
	return($data);
    }

    function accept_quote($id) {
	$this->load->helper('xml');
	$wsaccess = '?Wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
	$this->load->library('rest', array(
	    'server' => $this->wsurl));
	$type = 'invoice';
	$data = $this->rest->get($type . $wsaccess . '&uid=' . $id);
	$data['invoice']->status = 'O';
	$data['invoice'] = $data['invoice']->asXML();
	$data['invoice'] =

	"<?xml version='1.0' encoding='utf-8'?>
	    <tasks>
		<updateInvoice emailToContact='true'>"
	    . $data['invoice'] .
		"\r\n<emailMessage>
		<from>accounts@cloudgroup.com.au</from>
	        <to>christian.marth@cloudgroup.com.au</to>
	        <subject>Sales Order</subject>
	        <body>Please find attached a copy of your sales order</body>
		</emailMessage>
	        </updateInvoice>
	    </tasks>";
	$uri = "Tasks" . $wsaccess;
//        echo $data['invoice'];
	$xml = $data['invoice'];
	$test = $this->rest->post($uri, $xml);
	print_r($xml);
	return ($test);
    }

    function quote_detail($id) {
	//Return an individual invoice
	$wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
	$this->load->library('rest', array(
	    'server' => $this->wsurl));
	$type = 'invoice';
	$status = 'q';
	$invoicestatus = $status;
	$paidstatus = 'all';
	$contactuid = $this->session->userdata['contactuid'];

	$invoice = $this->rest->get($type . $wsaccess . '&uid=' . $id);

	// Return a list of invoices for the day the individual invoice was generated

	$data = $this->rest->get("invoicelist" . $wsaccess . "&transactiontype=s" .
			"&contactuid=" . $contactuid . "&InvoiceDateFrom=" .
			$invoice['invoice']->date . "&InvoiceDateTo=" . $invoice['invoice']->date .
			"&paidStatus=all&invoicestatus=" . $status);

	//look for the invoice id in the list of the individual invoice

	foreach ($data['invoiceList'] as $invoicedetails) {
	    if ($invoicedetails->invoiceUid - $invoice['invoice']['uid'] == 0
		);
	    $final = $invoicedetails;
	};

	return(array($invoice, $final));
//echo $type.$wsaccess.'&uid='.$id;
    }

}