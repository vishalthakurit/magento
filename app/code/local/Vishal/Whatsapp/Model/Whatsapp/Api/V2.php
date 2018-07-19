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
class Vishal_Whatsapp_Model_Whatsapp_Api_V2 extends Vishal_Whatsapp_Model_Whatsapp_Api
{
    /**
     * Whatsapp info
     *
     * @access public
     * @param int $whatsappId
     * @return object
     * @author Ultimate Module Creator
     */
    public function info($whatsappId)
    {
        $result = parent::info($whatsappId);
        $result = Mage::helper('api')->wsiArrayPacker($result);
        return $result;
    }
}
