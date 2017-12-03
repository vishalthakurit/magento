<?php

class Excellence_Showcase_Model_Mysql4_Showcase_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('showcase/showcase');
    }
}