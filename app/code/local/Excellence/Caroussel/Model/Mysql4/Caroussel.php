<?php

class Excellence_Caroussel_Model_Mysql4_Caroussel extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the caroussel_id refers to the key field in your database table.
        $this->_init('caroussel/caroussel', 'caroussel_id');
    }
}