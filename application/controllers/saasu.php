<?php
//TODO Change this to client controller
class Saasu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('rest', array(
            'server' => 'https://secure.saasu.com/webservices/rest/r1/'
        ));
    }

    function index() {
        $data['main_content'] = 'saasu/welcome';
        $this->load->view('includes/template', $data);
    }
    //TODO add hotlink functionality which doesn't require login
    function login() {

        // load the form validation library
        $this->load->library('form_validation');


        // Set the form validation rules

        $this->form_validation->set_rules('username', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

        // Run the form validation

        if ($this->form_validation->run() == FALSE) {

            // Return back to the login page on failure

            $this->index();
        } else {

            //Run our verification to see if user exists

            $this->load->model('saasu_model');
            $result = $this->saasu_model->login();
            if ($result) {

                //Send them to the dashboard
                $content['main_content'] = 'saasu/dashboard';
                $this->load->model('saasu_model');
                $content['invoices'] = $this->saasu_model->get_invoices('unpaid', 'I');

                $this->load->view('includes/template', $content);

                //If Uses doesn't exist return them to login page
            } else {
                $this->index();
            };
        }
    }

    function signup_form(){
        $content['main_content'] = 'saasu/signup';
        $this->load->view('includes/template',$content);
        
    }
    //TODO Develop Registration Functionality
    function signup(){
    $this->load->model('saasu_model');
    $this->saasu_model->signup();
    
    }
    //TODO Finish Reset Password Feature
    function forgot_password() {
        $content ['main_content'] = 'saasu/forgot_password';
        $this->load->view('includes/template', $content);
    }

    function password_reset() {
        $this->load->model('saasu_model');
        print_r($this->saasu_model->forgot_password());
        var_dump($this->config);
    }

}
