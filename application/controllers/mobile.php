<?php
Class mobile extends CI_Controller{
    
    function index(){
        print_r($this->input->post());
    }
}
?>
