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
 */
class Vishal_Whatsapp_Model_System_Config_Source_Pages extends Mage_Core_Model_Config_Data
{
    const CATEGORY = 'category';
    const PRODUCT = 'product';
    const CHECKOUT = 'checkout';
    const CART = 'cart';
    const CONTACTS = 'contacts';
    const CUSTOMER = 'customer';
    const WISHLIST = 'wishlist';

    /**
     * get possible values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function toOptionArray()
    {
        $pages = Mage::getModel('cms/page')->getCollection()->toOptionArray();
        $otherPages = array(
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Category'),
                                'value' => self::CATEGORY
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Product'),
                                'value' => self::PRODUCT
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Checkout'),
                                'value' => self::CHECKOUT
                            ),
                            array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Cart'),
                                'value' => self::CART
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Contact'),
                                'value' => self::CONTACTS
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Customer account'),
                                'value' => self::CUSTOMER
                            ),array(
                                'label' => Mage::helper('vishal_whatsapp')->__('Wishlist'),
                                'value' => self::WISHLIST
                            )
                        );
        $final = array_merge($pages,$otherPages);
        return $final;
    }

    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
