<?php

class Cart_model extends CI_Model {

    function add_to_cart() {
        $this->load->library('cart');
        $this->input->post($product);
        var_dump($this->cart->contents());
    }

}
?>
