<?php

Class mobile extends CI_Controller {

    function index() {
        $card = array(
        'name' => $this->input->post('name'),
        'number' => $this->input->post('number'),
        'expiry' => $this->input->post('expiry')
        );
        
        print_r($card);
        
    }

}

?>
