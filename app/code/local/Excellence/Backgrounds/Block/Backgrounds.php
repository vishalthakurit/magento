<?php
class Excellence_Backgrounds_Block_Backgrounds extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getBackgroundImage()     
     { 
        $path='';
        $exclusion_list=array('form01','extranet','dados','form02','super-inviter','avaliar','well-done');
        $router=Mage::app()->getRequest()->getModuleName();
        if(!in_array($router, $exclusion_list)){
            $backgroundImage=Mage::getModel('backgrounds/backgrounds')->getCollection()->getFirstItem(); 
            if($backgroundImage->getData()){
                if($backgroundImage->getFilename()){
                    $path = Mage::getBaseUrl('media') .  'backgroundimages' . DS.$backgroundImage->getFilename();
                }
            }
        }
        return $path;
    }
}