<?php

Class Saasu_model extends CI_Model{

    public  $wsaccesskey = "0F46-80F4-D8A2-4991-94A3-5378-8C35-29D5";
    public  $fileid = "11461";
    public  $wsurl = 'https://secure.saasu.com/webservices/rest/r1/';
    

    //public  $wsaccess = '?wsaccesskey='.$wsaccesskey.'&fileuid='.$fileid
    function login(){

    //Set our web services variables
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $wsaccess = '?wsaccesskey='.$this->wsaccesskey.'&fileuid='.$this->fileid;
    $this->load->library('rest', array(
            'server' => $this->wsurl
            ));

    //Load the Web Services Call

    $result = $this->rest->get('contactlist'.$wsaccess.
            '&&searchfieldname=emailaddress&searchfieldnamebeginswith='.$username.'&includeanytags=login');
//     $usr_email_vrfy = $this->wsurl.
//                'contactlist?wsaccesskey='
//                .$this->wsaccesskey."&fileuid=".$this->fileid.
//                "&&searchfieldname=emailaddress&searchfieldnamebeginswith=".$usr_email;

//    print_r($result['contactList']->contactListItem[0]->emailAddress->asXML());//->asXML());
        $saasu_pwd = $result['contactList']->contactListItem[0]->customField1;
        $saasu_contactuid = $result['contactList']->contactListItem[0]->contactUid->asXML();
        $saasu_firstname = $result['contactList']->contactListItem[0]->givenName->asXML();
        $saasu_email = $result['contactList']->contactListItem[0]->emailAddress->asXML();


        if(md5($password) == $saasu_pwd){
            
            $session = array(
                'username' => $saasu_email,
                'contactuid' => $saasu_contactuid,
                'firstname' => $saasu_firstname,
                'is_logged_in' => true
                );
            

                //Create a new session
                $this->session->set_userdata($session);
                return(true);
            }
        else{return(false);
        }
        }

        function signup(){
             $data = array(
                'insertContact' => array(
                    'contact' => array(
            "givenName" => $this->input->post('givenName'),
            "familyName" => $this->input->post('familyName'),
            "organisationName" => $this->input->post('organisationName'),
            "organisationAbn" => $this->input->post('organisationAbn'),
            "organisationPosition" => $this->input->post('organisationPosition'),
            "email" => $this->input->post('email'),
            "mainPhone" => $this->input->post('mainPhone'),
            "mobilePhone" => $this->input->post('mobilePhone'),
            "tags" => "login",
            "customField1" => md5($this->input->post('password')))));


                  $config = array(
            'server' => 'https://secure.saasu.com/webservices/rest/r1/');

        $this->rest->initialize($config);


        $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;

        
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
        print_r($data);
       print_r($result);
       print_r($xmlclean);




        }

    function get_invoices($paidstatus,$invoicestatus){

        $contactuid = $this->session->userdata['contactuid'];
        $paidstatus = $paidstatus;
        $invoicestatus = $invoicestatus;
        
        $this->load->library('rest', array(
            'server' => $this->wsurl
            ));
        $transactiontype = '&transactiontype=s';
        $wsaccess = '?wsaccesskey='.$this->wsaccesskey.'&fileuid='.$this->fileid;
        $data = $this->rest->get ('invoicelist'.$wsaccess.$transactiontype.
                '&contactuid='.$contactuid.
                '&InvoiceDateFrom=2000-01-01&InvoiceDateTo=2020-01-01'.
                '&paidStatus='.$paidstatus.'&invoicestatus='.$invoicestatus);
	    $this->rest->debug();


return $data;
    }

    function invoice_detail($id,$status){
        //Return an individual invoice
        $wsaccess = '?wsaccesskey='.$this->wsaccesskey.'&fileuid='.$this->fileid;
        $this->load->library('rest', array(
            'server' => $this->wsurl));
        $type = 'invoice';
        $invoicestatus = $status;
        $paidstatus = 'all';
        $contactuid = $this->session->userdata['contactuid'];

        $invoice = $this->rest->get($type.$wsaccess.'&uid='.$id);

        // Return a list of invoices for the day the individual invoice was generated

        $data = $this->rest->get("invoicelist".$wsaccess."&transactiontype=s".
        "&contactuid=".$contactuid."&InvoiceDateFrom=".
        $invoice['invoice']->date."&InvoiceDateTo=".$invoice['invoice']->date.
        "&paidStatus=all&invoicestatus=".$status);

        //look for the invoice id in the list of the individual invoice

        foreach($data['invoiceList'] as $invoicedetails)
        {                
                    if( $invoicedetails->invoiceUid - $invoice['invoice']['uid'] == 0);
                  $final = $invoicedetails;
        } ;
        
            return(array($invoice,$final));
//echo $type.$wsaccess.'&uid='.$id;
    }


    function get_contact_details(){

        $contactuid = $this->session->userdata['contactuid'];
        $wsaccess = '?wsaccesskey='.$this->wsaccesskey.'&fileuid='.$this->fileid;
        $this->load->library('rest', array(
            'server' => $this->wsurl));
        $type = 'contact';
        $result = $this->rest->get($type.$wsaccess.'&uid='.$contactuid);
        return ($result);

    }

    function retrieve_payments(){
        //Retrieves a list of unpaid invoices for a contact and then retrieves all
        //payments associated to those invoices

        $contactuid = $this->session->userdata['contactuid'];



    }

    function get_payments(){

        $contactuid = $this->session->userdata['contactuid'];
        $TransactionType = 'sp';
        $type = 'InvoicePaymentList';
        $type2 = 'InvoicePayment';
        $wsaccess = '?wsaccesskey='.$this->wsaccesskey.'&fileuid='.$this->fileid;
        $this->load->library('rest',array(
        'server' => $this->wsurl));
        $result = $this->rest->get($type.$wsaccess."&transactiontype=".$TransactionType.
                "&contactUid=846684");

//var_dump($result);
        foreach($result['invoicePaymentList']->invoicePaymentListItem as $payment){
$stuff = $this->rest->get($type2.$wsaccess."&uid=".$payment->invoicePaymentUid);

foreach($stuff['invoicePayment']->contactUid as $invoicepayments){
if($invoicepayment == $contactuid)
        $contact_invoices[] =  ($stuff['invoicePayment']);
        }


        }

return ($contact_invoices);

//print_r ($stuff);

//var_dump ($contact_invoices);
//var_dump ($contact_invoices);
 //       var_dump ($contact_invoices);
        
//            echo $payment->invoicePaymentUid."<br/>";
//        }
//        echo $result['invoicePaymentList']->invoicePaymentListItem[0]->invoicePaymentUid;
//        $payment = $this->rest->get($type2.$wsaccess."&uid=".$result['invoicePaymentList']->invoicePaymentListItem[0]->invoicePaymentUid);
//        var_dump ($payment);

//        echo $payment['invoicePayment']->contactUid;

    }

    
    

        function print_pdf($id){
        $wsaccess = '?wsaccesskey='.$this->wsaccesskey.'&fileuid='.$this->fileid;
        $this->load->library('rest', array(
            'server' => $this->wsurl));

        $type = 'invoice';
//        $data = $this->rest->get($type.$wsaccess.'&uid='.$id.'&format=pdf');
//            echo $data;
        $location = $this->wsurl.$type.$wsaccess.'&uid='.$id.'&format=pdf';
            header("location: $location");
          
        }

        function forgot_password(){
            $data = array (
                'email' => $this->input->post('email'),
                'confirm_email' => $this->input->post('confirm_email')
            );

            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'christian.marth@cloudgroup.com.au',
                'smtp_pass' => 'marth5587',
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('password@cloudgroup.com.au', 'The Cloud Group');
            $this->email->to($data['email']);

            $this->email->subject('The Cloud Group Password Reset');
            $this->email->message('Hello World');


            if (!$this->email->send())
                show_error($this->email->print_debugger());
            else
                echo 'Your e-mail has been sent!';
            echo $this->email->print_debugger();
              return ($data);
        }

        function test(){
            $this->load->library('saasu');

            $this->saasu->get('test','rest');
        }



}
//END saasu Model//