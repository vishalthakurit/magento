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
 * Whatsapp REST API customer handler
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Model_Api2_Whatsapp_Rest_Customer_V1 extends Vishal_Whatsapp_Model_Api2_Whatsapp_Rest
{
    /**
     * current customer
     * @var Mage_Customer_Model_Customer
     */
    protected $_customer;

    /**
     * get the current customer
     *
     * @access protected
     * @return Mage_Customer_Model_Customer
     * @author Ultimate Module Creator
     */
    protected function _getCustomer() {
        if (is_null($this->_customer)) {
            $customer = Mage::getModel('customer/customer')->load($this->getApiUser()->getUserId());
            if (!$customer->getId()) {
                $this->_critical('Customer not found.', Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
            }
            $this->_customer = $customer;
        }
        return $this->_customer;
    }
}
