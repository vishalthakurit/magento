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
 * Whatsapp admin edit tabs
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Block_Adminhtml_Whatsapp_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('whatsapp_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('vishal_whatsapp')->__('Whatsapp'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Vishal_Whatsapp_Block_Adminhtml_Whatsapp_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_whatsapp',
            array(
                'label'   => Mage::helper('vishal_whatsapp')->__('Whatsapp'),
                'title'   => Mage::helper('vishal_whatsapp')->__('Whatsapp'),
                'content' => $this->getLayout()->createBlock(
                    'vishal_whatsapp/adminhtml_whatsapp_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        $this->addTab(
            'form_meta_whatsapp',
            array(
                'label'   => Mage::helper('vishal_whatsapp')->__('Meta'),
                'title'   => Mage::helper('vishal_whatsapp')->__('Meta'),
                'content' => $this->getLayout()->createBlock(
                    'vishal_whatsapp/adminhtml_whatsapp_edit_tab_meta'
                )
                ->toHtml(),
            )
        );
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addTab(
                'form_store_whatsapp',
                array(
                    'label'   => Mage::helper('vishal_whatsapp')->__('Store views'),
                    'title'   => Mage::helper('vishal_whatsapp')->__('Store views'),
                    'content' => $this->getLayout()->createBlock(
                        'vishal_whatsapp/adminhtml_whatsapp_edit_tab_stores'
                    )
                    ->toHtml(),
                )
            );
        }
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve whatsapp entity
     *
     * @access public
     * @return Vishal_Whatsapp_Model_Whatsapp
     * @author Ultimate Module Creator
     */
    public function getWhatsapp()
    {
        return Mage::registry('current_whatsapp');
    }
}
