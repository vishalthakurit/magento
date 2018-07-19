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
 * Whatsapp comment model
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Model_Whatsapp_Comment_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * get whatsapps comments
     *
     * @access public
     * @param mixed $filters
     * @return array
     * @author Ultimate Module Creator
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('vishal_whatsapp/whatsapp_comment')->getCollection();
        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }
        $result = array();
        foreach ($collection as $whatsapp) {
            $result[] = $whatsapp->getData();
        }
        return $result;
    }

    /**
     * update comment status
     *
     * @access public
     * @param mixed $filters
     * @return bool
     * @author Ultimate Module Creator
     */
    public function updateStatus($commentId, $status)
    {
        $comment = Mage::getModel('vishal_whatsapp/whatsapp_comment')->load($commentId);
        if (!$comment->getId()) {
            $this->_fault('not_exists');
        }
        try {
            $comment->setStatus($status)->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return true;
    }
}
