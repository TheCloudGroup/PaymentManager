<?php

Class Admin_dashboard extends CI_Controller {

    function __construct() {

        parent::__construct();
    }

    function index() {
        $data['main_content'] = 'admin/admin_dashboard';

        $this->load->model('admin_model');
        $data['provider'] = $this->admin_model->provider_details();
        $this->load->view('admin/template', $data);
    }

}