<?php

class Excellence_Backgrounds_Model_Backgrounds extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('backgrounds/backgrounds');
    }
}