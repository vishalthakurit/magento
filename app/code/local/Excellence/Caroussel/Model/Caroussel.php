<?php

class Excellence_Caroussel_Model_Caroussel extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('caroussel/caroussel');
    }
}