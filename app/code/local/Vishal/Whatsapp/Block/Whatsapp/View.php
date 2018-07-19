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
 * Whatsapp view block
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Whatsapp_View extends Mage_Core_Block_Template
{
    /**
     * get the current whatsapp
     *
     * @access public
     * @return mixed (Vishal_Whatsapp_Model_Whatsapp|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentWhatsapp()
    {
        return Mage::registry('current_whatsapp');
    }
}
