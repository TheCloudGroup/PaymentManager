<?php

class Products_model extends CI_Model {

    public $wsaccesskey = "0F46-80F4-D8A2-4991-94A3-5378-8C35-29D5";
    public $fileid = "11461";
    public $wsurl = 'https://secure.saasu.com/webservices/rest/r1/';

    function products_list() {
        $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
        $this->load->library('rest', array('server' => $this->wsurl));
        $products = $this->rest->get('InventoryItemList' . $wsaccess);
        return($products);
    }

    function products_list_json() {
        $wsaccess = '?wsaccesskey=' . $this->wsaccesskey . '&fileuid=' . $this->fileid;
        $this->load->library('rest', array('server' => $this->wsurl));
        $products = $this->rest->get('InventoryItemList' . $wsaccess);
        
         foreach ($products['inventoryItemList']->inventoryItemListItem as $product)
        {
       // print_r($stuff);// (array) $stuff->description;
        //$item arra = (array) $product->description;
        $item[] = (array) $product->code;
        }
//       $item = ($products['inventoryItemList']);
//       $result = (array) $item;

      print_r($products);

    }

}
