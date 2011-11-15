<?php

class Quotes extends CI_Controller{
    function __construct() {
        parent::__construct();
        }

function get_quotes() {

    //Return a list of quotes and load it into the quotelist view
        $data['main_content'] = 'saasu/quotelist';
        $this->load->model('quotes_model');
        $data['quotes'] = $this->quotes_model->get_quotes();
        $this->load->view('includes/template', $data);
    }

    function accept_quote($id) {

    //Accepts the current quote and converts it to a sales order,
    //then emails a PDF to the contact

        $data['main_content'] = 'saasu/quote_accept';
        $this->load->model('quotes_model');
        $data['quote'] = $this->quotes_model->accept_quote($id);
        var_dump($data);
    }

    function quote_detail($id) {

	//Display the details of the selected quote

        $data['main_content'] = 'saasu/quotedetail';
        $this->load->model('quotes_model');
        $data['invoice'] = $this->quotes_model->quote_detail($id);
        $this->load->view('includes/template', $data);
    }

}