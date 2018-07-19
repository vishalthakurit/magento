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
class Vishal_Whatsapp_Model_System_Config_Source_Buttontype extends Mage_Core_Model_Config_Data
{

    const FLOATINGBALL = 'floating_ball';
    const BADGE = 'badge';
    const STICKY = 'sticky';

    public function toOptionArray()
    {
        $positions = array(
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Floating ball'),
                                'value' => self::FLOATINGBALL
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Floating button'),
                                'value' => self::BADGE
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Sticky'),
                                'value' => self::STICKY
                            )
                        );
        
        return $positions;

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
