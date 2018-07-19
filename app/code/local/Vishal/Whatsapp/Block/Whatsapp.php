<?php 
/**
 * Vishal_Whatsapp extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Vishal
 * @package        Vishal_Whatsapp
 * @copyright      Copyright (c) 2018
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Whatsapp RSS block
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 */
class Vishal_Whatsapp_Block_Whatsapp extends Mage_Core_Block_Template
{
    public function getStrId()
    {
        $storeId =  Mage::app()->getStore()->getStoreId();
        return $storeId; 
    }

    public function getButtonText()
    {  
        $buttonText = Mage::getStoreConfig('vishal_whatsapp/whatsapp_general_config/button_text', $this->getStrId());
        return $buttonText;
    }

    public function getWhatsappNumber()
    {
        $mobileNumber = Mage::getStoreConfig('vishal_whatsapp/whatsapp_general_config/mobile_number', $this->getStrId());
        return $mobileNumber;
    }

    public function getDefaultMsg()
    {
        $defaultMsg = Mage::getStoreConfig('vishal_whatsapp/whatsapp_general_config/default_msg', $this->getStrId());
        return $defaultMsg;
    }

    public function getButtonColor()
    {
        $buttonColor = Mage::getStoreConfig('vishal_whatsapp/whatsapp_dispaly_config/button_color', $this->getStrId());
        return $buttonColor;
    }

    public function getButtonType()
    {
        $buttonType = Mage::getStoreConfig('vishal_whatsapp/whatsapp_dispaly_config/type', $this->getStrId());
        return $buttonType;
    }

    public function getButtonPosition()
    {
        $buttonPosition = Mage::getStoreConfig('vishal_whatsapp/whatsapp_dispaly_config/position', $this->getStrId());
        return $buttonPosition;
    }

    public function getOfflineMsg()
    {
        $offlineMsg = Mage::getStoreConfig('vishal_whatsapp/whatsapp_dispaly_config/offline_message', $this->getStrId());
        return $offlineMsg;
    }

    public function getScheduleTiming()
    {   
        $finalTiming = array();
        $weekdays = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
        $scheduleTime = Mage::getStoreConfig('vishal_whatsapp/display/schedule', $this->getStrId());
        $scheduleTiming = json_decode($scheduleTime, true);
        foreach ($scheduleTiming as $key => $value) {
            $value['day'] = $weekdays[$key];
            $finalTiming[] = $value;
        }
        return $finalTiming;
    }

    public function getDefaultTimeZone()
    {
        return Mage::getStoreConfig('general/locale/timezone');
    }

    public function getCustGrpId()
    {
        $customerGroupId = "";
        $isLoggedIn = Mage::getSingleton('customer/session')->isLoggedIn();
        
        if($isLoggedIn)
        {
            $customerGroupId = Mage::getSingleton('customer/session')->getCustomerGroupId();
        }
        return $customerGroupId;
    }

    public function isEnable()
    {
        return Mage::getStoreConfig('vishal_whatsapp/whatsapp_general_config/enable', $this->getStrId());
    }

    public function getSelectedCustGrpId()
    {
        return explode(',', Mage::getStoreConfig('vishal_whatsapp/filters/customer_groups', $this->getStrId()));        
    }

    public function getSelPages()
    {
        return explode(',', Mage::getStoreConfig('vishal_whatsapp/filters/specific_pages', $this->getStrId()));
    }

    public function getWhtsappGrpId()
    {
        return Mage::getStoreConfig('vishal_whatsapp/whatsapp_general_config/group_id', $this->getStrId());
    }

    public function enableShareUrl()
    {
        return Mage::getStoreConfig('vishal_whatsapp/whatsapp_general_config/share_msg', $this->getStrId());
    }

}
