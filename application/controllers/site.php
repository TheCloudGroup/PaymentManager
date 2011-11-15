<?php

class Site extends CI_Controller {


    function __construct() {
        //Check to see if user is logged in
        parent::__construct();
        $this->is_logged_in();
    }

    function index() {
        //Take User to login Page
        redirect('saasu/index');
    }

    //Take User to Dashboard
    function saasu_dashboard() {

        $content['main_content'] = 'saasu/dashboard';
        $this->load->model('saasu_model');
        $content['invoices'] = $this->saasu_model->get_invoices('unpaid', 'I');
        $this->load->view('includes/template', $content);
    }

    function is_logged_in() {
        //See if the user is logged in
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $data['main_content'] = 'saasu/welcome';
            $this->load->view('includes/template', $data);
            //TODO Create redirect for users not logged in
        }
    }

    function logout() {

        $this->session->sess_destroy();
        $this->index();
    }

    //TODO Create a Client Login Controller to handle user verification and authentication

    function get_invoices() {

        //$contactuid = $_POST['uid'];
        $data['main_content'] = 'saasu/invoicelist';
        $this->load->model('saasu_model');
        $data['invoices'] = $this->saasu_model->get_invoices('all', 'I');
        if ($data) {
            $this->load->view('includes/template', $data);
        }
        else
            $this->logout();
        //echo $contactuid;
    }

    //TODO Create Seperate Controllers for client functions i.e menu items

    function invoice_detail($id, $status) {

        $data['main_content'] = 'saasu/invoicedetail';
        $this->load->model('saasu_model');
        $data['invoice'] = $this->saasu_model->invoice_detail($id, $status);
        $this->load->view('includes/template', $data);
    }

    function contact_details() {

        $data['main_content'] = 'saasu/contact';
        $this->load->model('saasu_model');
        $this->load->model('eway_model');
        $data['contact'] = $this->saasu_model->get_contact_details();
        $data['eway'] = $this->eway_model->query_customer();
        $this->load->view('includes/template', $data);
    }

    function payments() {

        $data['main_content'] = "saasu/payments";
        $this->load->model('saasu_model');

        $data['payments'] = $this->saasu_model->get_payments();
//        print_r ($data);
        $this->load->view('includes/template', $data);


//        $this->saasu_model->get_payments();
    }

    function orders() {
        $data['main_content'] = 'saasu/orderlist';
        $this->load->model('saasu_model');
        $data['orders'] = $this->saasu_model->get_invoices('all', 'O');

        $this->load->view('includes/template', $data);
    }

    function get_quotes() {

        $data['main_content'] = 'saasu/quotelist';
        $this->load->model('saasu_model');
        $data['quotes'] = $this->saasu_model->get_quotes();
        $this->load->view('includes/template', $data);
    }

    function accept_quote($id) {

        $data['main_content'] = 'saasu/quote_accept';
        $this->load->model('saasu_model');
        $data['quote'] = $this->saasu_model->accept_quote($id);
        //var_dump($data);
        var_dump($data);
    }

    function get_payments() {

        $data['main_content'] = 'saasu/payments';
        $this->load->model('payments_model');
        $data['payments'] = $this->payments_model->get_payments();
        $this->load->view('includes/template', $data);
    }

    function pay_invoice($id) {

        $data['main_content'] = 'saasu/pay_invoice';
        $this->load->model('payments_model');
        $data['result'] = $this->payments_model->pay_invoice($id);
        $this->load->model('saasu_model');
        $data['contact'] = $this->saasu_model->get_contact_details();
        $data['invoice'] = $this->saasu_model->invoice_detail($id);
        $this->load->view('includes/template', $data);
    }

    function process_payment() {

        $data['main_content'] = 'saasu/payment_result';
        $this->load->model('eway_model');
        $data['result'] = $this->eway_model->process_payments();
        $this->load->model('payments_model');
        $data['response'] = $this->payments_model->insert_payment($data);
        //var_dump($data['response']);
        //
        $data['response']->insertInvoicePaymentResult['insertedEntityUid'];
        $data['payment'] = $this->payments_model->get_payment($data['response']
                        ->insertInvoicePaymentResult['insertedEntityUid']);
        $this->load->view('includes/template', $data);
    }

    function products() {

        $data ['main_content'] = 'saasu/product_list';
        $this->load->model('products_model');
        $data['products'] = $this->products_model->products_list();
        $this->load->view('includes/template', $data);
    }

    function product() {
        //$item = "JSON : ".trim($this->input->post('item'));
        $this->load->model('products_model');
        $item = $this->products_model->products_list_json();
        $array = $item;
        return($array);
    }

//    function insert_payment($data){
//        //var_dump ($data);
//        $this->load->model('payments_model');
//        $response = $this->payments_model->insert_payment($data);
//        var_dump ($response);
//    }
    //TODO Create Products controller to handle re-ordering
    function add_to_cart($id, $qty) {

        $stuff = array(
            'id' => $id,
            'qty' => $qty,
        );
        $data['main_content'] = 'saasu/product_list';
        $this->load->model('cart_model');
        $response = $this->products_model->add_to_cart($stuff);
    }

    //TODO Ensure URL is not present in browser in FF
    function print_pdf($id) {

        $this->load->model('saasu_model');
        $response = $this->saasu_model->print_pdf($id);
//        return ($response);
    }

    function query_managed_customer() {

        $model = 'eway_model';
        $this->load->model($model);
        $response = $this->eway_model->query_customer();
        var_dump($response);
    }

    function create_managed_customer() {
        $this->load->model('saasu_model');
        $data = $this->saasu_model->get_contact_details();
        $this->load->model('eway_model');
        $this->eway_model->create_customer($data);
    }

    function suppliers() {
        $data['main_content'] = "saasu/suppliers";
        $query = $this->db->query('select * from Providers');
        $data['suppliers'] = $query->result_array();
        $this->load->view('includes/template', $data);
    }

    function test() {
        $this->load->model('saasu_model');
        $this->saasu_model->test();
    }

}