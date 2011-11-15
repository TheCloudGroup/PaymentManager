<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Saasu {

    private $CI;

  // $wsaccess = $CI->config->item('wsaccess')
    
    
    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('rest');
        $this->CI->config->load('saasu');
        $this->initialize();
    }

    public function initialize() {

    }

    public function get($method, $params) {

//        $fileid = $CI->config->item('fileid');
//        $wsurl = $CI->config->item('wsurl');
        echo $this->wsaccess;
    }

}

//    public  $wsaccesskey = "0F46-80F4-D8A2-4991-94A3-5378-8C35-29D5";
//    public  $fileid = "11461";
//    public  $wsurl = 'https://secure.saasu.com/webservices/rest/r1/';
//      function login() {
//
//    //Set our web services variables
//    $username = $this->input->post('username');
//    $password = $this->input->post('password');
//    $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
//    $this->load->library('rest', array(
//        'server' => $this->wsurl
//    ));
//
//    //Load the Web Services Call
//
//    $result = $this->rest->get('contactlist' . $wsaccess .
//                    '&&searchfieldname=emailaddress&searchfieldnamebeginswith=' . $username . '&includeanytags=login');
//
//
