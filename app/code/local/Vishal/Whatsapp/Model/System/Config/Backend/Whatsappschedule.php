<?php
class Vishal_Whatsapp_Model_System_Config_Backend_Whatsappschedule extends Mage_Core_Model_Config_Data
{
	protected function _afterSave()
	{
		Mage::log('hello', null, 'my.log', true); 
		if (is_array($this->getValue())) {
			Mage::log($this->getValue(), null, 'my.log', true); 	
		}
	}
}

?>