<?php
class Excellence_Caroussel_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	 
		$this->loadLayout();     
		$this->renderLayout();
    }
    
    function savenoresultAction(){
        $key=$this->getRequest()->getPost('key');
        $redis = Mage::getSingleton('extranet/redis');
        $redis->setValue($key,$this->getRequest()->getPost('data'));
           
    }
}