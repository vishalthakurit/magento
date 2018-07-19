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
 * Whatsapp list block
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Whatsapp_List extends Mage_Core_Block_Template
{
    /**
     * initialize
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $whatsapps = Mage::getResourceModel('vishal_whatsapp/whatsapp_collection')
                         ->addStoreFilter(Mage::app()->getStore())
                         ->addFieldToFilter('status', 1);
        $whatsapps->setOrder('mobile_phone', 'asc');
        $this->setWhatsapps($whatsapps);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return Vishal_Whatsapp_Block_Whatsapp_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'vishal_whatsapp.whatsapp.html.pager'
        )
        ->setCollection($this->getWhatsapps());
        $this->setChild('pager', $pager);
        $this->getWhatsapps()->load();
        return $this;
    }

    /**
     * get the pager html
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
