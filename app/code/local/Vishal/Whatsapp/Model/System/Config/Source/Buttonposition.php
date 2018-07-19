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
 * Admin source yes/no/default model
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Model_System_Config_Source_Buttonposition extends Mage_Core_Model_Config_Data
{
    const TOPLEFT = 'top-left';
    const TOPCENTER = 'top-center';
    const TOPRIGHT = 'top-right';
    const LEFT = 'left';
    const CENTER = 'center';
    const RIGHT = 'right';
    const BOTTOMLEFT = 'bottom-left';
    const BOTTOMCENTER = 'bottom-center';
    const BOTTOMRIGHT = 'bottom-right';

    public function toOptionArray()
    {
        $positions = array(
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Top left'),
                                'value' => self::TOPLEFT
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Top Center'),
                                'value' => self::TOPCENTER
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Top right'),
                                'value' => self::TOPRIGHT
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Mid left'),
                                'value' => self::LEFT
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Mid center'),
                                'value' => self::CENTER
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Mid right'),
                                'value' => self::RIGHT
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Bottom left'),
                                'value' => self::BOTTOMLEFT
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Bottom center'),
                                'value' => self::BOTTOMCENTER
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Bottom right'),
                                'value' => self::BOTTOMRIGHT
                            )
                        );
        
        return $positions;

        // $myDynamicValue = '1,2,3';      vishal_whatsapp_filters_specific_pages
        // Mage::getConfig()->saveConfig('section/group/field', $myDynamicValue, 'default', 0);
    }

    /**
     * Get list of all available values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
