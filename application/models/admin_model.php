<?php

class Admin_model extends CI_Model{

    function provider_details(){
        $query = ($this->db->query('select ID from Providers WHERE '));
            return ($query->result());
    }


}

?>
