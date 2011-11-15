<?php

class Admin extends CI_Controller {

    function __construct() {

        parent::__construct();
    }

    function index() {

        if ($this->session->userdata('logged_in') == 1)
            redirect('admin_dashboard');
        else {
            $data['main_content'] = 'admin/login';
            $this->load->view('admin/template', $data);
        }
    }

    function login() {

        echo $this->session->userdata('logged_in');

        $rules['login_username'] = "required|min_length[4]|max_length[32]|alpha_dash";
        $rules['login_password'] = "required|min_length[4]|max_length[32]|alpha_dash";

        $this->validation->set_rules($rules);

        $fields['login_username'] = 'login_username';
        $fields['login_password'] = 'login_password';

        $this->validation->set_fields($fields);

        if ($this->validation->run() == false) {

            redirect('admin/index');
        } else {

            if ($this->simplelogin->login($this->input->post('login_username'), $this->input->post('login_password'))) {

                redirect('admin_dashboard');
            }

            else
//                redirect('admin/index');
                echo 'login incorrect';

            var_dump($this->input->post('login_username'));

            var_dump($this->input->post('login_password'));

            var_dump($this->simplelogin->login($this->input->post('login_username'), $this->input->post('login_password')));
        }
    }

    function logout() {
        $this->simplelogin->logout();
        redirect('admin');
    }

}

?>
