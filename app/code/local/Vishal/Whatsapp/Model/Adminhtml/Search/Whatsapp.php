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
 * Admin search model
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Model_Adminhtml_Search_Whatsapp extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return Vishal_Whatsapp_Model_Adminhtml_Search_Whatsapp
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('vishal_whatsapp/whatsapp_collection')
            ->addFieldToFilter('mobile_phone', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $whatsapp) {
            $arr[] = array(
                'id'          => 'whatsapp/1/'.$whatsapp->getId(),
                'type'        => Mage::helper('vishal_whatsapp')->__('Whatsapp'),
                'name'        => $whatsapp->getMobilePhone(),
                'description' => $whatsapp->getMobilePhone(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/whatsapp_whatsapp/edit',
                    array('id'=>$whatsapp->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
