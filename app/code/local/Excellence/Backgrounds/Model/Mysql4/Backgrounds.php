<?php

class Excellence_Backgrounds_Model_Mysql4_Backgrounds extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the backgrounds_id refers to the key field in your database table.
        $this->_init('backgrounds/backgrounds', 'backgrounds_id');
    }
}